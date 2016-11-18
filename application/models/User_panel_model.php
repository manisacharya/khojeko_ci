<?php
class User_panel_model extends CI_Model {

    public function update($value) {
        $data = array(
            'visibility' => '0'
        );
        $this->db->set($data);
        $this->db->where('item_id', $value);
        $this->db->update('items', $data);
    }
};
?>