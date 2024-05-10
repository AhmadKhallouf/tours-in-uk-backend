<?php

namespace App\Services;

use Exception;

class RandImageProviderService
{
    /**
     * @throws Exception
     */
    public static function getRandomImage($imageSubDirectory = null): string
    {
        $tempImagesDir = app_path('TempImages');
        $publicPath = storage_path('app/public');

        $images = glob($tempImagesDir . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        if (empty($images)) {
            throw new Exception("No images available in the directory: $tempImagesDir");
        }

        $randomImageFilePath = $images[array_rand($images)];

        $fileName = basename($randomImageFilePath);

        $uniqueFileName = uniqid() . '-' . $fileName;

        if ($imageSubDirectory !== null && !str_ends_with($imageSubDirectory, '/')) {
            $imageSubDirectory .= '/';
        }

        $imageSubPath = $imageSubDirectory . $uniqueFileName;

        $newImagePath = $publicPath . '/' . $imageSubPath;
        copy($randomImageFilePath, $newImagePath);

        return $imageSubPath;
    }
}
