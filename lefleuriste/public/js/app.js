(function($){ 
  //gestion des sous catégories pour la fonction modifier
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
         
              $(id).parents('.control-group').show();                             
              for(var i in data.results){                     
                var result = data.results[i];              
                target.options[i] = new Option(result.nomc, result.id, false, false);
              }
            }
            
         },'json');     
   }); 

  //traitement de la suppression des éléments
  $('#formulaire').live('submit',function(){

    var courant = $(this);
    var select = courant.find('select');
    var action = select.val();
    var ok = false;

    //nombre de checkboxes cochées dans le formulaire
    var checkboxes = courant.find('input[type=checkbox]:checked').length;  

    //si la valeur est 0
    if(action == 0){
      alert('Merci de sélectionner une action');      
    }else
   //si aucune checkbox cochée on alerte l'utilisateur
    if(action == 1 && checkboxes == 0){
      alert('Merci de sélectionner des éléments');

    }else if(action == 1 && checkboxes > 0){
      ok = true;
    }

    return ok;    
    
  });


   
})(jQuery);