<?php	
				$vsb = explode(",", $_GET['idpaket']);
				$tmbhpks = " and (";
				$tmbhatas = " and (";
				foreach($vsb as $fd){
					if(!empty($fd)){
						if(is_numeric($fd)){
							$getarr[] = 1;
							$tmbhpks .= " a.id_tind='".$fd."' OR ";
							$tmbhatas .= " id_tind='".$fd."' OR ";
						}
					}
				}
				$tmbhpks .= ")*****";
				$tmbhpks = str_replace(" OR )*****", " ) ", $tmbhpks);
				$tmbhatas .= ")*****";
				$tmbhatas = str_replace(" OR )*****", " ) ", $tmbhatas);
				if(!is_array($getarr)){
					$tmbhpks = "";
				}
		//jadi hanya akan tampil jika ada id tindakan benar yang masuk
		if(!empty($tmbhpks)){
				$fas = "select id_fil, id_tind, id_pem from tb_register_filterdata where 1=1 ".$tmbhatas." and unicode_transaksi='".$_GET['kodetransaksi']."' and type_filter='KURANG' ";
				$osm = $this->db->query($fas);
				$ads = $osm->result();
				$filtmp = " and (";
				if($ads){
					foreach($ads as $gs){
						$cek[$gs->id_tind][$gs->id_pem] = 1;
						$filtmp .= " a.id_pem ='".$gs->id_pem."' OR ";
					}
					$filtmp .= ")*****";
					$filtmp = str_replace(" OR )*****", " ) ", $filtmp);
				}
				
				//die($filtmp);
				$page = isset($_POST['page']) ? intval($_POST['page']) : 1;  
				$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10; 
				$offset = ($page - 1) * $rows;
				$mm = "select b.rad_namapemeriksaan, b.nm_pem, b.det_nm_pemeriksaan, b.id_pem, c.kd_tind, c.id_tind, c.nm_tind, c.id_ins_tind from tb_pemeriksaan_meta a, tb_pemeriksaan b, tb_tindakan c where a.id_pem=b.id_pem and a.id_tind=c.id_tind ";
				$mm .= $tmbhpks;
				if (@!empty($_POST['cari'])){
					$mm .= " and (b.rad_namapemeriksaan like '%".$_POST['cari']."%' OR b.nm_pem like '%".$_POST['cari']."%' OR b.det_nm_pemeriksaan like '%".$_POST['cari']."%' OR c.nm_tind like '%".$_POST['cari']."%') ";
				}
				if (isset($_POST['tampilkanfilter'])){
					if($_POST['tampilkanfilter'] == "tampil"){
						$mm .= $filtmp;
					}
				}
				$mm .= " order by c.nm_tind ASC, b.det_nm_pemeriksaan ASC limit ".$offset .", ". $rows;
				$cc = $this->db->query($mm);
				$dd = $cc->result();
				if($dd){
					foreach($dd as $op){
						$nnn = new stdClass();
						$ggs = 'checked="true"';
						if($cek[$op->id_tind][$op->id_pem]){
							$ggs = '';
						}
						$nnn->centang 			= '<input type="checkbox" '.$ggs.' onclick="masukkandaftarfilter(\''.$_GET['kodetransaksi'].'\', \''.$op->id_tind.'\', \''.$op->id_ins_tind.'\', \''.$op->id_pem.'\')">';
						$nnn->new_namapemeriksaan = $op->nm_tind;
						$nnn->new_kodepemeriksaan = $op->kd_tind;
						if($op->id_ins_tind == "2"){
							$nnn->new_detailpemeriksaan = $op->nm_pem;
						} else if($op->id_ins_tind == "3"){
							$nnn->new_detailpemeriksaan = $op->rad_namapemeriksaan;
						}else {
							$nnn->new_detailpemeriksaan = $op->det_nm_pemeriksaan;
						}
						$ding[] = $nnn;
					}
				}
		}else {
			$ding = array();
		}
			$object = new stdClass();
			$object->total = 500;
			$object->rows = $ding;
			print_r (json_encode($object));
	//print_r($ding);
?>