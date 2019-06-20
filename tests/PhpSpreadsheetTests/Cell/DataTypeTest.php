<?php

namespace Wya\PhpSpreadsheetTests\Cell;

use Wya\PhpSpreadsheet\Cell\DataType;
use PHPUnit\Framework\TestCase;

class DataTypeTest extends TestCase
{
    public function testGetErrorCodes()
    {
        $result = DataType::getErrorCodes();
        self::assertInternalType('array', $result);
        self::assertGreaterThan(0, count($result));
        self::assertArrayHasKey('#NULL!', $result);
    }
}
