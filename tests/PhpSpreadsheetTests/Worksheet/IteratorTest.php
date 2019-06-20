<?php

namespace Wya\PhpSpreadsheetTests\Worksheet;

use Wya\PhpSpreadsheet\Spreadsheet;
use Wya\PhpSpreadsheet\Worksheet\Iterator;
use Wya\PhpSpreadsheet\Worksheet\Worksheet;
use PHPUnit\Framework\TestCase;

class IteratorTest extends TestCase
{
    public function testIteratorFullRange()
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->createSheet();
        $spreadsheet->createSheet();

        $iterator = new Iterator($spreadsheet);
        $columnIndexResult = 0;
        self::assertEquals($columnIndexResult, $iterator->key());

        foreach ($iterator as $key => $column) {
            self::assertEquals($columnIndexResult++, $key);
            self::assertInstanceOf(Worksheet::class, $column);
        }
        self::assertSame(3, $columnIndexResult);
    }
}
