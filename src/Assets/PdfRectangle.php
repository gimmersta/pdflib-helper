<?php

namespace Gimmersta\PdfLibHelper\Assets;

use Gimmersta\PdfLibHelper\Helpers\PdfColor;

class PdfRectangle extends BaseAsset
{
    public $posX;
    public $posY;
    public $width;
    public $height;
    public $lineWidth;

    /** @var PdfColor */
    public $strokeColor;

    /** @var PdfColor */
    public $fillColor;

    /**
     * PdfCell constructor.
     *
     * @param $posX
     * @param $posY
     * @param $width
     * @param $height
     */
    public function __construct($posX, $posY, $width, $height)
    {
        $this->setRectangle($posX, $posY, $width, $height);
    }

    /**
     * @param $posX
     * @param $posY
     * @param $width
     * @param $height
     *
     * @return $this
     */
    private function setRectangle($posX, $posY, $width, $height)
    {
        $this->posX = $posX;
        $this->posY = $posY;
        $this->width = $width;
        $this->height = $height;

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
