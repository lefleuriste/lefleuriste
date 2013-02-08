<?php

class RulesAjoutProduit extends Elegant
{
	protected $rules = array(
			'nomp' => 'required',
			
			'descriptif' => 'required',
			'categorie_id' => 'numeric',
			'chemin' => 'image|max:5000',
			
		);
}