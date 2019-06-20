<?php

use Wya\PhpSpreadsheet\Cell\Cell;
use Wya\PhpSpreadsheet\Cell\StringValueBinder;
use Wya\PhpSpreadsheet\IOFactory;

require __DIR__ . '/../Header.php';

Cell::setValueBinder(new StringValueBinder());

$inputFileType = 'Csv';
$inputFileName = __DIR__ . '/sampleData/longIntegers.csv';

$reader = IOFactory::createReader($inputFileType);
$helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' into WorkSheet #1 using IOFactory with a defined reader type of ' . $inputFileType);

$spreadsheet = $reader->load($inputFileName);
$spreadsheet->getActiveSheet()->setTitle(pathinfo($inputFileName, PATHINFO_BASENAME));

$helper->log($spreadsheet->getSheetCount() . ' worksheet' . (($spreadsheet->getSheetCount() == 1) ? '' : 's') . ' loaded');
$loadedSheetNames = $spreadsheet->getSheetNames();
foreach ($loadedSheetNames as $sheetIndex => $loadedSheetName) {
    $helper->log('<b>Worksheet #' . $sheetIndex . ' -> ' . $loadedSheetName . ' (Formatted)</b>');
    $spreadsheet->setActiveSheetIndexByName($loadedSheetName);
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    var_dump($sheetData);
}
