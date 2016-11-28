<?php

class Spam_and_fav_model extends CI_Model {

    public function add_fav($id, $p_id){
        $info = $this->db->get_where('favourites', array('item_id' => $id, 'p_id' => $p_id));

        if(! $info->num_rows()) {
            $data = array(
                'item_id' => $id,
                'p_id' => $p_id
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
                'user_id' => $user_id
            );

            $this->db->insert('spam', $data);

            $spam_count = $spam_count + 1;
            $this->db->where('item_id', $id);
            $this->db->update('items',array('spam_count' => $spam_count));
            $this->session->set_flashdata('spam_message','<div class="alert alert-success">Fake report has been registered for this item.</div>');
        } else {
            $this->session->set_flashdata('spam_message','<div class="alert alert-danger">Fake report already registered for this item.</div>');
            }
    }

}