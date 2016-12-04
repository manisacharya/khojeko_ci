<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Items_model extends CI_Model {
    public $item_id;
    public $title;
    public $item_type;
    public $bought_from;
    public $price;
    public $quantity;
    public $used_for;
    public $mkt_price;
    public $verification_number;
    public $isVerified;
    public $avaibility_address;
    public $published_date;
    public $delivery;
    public $delivery_charge;
    public $warranty_period;
    public $sales_status;
    public $ad_duration;
    public $views;
    public $visibility;
    public $video_url1;
    public $video_url2;
    public $deleted_date;
    public $c_id;
    public $user_id;
    public $ad_id;
    public $is_premium;
    public $comment_count;
    public $spam_count;

    function __Construct() {
        parent::__Construct ();
        $this->load->model('database_models/categories_model');
    }
    public function get_dealer_items($dealer) {
        if ($this->db->table_exists('items')) {
            $this->db = $this->item_joins();
            $this->db->join('dealer', 'user.user_key = dealer.d_id');

            $this->db->where('type', 'dealer');
            $this->db->where('khojeko_username', $dealer);
            $query = $this->db->get('items');
            $cleaned = $this->items_xss_clean($query->result(), 'dealer');
            return $cleaned;
        }
        return FALSE;
    }

    public function get_personal_items($personal) {
        if ($this->db->table_exists('items')) {
            $this->db = $this->item_joins();
            $this->db->join('personal', 'user.user_key = personal.p_id');

            $this->db->where('type', 'personal');
            $this->db->where('khojeko_username', $personal);
            $query = $this->db->get('items');
            $cleaned = $this->items_xss_clean($query->result(), 'personal');
            return $cleaned;
        }
        return FALSE;
    }

    public function get_filtered_items($cid){
        $this->db->select('title', 'c_id');
        $this->db->where('deleted_date', 0);
        $this->db->where('primary', 1);
        $this->db->where('items.c_id', $cid);

        $this->db->join('item_img', 'item_img.item_id = items.item_id');
        $this->db->join('item_spec', 'item_spec.item_id = items.item_id');
        $this->db->join('category', 'category.c_id = items.c_id');
        $this->db->join('user', 'user.user_id = items.user_id');

        $query = $this->db->get('items');
        return $query->result();
    }
//    public function get_filtered_items(){
//        if ($this->db->table_exists('items')) {
//            $this->db->where('deleted_date', 0);
//            $this->db->where('primary', 1);
//            $this->db->join('items', 'items.c_id = category.c_id');
//            $this->db->join('item_img', 'item_img.item_id = items.item_id');
//            $this->db->join('item_spec', 'item_spec.item_id = items.item_id');
//           // $this->db->join('category', 'category.c_id = items.c_id');
//            $this->db->join('user', 'user.user_id = items.user_id');
//
//            $categories = $this->categories_model->get_position();
//            $item_category = array();
//            $i=0;
//            foreach($categories as $c):
//                $this->db->where('c_id', $c->c_id);
//                $query = $this->db->get('items');
//
//                $item_category[$i++] = $this->items_xss_clean($query->result(), 'items');
//            endforeach;
//
//            return $item_category;
//        }
//        return FALSE;
//    }

    public function item_joins() {
        $this->db->where('deleted_date', 0);
        $this->db->where('primary', 1);
        $this->db->join('item_img', 'item_img.item_id = items.item_id');
        $this->db->join('item_spec', 'item_spec.item_id = items.item_id');
        $this->db->join('category', 'category.c_id = items.c_id');
        $this->db->join('user', 'user.user_id = items.user_id');
        return $this->db;
    }

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->item_id = $this->input->post('yeho');
            $this->title = $this->input->post('');
            $this->item_type = $this->input->post('');
            $this->bought_from = $this->input->post('');
            $this->price = $this->input->post('');
            $this->quantity = $this->input->post('');
            $this->used_for = $this->input->post('');
            $this->mkt_price = $this->input->post('');
            $this->verification_number = $this->input->post('');
            $this->isVerified = $this->input->post('');
            $this->avaibility_address = $this->input->post('');
            $this->published_date = $this->input->post('');
            $this->delivery = $this->input->post('');
            $this->delivery_charge = $this->input->post('');
            $this->warranty_period = $this->input->post('');
            $this->sales_status = $this->input->post('');
            $this->ad_duration = $this->input->post('');
            $this->views = $this->input->post('');
            $this->visibility = $this->input->post('');
            $this->video_url1 = $this->input->post('');
            $this->video_url2 = $this->input->post('');
            $this->deleted_date = $this->input->post('');
            $this->c_id = $this->input->post('');
            $this->user_id = $this->input->post('');
            $this->ad_id = $this->input->post('');
            $this->is_premium = $this->input->post('');
            $this->comment_count = $this->input->post('');
            $this->spam_count = $this->input->post('');
            return TRUE;
        }
        return FALSE;
    }

    public function count_items($user_id = 'all') {
        if($user_id != 'all') {
            $this->db->where('user_id', $user_id);
        }
        $this->db->where('deleted_date', 0);
        return $this->db->count_all_results('items');
    }

    public function count_status_items($item_type) { // used or new
        $this->db->where('item_type', $item_type);
        $this->db->where('deleted_date', 0);
        return $this->db->count_all_results('items');
    }

    public function count_user_items($type) {
        $this->db->where('type', $type);
        $this->db->where('deleted_date', 0);
        $this->db->join('user', 'user.user_id = items.user_id');
        return $this->db->count_all_results('items');
    }

    public function count_deleted_items($user_id) {
        $this->db->where('deleted_date != ', 0);
        $this->db->where('user_id', $user_id);
        return $this->db->count_all_results('items');
    }

    public function count_sales_items($user_id, $sales_status) {
        $this->db->where('sales_status', $sales_status);
        $this->db->where('user_id', $user_id);
        $this->db->where('deleted_date', 0);
        return $this->db->count_all_results('items');
    }

    public function count_visibility_items($user_id) {
        $this->db->where('visibility', 1);
        $this->db->where('user_id', $user_id);
        $this->db->where('deleted_date', 0);
        return $this->db->count_all_results('items');
    }

    public function count_user_page_items() {
        $session_data = $this->session->userdata('logged_in');
        $session_id = $session_data['id'];

        $this->load->model('database_models/spam_model');
        $data = array(
            'spam_reports' => $this->spam_model->count_spam_of_user($session_id),
            'total_items' => $this->count_items($session_id),
            'deleted_items' => $this->count_deleted_items($session_id),
            'sold_items' => $this->count_sales_items($session_id, 0),
            'active_items' => $this->count_visibility_items($session_id)
            /*'expired_items' => $this->count_expired_items($session_id)
            'alert_message'
            'admin_message'*/
        );

        return (object)$data;
    }

    public function extend_date($item_id, $extend){
        $extended_date = $this->input->post('extended_date');
        $days = $extend + $extended_date;
        $this->db->update('items', array('ad_duration' => $days), "item_id=".$item_id);
        $this->session->set_flashdata('message', '<div class="alert alert-success">'.$extended_date.' Days Extended Successfully</div>');
    }

    public function sold_unsold($item_id, $sales_status){
        if($sales_status) {
            $this->db->update('items', array('sales_status' => 0), "item_id=".$item_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Item checked for Sold</div>');
        }
        else {
            $this->db->update('items', array('sales_status' => 1), "item_id=".$item_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Item checked for Unsold</div>');
        }
    }

    public function hide_unhide($item_id, $visibility){
        if($visibility) {
            $this->db->update('items', array('visibility' => 0), "item_id=".$item_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Item Hidden</div>');
        }
        else {
            $this->db->update('items', array('visibility' => 1), "item_id=".$item_id);
            $this->session->set_flashdata('message', '<div class="alert alert-success">Item checked for Active</div>');
        }
    }

    public function delete() {
        $this->db->update('items', array('deleted_date' => NOW()), "item_id=".$this->input->post('item_id'));
        $this->session->set_flashdata('message', '<div class="alert alert-success">Item Deleted</div>');
    }

    public function premium($id, $premium){
        if($premium)
            $this->db->update('items', array('is_premium' => 0), "item_id=".$id);
        else
            $this->db->update('items', array('is_premium' => 1), "item_id=".$id);
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
            $items->ad_id                   = html_escape($this->security->xss_clean($items->ad_id));
            $items->specs                   = html_escape($this->security->xss_clean($items->specs));
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