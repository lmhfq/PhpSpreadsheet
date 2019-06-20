<?php

namespace Wya\PhpSpreadsheetTests\Shared;

use Wya\PhpSpreadsheet\Shared\PasswordHasher;
use PHPUnit\Framework\TestCase;

class PasswordHasherTest extends TestCase
{
    /**
     * @dataProvider providerHashPassword
     *
     * @param mixed $expectedResult
     */
    public function testHashPassword($expectedResult, ...$args)
    {
        $result = PasswordHasher::hashPassword(...$args);
        self::assertEquals($expectedResult, $result);
    }

    public function providerHashPassword()
    {
        return require 'data/Shared/PasswordHashes.php';
    }
}
