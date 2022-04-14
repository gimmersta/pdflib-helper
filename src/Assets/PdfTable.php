<?php

namespace Gimmersta\PdfLibHelper\Assets;

use Illuminate\Support\Collection;

class PdfTable extends BaseAsset
{
    /** @var Collection */
    public $rows;

    public $size;

    /** @var Collection */
    public $titles;

    /**
     * PdfCell constructor.
     *
     * @param array $rows
     */
    public function __construct($rows)
    {
        $this->setRows($rows);
    }

    /**
     * @param $rows
     *
     * @return $this
     */
    private function setRows($rows)
    {
        if ($rows instanceof Collection === false) {
            $rows = collect($rows);
        }

        $this->rows = collect($rows)
            ->transform(function ($row) {
                if ($row instanceof Collection === false) {
                    $row = collect($row);
                }

                return $row;
            });

        return $this;
    }

    public function size($size)
    {
        $this->size = $size;

        return $this;
    }

    public function columnTitles($titles)
    {
        $this->titles = collect($titles);

        return $this;
    }

}
