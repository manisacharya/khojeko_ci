<?php

class Spam_and_fav_model extends CI_Model {

    public function add_fav($id, $user_id){
        $info = $this->db->get_where('favourites', array('item_id' => $id, 'p_id' => $p_id));

        if(! $info->num_rows()) {
            $data = array(
                'item_id' => $id,
                'user_id' => $user_id
            );

            $this->db->insert('favourites', $data);
            $this->session->set_flashdata('fav_message','<div class="alert alert-success">This item has been added to your favourites.</div>');
        } else {
            $this->session->set_flashdata('fav_message','<div class="alert alert-danger">This item has already been added to your favourites.</div>');
        }
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