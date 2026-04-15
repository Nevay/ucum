<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal\Factor;

use Nevay\Ucum\Internal\Factor;

final class Identity implements Factor {

    public function apply(float|int $value): float|int {
        return $value;
    }

    public function applyInverse(float|int $value): float|int {
        return $value;
    }

    public function equals(Factor $other): bool {
        return $other instanceof Identity;
    }

    public function __toString(): string {
        return '1';
    }
}
