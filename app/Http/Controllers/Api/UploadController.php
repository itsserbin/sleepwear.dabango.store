<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UploadImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadController extends Controller
{
    private $UploadService;

    /**
     * UploadController constructor.
     * @param UploadImageService $uploadImage
     */
    public function __construct(UploadImageService $uploadImage)
    {
        parent::__construct();
        $this->UploadService = $uploadImage;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function uploadCategoryPreview(Request $request)
    {
        try {
            $path = $this->UploadService->uploadCategoryPreview($request->all());
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage());

            return $this->returnResponse([
                'success' => false,
            ], 400);
        }

        return $this->returnResponse([
            'success' => true,
            'url' => $path,
        ]);
    }


}
