<?php
class Categories_model extends CI_Model {
    public $c_id;
    public $c_name;
    public $parent_id;

    public function __construct() {
         // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_cid($category){
        //if ($this->db->table_exists('category')) {
            $this->db->select('c_id');
            $this->db->where('c_name', $category)->from('category');
            $query = $this->db->get();

            $data['c_id'] = $query->result();
            $this->db->insert('items', $data);
        //} else {
        //  echo show_error('We have encountered a problem !');
        //}
    }

    public function get_categories() {
        if ($this->db->table_exists('category')) {
            $query = $this->db->get('category');
            return $query->result();
        } else {
            echo show_error('We have encountered a problem !');
        }
    }
}
?>