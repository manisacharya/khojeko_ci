<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_pages extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model('admin/categories_model');
        $this->load->model('admin/latest_verified_unverified_ad_model');
        $this->load->model('database_models/user_model');
        $this->load->model('admin/zones_model');
        //$this->output->enable_profiler(TRUE);
        if (! $this->session->has_userdata('admin_logged_in'))
            redirect('admin/login');
    }

    public function page($page = 'index') {
        $data['error'] = 'Dimensions: 250x100 | Only PNG';
        $data['title'] = ucwords(strtolower(str_replace('_', ' ', $page))); // Capitalize the first letter
        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);

        $data['upload_status'] = "Upload file from here.";
        $data['message'] = $this->session->flashdata('message');

        $data['unverified_personal'] = $this->latest_verified_unverified_ad_model->get_details_item_personal(0);
        $data['unverified_dealer'] = $this->latest_verified_unverified_ad_model->get_details_item_dealer(0);
        $data['verified_personal'] = $this->latest_verified_unverified_ad_model->get_details_item_personal(1);
        $data['verified_dealer'] = $this->latest_verified_unverified_ad_model->get_details_item_dealer(1);

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/'.$page, $data);
        $this->load->view('admin/templates/footer');
    }
    public function verify_validation(){
        if($this->input->post('renew') != null){
            $this->extend_date();
        }
        if ($this->input->post('verify') == "Verify") {
            $selected = $this->input->post('foo1');
            $this->latest_verified_unverified_ad_model->verify($selected);
            redirect('admin');
        }
    }

    public function unverify_validation(){
        if($this->input->post('renew') != null){
            $this->extend_date();
        }
        if ($this->input->post('unverify') == "Unverify") {
            $selected = $this->input->post('foo2');
            $this->latest_verified_unverified_ad_model->unverify($selected);
            redirect('admin');
        }
    }

    public function extend_date(){
        $action = explode(',', $this->input->post('renew'));
        $data = array();
        foreach ($action as $value) {
            $a = explode(':', $value);
            $data[$a[0]] = $a[1];
        }
        $this->latest_verified_unverified_ad_model->extend_date($data['id'], $data['item_days']);
        redirect('admin');
    }

    public function sold_unsold($id, $sales_status){
        $this->latest_verified_unverified_ad_model->sold_unsold($id, $sales_status);
        redirect('admin');
    }

    public function hide_unhide($id, $visibility){
        $this->latest_verified_unverified_ad_model->hide_unhide($id, $visibility);
        redirect('admin');
    }

    public function delete($id){
        $this->latest_verified_unverified_ad_model->delete($id);
        redirect('admin');
    }

    public function premium($id, $premium){
        $this->latest_verified_unverified_ad_model->premium($id, $premium);
        redirect('admin');
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
        }
        else {
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
}
