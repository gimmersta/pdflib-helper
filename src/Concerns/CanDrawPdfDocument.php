<?php

namespace Gimmersta\PdfLibHelper\Concerns;

use Gimmersta\PdfLibHelper\Assets\PdfDocument;

trait CanDrawPdfDocument
{
    /**
     * @param PdfDocument $document
     */
    public function drawPdfDocument(PdfDocument $document): void
    {
        $pdfFile = $this->loadPdf($document->file);

        $this->pdf->fit_pdi_page($pdfFile, $this->pos->x, $this->pos->y, "orientate={$document->orientate} scale={$document->scale}");

        $this->pdf->close_pdi_page($pdfFile);
    }

    /**
     * @param string $file
     *
     * @return mixed
     */
    private function loadPdf(string $file)
    {
        $inFile = $this->pdf->open_pdi_document($file, '');
        $pdfContent = $this->pdf->open_pdi_page($inFile, 1, '');

        return $pdfContent;
    }
}
