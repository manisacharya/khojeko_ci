<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_img_model extends CI_Model {
    public $image_id;
    public $image_name;
    public $item_id;
    public $primary;

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->image_id = $this->input->post('image_id');
            $this->image_name = $this->input->post('image_name');
            $this->item_id = $this->input->post('item_id');
            $this->primary = $this->input->post('primary');
            return TRUE;
        }
        return FALSE;
    }
}