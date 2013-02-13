<?php

class RulesAjoutProduit extends Elegant
{
	protected $rules = array(
			'nomp' => 'required',			
			'categorie_id' => 'numeric',
			'chemin' => 'required|image|max:5000',
			
		);
	
}