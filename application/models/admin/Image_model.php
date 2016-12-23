<?php

/**
 * Created by PhpStorm.
 * User: manisAlert
 * Date: 10/1/2016
 * Time: 1:20 PM
 */
class Image_model extends CI_Model
{
    //item_img table attribute
    public $image_id;
    public $image;
    public $item_id;
    public $primary;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function add_img($img_data){

        $this->db->insert_batch('item_img', $img_data);        
    }
}