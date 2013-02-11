<?php

class Login_Controller extends Base_Controller {
    public $restful = true;

    public function __construct(){
        parent::__construct();
        
        //filtre pour sécuriser les pages liées à l'administration
		$this->filter('before','auth')->only(array('logout'));
		$this->filter('before','csrf')->on('post');   
    }
   
	public function get_index(){		
    	return View::make('login.index');
	}
	
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
		  Session::flash('status_error','login ou mot de passe incorrect.');
		  return Redirect::back();
	  }
	}
	
	public function get_logout(){
		if(!Auth::guest()){
			Auth::logout();
			Session::flash('status_success','Vous êtes bien déconnecté.');
		}
		
		return Redirect::to_route('accueil');
	}
}