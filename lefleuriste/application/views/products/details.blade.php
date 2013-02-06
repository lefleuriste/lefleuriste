@layout('base')

@section('content')

	@if($product)
        <h2>{{$product->nom}}</h2>
        <p>{{$product->description}}</p>
        <h5>{{$product->prix}}</h5>
	@endif
@endsection