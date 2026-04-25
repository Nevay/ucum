<?php declare(strict_types=1);
namespace Nevay\Ucum;

/**
 * @experimental
 */
final class UnitAtom {

    public function __construct(
        public readonly ?string $prefix,
        public readonly string $unit,
        public readonly int $exponent,
    ) {}
}
