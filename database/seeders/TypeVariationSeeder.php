<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_variations')->insert(
            [
                [
                    'name' => 'Tamaño',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Color',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            ]

        );
    }
}
