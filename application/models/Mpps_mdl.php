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
	
	public function submitResources($input_data)
	{
		$retStat;
		$attachments = array();
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
		$mail_subject = "resource details submitted";		
		$mail_to = RESOURCES_MAIL_TO;
		
		#Attaching Resume File
		if($input_data['resume_file'] != '')
		{
			$attachments['resume_file'] = $input_data['resume_file'];
		}
		if($input_data['cv_letter'] != '')
		{
			$attachments['cv_letter'] = $input_data['cv_letter'];
		}
		if($input_data['supp_doc'] != '')
		{
			$attachments['supp_doc'] = $input_data['supp_doc'];
		}
		
		
		try
		{	
			$input_data['av_date'] = date('Y-m-d',strtotime($input_data['av_date']));
			if($input_data['med_date'] != '')
			{
				$input_data['med_date'] = date('Y-m-d',strtotime($input_data['med_date']));
			}
			else{
				unset($input_data['med_date']);
			}
			$this->db->insert('mpps_innovators.resources', $input_data);
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
}
