<?php
				$this->db->select('id_pem');
				$this->db->where('id_tind', $this->uri->segment(3));
				$this->db->where('unicode_transaksi', $_GET['kode_transaksi']);
				$this->db->where('type_filter', 'KURANG');
				$abo = $this->db->get('tb_register_filterdata');
				$ubi = $abo->result();
				if($ubi){
					foreach($ubi as $df){
						$jangantampil[$df->id_pem] = $df->id_pem;
					}
				}
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'det_order_pemeriksaan';  
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
		$mm = "select b.kd_group, b.id_ins_periksa, b.det_range_pemeriksaan_awal, b.det_range_pemeriksaan_akhir, b.det_pilihan_pemeriksaan, b.det_jenis_pemeriksaan, b.det_type_pemeriksaan, b.id_pem, b.det_nilai_normal, b.det_satuan_pemeriksaan, b.det_nm_pemeriksaan from tb_pemeriksaan_meta a, tb_pemeriksaan b where 1=1 ";
		$mm .= " and a.id_pem=b.id_pem and a.id_tind='".$this->uri->segment(3)."' and b.parent_chamber='Y' ";
		$mm 	.= " order by ". $sort ." ". $order;
		$absc = $this->db->query($mm);
		$gfsd = $absc->result();
		$gndb = array();
		foreach($gfsd as $fd){
			if(!$jangantampil[$fd->id_pem]){
				$gndb[] = $fd;
			}
		}
		
			$object = new stdClass();
			$object->rows = $gndb;
			print_r (json_encode($object));
?>