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
    //public $description;
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
    //public $spec_url;
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
        $this->load->model('admin/specification_model'); 
        $this->load->model('admin/user_model');
        $this->load->model('admin/document_model');
    }

    public function add_item(){
        if ($this->db->table_exists('items')) {
            
            $this->title = $this->input->post('ad_title');
            $this->item_type = $this->input->post('ad_type');

            if($this->input->post('bought_from') == "Abroad")
                $this->bought_from = $this->input->post('abroad_country');
            else
                $this->bought_from = $this->input->post('bought_from');

            $this->price = $this->input->post('offer');
            $this->used_for = $this->input->post('used_for');
            $this->mkt_price = $this->input->post('market_price');
            $this->verification_number = $this->input->post('document_no');

            $this->is_verified = 0;     //what to do 
            $this->avaibility_address = NULL;  //what to do 

            $this->published_date = NOW();
            
            //$this->xss_invoke('spec_url', 'site_url');
           
           // $this->spec_url = $this->input->post('site_url');

            //$this->xss_invoke('delivery', 'home_delivery');
            $this->delivery = $this->input->post('home_delivery');

            $this->delivery_charge = $this->input->post('delivery_charge');
            $this->warranty_period = $this->input->post('warranty');

            $this->sales_status = 0;
            //$this->xss_invoke('ad_duration', 'ad_running_time');
            $this->ad_duration = $this->input->post('ad_running_time');

            $this->views = 0;
            $this->visibility = 1;

            // $this->xss_invoke('video_url1', 'video_url1');
            // $this->xss_invoke('video_url2', 'video_url2');
            $this->video_url1 = $this->input->post("video1_url");
            $this->video_url2 = $this->input->post("video2_url");

            $this->deleted_date = NULL;

            //$this->xss_invoke('c_id', 'parent_id');
            $this->c_id = $this->input->post('parent_id');
            
            $this->user_id = $this->user_model->get_user_id();
            $this->is_premium = 0;
                    
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
            $this->specification_model->add_spec();
           // $this->document_model->add_doc();

           // echo $this->item_id;

        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }

    public function get_ad_name(){

        return $this->title;
    }

    public function get_item_id(){

        return $this->item_id;
    }
}