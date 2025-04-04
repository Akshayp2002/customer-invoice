<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;



class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $usersData = [
            ['name' => 'John Doe', 'email' => 'john.doe@gmail.com'],
            ['name' => 'Jane Smith', 'email' => 'jane.smith@gmail.com'],
            ['name' => 'Alice Brown', 'email' => 'alice.brown@gmail.com'],
            ['name' => 'Robert White', 'email' => 'robert.white@gmail.com'],
            ['name' => 'Emily Davis', 'email' => 'emily.davis@gmail.com'],
            ['name' => 'Michael Clark', 'email' => 'michael.clark@gmail.com'],
            ['name' => 'Olivia Wilson', 'email' => 'olivia.wilson@gmail.com'],
            ['name' => 'David Lee', 'email' => 'david.lee@gmail.com'],
        ];

        foreach ($usersData as $userData) {
            // Create Customer
            $customer = Customer::create([
                'name'    => $userData['name'],
                'email'   => $userData['email'],
                'address' => $faker->address,
                'phone'   => $faker->numerify('9#########'),
            ]);

            // Create an Invoice for the customer
            $customer->invoices()->create([
                'amount' => $faker->randomFloat(2, 100, 5000),
                'date'   => $faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
                'status' => $faker->randomElement(['Unpaid', 'Paid', 'Cancelled']),
            ]);
        }
    }
}
