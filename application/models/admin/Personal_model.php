<?php

/**
 * Created by PhpStorm.
 * User: manisAlert
 * Date: 10/1/2016
 * Time: 1:20 PM
 */
class Personal_model extends CI_Model
{   
    //personal table attribute
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

    public function available_mobile_admin(){
        $query = $this->db->get_where('personal', ['primary_mob' => $this->input->post('mobile1')]);
        echo $query->num_rows();
    }

    //    public function check_mobile($mob){
//        $this->db->select('*')->from('personal');
//        $this->db->where('primary_mob', $mob);
//        $query = $this->db->get();
//
//        if($query->num_rows() == 1)
//            return true; //found mobile
//        else
//            return false;
//    }
//
//    public function get_p_id(){
//
//        return $this->p_id;
//    }
}