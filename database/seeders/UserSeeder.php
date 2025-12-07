<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
                $user = new User();
                $user->name = "ADMIN";
                $user->lastName = "ADMIN";
                $user->dni = "77777777A";
                $user->email = "admin@baleartrek.com";
                $user->email_verified_at=now();
                $user->phone = "777777777";
                $user->password = Hash::make('12345678');
                $user->role_id = Role::where('name', 'admin')->value('id');
                $user->save();
            
        
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\baleartrek\\users.json');
        $users = json_decode($jsonData, true);

        // Insertar cada registro en la tabla
        foreach ($users['usuaris']['usuari'] as $user) {
            User::FirstOrCreate(
                [
                    'dni' => $user['dni'],
                    'email' => strtolower($user['email']),
                ],


                [
                    'name' => strtoupper($user['nom']),
                    'lastName' => strtoupper($user['llinatges']),
                    'email_verified_at' => now(),
                    'phone' => $user['telefon'],
                    'password' => Hash::make($user['password']),
                    'role_id' => Role::where('name', 'guia')->value('id'),
                ]

            );
            /*
            Category::firstOrCreate(
     	          [ // Camps que s'usen per comprovar si ja existeix
    	            'title' => $category['Nom']
  	          ],
  	          [ // Camps que es creen si no existeix
   	             'url_clean' => $category['url']
  	          ]
        	);
            */
        }
    }
}
