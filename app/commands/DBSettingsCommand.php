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
	protected $name = 'settings:generate';

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
        $this->dbSettings();
        $key = $this->argument('key');
        $value = $this->option('value');
        if(!is_null($key) && !is_null($value))
        {
           $settings = DBSetting::firstOrNew(array('key' =>strtolower($key)));
           $settings->value = $value;
           $settings->save();
            $this->comment("{$key}  = {$value} created.");
        }
        $this->comment("Settings Generated successfully!!");

	}

    protected function getArguments(){
        return array(
            array('key', InputArgument::OPTIONAL, 'setting Key'),
        );
    }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('value', null, InputOption::VALUE_REQUIRED, 'Setting value', null),
		);
	}

    private function dbSettings()
    {
        $settings =[
            ['key'=>'site_name','value'=>'Menutang'],
            ['key'=>'site_url','value'=>'http://menutang.com'],
        ];
        foreach($settings as $db) {
            foreach ($db as $key => $value) {
                $settings = DBSetting::firstOrNew(array('key' =>strtolower($db['key'])));
                $settings->value = $db['value'];
                $settings->save();
            }
        }
    }

}
