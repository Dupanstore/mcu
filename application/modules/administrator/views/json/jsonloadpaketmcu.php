<?php
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kd_paket';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$this->db->where('jenis_paket', 'P');
		$this->db->order_by($sort, $order);
		$data['query'] = $this->db->get('tb_paket');
		$ffds = $data['query']->result();
		$hhhh = array();
		if($ffds){
			foreach($ffds as $fsa){
				$gscdd = "";
				$gscee = "";
				$autdin = "";
				$autoground = "";
				$autocert = "";
				if($fsa->en_hasil == "Y"){
					$gscdd = 'checked="true"';
				}
				if($fsa->casis_tni == "Y"){
					$gscee = 'checked="true"';
				}
				if($fsa->auto_dinas == "Y"){
					$autdin = 'checked="true"';
				}
				if($fsa->auto_grounded == "Y"){
					$autoground = 'checked="true"';
				}
				if($fsa->autosert == "Y"){
					$autocert = 'checked="true"';
				}
				$fsa->harga_paket_baru = is_no_rp($fsa->harga_paket);
				$fsa->en_hasil = '<input '.$gscdd.' type="checkbox" onclick="rubahstatusbahasa(\''.$fsa->id_paket.'\')">';
				$fsa->casis_tniok = '<input '.$gscee.' type="checkbox" onclick="rubahstatuscasistni(\''.$fsa->id_paket.'\')">';
				$fsa->autodinas = '<input '.$autdin.' type="checkbox" onclick="rubahstatusautodinas(\''.$fsa->id_paket.'\')">';
				$fsa->autogrounded = '<input '.$autoground.' type="checkbox" onclick="rubahstatusautogrounded(\''.$fsa->id_paket.'\')">';
				$fsa->autoct = '<input '.$autocert.' type="checkbox" onclick="rubahstatusautosert(\''.$fsa->id_paket.'\')">';
				$hhhh[] = $fsa;
			}
		}
			$object = new stdClass();
			$object->rows = $hhhh;
			print_r (json_encode($object));
?>