@layout("base")

@section("content")

<!-- <h1>Hello, world!</h1>
<p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p><p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
Bienvenue chez nous :) -->
	<div class="container-fluid">
      <div class="row-fluid">    
        <div class="span12">        
          <div class="row-fluid">
            <div class="span4">
				<div class="presentation">
					<h2>Bienvenue</h2>
					<p>Le fleuriste vous accueille 
					<strong>7 jours sur 7 </strong>
					de <strong>8h30 à 20h30 </strong>dans un cadre agréable.</p>
					<p> Découvrez de multiples compositions florales à offrir pour toutes occasions.</p>
              
            </div><!--/span-->
			</div>
            <div class="span4">
          		{{HTML::image('public/img/fleuraccueil.jpg')}}
        	</div><!--/span-->
            <div class="span4">
				<div class="presentation">
					<h2>Le Concept</h2>
					<p>Venez flâner, regarder, sentir et choisir vos fleurs dans nos magasins en libre service. </p>
					<p>Vous y trouverez une très large gamme de fleurs et plantes, de la meilleure qualité et à un prix attractif.</p>
					<p>Nous sommes ouverts 365 jours par an. Venez nous rencontrer !</p> 
				</div>
			</div><!--/span--> 
                     
          </div><!--/row-->         
        </div><!--/span-->
        
        
      </div><!--/row-fluid-->
    </div><!--/.fluid-container-->
    

@endsection