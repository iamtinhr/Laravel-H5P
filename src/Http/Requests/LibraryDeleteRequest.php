<?php

namespace Iamtinhr\LaravelH5P\Http\Requests;

use Iamtinhr\LaravelH5P\Repositories\Contracts\H5PContentRepositoryContract;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class LibraryDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
//        $h5PContentRepository = app(H5PContentRepositoryContract::class);
//        $h5pLibrary = $h5PContentRepository->getLibraryById($this->route('id'));
//
//        return Gate::allows('delete', $h5pLibrary);

        $h5PContentRepository = app(H5PContentRepositoryContract::class);
        $h5PContentRepository->getLibraryById($this->route('id'));

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
