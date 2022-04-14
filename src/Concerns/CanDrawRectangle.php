<?php

namespace Gimmersta\PdfLibHelper\Concerns;

use Gimmersta\PdfLibHelper\Assets\PdfRectangle;
use Gimmersta\PdfLibHelper\Helpers\PdfColor;

trait CanDrawRectangle
{
    /**
     * @param PdfRectangle $rectangle
     */
    public function drawRectangle(PdfRectangle $rectangle)
    {
        $fillColor = $rectangle->fillColor ?? new PdfColor();
        $strokeColor = $rectangle->strokeColor ?? new PdfColor();
        $lineWidth = $rectangle->lineWidth ?? 1;

        $startX = $rectangle->posX;
        $startY = $rectangle->height + $rectangle->posY; // Make the start pos top left for ease of use.

        $this->pdf->setlinewidth($lineWidth);
        $this->pdf->setcolor('fill', $fillColor->colorSpace, $fillColor->c1, $fillColor->c2, $fillColor->c3, $fillColor->c4);
        $this->pdf->setcolor('stroke', $strokeColor->colorSpace, $strokeColor->c1, $strokeColor->c2, $strokeColor->c3, $strokeColor->c4);

        if ($this->shouldFillRectangle($rectangle)) {
            $this->pdf->rect($startX, $startY, $rectangle->width, $rectangle->height);
            $this->pdf->fill();
        }

        if ($this->shouldStrokeRectangle($rectangle)) {
            $this->pdf->rect($startX, $startY, $rectangle->width, $rectangle->height);
            $this->pdf->stroke();
        }
    }

    /**
     * @param PdfRectangle $rectangle
     *
     * @return bool
     */
    private function shouldFillRectangle(PdfRectangle $rectangle): bool
    {
        return $rectangle->fillColor || (!isset($rectangle->fillColor) && !isset($rectangle->strokeColor));
    }

    /**
     * @param PdfRectangle $rectangle
     *
     * @return boolean
     */
    private function shouldStrokeRectangle(PdfRectangle $rectangle): bool
    {
        return boolval($rectangle->strokeColor);
    }
}
