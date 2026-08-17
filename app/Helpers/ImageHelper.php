<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Generate the correct public URL for an image.
     *
     * Demo images:
     * assets/images/demo-images/example.jpg
     *
     * Uploaded images:
     * property_images/example.jpg
     */
    public static function url(?string $path): string
    {
        if (!$path) {
            return asset('assets/images/placeholder.jpg');
        }

        // Already a complete URL
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Public assets
        if (str_starts_with($path, 'assets/')) {
            return asset($path);
        }

        // Storage images
        return asset('storage/' . ltrim($path, '/'));
    }
}