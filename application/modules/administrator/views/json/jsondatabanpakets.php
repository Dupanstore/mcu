<?php
		$this->db->select('id');
		$this->db->where('jenis_paket', 'P'); 
		$this->db->from('tb_paket');
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'nm_paket';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$this->db->where('jenis_paket', 'P'); 
		if (@!empty($_POST['cari'])){
			$this->db->like('nm_paket', strip_tags(trim($_POST['cari']))); 
		}
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_paket', $rows, $offset);
		
		$ffds = $data['query']->result();
		$gnhd = array();
		if($ffds){
			foreach($ffds as $hj){
				$autdin = "";
				if($hj->tampil_online == "Y"){
					$autdin = 'checked="true"';
				}
				
				$hj->blstimg = '<img src="'.is_iplocalserverandroid().'/'.$hj->img_paket.'" style="width:150px;">';
				$hj->autool = '<input '.$autdin.' type="checkbox" onclick="rubahstatautopaketpas(\''.$hj->id_paket.'\')">';
				$gnhd[] = $hj;
			}
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $gnhd;
			print_r (json_encode($object));
?>