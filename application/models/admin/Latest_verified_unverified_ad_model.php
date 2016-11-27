<?php

class Latest_verified_unverified_ad_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    //show details of item table
    public function get_details_item_personal($id){

        $this->db->select('*')->from('items');
        $this->db->join('user', "items.user_id = user.user_id");
        $this->db->join('personal', "user.user_key = personal.p_id ");
        $this->db->join('item_img', "items.item_id = item_img.item_id");
        $where = "type='personal' AND is_verified=".$id." AND deleted_date=0 AND primary=1";
        $this->db->where($where);

        $query = $this->db->get();
        return $query;
    }

    //show details of item table
    public function get_details_item_dealer($id){

        $this->db->select('*')->from('items');
        $this->db->join('user', "items.user_id = user.user_id");
        $this->db->join('dealer', "user.user_key = dealer.d_id");
        $this->db->join('item_img', "items.item_id = item_img.item_id");
        $where = "type='dealer' AND is_verified=".$id." AND deleted_date=0 AND primary=1";
        $this->db->where($where);

        $query = $this->db->get();
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

    public function extend_date($id, $extend){
        $days = $extend + 15;
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
}