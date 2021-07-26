<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class TestCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['id' => 1, 'name' => 'test']);
    }
}
