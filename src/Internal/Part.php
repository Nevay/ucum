<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal;

final class Part {

    public function __construct(
        public readonly string $unit,
        public readonly ?string $prefix = null,
    ) {}
}
