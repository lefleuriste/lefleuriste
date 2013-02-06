<?php

class Product extends Eloquent{	

	public static $timestamps = false;
	public function categorie() {
		
		return $this->belongs_to('Categorie');
	
	}

}