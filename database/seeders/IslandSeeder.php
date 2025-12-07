<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Island;

class IslandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $island = [
            'Mallorca',
            'Menorca',
            'Eivissa',
            'Formentera',
            'Cabrera',
        ];

        foreach ($island as $isla) {
            Island::firstOrCreate(['name' => $isla]);
        }
    }
}
