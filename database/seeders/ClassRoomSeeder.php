<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassRoomSeeder extends Seeder
{

    protected $data = [
        [
            'name' => 'X TJKT 1',
        ],
        [
            'name' => 'X TJKT 2',
        ],
        [
            'name' => 'X DKV 1',
        ],
        [
            'name' => 'X DKV 2',
        ],
        [
            'name' => 'X DKV 3',
        ],
        [
            'name' => 'X TF 1',
        ],
        [
            'name' => 'X TF 2',
        ],
        [
            'name' => 'X BD',
        ],
        [
            'name' => 'X MPLB 1',
        ],
        [
            'name' => 'X MPLB 2',
        ],
        [
            'name' => 'X AKT 1',
        ],
        [
            'name' => 'X AKT 2',
        ],
        [
            'name' => 'XI TKJ 1',
        ],
        [
            'name' => 'XI TKJ 2',
        ],
        [
            'name' => 'XI MM 1',
        ],
        [
            'name' => 'XI MM 2',
        ],
        [
            'name' => 'XI MM 3',
        ],
        [
            'name' => 'XI FKK',
        ],
        [
            'name' => 'XI BDP',
        ],
        [
            'name' => 'XI OTKP 1',
        ],
        [
            'name' => 'XI OTKP 2',
        ],
        [
            'name' => 'XI AKL',
        ],
        [
            'name' => 'XII TKJ 1',
        ],
        [
            'name' => 'XII TKJ 2',
        ],
        [
            'name' => 'XII MM 1',
        ],
        [
            'name' => 'XII MM 2',
        ],
        [
            'name' => 'XII FKK 1',
        ],
        [
            'name' => 'XII FKK 2',
        ],
        [
            'name' => 'XII BDP',
        ],
        [
            'name' => 'XII OTKP 1',
        ],
        [
            'name' => 'XII OTKP 2',
        ],
        [
            'name' => 'XII AKL 1',
        ],
        [
            'name' => 'XII AKL 2',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        foreach ($this->data as $d) {
            ClassRoom::create([
                'name' => $d['name'],
            ]);
        }
    }
}
