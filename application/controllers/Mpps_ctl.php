<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpps_ctl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mpps_mdl');	
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	public function index()
	{
		#$this->load->view('welcome_message');
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
