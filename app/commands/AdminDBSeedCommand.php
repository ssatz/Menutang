<?php

use Illuminate\Console\Command;

class AdminDBSeedCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:menutang-seeder';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'menutang  Seeder';

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
        DB::statement('TRUNCATE admins');
        $admin = Admin::create(array(
            'email' => 'senseionlinefoodservices@gmail.com',
            'password' => Hash::make('Sarosatz123$'),
            'mobile' => 9894331102
        ));
        $this->info("Admin credentials created");
        $buType =  BusinessType::insert($this->businessType());
        $this->info('Business Type Created');
        CuisineType::insert($this->cuisineType());
        $this->info('Cuisine Type Created');


	}

    protected function businessType()
    {
       return $data = [
            [
                'business_code'=>'RES',
                'business_type'=>'Restaurant'
            ],
            [
                'business_code'=>'CAK',
                'business_type'=>'Cake Shop'
            ]
        ];
    }

    protected function cuisineType()
    {
        return $data = [
            [
                'business_type_id'=>1,
                'cuisine_code'=>'Indian',
                'cuisine_description'=>'Indian'
            ],
            [
                'business_type_id'=>1,
                'cuisine_code'=>'Punjabi',
                'cuisine_description'=>'Punjabi'
            ],
            [
                'business_type_id'=>1,
                'cuisine_code'=>'Chinese',
                'cuisine_description'=>'Chinese'
            ],
            [
                'business_type_id'=>1,
                'cuisine_code'=>'Veg',
                'cuisine_description'=>'Veg Restaurant'
            ],
            [
                'business_type_id'=>1,
                'cuisine_code'=>'Non-Veg',
                'cuisine_description'=>'Non-Veg Restaurant'
            ],

        ];
    }
}
