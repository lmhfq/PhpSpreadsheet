<?php

namespace Wya\PhpSpreadsheet\Writer;

use Wya\PhpSpreadsheet\Spreadsheet;

interface IWriter
{
    /**
     * IWriter constructor.
     *
     * @param Spreadsheet $spreadsheet
     */
    public function __construct(Spreadsheet $spreadsheet);

    /**
     * Save PhpSpreadsheet to file.
     *
     * @param string $pFilename Name of the file to save
     *
     * @throws \Wya\PhpSpreadsheet\Writer\Exception
     */
    public function save($pFilename);
}
