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

    public function __construct() {
        parent::__construct();
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