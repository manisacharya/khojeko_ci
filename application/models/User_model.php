<?php
class User_model extends CI_Model {

    //check user table to login
    public function can_login($username){
        $password = $this->input->post('password');

        $this->db->select('khojeko_username, password')->from('user');
        $this->db->join('personal', "user.user_key = personal.p_id");
        $where = "type='personal' AND (email = '".$username."' OR primary_mob = '".$username."')";
        $this->db->where($where);
        $query_p = $this->db->get();
        $row_p = $query_p->row();
        if ($query_p->num_rows() == 1){
            $khojeko_username = $row_p->khojeko_username;
            $db_password = $row_p->password;
        }

        $this->db->select('khojeko_username , password')->from('user');
        $this->db->join('dealer', "user.user_key = dealer.d_id");
        $where = "type='dealer' AND (email = '".$username."' OR primary_mob = '".$username."')";
        $this->db->where($where);
        $query_d = $this->db->get();
        $row_d = $query_d->row();
        if ($query_d->num_rows() == 1){
            $khojeko_username = $row_d->khojeko_username;
            $db_password = $row_d->password;
        }

        if ($query_p->num_rows() == 1 || $query_d->num_rows() ==1) {
            if(password_verify($password, $db_password)) {
                return $khojeko_username;
            } else {
                return null;
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
}