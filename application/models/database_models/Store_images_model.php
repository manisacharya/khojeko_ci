<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_images_model extends CI_Model {
    public $si_id;
    public $si_name;
    public $d_id;

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->si_id = $this->input->post('si_id');
            $this->si_name = $this->input->post('si_name');
            $this->d_id = $this->input->post('d_id');
            return TRUE;
        }
        return FALSE;
    }
}