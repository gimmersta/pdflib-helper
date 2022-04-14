<?php

namespace Gimmersta\PdfLibHelper\Assets;

/**
 * Class PdfTextFlow
 *
 * @package RebelWalls\PdfLibHelper\Assets
 *
 * Multiline text content
 */
class PdfTextFlow extends BaseAsset
{
    public $content;
    public $fontSize = 8;
    public $font = 'EBGaramond';
    public $width;
    public $height;
    public $border = false;
    public $orientate = 'north';
    public $fontStyle = 'normal';
    public $charSpacing = 0;

    /**
     * PdfTextFlow constructor.
     *
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->setContent($content);
    }

    /**
     * @param string $content
     *
     * @return PdfTextFlow
     */
    private function setContent(string $content): PdfTextFlow
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param float $fontSize
     *
     * @return PdfTextFlow
     */
    public function fontSize(float $fontSize): PdfTextFlow
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    /**
     * @param float $width
     *
     * @return PdfTextFlow
     */
    public function width(float $width): PdfTextFlow
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @param float $height
     *
     * @return PdfTextFlow
     */
    public function height(float $height): PdfTextFlow
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @param bool $border
     *
     * @return PdfTextFlow
     */
    public function border(bool $border): PdfTextFlow
    {
        $this->border = $border;

        return $this;
    }

    /**
     * @param string $orientate
     *
     * @return PdfTextFlow
     */
    public function orientate(string $orientate): PdfTextFlow
    {
        $this->orientate = $orientate;

        return $this;
    }

    /**
     * @param string $font
     *
     * @return PdfTextFlow
     */
    public function font(string $font): PdfTextFlow
    {
        $this->font = $font;

        return $this;
    }

    /**
     * @param string $fontStyle
     *
     * @return PdfTextFlow
     */
    public function fontStyle(string $fontStyle): PdfTextFlow
    {
        $this->fontStyle = $fontStyle;

        return $this;
    }

    /**
     * @param float $charSpacing
     *
     * @return PdfTextFlow
     */
    public function charSpacing(float $charSpacing): PdfTextFlow
    {
        $this->charSpacing = $charSpacing;

        return $this;
    }
}
