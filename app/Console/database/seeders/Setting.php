<?php

namespace App\Console\database\seeders;

use Illuminate\Database\Seeder;

class Setting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::factory(1)->create();

    }
}
