<?php

namespace Gimmersta\PdfLibHelper\Assets;

/**
 * Class PdfImage
 *
 * @package App\Services\Pdf\Generators
 *
 * @property-read float $scale;
 */

class PdfImage extends BaseAsset
{
    public $file;
    public $scale = 1;
    public $orientate = 'north';

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
     * @return PdfImage
     */
    private function setFile(string $file): PdfImage
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @param float $scale
     *
     * @return PdfImage
     */
    public function scale(float $scale): PdfImage
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * @param string $orientate
     *
     * @return PdfImage
     */
    public function orientate(string $orientate): PdfImage
    {
        $this->orientate = $orientate;

        return $this;
    }

    /**
     * @param string $positionString
     *
     * @return $this
     */
    public function alignX(string $positionString = 'left'): PdfImage
    {
        $this->positionX = $this->stringToPosition($positionString);

        return $this;
    }

    /**
     * @param string $positionString
     *
     * @return $this
     */
    public function alignY(string $positionString = 'top'): PdfImage
    {
        $this->positionX = $this->stringToPosition($positionString);

        return $this;
    }
}
