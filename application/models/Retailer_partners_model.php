<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retailer_partners_model extends CI_Model {
    public $id;
    public $name;
    public $image;

    public function get_retailer_partners(){
        $query = $this->db->get('retailer_partners');
        $cleaned = $this->partner_xss_clean($query);
        return $cleaned;
    }

    public function partner_xss_clean($array) {
        foreach ($array->result() as &$partner) {
            $partner->name      = html_escape($this->security->xss_clean($partner->name));
            $partner->image     = html_escape($this->security->xss_clean($partner->image));
        }
        unset($user);
        return $array;
    }
}