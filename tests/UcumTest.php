<?php declare(strict_types=1);
namespace Nevay\Ucum;

use Nevay\Ucum\Internal\Factor\Identity;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class UcumTest extends TestCase {

    #[Test]
    public function convertFunctionFactor(): void {
        $this->assertSame(283.15, Unit::convert('[degF]', 'K')->apply(50));
        $this->assertSame(50, Unit::convert('Cel', '[degF]')->apply(10));
        $this->assertSame(68, Unit::convert('Cel', '[degF]')->apply(20));
        $this->assertSame(29.6, Unit::convert('Cel', '[degRe]')->apply(37));
        $this->assertSame(80, Unit::convert('Cel', '[degRe]')->apply(100));

        $this->assertEqualsWithDelta(0.04995839572, Unit::convert('%[slope]', 'deg')->apply(5), 1e-10);
        $this->assertEqualsWithDelta(0.57293869768, Unit::convert('[p\'diop]', 'deg')->apply(1), 1e-10);
        $this->assertSame(0.001, Unit::convert('[pH]', 'mol/l')->apply(3));
        $this->assertSame(10, Unit::convert('dB', '1')->apply(10));
        $this->assertSame(100, Unit::convert('dB', '1')->apply(20));
        $this->assertSame(100, Unit::convert('B[V]', 'V')->apply(4));
        $this->assertSame(1000, Unit::convert('B[V]', 'V')->apply(6));
        $this->assertSame(100, Unit::convert('[m/s2/Hz^(1/2)]', 'm2/s3')->apply(10));
        $this->assertSame(225, Unit::convert('[m/s2/Hz^(1/2)]', 'm2/s3')->apply(15));
    }

    #[Test]
    public function unitToString(): void {
        $this->assertSame('km.h-1', (string) Unit::parse('km/h'));
        $this->assertSame('g.kg-1', (string) Unit::parse('g{ann}/kg'));
    }

    #[Test]
    public function conversionToString(): void {
        $this->assertSame('1000', (string) Unit::convert('km', 'm'));
        $this->assertSame('0.001', (string) Unit::convert('g{ann}', 'kg'));
    }

    #[Test]
    public function algebraicOperationsDivideBy(): void {
        $kmh = Unit::parse('km')->divideBy(Unit::parse('h'));

        $this->assertSame('km.h-1', (string) $kmh);
        $this->assertInstanceOf(Identity::class, $kmh->convertTo(Unit::parse('km/h')));
    }

    #[Test]
    public function specialUnitsDoNotSupportAlgebraicOperations(): void {
        $cel = Unit::parse('Cel');
        $m = Unit::parse('m');

        $this->expectException(UnitException::class);

        $cel->multiplyBy($m);
    }

    #[Test]
    public function specialUnitsAreScalable(): void {
        $cel = Unit::parse('Cel');
        $five = Unit::parse('5');

        $this->assertSame('Cel.5', (string) $cel->multiplyBy($five));
    }

    #[Test]
    public function arbitraryUnitsAreNotConvertible(): void {
        $arb = Unit::parse('[arb\'U]');
        $dimless = Unit::parse('1');

        $this->expectException(UnitException::class);

        $arb->convertTo($dimless);
    }
}
