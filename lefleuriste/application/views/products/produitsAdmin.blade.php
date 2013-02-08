@layout("base")

@section('content')
<div class="span12">
    @include('elements/menuadmin')
</div>
<div class="row-fluid">	     	
	
	<h2>Les produits</h2>
        
	{{HTML::link_to_action('products.modifierProd','Ajouter',array(),array('class' => 'btn btn-success'))}} 		

	{{Form::open('products/suppression','POST', array('id'=>'formulaire'))}}
	@if($products)
        
		<table>
			<thead>
				<tr>
					<th class="ch"><a id="toggle-all" ></a> </th>
					<th>Produit</th>
					<th>Catégories</th>
					<th>Image</th>
					<th class="ch">Options</th>
				</tr>
			</thead>
			<tbody>
			@foreach($products->results as $p)
				<tr>					
					<td class="ch">{{Form::checkbox('select[]',$p->id)}}</td>
					<td>{{$p->nomp}}</td>
					<td>{{$p->categorie->nomc}}</td>
					<td>{{HTML::image('public/images/tab-'.$p->chemin)}}</td>					

					<td class="ch"><a href="{{URL::to_action('products.modifierProd',array('id'=>$p->id))}}">{{HTML::image('public/img/pencil.png', 'Modifier', array('title'=>'Modifier'))}}</a></td>		
				</tr>
				@endforeach
			</tbody>
			<tfoot>
			    <tr>
					<td colspan="6">
						<div class="actions">
							{{Form::select('actions', $options,array('id'=>'actions'))}}
							<input type="submit" value="OK" class="btn btn-success soumettre">
						</div>
						<!-- Pagination -->
						{{$products->links()}}
					</td>
				<tr>
			</tfoot>
			</table>
			
			{{Form::token()}}
			{{Form::close()}}

		

	@else
		<h2>Aucun produit</h2>
	@endif
	
</div> <!-- row-fluid 2 -->

@endsection



