<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Spam_model extends CI_Model {
    public $spam_id;
    public $item_id;
    public $user_id;

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->spam_id = $this->input->post('spam_id');
            $this->item_id = $this->input->post('item_id');
            $this->user_id = $this->input->post('user_id');
            return TRUE;
        }
        return FALSE;
    }
}