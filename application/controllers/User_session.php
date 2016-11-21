<?php
class User_session extends CI_Controller {

    private $khojeko_username;

    function __construct() {
        parent::__construct();
        $this->user_data = array();
        $this->load->model('database_models/categories_model');
        $this->load->model('khojeko_db_model');
        $this->load->model('general_database_model');
        $this->load->model('user_model');
        $this->load->model('detail_db_model');
        $this->load->model('database_models/dealer_model');
        $this->load->model('database_models/items_model');
        $this->load->model('database_models/user_model');
    }

    //Call the Login page
    public function login() {
        if ($this->session->has_userdata('logged_in'))
            redirect('logged_in');

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
            $data["category"] = $this->categories_model->get_categories();
            $data['dealer_list'] = $this->dealer_model->get_all_dealers();

            // counts : total, used/new, dealer/user ads
            $data["total_items"] = $this->items_model->count_items();
            $data["used_items"] = $this->items_model->count_status_items('used');
            $data["new_items"] = $this->items_model->count_status_items('new');
            $data['dealer_items'] = $this->items_model->count_user_items('dealer');
            $data['user_items'] = $this->items_model->count_user_items('personal');

            $this->load->view("pages/templates/header", $data);
            $this->load->view("pages/user_login");
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
            if($set_data['logged_in']['type'] == 'dealer')
                redirect('dpanel/'.$set_data['logged_in']['username'].'/All');
            else if($set_data['logged_in']['type'] == 'personal')
                redirect('upanel/'.$set_data['logged_in']['username'].'/All');
        }
        else {
            redirect('login');
        }
    }
}
?>