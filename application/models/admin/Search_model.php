<?php

class Search_model extends CI_Model {
    public function search_active_inactive($id, $type, $deleted_id, $search_query, $limit = 1, $offset = 0){
        $this->db->select('*');
        $this->db->join('user', "items.user_id = user.user_id");

        if($type==='dealer')
            $this->db->join('dealer', "user.user_key = dealer.d_id");
        if($type==='personal')
            $this->db->join('personal', "user.user_key = personal.p_id ");

        $this->db->join('item_img', "items.item_id = item_img.item_id");
        $where = "type='".$type."' AND primary=1  AND deleted_date".$deleted_id;
        if($deleted_id == "=0")
            $where .= " AND is_verified=".$id;
        $this->db->where($where);
        $this->db->group_start()->like('title', $search_query);
        $this->db->or_like('name', $search_query);
        $this->db->or_like('email', $search_query)->group_end();

        $query = $this->db->get('items',$limit, $offset);
        return $query;
    }

    public function total_items($type, $id, $deleted_id, $search_query){
        if ($this->db->table_exists('items')) {
            $this->db->select('*')->from('items');
            $this->db->join('user', "items.user_id = user.user_id");

            if($type==='dealer')
                $this->db->join('dealer', "user.user_key = dealer.d_id");
            if($type==='personal')
                $this->db->join('personal', "user.user_key = personal.p_id ");

            $this->db->join('item_img', "items.item_id = item_img.item_id");
            $where = "type='".$type."' AND primary=1  AND deleted_date".$deleted_id;
            if($deleted_id == "=0")
                $where .= " AND is_verified=".$id;
            $this->db->where($where);
            $this->db->group_start()->like('title', $search_query);
            $this->db->or_like('name', $search_query);
            $this->db->or_like('email', $search_query)->group_end();
            $query = $this->db->get();

            return $query->num_rows();
        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }
}