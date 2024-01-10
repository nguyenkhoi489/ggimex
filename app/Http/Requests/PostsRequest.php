<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
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
            'slug',
            'thumb',
            'content',
            'categories_id',
            'is_active',
            'title_seo',
            'slug_seo',
            'canonical_link',
            'thumb_seo',
            'description_seo',
            'google_index'
        ];
    }
}
