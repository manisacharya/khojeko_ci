<?php
class Categories_model extends CI_Model {
    public $c_id;
    public $c_name;
    public $parent_id;
    public $c_deleted;

    public function __construct() {
         // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_categories() {
        if ($this->db->table_exists('category')) {
            $this->db->order_by('c_name', 'ASC');
            $query = $this->db->get('category');

            // model mai yesari call garne
            $result = $this->object_xss_clean($query->result());
            return $result;
        } else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function add_category() {
        if ($this->db->table_exists('category')) {
            $this->c_name       = $this->input->post('c_name');
            $this->c_slug       = url_title($this->c_name, 'dash', TRUE);
            $this->parent_id    = $this->input->post('parent_id');
            $this->c_deleted    = 0;

            $this->db->insert('category', $this);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_category() {
        if ($this->db->table_exists('category')) {
            $this->c_name       = $this->input->post('c_name');
            $this->c_slug       = url_title($this->c_name, 'dash', TRUE);
            $this->parent_id    = $this->input->post('parent_id');
            $this->c_deleted    = 0;

            $this->c_id         = $this->input->post('c_id');
            $this->db->update('category', $this, array('c_id' => $this->c_id));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_category() {
        if ($this->db->table_exists('category')) {
            $this->c_id         = $this->input->post('c_id');

            $this->db->where('parent_id', $this->c_id);
            $query = $this->db->get('category', 1);
            if ($query->row() != NULL) {
                return FALSE;
            }

            $data = array(
                'c_deleted'    => NOW()
            );


            $this->db->update('category', $data, array('c_id' => $this->c_id));
            //$this->db->delete('category', array('c_name' => $this->input->post('c_name')));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // yo function le xss filer and escaping garcha
    public function object_xss_clean($array) {
        foreach ($array as &$category) {
            $category->c_name       = html_escape($this->security->xss_clean($category->c_name));
            $category->parent_id    = html_escape($this->security->xss_clean($category->parent_id));
            $category->c_slug       = html_escape($this->security->xss_clean($category->c_slug));
            $category->c_deleted    = html_escape($this->security->xss_clean($category->c_deleted));
        }
        unset($category);

        return $array;
    }
}