<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal;

use Antlr\Antlr4\Runtime\Tree\AbstractParseTreeVisitor;
use Nevay\Ucum\Internal\Grammar\Context;
use Nevay\Ucum\Unit;
use function assert;
use function is_int;

/**
 * @extends AbstractParseTreeVisitor<Unit>
 */
final class Visitor extends AbstractParseTreeVisitor implements Grammar\UcumVisitor {

    public function __construct(
        private readonly Vocabulary $vocabulary,
    ) {}

    public function visitUnit(Context\UnitContext $context): Unit {
        return $this->visitUcumExpr($context->ucumExpr());
    }

    public function visitUcumExpr(Context\UcumExprContext $context): Unit {
        $unit = $this->visitExpr($context->expr());
        if ($context->DIVIDE()) {
            $unit = $unit->toPower(-1);
        }

        return $unit;
    }

    public function visitMultiply(Context\MultiplyContext $context): Unit {
        $unit = $this->visitTerm($context->term());
        if ($context->DIVIDE()) {
            $unit = $unit->toPower(-1);
        }

        return $unit;
    }

    public function visitExpr(Context\ExprContext $context): Unit {
        $unit = $this->visitTerm($context->term());

        foreach ($context->multiply() as $multiply) {
            $unit = $unit->multiplyBy($this->visitMultiply($multiply));
        }

        return $unit;
    }

    public function visitTerm(Context\TermContext $context): Unit {
        $unit = $this->visitElement($context->element());

        if ($context->exponent()) {
            $unit = $unit->toPower($this->visitExponent($context->exponent()));
        }

        return $unit;
    }

    public function visitElement(Context\ElementContext $context): Unit {
        if ($context->simpleUnit()) {
            return $this->visitSimpleUnit($context->simpleUnit());
        }
        if ($context->expr()) {
            return $this->visitExpr($context->expr());
        }
        if ($context->ANN()) {
            return new Unit([new Part('1')], [1], [], [], []);
        }

        assert(false);
    }

    public function visitSimpleUnit(Context\SimpleUnitContext $context): Unit {
        if ($context->prefixedAtom) {
            return $this->vocabulary->resolvePrefixedUnit($context->prefixedAtom->getText());
        }
        if ($context->atom) {
            return $this->vocabulary->resolveUnit($context->atom->getText());
        }
        if ($context->digits) {
            $digits = $context->digits->getText();

            $value = +$digits;
            $factors = [];
            $factorExponents = [];
            if ($value > 3 && is_int($value)) {
                foreach ([2, 3, 5, 7, 11, 13, 23, 29, 31, 37] as $prime) {
                    if (($value % $prime) !== 0) {
                        continue;
                    }

                    $e = 0;
                    do {
                        $value /= $prime;
                        $e++;
                    } while (($value % $prime) === 0);

                    $factors[] = $prime;
                    $factorExponents[] = $e;

                    if ($value === 1) {
                        break;
                    }
                }
            }

            if ($value !== 1) {
                $factors[] = $value;
                $factorExponents[] = 1;
            }

            return new Unit([new Part($digits)], [1], [], $factors, $factorExponents);
        }

        assert(false);
    }

    public function visitExponent(Context\ExponentContext $context): int {
        return (int) $context->getText();
    }
}
