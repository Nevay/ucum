<?php declare(strict_types=1);
namespace Nevay\Ucum;

use DOMDocument;
use DOMXPath;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function in_array;

final class UcumFunctionalTest extends TestCase {

    private const UcumFunctionalTests = 'https://raw.githubusercontent.com/FHIR/Ucum-java/refs/heads/master/src/test/resources/UcumFunctionalTests.xml';

    #[Test, DataProvider('validationCasesValid')]
    public function parseValid(string $unit): void {
        $parsed = Unit::parse($unit);
        $reparsed = Unit::parse((string) $parsed);

        $this->assertSame((string) $parsed, (string) $reparsed);
    }

    #[Test, DataProvider('validationCasesInvalid')]
    public function parseInvalid(string $unit): void {
        $this->expectException(UnitException::class);

        Unit::parse($unit);
    }

    #[Test, DataProvider('conversionCases')]
    public function convert(string $from, string $to, int|float $value, int|float $expected): void {
        $this->assertSame($expected, Unit::convert($from, $to)->apply($value));
    }

    public static function validationCasesValid(): iterable {
        $document = new DOMDocument();
        $document->load(self::UcumFunctionalTests);
        $xpath = new DOMXPath($document);

        $skip = [
        ];

        $i = -1;
        foreach ($xpath->query('/ucumTests/validation/case[@valid="true"]') as $case) {
            $id = $xpath->evaluate('string(./@id)', $case);
            $unit = $xpath->evaluate('string(./@unit)', $case);

            if (in_array([$id, $unit], $skip, true)) {
                continue;
            }

            yield ++$i . ' - ' . $id => [$unit];
        }
    }

    public static function validationCasesInvalid(): iterable {
        $document = new DOMDocument();
        $document->load(self::UcumFunctionalTests);
        $xpath = new DOMXPath($document);

        $skip = [
            ['1-108', '10+3/ul'],
            ['1-115a', 'rad2{錠}'],
            ['1-118', '{|}1'],
        ];

        $i = -1;
        foreach ($xpath->query('/ucumTests/validation/case[@valid="false"]') as $case) {
            $id = $xpath->evaluate('string(./@id)', $case);
            $unit = $xpath->evaluate('string(./@unit)', $case);

            if (in_array([$id, $unit], $skip, true)) {
                continue;
            }

            yield ++$i . ' - ' . $id => [$unit];
        }
    }

    public static function conversionCases(): iterable {
        $document = new DOMDocument();
        $document->load(self::UcumFunctionalTests);
        $xpath = new DOMXPath($document);

        $skip = [
            ['3-113', '6.3', '4.s/m', 's/m', '25'], // precision, result: 25.2 (see 3-114)
            ['3-115', '6.3', 's/4/m', 's/m', '1.6'], // precision, result: 1.575
            ['3-118', '6.30', '[in_i]', 'm', '0.160'], // precision, result: 0.16002
            ['3-119', '6.300', '[in_i]', 'cm', '16.0'], // precision, result: 16.002
            ['3-128', '1', '1/[ly]', 'cm-1', '1.05700083402461546370946e-18'], // precision, result: 1.0570008340246153E-18
        ];

        $i = -1;
        foreach ($xpath->query('/ucumTests/conversion/case') as $case) {
            $id = $xpath->evaluate('string(./@id)', $case);
            $value = $xpath->evaluate('string(./@value)', $case);
            $srcUnit = $xpath->evaluate('string(./@srcUnit)', $case);
            $dstUnit = $xpath->evaluate('string(./@dstUnit)', $case);
            $outcome = $xpath->evaluate('string(./@outcome)', $case);

            if (in_array([$id, $value, $srcUnit, $dstUnit, $outcome], $skip, true)) {
                continue;
            }

            yield ++$i . ' - ' . $id => [$srcUnit, $dstUnit, (float) $value, (float) $outcome];
        }
    }
}
