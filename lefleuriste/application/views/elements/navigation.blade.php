    <!-- NAVBAR
    ================================================== -->
    <div class="navbar-wrapper">
      <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
      <div class="container">

        <div class="navbar">
          <div class="navbar-inner">
            <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
     <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
            <div class="nav-collapse collapse">
              <ul class="nav">
			  
				<li>{{HTML::link_to_action('accueil', 'Accueil')}}</li>  
				
			
				<!-- recuperer les categories principals -->
				@foreach (Categorie::where_null('categorie_id')->get() as $categorie)
					<!-- voir si la categorie principal a des sous categories -->
                    @if (($c = count($categorie->categories))> 0)						
                        		
                        <!-- recuperer les sous categories -->
                        @for ($i = 0 ; $i < $c; $i++)
                        
                            @if($i==0)
                            
                                <li class="dropdown" >
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="50" data-close-others="true">{{$categorie->nomc}}<b class="caret"></b></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li><a href="{{URL::to_route('bycategorie',array(Str::slug($categorie->categories[$i]->nomc), $categorie->categories[$i]->id))}}" tabindex="-1" >{{$categorie->categories[$i]->nomc}}</a></li>
                            
                            @else				
                                <li><a href="{{URL::to_route('bycategorie',array(Str::slug($categorie->categories[$i]->nomc), $categorie->categories[$i]->id))}}" tabindex="-1" >{{$categorie->categories[$i]->nomc}}</a></li>
                            @endif
                        	
                            @if($c-1 == $i)	
                        
                                </ul>
                                </li>
                            @endif   					 				
                
						@endfor
						<!-- sinon on affiche le nom de la categorie -->	
                    @else 
                    	<li>{{HTML::link_to_route('bycategorie',$categorie->nomc, array(Str::slug($categorie->nomc), $categorie->id))}}</li>               
					@endif
      			@endforeach <!-- fin de recuperation des categories -->
        		          
        		<li>{{HTML::link_to_route('contact', 'Contact')}}</li>
        
				
				</ul><!--/nav--> 
				
				</div><!--/.nav-collapse -->
			</div><!-- /.navbar-inner -->
		</div><!-- /.navbar -->
	</div> <!-- /.container -->
</div><!-- /.navbar-wrapper -->