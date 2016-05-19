<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Brofoods extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Brofood');
	}

	public function add_meal(){
		$mealtoadd = $this->input->post();
		$added_meal = $this->Brofood->add_meal($mealtoadd);
		$caloric = $this->Brofood->update_calories($mealtoadd);
		
		$data = array("message" => $added_meal,
					"calories" => $caloric
					);

		echo json_encode($data);
		
	}

	public function todays_calories(){
		$userid = $this->input->post();
		$todayscals = $this->Brofood->update_calories($userid);
		$data = array("foodcals" => $todayscals);
		echo json_encode($data);

	}


}
