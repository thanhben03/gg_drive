<?php

namespace App\Http\Requests;

use App\Models\File;
use App\Models\FileShares;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FilesActionRequest extends ParentIdBaseRequest
{

    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'all' => 'nullable|bool',
            'ids.*' => [
//                Rule::exists('files', 'id')
//                    ->where(function ($query) {
//                        $query->where('created_by', Auth::id());
//                    })
                function($att, $value, $fail) {
                    $file = File::query()
                        ->join('file_shares', 'file_shares.file_id','=', 'files.id')
                        ->where(function ($query) use ($value) {
                            $query
                                ->where('files.created_by', '=', Auth::id())
                                ->orWhere('file_shares.file_id', '=', $value);
                        })
                        ->exists();
//                    if ($file) {
//
//                    }


                }
                ,
//                function($att, $value, $fail) {
//                    $fileShares = FileShares::query()
//                                ->where('id', $value)
//                                ->get();
//                    $ancestor = $this->parent->ancestors[1];
//
//                    if ()
//                }
            ]
        ]);
    }
}
