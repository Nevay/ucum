<?php declare(strict_types=1);
namespace Nevay\Ucum;

enum Variant {

    /**
     * The case-sensitive variant uses `c/s` UCUM codes.
     */
    case CaseSensitive;
    /**
     * The case-insensitive variant uses `c/i` UCUM codes.
     */
    case CaseInsensitive;
}
