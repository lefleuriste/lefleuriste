@layout("base")

@section("content")


<div class="row-fluid">
	<div class="span12">
   		<div class="titre">
		<h2> Nos {{Str::plural($categorie->nom)}} </h2>
        </div>
    </div> <!-- / span12 -->
	@if($products)
        
	<ul class="thumbnails">
    <div class="row-fluid">

	@for($i=1; $i<=count($products); $i++)
			
			<li class="span3">
					<!-- image -->
					<a href="#" class="thumbnail">
						<img alt="300x200" style="width: 300px; height: 200px;" src="{{URL::base().($products[$i-1]->chemin)}}">

						<div class="caption">
							<p><h4>{{$products[$i-1]->nom}}</h4></p>
						</div> <!-- /caption -->
					</a>
			</li> <!-- /span3 -->
		
			
				@if($i>0 AND $i%4==0)
    </div> <!-- /row-fluid -->
		<div class="span12">
		</div>	<!-- /span12 -->
			
		<div class="row-fluid">	
			@endif
			

			
	
    @endfor
	</div> <!-- /row-fluid -->
	</ul>

	@endif
</div> <!-- row-fluid -->

@endsection