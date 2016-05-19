<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function get_all_bros(){	
		
		return $this->db->query("SELECT * FROM users") -> result_array();
		
	}


	public function add_user($newuser, $bmr){
		
		$query = "INSERT INTO users (user_email, user_password, age, height, gender, weight, created_at, updated_at, bmr) values(?, ?, ?, ?, ?, ?, NOW(), NOW(), ?);";
		$values=array($newuser['email'], $newuser['password'], $newuser['age'], $newuser['height'], $newuser['gender'], $newuser['weight'], $bmr);
		$this->db->query($query, $values);
		$id = $this->db->insert_id();
		return $id;
		
	
	}

	public function get_bro_by_email($broinfo){

		$query = "SELECT * FROM users where user_email = ? and user_password = ?";
		$values=array($broinfo['email'], $broinfo['password']);
		return $this->db->query($query, $values) -> row_array();
	}

	public function get_bro_by_id($id){
		$query = "SELECT * FROM users where id = ?";
		$values = array($id);
		return $this->db->query($query, $values) -> row_array();
	}

	public function update_profile($profileinfo){
		$query = "UPDATE users SET user_email = ?,user_password = ?, age=?, height=?, gender=?, weight=?,updated_at= CURDATE() WHERE id = ?";
		$values = array($profileinfo['email'],$profileinfo['password'],$profileinfo['age'],$profileinfo['height'],$profileinfo['gender'],$profileinfo['weight'],$profileinfo['user_id']);
		return $this->db->query($query,$values);
	}

}