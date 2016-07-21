<?php

$config = [

'login' => [
	['field'=>'username','label'=>'User Name','rules'=>'required|trim|valid_email'],
	['field'=>'password','label'=>'Password','rules'=>'required|trim']
],
'register' => [
	['field'=>'first_name','label'=>'First Name','rules'=>'required|alpha|trim'],
	['field'=>'last_name','label'=>'Last Name','rules'=>'required|alpha|trim'],
	['field'=>'email','label'=>'Email Address','rules'=>'required|trim|valid_email|is_unique[persons.email]',
			'errors'=>['is_unique' => 'The email is already registered you can <a href="reset">reset</a> account password']],
	['field'=>'password','label'=>'Password','rules'=>'required|trim|min_length[8]|max_length[16]'],
	['field'=>'passwordconf','label'=>'Password Confirmation','rules'=>'required|matches[password]']
]
];