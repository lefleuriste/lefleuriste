<?php

class Products_Controller extends Base_Controller {

	public $restful = true;
	public function __construct(){
        parent::__construct();
        
		$this->filter('before','csrf')->on('post');   
    }
	
	public function get_products(){
		
		$products = Product::all();
		return View::make('products.produitsAdmin')->with('products',$products);
	}
	
	public function get_index()
	{	
		$products = Product::all();
		return View::make('products.index')->with('products',$products);
	}
	
	public function get_ProductByCategorie($url, $id = null)
	{	
		$products = Categorie::find($id)->products;
		$cat= Categorie::find($id);
		return View::make('products.bycategorie')->with('products',$products)->with('categorie',$cat);
	}
	
	public function get_modifierProd($id=null){		
		
		$cat_option= Categorie::where_null('categorie_id')->lists('nom','id');
		$sous_cat_option= Categorie::where_not_null('categorie_id')->lists('nom','id');
		if($id){
			$prod= Product::find($id);		
			return View::make('products.editProduit')->with('product',$prod)->with('cat_option',$cat_option)->with('sous_cat_option',$sous_cat_option);
		}
		else {
			return View::make('products.editProduit')->with('product',null)->with('cat_option',$cat_option)->with('sous_cat_option',$sous_cat_option);
		}
	}
	
	
	public function post_modifierProd(){
	  	
		
		$newNomProduit = Input::get('nom');		
		$newDesc = Input::get('descriptif');
		$newCatId = Input::get('categorie_id');			
		$newSousCatId = Input::get('sousCategorie_id');			
		$newChemin = Input::file('chemin');			
		$id = Input::get('idprod');	
		$directory = path('public').'images/';	
		$rules = new RulesAjoutProduit();		
		
		//Check if the validation succeeded
		if(!$rules->validate(Input::all()) ) {
			//Send the $validation object to the redirected page
            return Redirect::back()->with_errors($rules->errors())->with_input();
		}
		else 
			// recadrage d'image et sauvegard dans le dossier images
			$success = Resizer::open( $newChemin)
    		->resize( 300 , 200 , 'fit' )
    		->save($directory.$newChemin['name'] , 90);
		
		//si modification
		if (isset($id) && $id != null){
			
			$prod = Product::find($id);		
			
			$prod->nom = $newNomProduit;						
			$prod->descriptif = $newDesc;			
			$prod->categorie_id = $newCatId;			
			$prod->chemin = $newChemin['name'];			
			$prod->save();
			
		}
		//si ajout
		else{
			if ($newSousCatId != null) {
				$newId = $newSousCatId;
			}
			else{ 
				$newId = $newCatId;
			}
					
			$new_ajouter = array (
			'nom' => Input::get('nom'),        	
			'descriptif' => Input::get('descriptif'),
        	'categorie_id' => $newId,
			'chemin' => $newChemin['name'],
			);
			//si bien ajouté
			if ($ajout = Product::create($new_ajouter)){
				Session::flash('status_success','Produit ajouté avec succès');
				
			}
			//sinon
			else Session::flash('status_error','Le produit n\'a pas pu être ajouté');
		
			}
		return Redirect::to_action('products@products');
	 
	}


	public function post_suppression(){

		//tableau qui récupère les cases à cocher
		$checked = Input::get('select');
		//recuperer le chemin pour les images
		$directory = path('public').'images/';	
		
		//compteur pour savoir si tous les produits ont été supprimés
		$compt = 0;

		//on parcourt les éléments du tableau
		for($i=0; $i<count($checked);$i++){
			$produit = Product::find($checked[$i]);
			$image = $produit->chemin;
			if($produit ->delete()){
				File::delete($directory.$image);
				$compt++;
			}				
		}

		//on vérifie si les produits supprimés correspondent au numéro du compteur
		if(count($checked) == $compt and $compt != 0){
			Session::flash('status_success','Tous les produits ont été supprimés avec succès.');
			
		}elseif(count($checked) == $compt){
			Session::flash('status_error','Vous n\'avez pas sélectionné de produits à supprimer. Veuillez réessayer.');
			
		}else{
			Session::flash('status_error','Un problème est survenu lors de la suppression des produits. Veuillez réessayer.');
		}
		
		return Redirect::back();
	}
		
}