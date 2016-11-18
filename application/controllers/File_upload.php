<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File_upload extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function upload_view(){
        $this->load->view('upload', array('error' => ' ' ));
    }
    public function upload_file(){
        //echo base_url()."public/uploads/";
        $config =  array(
            'upload_path'     => "./public/uploads",
            'allowed_types'   => "gif|jpg|png|jpeg|pdf",
            'overwrite'       => TRUE,
            'max_size'        => "2048000",  // Can be set to particular file size
            'max_height'      => "768",
            'max_width'       => "1024"
        );

        //$config['encrypt_name'] = TRUE;
        $this->load->helper('string'); // for random file name
        $new_name = random_string('alnum', 16);
        //echo $new_name;
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);
        if($this->upload->do_upload())
        {
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('upload/success', $data);
        }
        else
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload', $error);
        }
    }
}
?>