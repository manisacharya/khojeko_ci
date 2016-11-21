<?php

/**
 * Created by PhpStorm.
 * User: manisAlert
 * Date: 10/1/2016
 * Time: 1:20 PM
 */
class Specification_model extends CI_Model
{
    //item_spec table attribute
    public $s_id;
    public $specs;
    public $item_id;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('item_model'); // load model
        $this->load->model('document_model');
    }

    public function add_spec(){
        if ($this->db->table_exists('item_spec')) {

            $this->specs = $this->input->post('ad_details');

            $this->item_id = $this->item_model->get_item_id();

            $this->db->insert('item_spec', $this);

            //$this->document_model->add_doc();
        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }

}

?>