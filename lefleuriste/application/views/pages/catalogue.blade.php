@layout("base")

@section('content')

<div class="row-fluid">
	
	<div class="span12">
		<h2>Catalogue de Produits</h2>
		<hr class="sexy_line" />
	</div>
	
	<ul class="thumbnails">	
	@for($i=1; $i<=count($categories); $i++)
		<li class="span4">
				<a href="{{URL::to_route('bycategorie', array($categories[$i-1]->url, $categories[$i-1]->id))}}" class="thumbnail">
					<img data-src="holder.js/300x200" alt="300x200" style="width: 300px; height: 200px;" src="{{($categories[$i-1]->image)}}">
						<h4>{{Str::plural($categories[$i-1]->nom_categorie)}}</h4>       
				</a> <!-- href thumbnail -->	
		</li> <!-- span 4 -->
	
	@if($i>0 AND $i%3==0)
		</div> <!-- row-fluid 1 -->
		<div class="span12">
		</div> <!-- span 12 -->	
		<div class="row-fluid">
	@endif
	@endfor
	</ul> <!-- thumbnails -->
</div> <!-- row-fluid 2 -->

@endsection

