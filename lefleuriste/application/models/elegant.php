<?php


class Elegant extends Eloquent {
	
	//Create our validation rules
		protected $rules = array();
		
		protected $errors;
		
		public function validate($data)
		{
			$v = Validator::make($data, $this->rules);
			
			if ($v->fails())
			{
				$this->errors = $v->errors;
				return false;
			}
			
			return true;
			
		}
		
		public function errors()
		{
			return $this->errors;
		}
	
}


?>