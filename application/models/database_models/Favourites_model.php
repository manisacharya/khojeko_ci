<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Favourites_model extends CI_Model {
    public $fav_id;
    public $item_id;
    public $p_id;

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->fav_id = $this->input->post('fav_id');
            $this->item_id = $this->input->post('item_id');
            $this->p_id = $this->input->post('p_id');
            return TRUE;
        }
        return FALSE;
    }
}