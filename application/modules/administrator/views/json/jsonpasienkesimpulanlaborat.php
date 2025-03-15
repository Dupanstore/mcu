<?php
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
		$offset = ($page - 1) * $rows;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'tgl_awal_reg';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
		$que 	 = "select a.id_paket, a.kode_transaksi, a.no_reg, DATE_FORMAT(tgl_awal_reg, '%d/%m/%Y %H:%i:%s') as newtglnya, a.id_reg, a.no_filemcu, b.nip_nrp_nik, b.id_pas, b.nm_pas, b.no_tlp_pas, b.alamat_pas from tb_register_detailpemeriksaan x, tb_register a, tb_pasien b where x.kode_transaksi=a.kode_transaksi and a.no_reg=b.no_reg ";
		if (@!empty($_GET['filter_keyword'])){
			$que 	.= " and (a.no_filemcu like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR b.no_reg like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR  b.nm_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR b.alamat_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR b.nip_nrp_nik like '%".strip_tags(trim($_GET['filter_keyword']))."%' OR b.no_tlp_pas like '%".strip_tags(trim($_GET['filter_keyword']))."%')";
		}
		if(@!empty($_GET['filter_paket'])){
			$que 	.= " and a.id_paket='".$_GET['filter_paket']."' ";
		}
		if(@!empty($_GET['filter_typejawatan'])){
			$que 	.= " and b.no_reg like '".$_GET['filter_typejawatan']."%' ";
		}
		if(@!empty($_GET['filter_jawatan'])){
			$que 	.= " and b.id_jawatan='".$_GET['filter_jawatan']."' ";
		}
		$que 	.= " and a.konsul <> 'Y' ";
		$que 	.= " and x.id_ins_tind_detpem=2 and adakelainan='Y' ";
		$que 	.= " and a.tgl_awal_reg BETWEEN '".date("Y-m-d", strtotime($_GET['filter_tglawal']))." 00:00:00' AND '".date("Y-m-d", strtotime($_GET['filter_tglakhir']))." 23:59:59' ";
		$que 	.= " group by a.kode_transaksi ";
		$gsv = $this->db->query($que);
		$data['totals'] = $gsv->num_rows();
		$que 	.= " order by ". $sort ." ". $order ." limit ".$offset .", ". $rows;
		$data['query'] 	= $this->db->query($que);
		$ffds = $data['query']->result();
		$gnhd = array();
		if($ffds){
			foreach($ffds as $hj){
				
					$hsbb = "select a.hasilnya, a.ketkelainanlainnya, c.id_pem, c.nm_pem from tb_register_detailpemeriksaan a inner join tb_pemeriksaan c on a.id_pem_deb=c.id_pem  ";
					$hsbb .= "where  1=1  ";
					$hsbb .= "and a.kode_transaksi='".$hj->kode_transaksi."' and a.id_paket='".$hj->id_paket."' and a.adakelainan='Y' and a.id_ins_tind_detpem=2 ";
					$ansd = $this->db->query($hsbb);
					$ssv = $ansd->result();
					foreach($ssv as $vssd){
						$tmppkell[$hj->kode_transaksi][] = $vssd->nm_pem.": ".$vssd->hasilnya ." ".$vssd->ketkelainanlainnya;
					}
			
					$isihasildev = implode(', ', $tmppkell[$hj->kode_transaksi]);
					$isikesimpulandev = implode(', ', $tmppkell[$hj->kode_transaksi]);
					
					$this->db->select('kesimpulan_kelainan');
					$this->db->where('ket_resume', 'diagnosakelainan');
					$this->db->where('nama_kelainan', 'Laboratorium');
					$this->db->where('kode_transaksi', $hj->kode_transaksi);
					$sssa = $this->db->get('tb_resume_pasien');
					$respas = $sssa->row();
					if($respas){
						$hj->warnaok = 200;
						$isikesimpulandev = $respas->kesimpulan_kelainan;
					}else{
						$hj->warnaok = 0;
					}
					
					
					
					$hj->isihasil = '<textarea style="width:97%;height:96px" disabled="true">'.$isihasildev.'</textarea>';
					$hj->isikesimpulan = '<textarea style="width:97%;height:96px" onchange="rubahhasilkesimpulanlab(\''.$hj->kode_transaksi.'\', \''.$hj->id_reg.'\', this.value, \''.$isihasildev.'\')">'.$isikesimpulandev.'</textarea>';
					
					//saatnya dicek sudah pernah eval simpan kesimpulan saran atau belum
				$gnhd[] = $hj;
			}
		}
			$object = new stdClass();
			$total = $data['totals'];
			$object->total = $total;
			$object->rows = $gnhd;
			print_r (json_encode($object));
?>