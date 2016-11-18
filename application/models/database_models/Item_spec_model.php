<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_spec_model extends CI_Model {
    public $s_id;
    public $specs;
    public $item_id;

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->s_id = $this->input->post('s_id');
            $this->specs = $this->input->post('specs');
            $this->item_id = $this->input->post('item_id');
            return TRUE;
        }
        return FALSE;
    }
}