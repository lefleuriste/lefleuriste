<?php

class RulesCategorie extends Elegant
{
	protected $rules = array(
			'nomCategorie' => 'required|alpha_num',
			'image' => 'required|alpha',
		);
}