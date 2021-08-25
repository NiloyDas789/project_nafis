<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Nokib',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin@123'),
        ]);

        DB::table('settings')->insert([
            'company_name' => 'Test Company',
            'company_address' => 'ABC, House #5, Road #10',
            'company_city' => 'Uttara, Dhaka',
            'phone' => '000000000',
            'email' => 'abc@company.com',
            'invoice_prefix' => '#INV',
        ]);

        DB::table('customers')->insert([
            'name' => 'Walk-in Customer',
            'mobile' => '0000000000',
        ]);
    }
}
