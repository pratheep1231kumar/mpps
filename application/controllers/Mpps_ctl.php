<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpps_ctl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mpps_mdl');
		// Load session library
		$this->load->library('session');
	}

	public function index()
	{
		#$this->load->view('welcome_message');
	}
	
	public function mppsLogin()
	{
		//if(isset($this->session->userdata['logged_in'])){
		//	$this->load->view('admin_page');
		//}	
		$inputData = $this->input->post(NULL, TRUE);	
		$result = $this->Mpps_mdl->mppsLogin($inputData);
		if($result != false){
			$session_data = array(
				'username' => $result[0]->user_name				
			);
			// Add user data in session
			$this->session->set_userdata('logged_in', $session_data);
			$status = array("status" => 1, "username" => $result[0]->user_name);				
		}
		else{
			$status = array("status" => 0, "error" => "Invalid Login");			
		}
		echo json_encode($status);
	}
	
	public function loadAdminPage()
	{
		$this->load->view('admin_page', $this->session->userdata['logged_in']);
	}
	
	
	public function submitResources()
	{
		$inputData = $this->input->post(NULL, TRUE);
		$status = $this->Mpps_mdl->submitResources($inputData);
		echo json_encode($status);
	}
	
	public function getCountries()
	{
		$countriesFormatted = $this->Mpps_mdl->getCountries();
		echo json_encode($countriesFormatted);
	}
	
	public function getCities()
	{
		$country_id = $this->input->post('country_id');
		$citiesFormatted = $this->Mpps_mdl->getCities($country_id);
		echo json_encode($citiesFormatted);
	}

	public function uploadFile()
	{
		$file_tag_name = $this->input->post('file_tag_name');
		$status = $this->Mpps_mdl->uploadFile($_FILES, $file_tag_name);
		echo json_encode($status);
	}	
}
