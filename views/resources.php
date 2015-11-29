
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
   	<div id="careers_inner_main_content">
		<p align="justify">
        	We understand the real efforts in project execution and success, hence this portal is for supporting the industry at low budget, 
        	optimised schedule, uncompromised SAFETY Maximising Recovery plans of the Industry. Strictly for only candidates can input the information at free 
            of cost. No agencies access please. Employers registered with IADC, ISO or any professional organisations can contact MPPS to choose workforce at 
            free of cost. Please note that remuneration will be low if selected through us "NO MARK UPS FOR US, SERIOUSLY NO".

        </p>
    </div>    
   	<div id="careers_form" class="resources_left_div_form">
	    <!--<form id="careers_form" method="post" name="careers_form">-->
        	<fieldset class="resources_field_style">
            	 <div id='id_error' class='error_note'></div>
            	 <h5>Project Details:</h5>
            	 <select class="resources_input_select mandatory" name="project_role" id="id_project_role">
                    <option value="">--- Select Project Role ---</option>
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

            	 <select class="resources_input_select mandatory" name="years_of_exp" id="id_years_of_exp">
                    <option value="">--- Select Years of experience ---</option>
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
                    <option value="others">Others</option>                  
                 </select>
                 
                 <input type="text" title = "Years of Experience" placeholder = "Others" 
                 	name="others_years_of_exp" id="id_others_years_of_exp" maxlength="25" class="mpps_input_others collapsed">
                 
            	 <select class="resources_input_select mandatory" name="no_of_projects" id="id_no_of_projects">
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
                 	name="others_no_of_projects" id="id_others_no_of_projects" maxlength="25" class="mpps_input_others collapsed">               

            	 <select class="resources_input_select mandatory" name="type_of_projects" id="id_type_of_projects">
                    <option value="">--- Select Type of Projects ---</option>
					<option value="drillship">Drillship</option>                    
                    <option value="jack_up">Jack Up</option>
					<option value="semi_submersible">Semi Submersible</option>                 
                 </select>          

            	 <select class="resources_input_select mandatory" name="location_of_projects" id="id_location_of_projects">
                    <option value="">--- Select Location of Projects ---</option>
                 </select>
                 
                 <select class="resources_input_select mandatory" name="discipline" id="id_discipline">
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
                 	name="others_discipline" id="id_others_discipline" maxlength="25" class="mpps_input_others collapsed">               

            	 <select class="resources_input_select mandatory" name="team_size" id="id_team_size">
                    <option value="">--- Select Team Size ---</option>
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
                 
                 <h5>Personal Details:</h5>
                                  
        		 <input type="text" title = "Enter Your Name" placeholder = "Your First Name & Sir Name " 
                 	name="user_name" id="id_user_name" maxlength="25" class="mpps_input_full mandatory">

        		 <input type="text" title = "Enter Available Date" placeholder = "Available Date (DD-MMM-YYYY) " 
                 	name="av_date" id="id_av_date" maxlength="25" class="mpps_input_full mandatory">               

            	 <select class="resources_input_select mandatory" name="your_country" id="id_your_country">
                    <option value="">--- Select Your Country ---</option>
                 </select>

            	 <select class="resources_input_select mandatory" name="your_city" id="id_your_city">
                    <option value="">--- Select Your City ---</option>
                 </select>

        		 <input type="text" title = "Mobile Phone" placeholder = "Mobile Number (+91 999999999) " 
                 	name="mobile_phone" id="id_mobile_phone" maxlength="25" class="mpps_input_full mandatory">                                

        		 <input type="text" title = "E-mail" placeholder = "Email Id" 
                 	name="email_id" id="id_email_id" maxlength="50" class="mpps_input_full mandatory">                                

        		 <input type="text" title = "Home Phone" placeholder = "Home Phone Number (+91 999999999) " 
                 	name="home_phone" id="id_home_phone" maxlength="25" class="mpps_input_full">                 

        		 <input type="text" title = "Offshore medical expiry date" placeholder = "Offshore Medical Expiry Date (DD-MMM-YYYY) " 
                 	name="med_date" id="id_med_date" maxlength="25" class="mpps_input_full">                 

            	 <select class="resources_input_select" name="off_training" id="id_off_training">
                    <option value="">--- Select Offshore Training ---</option>
                    <option value="BOSIET">BOSIET valid upto</option>
                    <option value="HUET">HUET  valid upto</option>
                    <option value="Mist">Mist  valid upto</option>
                 </select>
                 
                 <h5>Attachments (word, pdf, jpg - Max size(10 MB)) :</h5>
                 <form name="upload_files" id="id_upload_files" 
            		method="POST" enctype="multipart/form-data">               
                     <label id='id_label_resume' class="upload_label"> Upload Your Resume : </label>
                     <input type="file" title = "Resume" placeholder = "Upload Your Resume" 
                        name="resume_file" id="id_resume_file"  class="mpps_input_file mandatory"
                         accept="application/pdf/word/jpg"></br>
    
                     <label id='id_label_resume' class="upload_label"> Upload Cover Letter : </label>
                     <input type="file" title = "Cover Letter" placeholder = "Upload Cover Letter" 
                        name="cv_letter" id="id_cv_letter"  class="mpps_input_file" accept="application/pdf/word/jpg"></br>
    
                     <label id='id_label_resume' class="upload_label"> Supporting Document (if any) : </label>
                     <input type="file" title = "Supporting Document" placeholder = "Supporting Document (if any)" 
                        name="supp_doc" id="id_supp_doc"  class="mpps_input_file" accept="application/pdf/word/jpg" />
                 </form>
             </fieldset>             
        <!-- </form> -->
        <div id="login_button_div">
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