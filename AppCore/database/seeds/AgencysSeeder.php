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
              'name_agency' => 'Logros C.A',
              'rut' => '020613019',
              'local_agency' => '02128708065',
              'tlf_agency' => '04120909876',
              'desc_sociality' => 'Empresa de seguridad',
              'email' => 'abenitez.freelance@gmail.com',
              'email_verified' => 0,
              'email_verified_at' => 0,
              'country' => 95,
              'state' => 1684,
              'password' => bcrypt('123456'),
              'address' => 'Venezuela / Caracas ',
              'is_active' => 0, 
              'is_admin' => 0, 
              'is_superadmin' => 0, 
              'type' => 0, 
              'remember_token' => 'z7cvsvKf9zGTHwU62Ap0Rd1Btr7dSwbKLcBAk7rM5KbGRTwFc1gsVxMkefvN',
              'created_at' => NULL,
              'updated_at' => NULL
            ],
        
        ]);
    }
}
