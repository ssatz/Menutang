<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('UserTableSeeder');
        $this->command->info("Users table seeded :)");
        $this->call('BusinessSeeder');
        $this->command->info("Business table seeded :)");
        $this->call('CountryTableSeeder');
        $this->command->info("Country table seeded :)");
        $this->call('StateTableSeeder');
        $this->command->info("State table seeded :)");
        $this->call('CityTableSeeder');
        $this->command->info("City table seeded :)");
        $this->call('StatusTableSeeder');
        $this->command->info('Status Table seeded');
        $this->call('BusinessInfoSeeder');
        $this->command->info('BusinessInfo Table seeded');
        $this->call('PaymentsSeeder');
        $this->command->info("Payments table seeded :)");

    }

}
