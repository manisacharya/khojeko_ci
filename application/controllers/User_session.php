<?php
class User_session extends CI_Controller {

    private $khojeko_username;
    public $previous_url;

    function __construct() {
        parent::__construct();
        $this->user_data = array();
        $this->load->model('database_models/categories_model');
        $this->load->model('retailer_partners_model');
        $this->load->model('khojeko_db_model');
        $this->load->model('user_model');
        $this->load->model('detail_db_model');
        $this->load->model('database_models/dealer_model');
        $this->load->model('database_models/items_model');
        $this->load->model('database_models/user_model');
        $this->previous_url = $this->session->flashdata('previous_url');
    }

    //Call the Login page
    public function login() {
        $this->session->set_flashdata('previous_url', $this->previous_url);

        if ($this->session->has_userdata('logged_in')) {
            redirect('logged_in');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'User name', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|callback_validate_credentials');
        //$username = $this->input->post('user_name');

        if($this->form_validation->run()){
            $user_session = array(
                'username'      => $this->khojeko_username,
                'type'          => $this->detail_db_model->get_type_session($this->khojeko_username),
                'id'            => $this->detail_db_model->get_id_session($this->khojeko_username),
                'is_logged_in'  => 1
            );
            $this->session->set_userdata('logged_in', $user_session);
            redirect('logged_in');
        } else {
            $this->get_common_contents($data);

            $data["login_msg"] = $this->session->flashdata('login_msg');

            //flashdata for password changed from new_password
            $data['pwd_changed'] = $this->session->flashdata('password_changed');

            $this->load->view("pages/templates/header", $data);
            $this->load->view("pages/user_login", $data);
            $this->load->view("pages/templates/footer", $data);
        }
    }

    //Destroy session to logout
    public function logout(){
        //$this->session->sess_destroy($data);
        $this->session->unset_userdata('logged_in');
        redirect();
    }

    //set message if username/password is incorrect
    public function validate_credentials(){
        $username_login = $this->input->post('user_name');
        $this->khojeko_username = $this->user_model->can_login($username_login);

        if($this->khojeko_username){
            if($this->user_model->user_verification($this->khojeko_username)) {
                return $this->khojeko_username;
            } else {
                $this->form_validation->set_message("validate_credentials", "Please verify your account from your email.");
                return false;
            }
        } else {
            $this->form_validation->set_message("validate_credentials", "Incorrect username/password");
            return false;
        }
    }

    public function logged_in() {
        $set_data = $this->session->all_userdata();
        if (isset($set_data['logged_in'])) {
            if (strlen($this->previous_url) == 0) {
                /*if ($set_data['logged_in']['type'] == 'dealer')
                    redirect('dpanel/' . $set_data['logged_in']['username']);
                else if ($set_data['logged_in']['type'] == 'personal')
                    redirect('upanel/' . $set_data['logged_in']['username']);*/
                redirect();
            } else {
                redirect($this->previous_url);
            }
        }
        else {
            redirect('login');
        }
    }

    public function lost_password(){
        if ($this->session->has_userdata('logged_in'))
            redirect('logged_in');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('useremail', 'User email', 'required|trim|valid_email|callback_check_email');

        if($this->form_validation->run()){
            $this->email_user($this->input->post('useremail'));
            redirect('lost_password');
        } else {
            $this->get_common_contents($data);

            $data['email'] = $this->session->flashdata('email_sent');

            $this->load->view("pages/templates/header", $data);
            $this->load->view("pages/login/lost_password", $data);
            $this->load->view("pages/templates/footer", $data);
        }
    }

    public function check_email(){
        if($this->user_model->check_email()) {
            return true;
        } else {
            $this->form_validation->set_message("check_email", "This email is invalid.");
            return false;
        }
    }

    //send email for lost password
    public function email_user($email){

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

        $this->email->from('noreply@khojeko.com','Khojeko');
        $this->email->to($email);
        $this->email->subject('Lost your password');
        $email = urlencode($email);

        $message = "<p><a href='".base_url()."lost_password/$email'>Click Here</a> to change your password</p>";

        $this->email->message($message);

        if($this->email->send()){
            $this->session->set_flashdata('email_sent','<div class="alert alert-success">An email has been sent to your email address.</div>');
        } else {
            $this->session->set_flashdata('email_sent','<div class="alert alert-danger">Email could not be sent.</div>');
        }
    }

    public function lost_password_change($email){
        $data['email'] = $email;
        $this->load->view("pages/login/hidden_email", $data);
    }

    public function new_password(){
        if ($this->session->has_userdata('logged_in'))
            redirect('logged_in');

        $this->load->library('form_validation');
        $email = $this->input->post('email');

        if($email == null) {
            $this->form_validation->set_rules('n_password', 'New Password', 'required|trim');
            $this->form_validation->set_rules('c_password', 'Confirm Password', 'required|trim|matches[n_password]');
            if($this->input->post('user_email') == null) {
                redirect('logged_in');
            }
            $email = $this->input->post('user_email');
            if ($this->form_validation->run()){
                $this->user_model->new_password();
                redirect('login');
            } else {
                $this->show_page($email);
            }
        } else {
            $this->show_page($email);
        }
    }

    public function show_page($email){
        $this->get_common_contents($data);
        $data['email'] = $email;

        $this->load->view("pages/templates/header", $data);
        $this->load->view("pages/login/new_password", $data);
        $this->load->view("pages/templates/footer", $data);
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
    }
}
?>