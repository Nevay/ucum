<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal\Factor;

use Nevay\Ucum\Internal\Factor;
use function atan;
use function tan;

final class TanTimes100 implements Factor {

    public function apply(float|int $value): float|int {
        return atan($value / 100);
    }

    public function applyInverse(float|int $value): float|int {
        return tan(100) * $value;
    }

    public function equals(Factor $other): bool {
        return $other instanceof TanTimes100;
    }

    public function __toString(): string {
        return '100tan';
    }
}
