<?php

namespace Wya\PhpSpreadsheetTests\Writer\Xlsx;

use Exception;
use Wya\PhpSpreadsheet\Settings;
use Wya\PhpSpreadsheet\Shared\File;
use PHPUnit\Framework\TestCase;
use ZipArchive;

class UnparsedDataTest extends TestCase
{
    /**
     * Test load and save Xlsx file with unparsed data (form elements, protected sheets, alternate contents, printer settings,..).
     */
    public function testLoadSaveXlsxWithUnparsedData()
    {
        $sampleFilename = './data/Writer/XLSX/form_pass_print.xlsm';
        $resultFilename = tempnam(File::sysGetTempDir(), 'phpspreadsheet-test');
        Settings::setLibXmlLoaderOptions(null); // reset to default options
        $reader = new \Wya\PhpSpreadsheet\Reader\Xlsx();
        $excel = $reader->load($sampleFilename);

        $excel->getSheet(1)->setCellValue('B1', '222');

        $writer = new \Wya\PhpSpreadsheet\Writer\Xlsx($excel);
        $writer->save($resultFilename);
        self::assertFileExists($resultFilename);

        $resultZip = new ZipArchive();
        $resultZip->open($resultFilename);
        $resultContentTypesRaw = $resultZip->getFromName('[Content_Types].xml');
        $resultControlPropRaw = $resultZip->getFromName('xl/ctrlProps/ctrlProp1.xml');
        $resultDrawingRaw = $resultZip->getFromName('xl/drawings/drawing1.xml');
        $resultVmlDrawingRaw = $resultZip->getFromName('xl/drawings/vmlDrawing1.vml');
        $resultPrinterSettingsRaw = $resultZip->getFromName('xl/printerSettings/printerSettings1.bin');
        $resultVbaProjectRaw = $resultZip->getFromName('xl/vbaProject.bin');
        $resultWorkbookRaw = $resultZip->getFromName('xl/workbook.xml');
        $resultSheet1RelsRaw = $resultZip->getFromName('xl/worksheets/_rels/sheet1.xml.rels');
        $resultSheet1Raw = $resultZip->getFromName('xl/worksheets/sheet1.xml');
        $resultSheet2Raw = $resultZip->getFromName('xl/worksheets/sheet2.xml');
        if (false === $resultZip->close()) {
            throw new Exception("Could not close zip file \"{$resultFilename}\".");
        }
        unlink($resultFilename);

        // [Content_Types].xml
        $this->assertContains('application/vnd.openxmlformats-officedocument.spreadsheetml.printerSettings', $resultContentTypesRaw, 'Content type for printerSettings not found!');
        $this->assertContains('application/vnd.ms-office.vbaProject', $resultContentTypesRaw, 'Content type for VbaProject not found!');
        $this->assertContains('application/vnd.ms-excel.controlproperties+xml', $resultContentTypesRaw, 'Content type for ctrlProp not found!');

        // xl/ctrlProps/ctrlProp1.xml
        $this->assertNotEmpty($resultControlPropRaw, 'ctrlProp not found!');

        // xl/drawings/drawing1.xml
        $this->assertContains('<mc:AlternateContent', $resultDrawingRaw, 'AlternateContent at drawing.xml not found!');

        // xl/drawings/vmlDrawing1.vml
        $this->assertNotEmpty($resultVmlDrawingRaw, 'vmlDrawing not found!');

        // xl/printerSettings/printerSettings1.bin
        $this->assertNotEmpty($resultPrinterSettingsRaw, 'printerSettings.bin not found!');

        // xl/vbaProject.bin
        $this->assertNotEmpty($resultVbaProjectRaw, 'vbaProject.bin not found!');

        // xl/workbook.xml
        $xmlWorkbook = simplexml_load_string($resultWorkbookRaw, 'SimpleXMLElement', Settings::getLibXmlLoaderOptions());
        if (!$xmlWorkbook->workbookProtection) {
            $this->fail('workbook.xml/workbookProtection not found!');
        } else {
            $this->assertEquals($xmlWorkbook->workbookProtection['workbookPassword'], 'CBEB', 'workbook.xml/workbookProtection[workbookPassword] is wrong!');
            $this->assertEquals($xmlWorkbook->workbookProtection['lockStructure'], 'true', 'workbook.xml/workbookProtection[lockStructure] is wrong!');

            $this->assertEquals($xmlWorkbook->sheets->sheet[0]['state'], '', 'workbook.xml/sheets/sheet[0][state] is wrong!');
            $this->assertEquals($xmlWorkbook->sheets->sheet[1]['state'], 'hidden', 'workbook.xml/sheets/sheet[1][state] is wrong!');
        }
        unset($xmlWorkbook);

        // xl/worksheets/_rels/sheet1.xml.rels
        $this->assertContains('http://schemas.openxmlformats.org/officeDocument/2006/relationships/printerSettings', $resultSheet1RelsRaw, 'Sheet relation with printerSettings not found!');
        $this->assertContains('http://schemas.openxmlformats.org/officeDocument/2006/relationships/vmlDrawing', $resultSheet1RelsRaw, 'Sheet relation with vmlDrawing not found!');
        $this->assertContains('http://schemas.openxmlformats.org/officeDocument/2006/relationships/ctrlProp', $resultSheet1RelsRaw, 'Sheet relation with ctrlProp not found!');

        // xl/worksheets/sheet1.xml
        $this->assertContains('<mc:AlternateContent', $resultSheet1Raw, 'AlternateContent at sheet1.xml not found!');
        $xmlWorksheet = simplexml_load_string($resultSheet1Raw, 'SimpleXMLElement', Settings::getLibXmlLoaderOptions());
        $pageSetupAttributes = $xmlWorksheet->pageSetup->attributes('http://schemas.openxmlformats.org/officeDocument/2006/relationships');
        $this->assertNotEmpty($pageSetupAttributes['id'], 'sheet1.xml/pageSetup[r:id] not found!');
        if (!$xmlWorksheet->sheetProtection) {
            $this->fail('sheet1.xml/sheetProtection not found!');
        } else {
            $this->assertEquals($xmlWorksheet->sheetProtection['password'], 'CBEB', 'sheet1.xml/sheetProtection[password] is wrong!');
            $this->assertEquals($xmlWorksheet->sheetProtection['sheet'], 'true', 'sheet1.xml/sheetProtection[sheet] is wrong!');
            $this->assertEquals($xmlWorksheet->sheetProtection['objects'], 'true', 'sheet1.xml/sheetProtection[objects] is wrong!');
            $this->assertEquals($xmlWorksheet->sheetProtection['scenarios'], 'true', 'sheet1.xml/sheetProtection[scenarios] is wrong!');
        }
        unset($xmlWorksheet);

        // xl/worksheets/sheet2.xml
        $this->assertNotEmpty($resultSheet2Raw, 'sheet2.xml not found!');
    }
}
