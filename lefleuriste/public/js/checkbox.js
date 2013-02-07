$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 		$('#toggle-all').toggleClass('toggle-checked');
		$('#formulaire input[type=checkbox]').checkBox('toggle');		
		return false;
	});
});