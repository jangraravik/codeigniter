<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_ctl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_mdl');
		$this->load->library('faker');
		$this->faker = Faker\Factory::create();
	}

	public function index()
	{
		$this->home();
	}

	public function home()
	{
		echo "Test URL <bt>";
		//echo $this->faker->unique()->userName;
		//echo $this->faker->imageUrl(200, 200, 'cats', true, 'Faker');
		//$this->faker->image('uploads',1600,1200);
	}

   public function seed()
    {
        $this->_truncate_table();
        $this->_feed_faker_data(100);
    }	

    private function _truncate_table()
    {
        $this->user_mdl->cleanTable();
    }

	private function _feed_faker_data($limit)
	{
		// create a fake reord of user accounts
		// Values https://github.com/fzaninotto/Faker
		for ($i = 0; $i < $limit; $i++) {         
			$data = array(
				'username' => $this->faker->unique()->userName, // get a unique nickname
				'password' => md5('12345'), // run this via your password hashing function
				'firstname' => $this->faker->firstName,
				'lastname' => $this->faker->lastName,
				'gender' => rand(0, 1) ? 'male' : 'female',
				'bio' => $this->faker->text($maxNbChars = 500),
				'address' => $this->faker->streetAddress,
				'city' => $this->faker->city,
				'state' => $this->faker->state,
				'country' => $this->faker->country,
				'postcode' => $this->faker->postcode,
				'email' => $this->faker->email,
				'email_verified' => mt_rand(0, 1) ? '0' : '1',
				'phone' => $this->faker->phoneNumber,
				'birth_date' => $this->faker->dateTimeThisCentury->format('Y-m-d H:i:s'),
				'registration_date' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
				'ip_address' => mt_rand(0, 1) ? $this->faker->ipv4 : $this->faker->ipv6,
				'active' => $i === 0 ? true : rand(0, 1),
			);
			$this->user_mdl->insert($data);
		}
	}
}
