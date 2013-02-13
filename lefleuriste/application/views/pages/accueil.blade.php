@layout("base")

@section("content")

<!-- <h1>Hello, world!</h1>
<p>This is a template for a simple marketing or informational website. It includes a large callout called the hero unit and three supporting pieces of content. Use it as a starting point to create something more unique.</p><p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
Bienvenue chez nous :) -->
	<div class="container-fluid">
      <div class="row-fluid">    
        <div class="span12"> 
          @if(isset($saint)) 
          	<div class="fete">
          		<p>{{$saint[0]->fete}}</p>
          	</div>
          @endif              
          <div class="row-fluid">
            <div class="span4">
				<div class="presentation">
					<h3>Chez « le fleuriste », nous sommes fleuristes avant tout !</h3>
					<p>Si l’étalage extérieur met en avant la fraîcheur et le choix, avec plus de <strong>50 variétés</strong>, l’intérieur de nos magasins est dédié au métier : bouquets et compositions florales, compositions de plantes… tout le savoir faire de <strong>nos fleuristes passionnés</strong> et diplômés s’y trouve.</p>
					
					<h3>Des fleurs simplement</h3>
					<p> Nous n’avons pas de secret, seul notre volume d’achats nous permet de raccourcir la chaine d’achats et donc de gagner en fraîcheur et en qualité de tenue pour votre plus grande satisfaction.</p>
              
            </div><!--/span-->
			</div>
            <div class="span4">
          		{{HTML::image('public/img/fleuraccueil.png')}}
        	</div><!--/span-->
            <div class="span4">
				<div class="presentation">
					<h3>Des Magasins où la fleur est à l’honneur sans chichi…</h2>
					<p>Chez « <strong>le fleuriste</strong>, des fleurs simplement » nos magasins reflètent l’esprit de l’enseigne : </p>
					<h4>Accueillants</h4>
					<p>... les équipes souriantes sont là pour vous conseiller et vous accompagner dans l’achat quotidien ou pour fabriquer des compositions pour des événements plus marquants.</p>
					<h4>Ouverts à tous</h4>
					<p>... de <strong>8h30 à 20h30</strong> tous les jours et faciles d’accès…tout pour mieux servir nos clients !</p> 
				</div>
			</div><!--/span--> 
                     
          </div><!--/row-->         
        </div><!--/span-->
        
        
      </div><!--/row-fluid-->
    </div><!--/.fluid-container-->
    

@endsection