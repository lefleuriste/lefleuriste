<?php

class RulesAjoutProduit extends Elegant
{
	protected $rules = array(
			'nom_product' => 'required',
			
			'descriptif' => 'required',
			'categorie_id' => 'numeric',
			'chemin' => 'required|image|max:5000',
			
		);
}