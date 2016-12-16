<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retailer_partners_model extends CI_Model {
    public $id;
    public $name;
    public $image;

    public function get_retailer_partners(){
        $query = $this->db->get('retailer_partners');
        return $query;
    }
}