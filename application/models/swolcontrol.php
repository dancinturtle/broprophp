<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Swolcontrol extends CI_Controller {
 
 	public function __construct(){
		parent::__construct();
	}


	public function add_workout($newworkout){
        $query = "INSERT INTO workouts (user_id,workout,intensity,calories,created_at) VALUES (?,?,?,?,CURDATE())";
        $values = array($newworkout['user_id'],$newworkout['activity'],$newworkout['intensity'],$newworkout['burn']);
        return $this->db->query($query, $values);
    }

    public function get_calories($workoutadd){

    	$query = "SELECT * FROM activities WHERE intensity= ? AND activity = ?";
    	$values = array($workoutadd['intensity'],$workoutadd['activity']);
		if ($this->db->query($query, $values)){
			return $this->db->query($query, $values) -> row_array();
		}
		else {
			return false;
		}
    }


    public function add_workout_cals($newworkout2){
    	$query= "SELECT sum(workouts.calories) as calories FROM workouts
				where user_id = ? and workouts.created_at=CURDATE()";
		$values=array($newworkout2['user_id']);
		return $this->db->query($query,$values)->row_array();
    }


	function get_activity_list(){
        $query = "SELECT * FROM activities WHERE intensity = 'light'";
        return $this->db->query($query) -> result_array();
    }

}