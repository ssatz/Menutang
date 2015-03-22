<?php

use Illuminate\Console\Command;

class AdminDBSeedCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:admin-seeder';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Admin Seeder';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $admin = Admin::create(array(
            'email' => 'senseionlinefoodservices@gmail.com',
            'password' => Hash::make('Sarosatz123$'),
            'mobile' => 9894331102
        ));
        $this->info("Admin credentials created");
	}
}
