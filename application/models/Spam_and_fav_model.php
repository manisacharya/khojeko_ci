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
        } else {
            echo "Page already added to favourite.";
        }
    }

    public function add_spam($id, $user_id){
        $info = $this->db->get_where('spam', array('item_id' => $id, 'user_id' => $user_id));

        if(! $info->num_rows()) {
            $data = array(
                'item_id' => $id,
                'user_id' => $user_id
            );

            $this->db->insert('spam', $data);
        } else {
            echo "Fake report already registered.";
        }
    }

}