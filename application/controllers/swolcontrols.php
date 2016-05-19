<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Swolcontrols extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('swolcontrol');
	}

	public function todays_burn(){
	   $todays_burn = $this->input->post();
       $totalburn = $this->swolcontrol->add_workout_cals($todays_burn);
       $data= array('calories'=> $totalburn);
       echo json_encode($data);
	}

	public function add_workout(){//*actually gets calories
		$newworkout = $this->input->post();

       $caloric = $this->swolcontrol->get_calories($newworkout);
       $data= array('calories'=> $caloric,
       	'message' => "hellow worldddd");
       	// 'burn'=> $caloric['id']);
       echo json_encode($data);
    }

    public function add_workout_foreal(){//*actually posts workout
		$newworkout2 = $this->input->post();
		$workoutinfo = $this->swolcontrol->add_workout($newworkout2);
		$addedcals = $this->swolcontrol->add_workout_cals($newworkout2);
		$data2 = array("workout" => $workoutinfo,
			"calinfo" => $addedcals);
		echo json_encode($data2);
	}



	public function get_activity_list(){
      
       $gotactivities =  $this->swolcontrol->get_activity_list();
       $data = array("activities" => $gotactivities);
       echo json_encode($data);
    }
}