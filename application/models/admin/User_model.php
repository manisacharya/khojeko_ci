<?php

/**
 * Created by PhpStorm.
 * User: manisAlert
 * Date: 10/1/2016
 * Time: 1:20 PM
 */
class User_model extends CI_Model
{
    //user table attribute
    public $user_id;
    public $khojeko_username;
    public $password;
    public $email;
    public $type;
    public $user_key;
    public $ac_created;
    public $u_verified;
    public $verification_key;
    public $m_verified;
    public $user_status;
    
    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('admin/item_model'); // load model
        $this->load->model('admin/personal_model');
        $this->load->model('admin/specification_model');
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



    public function get_user_info() {
        $this->db->join('admin', 'admin.a_id = user.user_key');
        $this->db->where('user.type', 'admin');
        $this->db->where('user.user_id', $this->session->userdata['admin_logged_in']['id']);
        $query = $this->db->get('user', 1);

        return $query->row();
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
}
?>