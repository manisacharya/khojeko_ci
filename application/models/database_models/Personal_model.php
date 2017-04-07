<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal_model extends CI_Model {
    public $p_id;
    public $name;
    public $zone;
    public $district;
    public $city;
    public $full_address;
    public $primary_mob;
    public $secondary_mob;
    public $tel_no;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('database_models/user_model');
    }

    //dummy
    public function insert_personal() {
        if ($this->db->table_exists('dealer')) {
            $this->p_id = $this->input->post('d_id');
            $this->name = $this->input->post('name');
            $this->zone = $this->input->post('zone');
            $this->district = $this->input->post('district');
            $this->city = $this->input->post('city');
            $this->full_address = $this->input->post('full_address');
            $this->primary_mob = $this->input->post('primary_mob');
            $this->secondary_mob = $this->input->post('secondary_mob');
            $this->tel_no = $this->input->post('tel_no');

            return TRUE;
        }
        return FALSE;
    }


    //admin portion
    public function add_personal(){
        if ($this->db->table_exists('personal')) {

            //personal
            $this->name = $this->input->post('owner_name');
            $this->zone = $this->input->post('zone');
            $this->district = $this->input->post('district');
            $this->city = $this->input->post('city');
            $this->full_address = $this->input->post('address');
            $this->primary_mob = $this->input->post('mobile1');
            $this->secondary_mob = $this->input->post('mobile2');
            $this->tel_no = $this->input->post('landline_no');

            if(!$this->check_mobile($this->primary_mob)){
                $this->db->insert('personal', $this);

                $query = $this->db->get_where('personal', array('primary_mob' => $this->primary_mob));
                //$this->db->where('published_date', $this->published_date);

                //$query =  $this->db->get();
                foreach ($query->result() as $row)
                {
                    $this->p_id = $row->p_id;
                }

                $this->user_model->add_user();
            }
        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }

    }

    //from sign_up model
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

    public function available_mobile_admin(){
        $query = $this->db->get_where('personal', ['primary_mob' => $this->input->post('mobile1')]);
        echo $query->num_rows();
    }

    //from sign_up model
    public function available_mobile_P(){
        $query = $this->db->get_where('personal', ['primary_mob' => $this->input->post('mobile_p')]);
        echo $query->num_rows();
    }
}