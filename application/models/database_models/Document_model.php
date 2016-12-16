<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends CI_Model {
    public $doc_id;
    public $doc_name;
    public $item_id;
    public $no_doc_reason;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('database_model/items_model'); // load model
    }

    public function add_doc(){
        if ($this->db->table_exists('document')) {

            if($this->input->post("owner_proof")=="Not"){
                $this->doc_name = NULL;
                $this->no_doc_reason = $this->input->post('reason');
                $this->item_id = $this->items_model->get_item_id();
            }else{
                $this->doc_name = $this->input->post('owner_proof');
                $this->no_doc_reason = NULL;
                $this->item_id = $this->items_model->get_item_id();
            }

            $this->db->insert('document', $this);
        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->doc_id = $this->input->post('doc_id');
            $this->doc_name = $this->input->post('doc_name');
            $this->item_id = $this->input->post('item_id');
            return TRUE;
        }
        return FALSE;
    }
}