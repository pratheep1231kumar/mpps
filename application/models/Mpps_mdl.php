<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpps_mdl extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
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
	
	public function submitResources($input_data)
	{
		$retStat;
		$mail_body = "<table border='1'>";
		$mail_body .= "<tr><td>Project Role : </td><td>".$input_data['project_role']."</td></tr>";
		$mail_body .= "<tr><td>Years of Exp : </td><td>".$input_data['years_of_exp']."</td></tr>";
		$mail_body .= "<tr><td>No of Projects : </td><td>".$input_data['no_of_projects']."</td></tr>";
		$mail_body .= "<tr><td>Type of Projects : </td><td>".$input_data['type_of_projects']."</td></tr>";
		$mail_body .= "<tr><td>Location of Projects : </td><td>".$input_data['location_of_projects']."</td></tr>";
		$mail_body .= "<tr><td>Discipline : </td><td>".$input_data['discipline']."</td></tr>";
		$mail_body .= "<tr><td>Team Size : </td><td>".$input_data['team_size']."</td></tr>";
		$mail_body .= "<tr><td>Name : </td><td>".$input_data['user_name']."</td></tr>";
		$mail_body .= "<tr><td>Country : </td><td>".$input_data['your_country']."</td></tr>";
		$mail_body .= "<tr><td>City : </td><td>".$input_data['your_city']."</td></tr>";
		$mail_body .= "<tr><td>Available Date : </td><td>".$input_data['av_date']."</td></tr>";
		$mail_body .= "<tr><td>Mobile Phone : </td><td>".$input_data['mobile_phone']."</td></tr>";
		$mail_body .= "<tr><td>Email Id : </td><td>".$input_data['email_id']."</td></tr>";
		$mail_body .= "<tr><td>Home Phone : </td><td>".$input_data['home_phone']."</td></tr>";		
		$mail_body .= "<tr><td>Offshore Medical Expiry Date : </td><td>".$input_data['med_date']."</td></tr>";
		$mail_body .= "<tr><td>Offshore Training : </td><td>".$input_data['off_training']."</td></tr>";
		$mail_body .= "</table>";
		
		$mail_headers = "MIME-Version: 1.0" . "\n";
		$mail_headers .= "Content-type:text/html;charset=iso-8859-1" . "\n";
		$mail_headers .= 'From: <resources@mppsinnovators.co.uk>' . "\n";
		
		$mail_subject = "resource details submitted";		
		$mail_to = RESOURCES_MAIL_TO;
		
		$mail_body = "\r\n".$mail_body."\r\n";		
		
		#Attaching Resume File
		if($input_data['resume_file'] != '')
		{
			$strFile = $input_data['resume_file'];
			$strRandomHash=md5($_SERVER["REQUEST_TIME"].":".strval(rand()));
			$mail_body.="\r\n--".$strRandomHash."\r\n";
			$mail_body.="Content-Type: application/octet-stream; name=\"".$strFile."\"\r\n";
			$mail_body.="Content-Transfer-Encoding: base64\r\n";
			$mail_body.="Content-Disposition: attachment;  filename=\"".$strFile."\"\r\n\r\n";
			$mail_body.="\r\n".chunk_split(base64_encode(file_get_contents(FILE_DB_PATH.$strFile)))."\r\n";			
		}
		if($input_data['cv_letter'] != '')
		{
			$strFile = $input_data['cv_letter'];
			$strRandomHash=md5($_SERVER["REQUEST_TIME"].":".strval(rand()));
			$mail_body.="\r\n--".$strRandomHash."\r\n";
			$mail_body.="Content-Type: application/octet-stream; name=\"".$strFile."\"\r\n";
			$mail_body.="Content-Transfer-Encoding: base64\r\n";
			$mail_body.="Content-Disposition: attachment;  filename=\"".$strFile."\"\r\n\r\n";
			$mail_body.="\r\n".chunk_split(base64_encode(file_get_contents(FILE_DB_PATH.$strFile)))."\r\n";			
		}
		if($input_data['supp_doc'] != '')
		{
			$strFile = $input_data['supp_doc'];
			$strRandomHash=md5($_SERVER["REQUEST_TIME"].":".strval(rand()));
			$mail_body.="\r\n--".$strRandomHash."\r\n";
			$mail_body.="Content-Type: application/octet-stream; name=\"".$strFile."\"\r\n";
			$mail_body.="Content-Transfer-Encoding: base64\r\n";
			$mail_body.="Content-Disposition: attachment;  filename=\"".$strFile."\"\r\n\r\n";
			$mail_body.="\r\n".chunk_split(base64_encode(file_get_contents(FILE_DB_PATH.$strFile)))."\r\n";			
		}
		
		
		try
		{
			$status = mail($mail_to, $mail_subject, $mail_body, $mail_headers);
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
}
