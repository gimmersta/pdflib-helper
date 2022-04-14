<?php

namespace Gimmersta\PdfLibHelper\Concerns;

use Gimmersta\PdfLibHelper\Assets\PdfCell;
use Gimmersta\PdfLibHelper\Assets\PdfLine;
use Gimmersta\PdfLibHelper\Assets\PdfTable;
use Gimmersta\PdfLibHelper\Helpers\PdfColor;
use Illuminate\Support\Collection;

trait CanDrawTable
{
    /**
     * @param PdfTable $table
     * @param null $maxWidth
     */
    public function drawTable(PdfTable $table, $maxWidth = null): void
    {
        $startX = $this->pos->x;

        if (! $maxWidth) {
            $maxWidth = $this->pos->max_x - $this->pos->x;
        }

        $firstRow = $table->rows->first();

        /** @var Collection $columnWidths */
        $columnWidths = $firstRow->pluck('width');

        $totalSetWidth = $columnWidths->sum();
        $countSetWidth = $columnWidths->filter()->count();
        $totalColumnCount = $firstRow->count();
        $totalUnsetWidth = $maxWidth - $totalSetWidth;
        $countUnsetWidth = $totalColumnCount - $countSetWidth;

        if ($countUnsetWidth) {
            $defaultColumnWidth = $totalUnsetWidth / $countUnsetWidth;
        } else {
            $defaultColumnWidth = 0;
        }

        $rowHeight = isset($table->size) ? $table->size * 1.5 : $this->pos->line_height;

        if ($table->titles) {
            $columnAlignments = $firstRow->pluck('align')->transform(function ($align) {
                    return $align ?? 'left';
                });

            $columnWidths = $columnWidths->transform(function ($width) use ($defaultColumnWidth) {
                return $width ?? $defaultColumnWidth;
            });

            $this->drawLine(
                PdfLine::make()
                    ->fromPos($this->pos->min_x, $this->pos->y)
                    ->toPos($this->pos->max_x, $this->pos->y)
                    ->lineWidth(.1)
                    ->stroke((new PdfColor())->gray(.5))
            );

            $this->pos->addY(5);

            $table->titles
                ->each(function ($title, $index) use ($table, $columnAlignments, $columnWidths) {
                    $this->drawCell(
                        PdfCell::make($title)
                            ->style('I')
                            ->size($table->size)
                            ->width($columnWidths[$index])
                            ->align($columnAlignments[$index])
                    );

                    $this->pos->addX($columnWidths[$index]);
                });

            $this->pos->addY(3);

            $this->drawLine(
                PdfLine::make()
                    ->fromPos($this->pos->min_x, $this->pos->y)
                    ->toPos($this->pos->max_x, $this->pos->y)
                    ->lineWidth(.1)
                    ->stroke((new PdfColor())->gray(.5))
            );

            $this->pos->setX($startX);
            $this->pos->addY($rowHeight);
        }

        $table->rows
            ->each(function($tableRow) use ($table, $defaultColumnWidth, $startX, $rowHeight) {
                $tableRow = collect($tableRow);

                collect($tableRow)
                    ->reject(function ($cell) {
                        return !$cell instanceof PdfCell;
                    })
                    ->each(function (PdfCell $cell) use ($table, $defaultColumnWidth) {
                        if (! $cell->width) {
                            $cell->width = $defaultColumnWidth;
                        }

                        if (! $cell->size) {
                            $cell->size($table->size);
                        }

                        $this->drawCell($cell);

                        $this->pos->addX($cell->width);
                    });

                $this->pos->setX($startX);
                $this->pos->addY($rowHeight);
            });
    }
}
