<?php

class Products_Controller extends Base_Controller {

	public $restful = true;
	public function __construct(){
        parent::__construct();
        
		$this->filter('before','csrf')->on('post');   
    }
	
	/**
	 * Récupère tous les produits dans la base de données et pagine le tableau
	 * @return une vue contenant les produits récupérés
	 */
	public function get_products($per_page=5){
		
		$products = Product::order_by('nomp')->paginate($per_page);

		return View::make('products.produitsAdmin')->with('products',$products);
	}	
		
	public function get_ProductByCategorie($url, $id = null, $per_page=10)
	{	
		$products = Product::where('categorie_id', '=',$id)->order_by('nomp')->paginate($per_page);		
		$cat= Categorie::find($id);
		return View::make('products.bycategorie')->with('products',$products)->with('categorie',$cat);
	}
	
	public function get_modifierProd($id=null){		
		
		$cat_option= Categorie::where_null('categorie_id')->lists('nomc','id');
		if($id){
			$prod= Product::find($id);		
			return View::make('products.editProduit')->with('product',$prod)->with('cat_option',$cat_option);
		}
		else {
			return View::make('products.editProduit')->with('product',null)->with('cat_option',$cat_option);
		}
	}
	
	
	public function post_modifierProd(){
	  	
		
		$newNomProduit = Input::get('nomp');		
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
		else {
			// recadrage d'image et sauvegard dans le dossier images
			$success = Resizer::open( $newChemin)
    		->resize( 300 , 200 , 'fit' )
    		->save($directory.$newChemin['name'] , 90);
		
		//si modification
		if (isset($id) && $id != null){
			
			$prod = Product::find($id);		
			
			$prod->nom_product = $newNomProduit;						
			$prod->descriptif = $newDesc;			
			$prod->categorie_id = $newCatId;			
			$prod->chemin = $newChemin['name'];			
			$prod->save();
			
		}
		//si ajout
		else{
						
			$new_ajouter = array (
			'nom_product' => Input::get('nomp'),        	
			'descriptif' => Input::get('descriptif'),
        	'categorie_id' => Input::get('categorie_id'),
			'chemin' => $newChemin['name'],
        	
			);
			//si bien ajouté
			if ($ajout = Product::create($new_ajouter)){
				Session::flash('status_success','Produit ajouté avec succès');
				
			}
			//sinon
			else Session::flash('status_error','Le produit n\'a pas pu être ajouté');
		
			}
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