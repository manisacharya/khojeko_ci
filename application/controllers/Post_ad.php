<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_ad extends CI_Controller {

    function __Construct() {
        parent::__Construct ();
        $this->load->database(); // load database

        $this->load->model('user_panel_model');
        $this->load->model('categories_model');
        $this->load->model('item_model');
        $this->load->model('image_model');
        $this->load->model('database_models/items_model');
        $this->load->model('database_models/dealer_model');
        $this->load->model('database_models/recent_view_model');
        $this->load->library('upload');
        
        $this->output->enable_profiler(TRUE);

    }

    public function post_form(){
        //$data['title'] = 'Post ad';
        if (!$this->session->has_userdata('logged_in'))
            redirect('logged_in');

        $session_data = $this->session->userdata('logged_in');
        $khojeko_username = $session_data['username'];

        $data['category'] = $this->categories_model->get_categories();
        $this->get_common_contents($data);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        $this->load->view('pages/templates/header', $data);

        $detail = $this->user_panel_model->getDetails($khojeko_username);

        $this->form_validation->set_rules('ad_title', 'Ad Title', 'required');
        // $this->form_validation->set_rules('shrt_description', 'Short Description', 'required');
        $this->form_validation->set_rules('ad_details', 'Ad Details', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = "first";

            $data['user_type'] = $detail->type;

            //$this->session->set_flashdata('data', $data);

            //redirect('adpost');
            $this->load->view('pages/freepost', $data);
            $this->load->view('pages/templates/footer', $data);

        }else {
            // $this->form_validation->set_rules('ad_title', 'Ad Title', 'required');
            // $this->form_validation->set_rules('shrt_description', 'Short Description', 'required');
            // $this->form_validation->set_rules('ad_details', 'Ad Details', 'required');

            $this->item_model->add_item($detail);

            $this->personal_upload($detail);

            $data['user_type'] = $detail->type;

            $data['message'] = "Successfully Added !";

//            $this->session->set_flashdata('data', $data);
//            redirect('adpost');
            $this->load->view('pages/freepost', $data);
            $this->load->view('pages/templates/footer', $data);

        }
    }

    public function personal_upload($detail){
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

        $name = $detail->khojeko_username;
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
                         $error = array('error' => $this->upload->display_errors());;
                         $this->load->view('admin/post_ad', $error);
                        // some errors
                    }
                }
           // }

            $count++;
        }
        $this->image_model->add_img($filename_arr);
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