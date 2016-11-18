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
        $data = array(
            'title'     => 'Upload Form',
            'message'   => 'Uploaded Successfully'
        );

        $config = array(
            'upload_path'   => './uploads/',
            'allowed_types' => 'png',
            'max_size'      => 1000,
            'max_width'     => 250,
            'max_height'    => 100
        );
        $this->load->library('upload', $config);

        $this->load->view('admin/templates/header', $data);
        if ( ! $this->upload->do_upload('userfile')) {
            $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            $this->load->view('admin/site_logo', $data);
            $this->load->view('admin/templates/footer');
        }
        else {
            $this->session->set_flashdata('message', 'File Uploded Successfully');
            redirect('admin/site_logo');
        }
    }
}