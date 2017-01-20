<?php

class Signup_model extends CI_Model {

    //add user from sign up login details to temporary file
    public function add_temp_user($key, $username){
        $data = array(
            'email' => $this->input->post('user_email'),
            'khojeko_username' => str_replace(' ', '-', $username),
            'password' =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'type' => $this->input->post('acc_type'),
            'ac_created' => NOW(),
            'u_verified' => 0,
            'verification_key' => $key,
            'user_status' => 1
        );

        $this->db->insert('user', $data);
    }

    //add user from sign up profile:personal details to temporary file
    public function add_temp_personal($email){
        $mobile = $this->input->post('mobile_p');
        $data = array(
            'name' => $this->input->post('full_name'),
            'zone' => $this->input->post('zone_p'),
            'district' => $this->input->post('district_p'),
            'city' => $this->input->post('city_p'),
            'full_address' => $this->input->post('address_p'),
            'primary_mob' => $mobile,
            'secondary_mob' => $this->input->post('sec_mobile'),
            'tel_no' => $this->input->post('telephone_p')
        );
        $this->db->insert('personal', $data);
        //update user table
        $this->update_user('personal', $email, $mobile, 'p_id');
    }

    //generate personal username
    public function personal_username($full_name){
        $random = mt_rand(00000, 99999);
        $username = url_title($full_name.$random);

        $query = $this->db->get_where('user', ['khojeko_username' => $username]);
        if($query->num_rows() == 0 )
            return $username;
        else
            $this->personal_username($full_name);
    }

    //add user from sign up profile:dealer details to temporary file
    public function add_temp_dealer($email, $dealerlogo, $dealerdoc){
        $mobile = $this->input->post('mobile');
        $data = array(
            'name' => $this->input->post('dealer_name'),
            'zone' => $this->input->post('zone'),
            'district' => $this->input->post('district'),
            'city' => $this->input->post('city'),
            'full_address' => $this->input->post('address'),
            'primary_mob' => $mobile,
            'tel_no' => $this->input->post('telephone'),
            'company_website' => $this->input->post('website'),
            'detail' => $this->input->post('profile'),
            'logo' => $dealerlogo,
            'document' => $dealerdoc
        );
        $this->db->insert('dealer', $data);

        //update user table
        $id = $this->update_user('dealer', $email, $mobile, 'd_id');
        return $id;
    }

    public function store_front($data){
        $this->db->insert_batch('store_images', $data);
    }

    //generalised function to update the table temp_user
    public function update_user($table, $email, $mobile, $type){
        $info = $this->db->get_where($table, array('primary_mob' => $mobile));
        $row = $info->row();
        $id = $row->$type;

        //set user_key to temp_user table
        //$this->db->update('temp_user', array('user_key' => $id), "email=".$email);
        $this->db->set(array('user_key' => $id));
        $this->db->where('email', $email);
        $this->db->update('user');

        return $id;
    }

    public function is_key_valid_add_user($key){
        $temp_user = $this->db->get_where('user', array('verification_key' => $key));

        if($temp_user->num_rows() == 1){
            $row = $temp_user->row();

            //$user_key = $row->user_key;
            //$type = $row->type;
            $email = $row->email;

            //update u_verified of user table
            $this->db->set(array('u_verified' => 1, 'verification_key' => null));
            $this->db->where('email', $email);
            $this->db->update('user');

            return true;
        } else {
            return false;
        }
    }

    public function get_all_zones(){
        $this->db->select('zone_name');
        $query = $this->db->get('zones');
        return $query->result();
    }

    public function get_districts(){
        $district_selected = $this->input->post('district_selected');
        $this->db->select('district_name')->from('districts');
        $this->db->join('zones', "districts.zone_id = zones.id");
        $where = "zone_name ='".$this->input->post('zone')."'";
        $this->db->where($where);
        $query = $this->db->get();
        $HTML = "";
        foreach($query->result() as $row) {
            $district_name = $row->district_name;
            if($district_name == $district_selected)
                $HTML.="<option value='".$district_name."' selected>".$district_name."</option>";
            else
                $HTML.="<option value='".$district_name."'>".$district_name."</option>";
        }
        echo $HTML;
    }

    public function available_username(){
        $query = $this->db->get_where('user', ['khojeko_username' => $this->input->post('username')]);
        echo $query->num_rows();
    }

    public function available_email(){
        $query = $this->db->get_where('user', ['email' => $this->input->post('useremail')]);
        echo $query->num_rows();
    }

    public function available_mobile_P(){
        $query = $this->db->get_where('personal', ['primary_mob' => $this->input->post('mobile_p')]);
        echo $query->num_rows();
    }

    public function available_mobile_d(){
        $query = $this->db->get_where('dealer', ['primary_mob' => $this->input->post('mobile_d')]);
        echo $query->num_rows();
    }
}