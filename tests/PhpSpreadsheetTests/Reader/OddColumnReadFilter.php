<?php

namespace Wya\PhpSpreadsheetTests\Reader;

use Wya\PhpSpreadsheet\Reader\IReadFilter;

/**
 * Show only cells from odd columns.
 */
class OddColumnReadFilter implements IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        return (\ord(\substr($column, -1, 1)) % 2) === 1;
    }
}
