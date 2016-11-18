<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Khojeko extends CI_Controller {

	function __Construct() {
		parent::__Construct ();
		$this->load->model('Khojeko_db_model'); // load model
		$this->load->model('General_database_model');
		$this->load->model('Hierarchy_model');
 	}

	public function index() {
		redirect('home');
	}

	public function redirecter() {
		$personal_joins = array(
			array (
				'table' => 'personal',
				'condition' => 'user.user_key = personal.p_id',
				'jointype' => 'INNER'
			)

		);

		$dealer_joins = array(
			array (
				'table' => 'dealer',
				'condition' => 'user.user_key = dealer.d_id',
				'jointype' => 'INNER'
			)
		);
		$this->data['users_list'] = $this->Khojeko_db_model->joinThings('user', 'khojeko_username', $personal_joins, 'type="personal"');
		$this->data['dealer_list'] = $this->Khojeko_db_model->joinThings('user', 'khojeko_username', $dealer_joins, 'type="dealer"');
		$this->load->view('redirecter', $this->data);
	}

	public function heirarchy() {
		//$this->data["category"] = $this->hierarchy_model->fetchChildren(0, 0, ''); // parent = 0, level = 0
		$this->data["category"] = $this->general_database_model->getAll('category', 'c_id', 'ASC');
		$this->load->view('heirarchy', $this->data);
	}


}
?>