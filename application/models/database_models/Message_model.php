<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {
    public $m_id;
    public $m_content;
    public $m_subject;
    public $user_id;
    public $sent_date;

    public function insert_message() {
        if ($this->db->table_exists('dealer')) {
            $this->m_id = $this->input->post('m_id');
            $this->m_content = $this->input->post('m_content');
            $this->m_subject = $this->input->post('m_subject');
            $this->user_id = $this->input->post('user_id');
            $this->sent_date = $this->input->post('sent_date');
            return TRUE;
        }
        return FALSE;
    }
}