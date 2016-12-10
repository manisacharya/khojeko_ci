<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    function __Construct() {
        parent::__Construct ();
        $this->load->database(); // load database
        $this->load->model('khojeko_db_model'); // load model
        $this->load->model('general_database_model');
        $this->load->model('database_models/categories_model');
        $this->load->model('search_model');
        $this->load->model('database_models/dealer_model');
        $this->load->model('database_models/items_model');
        $this->load->model('database_models/user_model');
        $this->output->enable_profiler(TRUE);
    }

    public function results() {
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
