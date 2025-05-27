<?php

namespace Iamtinhr\LaravelH5P\Http\Requests;

use Iamtinhr\LaravelH5P\Models\H5PLibrary;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class LibraryListRequest extends FormRequest
{
    public function authorize(): bool
    {
//        return Gate::allows('list', H5PLibrary::class);

        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
