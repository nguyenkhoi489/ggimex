<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'gallery',
            'description',
            'content',
            'categories_id',
            'price',
            'price_type',
            'price_to',
            'sku',
            'prefix_id',
            'inventory',
            'is_active'
        ];
    }
}
