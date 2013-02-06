<?php

class Categorie extends Eloquent{

	public static $timestamps = false;
	public function products() {
		
		return $this->has_many('Product');
	
	}
	public function categories(){
		return $this->has_many('Categorie');
	}

        public function parent_categorie(){
		return $this->belongs_to('Categorie','categorie_id');
	}

	 public function child_categories()
            {
            return $this->has_many('Categorie','categorie_id');
            }
}