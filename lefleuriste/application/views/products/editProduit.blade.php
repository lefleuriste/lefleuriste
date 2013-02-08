@layout('base')
  
@section('content')

<div class="row-fluid">
	
	<div class="span12">		
		
		@if ($product!=null)
			<h2>Modification du Produit</h2>
		@else
			<h2>Ajout d'un Produit</h2>
		@endif
    
    {{Form::open_for_files('products/modifierProd','POST',array('class'=>'form-horizontal'))}}
    
    @if ($product!=null)
            	{{Form::hidden('idprod',$product->id)}}
                
            @endif
            

    <div class="control-group @if ($errors->has('nomp')) error @endif">
            <div class="controls">
            	{{Form::label('nomp','Nom Produit')}}
                @if ($product!=null)
                    {{Form::text('nomp',Input::old('nomp',$product->nomp))}}
                @else {{Form::text('nomp',Input::old('nomp'),array('class'=>"inputError"))}}
                @endif
                @if ($errors->has('nomp'))
                    <span class="help-inline">{{$errors->first('nomp',':message')}}</span>

                @endif
            </div><!-- /class="controls" -->
	</div><!-- /class="control-group -->    
   
    
    <div class="control-group @if ($errors->has('descriptif')) error @endif">
            <div class="controls">
            	{{Form::label('descriptif','Description')}}
                @if ($product!=null)
                    {{Form::text('descriptif',Input::old('descriptif',$product->descriptif))}}
                @else {{Form::text('descriptif',Input::old('descriptif'),array('class'=>"inputError"))}}
                @endif
                @if ($errors->has('descriptif'))
                    <span class="help-inline">{{$errors->first('descriptif',':message')}}</span>
                @endif
            </div><!-- /class="controls" -->
	</div><!-- /class="control-group -->
	
    <div class="control-group @if ($errors->has('categorie_id')) error @endif">
            <div class="controls">
            	{{Form::label('categorie_id','Catégorie')}}
                @if ($product!=null)
  
                <select id="categorie" name="categorie_id" data-target="sousCategorie" data-url="{{URL::base()}}/categories/listeSousCategories/" class="ajaxList">
                    @foreach($cat_option as $k => $v) 
                        <option value="{{$k}}" @if($cat_mere->id == $k) selected @else '' @endif>{{$v}}</option>
                    @endforeach
                </select> 
                
                @else  
                <select id="categorie" name="categorie_id" data-target="sousCategorie" data-url="{{URL::base()}}/categories/listeSousCategories/" class="ajaxList">
                    <option value="null">Sélectionnez une catégorie</option>
                    @foreach($cat_option as $k => $v)
                        <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </select>                       
                @endif
                @if ($errors->has('categorie_id'))
                    <span class="help-inline">{{$errors->first('categorie_id',':message')}}</span>
                @endif
            </div><!-- /class="controls" -->
    </div><!-- /class="control-group -->

    <div class="control-group @if ($errors->has('sousCategorie_id')) error @endif">
            <div class="controls">
                {{Form::label('categorie_id','Sous catégorie')}}
                @if ($product!=null)

					{{Form::select('categorie_id', $sous_cat_option, Input::old('categorie_id' ,$product->categorie_id))}}

                @else                 
                <select id="sousCategorie" name="sousCategorie_id">
                    <option value="null">Vous devez sélectionner une catégorie</option>                    
                </select>    
                @endif
                @if ($errors->has('categorie_id'))
                    <span class="help-inline">{{$errors->first('categorie_id',':message')}}</span>
                @endif
            </div><!-- /class="controls" -->
    </div><!-- /class="control-group -->

	@if ($product!=null)
        <div class="control-group @if ($errors->has('chemin')) error @endif">
                <div class="controls">            	
            	 
                 	{{Form::label('image','Image Actuelle')}}
            		{{HTML::image('public/images/tab-'.$product->chemin)}}
                 
                </div> <!-- /class="controls" -->
        </div> <!-- /class="control-group -->  
	@endif
    
	<div class="control-group @if ($errors->has('chemin')) error @endif">
            <div class="controls">
            	{{Form::label('chemin','Choississez une nouvelle image')}}
                @if ($product!=null)
                    {{Form::file('chemin')}}
                @else {{Form::file('chemin')}}
                @endif
                @if ($errors->has('chemin'))
                    <span class="help-inline">{{$errors->first('chemin',':message')}}</span>
                @endif
            </div> <!-- /class="controls" -->
	</div> <!-- /class="control-group -->  
    
    <div class="form-actions">
				@if ($product!=null)
					{{Form::submit( 'Modifier' , array('class' => 'btn btn-success'))}}
				@else
					{{Form::submit( 'Ajouter' , array('class' => 'btn btn-success'))}}
				@endif
					{{HTML::link_to_action('products.products', 'Annuler', array(), array('class' => 'btn btn-danger'))}}
    </div> <!-- /form-actions-->
    
    {{Form::token()}}
    {{Form::close()}}
    </div>  <!-- /span12 -->
 </div>  <!-- /row-fluid -->
@endsection