<?php

class Base_Controller extends Controller {

	public function __construct()
	{

	     //Assets CSS
	    Asset::container('header')->add('bootstrap', 'public/css/bootstrap.css');
	    Asset::container('header')->add('bootstrap-responsive', 'public/css/bootstrap-responsive.css');
	    Asset::container('header')->add('speciale', 'public/css/speciale.css');    
        
        //Assets Js
        Asset::container('header')->add('jquery', 'public/js/jquery.min.js');
        Asset::container('header')->add('jquery-ui', 'public/js/ui.core.js');
        Asset::container('header')->add('jquery-ui-checkbox', 'public/js/ui.checkbox.js');

        Asset::container('header')->add('bootstrap', 'public/js/bootstrap.js');
        Asset::container('header')->add('bootstrap-dropdown', 'public/js/twitter-bootstrap-hover-dropdown.min.js');		   
	    Asset::container('header')->add('bootstrap-trans', 'public/js/bootstrap-transition.js');
	    Asset::container('header')->add('ckeckbox', 'public/js/checkbox.js');
	    Asset::container('header')->add('zoom', 'public/js/photoZoom.min.js');		
		Asset::container('header')->add('app', 'public/js/app.js');
	    parent::__construct();
	}

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

}