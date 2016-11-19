<?php
class User_session extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->user_data = array();
        $this->load->model('database_models/categories_model');
        $this->load->model('khojeko_db_model');
        $this->load->model('general_database_model');
        $this->load->model('user_model');
        $this->load->model('detail_db_model');
    }

    //Call the Login page
    public function login() {
        if ($this->session->has_userdata('logged_in'))
            redirect('logged_in');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'User name', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|callback_validate_credentials');
        $username = $this->input->post('user_name');

        if($this->form_validation->run()){
            $user_session = array(
                'username' => $username,
                'id' => $this->detail_db_model->get_id_session($username),
                'is_logged_in' => 1
            );
            $this->session->set_userdata('logged_in', $user_session);
            redirect('logged_in');
        } else {
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
        $username = $this->input->post('user_name');

        if($this->user_model->can_login($username)){
            if($this->user_model->user_verification($username)) {
                return true;
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
            redirect('upanel/'.$set_data['logged_in']['username'].'/All');
            //$this->load->view('login/loggedin');
        }
        else {
            redirect('login');
        }
    }
}
?>