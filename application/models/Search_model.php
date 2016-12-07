<?php

class Search_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function search_items() {
        $district = $this->input->get('district');
        $search_query = $this->input->get('search');

        if ($this->db->table_exists('items')) {
            $this->db->like('title', $search_query);
            $this->db->where('deleted_date', 0);
            $this->db->join('item_img', 'item_img.item_id = items.item_id');
            $this->db->join('item_spec', 'item_spec.item_id = items.item_id');
            $this->db->join('category', 'category.c_id = items.c_id');

            $query = $this->db->get('items');
            return $this->items_xss_clean($query->result());

        } else {
            echo show_error('We have encountered a problem !');
        }
    }

    public function search_personals() {
        $district = $this->input->get('district');
        $search_query = $this->input->get('search');

        if ($this->db->table_exists('user')) {
            $this->db->like('name', $search_query);
            $this->db->where('type', 'personal');
            //$this->db->where('district', $district);
            $this->db->join('personal', 'user.user_key=personal.p_id');

            $query = $this->db->get('user');
            return $this->user_type_xss_clean($query->result(), 'personal');
        } else {
            echo show_error('We have encountered a problem !');
        }
    }
    public function search_dealers() {
        $district = $this->input->get('district');
        $search_query = $this->input->get('search');

        if ($this->db->table_exists('user')) {
            $this->db->like('name', $search_query);
            $this->db->where('type', 'dealer');
            //$this->db->where('district', $district);
            $this->db->join('dealer', 'user.user_key=dealer.d_id');

            $query = $this->db->get('user');
            return $this->user_type_xss_clean($query->result(), 'dealer');
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
            $items->ad_id                   = html_escape($this->security->xss_clean($items->ad_id));
            $items->specs                   = html_escape($this->security->xss_clean($items->specs));
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