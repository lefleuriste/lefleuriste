(function($){ 

  $('.ajaxList').live('change',function(event){
	  
         event.preventDefault();
   		 var select = $(this);
         var url = select.data('url')+select.val();		 
         var id = '#'+select.data('target');
         $.get(url,{},function(data){
            var target = $(id).get(0);               
            if(data.error){
				
              $(id).parents('.control-group').hide(); 
              target.options.length = 0;
            }else{
			  console.log(data);	
              $(id).parents('.control-group').show();                             
              for(var i in data.results){   
			  
			                
                var result = data.results[i];
                target.options[i] = new Option(result.nom, result.id, false, false);
              }
            }
            
         },'json'); 		
   }); 

})(jQuery);