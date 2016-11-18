<?php
 	class General_database_model extends CI_Model {

 		// GET ALL DATA FROM ONE TABLE SORTED ORDER parameters:(TABLE NAME, ORDERBY, ASC/DESC)

 		function getAll($table, $orderby, $order) {
 			$this->db->select('*')->from($table)->order_by($orderby, $order);
	  		$query = $this->db->get();
	  		return $query->result();
 		}

 		// GET ONE ROW DATA FROM ONE TABLE parameter:(TABLE NAME, COLUMN, VALUE)

 		function getDetails($table, $column, $value) {
 			$this->db->where($column, $value)->from($table)->limit(1);
 			$query = $this->db->get();
 			return $query->row();
 		}

 		// GET ALL JOINED DATA FROM MULTIPLE JOINED TABLE parameter: (TABLE NAME, COLUMN, JOIN ARRAY)

 		/*  FORMAT OF JOINS ARRAY
 		$joins = array(
		    array(
		        'table' => 'TABLE1',
		        'condition' => 'TABLE CONDITION',
		        'jointype' => 'INNER/NATURAL/LEFT'
		    ),
		    array (
		    	'table' => 'TABLE2',
		    	'condition' => 'TABLE2 CONDTION',
		    	'jointype' => 'INNER/NATURAL/LEFT'
		    )
		);*/

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