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

		<div class="span6">
			<div class="config">
				<a href="{{URL::to_action('products.products')}}" class="thumbnail">
					{{HTML::image('public/img/produit.png')}}
				</a> <!-- href thumbnail -->	
			</div> <!-- /config -->
			<p></p>
		</div> <!-- span 6-->
	</div> <!--/row -->
		<div class="row-fluid">
			<div class="span6">
				<div class="config">
					<a href="{{URL::to_action('categories.categories')}}" class="thumbnail">
						{{HTML::image('public/img/categorie.png')}}
					</a> <!-- href thumbnail -->	
				</div> <!-- /config -->
			</div> <!-- /span 6 -->
		</div> <!--/row -->

</div> <!--/container -->

@endsection


