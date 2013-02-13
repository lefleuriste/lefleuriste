<?php

class Categories_Controller extends Base_Controller {

	public $restful = true;

	public function __construct(){
        parent::__construct();
        
        //filtre pour sécuriser les pages liées à l'administration
		$this->filter('before','auth')->only(array('categories','listeSousCategories','modifierCat','suppression'));
		$this->filter('before','csrf')->on('post');   
    }
	
	/**
	 * Récupération de toutes les catégories
	 * @return une vue contenant les catégories
	 */

	public function get_categories($per_page=4) {

		$categories = Categorie::order_by('categorie_id')->paginate($per_page); 
		//options de la liste déroulante des actions
		$options = array('0'=>'Choisissez une action', '1'=>'Supprimer');       
		return View::make('categories.categorieAdmin')->with('categories',$categories)->with('options',$options); 

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
				'error'=> "Il n'y a pas de sous catégorie liée à cette catégorie."
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
		//recupere les input //
		$newNomCategorie = Input::get('Categorie');
		$newcatMereID = Input::get('categorie_id');
		$id = Input::get('idcat');
		$select_cat_id = Input::get('categorie_id');
		
		//****************** //
		
		//recupere les rules
		$rules = new RulesCategorie();	
		
		//recupere le nom de la categorie
		$catExist=Categorie::where('nomc','=',$newNomCategorie)->where('id','!=',$id)->get();

		//Check if the validation succeeded
		if(!$rules->validate(Input::all()) ) {
			//Send the $validation object to the redirected page
        	return Redirect::back()->with_errors($rules->errors())->with_input();
		}

		//si on n'a pas d'errors on continue
		else {	
                    
                    //si on choisit la case vide le champs categorie_id doit etre null 
                    if(Input::get('categorie_id')==0)
                    {    
                        $newcatMereID=NULL; 
                     }
                    else{
					
                        $position=Input::get('categorie_id');
						
						// on va récupérer l'id de la catégorie situé à la position $position de l'array cat_option
						$cat_option = Categorie::where_null('categorie_id')->lists('nomc','id');				
						$compt=1;
						foreach($cat_option as $n => $i){
							if($compt == $position){
								$newcatMereID = $n;
							}
							$compt++;
						}
                     }
					
					
					//modification d'une catégorie;
					if (isset($id) && $id != null){	
						
						//on récupère le nombre de catégorie mère
                        $nbCat = Categorie::where_null('categorie_id')->count();
						
						//on vérifie que la catégorie à modifier est une catégorie fille
						$estCatFille = Categorie::where_not_null('categorie_id')->where('id','=',$id)->get();
						
						//Si une catégorie fille devient mere alors qu'il y a deja 4 categorie mere => message d'erreur
						if($nbCat>=4 && !empty($estCatFille) && $newcatMereID == NULL)
                        {
                            Session::flash('status_error','Nombre maximum de catégorie mère atteinte.');
                            return Redirect::back();;
                        }
						
						// on vérifie l'unicité du nom de la catégorie
						$catExist=Categorie::where('nomc','=',$newNomCategorie)->where('id','!=',$id)->get();
						if(!empty($catExist))
						{
							Session::flash('status_error','Ce nom de catégorie existe déjà.');
							return Redirect::back(); 
						}
					
					    //recuperer tout les categories avec le id = $id		 
				        $cat = Categorie::find($id);
				        //tester si le champ categorie est bien rempli
				        if (isset($newNomCategorie) && !empty($newNomCategorie)){
					        //si bien rempli on le modifie dans la base de donnees
							$cat->nomc = $newNomCategorie;
							$cat->save();
				        }
						// modification de la catégorie mere
					    $cat->categorie_id = $newcatMereID;
					    $cat->save();
						
						//on affiche un message de confirmation d'ajout puis on redirige
						Session::flash('status_success','Catégorie modifiée avec succès.');
						return Redirect::to_action('categories/categories');
					}
			
			        //ajout d'une catégorie
			        else {	
			
						//si on choisit la case vide le champs categorie_id doit etre null 			
						if(Input::get('categorie_id')==0)
						{    
							//on vérifie le nombre de catégorie limité à 4  
							$nbCat = Categorie::where_null('categorie_id')->count();
							if($nbCat>=4){
								Session::flash('status_error','Nombre maximum de catégorie mère atteinte.');
								return Redirect::back();;
							}
							$newcatMereID=Null;
						}
						else{
							$newcatMereID=Input::get('categorie_id');
						}
						
						// on vérifie l'unicité du nom de la catégorie
						$catExist=Categorie::where('nomc','=',$newNomCategorie)->get();
                    
						if(!empty($catExist)){
							Session::flash('status_error','Ce nom de catégorie existe déjà.');
							return Redirect::back(); 
						}
						
						//ajouter dans la base de donnees le nouvelle categorie 
						$new_cat = array (
						'nomc' => Input::get('Categorie'),
						'categorie_id' => $newcatMereID,			
						);
		
						if ($cat = Categorie::create($new_cat)){
							//on affiche un message de confirmation d'ajout puis on redirige
							Session::flash('status_success','Catégorie ajoutée avec succès.');
							return Redirect::to_action('categories/categories');
						}
						else {
							Session::flash('status_error','La catégorie n\'a pas pu être ajoutée.');
						}		
					}
					return Redirect::to_action('categories/categories');
			}//fin else	
	}// fin fonction
	
			
	
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
			// on récupére la catégorie avec son identifiant
			$catEnCours = Categorie::find($checked[$i]);
			if(!empty($catEnCours)){
				//on récupère les filles
				$catFilles = Categorie::where('categorie_id','=',$catEnCours->id)->get();
				
				//on supprime toutes les filles
				foreach($catFilles as $cf){
					$cf->delete();
				}
				
				//on supprime la mere
				$catEnCours->delete();
				
				// on incrémente le compteur
				$compt++;
			}				
		}

		//on vérifie si les catégories supprimés correspondent au numéro du compteur
		if(count($checked) == $compt and $compt != 0){
			Session::flash('status_success','Toutes les catégories sélectionnées ont été supprimé avec succès.');
		
		}elseif(count($checked) == $compt){
			Session::flash('status_error','Vous n\'avez pas sélectionné de catégorie à supprimer.');
			
		}else{
			Session::flash('status_error','Un problème est survenu lors de la suppression des catégories. Veuillez réessayer.');
		}
		
		return Redirect::back();
	}
	
}