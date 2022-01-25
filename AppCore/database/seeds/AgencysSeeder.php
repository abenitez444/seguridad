<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgencysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agency')->insert([
                
            [ 'avatar' => 'user/avatar0.jpg',
              'name' => 'Logros C.A',
              'last_name' => 'Logros ',
              'rut' => '020613019',
              'local_agency' => '02128708065',
              'tlf_agency' => '04120909876',
              'desc_sociality' => 'Empresa de seguridad',
              'email' => 'abenitez.freelance@gmail.com',
              'email_verified' => 1,
              'email_verified_at' => NULL,
              'country' => 95,
              'state' => 1684,
              'password' => bcrypt('123456'),
              'address' => 'Venezuela / Caracas ',
              'is_active' => 1, 
              'is_admin' => 0, 
              'is_superadmin' => 1, 
              'type' => 0, 
              'remember_token' => Str::random(100),
              'created_at' => NULL,
              'updated_at' => '2020-02-21 10:47:22'
            ],

        ]);
    }
}
