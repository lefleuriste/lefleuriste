@layout('base')

@section('content')

<div class="row-fluid">
	<div class="span12">
		<h2>Bienvenue {{Auth::user()->username}} !</h2>
		<hr class="sexy_line" />
	</div> <!--/span12-->
</div> <!--/row -->

<div class="container-fluid">

	<div class="row-fluid">
	
    <ul class="shortcut-buttons-set">
        
		<li><a class="shortcut-button" href="{{URL::to_action('admin.modifierMdp')}}"><span>
          {{HTML::image('public/img/icon_user_menu.png')}}<br />
          Gestion du compte
        </span></a></li>
        
		<li><a class="shortcut-button" href="{{URL::to_action('categories.categories')}}"><span>
          {{HTML::image('public/img/icon_categories_menu.png')}}<br />
          Gestion des catégories
        </span></a></li>
        
        <li><a class="shortcut-button" href="{{URL::to_action('products.products')}}"><span>
          {{HTML::image('public/img/icon_produits_menu.png')}}<br />
          Gestion des produits
        </span></a></li>  
        
	</ul><!-- End .shortcut-buttons-set -->
		
	</div> <!--/row -->

</div> <!--/container -->

@endsection


