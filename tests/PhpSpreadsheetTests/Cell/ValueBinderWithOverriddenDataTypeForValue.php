<?php

namespace Wya\PhpSpreadsheetTests\Cell;

use Wya\PhpSpreadsheet\Cell\DefaultValueBinder;

class ValueBinderWithOverriddenDataTypeForValue extends DefaultValueBinder
{
    public static $called = false;

    public static function dataTypeForValue($pValue)
    {
        self::$called = true;

        return parent::dataTypeForValue($pValue);
    }
}
