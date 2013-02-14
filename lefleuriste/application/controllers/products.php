<?php

class Products_Controller extends Base_Controller {

	public $restful = true;

	public function __construct(){
        parent::__construct();
        
        //filtre pour sécuriser les pages liées à l'administration
		$this->filter('before','auth')->only(array('products','modifierprod','suppression'));
		$this->filter('before','csrf')->on('post');   
    }
	
	/**
	 * Récupère tous les produits dans la base de données et pagine le tableau
	 * @return une vue contenant les produits récupérés
	 */
	public function get_products($per_page=10){
		//récupération de tous les produits ordonnés par nom
		$products = Product::order_by('nomp')->paginate($per_page);
		
		//options de la liste déroulante des actions
		$options = array('0'=>'Choisissez une action', '1'=>'Supprimer');   
		return View::make('products.produitsadmin')->with('products',$products)->with('options',$options);
	}	
	
	/**
	 * Récupère tous les produits dans la base de données appartenant à la même catégorie
	 * @return une vue contenant les produits récupérés
	 */
	public function get_ProductByCategorie($url)
	{	
		// Si l'url n'est pas null, on récupére les produits appartenant à la catégorie dont la valeur du slug vaut $url
		if(isset($url)){ 
			//on récupère tous les produits associés à la catégorie
			$products = DB::table('products')
    			->join('categories', 'products.categorie_id', '=', 'categories.id')
    			->where('categories.slug', '=', $url)
    			->order_by('products.nomp')
    			->get();
			
			// on récupère le nom de la catégorie
			$cat= DB::table('categories')->where('categories.slug', '=', $url)->only('categories.nomc');

			//Si aucun produit n'est trouvé, on redirige le visiteur vers une page 404
			if(empty($products) && empty($cat)){
				return Response::error('404');
			}
			return View::make('products.bycategorie')->with('products',$products)->with('categorie',$cat);
		}
		// Sinon on retourne la page 404
		else{
			return Response::error('404');
		}
		
		
	}
	
	/**
	 * Modification d'un produit
	 * Affiche le formulaire dans la vue
	 * @param id l'identifiant du produit à chercher dans la base de données
	 * @return une vue contenant le produit trouvé 
	 */
	public function get_modifierProd($id=null){		
		//récupération des catégories mères
		$cat_option= Categorie::where_null('categorie_id')->lists('nomc','id');
		
		//récupération des sous catégories
		$sous_cat_option= Categorie::where_not_null('categorie_id')->lists('nomc','id');

		//Si l'id du produit n'est pas null, on récupère le produit, la catégorie à laquelle il appartient
		//Si le produit appartient à une sous catégorie, on doit aussi récupérer à la catégorie mère
		if($id){
			$prod= Product::find($id);
			$cat_prod = Categorie::find($prod->categorie_id);
			
			if ($cat_prod->categorie_id != null){
				$cat_mere = Categorie::find($cat_prod->categorie_id);
			}
			else {
				$cat_mere = $cat_prod;
			}
			return View::make('products.editproduit')->with('product',$prod)->with('cat_option',$cat_option)->with('sous_cat_option',$sous_cat_option)->with('cat_mere',$cat_mere);
		}
		else {
			return View::make('products.editproduit')->with('product',null)->with('cat_option',$cat_option)->with('sous_cat_option',$sous_cat_option);
		}
	}
	
	/**
	 * Ajout et modification d'un produit dans la base de données 
	 * Récupération des données du formulaire d'ajout et de modification d'une catégorie
	 * @return Redirige l'utilisateur vers le formulaire avec les erreurs si il y a des erreurs
	 *         Redirige vers le tableau de l'ensemble des produits sinon
	 *
	 */
	public function post_modifierProd(){
		//Dans le cas d'un ajout d'un produit, on récupère les données saisies par l'utilisateur : nouveau nom du produit, descriptif, catégorie mère, sous catégorie et chemin d'accès à l'image
		$newNomProduit = Input::get('nomp');	
		$newDesc = Input::get('descriptif');
		$newCatId = Input::get('categorie_id');			
		$newSousCatId = Input::get('sousCategorie_id');			
		$newChemin = Input::file('chemin');
		
		//Dans le cas d'une modification, on récupère l'identifiant du produit à modifier
		$id = Input::get('idprod');	
		
		//Concernant l'image, on doit se placer dans le bon dossier des images
		$directory = path('public').'images/';
		
		//On créé des rules afin de vérifier les données du formulaire en cas de modification ou d'ajout
		$rulesajout = new RulesAjoutProduit();
		$rulesmodif = new RulesModifProduit();
			
		//Dans le cas d'une modification, si les données saisies ne vérifient pas les règles de validation, des messages d'erreur s'affichent.
		if((isset($id) && $id != 'null') && !$rulesmodif->validate(Input::all()) ) { 
			//Send the $validation object to the redirected page
            return Redirect::back()->with_errors($rulesmodif->errors())->with_input();
		}
		//Dans le cas d'un ajout, si les données saisies ne vérifient pas les règles de validation, des messages d'erreur s'affichent.
		else if ((!isset($id) || $id == 'null') && !$rulesajout->validate(Input::all())){
			//Send the $validation object to the redirected page
            return Redirect::back()->with_errors($rulesajout->errors())->with_input();
		}
		
		//Si le formulaire est bien rempli, on peut modifier ou ajouter
		else {	
			if ($newChemin['error']==0){		
				// 1er recadrage de l'image téléchargée au format grande taille et sauvegarde dans le dossier images
				$success = Resizer::open( $newChemin)
				->resize( 300 , 200 , 'fit' )
				->save($directory.$newChemin['name'] , 90);
				
				// 2ieme recadrage de l'image téléchargée au format miniature et sauvegarde dans le dossier images
				$success2 = Resizer::open($newChemin)
				->resize( 100 , 66 , 'fit' )
				->save($directory.'tab-'.$newChemin['name'] , 90);
			}
			
			//si modification
			if (isset($id) && $id != null){
				//Récupération du produit
				$prod = Product::find($id);
				
				//Si on a une nouvelle image, on supprime les anciennes, la miniature et la normale et met à jour la nouvelle image
				if (($prod->chemin != $newChemin['name']) && ($newChemin['error']==0)){
					File::delete($directory.$prod->chemin);
					File::delete($directory.'tab-'.$prod->chemin);
					$prod->chemin = $newChemin['name'];	
				}
				
				// on met à jour le nom, le descriptif et la catégorie associée produit
				$prod->nomp = $newNomProduit;						
				$prod->descriptif = $newDesc;			
				$prod->categorie_id = $newCatId;			
				
				//si la sauvegarde se passe bien, on affiche un message de confirmation
				if ($prod->save()){
					Session::flash('status_success','Produit modifié avec succès.');				
				}			
				//sinon on 	affiche un message d'erreur
				else Session::flash('status_error','Le prodouit n\'a pas pu être modifié.');
			
				
				
			}
			//si on n'est pas dans la modification, on est dans l'ajout
			else{
				//Si le produit est associé à une sous catégorie, on récupère l'identifiant de celui-ci
				if ($newSousCatId != null) {
					$newId = $newSousCatId;
				}
				//Sinon, le produit est alors affecté à une catégorie mère
				else{ 
					$newId = $newCatId;
				}
				
				// on construit le tableau de données contenant les informations du nouveau produit
				$new_ajouter = array (
				'nomp' => Input::get('nomp'),   
				'descriptif' => Input::get('descriptif'),
				'categorie_id' => $newId,
				'chemin' => $newChemin['name'],
				); 
				
				//Si le tableau est bien ajouté en base, on affiche un message de confirmation
				if ($ajout = Product::create($new_ajouter)){
					Session::flash('status_success','Produit ajouté avec succès.');
					
				}
				//si le tableau n'est pas inséré en base, on affiche un message d'erreur
				else Session::flash('status_error','Le produit n\'a pas pu être ajouté.');
			
			}
		}
		// on redirige toujour vers la liste des produits
		return Redirect::to_action('products.products');
	}

	/**
	 * Supprimer un produit
	 * @return Redirige l'utilisateur vers le tableau des produits	
	 */
	public function post_suppression(){

		//tableau qui récupère les lignes possédant des cases cochées
		$checked = Input::get('select');
		
		//recuperer le chemin pour les images
		$directory = path('public').'images/';	
		
		//compteur pour savoir si tous les produits ont été supprimés
		$compt = 0;

		//on parcourt les éléments du tableau qui ont été cochés pour pouvoir les supprimer
		for($i=0; $i<count($checked);$i++){
			$produit = Product::find($checked[$i]);
			$image = $produit->chemin;
			
			// on supprime les images associées au produit
			if($produit ->delete()){
				File::delete($directory.$image);
				File::delete($directory.'tab-'.$image);
				$compt++;
			}				
		}

		//on vérifie si les produits supprimés correspondent au numéro du compteur
		if(count($checked) == $compt and $compt != 0){
			Session::flash('status_success','Tous les produits sélectionnés ont été supprimé avec succès.');
			
		}elseif(count($checked) == $compt){
			Session::flash('status_error','Vous n\'avez pas sélectionné de produit à supprimer.');
			
		}else{
			Session::flash('status_error','Un problème est survenu lors de la suppression des produits. Veuillez réessayer.');
		}
		
		return Redirect::back();
	}	
}