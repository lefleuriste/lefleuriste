@layout("base")

@section('content')

<div class="row-fluid">
	<div class="span12">
		<h2>Les catégories</h2>
		{{HTML::link_to_action('categories@modifiercat', 'Ajouter',array(),array('class' => 'btn btn-success'))}}	
	</div><!--/span12-->
	
	{{Form::open('categories/suppression','POST', array('id'=>'mainform'))}}
        
        <input type="submit" value="Supprimer" class="btn btn-danger" onclick="return confirm('Etes-vous sûr de vouloir supprimer ces catégories ?');">
       		
	
	<!-- Affichage des catégories - tableau -->
	@if($categories)
		<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
					<th class="table-header-repeat line-left">Catégories</th>
					<th class="table-header-repeat line-left">Catégorie mère</th>
					<th class="table-header-repeat line-left">Option</th>
				</tr>
				@foreach($categories as $c)
				<tr>					
					<td>{{Form::checkbox('select[]',$c->id)}}</td>
					<td>{{$c->nom}}</td>
                                        <td>
					@if($c->categorie_id!=null)
						{{$c->parent_categorie->nom}}
					@endif
					</td>
                                       	<td>{{HTML::link_to_action('categories.modifierCat', 'Modifier',array('id'=>$c->id),array('class' => 'btn btn-success'))}}</td>
				</tr>
				@endforeach
		</table>
			
			{{Form::token()}}
			{{Form::close()}}
	
	@endif
	
</div><!--/row-->

@endsection