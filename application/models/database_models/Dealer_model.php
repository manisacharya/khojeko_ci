<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dealer_model extends CI_Model {
    public $d_id;
    public $name;
    public $zone;
    public $district;
    public $city;
    public $full_address;
    public $primary_mob;
    public $tel_no;
    public $detail;
    public $logo;
    public $document;
    public $company_website;

//    public function insert_dealer() {
//        if ($this->db->table_exists('dealer')) {
//            $this->d_id = $this->input->post('d_id');
//            $this->name = $this->input->post('name');
//            $this->zone = $this->input->post('zone');
//            $this->district = $this->input->post('district');
//            $this->city = $this->input->post('city');
//            $this->full_address = $this->input->post('full_address');
//            $this->primary_mob = $this->input->post('primary_mob');
//            $this->tel_no = $this->input->post('tel_no');
//            $this->detail = $this->input->post('detail');
//            $this->logo = $this->input->post('logo');
//            $this->document = $this->input->post('document');
//            $this->company_website = $this->input->post('company_website');
//            return TRUE;
//        }
//        return FALSE;
//    }

    public function get_all_dealers() {
        $this->db->where('type', 'dealer');
        $this->db->join('user', 'user.user_key = dealer.d_id');
        $query = $this->db->get('dealer', 20);

        return $this->dealer_xss_clean($query->result());
    }

    public function dealer_xss_clean($array) {
        foreach ($array as &$type) {
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
        }
        unset($type);

        return $array;
    }

    //from sign_up_model
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

    //from sign_up model
    public function available_mobile_d(){
        $query = $this->db->get_where('dealer', ['primary_mob' => $this->input->post('mobile_d')]);
        echo $query->num_rows();
    }
}