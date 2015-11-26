$(document).ready(function()
{

});

function showTip(ele_id)
{
	var offset = $('#'+ele_id).offset();
	if(ele_id == 'otc-rig-hotspot1')
	{
		$('#mpps-rig-tip1').removeClass('display_none');
		
		$('#'+ele_id).mouseout(function(){
			$('#mpps-rig-tip1').addClass('display_none');
		});
	}
	else if(ele_id == 'otc-rig-hotspot2')
	{
		$('#mpps-rig-tip2').removeClass('display_none');
		
		$('#'+ele_id).mouseout(function(){
			$('#mpps-rig-tip2').addClass('display_none');
		});
	}
	else if(ele_id == 'otc-rig-hotspot3')
	{
		$('#mpps-rig-tip3').removeClass('display_none');
		
		$('#'+ele_id).mouseout(function(){
			$('#mpps-rig-tip3').addClass('display_none');
		});
	}
	else if(ele_id == 'otc-rig-hotspot4')
	{
		$('#mpps-rig-tip4').removeClass('display_none');
		
		$('#'+ele_id).mouseout(function(){
			$('#mpps-rig-tip4').addClass('display_none');
		});
	}
	else if(ele_id == 'otc-rig-hotspot5')
	{
		$('#mpps-rig-tip5').removeClass('display_none');
		
		$('#'+ele_id).mouseout(function(){
			$('#mpps-rig-tip5').addClass('display_none');
		});
	}
	else if(ele_id == 'otc-rig-hotspot6')
	{
		$('#mpps-rig-tip6').removeClass('display_none');
		
		$('#'+ele_id).mouseout(function(){
			$('#mpps-rig-tip6').addClass('display_none');
		});
	}
	else if(ele_id == 'otc-rig-hotspot7')
	{
		$('#mpps-rig-tip7').removeClass('display_none');
		
		$('#'+ele_id).mouseout(function(){
			$('#mpps-rig-tip7').addClass('display_none');
		});
	}
	else if(ele_id == 'otc-rig-hotspot8')
	{
		$('#mpps-rig-tip8').removeClass('display_none');
		
		$('#'+ele_id).mouseout(function(){
			$('#mpps-rig-tip8').addClass('display_none');
		});
	}						
}


function removeValidationMsg(strEleId)
{
	$("#"+strEleId).attr("err_msg", "");
	$("#"+strEleId).removeClass("err_field");
	if($("#err_wrap_"+strEleId).length)
	{
		$("#err_wrap_"+strEleId).remove();
	}
}
 
function resetValidationMsgs()
{
	$(".err_field").each(function(nIndex, ele){
		removeValidationMsg($(ele).attr("id"));
	});
}

function jAlert(strTitle, strMesg)
{
	$("#alert").dialog({
		buttons : {
        	Ok: function() {
				$(this).dialog("close"); //closing on Ok click
            }
        }
	});
	$('#alert').html(strMesg);
	$('#alert').css('background-color', "#FFF");
	$('#alert').dialog('option', 'title', strTitle);
	$('#alert').dialog('open');
}