<?php

namespace App\Console\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => 'Green',
            'meta' => 'blogxe.com.vn cam kết cung cấp những thông tin xác thực và đáng tin cậy nhất ở thị trường ô tô trong nước cũng như quốc tế, đảm bảo hỗ trợ tối đa trong việc lựa chọn, tìm kiếm dòng xe phù hợp.',
            'keyword' => null,
            'thumb' => '/',
            'favicon ' => '/', // password
        ];
    }
}
