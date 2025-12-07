<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use App\Models\User;
use App\Models\Comment;
use App\Models\Image;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            // Seeders / JSON
            $this->command->info('Executant Seeders ...');
            $this->call(RoleSeeder::class);
            $this->call(UserSeeder::class);
            $this->call(ImageSeeder::class);
            $this->call(ZoneSeeder::class);
            $this->call(IslandSeeder::class);
            $this->call(MunicipalitySeeder::class);
            $this->call(TrekSeeder::class);
            $this->call(Place_typeSeeder::class);
            
            


            // Factories
            $this->command->info('Executant Factories ...');
            User::factory(100)->create();
            Image::factory(1000)->create();
            $this->call(MeetingSeeder::class);
        } catch (\Exception $e) {
            $this->command->error("Error durant l'execució dels seeders: " . $e->getMessage());
        }
    }
}