<?php

namespace Wya\PhpSpreadsheetTests\Functional;

use Wya\PhpSpreadsheet\Spreadsheet;

class TypeAttributePreservationTest extends AbstractFunctional
{
    public function providerFormulae()
    {
        $formats = ['Xlsx'];
        $data = require 'data/Functional/TypeAttributePreservation/Formula.php';

        $result = [];
        foreach ($formats as $f) {
            foreach ($data as $d) {
                $result[] = [$f, $d];
            }
        }

        return $result;
    }

    /**
     * Ensure saved spreadsheets maintain the correct data type.
     *
     * @dataProvider providerFormulae
     *
     * @param string $format
     * @param array $values
     */
    public function testFormulae($format, array $values)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($values);

        $reloadedSpreadsheet = $this->writeAndReload($spreadsheet, $format);
        $reloadedSheet = $reloadedSpreadsheet->getActiveSheet();

        $expected = $sheet->getCell('A1')->getCalculatedValue();

        if ($sheet->getCell('A1')->getDataType() === 'f') {
            $actual = $reloadedSheet->getCell('A1')->getOldCalculatedValue();
        } else {
            $actual = $reloadedSheet->getCell('A1')->getValue();
        }

        self::assertSame($expected, $actual);
    }
}
