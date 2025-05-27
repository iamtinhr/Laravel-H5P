<?php

namespace Iamtinhr\LaravelH5P\Http\Requests;

use Iamtinhr\LaravelH5P\Models\H5PContent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ContentUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
//        $h5pContent = H5PContent::findOrFail($this->route('id'));
//        return Gate::allows('update', $h5pContent);

        H5PContent::findOrFail($this->route('id'));
        return true;
    }

    public function rules(): array
    {
        return [
            'title'   => ['required', 'string'],
            'library' => ['required', 'string'],
            'params'  => ['required', 'string'],
            'nonce'  => ['required', 'string'],
        ];
    }
}
