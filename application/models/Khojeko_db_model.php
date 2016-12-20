<?php
class Khojeko_db_model extends CI_Model {

    function getAllCondition($table, $id) {
        $this->db->select('*')->from($table)->where('sc_id', $id);
        $query = $this->db->get();
        return $query->result();

    }

    public function joinThings($table, $columns, $joins, $where) {
        $this->db->select($columns)->from($table);

        if (is_array($joins) && count($joins) > 0) {
            foreach($joins as $k => $v) {
                $this->db->join($v['table'], $v['condition'], $v['jointype']);
            }
        }

        $this->db->where($where);
        return $this->db->get()->result();
    }

    public function joinThingsOrder($table, $joins, $orderBy) {
        $this->db->distinct();
        $this->db->select('*')->from($table)->order_by($orderBy, 'desc');;

        if (is_array($joins) && count($joins) > 0) {
            foreach ($joins as $k => $v) {
                $this->db->join($v['table'], $v['condition'], $v['jointype']);
            }
        }
        return $this->db->get()->result();
    }

    public function join_tables(){
        $this->join_and_filter();
        $this->db->join('category AS one', 'one.c_id = items.c_id');
        $this->db->join('category AS two', 'one.parent_id = two.c_id', 'LEFT');
        $this->db->join('category AS three', 'two.parent_id = three.c_id', 'LEFT');
        $this->db->join('category AS four', 'three.parent_id = four.c_id', 'LEFT');
        $this->db->select('items.*, user.*, item_spec.specs, item_img.image, four.c_name AS gg_parent, three.c_name AS g_parent, two.c_name AS parent, one.c_name AS category');
        $this->db->order_by('items.item_id', 'desc');

        $query = $this->db->get('items', 8); // limit 4

        return $query->result();
    }

    public function join_filtered_tables($cid){
        $items = array();

        foreach($cid as $key):
            $query = $this->show_child_item($key->c_slug);

            if ($query->num_rows() > 0) {
                $items[$key->c_name] = $query->result();
            }
        endforeach;
        return $items;
    }

    public function join_and_filter(){
        $this->db->join('user', 'items.user_id= user.user_id');
        $this->db->join('item_img', 'items.item_id = item_img.item_id');
        $this->db->join('item_spec', 'items.item_id = item_spec.item_id');

        //$this->db->where('quantity != ', 0);
        $this->db->where('visibility', 1);
        $this->db->where('deleted_date', 0);
        $this->db->where('primary', 1);
    }

    public function show_child_item($category_slug){
        $this->db->select('items.*, user.*, item_spec.specs, item_img.image, four.c_name AS gg_parent, three.c_name AS g_parent, two.c_name AS parent, one.c_name AS category');

        $this->join_and_filter();

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

        $query = $this->db->get('items');
        return $query;
    }

    public function popular_district(){
        $this->db->select("district, SUM(views) as total_district");
        $this->db->group_by('district');
        $this->db->join('personal', 'user.user_key = personal.p_id');
        $this->db->join('items', 'user.user_id= items.user_id');
        $this->db->order_by('total_district', 'desc');

        $query = $this->db->get('user', 14);
        return $query->result();
    }

    public function popular_category(){
        $this->db->select("c_name, SUM(views) as total_category");
        $this->db->group_by('c_name');
        $this->db->join('category', 'items.c_id = category.c_id');
        $this->db->join('user', 'items.user_id = user.user_id');
        $this->db->order_by('total_category', 'desc');

        $query = $this->db->get('items', 14);
        return $query->result();
    }

    public function popular_dealer(){
        $this->db->select("name, SUM(views) as total_dealer");
        $this->db->group_by('name');
        $this->db->join('dealer', 'user.user_key = dealer.d_id');
        $this->db->join('items', 'user.user_id= items.user_id');
        $this->db->order_by('total_dealer', 'desc');

        $query = $this->db->get('user', 14);
        return $query->result();
    }

    public function joinThingsRow($table, $columns, $joins, $where) {
        $this->db->select($columns)->from($table);

        if (is_array($joins) && count($joins) > 0) {
            foreach($joins as $k => $v) {
                $this->db->join($v['table'], $v['condition'], $v['jointype']);
            }
        }
        $this->db->where($where)->limit(1);
        return $this->db->get()->row();
    }

    public function getCount($table, $select, $where) {
        $this->db->select($select)->from($table)->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    public function countArray($array) {
        return count($array);
    }

    public function countSelectedArray($array, $index, $index_value) {
        $count = 0;
        foreach ($array as $key => $value) {
            if ($value->$index == $index_value)
                $count++;
        }
        return $count;
    }
};