<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal\Factor;

use Nevay\Ucum\Internal\Factor;
use function count;
use function substr;

final class Composite implements Factor {

    /**
     * @param list<Factor> $factors
     * @param list<Factor> $factorsInverse
     */
    public function __construct(
        private readonly array $factors,
        private readonly array $factorsInverse,
    ) {}

    public function apply(float|int $value): float|int {
        for ($i = 0; $i < count($this->factors); $i++) {
            $value = $this->factors[$i]->apply($value);
        }
        for ($i = count($this->factorsInverse); --$i >= 0;) {
            $value = $this->factorsInverse[$i]->applyInverse($value);
        }

        return $value;
    }

    public function applyInverse(float|int $value): float|int {
        for ($i = 0; $i < count($this->factorsInverse); $i++) {
            $value = $this->factorsInverse[$i]->apply($value);
        }
        for ($i = count($this->factors); --$i >= 0;) {
            $value = $this->factors[$i]->applyInverse($value);
        }

        return $value;
    }

    public function equals(Factor $other): bool {
        if (!$other instanceof Composite) {
            return false;
        }

        if (count($this->factors) !== count($other->factors)) {
            return false;
        }
        if (count($this->factorsInverse) !== count($other->factorsInverse)) {
            return false;
        }

        for ($i = 0; $i < count($this->factors); $i++) {
            if (!$this->factors[$i]->equals($other->factors[$i])) {
                return false;
            }
        }
        for ($i = 0; $i < count($this->factorsInverse); $i++) {
            if (!$this->factorsInverse[$i]->equals($other->factorsInverse[$i])) {
                return false;
            }
        }

        return true;
    }

    public function __toString(): string {
        $s = '';
        for ($i = 0; $i < count($this->factors); $i++) {
            $s .= $this->factors[$i];
            $s .= ' ';
        }
        for ($i = count($this->factorsInverse); --$i >= 0;) {
            $s .= '~';
            $s .= $this->factorsInverse[$i];
            $s .= ' ';
        }

        return substr($s, 0, -1);
    }
}
