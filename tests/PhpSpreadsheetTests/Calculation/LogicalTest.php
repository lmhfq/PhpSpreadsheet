<?php

namespace Wya\PhpSpreadsheetTests\Calculation;

use Wya\PhpSpreadsheet\Calculation\Functions;
use Wya\PhpSpreadsheet\Calculation\Logical;
use PHPUnit\Framework\TestCase;

class LogicalTest extends TestCase
{
    public function setUp()
    {
        Functions::setCompatibilityMode(Functions::COMPATIBILITY_EXCEL);
    }

    public function testTRUE()
    {
        $result = Logical::TRUE();
        self::assertTrue($result);
    }

    public function testFALSE()
    {
        $result = Logical::FALSE();
        self::assertFalse($result);
    }

    /**
     * @dataProvider providerAND
     *
     * @param mixed $expectedResult
     */
    public function testAND($expectedResult, ...$args)
    {
        $result = Logical::logicalAnd(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerAND()
    {
        return require 'data/Calculation/Logical/AND.php';
    }

    /**
     * @dataProvider providerOR
     *
     * @param mixed $expectedResult
     */
    public function testOR($expectedResult, ...$args)
    {
        $result = Logical::logicalOr(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerOR()
    {
        return require 'data/Calculation/Logical/OR.php';
    }

    /**
     * @dataProvider providerXOR
     *
     * @param mixed $expectedResult
     */
    public function testXOR($expectedResult, ...$args)
    {
        $result = Logical::logicalXor(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerXOR()
    {
        return require 'data/Calculation/Logical/XOR.php';
    }

    /**
     * @dataProvider providerNOT
     *
     * @param mixed $expectedResult
     */
    public function testNOT($expectedResult, ...$args)
    {
        $result = Logical::NOT(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerNOT()
    {
        return require 'data/Calculation/Logical/NOT.php';
    }

    /**
     * @dataProvider providerIF
     *
     * @param mixed $expectedResult
     */
    public function testIF($expectedResult, ...$args)
    {
        $result = Logical::statementIf(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerIF()
    {
        return require 'data/Calculation/Logical/IF.php';
    }

    /**
     * @dataProvider providerIFERROR
     *
     * @param mixed $expectedResult
     */
    public function testIFERROR($expectedResult, ...$args)
    {
        $result = Logical::IFERROR(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerIFERROR()
    {
        return require 'data/Calculation/Logical/IFERROR.php';
    }

    /**
     * @dataProvider providerSwitch
     *
     * @param mixed $expectedResult
     */
    public function testSWITCH($expectedResult, ...$args)
    {
        $result = Logical::statementSwitch(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerSwitch()
    {
        return require 'data/Calculation/Logical/SWITCH.php';
    }
}
