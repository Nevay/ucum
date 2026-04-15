<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal\Factor;

use Nevay\Ucum\Internal\Factor;
use function log;

final class NLog implements Factor {

    public function __construct(
        private readonly int|float $base,
    ) {}

    public function apply(float|int $value): float|int {
        return $this->base ** -$value;
    }

    public function applyInverse(float|int $value): float|int {
        return -log($value, $this->base);
    }

    public function equals(Factor $other): bool {
        return $other instanceof NLog
            && $other->base === $this->base;
    }

    public function __toString(): string {
        $s = '-log';
        $s .= $this->base;

        return $s;
    }
}
