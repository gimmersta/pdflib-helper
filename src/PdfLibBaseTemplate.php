<?php

namespace Gimmersta\PdfLibHelper;

use Illuminate\Support\Facades\Storage;

/**
 * Class PdfLibBaseTemplate
 *
 * @package RebelWalls\PdfLibHelper
 *
 * @property string $pageWidth
 * @property string $pageHeight
 * @property string $pageSettings
 * @property float $scale
 */
abstract class PdfLibBaseTemplate extends PdfLibHelper
{
    public string $pageWidth = 'a4.width';
    public string $pageHeight = 'a4.height';
    public string $pageSettings = 'topdown=true userunit=mm';
    public float $scale = 2.83464567;

    public string $documentCreator = 'Rebel Walls - PdfLib Helper';
    public string $documentTitle = 'Document Title';

    /**
     * PdfBaseTemplate constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->initialize();
    }

    protected abstract function generate();

    private function initialize()
    {
        if (config('pdflib-helper.license-key')) {
            $this->pdf->set_option('license=' . config('pdflib-helper.license-key'));
        }

        $this->pdf->set_option('errorpolicy=exception');
        $this->pdf->set_option('stringformat=' . config('pdflib-helper.string-format'));
        $this->pdf->set_option('SearchPath={{' . config('pdflib-helper.resource-path') . '}}');

        if (isset($this->defaultLineHeight)) {
            $this->pos->setDefaultLineHeight($this->defaultLineHeight);
        }

        $this->text->initFonts($this->defaultFont, $this->additionalFonts, $this->defaultFontSize);
    }

    protected function beginDocument() {
        if ($this->pdf->begin_document('', '') === 0) {
            die("Error: " . $this->pdf->get_errmsg());
        }

        $this->pdf->set_info("Creator", $this->documentCreator);
        $this->pdf->set_info("Title", $this->documentTitle);
    }

    public function endDocument()
    {
        for ($pageNumber = 1; $pageNumber <= $this->pageCount; $pageNumber++) {
            $this->pdf->resume_page('pagenumber ' . $pageNumber);
            $this->pdf->end_page_ext('');
        }

        $this->pdf->end_document('');

        return $this;
    }

    protected function beginPage()
    {
        $this->pageCount++;
        $this->pdf->begin_page_ext(0,0, "width={$this->pageWidth} height={$this->pageHeight} {$this->pageSettings}");
        $this->pdf->scale($this->scale, $this->scale);
    }

    protected function suspendPage()
    {
        $this->pdf->suspend_page('');
    }

    protected function endPage()
    {
        $this->pdf->end_page_ext('');
    }

    protected function newPage()
    {
        $this->beginPage();
        $this->pos->moveToTop();
        $this->pos->moveToFarLeft();
    }

    /**
     * Returns the file content string
     *
     * @return string
     */
    public function getFileContent()
    {
        return $this->pdf->get_buffer();
    }

    /**
     * Outputs the file to the browser, including headers
     *
     * @param string $fileName
     */
    public function writeOutput(string $fileName)
    {
        $buffer = $this->pdf->get_buffer();
        $bufferLength = strlen($buffer);

        header("Content-type: application/pdf");
        header("Content-Length: $bufferLength");
        header("Content-Disposition: inline; filename=" . $fileName);

        print $buffer;
    }

    /**
     * Writes the file to a specific filename in the public storage
     *
     * @param string $fileName
     */
    public function writeFile(string $fileName, $path = null)
    {
        // @todo: Implement $path

        $fileContent = $this->pdf->get_buffer();

        Storage::disk('public')->put($fileName, $fileContent);
    }
}
