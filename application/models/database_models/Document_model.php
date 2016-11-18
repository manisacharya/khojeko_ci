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