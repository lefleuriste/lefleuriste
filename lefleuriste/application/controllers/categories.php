<?php

class Categories_Controller extends Base_Controller {

	public $restful = true;
	
	/**
	 * Récupération de toutes les catégories
	 * @return une vue contenant les catégories
	 */
	public function get_categories() {
			$categories = categorie::order_by('categorie_id','asc')->get();
                        $cat_option = Categorie::lists('nomc','categorie_id');
			return View::make('categories.categorieAdmin')->with('categories',$categories)->with('cat_option',$cat_option);
	}

	/**
	 * Récupération la liste de sous catégories 
	 * Utilisé pour les listes liées dynamiques dans l'ajout et la modification d'un produit
	 * @param id l'identifiant de la catégorie à chercher dans la base de données
	 * @return un tableau contenant les sous catégories
	 */
	public function get_listeSousCategories($id=null) {		
		$categories = DB::query('SELECT id, nomc FROM categories WHERE categorie_id=?',array($id));
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
	
	/**
	 * Modification d'une catégorie
	 * Affiche le formulaire dans la vue
	 * @param id l'identifiant de la catégorie à chercher dans la base de données
	 * @return une vue contenant la catégorie trouvée ou pas sur la base de données
	 */
	public function get_modifierCat($id=null){
            

            $cat_option = Categorie::where_null('categorie_id')->lists('nomc','id');
            array_unshift($cat_option, '');          
            if($id != null){
				$cat= Categorie::find($id);		
				return View::make('categories.editCategorie')->with('categorie',$cat)->with('cat_option',$cat_option);
			}
			else {

			return View::make('categories.editCategorie')->with('categorie',null)->with('cat_option',$cat_option);
			}
	}
	
	/**
	 * Ajout et modification d'une catégorie dans la base de données 
	 * Récupération des données du formulaire d'ajout et de modification d'une catégorie
	 * @return Redirige l'utilisateur vers le formulaire avec les erreurs si il y a des erreurs
	 *         Redirige vers le tableau de l'ensemble des catégories sinon
	 *
	 */
	public function post_modifierCat(){
		
		$newNomCategorie = Input::get('Categorie');
		
		//$newCategorieMere = Input::get('categorie_id');
		$id = Input::get('idcat');
		$rules = new RulesCategorie();
		        
		//Check if the validation succeeded
		if(!$rules->validate(Input::all()) ) {
			//Send the $validation object to the redirected page
           	return Redirect::back()->with_errors($rules->errors())->with_input();
		}
		//si on n'a pas d'errors on continue
		else {	

                    //modification d'une catégorie
                    // on vérifie l'unicité du nom de la catégorie
                    $catExist=Categorie::where('nomc','=',$newNomCategorie)->where('id','!=',$id)->get();
                    if(!empty($catExist))
                    {
                      Session::flash('status_error','Cette catégorie existe déjà');
                      return Redirect::back(); 
                    }
                    
                    //si on choisit la case vide le champs categorie_id doit etre null 
                    if(Input::get('categorie_id')==0)
                    {    
                        //on vérifie le nombre de catégorie limité à 4  
                        $nbCat = Categorie::where_null('categorie_id')->count();
                        if($nbCat>=4)
                        {
                            Session::flash('status_error','Le nombre de catégorie est limité à 4, vous n\'avez plus le droit d\'en ajouter.');
                            return Redirect::back();;
                        }
                        $newcatID=Null; 
                     }
                     else{
                         $newcatID=Input::get('categorie_id');
                         
                       
                     }

                    if (isset($id) && $id != null){
			//modification d'une catégoriecho 'OK';
                     
                         $cat = Categorie::find($id);
			if (isset($newNomCategorie) && !empty($newNomCategorie)){

				
			 }
			 else{
				 //sinon on recupere la cle etranger de la sous categorie
				 $newcatID=Input::get('categorie_id');
				 
			   
			 }
			 
			//modification d'une catégorie;
			if (isset($id) && $id != null){		
				//recuperer tout les categories avec le id = $id		 
				$cat = Categorie::find($id);
				//tester si le champ categorie est bien rempli
				if (isset($newNomCategorie) && !empty($newNomCategorie)){
					//si bien rempli on le modifie dans la base de donnees
					$cat->nom = $newNomCategorie;
					$cat->save();
								
				}
				//si la list roulant des sous categories est rempli
				if (isset($newcatID) && !empty($newcatID)){
					//on modifie dans la base de donnees
					$cat->categorie_id = $newcatID;
					$cat->save();
				}
			}
			
			//ajout d'une catégorie
			else {	
			
				// on vérifie l'unicité du nom de la catégorie		
				$catExist=Categorie::where('nom','=',$newNomCategorie)->get();
				//si on choisit la case vide le champs categorie_id doit etre null 
				if(Input::get('categorie_id')==0)
				{    
					$newcatID=Null;
					//on vérifie le nombre de catégorie limité à 4  
					$nbCat = Categorie::where_null('categorie_id')->count();
					if($nbCat>=4)
					{
						Session::flash('status_error','Le nombre de catégorie est limité à 4, vous n\'avez plus le droit d\'en ajouter.');
						return Redirect::back();;
					}
					
				 }
				 else{
					 $newcatID=Input::get('categorie_id');
				 }
				//ajouter dans la base de donnees le nouvelle categorie 
				$new_cat = array (
					'nom' => Input::get('Categorie'),
					'categorie_id' => $newcatID,			
				);
		
				if ($cat = Categorie::create($new_cat)){
					return Redirect::to_action('categories/categories');
				}
				else {
					Session::flash('status_error','La catégorie n\'a pas pu être ajoutée');
				}		
				
			}

                    }
		
		
		else {
                    //ajout d'une catégorie
                    
                    $catExist=Categorie::where('nomc','=',$newNomCategorie)->get();
                     // on vérifie l'unicité du nom de la catégorie
                    if(!empty($catExist))
                    {
                      Session::flash('status_error','Cette catégorie existe déjà');
                      return Redirect::back(); 
                    }
                    
                    //si on choisit la case vide le champs categorie_id doit etre null 
                    if(Input::get('categorie_id')==0)
                    {    
                        //on vérifie le nombre de catégorie limité à 4  
                        $nbCat = Categorie::where_null('categorie_id')->count();
                        if($nbCat>=4)
                        {
                            Session::flash('status_error','Le nombre de catégorie est limité à 4, vous n\'avez plus le droit d\'en ajouter.');
                            return Redirect::back();;
                        }
                        $newcatID=Null;
                     }
                     else{
                         $newcatID=Input::get('categorie_id');
                     }
                     
                    $new_cat = array (
                        'nomc' => Input::get('Categorie'),
			'categorie_id' => $newcatID,			
                    );
			
                    if ($cat = Categorie::create($new_cat)){
			return Redirect::to_action('categories/categories');
                    }
                    else {
			Session::flash('status_error','La catégorie n\'a pas pu être ajoutée');
                    }		

		}
		
		return Redirect::to_action('categories/categories');
		
	}
	
	
	/**
	 * Supprimer une catégorie 
	 * Attention !! Tous les produits de la catégories seront supprimés
	 * @return Redirige l'utilisateur vers le tableau des catégories	
	 */
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
		if(count($checked) == $compt and $compt != 0){
			Session::flash('status_success','Toutes les catégories ont été supprimées avec succès.');
		
		}elseif(count($checked) == $compt){
			Session::flash('status_error','Vous n\'avez pas sélectionné de catégories à supprimer. Veuillez réessayer.');
			
		}else{
			Session::flash('status_error','Un problème est survenu lors de la suppression des catégories. Veuillez réessayer.');
		}

		return Redirect::back();
	}
	
}