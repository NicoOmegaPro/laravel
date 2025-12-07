<?php

namespace Database\Seeders;

use App\Models\Meeting;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    public function run(): void
    {
        $visitantRoleId = Role::where('name', 'visitant')->value('id');

        $visitantsIds = User::where('role_id', $visitantRoleId)->pluck('id');

        $meetings = Meeting::all();

        foreach ($meetings as $meeting) {
            $randomUsers = $visitantsIds->random(20);

            $meeting->Users()->attach($randomUsers);
        }
    }
}