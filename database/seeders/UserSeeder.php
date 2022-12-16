<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           
                'name' => 'Danilo Andrés',
                'lastname' => 'Carrión Lava',
                'email' => 'andrescarrion199603@gmail.com',
                'password' => Hash::make('danilo123'),
                'rol_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
    }
}
