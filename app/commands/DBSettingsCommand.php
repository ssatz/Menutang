<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DBSettingsCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'settings:create';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create Database Settings for menutang';

    protected $app;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($app)
	{
		parent::__construct();
        $this->app=$app;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $this->info('==== Creating Basic Settings  ===');
        $this->info('Current Enviroment: '. $this->app->environment());
	}



	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
