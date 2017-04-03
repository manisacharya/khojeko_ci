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

    public function add_img($img_data){

        $this->db->insert_batch('item_img', $img_data);
    }

    //from detail_db_model
    //show details of item images table
    public function get_details_img($id){

        $info = $this->db->get_where('item_img', array('item_id' => $id));

        //$row = $info->row();
        return $info;
    }
}