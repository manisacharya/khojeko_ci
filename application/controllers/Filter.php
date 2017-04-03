<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends CI_Controller {

    function __Construct() {
        parent::__Construct ();
        $this->load->database(); // load database
        $this->load->model('database_models/retailer_partners_model');
        $this->load->model('database_models/categories_model');
        $this->load->model('khojeko_db_model');
        $this->load->model('filter_test_model');
//        $this->load->model('general_database_model');
        $this->load->model('database_models/dealer_model');
        $this->load->model('database_models/items_model');
//        $this->load->model('database_models/user_model');
    }

    public function index() {
        $this->get_common_contents($data);
        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/filter', $data);
        $this->load->view('pages/templates/footer', $data);
    }

    public function get_sub_category(){
        $this->filter_test_model->get_sub_category();
    }

    public function get_sub_sub_category(){
        $this->filter_test_model->get_sub_sub_category();
    }

    public function get_common_contents(&$data) {
        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->dealer_model->get_all_dealers();

        $data["total_items"] = $this->items_model->count_items();
        $data["used_items"] = $this->items_model->count_status_items('used');
        $data["new_items"] = $this->items_model->count_status_items('new');
        $data['dealer_items'] = $this->items_model->count_user_items('dealer');
        $data['user_items'] = $this->items_model->count_user_items('personal');

        $data['retailer_partners'] = $this->retailer_partners_model->get_retailer_partners();

        $data['popular_district'] = $this->khojeko_db_model->popular_district();
        $data['popular_category'] = $this->khojeko_db_model->popular_category();
        $data['popular_dealer'] = $this->khojeko_db_model->popular_dealer();

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }
    }

}
