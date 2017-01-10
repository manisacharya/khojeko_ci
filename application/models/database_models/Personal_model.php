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
}