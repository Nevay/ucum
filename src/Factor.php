<?php declare(strict_types=1);
namespace Nevay\Ucum;

interface Factor {

    /**
     * Applies this conversion factor to the given value.
     *
     * @param float|int $value the value to convert
     * @return float|int the converted value
     */
    public function apply(float|int $value): float|int;

    /**
     * Applies this conversion factor to the given value.
     *
     * @param float|int $value the converted value
     * @return float|int the original value
     */
    public function applyInverse(float|int $value): float|int;
}
