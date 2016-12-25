<?php

/**
 * Created by PhpStorm.
 * User: manisAlert
 * Date: 9/30/2016
 * Time: 11:02 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_post extends CI_Controller{

    function __Construct(){

        parent::__Construct();
        $this->load->model('database_models/user_model');
        $this->load->model('admin/item_model'); // load model
        $this->load->model('database_models/categories_model');
        $this->load->model('admin/personal_model');
        $this->load->model('admin/image_model');
        $this->load->model('admin/districts_model');
        $this->load->model('admin/zones_model');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('security');
        $this->load->library('upload');
        $this->load->library('form_validation');

        $this->output->enable_profiler(TRUE);

        if (! $this->session->has_userdata('admin_logged_in'))
            redirect('admin/login');
    }

    public function post_form(){
        $data['title'] = 'Post ad';

        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);
        $data['categories'] = $this->categories_model->get_categories();
        $data['zones'] = $this->zones_model->getAllZones();

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->form_validation->set_rules('owner_name', 'AdOwnerName', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('username', 'UserName', 'required');

        $this->load->view('admin/templates/header', $data);

        if ($this->form_validation->run() == FALSE) {

            $data['message'] = "";
            $this->load->view('admin/post_ad', $data);
            $this->load->view('admin/templates/footer', $data);
        }else {
            // check for existing user through email and username
            if($this->user_model->check_user()){
                $u_id = $this->user_model->get_user_id();
            }else{
                $this->personal_model->add_personal();
                $u_id = $this->user_model->get_user_id();
            }
            //$this->form_validation->set_rules('ad_title', 'Ad Title', 'required');

            if($u_id==NULL){
                // $this->session->set_flashdata('message','<div class="alert alert-danger">Not Added !</div>');

                // redirect('admin/post_ad');
                $data['message'] = "";
                $this->load->view('admin/post_ad', $data);
                $this->load->view('admin/templates/footer', $data);

            }else{
                $this->item_model->add_item();

                $this->personal_upload();
            }

            $data['message'] = "Your item is posted.";
            $this->load->view('admin/adv_index', $data);
            $this->load->view('admin/templates/footer', $data);

            // $this->session->set_flashdata('message','<div class="alert alert-success">Successfully Added!</div>');

            // redirect('admin/post_ad');

            // $data['message'] = "Successfully Added !";

            // $this->load->view('admin/post_ad', $data);

        }//end of upload
    }

    public function form_valid_check(){
        $this->form_validation->set_rules('ad_title', 'Ad Title', 'required|trim|max_length[100]');

        if($this->input->post('bought_from') == "Abroad")
            $this->form_validation->set_rules('abroad_country', 'Abroad Country', 'required|trim|max_length[30]');

        $this->form_validation->set_rules('offer', 'Offer Price', 'required|trim|numeric');
        $this->form_validation->set_rules('used_for_text', 'Used For Text', 'required|trim|numeric');
        $this->form_validation->set_rules('market_price', 'Market Price', 'trim|numeric');
        $this->form_validation->set_rules('document_no', 'Documnet No', 'trim|alpha_dash');
        $this->form_validation->set_rules('ad_details', 'Ad Details', 'required|trim|max_length[300]');
        $this->form_validation->set_rules('site_url', 'Site URL', 'trim|valid_url');

        if($this->input->post('home_delivery') == 1)
            $this->form_validation->set_rules('delivery_charge', 'Delivery Charge', 'required|trim|numeric');

        $this->form_validation->set_rules('warranty', 'Warranty', 'trim|alpha_numeric_spaces');

        if($this->input->post('owner_proof[]') == "Not")
            $this->form_validation->set_rules('reason', 'No owner proof reason', 'required|trim|alpha_numeric_spaces');

        $this->form_validation->set_rules('video1_url', 'Video 1 URL', 'trim|valid_url');
        $this->form_validation->set_rules('video2_url', 'Video 2 URL', 'trim|valid_url');
    }

    public function personal_upload(){
        $config = array(
            'upload_path'   => './public/images/item_images',
            'allowed_types' => 'jpg|png',
            'max_size'      => 10000,
            'max_width'     => 10000,
            'max_height'    => 10000,
            'overwrite'     => FALSE
        );

        $filename_arr = array();
        $count=1;
        $a = 1;

        $name = $this->user_model->get_user_name();
        $ad = $this->item_model->get_ad_name();
        $id = $this->item_model->get_item_id();

        foreach ($_FILES as $key => $value) {
            //if($count>2) {
            $config['file_name'] = $name . "_" . $ad . $a++;
            $this->upload->initialize($config);
            if (!empty($value['tmp_name']) && $value['size'] > 0) {
                if ($this->upload->do_upload($key)) {
                    // Code After Files Upload Success GOES HERE
                    $data_name = $this->upload->data();
                    if($count == 1){
                        $filename_arr[] = array(
                            'image' => $data_name['file_name'],
                            'item_id' => $id,//$this->item_model->get_item_id(),
                            'primary' => 1
                        );
                    }else {
                        $filename_arr[] = array(
                            'image' => $data_name['file_name'],
                            'item_id' => $id,//$this->item_model->get_item_id(),
                            'primary' => 0
                        );
                    }

                    // if($count == 1)
                    //     $filename_arr['primary'] = 1;
                    // else
                    //     $filename_arr['primary'] = 0;

                } else {
                    $this->session->set_flashdata('error','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');

                    redirect('admin/post_ad');
                    // some errors
                }
            }
            // }

            $count++;
        }
        $this->image_model->add_img($filename_arr);
    }

    public function get_district_admin(){
        $this->districts_model->get_districts();
    }

//    public function available_username_admin(){
//        $this->user_model->available_username();
//    }
//
//    public function available_email_admin(){
//        $this->user_model->available_email();
//    }
//
//    public function available_mobile_admin(){
//        $this->personal_model->available_mobile();
//    }
}