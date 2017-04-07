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

    public function add_question($item_id,$user_id,$comment_count){
        $data = array(
            'question' => $this->input->post('question'),
            'answer' => NULL,
            'user_id' => $user_id,
            'item_id' => $item_id,
            'posted_date' => NOW()
        );

        $this->db->insert('ask_me', $data);

        $comment_count = $comment_count + 1;
        $this->db->update('items',array('comment_count' => $comment_count), "item_id=".$item_id);
    }
}