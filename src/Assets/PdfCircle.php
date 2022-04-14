<?php

namespace Gimmersta\PdfLibHelper\Assets;

use Gimmersta\PdfLibHelper\Helpers\PdfColor;

class PdfCircle extends BaseAsset
{
    public $centerX;
    public $centerY;
    public $radius;
    public $lineWidth;

    /** @var PdfColor */
    public $strokeColor;

    /** @var PdfColor */
    public $fillColor;

    /**
     * PdfCell constructor.
     *
     * @param $centerX
     * @param $centerY
     * @param $radius
     */
    public function __construct($centerX, $centerY, $radius)
    {
        $this->setRectangle($centerX, $centerY, $radius);
    }

    /**
     * @param $centerX
     * @param $centerY
     * @param $radius
     *
     * @return $this
     */
    private function setRectangle($centerX, $centerY, $radius)
    {
        $this->centerX = $centerX;
        $this->centerY = $centerY;
        $this->radius = $radius;

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
