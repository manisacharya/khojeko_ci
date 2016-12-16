<?php

/**
 * Created by PhpStorm.
 * User: manisAlert
 * Date: 10/1/2016
 * Time: 1:20 PM
 */
class Item_model extends CI_Model
{
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

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('database_models/item_spec_model');
        $this->load->model('database_models/categories_model');
    }

    public function add_item($detail){
        if ($this->db->table_exists('items')) {

            $this->title = $this->input->post('ad_title');

//            if ($detail->type == 'personal'){
//                $this->item_type = $this->input->post('ad_type_personal');
//                $this->quantity = 1;
//            }
//            else if($detail->type == 'dealer') {
                $this->item_type = $this->input->post('ad_type_dealer');
                $this->quantity = $this->input->post('quantity');
            //}

            if($this->input->post('bought_from') == "Abroad")
                $this->bought_from = $this->input->post('abroad_country');
            else
                $this->bought_from = $this->input->post('bought_from');

            $this->price = $this->input->post('offer');

           // $used_for = $this->input->post('used_for_text') . " " . $this->input->post('used_for_time');
            $this->used_for = $this->input->post('used_for_text');

            $this->mkt_price = $this->input->post('market_price');
            $this->verification_number = $this->input->post('document_no');

            //
            $this->is_verified = 1;
            $this->avaibility_address = $detail->full_address;

            $this->published_date = NOW();
            
            $this->ad_duration = $this->input->post('ad_running_time');

            $this->delivery = $this->input->post('home_delivery');

            if($this->delivery == "Yes") {
                $this->delivery_charge = $this->input->post('delivery_charge');
            } else {
                $this->delivery_charge = 0;
            }

            $this->warranty_period = $this->input->post('warranty');

            $this->sales_status = 1;

            $this->views = 0;

            // check if user is verified and is user blocked
            if($detail->u_verified == 1 && $detail->user_status == 1) {
                $this->visibility = 1;
            } else {
                $this->visibility = 0;
            }

            $this->video_url1 = $this->video_explode($this->input->post("video1_url"));

            $this->video_url2 = $this->video_explode($this->input->post("video2_url"));

            $this->deleted_date = 0;

            $this->c_id = $this->categories_model->get_cid_c_slug($this->input->post('postc_slug'));;
            
            $this->user_id = $this->user_model->get_user_id();

            $this->is_premium = 0;
            $this->comment_count = 0;
            $this->spam_count = 0;

            if($this->title!=NULL)
                $this->db->insert('items', $this);

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
           // echo $this->item_id;

        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }

    public function get_item_id(){

        return $this->item_id;
    }

    public function get_ad_name(){

        return $this->title;
    }

    public function video_explode($video_url){
        $action = explode('=', $video_url);
        foreach ($action as $value) {
            $data = $value;
        }
        return $data;
    }
}