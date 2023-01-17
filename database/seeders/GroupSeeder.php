<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
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
                'name' => 'Группа1',
                'expire_hours' => 1
            ], [
                'name' => 'Группа2',
                'expire_hours' => 2
            ]
        ];

        foreach ($data as $dataForOneGroup) {
            Group::factory()->create($dataForOneGroup);
        }
    }
}
