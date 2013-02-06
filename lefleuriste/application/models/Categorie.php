<?php

class Categorie extends Eloquent{

	public static $timestamps = false;
	public function products() {
		
		return $this->has_many('Product');
	
	}
	public function categories(){
		return $this->has_many('Categorie');
	}

}