<?php

namespace RebelWalls\PdfLibHelper\Concerns;

use RebelWalls\PdfLibHelper\Elements\PdfCell;
use RebelWalls\PdfLibHelper\Helpers\PdfText;

/**
 * Trait CanDrawCell
 *
 * @package App\Services\Pdf\Templates\Concerns
 *
 * @property PdfText text
 */

trait CanDrawCell {

    /**
     * @param $cell
     */
    public function drawCell($cell): void
    {
        $this->text->reset();

        $posX = $this->pos->x;

        $fontNo = $this->resolveFontNo($cell);
        $fontSize = $this->resolveFontSize($cell);

        $this->pdf->setfont($fontNo, $fontSize);

        if ($cell->caps) {
            $cell->content = mb_strtoupper($cell->content);
        }

        $strWidth = $this->pdf->stringwidth($cell->content, $fontNo, $fontSize);

        // If a width is not set, assume to the far right of the page.
        if (! $cell->width) {
//            info('$this->pos->width: ' . $this->pos->width);
//            info('$this->pos->x: ' . $this->pos->x);

            $cell->width = $this->pos->width - $this->pos->x - $this->pos->margin_right;
        }

        if ($cell->align === 'right') {
            $posX = $posX + $cell->width - $strWidth;
        }

        if ($cell->align === 'center') {
            $posX = $this->pos->margin_left + ($cell->width / 2) - ($strWidth / 2);
        }

        if ($cell->color) {

//            dd($cell->color);

            $this->pdf->setcolor('stroke', $cell->color->colorSpace, $cell->color->c1, $cell->color->c2, $cell->color->c3, $cell->color->c4);
            $this->pdf->setcolor('fill', $cell->color->colorSpace, $cell->color->c1, $cell->color->c2, $cell->color->c3, $cell->color->c4);
        }

        $this->pdf->show_xy($cell->content, $posX, $this->pos->y);

        $this->text->reset();
    }

    /**
     * @param PdfCell $cell
     *
     * @return int
     */
    private function resolveFontNo(PdfCell $cell): int
    {
        if (! $cell->font) {
            $cell->font = $this->defaultFont;
        }

        $font = $cell->font;

        if ($cell->style) {
            $font .= '-' . $cell->style;
        }

        return $this->text->loadedFonts[$font];
    }

    /**
     * @param PdfCell $cell
     *
     * @return float
     */
    private function resolveFontSize(PdfCell $cell): float
    {
        if (! $cell->size) {
            return $this->text->defaultFontSize;
        }

        return $cell->size;
    }
}
