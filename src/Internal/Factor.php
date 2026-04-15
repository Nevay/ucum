<?php declare(strict_types=1);
namespace Nevay\Ucum\Internal;

interface Factor extends \Nevay\Ucum\Factor {

    public function equals(Factor $other): bool;

    public function __toString(): string;
}
