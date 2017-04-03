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
    public $is_verified;
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
    public $is_premium;
    public $comment_count;
    public $spam_count;

    function __Construct() {
        parent::__Construct ();
        $this->load->model('database_models/categories_model');
        $this->load->model('database_models/item_spec_model');
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

    public function get_dealer_items($dealer, $visibility = FALSE) {
        if ($this->db->table_exists('items')) {
            $this->db->select('items.*, user.*, dealer.*, item_spec.specs, item_img.image, four.c_name AS gg_parent, three.c_name AS g_parent, two.c_name AS parent, one.c_name AS category');
            $this->db = $this->item_joins();
            $this->db->join('dealer', 'user.user_key = dealer.d_id');

            if($visibility)
                $this->db->where('visibility', 1); // user can set hide/unhide advertisement. | user panel and user page difference
            $this->db->where('type', 'dealer');
            $this->db->where('khojeko_username', $dealer);
            $this->db->order_by('item_id', 'DESC');
            $query = $this->db->get('items');
            $cleaned = $this->items_xss_clean($query->result(), 'dealer');
            return $cleaned;
        }
        return FALSE;
    }

    public function get_personal_items($personal, $visibility = FALSE) {
        if ($this->db->table_exists('items')) {
            $this->db->select('items.*, user.*, personal.*, item_spec.specs, item_img.image, four.c_name AS gg_parent, three.c_name AS g_parent, two.c_name AS parent, one.c_name AS category');
            $this->db = $this->item_joins();
            $this->db->join('personal', 'user.user_key = personal.p_id');

            if($visibility)
                $this->db->where('visibility', 1);
            $this->db->where('type', 'personal');
            $this->db->where('khojeko_username', $personal);
            $this->db->order_by('item_id', 'DESC');
            $query = $this->db->get('items');
            $cleaned = $this->items_xss_clean($query->result(), 'personal');
            return $cleaned;
        }
        return FALSE;
    }

    public function count_user_page_items() {
        $session_data = $this->session->userdata('logged_in');
        $session_id = $session_data['id'];

        $this->load->model('database_models/spam_model');
        $this->load->model('database_models/favourites_model');

        $data = array(
            'spam_reports'      => $this->spam_model->count_spam_of_user($session_id),
            'total_items'       => $this->count_items($session_id),
            'deleted_items'     => $this->count_deleted_items($session_id),
            'sold_items'        => $this->count_sales_items($session_id, 0),
            'active_items'      => $this->count_visibility_items($session_id),
            'favourited_items'  => $this->favourites_model->count_favourites($session_id)
        );

        return (object)$data;
    }

    public function add_item($detail){
        if ($this->db->table_exists('items')) {

            $this->title = $this->input->post('ad_title');

            if ($detail->type == "personal"){
                $this->item_type = $this->input->post('ad_type_personal');
                $this->quantity = 1;
            }
            else if($detail->type == "dealer") {
                $this->item_type = $this->input->post('ad_type_dealer');
                $this->quantity = $this->input->post('quantity_dealer');
            }

            if($this->input->post('bought_from') == "Abroad")
                $this->bought_from = $this->input->post('abroad_country');
            else
                $this->bought_from = $this->input->post('bought_from');

            $this->price = $this->input->post('offer');

            $used_for = $this->input->post('used_for_text') . " " . $this->input->post('used_for_time');
            $this->used_for = $used_for;

            $this->mkt_price = $this->input->post('market_price');
            $this->verification_number = $this->input->post('document_no');

            $this->is_verified = 0;

            $this->avaibility_address = $detail->full_address;

            $this->published_date = NOW();

            $this->ad_duration = $this->input->post('ad_running_time');

            $this->delivery = $this->input->post('home_delivery');

            if($this->delivery == 1) {
                $this->delivery_charge = $this->input->post('delivery_charge');
            } else {
                $this->delivery_charge = 0;
            }

            $this->warranty_period = $this->input->post('warranty');

            $this->sales_status = 1;

            $this->views = 0;

            // check if user is verified and is user blocked
//            if($detail->u_verified == 1 && $detail->user_status == 1) {
            $this->visibility = 1;
//            } else {
//                $this->visibility = 0;
//            }

            $this->video_url1 = $this->video_explode($this->input->post("video1_url"));
            $this->video_url2 = $this->video_explode($this->input->post("video2_url"));

            $this->deleted_date = 0;

            $this->c_id = $this->categories_model->get_cid_c_slug($this->input->post('postc_slug'));;

            $this->user_id = $detail->user_id;

            $this->is_premium = 0;
            $this->comment_count = 0;
            $this->spam_count = 0;

            if($this->title!=NULL)
                $this->db->insert('items', $this);

            $q = $this->db->get_where('items', array('published_date' => $this->published_date));

            foreach ($q->result() as $row)
            {
                $this->item_id = $row->item_id;
            }

            //$this->add_img($filename_arr);
            $this->item_spec_model->add_spec();
            // echo $this->item_id;

        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }

    public function get_item_id(){

        return $this->item_id;
    }

    ///
    public function get_ad_name(){

        return $this->title;
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
            $items->specs                   = html_escape($this->security->xss_clean($items->specs));
            $items->gg_parent               = html_escape($this->security->xss_clean($items->gg_parent));
            $items->g_parent                = html_escape($this->security->xss_clean($items->g_parent));
            $items->parent                  = html_escape($this->security->xss_clean($items->parent));
            $items->category                = html_escape($this->security->xss_clean($items->category));
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

    public function video_explode($video_url){
        $action = explode('=', $video_url);
        foreach ($action as $value) {
            $data = $value;
        }
        return $data;
    }

    public function item_joins() {
        $this->db->where('deleted_date', 0);
        $this->db->where('primary', 1);
        $this->db->join('item_img', 'item_img.item_id = items.item_id');
        $this->db->join('item_spec', 'item_spec.item_id = items.item_id');
        $this->db->join('user', 'user.user_id = items.user_id');

        $this->db->join('category AS one', 'one.c_id = items.c_id');
        $this->db->join('category AS two', 'one.parent_id = two.c_id', 'LEFT');
        $this->db->join('category AS three', 'two.parent_id = three.c_id', 'LEFT');
        $this->db->join('category AS four', 'three.parent_id = four.c_id', 'LEFT');
        return $this->db;
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

    //further added functions till admin sections from detail_db_model
    public function update_counter($id){
        // return current article views
        $info = $this->db->get_where('items', array('item_id' => urldecode($id)));

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

    //added from detail_db_model
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
        $items->is_premium              = html_escape($this->security->xss_clean($items->is_premium));
        $items->comment_count           = html_escape($this->security->xss_clean($items->comment_count));
        $items->spam_count              = html_escape($this->security->xss_clean($items->spam_count));
//        }
//        unset($items);

        return $items;
    }

    ///admin section
    public function add_item_admin(){
        $this->load->model('database_models/user_model');
        $this->load->model('database_models/document_model');

        if ($this->db->table_exists('items')) {

            $this->title = $this->input->post('ad_title');
            $this->item_type = $this->input->post('ad_type');
            $this->quantity = 1;

            if($this->input->post('bought_from') == "Abroad")
                $this->bought_from = $this->input->post('abroad_country');
            else
                $this->bought_from = $this->input->post('bought_from');

            $this->price = $this->input->post('offer');

            $used_for = $this->input->post('used_for_text') . " " . $this->input->post('used_for_time');
            $this->used_for = $used_for;

            $this->mkt_price = $this->input->post('market_price');
            $this->verification_number = $this->input->post('document_no');

            $this->is_verified = 0;     //what to do
            $this->avaibility_address = $this->input->post('address');  //what to do

            $this->published_date = NOW();

            $this->ad_duration = $this->input->post('ad_running_time');

            $this->delivery = $this->input->post('home_delivery');

            if($this->delivery == "yes") {
                $this->delivery_charge = $this->input->post('delivery_charge');
            } else {
                $this->delivery_charge = 0;
            }

            $this->warranty_period = $this->input->post('warranty');

            $this->sales_status = 1;
            //$this->xss_invoke('ad_duration', 'ad_running_time');

            $this->sales_status = 1;

            $this->views = 0;

            //what to set visibility?
            $this->visibility = 1;

            $this->video_url1 = $this->video_explode($this->input->post("video1_url"));
            $this->video_url2 = $this->video_explode($this->input->post("video2_url"));

            $this->deleted_date = 0;

            $this->c_id = $this->input->post('parent_id');

            $this->c_id = $this->categories_model->get_cid_c_slug($this->input->post('postc_slug'));;

            $this->user_id = $this->user_model->get_user_id();

            $this->is_premium = 0;
            $this->comment_count = 0;
            $this->spam_count = 0;

            // if($this->title!=NULL)
            $this->db->insert('items', $this);

            //echo $this->db->_insert();
            //$this->db->select('item_id');
            //$this->db->from('items');
            $q = $this->db->get_where('items', array('published_date' => $this->published_date));
            //$this->db->where('published_date', $this->published_date);

            //$query =  $this->db->get();
            foreach ($q->result() as $row)
            {
                $this->item_id = $row->item_id;
            }

            //$this->add_img($filename_arr);
            $this->item_spec_model->add_spec();
            // $this->document_model->add_doc();

            // echo $this->item_id;

        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }

    public function get_item_name(){

        return $this->title;
    }

}