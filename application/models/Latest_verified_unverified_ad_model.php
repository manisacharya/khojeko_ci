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

        if($type=='dealer')
            $this->db->join('dealer', "user.user_key = dealer.d_id");
        if($type=='personal')
            $this->db->join('personal', "user.user_key = personal.p_id ");

        $this->db->join('item_img', "items.item_id = item_img.item_id");
        $where = "type='".$type."' AND primary=1  AND deleted_date".$deleted_id;
        if($deleted_id == "=0")
            $where .= " AND is_verified=".$id;
        $this->db->where($where);

        $query = $this->db->get('items',$limit, $offset);
        $cleaned = $this->items_xss_clean($query->result(), $type);
        return $cleaned;

        //return $query;
    }

    public function total_items($type, $id, $deleted_id){
        if ($this->db->table_exists('items')) {
            $this->db->select('items.item_id')->from('items');
            $this->db->join('user', "items.user_id = user.user_id");

            if($type=='dealer')
                $this->db->join('dealer', "user.user_key = dealer.d_id");
            if($type=='personal')
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

    public function search_active_inactive($id, $type, $deleted_id, $search_query, $limit = 1, $offset = 0){
        $this->db->select('*');
        $this->db->join('user', "items.user_id = user.user_id");

        if($type=='dealer')
            $this->db->join('dealer', "user.user_key = dealer.d_id");
        if($type=='personal')
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
        $cleaned = $this->items_xss_clean($query->result(), $type);
        return $cleaned;
    }

    public function total_items_search($type, $id, $deleted_id, $search_query){
        if ($this->db->table_exists('items')) {
            $this->db->select('items.item_id')->from('items');
            $this->db->join('user', "items.user_id = user.user_id");

            if($type=='dealer')
                $this->db->join('dealer', "user.user_key = dealer.d_id");
            if($type=='personal')
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

    public function items_xss_clean($array, $type) {
        foreach ($array as &$items) {
            $items->title                   = html_escape($this->security->xss_clean($items->title));
            $items->item_type               = html_escape($this->security->xss_clean($items->item_type));
            $items->bought_from             = html_escape($this->security->xss_clean($items->bought_from));
            $items->price                   = html_escape($this->security->xss_clean($items->price));
            $items->quantity                = html_escape($this->security->xss_clean($items->quantity));
            $items->used_for                = html_escape($this->security->xss_clean($items->used_for));
            $items->mkt_price               = html_escape($this->security->xss_clean($items->mkt_price));
            $items->verification_number     = html_escape($this->security->xss_clean($items->verification_number));
            $items->is_verified             = html_escape($this->security->xss_clean($items->is_verified));
            $items->avaibility_address      = html_escape($this->security->xss_clean($items->avaibility_address));
            $items->delivery                = html_escape($this->security->xss_clean($items->delivery));
            $items->delivery_charge         = html_escape($this->security->xss_clean($items->delivery_charge));
            $items->warranty_period         = html_escape($this->security->xss_clean($items->warranty_period));
            $items->sales_status            = html_escape($this->security->xss_clean($items->sales_status));
            $items->ad_duration             = html_escape($this->security->xss_clean($items->ad_duration));
            $items->views                   = html_escape($this->security->xss_clean($items->views));
            $items->visibility              = html_escape($this->security->xss_clean($items->visibility));
            $items->video_url1	            = html_escape($this->security->xss_clean($items->video_url1));
            $items->video_url2              = html_escape($this->security->xss_clean($items->video_url2));
            $items->c_id                    = html_escape($this->security->xss_clean($items->c_id));
            $items->user_id                 = html_escape($this->security->xss_clean($items->user_id));
        }
        unset($items);

        return $this->user_xss_clean($array, $type);;
    }

    public function user_xss_clean($array, $type) {
        foreach ($array as &$user) {
            $user->khojeko_username = html_escape($this->security->xss_clean($user->khojeko_username));
            $user->email            = html_escape($this->security->xss_clean($user->email));
        }
        unset($user);

        return $this->user_type_xss_clean($array, $type);
    }

    public function user_type_xss_clean($array, $user) {
        if ($user == "dealer") {
            foreach ($array as &$type) {
                $type->name             = html_escape($this->security->xss_clean($type->name));
                $type->zone             = html_escape($this->security->xss_clean($type->zone));
                $type->district         = html_escape($this->security->xss_clean($type->district));
                $type->city             = html_escape($this->security->xss_clean($type->city));
                $type->full_address     = html_escape($this->security->xss_clean($type->full_address));
                $type->primary_mob      = html_escape($this->security->xss_clean($type->primary_mob));
                $type->tel_no           = html_escape($this->security->xss_clean($type->tel_no));
                $type->detail           = html_escape($this->security->xss_clean($type->detail));
                $type->logo             = html_escape($this->security->xss_clean($type->logo));
                $type->document         = html_escape($this->security->xss_clean($type->document));
                $type->company_website  = html_escape($this->security->xss_clean($type->company_website));
            }
        } else {
            foreach ($array as &$type) {
                $type->name             = html_escape($this->security->xss_clean($type->name));
                $type->zone             = html_escape($this->security->xss_clean($type->zone));
                $type->district         = html_escape($this->security->xss_clean($type->district));
                $type->city             = html_escape($this->security->xss_clean($type->city));
                $type->full_address     = html_escape($this->security->xss_clean($type->full_address));
                $type->primary_mob      = html_escape($this->security->xss_clean($type->primary_mob));
                $type->secondary_mob    = html_escape($this->security->xss_clean($type->secondary_mob));
                $type->tel_no           = html_escape($this->security->xss_clean($type->tel_no));
            }
        }
        unset($type);
        return $array;
    }
}