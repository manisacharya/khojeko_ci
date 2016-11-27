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

    public function count_favourites($user_id) {
        $this->db->where('p_id', $user_id);
        return $this->db->count_all_results('favourites');
    }
}