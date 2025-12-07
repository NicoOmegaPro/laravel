<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            'Centre',
            'Ponent',
            'Nord',
            'Llevant',
            'Sud',
        ];

        foreach ($zones as $zone) {
            Zone::firstOrCreate(['name' => $zone]);
        }
    }
}
