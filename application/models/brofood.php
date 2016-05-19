<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brofood extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	function add_meal($mealtoadd){
        //store the meal
        $query = "INSERT into meals (food_id,user_id,created_at,updated_at) VALUES (?,?,CURDATE(),CURDATE());";
        $values=array($mealtoadd['food_id'], $mealtoadd['user_id']);
        if($this->db->query($query,$values)){
        	$id = $this->db->insert_id();
        	return $id;
        }
        else {
        	return false;
        }

    }

    public function update_calories($mealtoadd){
    	$query = "SELECT meals.food_id, meals.user_id, meals.created_at, sum(fooditems.calories) as calories
			from meals
			join fooditems on meals.food_id = fooditems.id
			where meals.user_id = ? and meals.created_at=CURDATE();";
		$values = array($mealtoadd['user_id']);
		return $this->db->query($query, $values)->row_array();
    }
}