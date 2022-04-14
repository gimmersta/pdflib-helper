<?php

namespace Gimmersta\PdfLibHelper\Assets;

class PdfDocument extends BaseAsset
{
    public $file;

    public $orientate = 'north';
    public $scale = 1.0;

    /**
     * PdfDocument constructor.
     *
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->setFile($file);
    }

    /**
     * @param string $file
     *
     * @return PdfDocument
     */
    private function setFile(string $file): PdfDocument
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @param string $orientate
     *
     * @return $this
     */
    public function orientate(string $orientate)
    {
        $this->orientate = $orientate;

        return $this;
    }

    /**
     * @param float $scale
     *
     * @return $this
     */
    public function scale(float $scale)
    {
        $this->scale = $scale;

        return $this;
    }
}
