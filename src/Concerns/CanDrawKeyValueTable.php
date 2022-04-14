<?php

namespace Gimmersta\PdfLibHelper\Concerns;

use Illuminate\Support\Collection;

trait CanDrawKeyValueTable
{
    /**
     * @param Collection $tableData
     * @param null $maxWidth
     * @param int $columnMargin
     */
    public function drawKeyValueTable(Collection $tableData, $maxWidth = null, $columnMargin = 5): void
    {
        $startX = $this->pos->x; // Remember left starting position

        if (! $maxWidth) {
            $maxWidth = $this->pos->getUsableX();
        }

        $tableData->each(function($tableRow) use ($maxWidth, $startX, $columnMargin) {
            $firstCell = $tableRow[0];
            $secondCell = $tableRow[1];

            if (! $firstCell->width) {
                $firstCell->width = $maxWidth / 2;
            }

            if (! $secondCell->width) {
                $secondCell->width = $maxWidth - $firstCell->width;
            }

            $this->drawCell($firstCell);
            $this->pos->addX($firstCell->width);
            $this->drawCell($secondCell);
            $this->pos->lineBreak();
            $this->pos->x = $startX; // Reset to startX position
        });
    }
}
