<?php declare(strict_types=1);
namespace Nevay\Ucum;

use Antlr\Antlr4\Runtime\CommonTokenStream;
use Antlr\Antlr4\Runtime\Error\Listeners\DiagnosticErrorListener;
use Antlr\Antlr4\Runtime\InputStream;
use Nevay\Ucum\Internal\ErrorListener;
use Nevay\Ucum\Internal\Factor\Composite;
use Nevay\Ucum\Internal\Factor\Identity;
use Nevay\Ucum\Internal\Factor\Scale;
use Nevay\Ucum\Internal\Grammar;
use Nevay\Ucum\Internal\Part;
use Nevay\Ucum\Internal\Visitor;
use Nevay\Ucum\Internal\Vocabulary;
use function array_slice;
use function assert;
use function count;
use function is_numeric;
use function sprintf;
use function substr;

/**
 * An UCUM unit.
 *
 * @see https://ucum.org/
 */
final class Unit {

    /**
     * @param list<Part> $parts unit atoms with their prefixes,
     *        e.g. `km/h` -> `[(prefix: k, unit: m), (unit: h)]`
     * @param list<int> $exponents exponents of the units in `$parts`,
     *        e.g. `km/h` -> `[1, -1]`
     * @param list<int> $dimensions base dimension exponents of this unit
     * @param list<int|float> $factors factors to convert a value from this unit to the base dimensions
     * @param list<int> $factorExponents exponents for the factors in `$factors`
     * @param list<Internal\Factor> $special special conversion factors for this unit
     *
     * @internal
     */
    public function __construct(
        private readonly array $parts,
        private readonly array $exponents,
        private readonly array $dimensions,
        private readonly array $factors,
        private readonly array $factorExponents,
        private readonly array $special = [],
        private readonly bool $arbitrary = false,
    ) {}

    /**
     * Computes the conversion factor.
     *
     * @param string|Unit $from unit to convert from
     * @param string|Unit $to unit to convert to
     * @param Variant $variant variant to parse, either case sensitive or case insensitive
     * @return Factor the factor to convert values in `from` unit to `to` units
     * @throws UnitException if either unit string is invalid or if the units are not convertible to
     *         eachother
     *
     * @see Unit::parse()
     * @see Unit::convertTo()
     */
    public static function convert(string|Unit $from, string|Unit $to, Variant $variant = Variant::CaseSensitive): Factor {
        if (!$from instanceof Unit) {
            $from = Unit::parse($from, $variant);
        }
        if (!$to instanceof Unit) {
            $to = Unit::parse($to, $variant);
        }

        return $from->convertTo($to);
    }

    /**
     * Parses the given `$unit` string.
     *
     * @param string $unit the unit string to parse
     * @param Variant $variant variant to parse, either case sensitive or case insensitive
     * @return Unit the parsed unit
     * @throws UnitException if the given unit string is invalid
     */
    public static function parse(string $unit, Variant $variant = Variant::CaseSensitive): Unit {
        $input = InputStream::fromString($unit);
        $lexer = match ($variant) {
            Variant::CaseSensitive => new Grammar\UcumCS($input),
            Variant::CaseInsensitive => new Grammar\UcumCI($input),
        };
        $tokens = new CommonTokenStream($lexer);
        $parser = new Grammar\Ucum($tokens);
        $parser->addErrorListener(new DiagnosticErrorListener());
        $parser->addErrorListener(new ErrorListener());

        $visitor = match ($variant) {
            Variant::CaseSensitive => new Visitor(new Vocabulary\VocabularyCS()),
            Variant::CaseInsensitive => new Visitor(new Vocabulary\VocabularyCI()),
        };

        try {
            return $visitor->visitUnit($parser->unit());
        } catch (UnitException $e) {
            throw new UnitException(sprintf('Error parsing "%s" (%s): %s', $unit, $variant->name, $e->getMessage()), $e->getCode(), $e);
        }
    }

    /**
     * Computes the conversion factor.
     *
     * @param Unit $unit the unit to convert to
     * @return Factor the scaling factor to convert values in `from` unit to `to` units
     * @throws UnitException if the units are not convertible to eachother
     */
    public function convertTo(Unit $unit): Factor {
        $this->ensureSupportsConversion();
        $unit->ensureSupportsConversion();
        $this->ensureConvertibleDimensions($unit);

        if ($this->special || $unit->special) {
            $factors = [$this->scaleFactor(), ...$this->special];
            $factorsInverse = [$unit->scaleFactor(), ...$unit->special];

            $sl = count($factors);
            $sr = count($factorsInverse);
            for (; $sl > 0 && $sr > 0 && $factors[$sl - 1]->equals($factorsInverse[$sr - 1]); $sl--, $sr--) {}

            if ($sl > 1 || $sr > 1) {
                return new Composite(
                    factors: array_slice($factors, 0, $sl),
                    factorsInverse: array_slice($factorsInverse, 0, $sr),
                );
            }
        }

        $rl = new Unit([], [], [], $this->factors, $this->factorExponents);
        $rr = new Unit([], [], [], $unit->factors, $unit->factorExponents);

        return $rl->_multiply($rr, -1)->scaleFactor();
    }

    /**
     * Multiplies this unit by the given unit.
     *
     * @param Unit $unit the unit to multiply by
     * @return Unit the product of this multiplied by the given unit
     */
    public function multiplyBy(Unit $unit): Unit {
        $this->ensureSupportsAlgebraicOperations($unit);
        $unit->ensureSupportsAlgebraicOperations($this);

        return $this->_multiply($unit, 1);
    }

    /**
     * Divides this unit by the given unit.
     *
     * @param Unit $unit the unit to divide by
     * @return Unit the quotient of this unit divided by the given unit
     */
    public function divideBy(Unit $unit): Unit {
        $this->ensureSupportsAlgebraicOperations($unit);
        $unit->ensureSupportsAlgebraicOperations($this);

        return $this->_multiply($unit, -1);
    }

    /**
     * Raises this unit by the given exponent.
     *
     * @param int $exp the exponent to raise this unit by
     * @return Unit the power of this unit raised by the given exponent
     */
    public function toPower(int $exp): Unit {
        if ($exp === 1) {
            return $this;
        }

        $this->ensureSupportsAlgebraicOperations($this);

        $exponents = $this->exponents;
        $dimensions = $this->dimensions;
        $factorExponents = $this->factorExponents;

        for ($i = 0; $i < count($exponents); $i++) {
            $exponents[$i] *= $exp;
        }
        for ($i = 0; $i < count($dimensions); $i++) {
            $dimensions[$i] *= $exp;
        }
        for ($i = 0; $i < count($factorExponents); $i++) {
            $factorExponents[$i] *= $exp;
        }

        return new Unit(
            parts: $this->parts,
            exponents: $exponents,
            dimensions: $dimensions,
            factors: $this->factors,
            factorExponents: $factorExponents,
            special: $this->special,
            arbitrary: $this->arbitrary,
        );
    }

    /**
     * Returns the unit atoms, including their prefixes.
     *
     * ```
     * km/h => [(prefix: k, unit: m, exponent: 1), (unit: h, exponent: -1)]
     * ```
     *
     * @return iterable<UnitAtom> unit atoms
     *
     * @experimental
     */
    public function atoms(): iterable {
        for ($i = 0; $i < count($this->parts); ++$i) {
            $p = $this->parts[$i];
            $e = $this->exponents[$i];

            yield new UnitAtom(
                prefix: $p->prefix,
                unit: $p->unit,
                exponent: $e,
            );
        }
    }

    public function __toString(): string {
        $s = '';
        for ($i = 0; $i < count($this->parts); $i++) {
            $p = $this->parts[$i];
            $e = $this->exponents[$i];

            if ($p->prefix !== null) {
                $s .= $p->prefix;
            }
            $s .= $p->unit;
            if ($e !== 1) {
                if (is_numeric($p->unit) && $e >= 0) {
                    $s .= '+';
                }
                $s .= $e;
            }
            $s .= '.';
        }

        return substr($s, 0, -1);
    }

    private function _multiply(Unit $unit, int $scale): Unit {
        $parts = $this->parts;
        $exponents = $this->exponents;
        for ($i = 0; $i < count($unit->parts); $i++) {
            $parts[] = $unit->parts[$i];
            $exponents[] = $unit->exponents[$i] * $scale;
        }

        $dimensions = $this->dimensions ?: $unit->dimensions;
        if ($this->dimensions && $unit->dimensions) {
            for ($i = 0; $i < count($dimensions); $i++) {
                $dimensions[$i] += $unit->dimensions[$i] * $scale;
            }
        }

        $factors = [];
        $factorExponents = [];
        for ($l = 0, $r = 0, $ln = count($this->factors), $rn = count($unit->factors); $l < $ln && $r < $rn;) {
            $lf = $this->factors[$l];
            $rf = $unit->factors[$r];
            $le = $this->factorExponents[$l];
            $re = $unit->factorExponents[$r] * $scale;

            $cmp = $lf <=> $rf;
            if ($cmp === 0) {
                if ($le + $re) {
                    $factors[] = $lf;
                    $factorExponents[] = $le + $re;
                }
                $l++;
                $r++;
            }
            if ($cmp < 0) {
                $factors[] = $lf;
                $factorExponents[] = $le;
                $l++;
            }
            if ($cmp > 0) {
                $factors[] = $rf;
                $factorExponents[] = $re;
                $r++;
            }
        }
        for (; $l < $ln; $l++) {
            $factors[] = $this->factors[$l];
            $factorExponents[] = $this->factorExponents[$l];
        }
        for (; $r < $rn; $r++) {
            $factors[] = $unit->factors[$r];
            $factorExponents[] = $unit->factorExponents[$r] * $scale;
        }

        return new Unit(
            parts: $parts,
            exponents: $exponents,
            dimensions: $dimensions,
            factors: $factors,
            factorExponents: $factorExponents,
            special: $this->special ?: $unit->special,
            arbitrary: $this->arbitrary ?: $unit->arbitrary,
        );
    }

    private function ensureSupportsAlgebraicOperations(Unit $other): void {
        if ($this->special && $other->dimensions) {
            throw new UnitException(sprintf('Cannot perform algebraic operations on special unit "%s" (https://ucum.org/ucum#section-Special-Units-on-non-ratio-Scales)', $this));
        }
    }

    private function ensureSupportsConversion(): void {
        if ($this->arbitrary) {
            throw new UnitException(sprintf('Cannot convert or compare arbitrary unit "%s" to any other unit (https://ucum.org/ucum#section-Arbitrary-Units)', $this));
        }
    }

    private function ensureConvertibleDimensions(Unit $unit): void {
        if ($this->dimensions !== $unit->dimensions && (!$this->dimless() || !$unit->dimless())) {
            throw new UnitException(sprintf('Cannot convert unit due to incompatible dimensions "%s" -> "%s"', $this, $unit));
        }
    }

    private function dimless(): bool {
        foreach ($this->dimensions as $dimension) {
            if ($dimension) {
                return false;
            }
        }

        return true;
    }

    private function scaleFactor(): Internal\Factor {
        if (!$this->factors) {
            static $identity = new Identity();
            return $identity;
        }

        $multiplicand = 1;
        $divisor = 1;
        for ($i = 0; $i < count($this->factors); $i++) {
            $f = $this->factors[$i];
            $e = $this->factorExponents[$i];
            match (true) {
                $e > 0 => $multiplicand *= $f ** $e,
                $e < 0 => $divisor *= $f ** -$e,
                default => assert(false),
            };
        }

        return new Scale($multiplicand, $divisor);
    }
}
