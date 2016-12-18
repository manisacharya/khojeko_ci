<?php
class Categories_model extends CI_Model {
    public $c_id;
    public $c_name;
    public $parent_id;
    public $c_deleted;
    public $c_position;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $config = array(
            'table' => 'category',
            'id' => 'c_id',
            'field' => 'c_slug',
            'title' => 'title',
            'replacement' => 'dash' // Either dash or underscore
        );
        $this->load->library('slug', $config);
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
            $this->c_slug       = $this->slug->create_uri($this->c_name);
            $this->parent_id    = $this->input->post('parent_id');
            $this->c_deleted    = 0;
            $this->c_position   = 0;

            $this->db->insert('category', $this);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function edit_category() {
        if ($this->db->table_exists('category')) {
            $this->c_name       = $this->input->post('c_name');
            $this->c_slug       = $this->slug->create_uri($this->c_name);
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
            $category->c_position   = html_escape($this->security->xss_clean($category->c_position));
        }
        unset($category);

        return $array;
    }

    public function get_position(){
        if ($this->db->table_exists('category')) {
            $this->get_categories();
            $this->db->where('c_position !=', 0);
            $query = $this->db->get('category');

            return $query->result();
        } else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function get_one_category($id) {

        $this->db->select('*')->from('category');
        $this->db->where('c_id', $id);
        $query = $this->db->get();
        return $query->row();

    }

    public function retrieve_category($id) {

        $this->db->select('one.c_name AS root, two.c_name AS leaf1, three.c_name AS leaf2, four.c_name AS leaf3');
        $this->db->from('category AS one');
        $this->db->join('category AS two', 'two.parent_id = one.c_id', 'LEFT');
        $this->db->join('category AS three', 'three.parent_id = two.c_id', 'LEFT');
        $this->db->join('category AS four', 'four.parent_id = three.c_id', 'LEFT');
        $this->db->where('one.parent_id', 0);

        $this->db->group_start();
        $this->db->or_where('one.c_id', $id);
        $this->db->or_where('two.c_id', $id);
        $this->db->or_where('three.c_id', $id);
        $this->db->or_where('four.c_id', $id);
        $this->db->group_end();

        $this->db->limit(1);

        $query = $this->db->get();

        return $query->row();

    }

    public function get_cid_c_slug($c_slug) {
        //if ($this->db->table_exists('category')) {
        $this->db->select('c_id');
        $this->db->where('c_slug', $c_slug)->from('category');
        $query = $this->db->get();

        return $query->row()->c_id;
    }

    public function get_sub_categories($parent_slug) {
        if ($this->db->table_exists('category')) {
            $parent_id = $this->categories_model->get_category_id($parent_slug);
            $this->db->where('parent_id', $parent_id->c_id);
            $this->db->where('c_deleted', 0);
            $query = $this->db->get('category');
            return $query->result();
        }
        else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function get_category_id($slug) {
        $this->db->select('c_id');
        $this->db->where('c_slug', $slug);
        $query = $this->db->get('category');
        return $query->row();
    }

    public function get_categories_items($category_slug) {
        if ($this->db->table_exists('category')) {
            $this->db->select('items.title, category.c_name, item_spec.specs, item_img.image,four.c_name AS gg_parent, three.c_name AS g_parent, two.c_name AS parent, one.c_name AS category');

            $this->db->join('items', 'items.c_id = category.c_id');
            $this->db->join('item_spec', 'items.item_id = item_spec.item_id');
            $this->db->join('item_img', 'items.item_id = item_img.item_id');

            $this->db->join('category AS one', 'one.c_id = items.c_id');
            $this->db->join('category AS two', 'one.parent_id = two.c_id', 'LEFT');
            $this->db->join('category AS three', 'two.parent_id = three.c_id', 'LEFT');
            $this->db->join('category AS four', 'three.parent_id = four.c_id', 'LEFT');

            $this->db->group_start();
            $this->db->or_where('one.c_slug', $category_slug);
            $this->db->or_where('two.c_slug', $category_slug);
            $this->db->or_where('three.c_slug', $category_slug);
            $this->db->or_where('four.c_slug', $category_slug);
            $this->db->group_end();

            $this->db->where('primary', 1);
            $this->db->where('deleted_date', 0);
            $this->db->where('visibility', 1);

            $query = $this->db->get('category');
            return $query->result();
        }
        else {
            echo show_error('We have encountered a problem !');
        }
    }
}
