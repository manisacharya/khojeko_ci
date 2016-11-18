<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad_type_model extends CI_Model {
    public $ad_id;
    public $ad_name;

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->ad_id = $this->input->post('ad_id');
            $this->ad_name = $this->input->post('ad_name');
            return TRUE;
        }
        return FALSE;
    }
}