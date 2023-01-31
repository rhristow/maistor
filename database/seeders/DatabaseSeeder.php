<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run() {
        // Call Seeders //
        $this->call(SystemSeeder::class);
        $this->call(UserSeeder::class);
        // END //

        // Re-enable Foreign Key Constraints //
        Schema::enableForeignKeyConstraints();
        // END //
    }
}
