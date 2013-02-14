<?php

class Admin_Controller extends Base_Controller {

	public $restful = true;
	
	public function __construct(){
        parent::__construct();
        
        //filtre pour sécuriser les pages liées à l'administration
		$this->filter('before','auth')->only(array('index','modifiermdp'));
		$this->filter('before','csrf')->on('post');   
    }
	
	
	/**
	 * Récupération de la page principal de l'administration
	 * @return une vue contenant la page admin
	 */
	
	public function get_index()
	{
		//on appelle la page d'accueil de l'admin
		return View::make('admin.index');
	}
	
	
	/**
	 * Récupération de la page pour modifier le compte admin
	 * modification de mot de pass
	 * modification d'user
	 * @return une vue contenant la page de modification
	 */

	public function get_modifierMdp()
	{	
		// on récupére les info concernant l'admin
		$users = User::find(1);
		return View::make('admin.editPassword')->with('users',$users);	
	}
	
	/**
	 * Modification du compte administrateur
	 * modification de mot de pass
	 * modification d'user
	 * @return Redirige l'utilisateur vers le formulaire avec les erreurs si il y a des erreurs
	 *         Redirige vers la page principal d'administration
	 */
	
	public function post_modifierMdp()
	{
		$rules = new RulesUser();	
		//on vérifie que ce qui a été saisie au niveau du formulaire de modification est correcte
		if(!$rules->validate(Input::all()) ) {
			//Si ce n'est pas correcte, on affiche les champs erronés
            return Redirect::back()->with_errors($rules->errors())->with_input();
		}
		else{
			// on récupère les infos de l'admin	
			$users = User::find(1);
			
			//on modifie le champ username et passeword
			$users->username=Input::get('username');
			$users->password=Hash::make(Input::get('password'));
			$users->save();
       	 	
			//on affiche un message de confirmation de modification
			Session::flash('status_success','Modifications réalisées avec succès.');
			
			//on redirige vers la page d'accueil de l'admin
			return Redirect::to_action('admin.index');

			} 
	}//fin function post_modifier

}//fin controller
