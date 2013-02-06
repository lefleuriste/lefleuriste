$(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 		$('#toggle-all').toggleClass('toggle-checked');
		$('#mainform input[type=checkbox]').checkBox('toggle');		
		return false;
	});
});