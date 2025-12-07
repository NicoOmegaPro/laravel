<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trek;
use App\Models\Municipality;
use App\Models\Meeting;
use App\Models\Comment;
use App\Models\User;

class TrekSeeder extends Seeder
{

    public function run(): void
    {
        $jsonData = file_get_contents('c:\\temp\\baleartrek\\treks.json');
        $treks = json_decode($jsonData, true);

        foreach ($treks as $trek) {

            $trekModel = Trek::firstOrCreate(
                [
                    'regNumber' => $trek['regNumber'],
                ],
                [
                    'name'            => $trek['name'],
                    'municipality_id' => Municipality::where('name', $trek['municipality'])->value('id')
                ]
            );


            foreach ($trek['meetings'] as $m) {
                $dniUserM = User::where('dni', $m['DNI'])->firstOrFail();

                if (!$dniUserM) {
                    $dniUserM = User::where('email', '@admin@baleartrek.com')->value('id');
                }

                $meetingModel = Meeting::firstOrCreate(
                    [
                        'trek_id' => $trekModel->id,
                        'day'     => $m['day'],
                        'hour'    => $m['time'],
                        'user_id'     => $dniUserM->id,
                        'appDateIni' => now(),
                    ]
                );

                foreach ($m['comments'] as $c) {
                    $dniUserC = User::where('dni', $c['DNI'])->firstOrFail();
                    Comment::firstOrCreate(
                        [
                            'meeting_id' => $meetingModel->id,
                            'user_id'        => $dniUserC->id,
                            'comment'    => $c['comment'],
                            'score'      => $c['score'],
                        ]
                    );
                }
            }
        }
    }
}
