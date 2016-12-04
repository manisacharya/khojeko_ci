<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

    function __Construct() {
        parent::__Construct ();
        $this->load->database(); // load database
        $this->load->model('index_database_model'); // load model
        $this->load->model('khojeko_db_model');
        $this->load->model('general_database_model');
        $this->load->model('database_models/categories_model');
        $this->load->model('categories_model');
    }

    public function index() {
        echo "Index Controller";
    }

    public function home() {

        //for the For Sales: Latest Ad --> images
        $data['dat'] = $this->index_database_model->joinTableOrder('item_img', 'items', 'item_id', 'published_date');

        //for the For Sales: Latest Ad --> details
        $data['oth'] = $this->index_database_model->joinTable('items', 'item_spec', 'item_id');

        //for the For Sales: Latest Ad --> Ad By name
        $data['othUs'] = $this->index_database_model->joinTable('items', 'user', 'user_id');

        //for populating ad by greatest view
        $data['grtView'] = $this->index_database_model->joinTableOrder('item_img', 'items', 'item_id', 'views');

        //for realstate
        $data['house'] = $this->index_database_model->selHouLand();

        $data['service'] = $this->index_database_model->selectWhat('Services');

        $data['job'] = $this->index_database_model->selectWhat('Jobs');

        // for dealer list
        //$this->data['dealer_list'] = $this->general_database_model->getAll('dealer', 'name', 'ASC');
        $dealer_list_joins = array(
            array (
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            )
        );
        //$data["category"] = $this->general_database_model->getAll('category', 'c_id', 'ASC');
        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->khojeko_db_model->joinThings('user', 'khojeko_username, name', $dealer_list_joins, 'type="dealer"');

        $this->load->view('pages/home', $data); // load the view file , we are passing $data array to view file
    }

    public function search($aid){
        $this->load->model('index_database_model');
        $data['search'] = $this->index_database_model->getDetails('items', 'avaibility_address', $aid);

        $this->load->view('serchedItem', $data);
    }

    
}
