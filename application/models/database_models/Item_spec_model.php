<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Item_spec_model extends CI_Model {
    public $s_id;
    public $specs;
    public $item_id;

    public function __construct() {
        parent::__construct();
        $this->load->model('item_model');
        $this->load->model('database_models/document_model');
    }

    public function add_spec(){
        if ($this->db->table_exists('item_spec')) {

            $this->specs = $this->input->post('ad_details');
            $this->item_id = $this->item_model->get_item_id();
            $this->db->insert('item_spec', $this);

            $this->document_model->add_doc();
        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }
    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->s_id = $this->input->post('s_id');
            $this->specs = $this->input->post('specs');
            $this->item_id = $this->input->post('item_id');
            return TRUE;
        }
        return FALSE;
    }
}