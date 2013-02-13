<?php

class RulesModifProduit extends Elegant
{
	protected $rules = array(
			'nomp' => 'required',			
			'categorie_id' => 'numeric',
			'chemin' => 'image|max:5000',
			
		);
	
}