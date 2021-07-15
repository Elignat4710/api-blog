<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::create([
            'name' => 'images/default.jpg'
        ]);
    }
}
