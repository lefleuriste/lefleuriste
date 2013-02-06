@layout("base")

@section('content')



<div class="row-fluid">
	
	<div class="span12">		
		
		@if ($categorie!=null)
			<h2>Modification de la catégorie</h2>
		@else
			<h2>Ajout d'une catégorie</h2>
		@endif
		
		{{Form::open('categories/modifierCat','POST',array('class'=>'form-horizontal'))}}
			@if ($categorie!=null)
            	{{Form::hidden('idcat',$categorie->id)}}
                
            @endif
			
			<div class="control-group @if ($errors->has('nomCategorie')) error @endif">
				<div class="controls">
                	{{Form::label('nomCategorie','Nom Catégorie')}}
					@if ($categorie!=null)
						{{Form::text('nomCategorie',Input::old('nomCategorie', $categorie->nom_categorie ),array('class'=>"inputError"))}}
					@else {{Form::text('nomCategorie',Input::old('nomCategorie'),array('class'=>"inputError"))}}
					@endif
					@if ($errors->has('nomCategorie'))
						<span class="help-inline">{{$errors->first('nomCategorie',':message')}}</span>
					@endif
				</div>
			</div>
			
			<div class="control-group @if ($errors->has('image')) error @endif">
				<div class="controls">
                	{{Form::label('image','Image')}}
					@if ($categorie!=null)
						{{Form::text('image',Input::old('image', $categorie->image),array('class'=>"inputError"))}}
					@else
					{{Form::text('image',Input::old('image'),array('class'=>"inputError"))}}
					@endif
					@if ($errors->has('image'))
						<span class="help-inline">{{$errors->first('image',':message')}}</span>
					@endif
				</div>
			</div>
			
			<div class="form-actions">
				@if ($categorie!=null)
					{{Form::submit( 'Modifier' , array('class' => 'btn btn-success'))}}
				@else
					{{Form::submit( 'Ajouter' , array('class' => 'btn btn-success'))}}
				@endif
					{{HTML::link_to_action('categories.categories', 'Annuler', array(), array('class' => 'btn btn-danger'))}}
			</div>
		
		
		{{Form::token()}}	
		{{Form::close()}}
		
	</div>
</div>

@endsection



