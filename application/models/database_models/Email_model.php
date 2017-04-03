<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {
    public $id;
    public $type;
    public $content;

    public function update_template()
    {
        if ($this->input->post('v_content') != '') {
            $this->type = 'verification';
            $this->content = $this->input->post('v_content');
        } else if ($this->input->post('s_content') != '') {
            $this->type = 'support';
            $this->content = $this->input->post('s_content');
        } else if ($this->input->post('f_content') != '') {
            $this->type = 'feedback';
            $this->content = $this->input->post('f_content');
        } else if ($this->input->post('i_content') != '') {
            $this->type = 'inquiry';
            $this->content = $this->input->post('i_content');
        } else if ($this->input->post('m_content') != '') {
            $this->type = 'mass_mail';
            $this->content = $this->input->post('m_content');
        } else {
            return FALSE;
        }
        $this->db->update('emails', array('content' => $this->content), array('type' => $this->type));
        return TRUE;
    }

    public function get_email($type = FALSE)
    {
        $this->db->where('type', $type);
        $query = $this->db->get('emails', 1);
        return $query->row();
    }
}