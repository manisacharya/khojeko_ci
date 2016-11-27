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

    public function count_spam_of_user($user_id) {
        $this->db->where('items.user_id', $user_id);
        $this->db->join('items', 'items.item_id = spam.item_id');
        return $this->db->count_all_results('spam');
    }
}