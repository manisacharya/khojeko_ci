<?php

class Search_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function search_items() {
        $district = $this->input->get('district');
        $search_query = $this->input->get('search');

        if ($this->db->table_exists('items')) {
            $this->db->like('title', $search_query);
            $this->db->where('deleted_date', 0);
            $this->db->join('item_img', 'item_img.item_id = items.item_id');
            $this->db->join('item_spec', 'item_spec.item_id = items.item_id');
            $this->db->join('category', 'category.c_id = items.c_id');

            $query = $this->db->get('items');
            return $query->result();

        } else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function search_personals() {
        $district = $this->input->get('district');
        $search_query = $this->input->get('search');

        if ($this->db->table_exists('user')) {
            $this->db->like('name', $search_query);
            $this->db->where('type', 'personal');
            //$this->db->where('district', $district);
            $this->db->join('personal', 'user.user_key=personal.p_id');

            $query = $this->db->get('user');
            return $query->result();
        } else {
            echo show_error('We have encountered a problem !');
        }
    }
    public function search_dealers() {
        $district = $this->input->get('district');
        $search_query = $this->input->get('search');

        if ($this->db->table_exists('user')) {
            $this->db->like('name', $search_query);
            $this->db->where('type', 'dealer');
            //$this->db->where('district', $district);
            $this->db->join('dealer', 'user.user_key=dealer.d_id');

            $query = $this->db->get('user');
            return $query->result();
        } else {
            echo show_error('We have encountered a problem !');
        }
    }
}