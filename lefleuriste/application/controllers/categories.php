<?php

class Categories_Controller extends Base_Controller {

	public $restful = true;
	
	public function get_categories() {
			$categories = categorie::all();
			return View::make('categories.categorieAdmin')->with('categories',$categories);
		}

	public function get_listeSousCategories($id=null) {		
		$categories = DB::query('SELECT id, nom FROM categories WHERE categorie_id=?',array($id));
		if(empty($categories)){
			$return = array(
				'error'=> "Il n'y a pas de sous catégories liées à cette catégorie"
			);
		}else{
			$return = array(
				'error'=> false,
				'results'=> $categories
			);

		}		
		return Response::json($return);
	}
	
	public function get_modifierCat($id=null){
		if($id != null){
			$cat= Categorie::find($id);		
			return View::make('categories.editCategorie')->with('categorie',$cat);
		}
		else {
			return View::make('categories.editCategorie')->with('categorie',null);
		}
	}
	
	public function post_modifierCat(){
		$newNomCategorie = Input::get('nomCategorie');
		$newImage = Input::get('image');
		$id = Input::get('idcat');
		$rules = new RulesCategorie();
		
		//Check if the validation succeeded
		if(!$rules->validate(Input::all()) ) {
			//Send the $validation object to the redirected page
            return Redirect::back()->with_errors($rules->errors())->with_input();
		}
		
		else if (isset($id) && $id != null){
			//modification d'une catégorie
			$cat = Categorie::find($id);
		
			if (isset($newNomCategorie) && !empty($newNomCategorie)){
				$cat->nom_categorie = $newNomCategorie;
				$cat->url = Str::slug($newNomCategorie, '-');
				$cat->save();
			}
			
			if (isset($newImage) && !empty($newImage)){
				$cat->image = $newImage;
				$cat->save();
			}
		}
		
		else {
			//ajout d'une catégorie
			$new_cat = array (
				'nom_categorie' => Input::get('nomCategorie'),
				'image' => Input::get('image'),
				'url' => Str::slug(Input::get('nomCategorie'), '-'),
			);
			
			if ($cat = Categorie::create($new_cat)){
					return Redirect::to_action('categories\categories');
				}
			else {
					Session::flash('status_error','La catégorie n\'a pas pu être ajoutée');
				}		
			
		}
		
		return Redirect::to_action('categories/categories');
		
	}
	
	
	
	public function post_suppression(){

		//tableau qui récupère les cases à cocher
		$checked = Input::get('select');

		//compteur pour savoir si tous les produits ont été supprimés
		$compt = 0;

		//on parcourt les éléments du tableau
		for($i=0; $i<count($checked);$i++){
			if(Categorie::find($checked[$i])->delete()){
				$compt++;
			}				
		}

		//on vérifie si les catégories supprimés correspondent au numéro du compteur
		if(count($checked) == $compt){
			Session::flash('status_success','Toutes les catégories ont été supprimées avec succès.');
			
		}else{
			Session::flash('status_error','Un problème est survenu lors de la suppression des catégories. Veuillez réésayer.');
			
		}
		return Redirect::back();
	}
	
}