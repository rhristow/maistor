<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SystemSeeder extends Seeder
{
    public function run() {
        // System - Countries //
        DB::unprepared(file_get_contents('database/sql/system_countries.sql'));
        $this->command->info('System - Countries imported.');
        // END //
    }
}
