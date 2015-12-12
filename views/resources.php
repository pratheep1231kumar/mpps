
<!-- Header starts -->
<?php include_once("header.php"); ?>
<script src="../js/resources.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery.form.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/resources_messages.js" type="text/javascript" charset="utf-8"></script>
<!-- Header ends -->

<div id="inner_content">
 	<h2>Resources</h2>
    <!--<div id="page_construction_img">
		<img src="../images/page_under_construction.jpg" alt="Page Under Construction">
	</div>-->
   	<div id="resources_inner_main_content">
		<p align="justify">
            <b><u>We understand the real efforts in project execution and success, hence this portal is for supporting the industry at low budget, optimised schedule, uncompromised SAFETY Maximising Recovery plans of the Industry</u></b>
    		</br></br>
            Strictly professionals only can input the information at free of cost
    		</br></br>
            Employers registered with IADC or any professional organisations can contact MPPS to choose workforce at free of cost.
     		</br></br>
            <i>Please note the remuneration will be low if selected through us "sustainability than profitability"</i>
        </p>
    </div>    
   	<div id="careers_form" class="resources_left_div_form">
	    <!--<form id="careers_form" method="post" name="careers_form">-->
        	<fieldset class="resources_field_style">
            	 <div id='id_error' class='error_note'></div>
            	 </br>
                 <h5>Your Project Experience:</h5>
            	 <select class="resources_input_select mandatory" name="project_role" id="id_project_role">
                    <option value="">--- Select Current/Past Project Role ---</option>
                    <option value="Project Accountant">Project Accountant</option>
                    <option value="Project Administrator">Project Administrator</option>
                    <option value="Project Assisstant Construction Manager">Project Assisstant Construction Manager</option>
                    <option value="Project Assisstant Project Manager">Project Assisstant Project Manager</option>
                    <option value="Project Buyer">Project Buyer</option>
                    <option value="Project Commissioning Manager">Project Commissioning Manager</option>
                    <option value="Project Construction Manager">Project Construction Manager</option>
                    <option value="Project Controller">Project Controller</option>
                    <option value="Project Controls and Instrumentation Engineer">Project Controls and Instrumentation Engineer</option>
                    <option value="Project Drilling Engineer">Project Drilling Engineer</option>
                    <option value="Project Electrical Engineer">Project Electrical Engineer</option>
                    <option value="Project Manager">Project Manager</option>
                    <option value="Project Material Coordinator">Project Material Coordinator</option>
                    <option value="Project Mechanical Engineer">Project Mechanical Engineer</option>
                    <option value="Project Quality Coordinator">Project Quality Coordinator</option>
                    <option value="Project Ready to drill in charge">Project Ready to drill in charge</option>
                    <option value="Project Safety Coordinator">Project Safety Coordinator</option>
                    <option value="Project Scheduler">Project Scheduler</option>
                    <option value="Project Structural and Piping Engineer">Project Structural and Piping Engineer</option>
                    <option value="Project Sub Sea Engineer">Project Sub Sea Engineer</option>
                 </select>
              
            	 <!--<select class="resources_input_select mandatory" name="no_of_projects" id="id_no_of_projects">
                    <option value="">--- Select No of Projects ---</option>
                    <option value="3">3 Projects</option>
					<option value="4">4 Projects</option>                 
					<option value="5">5 Projects</option>                 
                    <option value="6">6 Projects</option>                 
                    <option value="7">7 Projects</option>                 
                    <option value="8">8 Projects</option>                 
                    <option value="9">9 Projects</option>                 
                    <option value="10">10 Projects</option>                 
                    <option value="others">Others</option>                 
                 </select>          
                 
                 <input type="text" title = "No of Projects" placeholder = "Others" 
                 	name="others_no_of_projects" id="id_others_no_of_projects" maxlength="25" class="mpps_input_others collapsed">-->               
  

            	 <select class="resources_input_select mandatory" name="location_of_projects" id="id_location_of_projects">
                    <option value="">--- Select Location of Projects ---</option>
                 </select>
                 
				 <div id = 'id_type_projects_div'>
	                 <input class="btn_dblue ui-button ui-widget ui-state-default ui-corner-all"
                 	  style = "font-size:14px !important;width:40px" id="id_add_button" type="button" 
	                  value="+" name="add_button" role="button" aria-disabled="false" onclick="addBox('id_type_projects_div')">
                                       
                     <select class="resources_input_select mandatory" style = "width:246px;height:30px" name="type_of_projects" 
                     	id="id_type_of_projects_0" onChange="showOthers('id_type_of_projects_0')">
                        <option value="">--- Select Type of Projects ---</option>
                        <option value="drillship">Drillship</option>                    
                        <option value="jack_up">Jack Up</option>
                        <option value="semi_submersible">Semi Submersible</option> 
                        <option value="tender_barge">Tender Barge</option> 
                        <option value="others">Others</option>               
                     </select>                     

                     <input type="text" title = "Type of Projects" placeholder = "Others" 
                        name="others_type_of_projects" id="id_others_type_of_projects_0" maxlength="25" class="mpps_input_others collapsed">    
                     
                      <select class="resources_input_select mandatory" style = "width:246px;height:30px" name="team_size" id="id_team_size_0">
                        <option value="">--- Select Project Team Size ---</option>
                        <option value="3">3 Members</option>
                        <option value="4">4 Members</option>                 
                        <option value="5">5 Members</option>                 
                        <option value="6">6 Members</option>                 
                        <option value="7">7 Members</option>                 
                        <option value="8">8 Members</option>                 
                        <option value="9">9 Members</option>                 
                        <option value="10">10 Members</option>                 
                        <option value="11">11 Members</option>                 
                        <option value="12">12 Members</option>                 
                        <option value="13">13 Members</option>                 
                        <option value="14">14 Members</option>                 
                        <option value="15">15 Members</option>                 
                        <option value="16">16 Members</option>                 
                        <option value="17">17 Members</option>                 
                        <option value="18">18 Members</option>                 
                        <option value="19">19 Members</option>                 
                        <option value="20">20 Members</option>                     
                        <option value="21">21 Members</option>                     
                        <option value="22">22 Members</option>                     
                        <option value="23">23 Members</option>                     
                        <option value="24">24 Members</option>                     
                        <option value="25">25 Members</option>                     
                        <option value="26">26 Members</option>                     
                        <option value="27">27 Members</option>                     
                        <option value="28">28 Members</option>                     
                        <option value="29">29 Members</option>                     
                        <option value="30">30 Members</option>                                         
                     </select>
                     
                     <select class="resources_input_select mandatory" style = "width:246px;height:30px" name="years_of_exp"
                      id="id_years_of_exp_0" onChange="addExperience()">
                        <option value="">--- Select Years of experience ---</option>
                        <option value="1">1 Year</option>
                        <option value="2">2 Years</option>                       
                        <option value="3">3 Years</option>
                        <option value="4">4 Years</option>                 
                        <option value="5">5 Years</option>                 
                        <option value="6">6 Years</option>                 
                        <option value="7">7 Years</option>                 
                        <option value="8">8 Years</option>                 
                        <option value="9">9 Years</option>                 
                        <option value="10">10 Years</option>                 
                        <option value="11">11 Years</option>                 
                        <option value="12">12 Years</option>                 
                        <option value="13">13 Years</option>                 
                        <option value="14">14 Years</option>                 
                        <option value="15">15 Years</option>                 
                        <option value="16">16 Years</option>                 
                        <option value="17">17 Years</option>                 
                        <option value="18">18 Years</option>                 
                        <option value="19">19 Years</option>                 
                        <option value="20">20 Years</option>
                     </select>
                                     
                   </div>
				   <div style="margin-top:3px">
                   		<h3>Total Experience : <label name ='lbl_exp' style="color: #2A2B8C !important;" id='id_lbl_exp'>0</label> Years</h3>
                   </div>

				<!--<select class="resources_input_select mandatory" name="discipline" id="id_discipline">
                    <option value="">--- Select Discipline ---</option>
                    <option value="Controls_and_Instrumentation">Controls and Instrumentation</option>
                    <option value="Drilling">Drilling</option>
                    <option value="Electrical">Electrical</option>
                    <option value="Mechanical">Mechanical</option>
                    <option value="MS_Project_Primavera">MS Project/ Primavera</option>
                    <option value="offshore">offshore</option>
                    <option value="project_office_admin">project office admin</option>
                    <option value="Safety">Safety</option>
                    <option value="shipyard">shipyard</option>
                    <option value="Steel">Steel</option>
                    <option value="SubSea">SubSea</option>
                    <option value="Supply_Chain">Supply Chain</option>  
                    <option value="others">Others</option>              
                 </select>

                 <input type="text" title = "Discipline" placeholder = "Others" 
                 	name="others_discipline" id="id_others_discipline" maxlength="25" class="mpps_input_others collapsed">-->
                 
                 
                 </br>
                 <h5>Your Personal Details:</h5>

				 <input type="text" title = "Prefix" placeholder = "Prefix" 
                 	name="prefix" id="id_prefix" maxlength="25" class="mpps_input mpps_input_small">                  
        		 <input type="text" title = "First Name" placeholder = "First Name" 
                 	name="first_name" id="id_first_name" maxlength="25" class="mpps_input mpps_input_medium mandatory">
				 <input type="text" title = "Middle Name" placeholder = "Middle Name" 
                 	name="middle_name" id="id_middle_name" maxlength="25" class="mpps_input mpps_input_medium">                    
				 <input type="text" title = "Last Name" placeholder = "Last Name/Surname " 
                 	name="last_name" id="id_last_name" maxlength="25" class="mpps_input mpps_input_medium mandatory">                  
				 <input type="text" title = "Suffix" placeholder = "Suffix" 
                 	name="suffix" id="id_suffix" maxlength="25" class="mpps_input mpps_input_small">                  

            	 <select class="resources_input_select mandatory" name="your_country" id="id_your_country">
                    <option value="">--- Select Country Of Residence ---</option>
                 </select>

            	 <select class="resources_input_select mandatory" name="your_city" id="id_your_city">
                    <option value="">--- Select City Of Residence ---</option>
                 </select></br>

        		 <input type="text" title = "Country Code" placeholder = "Code (+44) " 
                 	style="width:110px;height:30px"
                 	name="country_code" id="id_country_code" maxlength="25" class="mpps_input mandatory">

        		 <input type="text" title = "Mobile Phone" placeholder = "Mobile Number (999999999) " 
                 	style="width:273px;height:30px"
                 	name="mobile_phone" id="id_mobile_phone" maxlength="25" class="mpps_input mandatory">

        		 <input type="text" title = "Home Phone" placeholder = "Home Phone Number" 
                 	name="home_phone" id="id_home_phone" maxlength="25" class="mpps_input_full">     

        		 <input type="text" title = "E-mail" placeholder = "Email" 
                 	name="email_id" id="id_email_id" maxlength="50" class="mpps_input_full mandatory">                                

        		 <input type="text" title = "Enter Available Date" placeholder = "Available Date (DD-MMM-YYYY) " 
                 	name="av_date" id="id_av_date" maxlength="25" class="mpps_input_full mandatory">             

            	 <select class="resources_input_select mandatory" name="qualification" id="id_qualification">
                    <option value="">--- Select Highest Degree Attained---</option>
                    <option value="Master's">Master's</option>
                    <option value="Bachelor's">Bachelor's</option>   
                    <option value="Diploma">Diploma</option>
                 </select>                                  

        		 <input type="text" title = "Offshore medical expiry date" placeholder = "Offshore Medical Expiry Date (DD-MMM-YYYY) " 
                 	name="med_date" id="id_med_date" maxlength="25" class="mpps_input_full">

            	 <select class="resources_input_select" name="off_training" id="id_off_training">
                    <option value="">--- Select Offshore Training ---</option>
                    <option value="BOSIET">BOSIET valid upto</option>
                    <option value="HUET">HUET  valid upto</option>
                    <option value="Mist">Mist  valid upto</option>
                 </select>

           		 <input type="text" title = "Valid Date" placeholder = "Valid Date (DD-MMM-YYYY) " 
                 	name="valid_date" id="id_valid_date" maxlength="25" class="mpps_input_full">
                    

                 </br></br>
                 <h5>Attachments (word, pdf, jpeg - Max size(5 MB)) :</h5>
                 <form name="upload_files" id="id_upload_files" 
            		method="POST" enctype="multipart/form-data"> 
                    
                     <!--<label id='id_label_cv' class="textarea_label"> Enter Cover Letter : </label>-->
                     <textarea title = "Cover Letter" placeholder = "Enter Cover Letter" 
                        name="cv_letter" id="id_cv_letter"  class="mpps_textarea"></textarea></br>
                                      
                     <label id='id_label_resume' class="upload_label"> Upload Your Resume/CV : </label>
                     <input type="file" title = "Resume" placeholder = "Upload Your Resume" 
                        name="resume_file" id="id_resume_file"  class="mpps_input_file mandatory"
                         accept="application/pdf/word/jpg"></br>
    
    
                     <label id='id_label_resume' class="upload_label"> Supporting Document (if any) : </label>
                     <input type="file" title = "Supporting Document" placeholder = "Supporting Document (if any)" 
                        name="supp_doc" id="id_supp_doc"  class="mpps_input_file" accept="application/pdf/word/jpg" />
					 </br></br>
                     <input type="checkbox" name="terms_cond" id="id_terms_cond"> 
                     <span id='id_label_terms' class="cursor">I concerned my data can be shared with MPPS Authorized employees.</span>
                 </form>
             </fieldset>             
        <!-- </form> -->
        <div id="login_button_div" class="collapsed">
	        <input class="btn_dblue ui-button ui-widget ui-state-default ui-corner-all" id="id_submit_resources" type="button" 
            	value="Submit Details" name="submit_resources" role="button" aria-disabled="false">
        </div>

        <!-- Hidden variables... -->
        <input type='text' name='resume_file_hidden' id = 'id_resume_file_hidden' class="collapsed"/>
        <input type='text' name='cv_letter_hidden' id = 'id_cv_letter_hidden' class="collapsed"/>
        <input type='text' name='supp_doc_hidden' id = 'id_supp_doc_hidden' class="collapsed"/>
        
    </div>
</div>

    
<!-- Header starts -->
<?php include_once("footer.php"); ?>
<!-- Header ends -->