<?php

namespace Gimmersta\PdfLibHelper\Concerns;

use Gimmersta\PdfLibHelper\Assets\PdfCircle;
use Gimmersta\PdfLibHelper\Helpers\PdfColor;

trait CanDrawCircle
{
    /**
     * @param PdfCircle $circle
     */
    public function drawCircle(PdfCircle $circle)
    {
        $fillColor = $circle->fillColor ?? new PdfColor();
        $strokeColor = $circle->strokeColor ?? new PdfColor();
        $lineWidth = $circle->lineWidth ?? 1;

        $this->pdf->setlinewidth($lineWidth);
        $this->pdf->setcolor('fill', $fillColor->colorSpace, $fillColor->c1, $fillColor->c2, $fillColor->c3, $fillColor->c4);
        $this->pdf->setcolor('stroke', $strokeColor->colorSpace, $strokeColor->c1, $strokeColor->c2, $strokeColor->c3, $strokeColor->c4);

        if ($this->shouldFillCircle($circle)) {
            $this->pdf->circle($circle->centerX, $circle->centerY, $circle->radius);
            $this->pdf->fill();
        }

        if ($this->shouldStrokeCircle($circle)) {
            $this->pdf->circle($circle->centerX, $circle->centerY, $circle->radius);
            $this->pdf->stroke();
        }
    }

    /**
     * @param PdfCircle $circle
     *
     * @return bool
     */
    private function shouldFillCircle(PdfCircle $circle): bool
    {
        return $circle->fillColor || (!isset($circle->fillColor) && !isset($circle->strokeColor));
    }

    /**
     * @param PdfCircle $circle
     *
     * @return boolean
     */
    private function shouldStrokeCircle(PdfCircle $circle): bool
    {
        return boolval($circle->strokeColor);
    }
}
