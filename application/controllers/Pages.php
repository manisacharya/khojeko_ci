<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/29/16
 * Time: 9:44 AM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    function __Construct() {
        parent::__Construct ();
        //$this->load->database(); // load database
        $this->load->model('database_models/categories_model');
        $this->load->model('index_database_model'); // load model
        $this->load->model('khojeko_db_model');
        $this->load->model('general_database_model');
        $this->load->model('database_models/dealer_model');
        $this->load->model('database_models/items_model');
        $this->load->model('database_models/user_model');
        $this->output->enable_profiler(TRUE);
    }

    public function index() {
        //for top ad type listing
        $data['adList'] = $this->index_database_model->joinTable('items', 'user', 'user_id');

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

        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->dealer_model->get_all_dealers();

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->items_model->count_items();
        $data["used_items"] = $this->items_model->count_status_items('used');
        $data["new_items"] = $this->items_model->count_status_items('new');
        $data['dealer_items'] = $this->items_model->count_user_items('dealer');
        $data['user_items'] = $this->items_model->count_user_items('personal');

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/home', $data);
        $this->load->view('pages/templates/footer');
    }

    public function personal_page($personal, $category = 'all') {
        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->dealer_model->get_all_dealers();

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->items_model->count_items();
        $data["used_items"] = $this->items_model->count_status_items('used');
        $data["new_items"] = $this->items_model->count_status_items('new');
        $data['dealer_items'] = $this->items_model->count_user_items('dealer');
        $data['user_items'] = $this->items_model->count_user_items('personal');

        $data['personal_info'] = $this->user_model->get_user_info('personal', $personal);
        $data['personal_items'] = $this->items_model->get_personal_items($personal);

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/user_page', $data);
        $this->load->view('pages/templates/footer');
    }

    public function dealer_page($encoded_username, $encoded_category = 'all') {
        $username = urldecode($encoded_username);
        $category = urldecode($encoded_category);

        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->dealer_model->get_all_dealers();

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->items_model->count_items();
        $data["used_items"] = $this->items_model->count_status_items('used');
        $data["new_items"] = $this->items_model->count_status_items('new');
        $data['dealer_items'] = $this->items_model->count_user_items('dealer');
        $data['user_items'] = $this->items_model->count_user_items('personal');

        $data['dealer_info'] = $this->user_model->get_user_info('dealer', $username);
        $data['all_dealer_items'] = $this->items_model->get_dealer_items($username);
        $this->load->model('database_models/store_images_model');
        $data['store_images'] = $this->store_images_model->get_store_images($data['dealer_info']->d_id);


        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/dealer_page', $data);
        $this->load->view('pages/templates/footer');
    }

    public function dealer_panel($dealer) {
        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->dealer_model->get_all_dealers();

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->items_model->count_items();
        $data["used_items"] = $this->items_model->count_status_items('used');
        $data["new_items"] = $this->items_model->count_status_items('new');
        $data['dealer_items'] = $this->items_model->count_user_items('dealer');
        $data['user_items'] = $this->items_model->count_user_items('personal');

        $data['all_dealer_items'] = $this->items_model->get_dealer_items($dealer);
        $data['dealer_info'] = $this->user_model->get_user_info('dealer', $dealer);

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/dealer_panel', $data);
        $this->load->view('pages/templates/footer');
    }
}