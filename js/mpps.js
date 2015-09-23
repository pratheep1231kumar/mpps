$(document).ready(function(e){
	
	//Meganav functions
	function addMega(){
		$(this).addClass("hovering");
		$("select").addClass('hover_state');
		$(this).children(".megapanel").show();
	}
	
	function removeMega(){
		$(this).removeClass("hovering");
		$("select").removeClass('hover_state');
		$(this).children(".megapanel").hide();
	}
	
	var megaConfig = {
		interval: 20,
		sensitivity: 4,
		over: addMega,
		timeout: 10,
		out: removeMega
	};
	$("li.mega").hoverIntent(megaConfig);
});
	
$('a').focus(function(){
     $(this).attr("hideFocus", "hidefocus");
});

function highlight(id)
{
  $(".st").css("font-weight", "normal"); 
  $('#'+id).next().css("font-weight", "bold");
}
 
