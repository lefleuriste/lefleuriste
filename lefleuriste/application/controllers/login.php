<?php

class Login_Controller extends Base_Controller {
    public $restful = true;
   
	public function get_index(){
		if(Auth::check()){
		   return Redirect::to(URL::to_action('admin.index'));	
		}
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
		}
		return View::make('login.logout');
	}
}