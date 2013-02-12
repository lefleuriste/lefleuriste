@layout("base")

@section("content")

<div class="row-fluid">
	<div class="span12">
   		<div class="titre">
			<h2> Nos {{Str::plural($categorie->nomc)}} </h2>
        </div>
        <hr class="sexy_line" />
    </div> <!-- / span12 -->
	@if($products)
   		<section class="image-gallery">
        	<div class="row-fluid">

	    @for($i=1; $i<=count($products->results); $i++)
				<figure tabindex="{{$i}}">
					<!-- image -->					
					<img src="{{URL::base().'/public/images/'.$products->results[$i-1]->chemin}}"/>
            		           		
            	</figure>			
			
		@if($i>0 AND $i%4==0)
           </div> <!-- /row-fluid -->
		   <div class="span12">
		   </div>	<!-- /span12 -->
			
		   <div class="row-fluid">	
		@endif	
    @endfor
	</div> <!-- /row-fluid -->
	</section>
    <!-- Pagination -->
	{{$products->links()}}

	@endif
</div> <!-- row-fluid -->

@endsection