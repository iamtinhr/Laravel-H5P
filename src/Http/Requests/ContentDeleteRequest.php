<?php

namespace Iamtinhr\LaravelH5P\Http\Requests;

use Iamtinhr\LaravelH5P\Repositories\Contracts\H5PContentRepositoryContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ContentDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
//        $h5PContentRepository = app(H5PContentRepositoryContract::class);
//        $h5pContent = $h5PContentRepository->show($this->route('id'));
//
//        return Gate::allows('delete', $h5pContent);

        $h5PContentRepository = app(H5PContentRepositoryContract::class);
        $h5PContentRepository->show($this->route('id'));
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
