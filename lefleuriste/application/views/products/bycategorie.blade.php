@layout("base")

@section("content")

<div class="row-fluid">
	<div class="span12">
   		<div class="titre">
		<h2> Nos {{Str::plural($categorie->nomc)}} </h2>
        </div>
    </div> <!-- / span12 -->
	@if($products)
   		<ul class="thumbnails">
        <div class="row-fluid">

	    @for($i=1; $i<=count($products->results); $i++)
			
			<li class="span3">
					<!-- image -->
					<a href="#" class="thumbnail">

						{{HTML::image('public/images/'.$products->results[$i-1]->chemin)}}

						<div class="caption">
							<p><h4>{{$products->results[$i-1]->nomp}}</h4></p>

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

    <!-- Pagination -->
	{{$products->links()}}

	@endif
</div> <!-- row-fluid -->

@endsection