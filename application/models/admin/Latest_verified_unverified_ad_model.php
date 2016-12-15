<?php

class Latest_verified_unverified_ad_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    //show details of item table
    public function get_details_item($id, $type, $deleted_id, $limit = 1, $offset = 0){

        $this->db->select('*');
//        $this->db->select('*')->from('items');
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

        $query = $this->db->get('items',$limit, $offset);
        return $query;
    }

    public function verify($selected){
        foreach( $selected as $key => $value){
            $this->db->update('items', array('is_verified' => 1), "item_id=".$value);
        }
    }

    public function unverify($selected){
        foreach( $selected as $key => $value){
            $this->db->update('items', array('is_verified' => 0), "item_id=".$value);
        }
    }

    public function extend_date($id, $item_days){
        $extended_date = "extended_date".$id;
        $extend_days = $this->input->post($extended_date);
        $days = $item_days + $extend_days;
        $this->db->update('items', array('ad_duration' => $days), "item_id=".$id);
    }

    public function sold_unsold($id, $sales_status){
        if($sales_status)
            $this->db->update('items', array('sales_status' => 0), "item_id=".$id);
        else
            $this->db->update('items', array('sales_status' => 1), "item_id=".$id);
    }

    public function hide_unhide($id, $visibility){
        if($visibility)
            $this->db->update('items', array('visibility' => 0), "item_id=".$id);
        else
            $this->db->update('items', array('visibility' => 1), "item_id=".$id);
    }

    public function delete($id){
        $this->db->update('items', array('deleted_date' => NOW()), "item_id=".$id);
    }

    public function premium($id, $premium){
        if($premium)
            $this->db->update('items', array('is_premium' => 0), "item_id=".$id);
        else
            $this->db->update('items', array('is_premium' => 1), "item_id=".$id);
    }

    public function total_items($type, $id, $deleted_id){
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
            $query = $this->db->get();

            return $query->num_rows();
        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }
}