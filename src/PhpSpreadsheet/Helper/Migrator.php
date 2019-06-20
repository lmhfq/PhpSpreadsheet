<?php

namespace Wya\PhpSpreadsheet\Helper;

class Migrator
{
    /**
     * @var string[]
     */
    private $from;

    /**
     * @var string[]
     */
    private $to;

    public function __construct()
    {
        $this->from = array_keys($this->getMapping());
        $this->to = array_values($this->getMapping());
    }

    /**
     * Return the ordered mapping from old PHPExcel class names to new PhpSpreadsheet one.
     *
     * @return string[]
     */
    public function getMapping()
    {
        // Order matters here, we should have the deepest namespaces first (the most "unique" strings)
        $classes = [
            'PHPExcel_Shared_Escher_DggContainer_BstoreContainer_BSE_Blip' => \Wya\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer\BSE\Blip::class,
            'PHPExcel_Shared_Escher_DgContainer_SpgrContainer_SpContainer' => \Wya\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer\SpContainer::class,
            'PHPExcel_Shared_Escher_DggContainer_BstoreContainer_BSE' => \Wya\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer\BSE::class,
            'PHPExcel_Shared_Escher_DgContainer_SpgrContainer' => \Wya\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer::class,
            'PHPExcel_Shared_Escher_DggContainer_BstoreContainer' => \Wya\PhpSpreadsheet\Shared\Escher\DggContainer\BstoreContainer::class,
            'PHPExcel_Shared_OLE_PPS_File' => \Wya\PhpSpreadsheet\Shared\OLE\PPS\File::class,
            'PHPExcel_Shared_OLE_PPS_Root' => \Wya\PhpSpreadsheet\Shared\OLE\PPS\Root::class,
            'PHPExcel_Worksheet_AutoFilter_Column_Rule' => \Wya\PhpSpreadsheet\Worksheet\AutoFilter\Column\Rule::class,
            'PHPExcel_Writer_OpenDocument_Cell_Comment' => \Wya\PhpSpreadsheet\Writer\Ods\Cell\Comment::class,
            'PHPExcel_Calculation_Token_Stack' => \Wya\PhpSpreadsheet\Calculation\Token\Stack::class,
            'PHPExcel_Chart_Renderer_jpgraph' => \Wya\PhpSpreadsheet\Chart\Renderer\JpGraph::class,
            'PHPExcel_Reader_Excel5_Escher' => \Wya\PhpSpreadsheet\Reader\Xls\Escher::class,
            'PHPExcel_Reader_Excel5_MD5' => \Wya\PhpSpreadsheet\Reader\Xls\MD5::class,
            'PHPExcel_Reader_Excel5_RC4' => \Wya\PhpSpreadsheet\Reader\Xls\RC4::class,
            'PHPExcel_Reader_Excel2007_Chart' => \Wya\PhpSpreadsheet\Reader\Xlsx\Chart::class,
            'PHPExcel_Reader_Excel2007_Theme' => \Wya\PhpSpreadsheet\Reader\Xlsx\Theme::class,
            'PHPExcel_Shared_Escher_DgContainer' => \Wya\PhpSpreadsheet\Shared\Escher\DgContainer::class,
            'PHPExcel_Shared_Escher_DggContainer' => \Wya\PhpSpreadsheet\Shared\Escher\DggContainer::class,
            'CholeskyDecomposition' => \Wya\PhpSpreadsheet\Shared\JAMA\CholeskyDecomposition::class,
            'EigenvalueDecomposition' => \Wya\PhpSpreadsheet\Shared\JAMA\EigenvalueDecomposition::class,
            'PHPExcel_Shared_JAMA_LUDecomposition' => \Wya\PhpSpreadsheet\Shared\JAMA\LUDecomposition::class,
            'PHPExcel_Shared_JAMA_Matrix' => \Wya\PhpSpreadsheet\Shared\JAMA\Matrix::class,
            'QRDecomposition' => \Wya\PhpSpreadsheet\Shared\JAMA\QRDecomposition::class,
            'PHPExcel_Shared_JAMA_QRDecomposition' => \Wya\PhpSpreadsheet\Shared\JAMA\QRDecomposition::class,
            'SingularValueDecomposition' => \Wya\PhpSpreadsheet\Shared\JAMA\SingularValueDecomposition::class,
            'PHPExcel_Shared_OLE_ChainedBlockStream' => \Wya\PhpSpreadsheet\Shared\OLE\ChainedBlockStream::class,
            'PHPExcel_Shared_OLE_PPS' => \Wya\PhpSpreadsheet\Shared\OLE\PPS::class,
            'PHPExcel_Best_Fit' => \Wya\PhpSpreadsheet\Shared\Trend\BestFit::class,
            'PHPExcel_Exponential_Best_Fit' => \Wya\PhpSpreadsheet\Shared\Trend\ExponentialBestFit::class,
            'PHPExcel_Linear_Best_Fit' => \Wya\PhpSpreadsheet\Shared\Trend\LinearBestFit::class,
            'PHPExcel_Logarithmic_Best_Fit' => \Wya\PhpSpreadsheet\Shared\Trend\LogarithmicBestFit::class,
            'polynomialBestFit' => \Wya\PhpSpreadsheet\Shared\Trend\PolynomialBestFit::class,
            'PHPExcel_Polynomial_Best_Fit' => \Wya\PhpSpreadsheet\Shared\Trend\PolynomialBestFit::class,
            'powerBestFit' => \Wya\PhpSpreadsheet\Shared\Trend\PowerBestFit::class,
            'PHPExcel_Power_Best_Fit' => \Wya\PhpSpreadsheet\Shared\Trend\PowerBestFit::class,
            'trendClass' => \Wya\PhpSpreadsheet\Shared\Trend\Trend::class,
            'PHPExcel_Worksheet_AutoFilter_Column' => \Wya\PhpSpreadsheet\Worksheet\AutoFilter\Column::class,
            'PHPExcel_Worksheet_Drawing_Shadow' => \Wya\PhpSpreadsheet\Worksheet\Drawing\Shadow::class,
            'PHPExcel_Writer_OpenDocument_Content' => \Wya\PhpSpreadsheet\Writer\Ods\Content::class,
            'PHPExcel_Writer_OpenDocument_Meta' => \Wya\PhpSpreadsheet\Writer\Ods\Meta::class,
            'PHPExcel_Writer_OpenDocument_MetaInf' => \Wya\PhpSpreadsheet\Writer\Ods\MetaInf::class,
            'PHPExcel_Writer_OpenDocument_Mimetype' => \Wya\PhpSpreadsheet\Writer\Ods\Mimetype::class,
            'PHPExcel_Writer_OpenDocument_Settings' => \Wya\PhpSpreadsheet\Writer\Ods\Settings::class,
            'PHPExcel_Writer_OpenDocument_Styles' => \Wya\PhpSpreadsheet\Writer\Ods\Styles::class,
            'PHPExcel_Writer_OpenDocument_Thumbnails' => \Wya\PhpSpreadsheet\Writer\Ods\Thumbnails::class,
            'PHPExcel_Writer_OpenDocument_WriterPart' => \Wya\PhpSpreadsheet\Writer\Ods\WriterPart::class,
            'PHPExcel_Writer_PDF_Core' => \Wya\PhpSpreadsheet\Writer\Pdf::class,
            'PHPExcel_Writer_PDF_DomPDF' => \Wya\PhpSpreadsheet\Writer\Pdf\Dompdf::class,
            'PHPExcel_Writer_PDF_mPDF' => \Wya\PhpSpreadsheet\Writer\Pdf\Mpdf::class,
            'PHPExcel_Writer_PDF_tcPDF' => \Wya\PhpSpreadsheet\Writer\Pdf\Tcpdf::class,
            'PHPExcel_Writer_Excel5_BIFFwriter' => \Wya\PhpSpreadsheet\Writer\Xls\BIFFwriter::class,
            'PHPExcel_Writer_Excel5_Escher' => \Wya\PhpSpreadsheet\Writer\Xls\Escher::class,
            'PHPExcel_Writer_Excel5_Font' => \Wya\PhpSpreadsheet\Writer\Xls\Font::class,
            'PHPExcel_Writer_Excel5_Parser' => \Wya\PhpSpreadsheet\Writer\Xls\Parser::class,
            'PHPExcel_Writer_Excel5_Workbook' => \Wya\PhpSpreadsheet\Writer\Xls\Workbook::class,
            'PHPExcel_Writer_Excel5_Worksheet' => \Wya\PhpSpreadsheet\Writer\Xls\Worksheet::class,
            'PHPExcel_Writer_Excel5_Xf' => \Wya\PhpSpreadsheet\Writer\Xls\Xf::class,
            'PHPExcel_Writer_Excel2007_Chart' => \Wya\PhpSpreadsheet\Writer\Xlsx\Chart::class,
            'PHPExcel_Writer_Excel2007_Comments' => \Wya\PhpSpreadsheet\Writer\Xlsx\Comments::class,
            'PHPExcel_Writer_Excel2007_ContentTypes' => \Wya\PhpSpreadsheet\Writer\Xlsx\ContentTypes::class,
            'PHPExcel_Writer_Excel2007_DocProps' => \Wya\PhpSpreadsheet\Writer\Xlsx\DocProps::class,
            'PHPExcel_Writer_Excel2007_Drawing' => \Wya\PhpSpreadsheet\Writer\Xlsx\Drawing::class,
            'PHPExcel_Writer_Excel2007_Rels' => \Wya\PhpSpreadsheet\Writer\Xlsx\Rels::class,
            'PHPExcel_Writer_Excel2007_RelsRibbon' => \Wya\PhpSpreadsheet\Writer\Xlsx\RelsRibbon::class,
            'PHPExcel_Writer_Excel2007_RelsVBA' => \Wya\PhpSpreadsheet\Writer\Xlsx\RelsVBA::class,
            'PHPExcel_Writer_Excel2007_StringTable' => \Wya\PhpSpreadsheet\Writer\Xlsx\StringTable::class,
            'PHPExcel_Writer_Excel2007_Style' => \Wya\PhpSpreadsheet\Writer\Xlsx\Style::class,
            'PHPExcel_Writer_Excel2007_Theme' => \Wya\PhpSpreadsheet\Writer\Xlsx\Theme::class,
            'PHPExcel_Writer_Excel2007_Workbook' => \Wya\PhpSpreadsheet\Writer\Xlsx\Workbook::class,
            'PHPExcel_Writer_Excel2007_Worksheet' => \Wya\PhpSpreadsheet\Writer\Xlsx\Worksheet::class,
            'PHPExcel_Writer_Excel2007_WriterPart' => \Wya\PhpSpreadsheet\Writer\Xlsx\WriterPart::class,
            'PHPExcel_CachedObjectStorage_CacheBase' => \Wya\PhpSpreadsheet\Collection\Cells::class,
            'PHPExcel_CalcEngine_CyclicReferenceStack' => \Wya\PhpSpreadsheet\Calculation\Engine\CyclicReferenceStack::class,
            'PHPExcel_CalcEngine_Logger' => \Wya\PhpSpreadsheet\Calculation\Engine\Logger::class,
            'PHPExcel_Calculation_Functions' => \Wya\PhpSpreadsheet\Calculation\Functions::class,
            'PHPExcel_Calculation_Function' => \Wya\PhpSpreadsheet\Calculation\Category::class,
            'PHPExcel_Calculation_Database' => \Wya\PhpSpreadsheet\Calculation\Database::class,
            'PHPExcel_Calculation_DateTime' => \Wya\PhpSpreadsheet\Calculation\DateTime::class,
            'PHPExcel_Calculation_Engineering' => \Wya\PhpSpreadsheet\Calculation\Engineering::class,
            'PHPExcel_Calculation_Exception' => \Wya\PhpSpreadsheet\Calculation\Exception::class,
            'PHPExcel_Calculation_ExceptionHandler' => \Wya\PhpSpreadsheet\Calculation\ExceptionHandler::class,
            'PHPExcel_Calculation_Financial' => \Wya\PhpSpreadsheet\Calculation\Financial::class,
            'PHPExcel_Calculation_FormulaParser' => \Wya\PhpSpreadsheet\Calculation\FormulaParser::class,
            'PHPExcel_Calculation_FormulaToken' => \Wya\PhpSpreadsheet\Calculation\FormulaToken::class,
            'PHPExcel_Calculation_Logical' => \Wya\PhpSpreadsheet\Calculation\Logical::class,
            'PHPExcel_Calculation_LookupRef' => \Wya\PhpSpreadsheet\Calculation\LookupRef::class,
            'PHPExcel_Calculation_MathTrig' => \Wya\PhpSpreadsheet\Calculation\MathTrig::class,
            'PHPExcel_Calculation_Statistical' => \Wya\PhpSpreadsheet\Calculation\Statistical::class,
            'PHPExcel_Calculation_TextData' => \Wya\PhpSpreadsheet\Calculation\TextData::class,
            'PHPExcel_Cell_AdvancedValueBinder' => \Wya\PhpSpreadsheet\Cell\AdvancedValueBinder::class,
            'PHPExcel_Cell_DataType' => \Wya\PhpSpreadsheet\Cell\DataType::class,
            'PHPExcel_Cell_DataValidation' => \Wya\PhpSpreadsheet\Cell\DataValidation::class,
            'PHPExcel_Cell_DefaultValueBinder' => \Wya\PhpSpreadsheet\Cell\DefaultValueBinder::class,
            'PHPExcel_Cell_Hyperlink' => \Wya\PhpSpreadsheet\Cell\Hyperlink::class,
            'PHPExcel_Cell_IValueBinder' => \Wya\PhpSpreadsheet\Cell\IValueBinder::class,
            'PHPExcel_Chart_Axis' => \Wya\PhpSpreadsheet\Chart\Axis::class,
            'PHPExcel_Chart_DataSeries' => \Wya\PhpSpreadsheet\Chart\DataSeries::class,
            'PHPExcel_Chart_DataSeriesValues' => \Wya\PhpSpreadsheet\Chart\DataSeriesValues::class,
            'PHPExcel_Chart_Exception' => \Wya\PhpSpreadsheet\Chart\Exception::class,
            'PHPExcel_Chart_GridLines' => \Wya\PhpSpreadsheet\Chart\GridLines::class,
            'PHPExcel_Chart_Layout' => \Wya\PhpSpreadsheet\Chart\Layout::class,
            'PHPExcel_Chart_Legend' => \Wya\PhpSpreadsheet\Chart\Legend::class,
            'PHPExcel_Chart_PlotArea' => \Wya\PhpSpreadsheet\Chart\PlotArea::class,
            'PHPExcel_Properties' => \Wya\PhpSpreadsheet\Chart\Properties::class,
            'PHPExcel_Chart_Title' => \Wya\PhpSpreadsheet\Chart\Title::class,
            'PHPExcel_DocumentProperties' => \Wya\PhpSpreadsheet\Document\Properties::class,
            'PHPExcel_DocumentSecurity' => \Wya\PhpSpreadsheet\Document\Security::class,
            'PHPExcel_Helper_HTML' => \Wya\PhpSpreadsheet\Helper\Html::class,
            'PHPExcel_Reader_Abstract' => \Wya\PhpSpreadsheet\Reader\BaseReader::class,
            'PHPExcel_Reader_CSV' => \Wya\PhpSpreadsheet\Reader\Csv::class,
            'PHPExcel_Reader_DefaultReadFilter' => \Wya\PhpSpreadsheet\Reader\DefaultReadFilter::class,
            'PHPExcel_Reader_Excel2003XML' => \Wya\PhpSpreadsheet\Reader\Xml::class,
            'PHPExcel_Reader_Exception' => \Wya\PhpSpreadsheet\Reader\Exception::class,
            'PHPExcel_Reader_Gnumeric' => \Wya\PhpSpreadsheet\Reader\Gnumeric::class,
            'PHPExcel_Reader_HTML' => \Wya\PhpSpreadsheet\Reader\Html::class,
            'PHPExcel_Reader_IReadFilter' => \Wya\PhpSpreadsheet\Reader\IReadFilter::class,
            'PHPExcel_Reader_IReader' => \Wya\PhpSpreadsheet\Reader\IReader::class,
            'PHPExcel_Reader_OOCalc' => \Wya\PhpSpreadsheet\Reader\Ods::class,
            'PHPExcel_Reader_SYLK' => \Wya\PhpSpreadsheet\Reader\Slk::class,
            'PHPExcel_Reader_Excel5' => \Wya\PhpSpreadsheet\Reader\Xls::class,
            'PHPExcel_Reader_Excel2007' => \Wya\PhpSpreadsheet\Reader\Xlsx::class,
            'PHPExcel_RichText_ITextElement' => \Wya\PhpSpreadsheet\RichText\ITextElement::class,
            'PHPExcel_RichText_Run' => \Wya\PhpSpreadsheet\RichText\Run::class,
            'PHPExcel_RichText_TextElement' => \Wya\PhpSpreadsheet\RichText\TextElement::class,
            'PHPExcel_Shared_CodePage' => \Wya\PhpSpreadsheet\Shared\CodePage::class,
            'PHPExcel_Shared_Date' => \Wya\PhpSpreadsheet\Shared\Date::class,
            'PHPExcel_Shared_Drawing' => \Wya\PhpSpreadsheet\Shared\Drawing::class,
            'PHPExcel_Shared_Escher' => \Wya\PhpSpreadsheet\Shared\Escher::class,
            'PHPExcel_Shared_File' => \Wya\PhpSpreadsheet\Shared\File::class,
            'PHPExcel_Shared_Font' => \Wya\PhpSpreadsheet\Shared\Font::class,
            'PHPExcel_Shared_OLE' => \Wya\PhpSpreadsheet\Shared\OLE::class,
            'PHPExcel_Shared_OLERead' => \Wya\PhpSpreadsheet\Shared\OLERead::class,
            'PHPExcel_Shared_PasswordHasher' => \Wya\PhpSpreadsheet\Shared\PasswordHasher::class,
            'PHPExcel_Shared_String' => \Wya\PhpSpreadsheet\Shared\StringHelper::class,
            'PHPExcel_Shared_TimeZone' => \Wya\PhpSpreadsheet\Shared\TimeZone::class,
            'PHPExcel_Shared_XMLWriter' => \Wya\PhpSpreadsheet\Shared\XMLWriter::class,
            'PHPExcel_Shared_Excel5' => \Wya\PhpSpreadsheet\Shared\Xls::class,
            'PHPExcel_Style_Alignment' => \Wya\PhpSpreadsheet\Style\Alignment::class,
            'PHPExcel_Style_Border' => \Wya\PhpSpreadsheet\Style\Border::class,
            'PHPExcel_Style_Borders' => \Wya\PhpSpreadsheet\Style\Borders::class,
            'PHPExcel_Style_Color' => \Wya\PhpSpreadsheet\Style\Color::class,
            'PHPExcel_Style_Conditional' => \Wya\PhpSpreadsheet\Style\Conditional::class,
            'PHPExcel_Style_Fill' => \Wya\PhpSpreadsheet\Style\Fill::class,
            'PHPExcel_Style_Font' => \Wya\PhpSpreadsheet\Style\Font::class,
            'PHPExcel_Style_NumberFormat' => \Wya\PhpSpreadsheet\Style\NumberFormat::class,
            'PHPExcel_Style_Protection' => \Wya\PhpSpreadsheet\Style\Protection::class,
            'PHPExcel_Style_Supervisor' => \Wya\PhpSpreadsheet\Style\Supervisor::class,
            'PHPExcel_Worksheet_AutoFilter' => \Wya\PhpSpreadsheet\Worksheet\AutoFilter::class,
            'PHPExcel_Worksheet_BaseDrawing' => \Wya\PhpSpreadsheet\Worksheet\BaseDrawing::class,
            'PHPExcel_Worksheet_CellIterator' => \Wya\PhpSpreadsheet\Worksheet\CellIterator::class,
            'PHPExcel_Worksheet_Column' => \Wya\PhpSpreadsheet\Worksheet\Column::class,
            'PHPExcel_Worksheet_ColumnCellIterator' => \Wya\PhpSpreadsheet\Worksheet\ColumnCellIterator::class,
            'PHPExcel_Worksheet_ColumnDimension' => \Wya\PhpSpreadsheet\Worksheet\ColumnDimension::class,
            'PHPExcel_Worksheet_ColumnIterator' => \Wya\PhpSpreadsheet\Worksheet\ColumnIterator::class,
            'PHPExcel_Worksheet_Drawing' => \Wya\PhpSpreadsheet\Worksheet\Drawing::class,
            'PHPExcel_Worksheet_HeaderFooter' => \Wya\PhpSpreadsheet\Worksheet\HeaderFooter::class,
            'PHPExcel_Worksheet_HeaderFooterDrawing' => \Wya\PhpSpreadsheet\Worksheet\HeaderFooterDrawing::class,
            'PHPExcel_WorksheetIterator' => \Wya\PhpSpreadsheet\Worksheet\Iterator::class,
            'PHPExcel_Worksheet_MemoryDrawing' => \Wya\PhpSpreadsheet\Worksheet\MemoryDrawing::class,
            'PHPExcel_Worksheet_PageMargins' => \Wya\PhpSpreadsheet\Worksheet\PageMargins::class,
            'PHPExcel_Worksheet_PageSetup' => \Wya\PhpSpreadsheet\Worksheet\PageSetup::class,
            'PHPExcel_Worksheet_Protection' => \Wya\PhpSpreadsheet\Worksheet\Protection::class,
            'PHPExcel_Worksheet_Row' => \Wya\PhpSpreadsheet\Worksheet\Row::class,
            'PHPExcel_Worksheet_RowCellIterator' => \Wya\PhpSpreadsheet\Worksheet\RowCellIterator::class,
            'PHPExcel_Worksheet_RowDimension' => \Wya\PhpSpreadsheet\Worksheet\RowDimension::class,
            'PHPExcel_Worksheet_RowIterator' => \Wya\PhpSpreadsheet\Worksheet\RowIterator::class,
            'PHPExcel_Worksheet_SheetView' => \Wya\PhpSpreadsheet\Worksheet\SheetView::class,
            'PHPExcel_Writer_Abstract' => \Wya\PhpSpreadsheet\Writer\BaseWriter::class,
            'PHPExcel_Writer_CSV' => \Wya\PhpSpreadsheet\Writer\Csv::class,
            'PHPExcel_Writer_Exception' => \Wya\PhpSpreadsheet\Writer\Exception::class,
            'PHPExcel_Writer_HTML' => \Wya\PhpSpreadsheet\Writer\Html::class,
            'PHPExcel_Writer_IWriter' => \Wya\PhpSpreadsheet\Writer\IWriter::class,
            'PHPExcel_Writer_OpenDocument' => \Wya\PhpSpreadsheet\Writer\Ods::class,
            'PHPExcel_Writer_PDF' => \Wya\PhpSpreadsheet\Writer\Pdf::class,
            'PHPExcel_Writer_Excel5' => \Wya\PhpSpreadsheet\Writer\Xls::class,
            'PHPExcel_Writer_Excel2007' => \Wya\PhpSpreadsheet\Writer\Xlsx::class,
            'PHPExcel_CachedObjectStorageFactory' => \Wya\PhpSpreadsheet\Collection\CellsFactory::class,
            'PHPExcel_Calculation' => \Wya\PhpSpreadsheet\Calculation\Calculation::class,
            'PHPExcel_Cell' => \Wya\PhpSpreadsheet\Cell\Cell::class,
            'PHPExcel_Chart' => \Wya\PhpSpreadsheet\Chart\Chart::class,
            'PHPExcel_Comment' => \Wya\PhpSpreadsheet\Comment::class,
            'PHPExcel_Exception' => \Wya\PhpSpreadsheet\Exception::class,
            'PHPExcel_HashTable' => \Wya\PhpSpreadsheet\HashTable::class,
            'PHPExcel_IComparable' => \Wya\PhpSpreadsheet\IComparable::class,
            'PHPExcel_IOFactory' => \Wya\PhpSpreadsheet\IOFactory::class,
            'PHPExcel_NamedRange' => \Wya\PhpSpreadsheet\NamedRange::class,
            'PHPExcel_ReferenceHelper' => \Wya\PhpSpreadsheet\ReferenceHelper::class,
            'PHPExcel_RichText' => \Wya\PhpSpreadsheet\RichText\RichText::class,
            'PHPExcel_Settings' => \Wya\PhpSpreadsheet\Settings::class,
            'PHPExcel_Style' => \Wya\PhpSpreadsheet\Style\Style::class,
            'PHPExcel_Worksheet' => \Wya\PhpSpreadsheet\Worksheet\Worksheet::class,
        ];

        $methods = [
            'MINUTEOFHOUR' => 'MINUTE',
            'SECONDOFMINUTE' => 'SECOND',
            'DAYOFWEEK' => 'WEEKDAY',
            'WEEKOFYEAR' => 'WEEKNUM',
            'ExcelToPHPObject' => 'excelToDateTimeObject',
            'ExcelToPHP' => 'excelToTimestamp',
            'FormattedPHPToExcel' => 'formattedPHPToExcel',
            'Cell::absoluteCoordinate' => 'Coordinate::absoluteCoordinate',
            'Cell::absoluteReference' => 'Coordinate::absoluteReference',
            'Cell::buildRange' => 'Coordinate::buildRange',
            'Cell::columnIndexFromString' => 'Coordinate::columnIndexFromString',
            'Cell::coordinateFromString' => 'Coordinate::coordinateFromString',
            'Cell::extractAllCellReferencesInRange' => 'Coordinate::extractAllCellReferencesInRange',
            'Cell::getRangeBoundaries' => 'Coordinate::getRangeBoundaries',
            'Cell::mergeRangesInCollection' => 'Coordinate::mergeRangesInCollection',
            'Cell::rangeBoundaries' => 'Coordinate::rangeBoundaries',
            'Cell::rangeDimension' => 'Coordinate::rangeDimension',
            'Cell::splitRange' => 'Coordinate::splitRange',
            'Cell::stringFromColumnIndex' => 'Coordinate::stringFromColumnIndex',
        ];

        // Keep '\' prefix for class names
        $prefixedClasses = [];
        foreach ($classes as $key => &$value) {
            $value = str_replace('Wya\\', '\\Wya\\', $value);
            $prefixedClasses['\\' . $key] = $value;
        }
        $mapping = $prefixedClasses + $classes + $methods;

        return $mapping;
    }

    /**
     * Search in all files in given directory.
     *
     * @param string $path
     */
    private function recursiveReplace($path)
    {
        $patterns = [
            '/*.md',
            '/*.txt',
            '/*.TXT',
            '/*.php',
            '/*.phpt',
            '/*.php3',
            '/*.php4',
            '/*.php5',
            '/*.phtml',
        ];

        foreach ($patterns as $pattern) {
            foreach (glob($path . $pattern) as $file) {
                if (strpos($path, '/vendor/') !== false) {
                    echo $file . " skipped\n";

                    continue;
                }
                $original = file_get_contents($file);
                $converted = $this->replace($original);

                if ($original !== $converted) {
                    echo $file . " converted\n";
                    file_put_contents($file, $converted);
                }
            }
        }

        // Do the recursion in subdirectory
        foreach (glob($path . '/*', GLOB_ONLYDIR) as $subpath) {
            if (strpos($subpath, $path . '/') === 0) {
                $this->recursiveReplace($subpath);
            }
        }
    }

    public function migrate()
    {
        $path = realpath(getcwd());
        echo 'This will search and replace recursively in ' . $path . PHP_EOL;
        echo 'You MUST backup your files first, or you risk losing data.' . PHP_EOL;
        echo 'Are you sure ? (y/n)';

        $confirm = fread(STDIN, 1);
        if ($confirm === 'y') {
            $this->recursiveReplace($path);
        }
    }

    /**
     * Migrate the given code from PHPExcel to PhpSpreadsheet.
     *
     * @param string $original
     *
     * @return string
     */
    public function replace($original)
    {
        $converted = str_replace($this->from, $this->to, $original);

        // The string "PHPExcel" gets special treatment because of how common it might be.
        // This regex requires a word boundary around the string, and it can't be
        // preceded by $ or -> (goal is to filter out cases where a variable is named $PHPExcel or similar)
        $converted = preg_replace('~(?<!\$|->)(\b|\\\\)PHPExcel\b~', '\\' . \Wya\PhpSpreadsheet\Spreadsheet::class, $converted);

        return $converted;
    }
}
