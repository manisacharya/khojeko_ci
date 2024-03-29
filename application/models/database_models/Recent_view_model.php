<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Recent_view_model extends CI_Model {
    public $item_id;
    public $user_id;
    public $viewed_date;

    public function get_recent_view($user_id) {
        if ($this->db->table_exists('recent_view')) {
            $this->db->order_by('rv_id', 'DESC');
            $this->db->join('items', 'items.item_id=recent_view.item_id');
            $this->db->join('item_img', 'item_img.item_id = items.item_id');
            $this->db->join('user', 'user.user_id = items.user_id');
            $this->db->where('primary', 1);
            $this->db->where('deleted_date', 0);
            $this->db->where('recent_view.user_id', $user_id);
            $query = $this->db->get('recent_view', 8); // limit 8

            $result = $query->result();
            return $result;
        } else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function insert_recent_view($item_id, $user_id) {
        if ($this->db->table_exists('recent_view')) {
            $this->item_id      = $item_id;
            $this->user_id      = $user_id;
            $this->viewed_date  = NOW();

            $this->db->insert('recent_view', $this);
            return TRUE;
        }
        return FALSE;
    }
}