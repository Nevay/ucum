<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal\Factor;

use Nevay\Ucum\Internal\Factor;
use function sqrt;

final class Sqrt implements Factor {

    public function apply(float|int $value): float|int {
        return $value ** 2;
    }

    public function applyInverse(float|int $value): float|int {
        return sqrt($value);
    }

    public function equals(Factor $other): bool {
        return $other instanceof Sqrt;
    }

    public function __toString(): string {
        return 'sqrt';
    }
}
