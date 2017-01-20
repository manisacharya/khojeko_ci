<?php
/* *
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 9/27/16
 * Time: 11:44 PM
 */
class User_model extends CI_Model {
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
        parent::__construct();
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
        else {
            $this->db->join('personal', 'personal.p_id = user.user_key');
            $this->db->where('user.khojeko_username', $value);
        }
        $query = $this->db->get('user', 1);
        $result = $query->row();
        return $this->user_xss_clean($result, $type);
    }

    public function check_user(){
        if ($this->db->table_exists('user')) {

            $this->email = $this->input->post('email');

            $q = $this->db->get_where('user', array('email' => $this->email));

            if($q->result()){
//                foreach ($q->result() as $row)
//                {
//                    $this->user_id = $row->user_id;
//                }
                return true;
            }
            else{
                return false;
            }
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

    public function user_validate() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->db->where('type', 'admin');
        $query = $this->db->get('user');
        foreach ($query->result() as $row) {
            if($username == $row->khojeko_username) {
                if (password_verify($password, $row->password)) {
                    $user_session = array(
                        'username'      => $row->khojeko_username,
                        'id'            => $row->user_id,
                        'logged_in'     => TRUE
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

    public function register_user() {
        $this->khojeko_username     = $this->input->post('username');
        $password                   = $this->input->post('password');
        $this->email                = $this->input->post('email');
        $this->ac_created           = NOW();
        $this->type                 = 'admin';
        $this->u_verified           = 1;
        $this->m_verified           = 1;
        $this->verification_key     = uniqid();
        $this->user_status          = 1;

        if ($this->db->table_exists('user')) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $this->password = $hash;
            $this->load->model('database_models/admin_model');

            $this->user_key = $this->admin_model->register_admin();
            return $this->db->insert('user', $this);;
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
            $this->db->where('khojeko_username', $username);
            $this->db->set('password', password_hash($this->input->post('n_password'), PASSWORD_DEFAULT));
            if ($this->db->update('user'))
                $this->session->set_flashdata('change_password', '<div class="alert alert-success">Your password has been changed.</div>');
        } else
            $this->session->set_flashdata('change_password','<div class="alert alert-danger">Your password could not be changed.</div>');
    }

    //from detail_db_model
    //show details of user table
    public function get_details_user($details){

        $info = $this->db->get_where('user', array('user_id' => $details->user_id));
        $row = $this->user_xss_clean($info->row());
        return $row;
    }

    //from detail_db_model
    //show details of dealer or personal table
    public function get_details_dealer($user){
        $user_type = $user->type;
        if(strtoupper("$user_type") == "DEALER")
            $user_id = "d_id";
        else
            $user_id = "p_id";

        $info = $this->db->get_where($user_type, array($user_id => $user->user_key));
        $row = $this->user_type_xss_clean($info->row(), $user_id);
        return $row;
    }
    //from detail_db_model
    //function to get id for session
    public function get_id_session($username){

        $info = $this->db->get_where('user', array('khojeko_username' => $username));
        $row = $info->row();
        $id = 'user_id';
        $id = $row->$id;
        return $id;
    }

    //from detail_db_model
    //function to get user type for session
    public function get_type_session($username){

        $info = $this->db->get_where('user', array('khojeko_username' => $username));
        $row = $info->row();
        $id = 'type';
        $id = $row->$id;
        return $id;
    }

    //from detail_db_model
    public function user_xss_clean($user) {
        $user->khojeko_username    = html_escape($this->security->xss_clean($user->khojeko_username));
        $user->password            = html_escape($this->security->xss_clean($user->password));
        $user->email               = html_escape($this->security->xss_clean($user->email));
        $user->type                = html_escape($this->security->xss_clean($user->type));
        $user->user_key            = html_escape($this->security->xss_clean($user->user_key));
        $user->ac_created          = html_escape($this->security->xss_clean($user->ac_created));
        $user->u_verified          = html_escape($this->security->xss_clean($user->u_verified));
        $user->verification_key    = html_escape($this->security->xss_clean($user->verification_key));
        $user->m_verified          = html_escape($this->security->xss_clean($user->m_verified));
        $user->user_status         = html_escape($this->security->xss_clean($user->user_status));

        return $user;
    }

    //from detail_db_model
    public function user_type_xss_clean($type, $user_id) {
        if($user_id == "d_id"){
            $type->name             = html_escape($this->security->xss_clean($type->name));
            $type->zone             = html_escape($this->security->xss_clean($type->zone));
            $type->district         = html_escape($this->security->xss_clean($type->district));
            $type->city             = html_escape($this->security->xss_clean($type->city));
            $type->full_address     = html_escape($this->security->xss_clean($type->full_address));
            $type->primary_mob      = html_escape($this->security->xss_clean($type->primary_mob));
            $type->tel_no           = html_escape($this->security->xss_clean($type->tel_no));
            $type->detail           = html_escape($this->security->xss_clean($type->detail));
            $type->logo             = html_escape($this->security->xss_clean($type->logo));
            $type->document         = html_escape($this->security->xss_clean($type->document));
            $type->company_website  = html_escape($this->security->xss_clean($type->company_website));
        } else {
            $type->name             = html_escape($this->security->xss_clean($type->name));
            $type->zone             = html_escape($this->security->xss_clean($type->zone));
            $type->district         = html_escape($this->security->xss_clean($type->district));
            $type->city             = html_escape($this->security->xss_clean($type->city));
            $type->full_address     = html_escape($this->security->xss_clean($type->full_address));
            $type->primary_mob      = html_escape($this->security->xss_clean($type->primary_mob));
            $type->secondary_mob    = html_escape($this->security->xss_clean($type->secondary_mob));
            $type->tel_no           = html_escape($this->security->xss_clean($type->tel_no));
        }

        return $type;
    }

    public function account_password_validate() {
        $password = $this->input->post('o_password');

        $this->db->where('user.user_id', $this->session->userdata['logged_in']['id']);
        $result = $this->db->get('user', 1)->row();

        if (password_verify($password, $result->password)) {
            return TRUE;
        }
        else {
            return FALSE;
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

//    public function user_xss_clean(&$user, $type) {
//        $user->khojeko_username = html_escape($this->security->xss_clean($user->khojeko_username));
//        $user->email            = html_escape($this->security->xss_clean($user->email));
//        if ($type == "dealer") {
//            $user->name             = html_escape($this->security->xss_clean($user->name));
//            $user->zone             = html_escape($this->security->xss_clean($user->zone));
//            $user->district         = html_escape($this->security->xss_clean($user->district));
//            $user->city             = html_escape($this->security->xss_clean($user->city));
//            $user->full_address     = html_escape($this->security->xss_clean($user->full_address));
//            $user->primary_mob      = html_escape($this->security->xss_clean($user->primary_mob));
//            $user->tel_no           = html_escape($this->security->xss_clean($user->tel_no));
//            $user->detail           = html_escape($this->security->xss_clean($user->detail));
//            $user->logo             = html_escape($this->security->xss_clean($user->logo));
//            $user->document         = html_escape($this->security->xss_clean($user->document));
//            $user->company_website  = html_escape($this->security->xss_clean($user->company_website));
//        } else if($type == "personal") {
//            $user->name             = html_escape($this->security->xss_clean($user->name));
//            $user->zone             = html_escape($this->security->xss_clean($user->zone));
//            $user->district         = html_escape($this->security->xss_clean($user->district));
//            $user->city             = html_escape($this->security->xss_clean($user->city));
//            $user->full_address     = html_escape($this->security->xss_clean($user->full_address));
//            $user->primary_mob      = html_escape($this->security->xss_clean($user->primary_mob));
//            $user->secondary_mob    = html_escape($this->security->xss_clean($user->secondary_mob));
//            $user->tel_no           = html_escape($this->security->xss_clean($user->tel_no));
//        } else if($type == "admin") {
//            $user->a_id             = html_escape($this->security->xss_clean($user->a_id));
//            $user->admin_name       = html_escape($this->security->xss_clean($user->admin_name));
//            $user->address          = html_escape($this->security->xss_clean($user->address));
//            $user->mob              = html_escape($this->security->xss_clean($user->mob));
//            $user->avatar           = html_escape($this->security->xss_clean($user->avatar));
//        }
//        return $user;
//    }

    public function available_username_admin(){
        $query = $this->db->get_where('user', ['khojeko_username' => $this->input->post('username')]);
        echo $query->num_rows();
    }

    public function available_email_admin(){
        $query = $this->db->get_where('user', ['email' => $this->input->post('email')]);
        echo $query->num_rows();
    }

//    public function available_mobile_admin(){
//        $query = $this->db->get_where('personal', ['primary_mob' => $this->input->post('mobile1')]);
//        echo $query->num_rows();
//    }
//
//    public function can_login($username){
//        $password = $this->input->post('password');
//
//        $this->db->select('khojeko_username, password')->from('user');
//        $this->db->join('personal', "user.user_key = personal.p_id");
//        $where = "type='personal' AND (email = '".$username."' OR primary_mob = '".$username."')";
//        $this->db->where($where);
//        $query_p = $this->db->get();
//        $row_p = $query_p->row();
//        if ($query_p->num_rows() == 1){
//            $khojeko_username = $row_p->khojeko_username;
//            $db_password = $row_p->password;
//        }
//
//        $this->db->select('khojeko_username , password')->from('user');
//        $this->db->join('dealer', "user.user_key = dealer.d_id");
//        $where = "type='dealer' AND (email = '".$username."' OR primary_mob = '".$username."')";
//        $this->db->where($where);
//        $query_d = $this->db->get();
//        $row_d = $query_d->row();
//        if ($query_d->num_rows() == 1){
//            $khojeko_username = $row_d->khojeko_username;
//            $db_password = $row_d->password;
//        }
//
//        if ($query_p->num_rows() == 1 || $query_d->num_rows() ==1) {
//            if(password_verify($password, $db_password)) {
//                return $khojeko_username;
//            } else {
//                return null;
//            }
//        }
//    }
//
//    public function user_verification($username){
//        $data = array(
//            'khojeko_username' => $username,
//            'u_verified' => 1
//        );
//        $info = $this->db->get_where('user', $data);
//        if ($info->num_rows() == 1) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    public function check_email(){
//        $query = $this->db->get_where('user', array('email' => $this->input->post('useremail')));
//        if($query->num_rows() == 1)
//            return true;
//        else
//            return false;
//    }
//
//    public function new_password(){
//        $this->db->where('email',$this->input->post('user_email'));
//        $this->db->update('user', array('password' => password_hash($this->input->post('n_password'), PASSWORD_DEFAULT)));
//        $this->session->set_flashdata('password_changed','<div class="alert alert-success">Your password has been changed. Please login to continue.</div>');
//    }

}