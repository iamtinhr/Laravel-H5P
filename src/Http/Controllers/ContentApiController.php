<?php

namespace Iamtinhr\LaravelH5P\Http\Controllers;

use Iamtinhr\LaravelH5P\Dtos\ContentFilterCriteriaDto;
use Iamtinhr\LaravelH5P\Http\Controllers\Swagger\ContentApiSwagger;
use Iamtinhr\LaravelH5P\Http\Requests\ContentCreateRequest;
use Iamtinhr\LaravelH5P\Http\Requests\ContentDeleteRequest;
use Iamtinhr\LaravelH5P\Http\Requests\ContentListRequest;
use Iamtinhr\LaravelH5P\Http\Requests\AdminContentReadRequest;
use Iamtinhr\LaravelH5P\Http\Requests\ContentReadRequest;
use Iamtinhr\LaravelH5P\Http\Requests\ContentUpdateRequest;
use Iamtinhr\LaravelH5P\Http\Requests\LibraryStoreRequest;
use Iamtinhr\LaravelH5P\Http\Resources\ContentIndexResource;
use Iamtinhr\LaravelH5P\Http\Resources\ContentResource;
use Iamtinhr\LaravelH5P\Repositories\Contracts\H5PContentRepositoryContract;
use Iamtinhr\LaravelH5P\Services\Contracts\HeadlessH5PServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ContentApiController extends BaseController implements ContentApiSwagger
{
    private HeadlessH5PServiceContract $hh5pService;
    private H5PContentRepositoryContract $contentRepository;

    public function __construct(HeadlessH5PServiceContract $hh5pService, H5PContentRepositoryContract $contentRepository)
    {
        $this->hh5pService = $hh5pService;
        $this->contentRepository = $contentRepository;
    }

    public function index(ContentListRequest $request): JsonResponse
    {
        $contentFilterDto = ContentFilterCriteriaDto::instantiateFromRequest($request);
        $columns = [
          'hh5p_contents.title',
          'hh5p_contents.id',
          'hh5p_contents.uuid',
          'hh5p_contents.library_id',
          'hh5p_contents.user_id',
          'hh5p_contents.author'
        ];
        $list = $request->get('per_page') !== null && $request->get('per_page') == 0 ?
            $this->contentRepository->unpaginatedList($contentFilterDto, $columns) :
            $this->contentRepository->list($contentFilterDto, $request->get('per_page'), $columns);

        return $this->sendResponseForResource(ContentIndexResource::collection($list));
    }

    public function update(ContentUpdateRequest $request, int $id): JsonResponse
    {
        // Sanitize params
        $params = str_replace('\\"', "'", $request->get('params'));
        try {
            $contentId = $this->contentRepository->edit($id, $request->get('title'), $request->get('library'), $params, $request->get('nonce'));
        } catch (Exception $error) {
            return $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse(['id' => $contentId]);
    }

    public function store(ContentCreateRequest $request): JsonResponse
    {
        // Sanitize params
        $params = str_replace('\\"', "'", $request->get('params'));
        try {
            $contentId = $this->contentRepository->create($request->get('title'), $request->get('library'), $params, $request->get('nonce'));
        } catch (Exception $error) {
            return $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse(['id' => $contentId]);
    }

    public function destroy(ContentDeleteRequest $request, int $id): JsonResponse
    {
        try {
            $contentId = $this->contentRepository->delete($id);
        } catch (Exception $error) {
            return $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse(['id' => $contentId]);
    }

    public function show(AdminContentReadRequest $request, int $id): JsonResponse
    {
        try {
            $settings = $this->hh5pService->getContentSettings($id);
        } catch (Exception $error) {
            return $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse($settings);
    }

    public function frontShow(ContentReadRequest $request, string $uuid): JsonResponse
    {
        try {
            $settings = $this->hh5pService->getContentSettings($request->getH5PContent()->id);
        } catch (Exception $error) {
            return $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse($settings);
    }

    public function upload(LibraryStoreRequest $request): JsonResponse
    {
        try {
            $content = $this->contentRepository->upload($request->file('h5p_file'));
        } catch (Exception $error) {
            return $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponseForResource(ContentResource::make($content));
    }

    public function download(AdminContentReadRequest $request, $id): BinaryFileResponse
    {
        $filepath = $this->contentRepository->download($id);

        return response()
            ->download($filepath, '', [
                'Content-Type' => 'application/zip',
                'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
            ]);
    }

    public function deleteUnused(): JsonResponse
    {
        try {
            $ids = $this->contentRepository->deleteUnused();
        } catch (Exception $error) {
            return $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse(['ids' => $ids]);
    }
}
