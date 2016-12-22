<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

    function __Construct() {
        parent::__Construct ();
        $this->load->database(); // load database
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Signup_model');
        $this->load->model('khojeko_db_model');
        $this->load->model('retailer_partners_model');
        $this->load->model('database_models/categories_model');
        $this->load->model('database_models/dealer_model');
        $this->load->model('database_models/items_model');
        $this->load->model('database_models/user_model');
    }

    //Call the Sign up page
    public function signup(){
        if ($this->session->has_userdata('logged_in'))
            redirect('logged_in');

        $this->get_common_contents($data);

        $data['zones'] = $this->Signup_model->getAllZones();

        $email = $this->input->post('user_email');
        //generate random key
        $key = md5(uniqid());
        //insert into table according to user type
        if(strtoupper($this->input->post('acc_type')) == "DEALER"){
            //form validation for step 1
            $this->signup_step1();
            //Validate dealer profile from signup page and store in temporary file
            $this->form_validation->set_rules('user_name', 'Website Address', 'required|trim|is_unique[user.khojeko_username]');
            $this->form_validation->set_rules('dealer_name', 'Dealer Name', 'required|trim');
            $this->form_validation->set_rules('zone', 'Zone', 'required|trim');
            $this->form_validation->set_rules('district', 'District', 'required|trim');
            $this->form_validation->set_rules('city', 'City', 'required|trim');
            $this->form_validation->set_rules('address', 'Full Address', 'required|trim');
            $this->form_validation->set_rules('mobile', 'Mobile No.', 'required|trim|is_unique[dealer.primary_mob]');
            $this->form_validation->set_rules('profile', 'Company Profile', 'required|min_length[20]|trim');

            $name = $this->input->post('user_name');
            $district_selected = $this->input->post('district');
            //add the input data to temporary table
            if($this->form_validation->run()){
                $username = $this->input->post('user_name');
                $this->Signup_model->add_temp_user($key, $username);
                $dealerlogo = $this->dealer_logo($name);
                $dealerdoc = $this->dealer_vat($name);
                $id = $this->Signup_model->add_temp_dealer($email, $dealerlogo, $dealerdoc);
                $this->dealer_store($name, $id);

                //send email to the user
                $this->email_user($email, $key);
            }
        } else {
            //form validation for step 1
            $this->signup_step1();
            //generate unique username for personal user
            $username = $this->Signup_model->personal_username($this->input->post('full_name'));
            //Validate personal profile from signup page and store in temporary file
            $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
            $this->form_validation->set_rules('zone_p', 'Zone', 'required|trim');
            $this->form_validation->set_rules('district_p', 'District', 'required|trim');
            $this->form_validation->set_rules('city_p', 'City', 'required|trim');
            $this->form_validation->set_rules('address_p', 'Full Address', 'required|trim');
            $this->form_validation->set_rules('mobile_p', 'Mobile No.', 'required|trim|is_unique[personal.primary_mob]');

            $district_selected = $this->input->post('district_p');
            //add the input data to temporary table
            if ($this->form_validation->run()) {
                $this->Signup_model->add_temp_user($key, $username);
                $this->Signup_model->add_temp_personal($email);

                //send email to the user
                $this->email_user($email, $key);
            }
        }
        $data["district_selected"] = $district_selected;
        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/signup', $data);
        $this->load->view('pages/templates/footer', $data);

    }

    public function dealer_logo($name){
        $config1 = array(
            'upload_path'   => './public/images/dealer_logos',
            'allowed_types' => 'jpg|png',
            'file_name'     => 'logo_'.$name,
            'max_size'      => 10000,
            'max_width'     => 10000,
            'max_height'    => 10000,
            'overwrite'     => FALSE
        );
        //$this->load->library('upload', $config1);
        $this->upload->initialize($config1);

        if (!$this->upload->do_upload('dealerlogo')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('pages/signup', $error);
        } else {
            // Code After Files Upload Success GOES HERE
            $data_name = $this->upload->data();
            return $data_name['file_name'];
        }
    }

    public function dealer_vat($name){
        $config2 = array(
            'upload_path'   => './public/images/dealer_documents',
            'allowed_types' => 'jpg|png',
            'file_name'     => 'document_'.$name,
            'max_size'      => 10000,
            'max_width'     => 10000,
            'max_height'    => 10000,
            'overwrite'     => FALSE
        );
        $this->upload->initialize($config2);

        if (!$this->upload->do_upload('dealervat')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('pages/signup', $error);
        } else {
            // Code After Files Upload Success GOES HERE
            $data_name = $this->upload->data();
            return $data_name['file_name'];
        }
    }

    public function dealer_store($name, $id){
        $a=1;
        $config = array(
            'upload_path'   => './public/images/store_images',
            'allowed_types' => 'jpg|png',
            'max_size'      => 10000,
            'max_width'     => 10000,
            'max_height'    => 10000,
            'overwrite'     => FALSE
        );

        $filename_arr = array();
        $count=1;
        foreach ($_FILES as $key => $value) {
            if($count>2) {
                $config['file_name'] = "store_" . $name . $a++;
                $this->upload->initialize($config);
                if (!empty($value['tmp_name']) && $value['size'] > 0) {
                    if ($this->upload->do_upload($key)) {
                        // Code After Files Upload Success GOES HERE
                        $data_name = $this->upload->data();

                        $filename_arr[] = array(
                            'si_name' => $data_name['file_name'],
                            'd_id' => $id
                        );
                    } else {
                        $error = array('error' => $this->upload->display_errors());;
                        $this->load->view('pages/signup', $error);
                        // some errors
                    }
                }
            }
            $count++;
        }
        $this->Signup_model->store_front($filename_arr);

    }

    public function signup_step1(){
        $this->form_validation->set_rules('user_email', 'User email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'New Password', 'required|min_length[6]|trim');
        $this->form_validation->set_rules('re-password', 'Retype Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('acc_type', 'Account Type', 'required');
        //$this->form_validation->set_rules('captcha', 'Captcha', 'required|trim|matches[word]');
        $this->form_validation->set_rules('termsandcondition', 'tansc', 'callback_accept_terms');
    }

    //set message if terms and conditions is not selected
    public function accept_terms(){
        if ($this->input->post('termsandcondition')) {
            return true;
        } else {
            $this->form_validation->set_message('accept_terms', 'Please read and accept our terms and conditions.');
            return false;
        }
    }

    //call the done page from different function so the data is not re-enterd in the db
    public function signup_done (){
        if ($this->session->has_userdata('logged_in'))
            redirect('logged_in');


        $data["done_msg"] = $this->session->flashdata('done_msg');
        if ($data["done_msg"]) {
            $this->get_common_contents($data);
            //load the view page
            $this->load->view('pages/templates/header', $data);
            $this->load->view('pages/signup/signup_done');
            $this->load->view('pages/templates/footer', $data);
        } else {
            redirect('logged_in');
        }
    }
    //send email for confirmation after sign up
    public function email_user($email, $key){

        $this->load->library('email', array('mailtype'=>'html'));

        $this->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => 'noreply@technorio.com',
            'smtp_pass' => 'N0replyTec#n0ri0',
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n"
        ));

        $this->email->from('noreply@khojeko.com', 'Khojeko');
        $this->email->to($email);
        $this->email->subject('Confirm your account');

        $message = "<p>Thank you for signing up!</p>";
        $message .= "<p><a href='".base_url()."register_user/$key'>Click Here</a> to verify your account</p>";

        $this->email->message($message);

        if($this->email->send()){
            $this->session->set_flashdata('done_msg','<div class="alert alert-success">Congratulation your account is successfully created. Please check your email and verify your account soon.</div>');
        } else {
            $this->session->set_flashdata('done_msg','<div class="alert alert-danger">Email could not be sent. Please try again.</div>');
        }
        redirect('signup_done');
    }

    //to send the data from temp tables to the original tables
    public function register_user($key){

        if($this->Signup_model->is_key_valid_add_user($key)){
            $this->session->set_flashdata('login_msg','<div class="alert alert-success">You can now successfully login.</div>');
            redirect('login');
        } else {
            $this->session->set_flashdata('login_msg','<div class="alert alert-danger">Your account has already been verified.</div>');
            redirect('login');
        }
    }

    public function get_districts(){
        $this->Signup_model->get_districts();
    }

    public function available_username(){
        $this->Signup_model->available_username();
    }

    public function available_email(){
        $this->Signup_model->available_email();
    }

    public function available_mobile_P(){
        $this->Signup_model->available_mobile_P();
    }

    public function available_mobile_d(){
        $this->Signup_model->available_mobile_d();
    }

    public function get_common_contents(&$data) {
        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->dealer_model->get_all_dealers();

        $data["total_items"] = $this->items_model->count_items();
        $data["used_items"] = $this->items_model->count_status_items('used');
        $data["new_items"] = $this->items_model->count_status_items('new');
        $data['dealer_items'] = $this->items_model->count_user_items('dealer');
        $data['user_items'] = $this->items_model->count_user_items('personal');

        $data['retailer_partners'] = $this->retailer_partners_model->get_retailer_partners();

        $data['popular_district'] = $this->khojeko_db_model->popular_district();
        $data['popular_category'] = $this->khojeko_db_model->popular_category();
        $data['popular_dealer'] = $this->khojeko_db_model->popular_dealer();

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }
    }
}