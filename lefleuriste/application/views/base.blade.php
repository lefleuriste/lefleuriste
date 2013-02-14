<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Le fleuriste</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="{{URL::to('public/img/favicon.ico')}}" />

    <!-- Le styles -->
    {{ Asset::container('header')->styles() }}
    {{ Asset::container('header')->scripts() }}  
    <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>  
	<link href='http://fonts.googleapis.com/css?family=Kreon' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
	<!--[if gte IE 9]>
		<style type="text/css">
		.gradient {
				filter: none;
		}
		</style>
	<![endif]-->   
  </head>
  <body>
  	<div id="header">
    <!-- element banniere-->
    @render('elements/banniere')
    </div>
  	
	<!-- element navigation administrateur-->
	@render('elements/navigation')
	
    
    

    <div class="container">
    
		  
        @include('plugins.status')		
		@yield('content')
	</div> <!-- /container --> 
       
      	<!-- element footer-->
		@render('elements/footer')	
     
  </body>
</html>