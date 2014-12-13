<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

	//	$this->call('UserTableSeeder');
	//	$this->command->info("Users table seeded :)");
	//	$this->call('BusinessSeeder');
	//	$this->command->info("Business table seeded :)");

	//	$this->call('BusinessInfoSeeder');
	//	$this->command->info("RestaurantInfo table seeded :)");

		$this->call('PaymentsSeeder');
		$this->command->info("Payments table seeded :)");

	}

}
