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
        $this->call('AdminTableSeeder');
        $this->command->info("Admin credentials created :)");
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
        $this->call('CusisineTypeSeeder');
        $this->command->info('Cuisine Type table created sucessfully');
        $this->call('PaymentsSeeder');
        $this->command->info("Payments table seeded :)");
        $this->call('TimeCategorySeeder');
        $this->command->info("Time category table seeded :)");

    }

}
