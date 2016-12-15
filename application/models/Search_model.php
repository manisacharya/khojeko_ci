<?php

class Search_model extends CI_Model {

    public $district;
    public $search_query;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->district = $this->input->get('district');
        $this->search_query = $this->input->get('search');
    }

    public function search_items() {
        if ($this->db->table_exists('items')) {
            $this->db->select('items.*, item_spec.specs, item_img.image, four.c_name AS gg_parent, three.c_name AS g_parent, two.c_name AS parent, one.c_name AS category');

            $this->db->like('title', $this->search_query);
            $this->db->where('deleted_date', 0);
            $this->db->where('primary', 1);
            $this->db->where('visibility', 1);
            $this->db->join('item_img', 'item_img.item_id = items.item_id');
            $this->db->join('item_spec', 'item_spec.item_id = items.item_id');

            $this->db->join('category AS one', 'one.c_id = items.c_id');
            $this->db->join('category AS two', 'one.parent_id = two.c_id', 'LEFT');
            $this->db->join('category AS three', 'two.parent_id = three.c_id', 'LEFT');
            $this->db->join('category AS four', 'three.parent_id = four.c_id', 'LEFT');
            $this->db->order_by('views',  'DESC');

            $query = $this->db->get('items', 8);
            return $this->items_xss_clean($query->result());

        } else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function search_personals() {
        if ($this->db->table_exists('user')) {
            $this->db->like('name', $this->search_query);
            $this->db->where('type', 'personal');
            //$this->db->where('district', $district);
            $this->db->join('personal', 'user.user_key=personal.p_id');

            $query = $this->db->get('user', 8);
            return $this->user_type_xss_clean($query->result(), 'personal');
        } else {
            echo show_error('We have encountered a problem !');
        }
    }
    public function search_dealers() {
        if ($this->db->table_exists('user')) {
            $this->db->like('name', $this->search_query);
            $this->db->where('type', 'dealer');
            //$this->db->where('district', $district);
            $this->db->join('dealer', 'user.user_key=dealer.d_id');

            $query = $this->db->get('user', 8);
            return $this->user_type_xss_clean($query->result(), 'dealer');
        } else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function count_search_items() {
        if ($this->db->table_exists('items')) {
            $this->db->like('title', $this->search_query);
            $this->db->where('deleted_date', 0);
            return $this->db->count_all_results('items');
        } else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function count_search_personals() {
        if ($this->db->table_exists('user')) {
            $this->db->like('name', $this->search_query);
            $this->db->join('personal', 'user.user_key=personal.p_id');
            $this->db->where('type', 'personal');
            return $this->db->count_all_results('user');
        } else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function count_search_dealers() {
        if ($this->db->table_exists('user')) {
            $this->db->like('name', $this->search_query);
            $this->db->join('dealer', 'user.user_key=dealer.d_id');
            $this->db->where('type', 'dealer');
            return $this->db->count_all_results('user');
        } else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function items_xss_clean($array) {
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

        return $array;
    }

    public function user_xss_clean($array, $type) {
        foreach ($array as &$user) {
            $user->khojeko_username = html_escape($this->security->xss_clean($user->khojeko_username));
            $user->email            = html_escape($this->security->xss_clean($user->email));
        }
        unset($user);

        return user_type_xss_clean($array, $type);
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