<?php

use Wya\PhpSpreadsheet\IOFactory;
use Wya\PhpSpreadsheet\Writer\Xlsx;

require __DIR__ . '/../Header.php';

// Create temporary file that will be read
$sampleSpreadsheet = require __DIR__ . '/../templates/sampleSpreadsheet.php';
$filename = $helper->getTemporaryFilename();
$writer = new Xlsx($sampleSpreadsheet);
$writer->save($filename);

$callStartTime = microtime(true);
$spreadsheet = IOFactory::load($filename);
$helper->logRead('Xlsx', $filename, $callStartTime);

// Save
$helper->write($spreadsheet, __FILE__);
