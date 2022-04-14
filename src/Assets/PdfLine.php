<?php

namespace Gimmersta\PdfLibHelper\Assets;

use Gimmersta\PdfLibHelper\Helpers\PdfColor;

/**
 * Class PdfLine
 *
 * @package App\Services\Pdf\Generators
 */

class PdfLine extends BaseAsset
{
    public $fromX;
    public $fromY;
    public $toX;
    public $toY;
    public $lineWidth;

    public $colorSpace;
    public $c1;
    public $c2;
    public $c3;
    public $c4;

    /** @var PdfColor */
    public $strokeColor;

    /** @var PdfColor */
    public $fillColor;

    /**
     * @param $x
     * @param $y
     *
     * @return $this
     */
    public function fromPos($x, $y)
    {
        $this->fromX = $x;
        $this->fromY = $y;

        return $this;
    }

    /**
     * @param $x
     * @param $y
     *
     * @return $this
     */
    public function toPos($x, $y)
    {
        $this->toX = $x;
        $this->toY = $y;

        return $this;
    }

    /**
     * @param int $lineWidth
     *
     * @return $this
     */
    public function lineWidth($lineWidth = 1)
    {
        $this->lineWidth = $lineWidth;

        return $this;
    }

    /**
     * @param PdfColor $color
     *
     * @return $this
     */
    public function stroke(PdfColor $color)
    {
        $this->strokeColor = $color;

        return $this;
    }

    /**
     * @param PdfColor $color
     *
     * @return $this
     */
    public function fill(PdfColor $color)
    {
        $this->fillColor = $color;

        return $this;
    }
}
