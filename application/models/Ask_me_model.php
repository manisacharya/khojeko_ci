<?php

class Ask_me_model extends CI_Model {

    public function get_ques_ans($id){
//        $info = $this->db->get_where('ask_me', array('item_id' => $id));
//        return $info;
//
//        SELECT * FROM ask_me JOIN USER WHERE ask_me.user_id = user.user_id AND ask_me.item_id=2

        $this->db->select('*')->from('ask_me');
        $this->db->join('user', "(ask_me.user_id = user.user_id AND ask_me.item_id=".$id.")");

        $query = $this->db->get();
        return $query;
    }

    public function add_question($item_id,$user_id){
        $data = array(
            'question' => $this->input->post('question'),
            'answer' => NULL,
            'user_id' => $user_id,
            'item_id' => $item_id,
            'posted_date' => NOW()
        );

        $this->db->insert('ask_me', $data);
    }
}