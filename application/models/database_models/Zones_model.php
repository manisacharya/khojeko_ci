<?php

/**
 * Created by PhpStorm.
 * User: manisAlert
 * Date: 10/1/2016
 * Time: 1:20 PM
 */
class Zones_model extends CI_Model
{
    //user table attribute
    public $id;
    public $zone_name;
    
    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_all_zones(){
        $this->db->select('zone_name');
        $query = $this->db->get('zones');
        return $query->result();
    }

}