<?php

namespace Iamtinhr\LaravelH5P\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Iamtinhr\LaravelH5P\Http\Controllers\Swagger\EditorApiSwagger;
use Iamtinhr\LaravelH5P\Services\Contracts\HeadlessH5PServiceContract;
use Exception;

class EditorApiController extends BaseController implements EditorApiSwagger
{
    private HeadlessH5PServiceContract $hh5pService;

    public function __construct(HeadlessH5PServiceContract $hh5pService)
    {
        $this->hh5pService = $hh5pService;
    }

    public function __invoke(Request $request, $id = null): JsonResponse
    {
        $token = request()->bearerToken();

        try {
            $settings = $this->hh5pService->getEditorSettings($id);

            return $this->sendResponse(array_merge($settings, ['token' => $token]), 'Editor settings retrieved successfully');
        } catch (Exception $error) {
            return $this->sendError($error->getMessage(), 422);
        }
    }
}
