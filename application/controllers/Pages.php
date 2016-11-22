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

        $this->get_common_contents($data);

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/home', $data);
        $this->load->view('pages/templates/footer');
    }

    public function personal_page($encoded_username, $encoded_category = 'all') {
        $username = urldecode($encoded_username);
        $category = urldecode($encoded_category);

        $this->get_common_contents($data);

        $data['personal_info'] = $this->user_model->get_user_info('personal', $username);
        $data['personal_items'] = $this->items_model->get_personal_items($username);

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/user_page', $data);
        $this->load->view('pages/templates/footer');
    }

    public function dealer_page($encoded_username, $encoded_category = 'all') {
        $username = urldecode($encoded_username);
        $category = urldecode($encoded_category);

        $this->get_common_contents($data);

        $data['dealer_info'] = $this->user_model->get_user_info('dealer', $username);
        $data['all_dealer_items'] = $this->items_model->get_dealer_items($username);
        $this->load->model('database_models/store_images_model');
        $data['store_images'] = $this->store_images_model->get_store_images($data['dealer_info']->d_id);

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/dealer_page', $data);
        $this->load->view('pages/templates/footer');
    }

    public function personal_panel($encoded_username, $encoded_category = 'all') {
        if (!$this->session->has_userdata('logged_in'))
            show_error('Sorry, page broken.');

        $username = urldecode($encoded_username);
        $category = urldecode($encoded_category);

        $this->get_common_contents($data);

        $data['user_item_counts'] = $this->items_model->count_user_page_items();

        $data['all_personal_items'] = $this->items_model->get_personal_items($username);
        $data['personal_info'] = $this->user_model->get_user_info('personal', $username);
        $this->load->model('database_models/favourites_model');
        $data['total_favourited_items'] = $this->favourites_model->count_favourites($data['personal_info']->user_id);

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/user_panel', $data);
        $this->load->view('pages/templates/footer');
    }

    public function dealer_panel($encoded_username, $encoded_category = 'all') {
        if (!$this->session->has_userdata('logged_in'))
            show_error('Sorry, page broken.');

        $username = urldecode($encoded_username);
        $category = urldecode($encoded_category);

        $this->get_common_contents($data);
        $data['user_item_counts'] = $this->items_model->count_user_page_items();

        $data['all_dealer_items'] = $this->items_model->get_dealer_items($username);
        $data['dealer_info'] = $this->user_model->get_user_info('dealer', $username);

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/dealer_panel', $data);
        $this->load->view('pages/templates/footer');
    }

    public function get_common_contents(&$data) {
        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->dealer_model->get_all_dealers();

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
    }
}