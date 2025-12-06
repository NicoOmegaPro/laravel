<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::UpdateOrCreate(
            [
                $admin = new User(),
                $admin->name = "admin",
                $admin->lastName = "admin",
                $admin->email = "admin@baleartrek.com",
                $admin->phone = "777777777",
                $admin->password = bcrypt('12345678'), //Contraseña encriptada, "Bycryp".
                $admin->role_id = Role::where('name', 'admin')->value('id'),
            ]
        );
        // Des d'un arxiu JSON
        $jsonData = file_get_contents('c:\\temp\\blog\\user.json');
        $users = json_decode($jsonData, true);

        // Insertar cada registro en la tabla
        foreach ($users['usuaris']['usuari'] as $user) {
            User::UpdateOrCreate(
                [
                    'dni' => $user['dni]'],
                    'email' => $user['email]'],
                ],


                [
                    'name' => $user['name]'],
                    'lastName' => $user['lastName]'],
                    'email_verifies_at' => $user['email_verifies_at]'],
                    'phone' => $user['phone]'],
                    'passwd' => $user['passwd]'],
                    'role_id' => $user['role_id]'],
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
