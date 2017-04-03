<?php
class Filter_test_model extends CI_Model {

    public function get_sub_category(){
        $category = $this->input->post('sub_cat');

        //query to get c_id
        $query1 = $this->db->get_where('category', ['c_slug' => $category]);
        $c_id = $query1->row()->c_id;

        //sql for ajax
        $query2 = $this->db->get_where('category', ['parent_id' => $c_id]);

        $HTML = "<h4>".ucwords(strtolower(str_replace('-', ' ', $category))) ." >></h4>";
        $HTML .="<div class='subcategory_display'>";

        if ($query2->num_rows()>0) {
            $HTML .="<ul>";
            foreach ($query2->result() as $row) {
                $HTML .= "<li onclick=\"sub_sub_category('".$row->c_slug."')\">" . $row->c_name . "</li>";
            }
            $HTML .="</ul>";
        } else {
            $HTML .= "<span>No subcategory available</span>";
        }
        $HTML .="</div>";
        echo $HTML;
    }

    public function get_sub_sub_category(){
        $category = $this->input->post('sub_sub_cat');

        //query to get c_id
        $query1 = $this->db->get_where('category', ['c_slug' => $category]);
        $c_id = $query1->row()->c_id;

        //sql for ajax
        $query2 = $this->db->get_where('category', ['parent_id' => $c_id]);

        $HTML = "<h4>".ucwords(strtolower(str_replace('-', ' ', $category))) ." >></h4>";
        $HTML .="<div class='subcategory_display'>";

        if ($query2->num_rows()>0) {
            $HTML .="<ul>";
            foreach ($query2->result() as $row) {
                $HTML .= "<li>" . $row->c_name . "</li>";
            }
            $HTML .="</ul>";
        } else {
            $HTML .= "<span>No subcategory available</span>";
        }
        $HTML .="</div>";
        echo $HTML;
    }

}