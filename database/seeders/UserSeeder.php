<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Array of users data
        $usersData = [
            [
                'name'           => 'Admin One',
                'email'          => 'admin1@gmail.com',
                'password'       => 'password',
                'account_suffix' => '9',
            ],
            [
                'name'           => 'Admin Two',
                'email'          => 'admin2@gmail.com',
                'password'       => 'password',
                'account_suffix' => '1',
            ],
        ];

        foreach ($usersData as $userData) {
            // Create User
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
            ]);

            // Create the account for the user
            $user->account()->create([
                'account_number' => '123456789' . $userData['account_suffix'],
                'balance' => 100,
            ]);
        }
    }
}
