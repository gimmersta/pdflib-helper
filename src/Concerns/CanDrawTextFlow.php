<?php

namespace Gimmersta\PdfLibHelper\Concerns;

use Gimmersta\PdfLibHelper\Assets\PdfTextFlow;

trait CanDrawTextFlow
{
    /**
     * @param PdfTextFlow $text
     */
    public function drawTextFlow(PdfTextFlow $text): void
    {
        $textFlow = $this->pdf->add_textflow(0, $text->content, $this->resolveTextOptionsString($text));
        $x = $this->pos->x;
        $y = $this->pos->y;
        $maxX = $x + $text->width;
        $maxY = $y + $text->height;

        $showBorder = $text->border ? "true" : "false";
        $this->pdf->fit_textflow($textFlow, $x, $y, $maxX, $maxY, "showborder=$showBorder orientate={$text->orientate}");
    }

    /**
     * @param PdfTextFlow $text
     *
     * @return string
     */
    private function resolveTextOptionsString(PdfTextFlow $text): string
    {
        return "fontname={$text->font} fontsize={$text->fontSize} encoding=unicode fontstyle={$text->fontStyle} charspacing={$text->charSpacing}";
    }
}
