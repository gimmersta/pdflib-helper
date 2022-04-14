<?php

namespace Gimmersta\PdfLibHelper\Assets;

/**
 * Class PdfKeyValue
 *
 * @package App\Services\Pdf\Generators
 */

class PdfKeyValue extends BaseAsset
{
    public $items = [];

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function addItem($key, $value)
    {
        $this->items[] = [$key, $value];

        return $this;
    }
}
