<?php

namespace Iamtinhr\LaravelH5P\Http\Requests;

use Iamtinhr\LaravelH5P\Models\H5PContent;
use Illuminate\Support\Facades\Gate;

class AdminContentReadRequest extends ContentReadRequest
{
    public function authorize(): bool
    {
//        $h5pContent = $this->getH5PContent();
//        return Gate::allows('read', $h5pContent);

        $this->getH5PContent();
        return true;
    }

    public function getH5PContent(): H5PContent
    {
        return H5PContent::findOrFail($this->route('id'));
    }
}
