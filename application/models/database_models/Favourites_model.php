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
    public $user_id;

    public function count_favourites($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->count_all_results('favourites');
    }

    public function add_fav($id, $user_id){
        $info = $this->db->get_where('favourites', array('item_id' => $id, 'user_id' => $user_id));

        if(! $info->num_rows()) {
            $data = array(
                'item_id' => $id,
                'user_id' => $user_id
            );

            $this->db->insert('favourites', $data);
            $this->session->set_flashdata('fav_message','<div class="alert alert-success">This item has been added to your favourites.</div>');
        } else {
            $this->session->set_flashdata('fav_message','<div class="alert alert-danger">This item has already been added to your favourites.</div>');
        }
    }
}