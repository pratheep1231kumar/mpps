//Global Variables.
TYPE_PROJ_CNT = 0;
$(document).ready(function(){
	loadCountries();

	$("#id_terms_cond").click(function(){
		if($(this).is(':checked')){
			$('#login_button_div').show();
		}else{
			$('#login_button_div').hide();
		}
	}); 

	$("#id_label_terms").click(function(){
		if(!$('#id_terms_cond').is(':checked')){
			$('#id_terms_cond').attr('checked', 'checked');
			$('#login_button_div').show();
		}else{
			$('#id_terms_cond').attr('checked', false);
			$('#login_button_div').hide();
		}
	});	
		
	$("#id_years_of_exp").change(function(){
		var exp = $(this).val();
		if(exp == 'others'){
			$("#id_others_years_of_exp").show();
		}
		else{
			$("#id_others_years_of_exp").hide();
		}
	}); 
	
	$("#id_no_of_projects").change(function(){
		var exp = $(this).val();
		if(exp == 'others'){
			$("#id_others_no_of_projects").show();
		}
		else{
			$("#id_others_no_of_projects").hide();
		}
	});	

	$("#id_discipline").change(function(){
		var exp = $(this).val();
		if(exp == 'others'){
			$("#id_others_discipline").show();
		}
		else{
			$("#id_others_discipline").hide();
		}
	});

	$("#id_resume_file").change(function(){
		var fileName = $(this).val();
		var fileTagName = $(this).attr('name');
		if(fileName != ''){
			fileUpload(fileName, fileTagName);
		}
	});	
	
	$("#id_cv_letter").change(function(){
		var fileName = $(this).val();
		var fileTagName = $(this).attr('name');
		if(fileName != ''){
			fileUpload(fileName, fileTagName);
		}
	});	
	
	$("#id_supp_doc").change(function(){
		var fileName = $(this).val();
		var fileTagName = $(this).attr('name');
		if(fileName != ''){
			fileUpload(fileName, fileTagName);
		}
	});		
	
	$("#id_your_country").change(function(){
		var country_id = $(this).val();
		if(country_id != ''){
			loadCites(country_id);
		}
	});			
	
	$(function(){
		$('#id_av_date').datepicker({
			changeMonth: true,
		    changeYear: true,
			dateFormat: 'dd-M-yy',
			 minDate: 0
		});
	});
	
	$(function(){
		$('#id_med_date').datepicker({
			changeMonth: true,
		    changeYear: true,
			dateFormat: 'dd-M-yy'
		});
	});	

	$(function(){
		$('#id_valid_date').datepicker({
			changeMonth: true,
		    changeYear: true,
			dateFormat: 'dd-M-yy'
		});
	});		
			
	$('#id_submit_resources').click(function(){	
		var ipData = prepareInputData();
		var validData = validateFormData(ipData);
		if(!validData)
		{
			return;
		}			
		showAjaxLoader();
		$.ajax({  //ajax call to create ARO request in database.
			type: "POST",
			url: site_url+"/Mpps_ctl/submitResources",
			data: ipData,
			datatype: "json",
			success: function(response){
				//validateSession(response);
				response = JSON.parse(response);
				if(response['status'] == 1)
				{	
					//loadSearchView(response['aro_id']);
					jAlert("Success", "Thanks for your interest in MPPPS Innovators.<br/>"+
						"Your details are successfully sent to Our team.<br/>"+
						"Our team will contact you soon.", "Success");
				}			
				else if(response['status'] == 0)
				{				
					//displayErrorMessage(response['error']);
					jAlert("Error", response['error']);
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
	});
});

function loadCountries(){
	showAjaxLoader();
	$.ajax({  //ajax call to fetch Countries information.
		type: "POST",
		url: site_url+"/Mpps_ctl/getCountries",
		data: {},
		dataType: "json",
		success: function(response){
			var countriesInfo = response;
			for(var i=0; i < countriesInfo.countries.length; i++)
			{
				var country_id = countriesInfo.countries[i].country_id;				
				var country_name = countriesInfo.countries[i].country_name;
				$('#id_location_of_projects').append("<option value='"+country_id+"'>"+					
						country_name+"</option>");
				$('#id_your_country').append("<option value='"+country_id+"'>"+					
						country_name+"</option>");						
			}
			hideAjaxLoader();						
		},
		complete: function(XHR, status){   //handle session out
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

}

function loadCites(country_id){
	showAjaxLoader();
	$.ajax({  //ajax call to fetch Countries information.
		type: "POST",
		url: site_url+"/Mpps_ctl/getCities",
		data: {country_id:country_id},
		dataType: "json",
		success: function(response){
			var citiesInfo = response;
			$('#id_your_city').empty().append("<option value=''>--- Select Your City ---</option>");
			for(var i=0; i < citiesInfo.cities.length; i++)
			{
				var city_id = citiesInfo.cities[i].city_id;				
				var city_name = citiesInfo.cities[i].city_name;
				$('#id_your_city').append("<option value='"+city_id+"'>"+					
					city_name+"</option>");								
			}
			$('#id_country_code').val('+'+citiesInfo.country_mobile_code);
			hideAjaxLoader();
		},
		complete: function(XHR, status){   //handle session out
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

}




function validateFormData(ipData)
{
	resetValidationMsgs();
	var validData = true;

	if(ipData['project_role'] == ''){
		$('#id_project_role').addClass('err_field');
		validData = false;
	}

	if(ipData['years_of_exp'] == ''){
		$('#id_years_of_exp').addClass('err_field');
		validData = false;
	}

	if(ipData['no_of_projects'] == ''){
		$('#id_no_of_projects').addClass('err_field');
		validData = false;
	}

	if(ipData['type_of_projects'] == ''){
		$('#id_type_of_projects').addClass('err_field');
		validData = false;
	}

	if(ipData['location_of_projects'] == ''){
		$('#id_location_of_projects').addClass('err_field');
		validData = false;
	}

	if(ipData['discipline'] == ''){
		$('#id_discipline').addClass('err_field');
		validData = false;
	}

	if(ipData['team_size'] == ''){
		$('#id_team_size').addClass('err_field');
		validData = false;
	}

	if(ipData['user_name'] == ''){
		$('#id_user_name').addClass('err_field');
		validData = false;
	}

	if(ipData['your_country'] == ''){
		$('#id_your_country').addClass('err_field');
		validData = false;
	}

	if(ipData['your_city'] == ''){
		$('#id_your_city').addClass('err_field');
		validData = false;
	}

	if(ipData['av_date'] == ''){
		$('#id_av_date').addClass('err_field');
		validData = false;
	}

	if(ipData['mobile_phone'] == ''){
		$('#id_mobile_phone').addClass('err_field');
		validData = false;
	}
	
	if(ipData['email_id'] == ''){
		$('#id_email_id').addClass('err_field');
		validData = false;
	}

	if(ipData['resume_file'] == ''){
		$('#id_resume_file').addClass('err_field');
		validData = false;
	}			
	
	return validData;
}

function prepareInputData()
{
	var ipData = new Object();	
	ipData['project_role'] = $('#id_project_role').val();
	
	ipData['years_of_exp'] = $('#id_years_of_exp').val();
	if(ipData['years_of_exp'] == 'others'){
		ipData['years_of_exp'] = $('#id_others_years_of_exp').val();
	}
	
	ipData['no_of_projects'] = $('#id_no_of_projects').val();
	if(ipData['no_of_projects'] == 'others'){
		ipData['no_of_projects'] = $('#id_others_no_of_projects').val();
	}
	
	ipData['type_of_projects'] = $('#id_type_of_projects').val();
	
	ipData['location_of_projects'] = $('#id_location_of_projects option:selected').text();
	
	ipData['discipline'] = $('#id_discipline').val();
	if(ipData['discipline'] == 'others'){
		ipData['discipline'] = $('#id_others_discipline').val();
	}
		
	ipData['team_size'] = $('#id_team_size').val();
	
	ipData['user_name'] = $('#id_user_name').val();
	
	ipData['your_country'] = $('#id_your_country option:selected').text();
	
	ipData['your_city'] = $('#id_your_city option:selected').text();
	
	ipData['av_date'] = $('#id_av_date').val();
	
	ipData['home_phone'] = $('#id_home_phone').val();
	
	ipData['mobile_phone'] = $('#id_mobile_phone').val();
	
	ipData['email_id'] = $('#id_email_id').val();
	
	ipData['med_date'] = $('#id_med_date').val();
	
	ipData['off_training'] = $('#id_off_training').val();
	
	ipData['resume_file'] = $('#id_resume_file_hidden').val();
	ipData['cv_letter'] = $('#id_cv_letter_hidden').val();
	ipData['supp_doc'] = $('#id_supp_doc_hidden').val();
	
	return ipData;
}

function fileUpload(fileName, fileTagName){
	
	//var fileName = $(element).val();
	
    //To fix IE firing event twice.
    if($.browser.msie)
    {
        if(LAST_UPLOADED_FILE == fileName)
        {
            return;
        }
        else
        {
           LAST_UPLOADED_FILE = fileName;
        }
    }

	var regEx = /.pdf|.doc|.jpg|.docx$/ig;
	if(!regEx.test(fileName))
	{
		jAlert("Error", resourcesMessage['only_files']);
	}
	else{	
		//ajaxLoaderShow();
		showAjaxLoader();
	    $("#id_upload_files").ajaxSubmit({
			type: "POST", 
			data: {file_tag_name:fileTagName},
			url: site_url+"/Mpps_ctl/uploadFile", 			
			dataType: "json",
			contentType: "application/pdf",
			success: function(response) { 
				if(response.status == 0)
				{
					alert("Error",response.error);
					$('input[name='+fileTagName+']').val('');
					//ajaxLoaderHide();				
					return;
				}
				else if(response.status == 1)
				{					
					$('input[name='+fileTagName+'_hidden]').val(response.name);
				}
				hideAjaxLoader();
			},
			complete: function(XHR, status){   //handle session out
			},
			error: function(error){
				jAlert("Error", "Please Retry..., Unable to process your request!<br/>"+
					  "Most likely causes:<br/>"+
					  "1. Uploaded file exceeding the size.<br/>"+
					  "2. You are not connected to the Internet.<br/>"+
					  "3. The Domain Name Server (DNS) is not reachable.<br/>");
				hideAjaxLoader();
			}			
		});	
					
	}	
}

function addBox(ident)
{
	//alert(IS_OPS);
	var count;
	TYPE_PROJ_CNT++;
	count = TYPE_PROJ_CNT;
	
	var strBox = "<div id='id_type_proj_div_"+count+"'><input class='btn_dblue ui-button ui-widget ui-state-default ui-corner-all'"+
                 	  "style = 'font-size:14px !important;width:40px' id='id_add_button' type='button' "+
	                  "value='-' name='remove_button' role='button' aria-disabled='false' onclick=removeBox("+"'id_type_proj_div_"+count+"'"+")> "+
                                       
                     "<select class='resources_input_select mandatory' style = 'width:246px;height:30px' name='type_of_projects' id='id_type_of_projects_"+
					 count+"' onChange=showOthers('id_type_of_projects_"+count+"')> "+
                     "<option value=''>--- Select Type of Projects ---</option>"+
                     "<option value='drillship'>Drillship</option>"+     
                     "<option value='jack_up'>Jack Up</option>"+
                     "<option value='semi_submersible'>Semi Submersible</option>"+
                     "<option value='tender_barge'>Tender Barge</option>"+ 
					 "<option value='others'>Others</option>"+     
                     "</select> "+
					 "<input type='text' title = 'Type of Projects' placeholder = 'Others'"+ 
                     "name='others_type_of_projects' id='id_others_type_of_projects_"+count+"' maxlength='25' class='mpps_input_others collapsed'> "+                                       
                      "<select class='resources_input_select mandatory' style = 'width:246px;height:30px' name='team_size' id='id_team_size_"+count+"'>"+
                      "  <option value=''>--- Select Project Team Size ---</option>";
	for(var i=3; i<=30; i++){
		strBox += "<option value='"+i+"'>"+i+" Members</option>";
	}
	strBox += "</select> ";
	
	strBox += "<select class='resources_input_select mandatory' style = 'width:246px;height:30px' name='years_of_exp' id='id_years_of_exp_"+count+"'onChange=addExperience()>"+
                      "  <option value=''>--- Select Years of experience ---</option>";
	for(var i=1; i<=30; i++){
		strBox += "<option value='"+i+"'>"+i+" Years</option>";
	}	
	
    strBox += "</select></div>"; 
	
	$("#"+'id_type_projects_div').append(strBox);
	
	$("input:button, input:submit, input:reset").button();
}

function removeBox(element)
{
	$('#'+element).remove();
	TYPE_PROJ_CNT--;
	addExperience();
}

function showOthers(element){
	var div_id = element;
	var count =  div_id.substr(div_id.lastIndexOf('_')+1);
	var exp = $('#'+element).val();
	if(exp == 'others'){
		$("#id_others_type_of_projects_"+count).show();
	}
	else{
		$("#id_others_type_of_projects_"+count).hide();
	}
}

function addExperience(){
	var total_exp = 0;
	$('select[id^="id_years_of_exp_"]').each(function(){
		total_exp += Number($(this).val());
	});
	$('#id_lbl_exp').text(total_exp);
}