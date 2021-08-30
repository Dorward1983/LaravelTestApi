<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Users seeder
        $super_admin = [
            'name' => 'devtask',
            'email' => 'devtask@example.com',
            'client_id' => 'devtask',
        ];
        $super_admin_password = Hash::make('Ye97T%c!CGZ*7$52');
        if ($super_admin_password) {
            $super_admin['password'] = $super_admin_password;
        }

        $user = User::factory()->create($super_admin);
    }
}
