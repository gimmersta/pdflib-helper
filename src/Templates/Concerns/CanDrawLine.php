<?php

namespace RebelWalls\PdfLibHelper\Templates\Concerns;

use RebelWalls\PdfLibHelper\Elements\PdfLine;
use RebelWalls\PdfLibHelper\Helpers\PdfColor;

trait CanDrawLine {

    public function drawLine(PdfLine $line)
    {
        $strokeColor = $line->strokeColor ?? new PdfColor();
        $fillColor = $line->fillColor ?? new PdfColor();

        $this->pdf->setlinewidth($line->lineWidth);
        $this->pdf->setcolor('stroke', $strokeColor->colorSpace, $strokeColor->c1, $strokeColor->c2, $strokeColor->c3, $strokeColor->c4);
        $this->pdf->setcolor('fill', $fillColor->colorSpace, $fillColor->c1, $fillColor->c2, $fillColor->c3, $fillColor->c4);
        $this->pdf->moveto($line->fromX, $line->fromY);
        $this->pdf->lineto($line->toX, $line->toY);
        $this->pdf->stroke();
    }
}
