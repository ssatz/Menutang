<?php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Drop a current database and re-create it';

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
       $default =$this->laravel['config']['database.default'];
       $db = $this->laravel['config']['database.connections.'.$default.'.database'];
        DB::statement('DROP DATABASE '.$db);
        DB::statement('CREATE DATABASE '.$db);
        $this->info("Database($db) Dropped and Created Successfully");
	}
}
