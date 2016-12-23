<?php

/**
 * Created by PhpStorm.
 * User: manisAlert
 * Date: 10/1/2016
 * Time: 1:20 PM
 */
class Document_model extends CI_Model
{
    //document table attribute
    public $doc_id;
    public $doc_name;
    public $no_doc_reason;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('admin/item_model'); // load model
    }

    public function add_doc(){
        if ($this->db->table_exists('document')) {

            $variable = serialize($this->input->post('owner_proof'));

            foreach ($variable as $key => $value) {
                # code...
            }
            $data = array(
                 'section' => $variable
                 );

            $this->db->insert('table_name',$data);

            if($this->input->post("owner_proof")=="Not"){
                $this->doc_name = NULL;
                $this->no_doc_reason = $this->input->post('reason');
                $this->item_id = $this->item_model->get_item_id();
            }else{
                $this->doc_name = $this->input->post('owner_proof');
                $this->item_id = $this->item_model->get_item_id();
                $this->no_doc_reason = NULL;
            }

            $this->db->insert('document', $this);
        } else {
            echo show_error('We have encountered some problem. Visit site later.', 500, 'Opps! Something went wrong');
        }
    }
}