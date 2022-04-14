<?php

namespace Gimmersta\PdfLibHelper\Assets;

/**
 * Class PdfGraphics
 *
 * @package App\Services\Pdf\Generators
 *
 * @property-read float $scale;
 */

class PdfGraphic extends BaseAsset
{
    public $file;
    public $scale = 1;

    public $positionX = 0;
    public $positionY = 100;

    /**
     * PdfCell constructor.
     *
     * @param $file
     */
    public function __construct($file)
    {
        $this->setFile($file);
    }

    /**
     * @param string $file
     *
     * @return PdfGraphic
     */
    private function setFile(string $file): PdfGraphic
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @param float $scale
     *
     * @return PdfGraphic
     */
    public function scale(float $scale): PdfGraphic
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * @param string $positionString
     *
     * @return $this
     */
    public function alignX(string $positionString = 'left'): PdfGraphic
    {
        $this->positionX = $this->stringToPosition($positionString);

        return $this;
    }

    /**
     * @param string $positionString
     *
     * @return $this
     */
    public function alignY(string $positionString = 'top'): PdfGraphic
    {
        $this->positionX = $this->stringToPosition($positionString);

        return $this;
    }
}
