<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpps_innovators extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mpps_innovators_mdl');		
	}

	public function index()
	{
		#$this->load->view('welcome_message');
	}
	
	public function submitResources()
	{
		$inputData = $this->input->post(NULL, TRUE);
		$status = $this->mpps_innovators_mdl->submitResources($inputData);
		echo json_encode($status);
	}
	
	public function getCountries()
	{
		$countriesFormatted = $this->mpps_innovators_mdl->getCountries();
		echo json_encode($countriesFormatted);
	}
	
	public function getCities()
	{
		$country_id = $this->input->post('country_id');
		$citiesFormatted = $this->mpps_innovators_mdl->getCities($country_id);
		echo json_encode($citiesFormatted);
	}

	public function uploadFile()
	{
		$file_tag_name = $this->input->post('file_tag_name');
		$status = $this->mpps_innovators_mdl->uploadFile($_FILES, $file_tag_name);
		echo json_encode($status);
	}	
}
