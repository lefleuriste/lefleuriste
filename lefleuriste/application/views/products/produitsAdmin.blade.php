@layout("base")

@section('content')

<div class="row-fluid">
	
	<div class="span12">
		<h2>Les produits</h2>
        
		{{HTML::link_to_action('products.modifierProd','Ajouter',array(),array('class' => 'btn btn-success'))}}      
		
	</div>
	{{Form::open('products/suppression','POST', array('id'=>'mainform'))}}
	<input type="submit" value="Supprimer" class="btn btn-danger" onclick="return confirm('Etes-vous sûr de vouloir supprimer ces produits ?');">
	@if($products)
       
		<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
					<th class="table-header-repeat line-left minwidth-1">Produit</th>
					<th class="table-header-repeat line-left">Catégories</th>
					<th class="table-header-repeat line-left">Image</th>
					<th class="table-header-options line-left">Options</th>
				</tr>
				@foreach($products as $p)
				<tr>					
					<td>{{Form::checkbox('select[]',$p->id)}}</td>
					<td>{{$p->nom}}</td>
					<td>{{$p->categorie->nom}}</td>
					<td>{{$p->chemin}}</td>					
					<td>{{HTML::link_to_action('products.modifierProd', 'Modifier',array('id'=>$p->id),array('class' => 'btn btn-success'))}}</td>		
					
				</tr>
				@endforeach
			</table>
			
			{{Form::token()}}
			{{Form::close()}}
	@endif
	
</div> <!-- row-fluid 2 -->

@endsection



