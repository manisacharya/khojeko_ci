<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Details extends CI_Controller {

    function __Construct() {
        parent::__Construct ();
        $this->load->database(); // load database
        $this->load->model('database_models/retailer_partners_model');
        $this->load->model('detail_db_model');
        $this->load->model('khojeko_db_model'); // load model
        $this->load->model('database_models/categories_model');
        $this->load->model('database_models/ask_me_model');
        $this->load->model('database_models/dealer_model');
        $this->load->model('database_models/items_model');
        $this->load->model('database_models/spam_model');
        $this->load->model('database_models/favourites_model');
    }

    //For Details Page
    public function details($id) {
        $data['details'] = $this->detail_db_model->get_details_item($id);
        if ($data['details']->deleted_date != 0)
            show_error('Sorry, page broken.');

        if ($this->session->has_userdata('logged_in')) {
            $this->add_recent_view($id);
        }

        $this->add_view_count($id);
        $data['id'] = $id;

        $data['specification'] = $this->detail_db_model->get_details_specs($id);
        $data['image'] = $this->detail_db_model->get_details_img($id);
        $data['user'] = $this->detail_db_model->get_details_user($data['details']);
        $data['user_type'] = $this->detail_db_model->get_details_dealer($data['user']);
        $data['date'] = $this->detail_db_model->get_date_diff($data['details']);
        $data['question'] = $this->ask_me_model->get_ques_ans($id);

        $data["category"] = $this->categories_model->get_categories();
        $data['dealer_list'] = $this->dealer_model->get_all_dealers();

        // counts : total, used/new, dealer/user ads
        $data["total_items"] = $this->items_model->count_items();
        $data["used_items"] = $this->items_model->count_status_items('used');
        $data["new_items"] = $this->items_model->count_status_items('new');
        $data['dealer_items'] = $this->items_model->count_user_items('dealer');
        $data['user_items'] = $this->items_model->count_user_items('personal');

        $data['retailer_partners'] = $this->retailer_partners_model->get_retailer_partners();

        $data['popular_district'] = $this->khojeko_db_model->popular_district();
        $data['popular_category'] = $this->khojeko_db_model->popular_category();
        $data['popular_dealer'] = $this->khojeko_db_model->popular_dealer();

        $data["fav_msg"] = $this->session->flashdata('fav_message');
        $data["spam_msg"] = $this->session->flashdata('spam_message');

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }

        $this->session->set_userdata('add_slider', 'true');
        $this->load->view('pages/templates/header', $data);
        $this->load->view('pages/details', $data);
        $this->load->view('pages/templates/footer', $data);
    }

    public function add_view_count($id) {
        // load cookie helper
        $this->load->helper('cookie');
        // this line will return the cookie which has id
        $check_visitor = $this->input->cookie(urldecode($id), TRUE);
        // this line will return the visitor ip address

        //$ip = $this->input->ip_address();
        //echo "<br>".$ip;
        // echo "<br>".$_COOKIE[urldecode($id)];

        //echo time();

        //echo ($_COOKIE['expire']!='' ? $_COOKIE['expire'] : 'Guest');

        // if the visitor visit this article for first time then //
        //set new cookie and update views column ..
        //you might be notice we used id for cookie name and ip
        //address for value to distinguish between articles views

        //delete_cookie(urldecode($id));
        //get_cookie(urldecode($id));
        if (!$check_visitor) {
            //echo time() + 120;
            $cookie = array(
                "name" => urldecode($id),
                "value" => time() + 120,
                "expire" => time() + 86400,
                'domain' => 'domain',
                'path'   => '/',
                'prefix' => ''
            );
            $this->input->set_cookie($cookie);
            $this->detail_db_model->update_counter($id);
        }

        // $cookie = array(
        // 	"name" => urldecode($id),
        // 	"value" => '',
        // 	"expire" => '0',
        // 	"secure" => false
        // );
        // //delete_cookie($cookie);
        // $this->input->set_cookie($cookie);
    }

    //For adding to favourites
    public function add_to_fav($id){
        if($this->session->has_userdata('logged_in')) {
            $type = $this->session->userdata['logged_in']['type'];
            if(strtoupper($type) == 'PERSONAL') {
                $user_id = $this->session->userdata['logged_in']['id'];
                $this->favourites_model->add_fav($id, $user_id);
            } else {
                $this->session->set_flashdata('fav_message','<div class="alert alert-danger">Only personal user can add to favourites.</div>');
            }
            redirect('details/'.$id);
        } else {
            $this->session->set_flashdata('previous_url', base_url('details/'.$id));
            redirect('login');
        }
    }

    //For adding to spam
    public function add_to_spam($id, $spam_count){
        if($this->session->has_userdata('logged_in')) {
            $user_id = $this->session->userdata['logged_in']['id'];
            $this->spam_model->add_spam($id, $user_id, $spam_count);
            redirect(base_url('details/'.$id));
        } else {
            $this->session->set_flashdata('previous_url', base_url('details/'.$id));
            redirect('login');
        }
    }

    //ask_me validation to add questions in table
    public function ask_me_validation($comment_count){
        $user_id = $this->session->userdata['logged_in']['id'];
        $item_id = $this->input->post('item_id');
        if($this->session->has_userdata('logged_in')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('question', 'Question', 'required|trim');

            //add the question in table
            if($this->form_validation->run()){
                //$this->ask_me_model->add_question($ques, $item_id, $user_id);
                $this->ask_me_model->add_question($item_id,$user_id,$comment_count);
                redirect('details/'.$item_id);
            } else {
                $this->load->view('pages/details/'.$item_id);
            }
        } else {
            $this->session->set_flashdata('previous_url', base_url('details/'.$item_id));
            redirect('login');
        }
    }

    //For Sending Email from signed up user to ad owner
    public function email_validation(){
        //$this->load->library('form_validation');

        //$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        //if($this->form_validation->run()){
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

        $this->email->from($this->input->post('email'));
        $this->email->to($this->input->post('tomsg'));
        $this->email->subject("Query from Khojeko.com");

        $message = "<p>Dear ".$this->input->post('username')."</p>";
        $message .= "<p>".$this->input->post('message')."</p>";
        $message .= "<p>-".$this->input->post('name')."</p>";
        $message .= "<p>".$this->input->post('mobile')."</p>";
        $this->email->message($message);

        $id = $this->input->post('id');
        if($this->email->send()){
            echo "email sent";
        } else {
            echo "email not sent";
        }
        redirect('details/'.$id);
        // } else {
        // 	echo "ERROR";
        // }
    }

    public function add_recent_view($item_id) {
        $this->load->model('database_models/recent_view_model');
        $user_session = $this->session->all_userdata();
        $this->recent_view_model->insert_recent_view($item_id, $user_session['logged_in']['id']);
    }
}
