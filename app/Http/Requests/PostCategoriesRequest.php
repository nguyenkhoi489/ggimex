<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCategoriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title',
            'description',
            'slug',
            'thumb',
            'is_active',
            'title_seo',
            'description_seo',
            'canonical_link',
            'slug_seo',
            'thumb_seo',
            'google_index'
        ];
    }
}
