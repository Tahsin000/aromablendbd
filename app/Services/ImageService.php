<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    private const DISK = 'public';

    public static function upload(UploadedFile $image, string $folder = 'reviews'): string
    {
        return $image->store($folder, self::DISK);
    }

    public static function delete(?string $path): void
    {
        if ($path) {
            Storage::disk(self::DISK)->delete($path);
        }
    }

    public static function replace(?string $oldPath, UploadedFile $newImage, string $folder = 'reviews'): string
    {
        self::delete($oldPath);

        return self::upload($newImage, $folder);
    }

    public static function url(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return asset('storage/' . $path);
    }
}
