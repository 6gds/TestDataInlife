<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Иванов',
                'email' => 'info@datainlife.ru'
            ], [
                'name' => 'Петров',
                'email' => 'job@datainlife.ru'
            ]
        ];

        foreach ($data as $dataForOneUser) {
            User::factory()->create($dataForOneUser);
        }
    }
}
