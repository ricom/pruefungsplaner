<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $rooms = [
            ['name' => 'SE04', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SE05/06', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SE07', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'SE16', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S104', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S105', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S119/120', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S121', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S122', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S123', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S127', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S220', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S320', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S321', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S322', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S404/405', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S406', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S421', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'S422a', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'ME02', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'H101(Aula)', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'H102', 'capacity' => 25, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('rooms')->insert($rooms);
    }
}
