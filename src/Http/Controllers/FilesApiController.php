<?php

namespace Iamtinhr\LaravelH5P\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Iamtinhr\LaravelH5P\Http\Controllers\Swagger\FilesApiSwagger;
use Iamtinhr\LaravelH5P\Services\Contracts\HeadlessH5PServiceContract;
use Iamtinhr\LaravelH5P\Http\Requests\FilesStoreRequest;

class FilesApiController extends BaseController implements FilesApiSwagger
{
    private HeadlessH5PServiceContract $hh5pService;

    public function __construct(HeadlessH5PServiceContract $hh5pService)
    {
        $this->hh5pService = $hh5pService;
    }

    public function __invoke(FilesStoreRequest $request, String $nonce = null): JsonResponse
    {
        try {
            $result = $this->hh5pService->uploadFile(
                $request->get('contentId'),
                $request->get('field'),
                $request->get('_token'),
                $nonce
            );

            return response()->json($result);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], 422);
        }
    }
}
