<?php
class Hierarchy_model extends CI_Model {

    private $data;
    private $handler;

    function __Construct() {
 			parent::__Construct ();
 			//$this->data[] = array(array());
 			$this->data[] = array();
 		}

		public function fetchChildren($parent, $level) {
		    $this->db->select('*')->from('category')->where('p_id', $parent);
		    $query = $this->db->get();
		    $result = $query->result();

		    foreach($result as $value => $row) {
		        $row->level = $level;
                $this->data[] = $row;
		        $this->fetchChildren($row->c_id, $level+1);
		    }
		    return $this->data;
		}

	};
?>