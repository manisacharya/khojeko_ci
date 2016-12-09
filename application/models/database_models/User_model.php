<?php
/* *
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 9/27/16
 * Time: 11:44 PM
 */
class User_model extends CI_Model {
    public $khojeko_username;
    public $password;
    public $email;
    public $type;
    public $user_key;
    public $ac_created;
    public $status;
    public $u_verified;
    public $verification_key;
    public $m_verified;
    public $user_status;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/item_model'); // load model
        $this->load->model('admin/personal_model');
        $this->load->model('admin/specification_model');
    }

    public function get_user_info($type, $value) {
        $this->db->where('user.type', $type);
        if ($type == 'admin') {
            $this->db->join('admin', 'admin.a_id = user.user_key');
            $this->db->where('user.user_id', $value);
        }
        else if ($type == 'dealer') {
            $this->db->join('dealer', 'dealer.d_id = user.user_key');
            $this->db->where('user.khojeko_username', $value);
        }
        else if ($type == 'personal') {
            $this->db->join('personal', 'personal.p_id = user.user_key');
            $this->db->where('user.khojeko_username', $value);
        }
        $query = $this->db->get('user', 1);
        $result = $query->row();
        return $this->user_xss_clean($result, $type);
    }

    public function register_user() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($this->db->table_exists('user')) {
            $this->khojeko_username = $username;
            $this->ac_created = time('Asia/Kathmandu');

            $hash = password_hash($password, PASSWORD_DEFAULT);
            $this->password = $hash;

            $this->email    = $this->input->post('email');

            return $this->db->insert('user', $this);
        }
        else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }

    public function change_password() {
        if ($this->db->table_exists('user')) {
            $this->password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $this->db->where('user.user_id', $this->session->userdata['admin_logged_in']['id']);
            $this->db->set('password', $this->password);
            $this->db->update('user');
            return TRUE;
        }
        return FALSE;
    }

    public function user_validate() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->where('type', 'admin');
        $query = $this->db->get('user');
        foreach ($query->result() as $row) {
            if($username == $row->khojeko_username) {
                if (password_verify($password, $row->password)) {
                    $user_session = array(
                        'username'  => $row->khojeko_username,
                        'id'        => $row->user_id,
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata('admin_logged_in', $user_session);
                    return TRUE;
                }
            }
        }

        return FALSE;
    }

    public function password_validate() {
        $password = $this->input->post('current_password');

        $this->db->where('user.user_id', $this->session->userdata['admin_logged_in']['id']);
        $result = $this->db->get('user', 1)->row();

        if (password_verify($password, $result->password)) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function check_user(){
        if ($this->db->table_exists('user')) {
            //SELECT * FROM `user`JOIN `personal` WHERE `user`.type = 'personal' AND `user`.user_key = `personal`.p_id
            $this->email = $this->input->post('email');
            $this->khojeko_username = $this->input->post('username');
            // $this->primary_mob = $this->input->post('mobile1');

            // $this->khojeko_username = $this->input->post('username');
            // $this->email = $this->input->post('email');
            //$this->primary_mob = $this->input->post('mobile1');
            //  $query = "SELECT * FROM 'user' JOIN 'personal' WHERE 'user'.type = 'personal' AND 'user'.user_key = 'personal'.p_id AND 'personal'.primary_mob=".$this->primary_mob." AND email=".$this->email." AND khojeko_username=".$this->khojeko_username;
            // // $query = "select * from ".$this::DB_TABLE." name where $column=? and $column2 = ?";

            //$q = $this->db->query($query);

            $q = $this->db->get_where('user', array('email' => $this->email, 'khojeko_username' => $this->khojeko_username));

            if($q->result()){
                foreach ($q->result() as $row)
                {
                    $this->user_id = $row->user_id;
                }
                return true;
            }
            else{
                return false;
            }
        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }

    public function add_user(){
        if ($this->db->table_exists('user')) {

            //$this->khojeko_username = $this->input->post('username');
            //user
            //here hashing done
            $this->password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            //$this->khojeko_username = $this->input->post('username');
            //$this->password = $this->input->post('password');
            //$this->email = $this->input->post('email');
            $this->type = "personal";
            $this->user_key = $this->personal_model->get_p_id();

            //if($this->email!=NULL){
            $this->ac_created = NOW();

            $this->u_verified = 0;

            $this->verification_key = uniqid();

            $this->m_verified = 0;
            $this->user_status = 0;

            $this->db->insert('user', $this);
            //}
            $query = $this->db->get_where('user', array('email' => $this->email));
            //$this->db->where('published_date', $this->published_date);

            //$query =  $this->db->get();
            foreach ($query->result() as $row)
            {
                $this->user_id = $row->user_id;
            }

            // $this->specification_model->add_spec();
        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }

    public function get_user_id(){

        return $this->user_id;
    }

    public function get_user_name(){

        return $this->khojeko_username;
    }

    public function available_username(){
        $query = $this->db->get_where('user', ['khojeko_username' => $this->input->post('username')]);
        echo $query->num_rows();
    }

    public function available_email(){
        $query = $this->db->get_where('user', ['email' => $this->input->post('email')]);
        echo $query->num_rows();
    }

    public function user_xss_clean(&$user, $type) {
        $user->khojeko_username = html_escape($this->security->xss_clean($user->khojeko_username));
        $user->email            = html_escape($this->security->xss_clean($user->email));
        if ($type == "dealer") {
            $user->name             = html_escape($this->security->xss_clean($user->name));
            $user->zone             = html_escape($this->security->xss_clean($user->zone));
            $user->district         = html_escape($this->security->xss_clean($user->district));
            $user->city             = html_escape($this->security->xss_clean($user->city));
            $user->full_address     = html_escape($this->security->xss_clean($user->full_address));
            $user->primary_mob      = html_escape($this->security->xss_clean($user->primary_mob));
            $user->tel_no           = html_escape($this->security->xss_clean($user->tel_no));
            $user->detail           = html_escape($this->security->xss_clean($user->detail));
            $user->logo             = html_escape($this->security->xss_clean($user->logo));
            $user->document         = html_escape($this->security->xss_clean($user->document));
            $user->company_website  = html_escape($this->security->xss_clean($user->company_website));
        } else if($type == "personal") {
            $user->name             = html_escape($this->security->xss_clean($user->name));
            $user->zone             = html_escape($this->security->xss_clean($user->zone));
            $user->district         = html_escape($this->security->xss_clean($user->district));
            $user->city             = html_escape($this->security->xss_clean($user->city));
            $user->full_address     = html_escape($this->security->xss_clean($user->full_address));
            $user->primary_mob      = html_escape($this->security->xss_clean($user->primary_mob));
            $user->secondary_mob    = html_escape($this->security->xss_clean($user->secondary_mob));
            $user->tel_no           = html_escape($this->security->xss_clean($user->tel_no));
        } else if($type == "admin") {
            $user->a_id             = html_escape($this->security->xss_clean($user->a_id));
            $user->admin_name       = html_escape($this->security->xss_clean($user->admin_name));
            $user->address          = html_escape($this->security->xss_clean($user->address));
            $user->mob              = html_escape($this->security->xss_clean($user->mob));
            $user->avatar           = html_escape($this->security->xss_clean($user->avatar));
        }
        return $user;
    }

    public function change_password_user(){
        $username =  $this->session->userdata['logged_in']['username'];
        $password =  $this->input->post('o_password');

        //check old password from database
        $this->db->select('password')->from('user');
        $this->db->where('khojeko_username',$username);
        $query = $this->db->get();
        $row = $query->row();
        $db_password = $row->password;

        if(password_verify($password, $db_password)) {
            if ($this->db->update('user', array('password' => password_hash($this->input->post('n_password'), PASSWORD_DEFAULT))))
                $this->session->set_flashdata('change_password', '<div class="alert alert-success">Your password has been changed.</div>');
        } else
            $this->session->set_flashdata('change_password','<div class="alert alert-danger">Your password could not be changed.</div>');
    }
}