@layout("base")

@section('content')
<div class="span12">
    @include('elements/menuadmin')
</div>
<div class="row-fluid">	
	
	<h2>Les catégories</h2>
	{{HTML::link_to_action('categories@modifiercat', 'Ajouter',array(),array('class' => 'btn btn-success'))}}	
	
	{{Form::open('categories/suppression','POST', array('id'=>'formulaire'))}}       
       		
	<!-- Affichage des catégories - tableau -->
	@if($categories)		
		<table>
			<thead>
				<tr>
					<th class="ch"><a id="toggle-all" ></a></th>
					<th>Catégories</th>
					<th>Catégorie mère</th>
					<th class="ch">Modifier</th>
				</tr>
			</thead>
			
				@foreach($categories->results as $c)
				<tr>								
					<td class="ch">{{Form::checkbox('select[]',$c->id)}}</td>
					<td>{{$c->nomc}}</td>
                                        <td>
					@if($c->categorie_id!=null)
						{{$c->parent_categorie->nomc}}
					@endif
					</td>
                    <td class="ch"><a href="{{URL::to_action('categories.modifierCat',array('id'=>$c->id))}}">{{HTML::image('public/img/pencil.png', 'Modifier', array('title'=>'Modifier'))}}</a></td>
				</tr>			
				@endforeach
			
			<tfoot>
				<tr>
					<td colspan="6">
						<div class="actions">
							{{Form::select('actions', $options,array('id'=>'actions'))}}
							<input type="submit" value="OK" class="btn btn-success soumettre">
						</div>
					<!-- Pagination -->
					{{$categories->links()}}
					</td>
				<tr>
			</tfoot>
		</table>		 
			
			{{Form::token()}}
			{{Form::close()}}

		
	@else
		<h2>Aucune catégorie</h2>
	@endif
	
</div><!--/row-->

@endsection