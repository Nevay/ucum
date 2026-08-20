<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal;

use Nevay\Ucum\Unit;

interface Vocabulary {

    public function resolvePrefixedUnit(string $prefixedAtom): ?Unit;

    public function resolveUnit(string $atom): ?Unit;
}
