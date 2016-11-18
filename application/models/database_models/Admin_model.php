<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    public $a_id;
    public $admin_name;
    public $address;
    public $mob;
    public $avatar;
    public $is_primary;

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->a_id = $this->input->post('a_id');
            $this->admin_name = $this->input->post('admin_name');
            $this->address = $this->input->post('address');
            $this->mob = $this->input->post('mob');
            $this->avatar = $this->input->post('avatar');
            $this->is_primary = $this->input->post('is_primary');
            return TRUE;
        }
        return FALSE;
    }
}