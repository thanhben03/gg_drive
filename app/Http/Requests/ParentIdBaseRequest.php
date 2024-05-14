<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class ParentIdBaseRequest extends FormRequest
{
    public ?File $parent = null;

    public function authorize(): bool
    {
        $this->parent = File::query()->where('id', $this->input('parent_id'))->first();
        if ($this->parent && !$this->parent->isOwnedBy(Auth::id()) && !$this->parent->isShareWithRootFolder()) {
            return false;
        }
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_id' => [
                function($attribute, $value, $fail) {
                    $file = File::query()
                                ->join('file_shares', 'file_shares.file_id','=', 'files.id')
                                ->where(function ($query) {
                                    $query
                                        ->where('created_by', '=', Auth::id())
                                        ->orWhere('file_shares.user_id', '=', Auth::id());
                                })
                                ->where('is_folder', '=', '1')
                                ->where('files.id', $value)
                                ->exists();
                }
//                Rule::exists(File::class, 'id')
//                    ->where(function (Builder $query) {
//                        return $query
//                            ->where('is_folder', '=', '1')
//                            ->where('created_by', '=', Auth::id());
//                    })
            ]
        ];
    }
}
