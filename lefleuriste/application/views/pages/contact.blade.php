@layout("base")

@section("content")
<div class="container-fluid">
	<div class="row-fluid">
		<div id="agences"> 
			<div class="span12">
				<h2>Nos Magasins</h2>
					<hr class="sexy_line" />
					<iframe width="100%" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="10" src="https://maps.google.fr/maps/ms?msid=214607862597897101337.0004d37bba2d158f56245&amp;msa=0&amp;ie=UTF8&amp;t=m&amp;ll=43.607494,1.434746&amp;spn=0.062148,0.300407&amp;z=12&amp;output=embed"></iframe><br />
			</div> <!-- /span12 -->
			<div class="row-fluid">
				<div class="span6">
					<div class="info">
						<p> <strong>Le Fleuriste</strong></br>
							147, Avenue des Arènes Romaines</br>
							31300 Toulouse </br></br>
							Proche Arrêt Ancely - Tram T1</br></br>
							<strong>Téléphone :</strong> 05.61.31.77.77</br></br>
							{{HTML::image('public/img/arene.png')}}</br></p>
							
					</div> <!-- /info -->
				</div> <!-- /span6 -->
				<div class="span6">
					<div class="info">
						<p>	<strong>Le Fleuriste</strong></br>	
							31 bis, Avenue de Grande-Bretagne</br>
							31300 Toulouse </br></br>
							Proche Arrêt Patte-d'Oie - Métro A</br></br>
							<strong>Téléphone :</strong> 05.61.63.00.00 </br></br>
							{{HTML::image('public/img/anglais.png')}}</br></p>
					</div> <!-- /info -->
				</div> <!-- /span6 -->
			</div> <!-- /row -->			
	</div> <!-- /agence -->
	</div> <!-- /row -->
</div> <!-- /container -->
		
 @endsection
