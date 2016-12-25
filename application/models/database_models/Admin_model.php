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

    public function register_admin() {
        if ($this->db->table_exists('admin')) {
            $this->a_id         = $this->input->post('a_id');
            $this->admin_name   = $this->input->post('admin_name');
            $this->address      = $this->input->post('address');
            $this->mob          = $this->input->post('mob');
            $this->avatar       = 1;
            $this->db->insert('admin', $this);
            return $this->db->insert_id();
        }
        return 0;
    }
}