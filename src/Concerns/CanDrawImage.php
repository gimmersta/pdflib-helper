<?php

namespace Gimmersta\PdfLibHelper\Concerns;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Gimmersta\PdfLibHelper\Assets\PdfImage;

trait CanDrawImage
{
    /**
     * @param PdfImage $image
     */
    public function drawImage(PdfImage $image): void
    {
        $loadedImage = $this->loadImage($image);

        if (!$image) {
            die("Error: " . $this->pdf->get_errmsg());
        }

        $this->pdf->fit_image($loadedImage, $this->pos->x, $this->pos->y, $this->resolveImageOptionsString($image));
        $this->pdf->close_image($loadedImage);
    }

    /**
     * @param PdfImage $image
     *
     * @return string
     */
    private function resolveImageOptionsString(PdfImage $image): string
    {
        return 'scale=' . $image->scale . ' position={' . $image->positionX . ' ' . $image->positionY . '} orientate=' . $image->orientate;
    }

    /**
     * @param PdfImage $image
     *
     * @return mixed
     */
    private function loadImage(PdfImage $image)
    {
        $path = mb_strtolower($image->file);

        if (Str::contains($path, ['http://', 'https://'])) {
            $content = file_get_contents($path);

            $storage = Storage::disk('local');
            $fileName = basename($path);
            $filePath = 'pdf/' . $fileName;
            $storage->put($filePath, $content);

            $fullPath = concat_path(storage_path('app/pdf'), $fileName);
            $loadedImage = $this->pdf->load_image('auto', $fullPath, '');
            $storage->delete($filePath);
        } else {
            $loadedImage = $this->pdf->load_image('auto', $image->file, '');
        }

        return $loadedImage;
    }
}
