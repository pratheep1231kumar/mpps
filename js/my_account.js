$(document).ready(function(){	
	$('#id_login').click(function(){
		var ipData = prepareInputData();
		var validData = validateFormData(ipData);
		if(!validData)
		{
			return;
		}			
		showAjaxLoader();
		var loginSuccess = false;
		$.ajax({  //ajax call to create ARO request in database.
			type: "POST",
			url: site_url+"/Mpps_ctl/mppsLogin",
			data: ipData,
			async: false,	
			datatype: "json",
			success: function(response){
				//validateSession(response);
				response = JSON.parse(response);
				if(response['status'] == 1)
				{
					loginSuccess = true;		
				}
				else if(response['status'] == 0)
				{				
					//displayErrorMessage(response['error']);
					$('#id_error').html("Invalid Username or Password");
					$('#id_error').show();				
				}
				hideAjaxLoader();
			},
			error: function(error){
				jAlert("Error", "Please Retry..., Unable to process your request!<br/>"+
			    	  "Most likely causes:<br/>"+
               	  	"1. Your session is expired.<br/>"+
               	  	"2. You are not connected to the Internet.<br/>"+
               	  	"3. The Domain Name Server (DNS) is not reachable.<br/>");
				hideAjaxLoader();
			}
		});
		
		if(loginSuccess)
		{			
			loadAdminPage();
		}
		
	});
});

function validateFormData(ipData)
{
	resetValidationMsgs();
	var validData = true;

	if(ipData['user_name'] == ''){
		$('#id_user_name').addClass('err_field');
		validData = false;
	}

	if(ipData['password'] == ''){
		$('#id_	password').addClass('err_field');
		validData = false;
	}	
	return validData;
}

function prepareInputData()
{
	var ipData = new Object();	
	ipData['user_name'] = $('#id_user_name').val();	
	ipData['password'] = $('#id_password').val();	
	return ipData;
}

function loadAdminPage(){
	showAjaxLoader();
	$('#admin_page_div').load(site_url+"/Mpps_ctl/loadAdminPage", 
		{},
		function(respText, status, XHR){	        				
			hideAjaxLoader();
		}
	);
	$('#my_account_div').hide();
	$('#admin_page_div').show();	
}
