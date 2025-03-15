<?php
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tgl_awal_reg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
		$que 	 = "select  a.id_paket, a.kode_transaksi, a.no_reg, DATE_FORMAT(tgl_awal_reg, '%d/%m/%Y %H:%i:%s') as newtglnya, a.id_reg, b.nip_nrp_nik, b.id_pas, b.nm_pas, b.jabatan_pas, b.pangkat_pas, b.alamat_pas, c.nm_jawatan, d.nm_dinas from tb_register a, tb_pasien b, tb_jawatan c, tb_dinas d where a.no_reg=b.no_reg and b.id_jawatan=c.id_jawatan and b.id_dinas=d.id_dinas";
		if (@!empty($_GET['filter_keyword'])){
			$que 	.= " and (b.nm_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR b.jabatan_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR  b.pangkat_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR c.nm_jawatan like '%".strip_tags(trim($_GET['filter_keyword']))."%')";
		}
		if(@!empty($_GET['filter_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['filter_jawatan']."' ";
		}
		if(@!empty($_GET['filter_carabayar'])){
			$que 	.= " and a.cara_bayar='".$_GET['filter_carabayar']."' ";
		}
		$que 	.= " and (d.id_dinas='43' OR d.id_dinas='44' OR d.id_dinas='45' OR d.id_dinas='46' OR d.id_dinas='47' OR d.id_dinas='48' OR d.id_dinas='49' OR d.id_dinas='51' OR d.id_dinas='63' OR d.id_dinas='80') ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime($_GET['filter_tglawal']))." 00:00:00' AND '".date("Y-m-d", strtotime($_GET['filter_tglakhir']))." 23:59:59' ";
		$gsv = $this->db->query($que);
		$data['totals'] = $gsv->num_rows();
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
		$gnhd = array();
		if($ffds){
			foreach($ffds as $hj){
				$hj->bayarlah = 'bbbbbb';
				$gnhd[] = $hj;
			}
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $gnhd;
			print_r (json_encode($object));
?>