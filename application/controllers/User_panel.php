<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_panel extends CI_Controller {

	function __Construct() {
		parent::__Construct ();
   		$this->load->database(); // load database
		$this->load->model('khojeko_db_model'); // load model
		$this->load->model('general_database_model');
		$this->load->model('user_panel_model');
		$this->load->model('hierarchy_model');
		$this->load->model('database_models/categories_model');
 	}

	public function upanel($encoded_user_name, $encoded_c_name) {
		$user_name = urldecode($encoded_user_name);
		$c_name = urldecode($encoded_c_name);
		$this->data['user_name'] = $user_name;
		$this->data['c_name'] = $c_name;
		/*item/Category JOIN ARRAY*/

		//$task = $this->input->post('task');

		foreach ($_GET as $name => $val) {
			switch(htmlspecialchars($name)) {
				case 'delete':
					$this->user_panel_model->update(htmlspecialchars($val));
					break;
				case 'edit':
					echo 'edit ';
					echo htmlspecialchars($val) . "<br />";
					die();
					break;
				case NULL:
			}
        }

		$item_joins = array(
			array (
				'table' => 'user',
				'condition' => 'user.user_id = items.user_id',
				'jointype' => 'INNER'
			),
			array (
				'table' => 'personal',
				'condition' => 'user.user_key = personal.p_id',
				'jointype' => 'INNER'
			),
			array (
				'table' => 'category',
				'condition' => 'items.c_id = category.c_id',
				'jointype' => 'INNER'
			),
			array (
				'table' => 'item_img',
				'condition' => 'items.item_id = item_img.item_id',
				'jointype' => 'INNER'
			),
			array (
				'table' => 'item_spec',
				'condition' => 'items.item_id = item_spec.item_id',
				'jointype' => 'INNER'
			)
		);

		$dealer_joins = array(
			array (
				'table' => 'user',
				'condition' => 'user.user_id = items.user_id',
				'jointype' => 'INNER'
			),
			array (
				'table' => 'dealer',
				'condition' => 'user.user_key = dealer.d_id',
				'jointype' => 'INNER'
			)
		);

		$personal_joins = array(
			array (
				'table' => 'user',
				'condition' => 'user.user_key = personal.p_id',
				'jointype' => 'INNER'
			)
		);

		// for detail information of dealer
		$where = "type='personal' AND khojeko_username='".$user_name."'";
		$this->data['user_info'] = $this->khojeko_db_model->joinThingsRow('personal', '*', $personal_joins, $where);

		// for dealer list
		//$this->data['dealer_list'] = $this->general_database_model->getAll('dealer', 'name', 'ASC');
		$dealer_list_joins = array(
			array (
				'table' => 'dealer',
				'condition' => 'user.user_key = dealer.d_id',
				'jointype' => 'INNER'
			)
		);
		$this->data['dealer_list'] = $this->khojeko_db_model->joinThings('user', 'khojeko_username, name', $dealer_list_joins, 'type="dealer"');

		// dealer advertisement
		if ($c_name == "All")
			$where = 'khojeko_username="'.$user_name.'"';
		else
			$where = 'c_name="'.$c_name.'" AND khojeko_username="'.$user_name.'"';

		$this->data['item'] = $this->khojeko_db_model->joinThings('items', 'personal.name, personal.p_id, user.type, items.*, category.c_name, item_img.*, item_spec.*, khojeko_username', $item_joins, $where);

		// counts : total, used/new, dealer/user ads
		$this->data["total_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "1=1");
		$this->data["used_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='used'");
		$this->data["new_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='new'");
		$this->data['dealer_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $dealer_joins, 'type="dealer"');
		$this->data['user_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $item_joins, 'type="personal"');

		// personal total count
		$this->data['this_user_item'] = $this->khojeko_db_model->countArray($this->data['item']);
		$this->data['this_user_active_item'] = $this->khojeko_db_model->countSelectedArray($this->data['item'], 'sales_status', '0');
		$this->data['this_user_sold_item'] = $this->khojeko_db_model->countSelectedArray($this->data['item'], 'sales_status', '1');

		// category
        $this->data["category"] = $this->categories_model->get_categories();

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $this->data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }

        $this->load->view('pages/templates/header', $this->data);
		$this->load->view('pages/user_panel', $this->data);
        $this->load->view('pages/templates/footer', $this->data);
	}

	public function redirect() {
		redirect('redirecter');
	}
}
?>