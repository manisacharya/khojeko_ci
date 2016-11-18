<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Ask_me_model extends CI_Model {
    public $ask_id;
    public $question;
    public $answer;
    public $user_id;
    public $item_id;
    public $posted_date;

    public function insert_dealer() {
        if ($this->db->table_exists('dealer')) {
            $this->ask_id = $this->input->post('ask_id');
            $this->question = $this->input->post('question');
            $this->answer = $this->input->post('answer');
            $this->user_id = $this->input->post('user_id');
            $this->item_id = $this->input->post('item_id');
            $this->posted_date = $this->input->post('posted_date');
            return TRUE;
        }
        return FALSE;
    }
}