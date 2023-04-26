<?php

namespace Database\Seeders;

use App\Models\Competency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetencySeeder extends Seeder
{

    protected $data = [
        [
            'name' => 'Desain Komunikasi Visual',
            'singkatan' => 'DKV'
        ],
        [
            'name' => 'Teknik Jaringan Komputer & Telekomunikasi',
            'singkatan' => 'TJKT'
        ],
        [
            'name' => 'Bisnis Digital',
            'singkatan' => 'BD'
        ],
        [
            'name' => 'Manajemen Perkantoran & Layanan Bisnis',
            'singkatan' => 'MPLB'
        ],
        [
            'name' => 'Akuntansi & Keuangan Lembaga',
            'singkatan' => 'AKT'
        ],
        [
            'name' => 'Teknologi Farmasi',
            'singkatan' => 'TF'
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
            Competency::create([
                'name' => $d['name'],
                'singkatan' => $d['singkatan'],
            ]);
        }
    }
}
