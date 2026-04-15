<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal\Factor;

use Nevay\Ucum\Internal\Factor;
use function log10;

final class LgTimes2 implements Factor {

    public function apply(float|int $value): float|int {
        return 10 ** ($value / 2);
    }

    public function applyInverse(float|int $value): float|int {
        return 2 * log10($value);
    }

    public function equals(Factor $other): bool {
        return $other instanceof LgTimes2;
    }

    public function __toString(): string {
        return '2lg';
    }
}
