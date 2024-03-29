<?php

namespace Wya\PhpSpreadsheetTests\Calculation;

use Wya\PhpSpreadsheet\Calculation\Engineering;
use Wya\PhpSpreadsheet\Calculation\Functions;
use Wya\PhpSpreadsheetTests\Custom\ComplexAssert;
use PHPUnit\Framework\TestCase;

class EngineeringTest extends TestCase
{
    /**
     * @var ComplexAssert
     */
    protected $complexAssert;

    const BESSEL_PRECISION = 1E-8;
    const COMPLEX_PRECISION = 1E-8;
    const ERF_PRECISION = 1E-12;

    public function setUp()
    {
        $this->complexAssert = new ComplexAssert();
        Functions::setCompatibilityMode(Functions::COMPATIBILITY_EXCEL);
    }

    public function tearDown()
    {
        $this->complexAssert = null;
    }

    /**
     * @dataProvider providerBESSELI
     *
     * @param mixed $expectedResult
     */
    public function testBESSELI($expectedResult, ...$args)
    {
        $result = Engineering::BESSELI(...$args);
        self::assertEquals($expectedResult, $result, null, self::BESSEL_PRECISION);
    }

    public function providerBESSELI()
    {
        return require 'data/Calculation/Engineering/BESSELI.php';
    }

    /**
     * @dataProvider providerBESSELJ
     *
     * @param mixed $expectedResult
     */
    public function testBESSELJ($expectedResult, ...$args)
    {
        $result = Engineering::BESSELJ(...$args);
        self::assertEquals($expectedResult, $result, null, self::BESSEL_PRECISION);
    }

    public function providerBESSELJ()
    {
        return require 'data/Calculation/Engineering/BESSELJ.php';
    }

    /**
     * @dataProvider providerBESSELK
     *
     * @param mixed $expectedResult
     */
    public function testBESSELK($expectedResult, ...$args)
    {
        $result = Engineering::BESSELK(...$args);
        self::assertEquals($expectedResult, $result, null, self::BESSEL_PRECISION);
    }

    public function providerBESSELK()
    {
        return require 'data/Calculation/Engineering/BESSELK.php';
    }

    /**
     * @dataProvider providerBESSELY
     *
     * @param mixed $expectedResult
     */
    public function testBESSELY($expectedResult, ...$args)
    {
        $result = Engineering::BESSELY(...$args);
        self::assertEquals($expectedResult, $result, null, self::BESSEL_PRECISION);
    }

    public function providerBESSELY()
    {
        return require 'data/Calculation/Engineering/BESSELY.php';
    }

    /**
     * @dataProvider providerCOMPLEX
     *
     * @param mixed $expectedResult
     */
    public function testParseComplex()
    {
        list($real, $imaginary, $suffix) = [1.23e-4, 5.67e+8, 'j'];

        $result = Engineering::parseComplex('1.23e-4+5.67e+8j');
        $this->assertArrayHasKey('real', $result);
        $this->assertEquals($real, $result['real']);
        $this->assertArrayHasKey('imaginary', $result);
        $this->assertEquals($imaginary, $result['imaginary']);
        $this->assertArrayHasKey('suffix', $result);
        $this->assertEquals($suffix, $result['suffix']);
    }

    /**
     * @dataProvider providerCOMPLEX
     *
     * @param mixed $expectedResult
     */
    public function testCOMPLEX($expectedResult, ...$args)
    {
        $result = Engineering::COMPLEX(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerCOMPLEX()
    {
        return require 'data/Calculation/Engineering/COMPLEX.php';
    }

    /**
     * @dataProvider providerIMAGINARY
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMAGINARY($expectedResult, $value)
    {
        $result = Engineering::IMAGINARY($value);
        self::assertEquals($expectedResult, $result, null, self::COMPLEX_PRECISION);
    }

    public function providerIMAGINARY()
    {
        return require 'data/Calculation/Engineering/IMAGINARY.php';
    }

    /**
     * @dataProvider providerIMREAL
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMREAL($expectedResult, $value)
    {
        $result = Engineering::IMREAL($value);
        self::assertEquals($expectedResult, $result, null, self::COMPLEX_PRECISION);
    }

    public function providerIMREAL()
    {
        return require 'data/Calculation/Engineering/IMREAL.php';
    }

    /**
     * @dataProvider providerIMABS
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMABS($expectedResult, $value)
    {
        $result = Engineering::IMABS($value);
        self::assertEquals($expectedResult, $result, null, self::COMPLEX_PRECISION);
    }

    public function providerIMABS()
    {
        return require 'data/Calculation/Engineering/IMABS.php';
    }

    /**
     * @dataProvider providerIMARGUMENT
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMARGUMENT($expectedResult, $value)
    {
        $result = Engineering::IMARGUMENT($value);
        self::assertEquals($expectedResult, $result, null, self::COMPLEX_PRECISION);
    }

    public function providerIMARGUMENT()
    {
        return require 'data/Calculation/Engineering/IMARGUMENT.php';
    }

    /**
     * @dataProvider providerIMCONJUGATE
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMCONJUGATE($expectedResult, $value)
    {
        $result = Engineering::IMCONJUGATE($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMCONJUGATE()
    {
        return require 'data/Calculation/Engineering/IMCONJUGATE.php';
    }

    /**
     * @dataProvider providerIMCOS
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMCOS($expectedResult, $value)
    {
        $result = Engineering::IMCOS($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMCOS()
    {
        return require 'data/Calculation/Engineering/IMCOS.php';
    }

    /**
     * @dataProvider providerIMCOSH
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMCOSH($expectedResult, $value)
    {
        $result = Engineering::IMCOSH($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMCOSH()
    {
        return require 'data/Calculation/Engineering/IMCOSH.php';
    }

    /**
     * @dataProvider providerIMCOT
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMCOT($expectedResult, $value)
    {
        $result = Engineering::IMCOT($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMCOT()
    {
        return require 'data/Calculation/Engineering/IMCOT.php';
    }

    /**
     * @dataProvider providerIMCSC
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMCSC($expectedResult, $value)
    {
        $result = Engineering::IMCSC($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMCSC()
    {
        return require 'data/Calculation/Engineering/IMCSC.php';
    }

    /**
     * @dataProvider providerIMCSCH
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMCSCH($expectedResult, $value)
    {
        $result = Engineering::IMCSCH($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMCSCH()
    {
        return require 'data/Calculation/Engineering/IMCSCH.php';
    }

    /**
     * @dataProvider providerIMSEC
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMSEC($expectedResult, $value)
    {
        $result = Engineering::IMSEC($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMSEC()
    {
        return require 'data/Calculation/Engineering/IMSEC.php';
    }

    /**
     * @dataProvider providerIMSECH
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMSECH($expectedResult, $value)
    {
        $result = Engineering::IMSECH($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMSECH()
    {
        return require 'data/Calculation/Engineering/IMSECH.php';
    }

    /**
     * @dataProvider providerIMDIV
     *
     * @param mixed $expectedResult
     */
    public function testIMDIV($expectedResult, ...$args)
    {
        $result = Engineering::IMDIV(...$args);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMDIV()
    {
        return require 'data/Calculation/Engineering/IMDIV.php';
    }

    /**
     * @dataProvider providerIMEXP
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMEXP($expectedResult, $value)
    {
        $result = Engineering::IMEXP($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMEXP()
    {
        return require 'data/Calculation/Engineering/IMEXP.php';
    }

    /**
     * @dataProvider providerIMLN
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMLN($expectedResult, $value)
    {
        $result = Engineering::IMLN($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMLN()
    {
        return require 'data/Calculation/Engineering/IMLN.php';
    }

    /**
     * @dataProvider providerIMLOG2
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMLOG2($expectedResult, $value)
    {
        $result = Engineering::IMLOG2($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMLOG2()
    {
        return require 'data/Calculation/Engineering/IMLOG2.php';
    }

    /**
     * @dataProvider providerIMLOG10
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMLOG10($expectedResult, $value)
    {
        $result = Engineering::IMLOG10($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMLOG10()
    {
        return require 'data/Calculation/Engineering/IMLOG10.php';
    }

    /**
     * @dataProvider providerIMPOWER
     *
     * @param mixed $expectedResult
     */
    public function testIMPOWER($expectedResult, ...$args)
    {
        $result = Engineering::IMPOWER(...$args);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMPOWER()
    {
        return require 'data/Calculation/Engineering/IMPOWER.php';
    }

    /**
     * @dataProvider providerIMPRODUCT
     *
     * @param mixed $expectedResult
     */
    public function testIMPRODUCT($expectedResult, ...$args)
    {
        $result = Engineering::IMPRODUCT(...$args);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMPRODUCT()
    {
        return require 'data/Calculation/Engineering/IMPRODUCT.php';
    }

    /**
     * @dataProvider providerIMSIN
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMSIN($expectedResult, $value)
    {
        $result = Engineering::IMSIN($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMSIN()
    {
        return require 'data/Calculation/Engineering/IMSIN.php';
    }

    /**
     * @dataProvider providerIMSINH
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMSINH($expectedResult, $value)
    {
        $result = Engineering::IMSINH($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMSINH()
    {
        return require 'data/Calculation/Engineering/IMSINH.php';
    }

    /**
     * @dataProvider providerIMTAN
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMTAN($expectedResult, $value)
    {
        $result = Engineering::IMTAN($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMTAN()
    {
        return require 'data/Calculation/Engineering/IMTAN.php';
    }

    /**
     * @dataProvider providerIMSQRT
     *
     * @param mixed $expectedResult
     * @param mixed $value
     */
    public function testIMSQRT($expectedResult, $value)
    {
        $result = Engineering::IMSQRT($value);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMSQRT()
    {
        return require 'data/Calculation/Engineering/IMSQRT.php';
    }

    /**
     * @dataProvider providerIMSUB
     *
     * @param mixed $expectedResult
     */
    public function testIMSUB($expectedResult, ...$args)
    {
        $result = Engineering::IMSUB(...$args);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMSUB()
    {
        return require 'data/Calculation/Engineering/IMSUB.php';
    }

    /**
     * @dataProvider providerIMSUM
     *
     * @param mixed $expectedResult
     */
    public function testIMSUM($expectedResult, ...$args)
    {
        $result = Engineering::IMSUM(...$args);
        self::assertTrue(
            $this->complexAssert->assertComplexEquals($expectedResult, $result, self::COMPLEX_PRECISION),
            $this->complexAssert->getErrorMessage()
        );
    }

    public function providerIMSUM()
    {
        return require 'data/Calculation/Engineering/IMSUM.php';
    }

    /**
     * @dataProvider providerERF
     *
     * @param mixed $expectedResult
     */
    public function testERF($expectedResult, ...$args)
    {
        $result = Engineering::ERF(...$args);
        self::assertEquals($expectedResult, $result, null, self::ERF_PRECISION);
    }

    public function providerERF()
    {
        return require 'data/Calculation/Engineering/ERF.php';
    }

    /**
     * @dataProvider providerERFPRECISE
     *
     * @param mixed $expectedResult
     */
    public function testERFPRECISE($expectedResult, ...$args)
    {
        $result = Engineering::ERFPRECISE(...$args);
        self::assertEquals($expectedResult, $result, null, self::ERF_PRECISION);
    }

    public function providerERFPRECISE()
    {
        return require 'data/Calculation/Engineering/ERFPRECISE.php';
    }

    /**
     * @dataProvider providerERFC
     *
     * @param mixed $expectedResult
     */
    public function testERFC($expectedResult, ...$args)
    {
        $result = Engineering::ERFC(...$args);
        self::assertEquals($expectedResult, $result, null, self::ERF_PRECISION);
    }

    public function providerERFC()
    {
        return require 'data/Calculation/Engineering/ERFC.php';
    }

    /**
     * @dataProvider providerBIN2DEC
     *
     * @param mixed $expectedResult
     */
    public function testBIN2DEC($expectedResult, ...$args)
    {
        $result = Engineering::BINTODEC(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerBIN2DEC()
    {
        return require 'data/Calculation/Engineering/BIN2DEC.php';
    }

    /**
     * @dataProvider providerBIN2HEX
     *
     * @param mixed $expectedResult
     */
    public function testBIN2HEX($expectedResult, ...$args)
    {
        $result = Engineering::BINTOHEX(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerBIN2HEX()
    {
        return require 'data/Calculation/Engineering/BIN2HEX.php';
    }

    /**
     * @dataProvider providerBIN2OCT
     *
     * @param mixed $expectedResult
     */
    public function testBIN2OCT($expectedResult, ...$args)
    {
        $result = Engineering::BINTOOCT(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerBIN2OCT()
    {
        return require 'data/Calculation/Engineering/BIN2OCT.php';
    }

    /**
     * @dataProvider providerDEC2BIN
     *
     * @param mixed $expectedResult
     */
    public function testDEC2BIN($expectedResult, ...$args)
    {
        $result = Engineering::DECTOBIN(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerDEC2BIN()
    {
        return require 'data/Calculation/Engineering/DEC2BIN.php';
    }

    /**
     * @dataProvider providerDEC2HEX
     *
     * @param mixed $expectedResult
     */
    public function testDEC2HEX($expectedResult, ...$args)
    {
        $result = Engineering::DECTOHEX(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerDEC2HEX()
    {
        return require 'data/Calculation/Engineering/DEC2HEX.php';
    }

    /**
     * @dataProvider providerDEC2OCT
     *
     * @param mixed $expectedResult
     */
    public function testDEC2OCT($expectedResult, ...$args)
    {
        $result = Engineering::DECTOOCT(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerDEC2OCT()
    {
        return require 'data/Calculation/Engineering/DEC2OCT.php';
    }

    /**
     * @dataProvider providerHEX2BIN
     *
     * @param mixed $expectedResult
     */
    public function testHEX2BIN($expectedResult, ...$args)
    {
        $result = Engineering::HEXTOBIN(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerHEX2BIN()
    {
        return require 'data/Calculation/Engineering/HEX2BIN.php';
    }

    /**
     * @dataProvider providerHEX2DEC
     *
     * @param mixed $expectedResult
     */
    public function testHEX2DEC($expectedResult, ...$args)
    {
        $result = Engineering::HEXTODEC(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerHEX2DEC()
    {
        return require 'data/Calculation/Engineering/HEX2DEC.php';
    }

    /**
     * @dataProvider providerHEX2OCT
     *
     * @param mixed $expectedResult
     */
    public function testHEX2OCT($expectedResult, ...$args)
    {
        $result = Engineering::HEXTOOCT(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerHEX2OCT()
    {
        return require 'data/Calculation/Engineering/HEX2OCT.php';
    }

    /**
     * @dataProvider providerOCT2BIN
     *
     * @param mixed $expectedResult
     */
    public function testOCT2BIN($expectedResult, ...$args)
    {
        $result = Engineering::OCTTOBIN(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerOCT2BIN()
    {
        return require 'data/Calculation/Engineering/OCT2BIN.php';
    }

    /**
     * @dataProvider providerOCT2DEC
     *
     * @param mixed $expectedResult
     */
    public function testOCT2DEC($expectedResult, ...$args)
    {
        $result = Engineering::OCTTODEC(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerOCT2DEC()
    {
        return require 'data/Calculation/Engineering/OCT2DEC.php';
    }

    /**
     * @dataProvider providerOCT2HEX
     *
     * @param mixed $expectedResult
     */
    public function testOCT2HEX($expectedResult, ...$args)
    {
        $result = Engineering::OCTTOHEX(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerOCT2HEX()
    {
        return require 'data/Calculation/Engineering/OCT2HEX.php';
    }

    /**
     * @dataProvider providerBITAND
     *
     * @param mixed $expectedResult
     * @param mixed[] $args
     */
    public function testBITAND($expectedResult, array $args)
    {
        $result = Engineering::BITAND(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerBITAND()
    {
        return require 'data/Calculation/Engineering/BITAND.php';
    }

    /**
     * @dataProvider providerBITOR
     *
     * @param mixed $expectedResult
     * @param mixed[] $args
     */
    public function testBITOR($expectedResult, array $args)
    {
        $result = Engineering::BITOR(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerBITOR()
    {
        return require 'data/Calculation/Engineering/BITOR.php';
    }

    /**
     * @dataProvider providerBITXOR
     *
     * @param mixed $expectedResult
     * @param mixed[] $args
     */
    public function testBITXOR($expectedResult, array $args)
    {
        $result = Engineering::BITXOR(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerBITXOR()
    {
        return require 'data/Calculation/Engineering/BITXOR.php';
    }

    /**
     * @dataProvider providerBITLSHIFT
     *
     * @param mixed $expectedResult
     * @param mixed[] $args
     */
    public function testBITLSHIFT($expectedResult, array $args)
    {
        $result = Engineering::BITLSHIFT(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerBITLSHIFT()
    {
        return require 'data/Calculation/Engineering/BITLSHIFT.php';
    }

    /**
     * @dataProvider providerBITRSHIFT
     *
     * @param mixed $expectedResult
     * @param mixed[] $args
     */
    public function testBITRSHIFT($expectedResult, array $args)
    {
        $result = Engineering::BITRSHIFT(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerBITRSHIFT()
    {
        return require 'data/Calculation/Engineering/BITRSHIFT.php';
    }

    /**
     * @dataProvider providerDELTA
     *
     * @param mixed $expectedResult
     */
    public function testDELTA($expectedResult, ...$args)
    {
        $result = Engineering::DELTA(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerDELTA()
    {
        return require 'data/Calculation/Engineering/DELTA.php';
    }

    /**
     * @dataProvider providerGESTEP
     *
     * @param mixed $expectedResult
     */
    public function testGESTEP($expectedResult, ...$args)
    {
        $result = Engineering::GESTEP(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerGESTEP()
    {
        return require 'data/Calculation/Engineering/GESTEP.php';
    }

    public function testGetConversionGroups()
    {
        $result = Engineering::getConversionGroups();
        self::assertInternalType('array', $result);
    }

    public function testGetConversionGroupUnits()
    {
        $result = Engineering::getConversionGroupUnits();
        self::assertInternalType('array', $result);
    }

    public function testGetConversionGroupUnitDetails()
    {
        $result = Engineering::getConversionGroupUnitDetails();
        self::assertInternalType('array', $result);
    }

    public function testGetConversionMultipliers()
    {
        $result = Engineering::getConversionMultipliers();
        self::assertInternalType('array', $result);
    }

    /**
     * @dataProvider providerCONVERTUOM
     *
     * @param mixed $expectedResult
     */
    public function testCONVERTUOM($expectedResult, ...$args)
    {
        $result = Engineering::CONVERTUOM(...$args);
        self::assertEquals($expectedResult, $result, null);
    }

    public function providerCONVERTUOM()
    {
        return require 'data/Calculation/Engineering/CONVERTUOM.php';
    }
}
