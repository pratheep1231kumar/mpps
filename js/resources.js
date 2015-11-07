$(document).ready(function(){	
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
	
	$(function(){
		$('#id_av_date').datepicker({
			changeMonth: true,
		    changeYear: true,
			dateFormat: 'dd-M-yy'
		});
	});
	
	$(function(){
		$('#id_med_date').datepicker({
			changeMonth: true,
		    changeYear: true,
			dateFormat: 'dd-M-yy'
		});
	});	

});
