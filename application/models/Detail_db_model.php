<?php

class Detail_db_model extends CI_Model{

    function getAll($table, $orderby, $order) {
        $this->db->select('*')->from($table)->order_by($orderby, $order);
        //$this->db
        $query = $this->db->get();
        return $query->result();
    }

    public function update_counter($id){
        // return current article views
        $info = $this->get_sql('items','item_id',urldecode($id));
        $row = $info->row();

        $views = $row->views + 1;
        $this->db->update('items', array('views' => $views), "item_id=".urldecode($id));
    }

    //show details of item table
    public function get_details_item($id){
        $this->db->select('items.*, item_spec.specs, four.c_name AS gg_parent, three.c_name AS g_parent, two.c_name AS parent, one.c_name AS category');
        $this->db->where('items.item_id', $id);
        $this->db->join('item_spec', 'items.item_id = item_spec.item_id');

        $this->db->join('category AS one', 'one.c_id = items.c_id');
        $this->db->join('category AS two', 'one.parent_id = two.c_id', 'LEFT');
        $this->db->join('category AS three', 'two.parent_id = three.c_id', 'LEFT');
        $this->db->join('category AS four', 'three.parent_id = four.c_id', 'LEFT');
        $info = $this->db->get('items');
        if($info->row() ==  NULL)
            show_error('Sorry, page broken.');
        $row = $this->item_xss_clean($info->row());
        return $row;
    }

    //show details of item specification table
    public function get_details_specs($id){
        $info = $this->get_sql('item_spec','item_id',$id);
        $row = $this->item_spec_xss_clean($info->row());
        return $row;
    }

    //show details of item images table
    public function get_details_img($id){
        $info = $this->get_sql('item_img','item_id',$id);

        //$row = $info->row();
        return $info;
    }

    //show details of user table
    public function get_details_user($details){
        $info = $this->get_sql('user','user_id',$details->user_id);
        $row = $this->user_xss_clean($info->row());
        return $row;
    }

    //show details of dealer or personal table
    public function get_details_dealer($user){
        $user_type = $user->type;
        if(strtoupper("$user_type") == "DEALER")
            $user_id = "d_id";
        else
            $user_id = "p_id";

        $info = $this->get_sql($user_type, $user_id, $user->user_key);
        $row = $this->user_type_xss_clean($info->row(), $user_id);
        return $row;
    }

    //get the number of days after item published
    public function get_date_diff($details){
        //default_timezone_set in config.php
        $datestring = '%d %M %Y';
        $published_date = mdate($datestring, $details->published_date);
        $current_time = mdate($datestring, time());

        $p = date_create($published_date);
        $c = date_create($current_time);
        $days = date_diff($p,$c);
        return $days;
    }

    //function to get id for session
    public function get_id_session($username){
        $info = $this->get_sql('user','khojeko_username',$username);
        $row = $info->row();
        $id = 'user_id';
        $id = $row->$id;
        return $id;
    }

    //function to get user type for session
    public function get_type_session($username){
        $info = $this->get_sql('user','khojeko_username',$username);
        $row = $info->row();
        $id = 'type';
        $id = $row->$id;
        return $id;
    }

    //query to get information about the given table with given condition
    public function get_sql($table, $attribute, $data){
        //$table is the table name and array specifies the contition of the querys
        $info = $this->db->get_where($table, array($attribute => $data));

        return $info;
    }

    public function item_xss_clean($items) {
//        foreach ($array as &$items) {
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
        $items->published_date          = html_escape($this->security->xss_clean($items->published_date));
        $items->delivery                = html_escape($this->security->xss_clean($items->delivery));
        $items->delivery_charge         = html_escape($this->security->xss_clean($items->delivery_charge));
        $items->warranty_period         = html_escape($this->security->xss_clean($items->warranty_period));
        $items->sales_status            = html_escape($this->security->xss_clean($items->sales_status));
        $items->ad_duration             = html_escape($this->security->xss_clean($items->ad_duration));
        $items->views                   = html_escape($this->security->xss_clean($items->views));
        $items->visibility              = html_escape($this->security->xss_clean($items->visibility));
        $items->video_url1	            = html_escape($this->security->xss_clean($items->video_url1));
        $items->video_url2              = html_escape($this->security->xss_clean($items->video_url2));
        $items->deleted_date            = html_escape($this->security->xss_clean($items->deleted_date));
        $items->c_id                    = html_escape($this->security->xss_clean($items->c_id));
        $items->user_id                 = html_escape($this->security->xss_clean($items->user_id));
        $items->ad_id                   = html_escape($this->security->xss_clean($items->ad_id));
        $items->is_premium              = html_escape($this->security->xss_clean($items->is_premium));
        $items->comment_count           = html_escape($this->security->xss_clean($items->comment_count));
        $items->spam_count              = html_escape($this->security->xss_clean($items->spam_count));
//        }
//        unset($items);

        return $items;
    }

    public function item_spec_xss_clean($spec) {
        $spec->specs    = html_escape($this->security->xss_clean($spec->specs));
        $spec->item_id  = html_escape($this->security->xss_clean($spec->item_id));

        return $spec;
    }

    public function user_xss_clean($user) {
        $user->khojeko_username    = html_escape($this->security->xss_clean($user->khojeko_username));
        $user->password            = html_escape($this->security->xss_clean($user->password));
        $user->email               = html_escape($this->security->xss_clean($user->email));
        $user->type                = html_escape($this->security->xss_clean($user->type));
        $user->user_key            = html_escape($this->security->xss_clean($user->user_key));
        $user->ac_created          = html_escape($this->security->xss_clean($user->ac_created));
        $user->u_verified          = html_escape($this->security->xss_clean($user->u_verified));
        $user->verification_key    = html_escape($this->security->xss_clean($user->verification_key));
        $user->m_verified          = html_escape($this->security->xss_clean($user->m_verified));
        $user->user_status              = html_escape($this->security->xss_clean($user->user_status));

        return $user;
    }

    public function user_type_xss_clean($type, $user_id) {
        if($user_id == "d_id"){
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
        } else {
            $type->name             = html_escape($this->security->xss_clean($type->name));
            $type->zone             = html_escape($this->security->xss_clean($type->zone));
            $type->district         = html_escape($this->security->xss_clean($type->district));
            $type->city             = html_escape($this->security->xss_clean($type->city));
            $type->full_address     = html_escape($this->security->xss_clean($type->full_address));
            $type->primary_mob      = html_escape($this->security->xss_clean($type->primary_mob));
            $type->secondary_mob    = html_escape($this->security->xss_clean($type->secondary_mob));
            $type->tel_no           = html_escape($this->security->xss_clean($type->tel_no));
        }

        return $type;
    }
}