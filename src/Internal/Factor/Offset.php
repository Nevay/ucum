<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal\Factor;

use Nevay\Ucum\Internal\Factor;

final class Offset implements Factor {

    public function __construct(
        private readonly int|float $offset,
    ) {}

    public function apply(float|int $value): float|int {
        return $value + $this->offset;
    }

    public function applyInverse(float|int $value): float|int {
        return $value - $this->offset;
    }

    public function equals(Factor $other): bool {
        return $other instanceof Offset
            && $other->offset === $this->offset;
    }

    public function __toString(): string {
        $s = 'offset(';
        $s .= $this->offset;
        $s .= ')';

        return $s;
    }
}
