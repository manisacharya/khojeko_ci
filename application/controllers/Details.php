<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Details extends CI_Controller {

    function __Construct() {
        parent::__Construct ();
        $this->load->database(); // load database
        $this->load->model('detail_db_model');
        $this->load->model('khojeko_db_model'); // load model
        $this->load->model('general_database_model');
        $this->load->model('database_models/categories_model');
        $this->load->model('Spam_and_fav_model');
        $this->load->model('Ask_me_model');
        $this->output->enable_profiler(TRUE);
    }

    //For Details Page
    public function details($id) {
        if ($this->session->has_userdata('logged_in')) {
            $this->add_recent_view($id);
        }
        $this->add_view_count($id);
        $data['id'] = $id;

        $data['details'] = $this->detail_db_model->get_details_item($id);
        $data['specification'] = $this->detail_db_model->get_details_specs($id);
        $data['image'] = $this->detail_db_model->get_details_img($id);
        $data['user'] = $this->detail_db_model->get_details_user($data['details']);
        $data['user_type'] = $this->detail_db_model->get_details_dealer($data['user']);
        $data['date'] = $this->detail_db_model->get_date_diff($data['details']);
        $data['question'] = $this->Ask_me_model->get_ques_ans($id);

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

        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('database_models/recent_view_model');
            $user_session = $this->session->all_userdata();
            $data['recent_views'] = $this->recent_view_model->get_recent_view($user_session['logged_in']['id']);
        }

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
        //$data['fname'] = $this->session->userdata('username');
        if($this->session->has_userdata('logged_in')) {
            $type = $this->session->userdata['logged_in']['type'];
            if(strtoupper($type) == 'PERSONAL') {
                $p_id = $this->session->userdata['logged_in']['id'];
                $this->Spam_and_fav_model->add_fav($id, $p_id);
                redirect('details/'.$id);
            } else {
                echo "only personal user can add to favourite";
            }
        } else {
            $this->load->view('login');
        }
    }

    //For adding to spam
    public function add_to_spam($id){
        if($this->session->has_userdata('logged_in')) {
            $user_id = $this->session->userdata['logged_in']['id'];
            $this->Spam_and_fav_model->add_spam($id, $user_id);
        } else {
            $this->load->view('login');
        }
    }

    //ask_me validation to add questions in table
    public function ask_me_validation(){
        if($this->session->has_userdata('logged_in')) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('question', 'Question', 'required|trim');

            $user_id = $this->session->userdata['logged_in']['id'];
            $item_id = $this->input->post('item_id');

            //add the question in table
            if($this->form_validation->run()){
                //$this->Ask_me_model->add_question($ques, $item_id, $user_id);
                $this->Ask_me_model->add_question($item_id,$user_id);
                redirect('details/'.$item_id);
            } else {
                $this->load->view('pages/details/'.$item_id);
            }
        }else {
            $this->load->view('login');
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
