<?php
 	class Khojeko_db_model extends CI_Model {

 		function getAllCondition($table, $id) {

 			$this->db->select('*')->from($table)->where('sc_id', $id);
	  		$query = $this->db->get();
	  		return $query->result();

 		}

 		public function joinThings($table, $columns, $joins, $where) {

			$this->db->select($columns)->from($table);

			if (is_array($joins) && count($joins) > 0) {
				foreach($joins as $k => $v) {
					$this->db->join($v['table'], $v['condition'], $v['jointype']);
				}
			}

			$this->db->where($where);
			return $this->db->get()->result();

		}

        public function joinThingsOrder($table, $joins, $orderBy) {
            $district = array();
            $i = 0;

            $this->db->distinct();
            $this->db->select('*')->from($table)->order_by($orderBy, 'desc');;

            if (is_array($joins) && count($joins) > 0) {
                foreach ($joins as $k => $v) {
                    $this->db->join($v['table'], $v['condition'], $v['jointype']);
                }
//            $this->db->where($where);
                //$query = $this->db->get()->result();

//                foreach($query as $row) {
//                    if ($row->district[$i] == $row->district[$i + 1]) {
//
//                    }
//                    $district['districts'] =
//                }
            }
            return $this->db->get()->result();
        }

        public function popular_district(){
            $this->db->join('personal', 'user.user_key = personal.p_id');
            $this->db->join('items', 'user.user_id= items.user_id');
            $this->db->order_by('items.views', 'desc');

            $query = $this->db->get('user', 14);
            return $query->result();
        }

        public function popular_category(){
            $this->db->select('*')->from('items');
            $this->db->join('category', 'user.user_key = cate.p_id');
            $this->db->join('items', 'user.user_id= items.user_id');

            return $this->db->get()->result();
        }

        public function popular_dealer(){
            $this->db->join('dealer', 'user.user_key = dealer.d_id');
            $this->db->join('items', 'user.user_id= items.user_id');
            $this->db->order_by('items.views', 'desc');

            $query = $this->db->get('user', 14);
            return $query->result();
        }

        public function joinThingsRow($table, $columns, $joins, $where) {

            $this->db->select($columns)->from($table);

            if (is_array($joins) && count($joins) > 0) {
                foreach($joins as $k => $v) {
                    $this->db->join($v['table'], $v['condition'], $v['jointype']);
                }
            }

            $this->db->where($where)->limit(1);
            return $this->db->get()->row();

		}

		public function getCount($table, $select, $where) {

			$this->db->select($select)->from($table)->where($where);
			$query = $this->db->get();
			return $query->row();

		}


		public function countArray($array) {

			return count($array);

		}

		public function countSelectedArray($array, $index, $index_value) {
			$count = 0;
			//print_r($array);
			foreach ($array as $key => $value) {

				if ($value->$index == $index_value)
					$count++;

			}

			return $count;

		}
 	};
?>