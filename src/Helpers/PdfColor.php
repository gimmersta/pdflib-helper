<?php

namespace Gimmersta\PdfLibHelper\Helpers;

class PdfColor
{
    public $colorSpace;

    public $c1;
    public $c2;
    public $c3;
    public $c4;

    /**
     * PdfColor constructor.
     */
    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->colorSpace = config('pdf-generator.default-color-space');
        $this->c1 = 0;
        $this->c2 = 0;
        $this->c3 = 0;
        $this->c4 = 0;
    }

    public function gray($c1 = 0)
    {
        $this->colorSpace = 'gray';
        $this->c1 = $c1;

        return $this;
    }

    public function white($c = 0)
    {
        $this->colorSpace = 'white';
        $this->c = $c;

        return $this;
    }

    public function black($c = 0)
    {
        $this->colorSpace = 'black';
        $this->c = $c;

        return $this;
    }

    public function rgb($c1 = 0, $c2 = 0, $c3 = 0)
    {
        $this->colorSpace = 'rgb';
        $this->c1 = $c1;
        $this->c2 = $c2;
        $this->c3 = $c3;

        return $this;
    }

    public function cmyk($c1 = 0, $c2 = 0, $c3 = 0, $c4 = 0)
    {
        $this->colorSpace = 'cmyk';
        $this->c1 = $c1;
        $this->c2 = $c2;
        $this->c3 = $c3;
        $this->c4 = $c4;

        return $this;
    }
}
