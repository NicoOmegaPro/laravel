<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Trek;
use App\Models\PlaceType;
use App\Models\InterestingPlace;

class Place_typeSeeder extends Seeder
{
    public function run(): void
    {
        $jsonData = file_get_contents('c:\\temp\\baleartrek\\places.json');
        $treks = json_decode($jsonData, true);

        foreach ($treks as $trekData) {
            $trekModel = Trek::firstOrCreate(
                ['regNumber' => $trekData['regNumber']]
            );

            foreach ($trekData['places_of_interest'] as $index => $place) {

                $ptype = PlaceType::firstOrCreate(
                    ['name' => $place['type']]
                );

                $inte = InterestingPlace::firstOrCreate(
                    ['gps' => $place['gpsPos']],
                    [
                        'name'          => $place['name'],
                        'place_type_id' => $ptype->id,
                    ]
                );

                $trekModel->interesting_places()->syncWithoutDetaching([
                    $inte->id => ['order' => $index + 1],
                ]);
            }
        }
    }
} 