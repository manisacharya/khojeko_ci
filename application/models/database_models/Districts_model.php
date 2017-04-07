<?php

/**
 * Created by PhpStorm.
 * User: manisAlert
 * Date: 10/1/2016
 * Time: 1:20 PM
 */
class Districts_model extends CI_Model
{
    //user table attribute
    public $id;
    public $district_name;
    public $zone_id;
    
    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_districts(){
        $district_selected = $this->input->post('district_selected');
        $this->db->select('district_name')->from('districts');
        $this->db->join('zones', "districts.zone_id = zones.id");
        $where = "zone_name ='".$this->input->post('zone')."'";
        $this->db->where($where);
        $query = $this->db->get();
        $HTML = "";
        foreach($query->result() as $row) {
            $district_name = $row->district_name;
            if($district_name == $district_selected)
                $HTML.="<option value='".$district_name."' selected>".$district_name."</option>";
            else
                $HTML.="<option value='".$district_name."'>".$district_name."</option>";
        }
        echo $HTML;
    }
}