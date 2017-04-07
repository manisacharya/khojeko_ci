<?php
/**
 * Created by PhpStorm.
 * User: cham11ng
 * Date: 10/27/16
 * Time: 1:48 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Spam_model extends CI_Model {
    public $spam_id;
    public $item_id;
    public $user_id;
    public $spam_message;

    public function count_spam_of_user($user_id) {
        $this->db->where('items.user_id', $user_id);
        $this->db->join('items', 'items.item_id = spam.item_id');
        return $this->db->count_all_results('spam');
    }

    public function add_spam($id, $user_id, $spam_count){
        $info = $this->db->get_where('spam', array('item_id' => $id, 'user_id' => $user_id));

        if(! $info->num_rows()) {
            $data = array(
                'item_id' => $id,
                'user_id' => $user_id,
                'spam_message' => $this->input->post('fake_comment')
            );

            $this->db->insert('spam', $data);

            $spam_count = $spam_count + 1;
            $this->db->update('items',array('spam_count' => $spam_count), "item_id=".$id);
            $this->session->set_flashdata('spam_message','<div class="alert alert-success">Your report has been registered for this item.</div>');
            return true;
        } else {
            $this->session->set_flashdata('spam_message','<div class="alert alert-danger">Your report already registered for this item.</div>');
            return false;
        }
    }

    public function spam_check($id, $user_id){
        $info = $this->db->get_where('spam', array('item_id' => $id, 'user_id' => $user_id));

        if(!$info->num_rows()){
            return true;
        }else{
            return false;
        }
    }
}