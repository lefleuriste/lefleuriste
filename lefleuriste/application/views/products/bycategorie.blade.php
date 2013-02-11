@layout("base")

@section("content")

<div class="row-fluid">
	<div class="span12">
   		<div class="titre">
			<h2> Nos {{Str::plural($categorie->nomc)}} </h2>
        </div>
    </div> <!-- / span12 -->
	@if($products)
   		<section class="image-gallery">

	    @for($i=1; $i<=count($products->results); $i++)
			
			
					<!-- image -->					
                    <figure tabindex="{{$i}}">
                    	{{HTML::image('public/images/'.$products->results[$i-1]->chemin)}}
                    	
                    </figure>
					
			
		@if($i>0 AND $i%4==0)
           </div> <!-- /row-fluid -->
		   <div class="span12">
		   </div>	<!-- /span12 -->
			
		   <div class="row-fluid">	
		@endif	
    @endfor
	</section>

    <!-- Pagination -->
	{{$products->links()}}

	@endif
</div> <!-- row-fluid -->

@endsection