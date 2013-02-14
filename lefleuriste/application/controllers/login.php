<?php

class Login_Controller extends Base_Controller {
    public $restful = true;

    public function __construct(){
        parent::__construct();
        
        //filtre pour sécuriser les pages liées à l'administration
		$this->filter('before','auth')->only(array('logout'));
		$this->filter('before','csrf')->on('post');   
    }
	
	/**
	 * Recuperation de la page de login
	 * 
	 * @return une view avec la page de login
	 */   
	public function get_index(){		
    	return View::make('login.index');
	}
	
	/**
	 * Login sur le côté administration
	 * Récupération des données du formulaire de login
	 * @return Redirige l'utilisateur vers la formulaire avec les erreurs si il y a des erreurs
	 *         Redirige vers la page principal d'administration
	 *
	 */
	public function post_index(){
	  $creds = array(
		  'username' => Input::get('username'),
		  'password' => Input::get('password'),
	  );
	  if (Auth::attempt($creds)) {
		  if(Auth::user()->admin){
				return Redirect::to_action('admin.index');
			}
		  
	  } else {
		  Session::flash('status_error','Username ou Mot de passe incorrect.');
		  return Redirect::back();
	  }
	}
	
	/**
	 * Logout sur le côté administration
	 * 
	 * @return Redirige l'utilisateur vers la page d'accueil avec une message de succes
	 */
	public function get_logout(){
		if(!Auth::guest()){
			Auth::logout();
			Session::flash('status_success','Vous avez été déconnecté.');
		}
		
		return Redirect::to_route('accueil');
	}
}