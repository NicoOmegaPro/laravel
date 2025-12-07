<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Municipality;
use App\Models\Island;
use App\Models\Zone;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $jsonData = file_get_contents('c:\\temp\\baleartrek\\municipalities.json');
        $municipalities = json_decode($jsonData, true);
        
        foreach ($municipalities['municipis']['municipi'] as $muni) {
            Municipality::FirstOrCreate(
                [
                    'name' => $muni['Nom'],
                    'island_id' =>Island::where('name',$muni['Illa'])->value('id'),
                    'zone_id' => Zone::where('name',$muni['Zona'])->value('id')
                ]);
        }
    }
}

