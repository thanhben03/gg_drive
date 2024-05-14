<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ShareFilesRequest extends FilesActionRequest
{

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'email' => 'required|email',
        ]);
    }
}
