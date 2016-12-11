<?php
class Index_database_model extends CI_Model {

    // public function xss_invoke($variable, $name){
    //     $this->$variable = html_escape($this->security->xss_clean($this->input->post($name)));
    // }
    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('categories_model');
    }
    //fetch all data from $table
    function getAll($table, $orderby, $order) {
        $this->db->select('*')->from($table)->order_by($orderby, $order);
        $query = $this->db->get();
        return $query->result();
    }

    //for latest ad not to show house and land
    function getAllWhere($table, $orderby, $order){
        $this->db->select('*')->from($table)->order_by($orderby, $order);
        $this->db->where('item_img.primary', 1);
        $this->db->where('visibility', 1);
        $query = $this->db->get();
        return $query->result();
    }

    //fetch certain data with $id = $value
    function getDetails($table, $value, $id) {
        $this->db->where($value, $id)->from($table);
        $query = $this->db->get();
        return html_escape($this->security->xss_clean($query->row()));
    }

    //join $tableFrom and $tableJoin with certain $id
    public function joinTable($tableFrom, $tableJoin, $id){

        $this->db->select('*')->from($tableFrom);
        $this->db->join($tableJoin, "$tableFrom.$id = $tableJoin.$id");
//        $this->db->where('quantity'!=0);
//        $this->db->where('isverified'==1);
//        $this->db->where('sales_status'==1);
//        $this->db->where('adduration'!=0);
//        $this->db->where('visibility'==1);
//        $this->db->where('deleted_date'==1);

        $query = $this->db->get();
        return $query->result();
    }

    //function joinTable with descending order
    public function joinTableOrder($tableFrom, $tableJoin, $id, $orderAtr){

        $this->db->select('*')->from($tableFrom);
        $this->db->join($tableJoin, "$tableFrom.$id = $tableJoin.$id");
        //$this->db->join('category', "category.cid = $tableJoin.cid");
 
        $this->db->order_by("$tableJoin.$orderAtr", 'desc');
        //$this->db->where('quantity',!0);
        $this->db->where('is_verified', 1);
        $this->db->where('sales_status', 1);
        //$this->db->where('ad_duration', !0);
        $this->db->where('visibility', 1);
        $this->db->where('deleted_date', 0);
        $query = $this->db->get();
        return $query->result();
    }

    function selHouLand(){

        $this->db->select('*');
        $this->db->from('items');
        $this->db->join('category', 'category.c_id= items.c_id');
        $this->db->join('item_img', 'item_img.item_id = items.item_id');
        $this->db->where('item_img.primary', 1);
        $this->db->where('visibility', 1);
        $this->db->group_start();
        $this->db->where('category.c_name','House');
        $this->db->or_where('category.c_name', 'Land');
        $this->db->group_end();
        //$this->db->order_by('items.published_date', 'desc')
        $query =  $this->db->get();
        return $query->result();
    }

    function selectWhat($selAttribute){
        $this->db->select('*');
        $this->db->from('items');
        $this->db->join('category', 'category.c_id= items.c_id');
        $this->db->join('item_img', 'item_img.item_id= items.item_id');
        $this->db->where('item_img.primary', 1);
        $this->db->group_start();
        $this->db->where('category.c_name',$selAttribute);
        $this->db->group_end();

        $query =  $this->db->get();
        return $query->result();
    }

    function details($id){

        $this->db->select('*')->from('item_img');
        $this->db->join('items', 'item_img.item_id= items.item_id');
        $this->db->where('item_img.image_id', $id);
        $query =  $this->db->get();
        return html_escape($this->security->xss_clean($query->row()));
    }

    //to be made continue
    public function joinTableWhere($tableFrom, $tableJoin, $tid, $id){

        $this->db->select('*')->from($tableFrom);
        $this->db->join($tableJoin, "$tableFrom.$tid = $tableJoin.$tid");
        $this->db->where('item_img.image_id', $id);

        $query = $this->db->get();
        return html_escape($this->security->xss_clean($query->result()));
    }

	public function search($name){
        $this->db->like('title', $name, 'both');
        return $this->db->get('items')->result();
    }

    public function joinThings($table, $columns, $joins) {
        $this->db->select($columns)->from($table);

        if (is_array($joins) && count($joins) > 0) {
            foreach($joins as $k => $v) {
                $this->db->join($v['table'], $v['condition'], $v['jointype']);
            }
        }
        return $this->db->get()->result();
    }

};
?>