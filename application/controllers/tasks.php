<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('task');
	}

	public function index(){	
		
		$this->load->view('index');
	}
	public function get_all_bros(){
		$gotBros = $this->task->get_all_bros();
		echo json_encode($gotBros);
		
	}

	public function add_user(){
		$newuser = $this->input->post();
		$height = $newuser['height'];
		$weight = $newuser['weight'];
		$age = $newuser['age'];
		$gender = $newuser['gender'];
		    if($gender == "female"){
            $BMR = 655 + (4.35 * $weight) + (4.7 * $height) - (4.7 * $age);
        	}
        	if($gender == "male"){
            $BMR = 66 + (6.23 * $weight) + (12.7 * $height) - (6.8 * $age);
        	}
        $active_BMR= ($BMR * 1.4);
		$added_user = $this->task->add_user($newuser, $active_BMR);
		//we have the id of the new user
		$oneuser = $this->task->get_bro_by_id($added_user);
		$data = array("newid" => $added_user,
			"oneuser" => $oneuser);
		echo json_encode($data);
	}

	// public function update_BMR(){
	// 	$userinfo = $this->input->post();
	// 	$gender = $userinfo['gender'];
	// 	    if($gender == "female"){
 //            $BMR = 655 + (4.35 * $weight) + (4.7 * $height) - (4.7 * $age);
 //        	}
 //        	if($gender == "male"){
 //            $BMR = 66 + (6.23 * $weight) + (12.7 * $height) - (6.8 * $age);
 //        	}
 //        $active_BMR= ($BMR * 1.4);
 //        $BMRdata = $this->task->update_BMR($active_BMR,$userinfo);
 //        $data = array("BMR" => $BMRdata);
	// 	echo json_encode($data);
	// }

	public function get_bro_by_email(){
		//email and password

		$broinfo = $this->input->post();
		$gotbro = $this->task->get_bro_by_email($broinfo);
		if ($gotbro) {
			$data = array("bro" => $gotbro);
		echo json_encode($data);
		}
		else {
			$data = array("message" => "Bro, you're not in our database, you gotta register");
			echo json_encode($data);
		}
		
	}

	public function update_profile(){
		$profileinfo = $this->input->post();
		// $gender = $profileinfo['gender'];
		//     if($gender == "female"){
  //           $BMR = 655 + (4.35 * $weight) + (4.7 * $height) - (4.7 * $age);
  //       	}
  //       	if($gender == "male"){
  //           $BMR = 66 + (6.23 * $weight) + (12.7 * $height) - (6.8 * $age);
  //       	}
  //       $active_BMR= ($BMR * 1.4);
		$complete = $this->task->update_profile($profileinfo);
		$oneuser = $this->task->get_bro_by_id($profileinfo['user_id']);
		$data = array("message" => "Your brofile is up to date!",
			"userinfo" => $oneuser);
		echo json_encode($data);
	}
}