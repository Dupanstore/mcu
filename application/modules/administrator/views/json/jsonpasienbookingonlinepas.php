<?php
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tglbooking';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
		$que 	 = "select a.*, b.id_pas, b.nm_pas, b.nip_nrp_nik, b.dari_online, c.nm_paket from api_booking a, tb_pasien b, tb_paket c where a.nomor=b.id_pas and a.id_paket=c.id_paket ";
		if (@!empty($_GET['filter_keyword'])){
			$que 	.= " and (a.msg like '%".strip_tags(trim($_GET['filter_keyword']))."%'  OR  b.nm_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR b.alamat_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR b.nip_nrp_nik like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR b.no_tlp_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%')";
		}
		if(@!empty($_GET['filter_paket'])){
			$que 	.= " and a.id_paket='".$_GET['filter_paket']."' ";
		}
		if(@!empty($_GET['filter_typejawatan'])){
			//$que 	.= " and b.no_reg like '".$_GET['filter_typejawatan']."%' ";
		}
		if(@!empty($_GET['filter_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['filter_jawatan']."' ";
		}
		$que 	.= " and a.tglbooking BETWEEN '".date("Y-m-d", strtotime($_GET['filter_tglawal']))."' AND '".date("Y-m-d", strtotime($_GET['filter_tglakhir']))."' ";
		$gsv = $this->db->query($que);
		$data['totals'] = $gsv->num_rows();
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
		$gnhd = array();
		if($ffds){
			foreach($ffds as $hj){	
					//saatnya dicek sudah pernah eval simpan kesimpulan saran atau belum
				$dtbbol = "Tidak";
				if($hj->dari_online){
					$dtbbol = "Ya";
				}
				$gsgb = explode('/', $hj->msg);
				$hj->kode_book = $gsgb[1];
				$hj->dari_online = $dtbbol;
				$hj->prosesdata = "<button type='button' style='margin:5px;' onclick=\"lanjutkanpendaftaranpasien('".$hj->id_pas."', '".$hj->id."')\">Proses Data</button>";
				$gnhd[] = $hj;
			}
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $gnhd;
			print_r (json_encode($object));
?>