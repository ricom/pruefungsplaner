<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $supervisors = [
            ['first_name' => null, 'last_name' => 'Bürling', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Brunßen', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Büscher', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Clausen', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Gawe', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Geschonke', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Heckeroth', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Jonitz', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Kiel', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Krupa', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Lange', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Lindeke', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Paetz', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Petrich', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Rössler', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Schulte', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Skibb', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Ströller', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Sutton', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Sturm', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Tetz', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Tiemann', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Varban', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Walther', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Westerkamp', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Wobbe', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
            ['first_name' => null, 'last_name' => 'Zwingelberg', 'email' => null, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('supervisors')->insert($supervisors);
    }
}
