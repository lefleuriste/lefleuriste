<?php

class Admin_Controller extends Base_Controller {

	public $restful = true;
	
	public function get_index()
	{
		
		return View::make('admin.index');
	}

	public function get_modifierMdp()
	{
		$users = User::find(1);
		return View::make('admin.editPassword')->with('users',$users);	
	}
	
	public function post_modifierMdp()
	{
		$rules = new RulesUser();
				
		//Check if the validation succeeded
		if(!$rules->validate(Input::all()) ) {
			//Send the $validation object to the redirected page
            return Redirect::back()->with_errors($rules->errors())->with_input();
		}
		else{
					
			$users = User::find(1);
			$users->username=Input::get('username');
			$users->password=Hash::make(Input::get('password'));
			$users->save();
       	 	
			Session::flash('status_success','Modifications réalisées avec succès');
				
			return Redirect::to_action('admin.index');
		}
		
	  	
	 
}
	
	
	
}