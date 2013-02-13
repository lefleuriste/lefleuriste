@layout("base")

@section("content")

<div class="row-fluid">
	<div class="span12">
   		<div class="titre">
			<h2>{{Str::plural($categorie->nomc)}}</h2>
        </div>
        <hr class="sexy_line" />
    </div> <!-- / span12 -->
	@if($products)
   		<section class="image-gallery">
        	<div class="row-fluid">

	    @for($i=1; $i<=count($products); $i++)
				<figure tabindex="{{$i}}">
					<!-- image -->					
					<img src="{{URL::base().'/public/images/'.$products[$i-1]->chemin}}"/>
            		           		
            	</figure>			
			
		@if($i>0 AND $i%6==0)
           </div> <!-- /row-fluid -->
		   <div class="span12">
		   </div>	<!-- /span12 -->
			
		   <div class="row-fluid">	
		@endif	
    @endfor
	</div> <!-- /row-fluid -->
	</section>	@endif
</div> <!-- row-fluid -->

@endsection
