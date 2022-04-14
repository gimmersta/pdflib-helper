<?php

namespace Gimmersta\PdfLibHelper\Assets;

abstract class BaseAsset
{
    /**
     * Create a new element.
     *
     * @param array $arguments
     *
     * @return static
     */
    public static function make(...$arguments)
    {
        return new static(...$arguments);
    }

    /**
     * @param string $positionString
     *
     * @return int
     */
    public function stringToPosition(string $positionString): int
    {
        switch ($positionString) {
            case 'left':
                return 0;
            case 'right':
                return 100;
            case 'center':
                return 50;
            case 'middle':
                return 50;
            case 'top':
                return 0;
            case 'bottom':
                return 100;
            default:
                return 0;
        }
    }
}
