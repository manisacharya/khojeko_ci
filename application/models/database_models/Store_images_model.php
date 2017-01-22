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

    public function get_store_images($dealer_id) {
        $this->db->select('si_name');
        $this->db->where('store_images.d_id', $dealer_id);
        $this->db->join('dealer', 'dealer.d_id = store_images.d_id');
        $query = $this->db->get('store_images', 4);
        return $query->result();
    }

    //from sign_up_model
    public function store_front($data){
        $this->db->insert_batch('store_images', $data);
    }
}