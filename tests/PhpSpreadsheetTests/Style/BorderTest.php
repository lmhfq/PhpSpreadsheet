<?php

namespace Wya\PhpSpreadsheetTests\Style;

use Wya\PhpSpreadsheet\Spreadsheet;
use Wya\PhpSpreadsheet\Style\Border;
use PHPUnit\Framework\TestCase;

class BorderTest extends TestCase
{
    public function testCase()
    {
        $spreadsheet = new Spreadsheet();
        $borders = $spreadsheet->getActiveSheet()->getStyle('A1')->getBorders();
        $allBorders = $borders->getAllBorders();
        $bottom = $borders->getBottom();

        $actual = $bottom->getBorderStyle();
        self::assertSame(Border::BORDER_NONE, $actual, 'should default to none');

        $allBorders->setBorderStyle(Border::BORDER_THIN);

        $actual = $bottom->getBorderStyle();
        self::assertSame(Border::BORDER_THIN, $actual, 'should have been set via allBorders');
    }
}
