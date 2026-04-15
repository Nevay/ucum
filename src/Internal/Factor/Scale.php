<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal\Factor;

use Nevay\Ucum\Internal\Factor;

final class Scale implements Factor {

    public function __construct(
        private readonly float|int $multiplicand,
        private readonly float|int $divisor,
    ) {}

    public function apply(float|int $value): float|int {
        return $value * $this->multiplicand / $this->divisor;
    }

    public function applyInverse(float|int $value): float|int {
        return $value * $this->divisor / $this->multiplicand;
    }

    public function equals(Factor $other): bool {
        return $other instanceof Scale
            && $other->multiplicand === $this->multiplicand
            && $other->divisor === $this->divisor;
    }

    public function __toString(): string {
        return (string) $this->apply(1);
    }
}
