<?php
		$total = 0;
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tgl_awal_reg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
		$que 	 = "select a.id_reg, a.no_filemcu, b.nip_nrp_nik, b.id_pas, b.nm_pas, b.no_tlp_pas from tb_register a, tb_pasien b where a.no_reg=b.no_reg ";
		if(isset($_POST['cari']) AND @!empty($_POST['cari'])){
			$que 	.= " and (b.no_reg like '%".strip_tags(trim($_POST['cari']))."%' OR  b.nm_pas like '%".strip_tags(trim($_POST['cari']))."%' OR b.alamat_pas like '%".strip_tags(trim($_POST['cari']))."%' OR b.nip_nrp_nik like '%".strip_tags(trim($_POST['cari']))."%' OR b.no_tlp_pas like '%".strip_tags(trim($_POST['cari']))."%')";
		}
		if(!isset($_POST['filter_tglawal'])){
			$que 	.= " and DATE_FORMAT(a.tgl_awal_reg, '%Y%m%d')='".date('Ymd')."' ";
		}
		$que 	.= " and a.konsul='Y' ";
		//$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime($_GET['filter_tglawal']))." 00:00:00' AND '".date("Y-m-d", strtotime($_GET['filter_tglakhir']))." 23:59:59' ";
		$newttl = $this->db->query($que);
		if($newttl->num_rows()){
			$total = $newttl->num_rows();
		}
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
		$gnhd = array();
		if($ffds){
			foreach($ffds as $hj){
				$hj->editpasya = '<a href="javascript:void(0)" onclick="editdatapas(\''.$hj->id_pas.'\', \''.$hj->id_reg.'\')"><img src="'.base_url('assets/img/icon_edit.png').'" style="width:18px;"></a>';
				$hj->printpasya = '<a href="javascript:void(0)" onclick="printdatapas(\''.$hj->id_pas.'\', \''.$hj->id_reg.'\')"><img src="'.base_url('assets/img/icon_print.png').'" style="width:18px;"></a>';
				$gnhd[] = $hj;
			}
		}
			$object = new stdClass();
			$object->total = $total;
			$object->rows = $gnhd;
			print_r (json_encode($object));
?>