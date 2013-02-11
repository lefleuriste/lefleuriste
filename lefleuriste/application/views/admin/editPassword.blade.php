@layout("base")

@section('content')

<div class="row-fluid">
	<div class="span12">		
		<h2>Modification du Mot de Passe</h2>
		
		{{Form::open('admin/modifierMdp','POST',array('class'=>'form-horizontal'))}}
			<!-- Champ Username -->
				<div class="control-group @if ($errors->has('username')) error @endif">
				<div class="controls">
                	{{Form::label('Username','Username')}} 
					{{Form::text('username',Input::old('username', $users->username))}}
					@if ($errors->has('username'))
						<span class="help-inline">{{$errors->first('username',':message')}}</span>
					@endif
				</div><!--/controls-->
				</div><!--/control-group-->
			
			<!-- Champ Mot de Passe -->
                <div class="control-group @if ($errors->has('password')) error @endif">
				<div class="controls">
                    {{Form::label('motpasse', 'Nouveau Mot de passe')}} 
					{{Form::password('password')}}
					@if ($errors->has('password'))
						<span class="help-inline">{{$errors->first('password',':message')}}</span>
					@endif
                </div><!-- /class="control-group -->  
				</div><!--/control-group-->
               
			<!-- Champ Contrôle Mot de Passe -->
                <div class="control-group @if ($errors->has('password2')) error @endif">
				<div class="controls">
                    {{Form::label('motpasse2', 'Confirmation')}} 
					{{Form::password('password2')}}
					@if ($errors->has('password2'))
						<span class="help-inline">{{$errors->first('password2',':message')}}</span>
					@endif
                </div><!-- /class="control-group -->
				</div><!--/control-group-->
                                
			<div class="form-actions">
				{{Form::submit( 'Modifier' , array('class' => 'btn btn-success'))}}
				{{HTML::link_to_action('categories.categories', 'Annuler', array(), array('class' => 'btn btn-danger'))}}
			</div><!--/form-actions-->
		
		{{Form::token()}}	
		{{Form::close()}}
		
	</div> <!--/span12-->
</div><!--/row-->

@endsection



