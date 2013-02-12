@layout('base')

@section('content')

<div class="container-fluid">
	<div class="row-fluid">
	
		<div class="span12">
			<h2>Se connecter</h2>
			<hr class="sexy_line" />			
				{{Form::open('login', 'Post', array('class'=>'form-horizontal'))}}
				
                <div class="control-group">
      			<div class="controls">
                <label id="username"> Nom d'utilisateur </label>
                <input type="text" name="username" placeholder="Nom d'utilisateur" />
				</div>
                </div>
                <div class="control-group">
				<div class="controls">
                <label id="password"> Mot de passe </label>
                <input type="password" name="password" placeholder="Mot de passe" />
				</div>
				</div>
                
                  <div class="form-actions">
                  {{Form::submit('Se connecter', array('class' => 'btn btn-success'))}}
                  </div>
                  {{Form::token()}}	
                  {{Form::close()}}	
			
			</div> <!-- /span12 -->
			
	</div> <!-- /row -->
</div> <!-- /container -->

@endsection
