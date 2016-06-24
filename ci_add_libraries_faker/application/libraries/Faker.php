<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faker
{
	public $faker;
	public function __construct()
	{
		require_once APPPATH.'third_party/faker/faker.php';
	}

}