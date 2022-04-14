<?php

namespace Gimmersta\PdfLibHelper;

use PDFlib;
use Gimmersta\PdfLibHelper\Concerns\CanDrawCircle;
use Gimmersta\PdfLibHelper\Concerns\CanDrawPdfDocument;
use Gimmersta\PdfLibHelper\Concerns\CanDrawRectangle;
use Gimmersta\PdfLibHelper\Concerns\CanDrawTextFlow;
use Gimmersta\PdfLibHelper\Helpers\PdfColor;
use Gimmersta\PdfLibHelper\Helpers\PdfPosition;
use Gimmersta\PdfLibHelper\Concerns\CanDrawCell;
use Gimmersta\PdfLibHelper\Concerns\CanDrawGraphic;
use Gimmersta\PdfLibHelper\Concerns\CanDrawImage;
use Gimmersta\PdfLibHelper\Concerns\CanDrawKeyValueTable;
use Gimmersta\PdfLibHelper\Concerns\CanDrawLine;
use Gimmersta\PdfLibHelper\Concerns\CanDrawTable;
use Gimmersta\PdfLibHelper\Helpers\PdfText;

/**
 * @property PdfLib pdf
 * @property int $pageCount
 * @property array $additionalFonts
 * @property string $defaultFont
 * @property float $defaultFontSize
 * @property string $documentCreator
 *
 * @property PdfPosition $pos
 * @property PdfText $text
 */
abstract class PdfLibHelper
{
    protected int $pageCount = 0;
    protected array $additionalFonts;
    protected string $defaultFont;
    protected float $defaultFontSize;
    protected string $documentCreator;
    protected array $fontList;
    protected PdfColor $color;
    protected PDFlib $pdf;
    protected PdfPosition $pos;
    protected PdfText $text;

    use CanDrawCell;
    use CanDrawCircle;
    use CanDrawGraphic;
    use CanDrawImage;
    use CanDrawKeyValueTable;
    use CanDrawLine;
    use CanDrawRectangle;
    use CanDrawTable;
    use CanDrawPdfDocument;
    use CanDrawTextFlow;

    /**
     * PdfBaseTemplate constructor.
     */
    public function __construct()
    {
        $this->pdf = new PdfLib();

        $this->pos = new PdfPosition();
        $this->text = new PdfText($this->pdf);
    }
}
