<?php

class Pages_Controller extends Base_Controller {

	public $restful = true;

public function get_accueil()
	{
		return View::make('pages.accueil');
	}	
	
public function get_catalogue()
	{
		$categories = Categorie::all();
		return View::make('pages.catalogue')->with('categories',$categories);	
	}
	

public function get_contact()
	{
		return View::make('pages.contact');
	}
	
	

	
}