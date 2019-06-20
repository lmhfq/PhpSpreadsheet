<?php

namespace Wya\PhpSpreadsheetTests\Helper;

use Wya\PhpSpreadsheet\Helper\Migrator;
use PHPUnit\Framework\TestCase;

class MigratorTest extends TestCase
{
    public function testMappingOnlyContainExistingClasses()
    {
        $migrator = new Migrator();

        foreach ($migrator->getMapping() as $classname) {
            if (substr_count($classname, '\\')) {
                self::assertTrue(class_exists($classname) || interface_exists($classname), 'mapping is wrong, class does not exists in project: ' . $classname);
            }
        }
    }

    public function testReplace()
    {
        $input = <<<'STRING'
<?php

namespace Foo;

use PHPExcel;
use PHPExcel_Worksheet;

class Bar
{
    /**
     * @param PHPExcel $workbook
     * @param PHPExcel_Worksheet $sheet
     *
     * @return string
     */
    public function baz(PHPExcel $workbook, PHPExcel_Worksheet $sheet)
    {
        PHPExcel::class;
        \PHPExcel::class;
        $PHPExcel->do();
        $fooobjPHPExcel->do();
        $objPHPExcel->do();
        $this->objPHPExcel->do();
        $this->PHPExcel->do();

        return \PHPExcel_Cell::stringFromColumnIndex(9);
    }
}
STRING;

        $expected = <<<'STRING'
<?php

namespace Foo;

use \Wya\PhpSpreadsheet\Spreadsheet;
use \Wya\PhpSpreadsheet\Worksheet\Worksheet;

class Bar
{
    /**
     * @param \Wya\PhpSpreadsheet\Spreadsheet $workbook
     * @param \Wya\PhpSpreadsheet\Worksheet\Worksheet $sheet
     *
     * @return string
     */
    public function baz(\Wya\PhpSpreadsheet\Spreadsheet $workbook, \Wya\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        \Wya\PhpSpreadsheet\Spreadsheet::class;
        \Wya\PhpSpreadsheet\Spreadsheet::class;
        $PHPExcel->do();
        $fooobjPHPExcel->do();
        $objPHPExcel->do();
        $this->objPHPExcel->do();
        $this->PHPExcel->do();

        return \Wya\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(9);
    }
}
STRING;

        $migrator = new Migrator();
        self::assertSame($expected, $migrator->replace($input));
    }
}
