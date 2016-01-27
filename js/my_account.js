var RESOURCES_TABLE;

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

/**
	@Description: Load Data Table with ARO requests.
	@param		: None
	@return		: None
*/
function loadResourcesTable() {	
	// creating DataTables object for containing preferences list
	RESOURCES_TABLE=$("#id_resources_table").dataTable({
		"sPaginationType": "full_numbers",
		"bJQueryUI": true,
		"iDisplayLength": 10,
		"bFilter": false,
		"bServerSide": true,
        "sDom": '<"H"lfrp>t<"F"ip>',
		"bSort": false,
		"sAjaxSource": site_url+"/Mpps_ctl/loadResources",
        "oLanguage": {
            "sLengthMenu": "Show Records: _MENU_",
            "sZeroRecords": "No matching records found"
        },
		"fnServerData": function(sSource, aoData, fnCallback){	
			showAjaxLoader();
			$.ajax({
				"dataType": 'json',
				"type": "POST",
				"url": sSource,
				"data": aoData,
				"success": fnCallback,
				complete: function(XHR, status){   //handle session out
					hideAjaxLoader();					
				},
				error: function(error){
					jAlert("Error", "Please Retry..., Unable to process your request!<br/>"+
					      "Most likely causes:<br/>"+
                    	  "1. Your session is expired.<br/>"+
                    	  "2. You are not connected to the Internet.<br/>"+
                    	  "3. The Domain Name Server (DNS) is not reachable.<br/>");
				}
			});
		},
		"bAutoWidth" : false, 
		"aoColumns": [
			{"sClass": "left" , "bSortable": false},
			{"sClass": "left" , "bSortable": false},
			{"sClass": "left" , "bSortable": false},
			{"sClass": "left" , "bSortable": false},
			{"sClass": "left" , "bSortable": false},
			{"sClass": "left" , "bSortable": false},
			{"sClass": "left" , "bSortable": false},
			{"sClass": "left" , "bSortable": false},
			{"sClass": "left" , "bSortable": false, "bVisible": false}
		],
		"fnDrawCallback": fnOpenClose
	});
}

function fnOpenClose ( oSettings )
{
	$('td [id^="resource"]', RESOURCES_TABLE.fnGetNodes() ).each( function () {
		$(this).click( function () {
			var nTr = this.parentNode.parentNode;										
			var nRemove = $(nTr).next()[0];
			var mpps_id = $(nTr).find("a").attr("id");				
			//open							 
			if(mpps_id.substr(9,1)==0){
				$(nTr).find("a").attr("id",$(nTr).find("a").attr("id").replace("_0_","_1_"));
				$(nTr).find("a").text('less');
				$(nTr).find("img").attr('src','../images/icon_up.gif')
				var id = mpps_id.substring(11);
				RESOURCES_TABLE.fnOpen(nTr, formatDetails(nTr), 'resource_details' );
			}
			else{
				// close
				if($(nRemove).find('td').is(".resource_details")){
					$(nTr).find("a").attr("id",$(nTr).find("a").attr("id").replace("_1_","_0_"));
					$(nTr).find("a").text('more');
					$(nTr).find("img").attr('src','../images/icon_up.gif');
					nRemove.parentNode.removeChild(nRemove);
				 }
			}
		});
	});
}

function formatDetails(nTr )
{				
	var aData = RESOURCES_TABLE.fnGetData( nTr ); 
	var ResourceData = JSON.parse(aData[8]);
	var html = '';
	if(ResourceData.id)
	{
    	var years_of_exp = ResourceData.years_of_exp;
        var no_of_projects = ResourceData.no_of_projects;
        var type_of_projects = ResourceData.type_of_projects;
		var location_of_projects = ResourceData.location_of_projects;
		var discipline = ResourceData.discipline;
		
		html += "<table class='resource_margin_bottom' id='resource_details_table' cellpadding='0' width='100%' cellspacing='0' border='0'  >"+
			"<tr><td><b>Years Of Exp</b></td><td>: "+ResourceData.years_of_exp+"</td>"+
			"<td><b>Home Phone</b></td><td>: "+ResourceData.home_phone+"</td>"+
			"<tr><td><b>Location Of Projects</b></td><td>: "+ResourceData.location_of_projects+"</td>"+
			"<td><b>Email</b></td><td>: "+ResourceData.email_id+"</td>"+
			"<tr><td><b>Mobile</b></td><td>: "+ResourceData.mobile_phone+"</td>"+
			"</table>";					
	}

	return html;	
}

function validateFormData(ipData)
{
	resetValidationMsgs();
	var validData = true;

	if(ipData['user_name'] == ''){
		$('#id_user_name').addClass('err_field');
		validData = false;
	}

	if(ipData['password'] == ''){
		$('#id_password').addClass('err_field');
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
