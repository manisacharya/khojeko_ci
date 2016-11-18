<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    function __Construct() {
        parent::__Construct ();
        $this->load->database(); // load database
        $this->load->model('khojeko_db_model'); // load model
        $this->load->model('general_database_model');
        $this->load->model('hierarchy_model');
        $this->load->model('database_models/categories_model');
        $this->load->model('search_model');
    }

    public function results() {
        /*item/Category JOIN ARRAY*/
        $item_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'category',
                'condition' => 'items.c_id = category.c_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_img',
                'condition' => 'items.item_id = item_img.item_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_spec',
                'condition' => 'items.item_id = item_spec.item_id',
                'jointype' => 'INNER'
            )
        );

        $dealer_list_joins = array(
            array (
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            )
        );
        $personal_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'personal',
                'condition' => 'user.user_key = personal.p_id',
                'jointype' => 'INNER'
            )
        );

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "1=1");
        $data["used_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='used'");
        $data["new_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='new'");
        $data['dealer_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $item_joins, 'type="dealer"');
        $data['user_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $personal_joins, 'type="personal"');

        $data['dealer_list'] = $this->khojeko_db_model->joinThings('user', 'khojeko_username, name', $dealer_list_joins, 'type="dealer"');
        $data["category"] = $this->categories_model->get_categories();

        // SEARCH QUERIES
        $data['searched_items'] = $this->search_model->search_items();
        $data['searched_personals'] = $this->search_model->search_personals();
        $data['searched_dealers'] = $this->search_model->search_dealers();

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/results', $data);
        $this->load->view('pages/templates/footer', $data);
    }
}
?>