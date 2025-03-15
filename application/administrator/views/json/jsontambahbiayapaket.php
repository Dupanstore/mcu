<?php
	$salsa = array();
	$fas = "select id_fil, id_tind, id_pem from tb_register_filterdata where unicode_transaksi='".$_GET['kodetransaksi']."' and type_filter='TAMBAH' ";
	$osm = $this->db->query($fas);
	$ads = $osm->result();
	$filtmp = " and (";
	if($ads){
		foreach($ads as $gs){
			$cekss[$gs->id_tind] = 1;
			$filtmp .= " id_tind ='".$gs->id_tind."' OR ";
		}
		$filtmp .= ")*****";
		$filtmp = str_replace(" OR )*****", " ) ", $filtmp);
	}
	//die($filtmp);
	$tt = "select id_tind from tb_paket_meta where 1=1 ";
	$tt .= " and id_paket='".$_GET['idpaket']."' ";
	$aa = $this->db->query($tt);
	$bb = $aa->result();
	//print_r($bb);
	if($bb){
		foreach($bb as $kkkk){
			$cek[$kkkk->id_tind] = '1';
		}
	}
		$this->db->select('id_tind');
		$this->db->from('tb_tindakan');
		//$this->db->where('id_ins_tind', $this->uri->segment(3));
		$data['totals'] = $this->db->count_all_results();
		//untuk bagian pagging
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kd_tind';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$que 	 = "select * from tb_tindakan, tb_grouptind where tb_tindakan.kd_grouptind=tb_grouptind.kd_grouptindakan ";
		if (@!empty($_POST['cari'])){
			$que 	.= " and (nm_tind like '%".strip_tags(trim($_POST['cari']))."%' OR  kd_tind like '%".strip_tags(trim($_POST['cari']))."%' OR  nm_grouptindakan like '%".strip_tags(trim($_POST['cari']))."%')";
		}
		if (isset($_POST['tampilkanfilter'])){
					if($_POST['tampilkanfilter'] == "tampil"){
						$que .= $filtmp;
					}
				}
		//$que 	.= " and id_ins_tind='".$this->uri->segment(3)."' ";
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
		foreach($ffds as $goi){
			if($cek[$goi->id_tind]){
				$goi->centangdatanyaya = '-';
			} else {
				$ggs = "";
				if($cekss[$goi->id_tind]){
					$ggs = 'checked="true"';
				}
				$goi->centangdatanyaya = '<input type="checkbox" '.$ggs.' onclick="cobatambahkanbiaya(\''.$_GET['idpaket'].'\', \''.$_GET['kodetransaksi'].'\', \''.$goi->id_tind.'\', \''.$goi->id_ins_tind.'\')">';
			}
			$salsa[] = $goi;
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $salsa;
			print_r (json_encode($object));
?>