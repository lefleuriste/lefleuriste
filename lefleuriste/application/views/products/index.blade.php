@layout('base')

@section('content')

	@if($products)
        <table class="table table-hover">
         <th>Id</th> 
         <th>Nom</th>
         <th>Description</th>
         <th>Prix</th>
        	
			@foreach($products as $p)
            <tr>
	            <td>{{$p->id}}</td>
	            <td>{{HTML::link_to_route('productDetails', $p->nom ,array('id' => $p->id));}}</td>
	            <td>{{Str::limit($p->description,200)}}</td>
	            <td>{{$p->prix}}€</td>
            </td>
			@endforeach
			
        </table>

	@endif
@endsection