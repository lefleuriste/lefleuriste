<?php

class RulesUser extends Elegant
{
	protected $rules = array(
			'username' => 'required',
    		'password' => 'required',
			'password2' => 'required|same:password',
		);
}