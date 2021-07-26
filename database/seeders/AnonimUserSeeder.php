<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AnonimUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Аноним',
            'email' => 'anonim@gmail.com',
            'password' => bcrypt('password'),
            'file_id' => 1
        ]);
    }
}
