<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Liste der Rollen
        $roles = [
            ['name' => 'Admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'User', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        // Einfügen der Rollen in die Datenbank
        DB::table('roles')->insert($roles);
    }
}
