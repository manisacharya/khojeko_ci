<?php
class User_model extends CI_Model {

    //check user table to login
    public function can_login($username){
        $password = $this->input->post('password');

        $data = array(
            'khojeko_username' => $username,
            'type !=' => 'admin'
        );

        $info = $this->db->get_where('user', $data);
        $row = $info->row();
        if ($info->num_rows() == 1) {
            if(password_verify($password, $row->password)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function user_verification($username){
        $data = array(
            'khojeko_username' => $username,
            'u_verified' => 1
        );
        $info = $this->db->get_where('user', $data);
        if ($info->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

}