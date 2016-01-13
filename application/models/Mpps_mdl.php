<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpps_mdl extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->strFilesLocPath = FILE_DB_PATH;
	}
	
	public function getCountries()
	{
		$countriesFormatted = array();		
		$countriesFormatted['countries'] = array();
		$query = $this->db->query('SELECT id, name FROM mpps_innovators.countries ORDER BY name ASC');
		$cities = array();
		foreach($query->result() as $row)
		{
			array_push($countriesFormatted['countries'], 
			array('country_id' => $row->id, 'country_name' => $row->name));			
		}
		return $countriesFormatted;
	}

	public function getCities($country_id)
	{
		$citiesFormatted = array();		
		$citiesFormatted['cities'] = array();
		$query = $this->db->query(
			'SELECT c.* FROM mpps_innovators.cities AS c
			JOIN (SELECT s.id FROM mpps_innovators.states s
			JOIN mpps_innovators.countries c
			ON s.country_id = c.id
			WHERE c.id = '.$country_id.') AS state_ids
			ON c.state_id = state_ids.id
			ORDER BY c.name ASC;'
		);
		$cities = array();
		foreach($query->result() as $row)
		{
			array_push($citiesFormatted['cities'], 
			array('city_id' => $row->id, 'city_name' => $row->name));			
		}
		return $citiesFormatted;
	}
	
	public function getCountryMobileCode($country_id)
	{
		$country_mobile_code = '';
		$query = $this->db->query(
			'SELECT country_mobile_code FROM 
			 mpps_innovators.countries c
			WHERE c.id = '.$country_id.';'
		);

		foreach($query->result() as $row)
		{
			if($row->country_mobile_code){
				$country_mobile_code = $row->country_mobile_code;
			}
		}
		return $country_mobile_code;
	}
	
	public function submitResources($input_data)
	{

		#Prepare Data for DB insertion
		$insert_data = array();
		$insert_data['project_role'] = $input_data['project_role'];
		$insert_data['location_of_projects'] = $input_data['location_of_projects'];
		$insert_data['years_of_exp'] = $input_data['total_years_of_exp'];
		$insert_data['user_name'] = $input_data['prefix'].' '.$input_data['first_name'].' '.
			$input_data['middle_name'].' '.$input_data['last_name'].' '.$input_data['suffix'];
		$insert_data['your_country'] = $input_data['your_country'];
		$insert_data['your_city'] = $input_data['your_city'];
		$insert_data['mobile_phone'] = $input_data['mobile_phone'];
		if($input_data['home_phone'] != '')
		{
			$insert_data['home_phone'] = $input_data['home_phone'];
		}
		$insert_data['email_id'] = $input_data['email_id'];
		$insert_data['av_date'] = date('Y-m-d',strtotime($input_data['av_date']));
		$insert_data['qualification'] = $input_data['qualification'];
		if($input_data['med_date'] != '')
		{
			$insert_data['med_date'] = date('Y-m-d',strtotime($input_data['med_date']));
		}
		if($input_data['cv_letter'] != '')
		{
			$insert_data['cv_letter'] = $input_data['cv_letter'];
		}
		$insert_data['resume_file'] = $input_data['resume_file'];
		if($input_data['supp_doc'] != '')
		{
			$insert_data['supp_doc'] = $input_data['supp_doc'];
		}
		
		
		#Prepare for e-mail body.
		$retStat;
		$attachments = array();
		$mail_body = "<table border='1'>";
		$mail_body .= "<tr><td>Project Role : </td><td>".$insert_data['project_role']."</td></tr>";
		$mail_body .= "<tr><td>Years of Exp : </td><td>".$insert_data['years_of_exp']."</td></tr>";
		$mail_body .= "<tr><td>Location of Projects : </td><td>".$insert_data['location_of_projects']."</td></tr>";
		$mail_body .= "<tr><td>Name : </td><td>".$insert_data['user_name']."</td></tr>";
		$mail_body .= "<tr><td>Country : </td><td>".$insert_data['your_country']."</td></tr>";
		$mail_body .= "<tr><td>City : </td><td>".$insert_data['your_city']."</td></tr>";
		$mail_body .= "<tr><td>Available Date : </td><td>".$input_data['av_date']."</td></tr>";
		$mail_body .= "<tr><td>Mobile Phone : </td><td>".$insert_data['mobile_phone']."</td></tr>";
		$mail_body .= "<tr><td>Email Id : </td><td>".$insert_data['email_id']."</td></tr>";
		$mail_body .= "<tr><td>Home Phone : </td><td>".$input_data['home_phone']."</td></tr>";		
		$mail_body .= "<tr><td>Offshore Medical Expiry Date : </td><td>".$input_data['med_date']."</td></tr>";
		$mail_body .= "</table>";	
		if($input_data['type_proj_cnt'] > 0){
			$mail_body .= "</br></br><table border='1'>";
			$mail_body .= "<tr><td><b>Project Type</b></td>";
			$mail_body .= "<td><b>Team Size</b></td>";
			$mail_body .= "<td><b>Experience (Years)</b></td></tr>";
			for($i=0; $i< $input_data['type_proj_cnt']; $i++){
				$mail_body .= "<tr><td>".$input_data['type_of_projects_'.$i]."</td>";
				$mail_body .= "<td>".$input_data['team_size_'.$i]."</td>";
				$mail_body .= "<td>".$input_data['years_of_exp_'.$i]."</td></tr>";
			}
			$mail_body .= "</table>";				
		}
		if($input_data['off_trng_cnt'] > 0){
			$mail_body .= "</br></br><table border='1'>";
			$mail_body .= "<tr><td><b>Offshore Training</b></td>";
			$mail_body .= "<td><b>Valid Date</b></td></tr>";
			for($i=0; $i< $input_data['off_trng_cnt']; $i++){
				$mail_body .= "<tr><td>".$input_data['off_training_'.$i]."</td>";
				$mail_body .= "<td>".$input_data['valid_date_'.$i]."</td></tr>";
			}
			$mail_body .= "</table>";				
		}

		$mail_subject = "resource details submitted";		
		$mail_to = RESOURCES_MAIL_TO;
		#Attaching Resume File
		if($input_data['resume_file'] != '')
		{
			$attachments['resume_file'] = $input_data['resume_file'];
		}
		if($input_data['supp_doc'] != '')
		{
			$attachments['supp_doc'] = $input_data['supp_doc'];
		}
		
		try
		{	
			$result = $this->db->insert('mpps_innovators.resources', $insert_data);
			$last_insert_id = $this->db->insert_id();
			
			#Insert Project Details
			if($input_data['type_proj_cnt'] > 0){
				for($i=0; $i< $input_data['type_proj_cnt']; $i++){
					$project_data = array();
					$project_data['resource_id'] = $last_insert_id;
					$project_data['project_type'] = $input_data['type_of_projects_'.$i];
					$project_data['team_size'] = $input_data['team_size_'.$i];
					$project_data['years_of_exp'] = $input_data['years_of_exp_'.$i];
					$result = $this->db->insert('mpps_innovators.resources_projects', $project_data); 
				}
			}
			#Insert Training Details
			if($input_data['off_trng_cnt'] > 0){
				for($i=0; $i< $input_data['off_trng_cnt']; $i++){
					$trainings_data = array();
					$trainings_data['resource_id'] = $last_insert_id;
					$trainings_data['offshore_training'] = $input_data['off_training_'.$i];					
					$trainings_data['valid_upto'] = date('Y-m-d',strtotime($input_data['valid_date_'.$i]));
					$result = $this->db->insert('mpps_innovators.resources_trainings', $trainings_data); 					
				}
			}			
			
			$status = $this->send($mail_to, $mail_subject, $mail_body, $attachments);
			$retStat=array("status" => 1);
		}
		catch(Exception $e)
		{
			//Something went bad
			echo "Fail :(";
			$retStat=array("status" => 0, "error" => $e);
		}			
		
		return $retStat;
	}
	
	public function uploadFile($file, $file_tag_name)
	{
		if(!isset($file[$file_tag_name]['size']))
		{
			$retStat=array("status" => "0", "error" => "Exceeding file size limit...");
			return $retStat;			
		}		
		switch($file[$file_tag_name]["error"])
		{
			case UPLOAD_ERR_OK:
			{
				if(!file_exists(FILE_DB_PATH))
				{
					 mkdir(FILE_DB_PATH, 0777);					
				}
				$dirname = FILE_DB_PATH;
				$output = preg_match('/(.*?)\.(\w+)$/', $file[$file_tag_name]["name"], $file_strings);
				$filename = $file_strings[1].'_'.date("YmdGis").'.'.$file_strings[2];
				$filename = str_replace(' ','_', $filename);
				move_uploaded_file($file[$file_tag_name]["tmp_name"], $dirname.$filename);
				$retStat=array("status" => "1",	"name" => $filename);
				break;
			}
			case UPLOAD_ERR_PARTIAL:
			{
				$retStat=array("status" => "0",	"error" => "File is partly uploaded...");	
				break;
			}
			case UPLOAD_ERR_NO_FILE:
			{
				$retStat=array("status" => "0", "error" => "No file to upload...");						
				break;
			}
			default:
			{
	
				break;
			}
		}
		return $retStat;	
	}

	public function send($strToEmailIds, $strSubject, $strMessage, $attachments=NULL, $strCcEmailIds='',$strBCcEmailIds='')
	{
		//boundary string for multipart/mixed must be unique
		$strRandomHash=md5($_SERVER["REQUEST_TIME"].":".strval(rand())); 
		$strHeaders ="";
		$strBody =""; 
		$strHeaders.="From: "."resources@mppsinnovators.co.uk"."\r\n";
		$strHeaders.="Reply-To: "."pratheep1231kumar@gmail.com"."\r\n";
		if("" != $strCcEmailIds)$strHeaders.="Cc: ".$strCcEmailIds."\r\n"; 
		if("" != $strBCcEmailIds)$strHeaders.="Bcc: ".$strBCcEmailIds."\r\n";
		$strHeaders.="MIME-Version: 1.0\r\n";
		$strHeaders.="Content-Type: multipart/mixed;boundary=\"".$strRandomHash."\"\r\n";
		$strBody.="\r\n--".$strRandomHash."\r\n";
		$strBody.="Content-Type: text/html;charset=UTF-8\r\n";
		$strBody .= "\r\n".$strMessage ."\r\n";
		if(!is_null($attachments))
		{
			if("" != $this->strFilesLocPath)
			{
				if(is_array($attachments))
				{
					foreach($attachments as $nKey => $strFileName)
					{
						$strBody.="\r\n--".$strRandomHash."\r\n";
						$strBody.="Content-Type: application/octet-stream; name=\"".$strFileName."\"\r\n";
						$strBody.="Content-Transfer-Encoding: base64\r\n";
						$strBody.="Content-Disposition: attachment;  filename=\"".$strFileName."\"\r\n\r\n";
						$strBody.="\r\n".chunk_split(base64_encode(file_get_contents($this->strFilesLocPath.$strFileName)))."\r\n";
					}
				}
				else
				{
						$strBody.="\r\n--".$strRandomHash."\r\n";
						$strBody.="Content-Type: application/octet-stream; name=\"".$attachments."\"\r\n";
						$strBody.="Content-Transfer-Encoding: base64\r\n";
						$strBody.="Content-Disposition: attachment;  filename=\"".$attachments."\"\r\n\r\n";
						$strBody.="\r\n".chunk_split(base64_encode(file_get_contents($this->strFilesLocPath.$attachments)))."\r\n";			
				}			
			}
			else
			{
				return FALSE; 
			}
		}
		$strBody.="\r\n--".$strRandomHash."--";	
		return mail($strToEmailIds, $strSubject, $strBody, $strHeaders);
	}
	
	function mppsLogin($input_data)
	{
		$condition = "user_name ="."'".$input_data['user_name']."'"."AND user_password ="."'".$input_data['password']."'";
		$this->db->select('*');
		$this->db->from('mpps_innovators.user_login');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if($query->num_rows() == 1){
			return $query->result();
		}
		else{
			return false;
		}		
	}
	
	public function loadResources($iDisplayStart=NULL, $iDisplayLength=NULL)
	{
		$resourcesRequests = array();		
		$filteredTotal = 0;
		if(isset($iDisplayStart) && isset($iDisplayLength))
		{
			$resourcesRequests = $this->getResources($iDisplayStart,$iDisplayLength);
			$filteredTotal = $resourcesRequests['filtered_total'];
			$resourcesRequests = $resourcesRequests['resources_data'];			

		}
		//Prepare json output
		$output = array(
			 'iTotalRecords' => $filteredTotal,
			 'iTotalDisplayRecords' => $filteredTotal,
			 'aaData' => array()
		);				
		
		foreach($resourcesRequests as $resourcesRequest)
		{
			$resourcesRequestData = array();
			$extraDetails = array();
			
			array_push($resourcesRequestData, $resourcesRequest->id);
			array_push($resourcesRequestData, $resourcesRequest->created_on);
			array_push($resourcesRequestData, $resourcesRequest->user_name);
			array_push($resourcesRequestData, $resourcesRequest->project_role);
            array_push($resourcesRequestData, $resourcesRequest->discipline);
			array_push($resourcesRequestData, $resourcesRequest->your_country);
			array_push($resourcesRequestData, $resourcesRequest->your_city);
			$moreOption = "<img src='../images/icon_down.gif'".
                "id=resource_0_".$resourcesRequest->id.
				"class='resource_image_style resource_cursor'>".
				" <a class = 'resource_cursor' id=resource_0_".$resourcesRequest->id.
				">more</a>";				
			array_push($resourcesRequestData, $moreOption);
			
			$extraDetails['id'] = $resourcesRequest->id;
			$extraDetails['created_on'] = $resourcesRequest->created_on;
			$extraDetails['project_role'] = $resourcesRequest->project_role;
			$extraDetails['years_of_exp'] = $resourcesRequest->years_of_exp;
			$extraDetails['no_of_projects'] = $resourcesRequest->no_of_projects;
			$extraDetails['type_of_projects'] = $resourcesRequest->type_of_projects;
			$extraDetails['location_of_projects'] = $resourcesRequest->location_of_projects;
			$extraDetails['discipline'] = $resourcesRequest->discipline;
			$extraDetails['team_size'] = $resourcesRequest->team_size;
			$extraDetails['user_name'] = $resourcesRequest->user_name;
			$extraDetails['your_country'] = $resourcesRequest->your_country;
			$extraDetails['your_city'] = $resourcesRequest->your_city;
			$extraDetails['av_date'] = $resourcesRequest->av_date;
			$extraDetails['mobile_phone'] = $resourcesRequest->mobile_phone;
			$extraDetails['email_id'] = $resourcesRequest->email_id;
			$extraDetails['home_phone'] = $resourcesRequest->home_phone;
			$extraDetails['med_date'] = $resourcesRequest->med_date;
			$extraDetails['off_training'] = $resourcesRequest->off_training;
			$extraDetails['resume_file'] = $resourcesRequest->resume_file;
			$extraDetails['cv_letter'] = $resourcesRequest->cv_letter;
			$extraDetails['supp_doc'] = $resourcesRequest->supp_doc;
		
			array_push($resourcesRequestData, json_encode($extraDetails));
			array_push($output['aaData'], $resourcesRequestData);		
		}
		return $output;
	}	
	
	public function getResources($rowsStart=NULL, $rowsCount=NULL)
	{
		$resourcesRequests = array();
		//Prepare sql query to fetch active ARO records.
        $sql = "SELECT id, DATE_FORMAT( created_on, '%d-%b-%Y %H:%i' ) AS created_on, 
				project_role, years_of_exp, no_of_projects, type_of_projects, 
				location_of_projects, discipline, team_size, user_name, your_country, 
				your_city, av_date, mobile_phone, email_id, home_phone, med_date, 
				off_training, resume_file, cv_letter, supp_doc
				FROM mpps_innovators.resources ORDER BY created_on DESC	";
		
		//Execute query
		$query = $this->db->query($sql);
		
		foreach($query->result() as $row)
		{
			array_push($resourcesRequests, $row);
		}
		
		//Set LIMIT to Array.
		if(isset($rowsStart) and isset($rowsCount))
		{
			$resourcesFilteredTotal = count($resourcesRequests);
			$resourcesLimitArray = array();
			$resourcesIndex = 0;
			foreach($resourcesRequests as $resourcesRequest)
			{
				if($resourcesIndex >= $rowsStart and $resourcesIndex < $rowsStart+$rowsCount)
				{
					array_push($resourcesLimitArray , $resourcesRequest);
				}
				$resourcesIndex++;
			}
		    $resourcesLimitArray = array('resources_data' => $resourcesLimitArray, 
				'status' => '1',
				'filtered_total' => $resourcesFilteredTotal);			
			return $resourcesLimitArray;
		}
		else
		{
			return array('status' => 1, 'resources_data' => $resourcesRequests);
		}	
	}	
}
	

