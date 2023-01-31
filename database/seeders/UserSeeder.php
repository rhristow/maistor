<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
// Models //
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run() {
        // Users //
        User::create([
            'uuid'                  => (string) Str::uuid(),
            'email'                 => 'office@sitewab.com',
            'password'              => bcrypt('secret'),
            'name'                  => 'Martin Dinkov',
            'phoneNumber'           => '+359 87 932 6563',
            'country_id'            => 34,
            'activationKey'         => null,
            'forgottenPasswordKey'  => null
        ]);
        $this->command->info('Users seeded.');
        // END //
    }
}
