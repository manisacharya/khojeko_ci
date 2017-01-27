<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 9/25/16
 * Time: 12:58 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('database_models/user_model');
    }

    public function site_logo() {
        $data['error'] = 'Dimensions: 250x100 | Only PNG';
        $data['title'] = "Site Logo";
        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);

        $data['upload_status'] = "Upload file from here.";
        $data['message'] = $this->session->flashdata('message');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/site_logo', $data);
        $this->load->view('admin/templates/footer');
    }

    public function logo_upload() {
        $config = array(
            'upload_path'   => './public/images',
            'allowed_types' => 'jpg|png',
            'max_size'      => 1000,
            'max_width'     => 250,
            'max_height'    => 100,
            'file_name'     => 'khojeko.png',
            'overwrite'     => TRUE
        );
        $this->load->library('upload', $config);

        $page = 'site_logo';
        $data['title'] = ucwords(strtolower(str_replace('_', ' ', $page)));

        $this->load->view('admin/templates/header', $data);

        if ( ! $this->upload->do_upload('userfile')) {
            $data['upload_status'] = "Logo not uploaded";
            $this->session->set_flashdata("message", $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
            redirect('admin/site_logo');

        }
        else {
            $data = array('upload_data' => $this->upload->data());
            $this->session->set_flashdata("message", '<div class="alert alert-success">Logo updated successfully</div>');
            redirect('admin/site_logo');
        }
    }

    public function top_banners() {

        $data['error'] = 'Dimensions: 250x100 | Only PNG';
        $data['title'] = "Site Top Banners";
        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);

        $data['upload_status'] = "Upload file from here.";
        $data['message'] = $this->session->flashdata('message');

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/top_banners', $data);
        $this->load->view('admin/templates/footer');
    }

    public function top_banners_upload() {
        $config = array(
            'upload_path'   => './public/images',
            'allowed_types' => 'jpg|png',
            'max_size'      => 1000,
            'max_width'     => 250,
            'max_height'    => 100,
            'file_name'     => 'khojeko.png',
            'overwrite'     => TRUE
        );
        $this->load->library('upload', $config);

        $page = 'site_logo';
        $data['title'] = ucwords(strtolower(str_replace('_', ' ', $page)));

        $this->load->view('admin/templates/header', $data);

        if ( ! $this->upload->do_upload('userfile')) {
            $data['upload_status'] = "Logo not uploaded";
            $this->session->set_flashdata("message", $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
            redirect('admin/site_logo');

        }
        else {
            $data = array('upload_data' => $this->upload->data());
            $this->session->set_flashdata("message", '<div class="alert alert-success">Logo updated successfully</div>');
            redirect('admin/site_logo');
        }
    }

    public function partner_logo()
    {
        $this->load->model('database_models/retailer_partners_model');

        $data['error'] = 'Dimensions: 80x140 | Only PNG';
        $data['title'] = "Partners Logo";
        $data['user_info'] = $this->user_model->get_user_info('admin', $this->session->userdata['admin_logged_in']['id']);

        $data['upload_status'] = "Upload file from here.";
        $data['message'] = $this->session->flashdata('message');
        $data['retailer_partners'] = $this->retailer_partners_model->get_retailer_partners();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/retail_partners_banner', $data);
        $this->load->view('admin/templates/footer');
    }
//    public funtion partner_logo_upload()
//    {
//        $config = array(
//        'upload_path'   => './public/images/item_images',
//        'allowed_types' => 'jpg|png',
//        'max_size'      => 10000,
//        'max_width'     => 10000,
//        'max_height'    => 10000,
//        'overwrite'     => FALSE
//        );
//
//        $filename_arr = array();
//        $count=1;
//        $a = 1;
//
//        $name = $this->user_model->get_user_name();
//        $ad = $this->item_model->get_item_name();
//        $id = $this->item_model->get_item_id();
//
//        foreach ($_FILES as $key => $value) {
//            //if($count>2) {
//        $config['file_name'] = $name . "_" . $ad . $a++;
//        $this->upload->initialize($config);
//        if (!empty($value['tmp_name']) && $value['size'] > 0) {
//        if ($this->upload->do_upload($key)) {
//            // Code After Files Upload Success GOES HERE
//        $data_name = $this->upload->data();
//        if($count == 1){
//        $filename_arr[] = array(
//        'image' => $data_name['file_name'],
//        'item_id' => $id,//$this->item_model->get_item_id(),
//        'primary' => 1
//        );
//        }else {
//            $filename_arr[] = array(
//                'image' => $data_name['file_name'],
//                'item_id' => $id,//$this->item_model->get_item_id(),
//                'primary' => 0
//            );
//        }
//
//        // if($count == 1)
//        //     $filename_arr['primary'] = 1;
//        // else
//        //     $filename_arr['primary'] = 0;
//
//        } else {
//            $this->session->set_flashdata('error','<div class="alert alert-danger">'.$this->upload->display_errors().'</div>');
//
//            redirect('admin/post_ad');
//            // some errors
//        }
//        }
//        // }
//
//        $count++;
//        }
//        $this->item_img_model->add_img($filename_arr);
//
//        }
}