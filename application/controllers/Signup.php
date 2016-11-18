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
        $this->load->model('database_models/categories_model');
    }

    //Call the Sign up page
    public function signup(){
        if ($this->session->has_userdata('logged_in'))
            redirect('logged_in');

        /*item/Category JOIN ARRAY*/
        $item_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'category',
                'condition' => 'items.c_id = category.c_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_img',
                'condition' => 'items.item_id = item_img.item_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_spec',
                'condition' => 'items.item_id = item_spec.item_id',
                'jointype' => 'INNER'
            )
        );

        $dealer_list_joins = array(
            array (
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            )
        );
        $personal_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'personal',
                'condition' => 'user.user_key = personal.p_id',
                'jointype' => 'INNER'
            )
        );

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "1=1");
        $data["used_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='used'");
        $data["new_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='new'");
        $data['dealer_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $item_joins, 'type="dealer"');
        $data['user_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $personal_joins, 'type="personal"');

        $data['dealer_list'] = $this->khojeko_db_model->joinThings('user', 'khojeko_username, name', $dealer_list_joins, 'type="dealer"');
        $data["category"] = $this->categories_model->get_categories();

        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/signup', $data);
        $this->load->view('pages/templates/footer', $data);
    }

    //Validate login details from signup page and store in temporary file
    public function details_validation(){

        /*item/Category JOIN ARRAY*/
        $item_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'category',
                'condition' => 'items.c_id = category.c_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_img',
                'condition' => 'items.item_id = item_img.item_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_spec',
                'condition' => 'items.item_id = item_spec.item_id',
                'jointype' => 'INNER'
            )
        );

        $dealer_list_joins = array(
            array (
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            )
        );
        $personal_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'personal',
                'condition' => 'user.user_key = personal.p_id',
                'jointype' => 'INNER'
            )
        );

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "1=1");
        $data["used_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='used'");
        $data["new_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='new'");
        $data['dealer_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $item_joins, 'type="dealer"');
        $data['user_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $personal_joins, 'type="personal"');

        $data['dealer_list'] = $this->khojeko_db_model->joinThings('user', 'khojeko_username, name', $dealer_list_joins, 'type="dealer"');
        $data["category"] = $this->categories_model->get_categories();

        $email = $this->input->post('user_email');
        //generate random key
        $key = md5(uniqid());

        //insert into table according to user type
        if(strtoupper($this->input->post('acc_type')) == "DEALER"){
            //$this->load->view('signup/signup_d_profile', $data);
            $this->signup_step1();
            //Validate dealer profile from signup page and store in temporary file
            $this->form_validation->set_rules('dealer_name', 'Dealer Name', 'required|trim');
            $this->form_validation->set_rules('zone', 'Zone', 'required|trim');
            $this->form_validation->set_rules('district', 'District', 'required|trim');
            $this->form_validation->set_rules('city', 'City', 'required|trim');
            $this->form_validation->set_rules('address', 'Full Address', 'required|trim');
            $this->form_validation->set_rules('mobile', 'Mobile No.', 'required|trim|is_unique[dealer.primary_mob]');
            $this->form_validation->set_rules('telephone', 'Telephone No.', 'required|trim');
            $this->form_validation->set_rules('profile', 'Company Profile', 'required|trim');
            $this->form_validation->set_rules('website', 'Company Website', 'required|trim');

            $name = $this->input->post('dealer_name');
            //add the input data to temporary table
            if($this->form_validation->run()){
                $this->Signup_model->add_temp_user($key);
                $dealerlogo = $this->dealer_logo($name);
                $dealerdoc = $this->dealer_vat($name);
                $id = $this->Signup_model->add_temp_dealer($email, $dealerlogo, $dealerdoc);
                $this->dealer_store($name, $id);

                //send email to the user
                $this->email_user($email, $key);
            } else {
                $this->load->view('pages/templates/header', $data);
                $this->load->view('pages/signup', $data);
                $this->load->view('pages/templates/footer', $data);
                //echo "error dealer";
            }
        } else {
            //$this->load->view('signup/signup_p_profile', $data);

            $this->signup_step1();
            //Validate personal profile from signup page and store in temporary file
            $this->form_validation->set_rules('full_name', 'Full Name', 'required|trim');
            $this->form_validation->set_rules('zone_p', 'Zone', 'required|trim');
            $this->form_validation->set_rules('district_p', 'District', 'required|trim');
            $this->form_validation->set_rules('city_p', 'City', 'required|trim');
            $this->form_validation->set_rules('address_p', 'Full Address', 'required|trim');
            $this->form_validation->set_rules('mobile_p', 'Mobile No.', 'required|trim|is_unique[personal.primary_mob]');
            $this->form_validation->set_rules('sec_mobile', 'Another Mobile No.', 'required|trim');
            $this->form_validation->set_rules('telephone_p', 'Telephone No.', 'required|trim');
            //add the input data to temporary table
            if ($this->form_validation->run()) {
                $this->Signup_model->add_temp_user($key);
                $this->Signup_model->add_temp_personal($email);

                //send email to the user
                $this->email_user($email, $key);

                //call the done page
                //$this->signup_done($this->input->post('key'));
            } else {
                $this->load->view('pages/templates/header', $data);
                $this->load->view('pages/signup', $data);
                $this->load->view('pages/templates/footer', $data);
                //echo "error";
            }
        }
        //redirect('/details');
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
        $this->form_validation->set_rules('user_name', 'Username', 'required|trim|is_unique[user.khojeko_username]');
        $this->form_validation->set_rules('user_email', 'User email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'New Password', 'required|trim');
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

        /*item/Category JOIN ARRAY*/
        $item_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'category',
                'condition' => 'items.c_id = category.c_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_img',
                'condition' => 'items.item_id = item_img.item_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'item_spec',
                'condition' => 'items.item_id = item_spec.item_id',
                'jointype' => 'INNER'
            )
        );

        $dealer_list_joins = array(
            array (
                'table' => 'dealer',
                'condition' => 'user.user_key = dealer.d_id',
                'jointype' => 'INNER'
            )
        );
        $personal_joins = array(
            array(
                'table' => 'user',
                'condition' => 'user.user_id = items.user_id',
                'jointype' => 'INNER'
            ),
            array(
                'table' => 'personal',
                'condition' => 'user.user_key = personal.p_id',
                'jointype' => 'INNER'
            )
        );

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "1=1");
        $data["used_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='used'");
        $data["new_items"] = $this->khojeko_db_model->getCount("items", "COUNT(*) as total", "item_type='new'");
        $data['dealer_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $item_joins, 'type="dealer"');
        $data['user_items'] = $this->khojeko_db_model->joinThingsRow('items', 'COUNT(*) as total', $personal_joins, 'type="personal"');

        $data['dealer_list'] = $this->khojeko_db_model->joinThings('user', 'khojeko_username, name', $dealer_list_joins, 'type="dealer"');
        $data["category"] = $this->categories_model->get_categories();

        //load the view page
        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/signup/signup_done');
        $this->load->view('pages/templates/footer', $data);
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

        $this->email->from('khojeko@khojeko.com');
        $this->email->to($email);
        $this->email->subject('Confirm your account');

        $message = "<p>Thank you for signing up!</p>";
        $message .= "<p><a href='".base_url()."register_user/$key'>Click Here</a> to verify your account</p>";

        $this->email->message($message);

        if($this->email->send()){
            //echo "The email has been sent";

            ///call the done page
            redirect('signup_done');
            //$this->signup_done($this->input->post('key'));
        } else {
            echo "could not send email";
        }
    }

    //to send the data from temp tables to the original tables
    public function register_user($key){

        if($this->Signup_model->is_key_valid_add_user($key)){
            echo "You can now successfully login";
            redirect('/login');
        } else {
            echo "Your account is not valid. Please signup again.";
        }
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
}