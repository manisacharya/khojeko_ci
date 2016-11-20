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
    }

    public function index() {
        $data = array(
            'title' => 'Upload Form',
            'error' => ''
        );
        $this->load->view('templates/header', $data);
        $this->load->view('upload/upload_form', $data);
        $this->load->view('templates/footer');
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

            $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            $this->load->view('admin/'.$page, $data);
        }
        else {
            $data = array('upload_data' => $this->upload->data());
            $data['upload_status'] = "Logo updated successfully";
            $data['error'] = '';
            $this->load->view('admin/'.$page, $data);
        }
    }
}