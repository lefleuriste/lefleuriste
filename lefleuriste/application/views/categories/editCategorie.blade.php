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
			
			<!-- Champ Nom Catégorie -->
			<div class="control-group @if ($errors->has('Categorie')) error @endif">
				<div class="controls">
                	{{Form::label('Categorie','Nom Catégorie')}}
					@if ($categorie!=null)
						{{Form::text('Categorie',Input::old('Categorie', $categorie->nomc ),array('class'=>"inputError"))}}
					@else {{Form::text('Categorie',Input::old('Categorie'),array('class'=>"inputError"))}}
					@endif
					@if ($errors->has('Categorie'))
						<span class="help-inline">{{$errors->first('Categorie',':message')}}</span>
					@endif
				</div><!--/controls-->
			</div><!--/control-group-->
			
			<!-- Champ catégorie mere -->
			<div class="control-group @if ($errors->has('categorie_id')) error @endif">
                            <div class="controls">
                                {{Form::label('categorie_id','Catégorie mère')}}
                                @if ($categorie!=null)
                                    {{Form::select('categorie_id', $cat_option, Input::old('categorie_id' ,$categorie->categorie_id))}}
                                @else {{Form::select('categorie_id', $cat_option, Input::old('categorie_id'))}}
                                @endif
                                @if ($errors->has('categorie_id'))
                                    <span class="help-inline">{{$errors->first('categorie_id',':message')}}</span>
                                @endif
                            </div><!-- /class="controls" -->
                        </div><!-- /class="control-group -->
			
			<div class="form-actions">
				@if ($categorie!=null)
					{{Form::submit( 'Modifier' , array('class' => 'btn btn-success'))}}
				@else
					{{Form::submit( 'Ajouter' , array('class' => 'btn btn-success'))}}
				@endif
					{{HTML::link_to_action('categories.categories', 'Annuler', array(), array('class' => 'btn btn-danger'))}}
			</div><!--/form-actions-->
		
		{{Form::token()}}	
		{{Form::close()}}
		
	</div> <!--/span12-->
</div><!--/row-->

@endsection



