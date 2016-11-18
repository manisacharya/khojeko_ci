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

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->d_id = $this->input->post('d_id');
            $this->name = $this->input->post('name');
            $this->zone = $this->input->post('zone');
            $this->district = $this->input->post('district');
            $this->city = $this->input->post('city');
            $this->full_address = $this->input->post('full_address');
            $this->primary_mob = $this->input->post('primary_mob');
            $this->tel_no = $this->input->post('tel_no');
            $this->detail = $this->input->post('detail');
            $this->logo = $this->input->post('logo');
            $this->document = $this->input->post('document');
            $this->company_website = $this->input->post('company_website');
            return TRUE;
        }
        return FALSE;
    }
}