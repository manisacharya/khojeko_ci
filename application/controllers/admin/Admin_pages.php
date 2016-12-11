<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_pages extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model('admin/categories_model');
        $this->load->model('admin/latest_verified_unverified_ad_model');
        $this->load->model('admin/search_model');
        $this->load->model('database_models/user_model');
        $this->load->model('admin/zones_model');
        //$this->output->enable_profiler(TRUE);
        if (! $this->session->has_userdata('admin_logged_in'))
            redirect('admin/login');
    }

    public function page($page = 'index', $page_number = 1) {
        $per_page = 10;
        $this->load->library('pagination');

        $data['title'] = ucwords(strtolower(str_replace('_', ' ', $page))); // Capitalize the first letter
        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);

        $data['message'] = $this->session->flashdata('message');
        $data['per_page'] = $per_page;
        $data['page_number'] = $page_number;

        if($page == "inactive_adv_personal") {
            $config1['base_url'] = base_url('admin/inactive_adv_personal');
            $config1['first_url'] = base_url('admin/inactive_adv_personal/1');
            $config1['per_page'] = $per_page;
            $search_query = $this->input->get('search');
            if($search_query){
                $active_personal = $this->search_model->total_items('personal', 0, '=0', $search_query);
                $data['unverified_personal'] = $this->search_model->search_active_inactive(0, 'personal', '=0', $search_query, $per_page, ($page_number - 1) * $per_page);
            }else {
                //get total rows of items
                $active_personal = $this->latest_verified_unverified_ad_model->total_items('personal', 0);
                $data['unverified_personal'] = $this->latest_verified_unverified_ad_model->get_details_item_personal(0, $per_page, ($page_number - 1) * $per_page);
            }
            $config1['total_rows'] = $active_personal;
            $this->pagination->initialize($config1);
            $data['active_page_links'] = $this->pagination->create_links();
            $data['total'] = $active_personal;
        }
        if($page == "inactive_adv_dealer") {
            $config3['base_url'] = base_url('admin/inactive_adv_dealer');
            $config3['first_url'] = base_url('admin/inactive_adv_dealer/1');
            $config3['per_page'] = $per_page;
            $search_query = $this->input->get('search');
            if($search_query){
                $active_dealer = $this->search_model->total_items('dealer', 0, '=0', $search_query);
                $data['unverified_dealer'] = $this->search_model->search_active_inactive(0, 'dealer', '=0', $search_query, $per_page, ($page_number - 1) * $per_page);
            }else {
                $active_dealer = $this->latest_verified_unverified_ad_model->total_items('dealer', 0);
                $data['unverified_dealer'] = $this->latest_verified_unverified_ad_model->get_details_item_dealer(0, $per_page, ($page_number - 1) * $per_page);
            }
            $config3['total_rows'] = $active_dealer;
            $this->pagination->initialize($config3);
            $data['active_page_links'] = $this->pagination->create_links();
            $data['total'] = $active_dealer;
        }
        if($page == "active_adv_personal") {
            $config2['first_url'] = base_url('admin/active_adv_personal/1');
            $config2['base_url'] = base_url('admin/active_adv_personal');
            $config2['per_page'] = $per_page;
            $search_query = $this->input->get('search');
            if($search_query){
                $inactive_personal = $this->search_model->total_items('personal', 1, '=0', $search_query);
                $data['verified_personal'] = $this->search_model->search_active_inactive(1, 'personal', '=0', $search_query, $per_page, ($page_number - 1) * $per_page);
            }else {
                $inactive_personal = $this->latest_verified_unverified_ad_model->total_items('personal', 1);
                $data['verified_personal'] = $this->latest_verified_unverified_ad_model->get_details_item_personal(1, $per_page, ($page_number - 1) * $per_page);
            }
            $config2['total_rows'] = $inactive_personal;
            $this->pagination->initialize($config2);
            $data['inactive_page_links'] = $this->pagination->create_links();
            $data['total'] = $inactive_personal;
        }
        if($page == "active_adv_dealer") {
            $config4['first_url'] = base_url('admin/active_adv_dealer/1');
            $config4['base_url'] = base_url('admin/active_adv_dealer');
            $config4['per_page'] = $per_page;
            $search_query = $this->input->get('search');
            if($search_query){
                $inactive_dealer = $this->search_model->total_items('dealer', 1, '=0', $search_query);
                $data['verified_dealer'] = $this->search_model->search_active_inactive(1, 'dealer', '=0', $search_query, $per_page, ($page_number - 1) * $per_page);
            }else {
                $inactive_dealer = $this->latest_verified_unverified_ad_model->total_items('dealer', 1);
                $data['verified_dealer'] = $this->latest_verified_unverified_ad_model->get_details_item_dealer(1, $per_page, ($page_number - 1) * $per_page);
            }
            $config4['total_rows'] = $inactive_dealer;
            $this->pagination->initialize($config4);
            $data['inactive_page_links_d'] = $this->pagination->create_links();
            $data['total'] = $inactive_dealer;
        }
        if($page == "deleted_adv_personal"){
            $config3['first_url'] = base_url('admin/deleted_adv_personal/1');
            $config3['base_url'] = base_url('admin/deleted_adv_personal');
            $config3['per_page'] = $per_page;
            $search_query = $this->input->get('search');
            if($search_query){
                $deleted_personal = $this->search_model->total_items('personal', 0, '!=0', $search_query);
                $data['deleted_personal'] = $this->search_model->search_active_inactive(0, 'personal', '!=0', $search_query, $per_page, ($page_number - 1) * $per_page);
            }else {
                $deleted_personal = $this->latest_verified_unverified_ad_model->total_deleted_items('personal');
                $data['deleted_personal'] = $this->latest_verified_unverified_ad_model->get_details_item_deleted('personal', $per_page, ($page_number - 1) * $per_page);
            }
            $config3['total_rows'] = $deleted_personal;
            $this->pagination->initialize($config3);
            $data['total'] = $deleted_personal;
            $data['deleted_page_links'] = $this->pagination->create_links();
        }
        if($page == "deleted_adv_dealer"){
            $config3['first_url'] = base_url('admin/deleted_adv_dealer/1');
            $config3['base_url'] = base_url('admin/deleted_adv_dealer');
            $config3['per_page'] = $per_page;
            $search_query = $this->input->get('search');
            if($search_query){
                $deleted_dealer = $this->search_model->total_items('dealer', 0, '!=0', $search_query);
                $data['deleted_dealer'] = $this->search_model->search_active_inactive(0, 'dealer', '!=0', $search_query, $per_page, ($page_number - 1) * $per_page);
            }else {
                $deleted_dealer = $this->latest_verified_unverified_ad_model->total_deleted_items('dealer');
                $data['deleted_dealer'] = $this->latest_verified_unverified_ad_model->get_details_item_deleted('dealer', $per_page, ($page_number - 1) * $per_page);
            }
            $config3['total_rows'] = $deleted_dealer;
            $this->pagination->initialize($config3);
            $data['total'] = $deleted_dealer;
            $data['deleted_page_links'] = $this->pagination->create_links();
        }
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/'.$page, $data);
        $this->load->view('admin/templates/footer');
    }

    public function verify_validation($page){
        if($this->input->post('renew') != null){
            $this->extend_date($page);
        }
        if ($this->input->post('verify') == "Verify") {
            $selected = $this->input->post('foo1');
            $this->latest_verified_unverified_ad_model->verify($selected);
            redirect('admin/'.$page);
        }
    }

    public function unverify_validation($page){
        if($this->input->post('renew') != null){
            $this->extend_date($page);
        }
        if ($this->input->post('unverify') == "Unverify") {
            $selected = $this->input->post('foo2');
            $this->latest_verified_unverified_ad_model->unverify($selected);
            redirect('admin/'.$page);
        }
    }

    public function extend_date($page){
        $action = explode(',', $this->input->post('renew'));
        $data = array();
        foreach ($action as $value) {
            $a = explode(':', $value);
            $data[$a[0]] = $a[1];
        }
        $this->latest_verified_unverified_ad_model->extend_date($data['id'], $data['item_days']);
        redirect('admin/'.$page);
    }

    public function sold_unsold($id, $sales_status, $page){
        $this->latest_verified_unverified_ad_model->sold_unsold($id, $sales_status);
        redirect('admin/'.$page);
    }

    public function hide_unhide($id, $visibility, $page){
        $this->latest_verified_unverified_ad_model->hide_unhide($id, $visibility);
        redirect('admin/'.$page);
    }

    public function delete($id, $page){
        $this->latest_verified_unverified_ad_model->delete($id);
        redirect('admin/'.$page);
    }

    public function premium($id, $premium, $page){
        $this->latest_verified_unverified_ad_model->premium($id, $premium);
        redirect('admin/'.$page);
    }

    public function add_category() {
        $data['title'] = "Add Category";
        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $data['categories'] = $this->categories_model->get_categories();

        $this->load->view('admin/templates/header', $data);
        $this->form_validation->set_rules('c_name', 'Category Name', 'required');
        $this->form_validation->set_rules('parent_id', 'Parent', 'required');
        $data['message'] = $this->session->flashdata('message');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/category_add', $data);
        } else {
            if ($this->categories_model->add_category() === TRUE) {
                $message = "<div class='alert alert-success'>Successfully Added !</div>";
            }
            else {
                $message = "<div class='alert alert-danger'>Not Added !</div>";
            }
            if($this->input->post('c_name')) {
                $this->session->set_flashdata('message', $message);
                redirect('admin/category_add');
            }
            $this->load->view('admin/category_add', $data);
        }
        $this->load->view('admin/templates/footer');
    }

    public function delete_category() {
        $data['title'] = "Delete Category";
        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $data['categories'] = $this->categories_model->get_categories();

        $this->load->view('admin/templates/header', $data);
        $this->form_validation->set_rules('c_id', 'Category', 'required', array('required' => 'You must choose {field}.'));
        $data['message'] = $this->session->flashdata('message');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/category_delete', $data);
        }
        else {
            if ($this->categories_model->delete_category() === TRUE) {
                $message = "<div class='alert alert-success'>Deleted Successfully</div>";
            }
            else {
                $message = "<div class='alert alert-danger'>Not deleled! Hint: Cannot delete the parent.</div>";
            }
            if($this->input->post('c_id')) {
                $this->session->set_flashdata('message', $message);
                redirect('admin/category_delete');
            }

            $this->load->view('admin/category_delete', $data);

        }
        $this->load->view('admin/templates/footer');
    }

    public function edit_category() {
        $data['title'] = "Edit Category";
        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $data['categories'] = $this->categories_model->get_categories();

        $this->load->view('admin/templates/header', $data);
        $this->form_validation->set_rules('c_id', 'Category', 'required', array('required' => 'You must choose a {field} to edit.'));
        $this->form_validation->set_rules('c_name', 'Category Name', 'required');
        $this->form_validation->set_rules('parent_id', 'Parent', 'required');
        $data['message'] = $this->session->flashdata('message');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('admin/category_edit', $data);
        } else {
            if ($this->categories_model->edit_category() == TRUE) {
                $message = "<div class='alert alert-success'>Edited Successfully !</div>";
            } else {
                $message = "<div class='alert alert-danger'>Not Edited !</div>";
            }
            if($this->input->post('c_name')) {
                $this->session->set_flashdata('message', $message);
                redirect('admin/category_edit');
            }
            $this->load->view('admin/category_edit', $data);
        }
        $this->load->view('admin/templates/footer');
    }

    public function total_active_items(){
        if ($this->db->table_exists('items')) {
            return $this->db->count_all('items');
        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }
}
