<?php

namespace Wya\PhpSpreadsheetTests\Functional;

use Wya\PhpSpreadsheet\IOFactory;
use Wya\PhpSpreadsheet\Shared\File;
use Wya\PhpSpreadsheet\Spreadsheet;
use PHPUnit\Framework\TestCase;

/**
 * Base class for functional test to write and reload file on disk across different formats.
 */
abstract class AbstractFunctional extends TestCase
{
    /**
     * Write spreadsheet to disk, reload and return it.
     *
     * @param Spreadsheet $spreadsheet
     * @param string $format
     * @param null|callable $readerCustomizer
     *
     * @return Spreadsheet
     */
    protected function writeAndReload(Spreadsheet $spreadsheet, $format, callable $readerCustomizer = null)
    {
        $filename = tempnam(File::sysGetTempDir(), 'phpspreadsheet-test');
        $writer = IOFactory::createWriter($spreadsheet, $format);
        $writer->save($filename);

        $reader = IOFactory::createReader($format);
        if ($readerCustomizer) {
            $readerCustomizer($reader);
        }
        $reloadedSpreadsheet = $reader->load($filename);
        unlink($filename);

        return $reloadedSpreadsheet;
    }
}
