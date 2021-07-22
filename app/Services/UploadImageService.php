<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

/**
 * Class UploadImageService
 * @package App\Services
 */
class UploadImageService
{
    /**
     * Загрузчик превью товара.
     *
     * @param $request
     * @return string
     */
    public function uploadCategoryPreview($request)
    {
        $preview = $request['preview'];

        $filename = $preview->getClientOriginalName();

        try {
            Image::make($preview)->save(public_path('storage/category/') . $filename);
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());
        }

        return asset('storage/category/' . $filename);
    }
}
