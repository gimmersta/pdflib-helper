<?php

namespace Gimmersta\PdfLibHelper\Concerns;

use Gimmersta\PdfLibHelper\Assets\PdfGraphic;

trait CanDrawGraphic
{
    /**
     * @param PdfGraphic $graphic
     */
    public function drawGraphic(PdfGraphic $graphic): void
    {
        $loadedGraphic = $this->pdf->load_graphics('auto', $graphic->file, '');

        if (!$loadedGraphic) {
            die("Error: " . $this->pdf->get_errmsg());
        }

        $this->pdf->fit_graphics($loadedGraphic, $this->pos->x, $this->pos->y, $this->resolveGraphicOptionsString($graphic));
        $this->pdf->close_graphics($loadedGraphic);
    }

    /**
     * @param PdfGraphic $graphic
     *
     * @return string
     */
    private function resolveGraphicOptionsString(PdfGraphic $graphic): string
    {
        return 'scale=' . $graphic->scale . ' position={' . $graphic->positionX . ' ' . $graphic->positionY . '}';
    }
}
