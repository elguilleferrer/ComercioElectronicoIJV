<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Guille',
            'email' => 'yalvarez@comercioij.co.cu',
            'password' => bcrypt('Password.01asd$'),
        ]);

        User::create([
            'name' => 'Yuliet Lusson',
            'email' => 'ylusson@comercioij.co.cu',
            'password' => bcrypt('Ylusson2022*-'),
        ]);

        User::create([
            'name' => 'Yarisleydis Rodríguez',
            'email' => 'yrodriguez@comercioij.co.cu',
            'password' => bcrypt('Yarita2021*'),
        ]);
    }
}
