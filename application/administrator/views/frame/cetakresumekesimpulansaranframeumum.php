<?php
	$dismm = "";
	$BODYBACK = "background:#777777";
	if($_GET['hidecetakdanjangantampiltombol']){
		$dismm = 'style="display:none"';
		$BODYBACK = "background:#FFFFFF";
?>
<?php } ?>
<?php if(!$_GET['hidecetakdanjangantampiltombol'] AND !$_GET['noprint']){ ?>
<script type="text/javascript">
	window.print();
</script>
<?php } ?>
<div <?=@$dismm?>>
<?php
	$dfr = "select a.keluhan_utama, a.no_reg, a.tgl_awal_reg, a.kode_transaksi, a.no_filemcu, c.kawin_pas, c.nm_pas, c.bangsa_pas, c.pangkat_pas, c.jenkel_pas, c.alamat_pas, c.no_tlp_pas, c.nip_nrp_nik, c.nm_pekerjaan, c.gol_darah, c.jabatan_pas, c.tgl_lhr_pas, c.tmp_lahir_pas, d.nm_jawatan, nm_dinas ";
	$dfr .= " from tb_register a, tb_pasien c, tb_jawatan d, tb_dinas e ";
	$dfr .= " where a.no_reg=c.no_reg and c.id_jawatan=d.id_jawatan and c.id_dinas=e.id_dinas ";
	$dfr .= " and a.kode_transaksi='".clean_data($_GET['kode_transaksi'])."' limit 1 ";
	$sbd = $this->db->query($dfr);
	$abs = $sbd->row();
	
	//ambil riwayattttt
	$gsvbbs = "select hasilnya, nama_pemeriksaan_khusus from tb_register_detailpemeriksaan where apakah_riwayat='Y' and kode_transaksi='".clean_data($_GET['kode_transaksi'])."' ";
	$gsvbas = $this->db->query($gsvbbs);
	$generateriwayat = $gsvbas->result();
	//print_r($generateriwayat);
	foreach($generateriwayat as $loopriwayat){
		$explopriwayat = explode("___", $loopriwayat->nama_pemeriksaan_khusus);
		$getcek[$explopriwayat[0]][$explopriwayat[1]] = 'checked="true"';
		$getcekisiok[$explopriwayat[0]][$explopriwayat[1]] = $loopriwayat->hasilnya;
	}
	//print_r($getcekisiok);
	//print_r($checklistriwayat);
	//die();
	
	$getAnamnesa = $abs->keluhan_utama;
	$rere = $this->madmin->Get_setting('get_ketgigi');
	$mama = explode(", ", $rere);	
	foreach($mama as $tdtdd){
		$sjjsia = explode("*", $tdtdd);
		$kelainangigi[$sjjsia[1]] = $sjjsia[0];
	}
	//print_r($kelainangigi);
					$hdvs = "select riwayat_kesehatan_pasien, riwayat_kesehatan_keluarga from tb_pasien where no_reg='".$abs->no_reg."' limit 1";
					$amnp = $this->db->query($hdvs);
					$dfrs = $amnp->result();
					//print_r($dfrs);
					if($dfrs){
						$val3 = $dfrs[0]->riwayat_kesehatan_pasien;
						$val4 = $dfrs[0]->riwayat_kesehatan_keluarga;
					}
					//ambil untuk struktur gigi
						$jkjkbs = "select hasilnya, posisi_struktur_gigi from tb_register_detailpemeriksaan where 1=1 and kode_transaksi='".$_GET['kode_transaksi']."' and apakah_struktur_gigi='Y' ";
						$kjhjgh = $this->db->query($jkjkbs);
						$hjfgbj = $kjhjgh->result();
						if($hjfgbj){
							foreach($hjfgbj as $jhjass){
								$getpemgigi[$jhjass->posisi_struktur_gigi] = $jhjass->hasilnya;
							}
						}
	$shc = "select hasilnya, nama_pemeriksaan_khusus  from tb_register_detailpemeriksaan where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."' ";
	$sgd = $this->db->query($shc);
	$dgs = $sgd->result();
	if($dgs){
		foreach($dgs as $bd){
			$pemkss[$bd->nama_pemeriksaan_khusus] = $bd->hasilnya;
		}
	}
					
	//ambil data resumnya yaaa
	$oiu = "select * from tb_resume_pasien where  kode_transaksi='".clean_data($_GET['kode_transaksi'])."'  and (ket_resume='anamnesa' OR ket_resume='kesimpulansaran' OR ket_resume='periksatambahan' OR ket_resume='diagnosakelainan') ";
	$aew = $this->db->query($oiu);
	$mdn = $aew->result();
	//print_r($oiu);
	if($mdn){
		foreach($mdn as $sa){
			if($sa->ket_resume == "anamnesa"){
				
			}
			if($sa->ket_resume == "kesimpulansaran"){
				$kesansaran[$sa->nama_kesansaran] = $sa->isi_kesansaran;
			}
			if($sa->ket_resume == "periksatambahan"){
				$gettambah[$sa->nama_kelainan] = $sa->isi_kelainan;
			}
			if($sa->ket_resume == "diagnosakelainan"){
				$getinbody[$sa->nama_kelainan] = $sa->isi_kelainan;
			}
		}
		
	}
	$sga = "select a.kesantext, a.val_stakes, b.id_tind, b.kd_tind, b.nm_tind, b.id_ins_tind, b.set_struktur_gigi, b.stakes_tindakan, d.set_stakes, d.id_ins, d.nm_ins, d. in_english_ins, d.order_ins, d.order_evaluasi, e.nm_grouptindakan, e.order_evalusi_group, e.kd_grouptindakan, e.en_english_group from  tb_register_pemeriksaan a, tb_tindakan b, tb_instalasi d, tb_grouptind e ";
	$sga .= "where a.id_tind_pem=b.id_tind and b.id_ins_tind=d.id_ins and b.kd_grouptind=e.kd_grouptindakan ";
	$sga .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' ";
	$sfc = $this->db->query($sga);
	$ash = $sfc->result();
	//print_r($ash);
	if($ash){
		foreach($ash as $bs){
			//pertama adalah buat barisnya yaaaaa
			//yang pasti bedakan page kanan dan kiriiii yaaaaa
			//intine page 1 tek buat fix kaya asline
			$hsbb = "select a.adakelainan, a.hasilnya, a.ketkelainanlainnya, c.id_pem, c.det_nm_pemeriksaan, c.rad_namapemeriksaan, c.nm_pem, c.kd_pem, c.det_order_pemeriksaan, c.satuan, c.nilai_rujukan, c.in_english_pem, c.setheader_lab, d.id_ins from tb_register_detailpemeriksaan a, tb_pemeriksaan c, tb_instalasi d ";
			$hsbb .= "where a.id_pem_deb=c.id_pem  and a.id_ins_tind_detpem=d.id_ins ";
			$hsbb .= "and a.kode_transaksi='".$_GET['kode_transaksi']."' and a.id_paket='".$_GET['id_paket']."' and a.id_tind_detpem='".$bs->id_tind."' and a.apakah_pemeriksaan_khusus <> 'Y' and a.apakah_struktur_gigi <> 'Y' and d.type_ins <> 'L' order by c.kd_pem ASC ";
			$ansd = $this->db->query($hsbb);
			$ssv = $ansd->result();
			$nminsnya = strtoupper(str_replace("Poliklinik", "Pemeriksaan", $bs->nm_ins));
			$nameeng = "";
			if($bs->in_english_ins != ""){
				$nameeng = '<br/><span style="border-top:solid 1px #000000;padding:0;">'.$bs->in_english_ins.'</span>';
			}
			$nameengradseng = "";
			if($bs->en_english_group != ""){
				$nameengradseng = '<br/><span style="border-top:solid 1px #000000;padding:0;">'.$bs->en_english_group.'</span>';
			}
			if($bs->id_ins == "2"){
				$pages[$bs->order_evaluasi] = '
					<table width="100%" style="0;font-size:11px;font-family: arial;" cellpadding="1px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>'.$nminsnya.'</span>'.$nameeng.'</h3>
											</div></td>
										</tr>
									</table>
				';
					$pages1[$bs->order_evaluasi][$bs->kd_grouptindakan] = '
						<table width="100%" style="0;font-size:11px;font-family: arial;margin-top:10px;" cellpadding="1px">
										<tr>
											<td colspan="3"><b>
												<span>'.strtoupper($bs->nm_grouptindakan).'</span>'.$nameengradseng.'
											</b></td>
										</tr>
									</table>
					';
					foreach($ssv as $hsd){
						
						$bintangtang = "";
						$lainwarnbld = "";
						if($hsd->adakelainan == "Y"){
							$bintangtang = "*";
							$lainwarnbld = 'style="font-weight:bold;"';
						}
						
						
						if($hsd->nm_pem == "HITUNG JENIS"){
							$hsd->nm_pem = "<br /><b>". $hsd->nm_pem ."</b>";
						}
						if($hsd->nm_pem == "Monosit"){
							$hsd->nm_pem = $hsd->nm_pem;
						}
						if($hsd->satuan == "-"){
							$hsd->satuan = "";
						}
						$gshnv = "";
						if($hsd->in_english_pem != ""){
							$gshnv = '<br/><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>'.$hsd->in_english_pem.'</i></span>';
						}
						$titikdua = "";
						if($hsd->setheader_lab == ""){
							$titikdua = ":";
						}
						$pages2[$bs->order_evaluasi][$bs->kd_grouptindakan][$bs->kd_tind][$hsd->kd_pem] = '
										<table width="100%" style="0;font-size:11px;font-family: arial;border:solid 0PX;margin:0;padding:0;">
												<tr>
													<td style="padding:3px;width:40%"><span>'. $hsd->nm_pem.'</span>'.$gshnv.'</td>
													<td width="1%">'.$titikdua.'</td>
													<td style="padding:3px;"><span '.$lainwarnbld.'>'.$hsd->hasilnya.$bintangtang.'</span></td>
													<td style="padding:3px;width:30%"><div align="right"><span>'.$hsd->nilai_rujukan .'</span></div></td>
												</tr>
									</table>
						';
					}
			}else if($bs->id_ins == "3"){
				//buat men radiologi nang ngisor dewek yaaaaa
				$shag = $bs->order_evalusi_group+20;
				$loopsdatabeb[$shag] = '
					<table width="100%" style="0;font-size:11px;font-family: arial;" cellpadding="1px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>'.strtoupper($bs->nm_grouptindakan).'</span>'.$nameengradseng.'</h3>
											</div></td>
										</tr>
									</table>
				';
				foreach($ssv as $hsd){
					$gshnv = "";
					if($hsd->in_english_pem != ""){
						$gshnv = '<br/><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>'.$hsd->in_english_pem.'</i></span>';
					}
					$loopsdatabeb1[$shag][$hsd->det_order_pemeriksaan] = '
						<table width="100%" style="0;font-size:11px;font-family: arial;border:solid 0PX;margin:0;padding:0;">
												<tr>
													<td style="padding:3px;width:40%"><span>'. $hsd->rad_namapemeriksaan.'</span>'.$gshnv.'</td>
													<td width="1%">:</td>
													<td style="padding:3px;"><span>'. $hsd->hasilnya.'</span></td>
												</tr>
						</table>
					';
				}
			}else {
				$loopsdatabeb[$bs->order_evaluasi] = '
					<table width="100%" style="0;font-size:11px;font-family: arial;" cellpadding="1px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>'.$nminsnya.'</span>'.$nameeng.'</h3>
											</div></td>
										</tr>
									</table>
				';
				//nah disini kita ambil struktur gigi kalau ada
				if($bs->set_struktur_gigi == "Y"){
							
					$this->db->select("posisi_struktur_gigi, warna_kelainan_gigi, hasilnya, id_reg_detpem");
					$this->db->where("kode_transaksi", $_GET['kode_transaksi']);
					$this->db->where("apakah_struktur_gigi", "Y");
					$jshdc = $this->db->get("tb_register_detailpemeriksaan");
					$nhdsv = $jshdc->result();
					foreach($nhdsv as $gdgl){
						if(!empty($gdgl->warna_kelainan_gigi)){
							$getkelainan[$gdgl->posisi_struktur_gigi] = $gdgl->warna_kelainan_gigi;
							$loopkelainan[$gdgl->posisi_struktur_gigi] = $gdgl;
						}
					}
					//print_r($getkelainan);

					$strukturgigikiri = array(
					'18' => array('id' => 18, 'transfom' => '0,0'),
					'17' => array('id' => 17, 'transfom' => '25,0'),
					'16' => array('id' => 16, 'transfom' => '50,0'),
					'15' => array('id' => 15, 'transfom' => '75,0'),
					'14' => array('id' => 14, 'transfom' => '100,0'),
					'13' => array('id' => 13, 'transfom' => '125,0'),
					'12' => array('id' => 12, 'transfom' => '150,0'),
					'11' => array('id' => 11, 'transfom' => '175,0'),
					'55' => array('id' => 55, 'transfom' => '75,40'),
					'54' => array('id' => 54, 'transfom' => '100,40'),
					'53' => array('id' => 53, 'transfom' => '125,40'),
					'52' => array('id' => 52, 'transfom' => '150,40'),
					'51' => array('id' => 51, 'transfom' => '175,40'),
					'85' => array('id' => 85, 'transfom' => '75,80'),
					'84' => array('id' => 84, 'transfom' => '100,80'),
					'83' => array('id' => 83, 'transfom' => '125,80'),
					'82' => array('id' => 82, 'transfom' => '150,80'),
					'81' => array('id' => 81, 'transfom' => '175,80'),
					'48' => array('id' => 48, 'transfom' => '0,120'),
					'47' => array('id' => 47, 'transfom' => '25,120'),
					'46' => array('id' => 46, 'transfom' => '50,120'),
					'45' => array('id' => 45, 'transfom' => '75,120'),
					'44' => array('id' => 44, 'transfom' => '100,120'),
					'43' => array('id' => 43, 'transfom' => '125,120'),
					'42' => array('id' => 42, 'transfom' => '150,120'),
					'41' => array('id' => 41, 'transfom' => '175,120'),
				);



				$strukturgigikanan = array(
					'21' => array('id' => 21, 'transfom' => '210,0'),
					'22' => array('id' => 22, 'transfom' => '235,0'),
					'23' => array('id' => 23, 'transfom' => '260,0'),
					'24' => array('id' => 24, 'transfom' => '285,0'),
					'25' => array('id' => 25, 'transfom' => '310,0'),
					'26' => array('id' => 26, 'transfom' => '335,0'),
					'27' => array('id' => 27, 'transfom' => '360,0'),
					'28' => array('id' => 28, 'transfom' => '385,0'),
					'61' => array('id' => 61, 'transfom' => '210,40'),
					'62' => array('id' => 62, 'transfom' => '235,40'),
					'63' => array('id' => 63, 'transfom' => '260,40'),
					'64' => array('id' => 64, 'transfom' => '285,40'),
					'65' => array('id' => 65, 'transfom' => '310,40'),
					'71' => array('id' => 71, 'transfom' => '210,80'),
					'72' => array('id' => 72, 'transfom' => '235,80'),
					'73' => array('id' => 73, 'transfom' => '260,80'),
					'74' => array('id' => 74, 'transfom' => '285,80'),
					'75' => array('id' => 75, 'transfom' => '310,80'),
					'31' => array('id' => 31, 'transfom' => '210,120'),
					'32' => array('id' => 32, 'transfom' => '235,120'),
					'33' => array('id' => 33, 'transfom' => '260,120'),
					'34' => array('id' => 34, 'transfom' => '285,120'),
					'35' => array('id' => 35, 'transfom' => '310,120'),
					'36' => array('id' => 36, 'transfom' => '335,120'),
					'37' => array('id' => 37, 'transfom' => '360,120'),
					'38' => array('id' => 38, 'transfom' => '385,120'),
				);
				$pict1 = array(
					'C' => '5,5 	15,5 	15,15 	5,15',
					'T' => '0,0 	20,0 	15,5 	5,5',
					'B' => '5,15 	15,15 	20,20 	0,20',
					'R' => '15,5 	20,0 	20,20 	15,15',
					'L' => '0,0 	5,5 	5,15 	0,20',
				);




				$pict2 = array(
					'C' => '4,4 	12,4 	12,12 	4,12',
					'T' => '0,0 	16,0 	12,4 	4,4',
					'B' => '4,12 	12,12 	16,16 	0,16',
					'R' => '12,4 	16,0 	16,16 	12,12',
					'L' => '0,0 	4,4 	4,12 	0,16',
				);

				$lokasibesar = array(
					'C' => 'x="8" y="12" ',
					'T' => 'x="8" y="4"  ',
					'B' => 'x="7" y="19"  ',
					'R' => 'x="15" y="12" ',
					'L' => 'x="-1" y="12" ',
				);

				$lokasikecil = array(
					'C' => 'x="5" y="9" ',
					'T' => 'x="5" y="3"  ',
					'B' => 'x="5" y="16"  ',
					'R' => 'x="12" y="9" ',
					'L' => 'x="0" y="9" ',
				);

							
					$sltttt = '<div id="svgselect" style="width: 100%;">
						<svg version="1.1" width="100%">
							<g transform="scale(0.7)" id="gmain">';
							foreach($strukturgigikiri as $vllok){ 
								$sltttt .= '<g id="P'.$vllok['id'].'" transform="translate('.$vllok['transfom'].')">';
									$pict = $pict1;
									$lokasi = $lokasibesar;
									$ukuran = "4pt";
									if($vllok['id'] > 50){
										$ukuran = "3pt";
										$lokasi = $lokasikecil;
										$pict = $pict2;
									}
								foreach($pict as $kjj => $gsfs){ 
										$warnaku = "";
										$kods = "P".$vllok['id']."-". $kjj;
										if(isset($getkelainan[$kods])){
											$warnaku = $getkelainan[$kods];
										}
									$sltttt .= '<polygon points="'.@$gsfs.'" fill="white" stroke="navy" stroke-width="0.5" id="'.@$kjj.'" opacity="1"></polygon>';
									$sltttt .= '<text '.$lokasi[$kjj].' stroke="red" fill="red" stroke-width="0.1" style="font-size: '.@$ukuran.';font-weight:normal;color:red;text-align:center">'.@$warnaku.'</text>';
								} 
									$sltttt .= '<text x="6" y="30" stroke="navy" fill="navy" stroke-width="0.1" style="font-size: 6pt;font-weight:normal">'.@$vllok['id'].'</text>
								</g>';
								}
								
								foreach($strukturgigikanan as $vllok){ 
								$sltttt .= '<g id="P'.$vllok['id'].'" transform="translate('.$vllok['transfom'].')">';
									$pict = $pict1;
									$lokasi = $lokasibesar;
									$ukuran = "4pt";
									if($vllok['id'] > 50){
										$ukuran = "3pt";
										$lokasi = $lokasikecil;
										$pict = $pict2;
									}
								foreach($pict as $kjj => $gsfs){ 
										$warnaku = "";
										$kods = "P".$vllok['id']."-". $kjj;
										if(isset($getkelainan[$kods])){
											$warnaku = $getkelainan[$kods];
										}
									$sltttt .= '<polygon points="'.@$gsfs.'" fill="white" stroke="navy" stroke-width="0.5" id="'.@$kjj.'" opacity="1"></polygon>';
									$sltttt .= '<text '.$lokasi[$kjj].' stroke="red" fill="red" stroke-width="0.1" style="font-size: '.@$ukuran.';font-weight:normal;color:red;text-align:center">'.$warnaku.'</text>';
								} 
									$sltttt .= '<text x="6" y="30" stroke="navy" fill="navy" stroke-width="0.1" style="font-size: 6pt;font-weight:normal">'.@$vllok['id'].'</text>
								</g>';
								}
								
								
								
							$sltttt .='</g>
							</svg>
						</div>';
					$loopsdatabeb1[$bs->order_evaluasi]['pemeriksaangigi'] = $sltttt;
				}
				foreach($ssv as $hsd){
					$gshnv = "";
					if($hsd->in_english_pem != ""){
						$gshnv = '<br/><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>'.$hsd->in_english_pem.'</i></span>';
					}
					$gethasilopt = $hsd->hasilnya;
					if(!empty($hsd->ketkelainanlainnya)){
						$gethasilopt = $hsd->ketkelainanlainnya;
					}
					$loopsdatabeb1[$bs->order_evaluasi][$hsd->det_order_pemeriksaan] = '
						<table width="100%" style="0;font-size:11px;font-family: arial;border:solid 0PX;margin:0;padding:0;">
												<tr>
													<td style="padding:3px;width:40%"><span>'. $hsd->det_nm_pemeriksaan .'</span>'.$gshnv.'</td>
													<td width="1%">:</td>
													
													<td style="padding:3px;"><span>'. $gethasilopt.'</span></td>
												</tr>
						</table>
					';
				}
				
			}
		}
	}
	
	//print_r($loopsdatabeb1);
	ksort($loopsdatabeb);
	foreach($loopsdatabeb as $sgd => $sbd){
		ksort($loopsdatabeb1[$sgd]);
		if($sgd != 1){
			if(is_array($loopsdatabeb1[$sgd])){
				$ayolooping[] = $sbd;
			}
		}
		foreach($loopsdatabeb1[$sgd] as $bsj => $basd){
			$ayolooping[] = $basd;
		}
		
	}
	
	//saatnya looping lab
	//print_r($pages);
	foreach($pages as $hdddcdcg => $sbvjgbsj){
		$newloplab[] = $sbvjgbsj;
		foreach($pages1[$hdddcdcg] as $jkhgjhg => $hjvgjkhvh){
			$newloplab[] = $hjvgjkhvh;
			foreach($pages2[$hdddcdcg][$jkhgjhg] as $kgljhfhgfgh => $jhgfffd){
				foreach($jhgfffd as $balibalik){
					$newloplab[] = $balibalik;
				}
			}
		}
	}
	//looping akhir dan finishing dab
	$de = 1;
	$do = 1;
	$finishkesel = array_merge($ayolooping, $newloplab);
	//print_r($finishkesel);
	foreach($finishkesel as $nsd){
		$sgl = $de++;
		$totlop[$do] = 'sahudbabivalueloopingdinamiictembeleksinga';
		$broloping[$do][] = $nsd;
		//kie nggo mbagi perhalamane yaaaaaaaaaaaa
		if($sgl == 13){
			$de = 1;
			$do++;
		}
		
	}
	$totlop[] = 'sahudbabivalueloopingdinamiictembeleksinga';
	$broloping[][0] =   '<div style="padding:3px;">
							<h3 style="font-size:15px;font-weight:bold;margin-top:0px;"><span style="border-bottom:solid 2px #000000;padding:0;">PEMERIKSAAN TAMBAHAN</span></h3>
						</div>
						<table width="100%" style="font-size:11px;font-family: arial;" cellpadding="1px">
							<tr>
								<td></td>
								<td width="30%" style="padding:3px;">Chamber Flight<td>
								<td style="padding:3px;">:</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td style="padding:3px;">Psikologi<td>
								<td style="padding:3px;">:</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td style="padding:3px;">Psikiatri<td>
								<td style="padding:3px;">:</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td style="padding:3px;">Kesamaptaan<td>
								<td style="padding:3px;">:</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td style="padding:3px;">Inbody<td>
								<td style="padding:3px;">:</td>
								<td></td>
							</tr>
						</table>';
	
	$countloping = count($totlop);
	
?>
<style>
#tablenya {
	border:0px;
}
#tablenya td{
	border-left:1px solid;
	padding:1px;
}
#tablenya th{
	border-top:1px solid;
	border-bottom:1px solid;
}
td{
	vertical-align:top;
	
}
</style>
<style>
	body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        font: 12pt "Helvetica";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
	.breaks{
		page-break-after: auto;
	}
    .page {
        width: 8.5in;
        padding: 5mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        background: white;
        box-shadow: 5px 5px 5px #222222;
    }
    @media print {
        html, body {
            width: 8.27in;
            min-height: 3.69in;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
			box-shadow: 5px 5px 5px #222222;
        }
		.breaks{
			page-break-after: auto;
		}	
    }
	@page {
        size: 8.27in;
        margin: 0;
    }
	div.page { page-break-after: always }
	</style>



<html>
	<head>
		<link rel="stylesheet" href="<?=@base_url('template')?>/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="<?=@base_url('template')?>/dist/css/ionicons.min.css">-->
		<link rel="stylesheet" href="<?=@base_url('template')?>/plugins/datatables/dataTables.bootstrap.css">
	</head>
	<body style="<?=@$BODYBACK?>;">
	<div class="container">
		<div class="book">
			<?php 
				if($_GET['coverpage']){
					//halaman cover ya bray
			?>
				<div class="page">
					<div style="<?=@get_ukuran_buku('kecil')?>;">
						<table width="100%" style="margin:0;font-size:11px;font-family: arial;" cellpadding="1px">
							<tr>
								<td width="50%">
									
								</td>
								<td width="50%">
									<div style="padding:5px;">
										<div align="center" style="margin-top:395px;">
											<div style="margin:10% 0 0 0;border:solid 0px #000000;width:100%;font-size:11px;padding:0px;border-radius:0px;"><b><?=@$abs->nm_pas?></b></div>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<?php } ?>
			<?php 
				$f = range(1,5);
				$akhirpage = 5;
				if($f){ 
					$nm = 1;
					foreach($f as $val){
					$um = $nm++;
			?>
			<?php if($_GET['viewpage'][$um]){ ?>
			<div class="page">
				<div style="<?=@get_ukuran_buku('kecil')?>;">
					<table width="100%" style="margin:0;font-size:11px;font-family: arial;" cellpadding="1px">
						<tr>
							<td width="50%">
								
							</td>
							<td width="40%">
								<div style="padding:5px;">
								<?php if($um == "1"){ ?>
									<table width="100%" style="0;font-size:11px;font-family: arial;" cellpadding="1px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>IDENTITAS</span><br/>
												<span style="border-top:solid 1px #000000;padding:0 5px 0 5px;">IDENTITY</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="0;font-size:11px;font-family: arial;border:solid 1px #000000" cellpadding="1px">
										<tr>
											<td style="padding:3px;" colspan="3"><span>Nama</span> : <?=@$abs->nm_pas?><br/><span style="border-top:solid 1px #000000;padding:0;"><i>Name</i></span></td>
											<td style="border-left:solid 1px #000000;padding:3px;text-align:center;width:23%"><span>Kelamin</span><br/><span style="border-top:solid 1px #000000;padding:0 10px 0 10px;">Sex</span><br /><?=@is_jenkel($abs->jenkel_pas)?></td>
										</tr>
										<tr style="border-top:1px solid #000000;">
											<td style="padding:3px;width:40%"><span>Tempat & Tgl.Lahir</span><br/><span style="border-top:solid 1px #000000;padding:0;"><i>Place & Date of Birth</i></span></td>
											<td width="1%">:</td>
											<td style="padding:3px;" colspan="3"><?=@$abs->tmp_lahir_pas?>,<br /><?=@the_time(date("Y-m-d", strtotime($abs->tgl_lhr_pas)))?></td>
										</tr>
										<tr style="border-top:1px solid #000000;">
											<td style="padding:3px;width:40%"><span>Kesatuan/Pekerjaan</span><br/><span style="border-top:solid 1px #000000;padding:0;"><i>Occupation</i></span></td>
											<td width="1%">:</td>
											<td style="padding:3px;" colspan="3"><?=@$abs->nm_pekerjaan?></td>
										</tr>
										<tr style="border-top:1px solid #000000;">
											<td style="padding:3px;width:40%"><span>Status Perkawinan</span><br/><span style="border-top:solid 1px #000000;padding:0 35px 0 0;"><i>Marital State</i></span></td>
											<td width="1%">:</td>
											<td style="padding:3px;" colspan="3"><?=@$abs->kawin_pas?></td>
										</tr>
										<tr style="border-top:1px solid #000000;">
											<td style="padding:3px;width:40%"><span>Alamat Rumah/Telpon</span><br/><span style="border-top:solid 1px #000000;padding:0 25px 0 0;"><i>Residence/Phone</i></span></td>
											<td width="1%">:</td>
											<td style="padding:3px;" colspan="3"><?=@$abs->alamat_pas?></td>
										</tr>
										<tr style="border-top:1px solid #000000;">
											<td style="padding:3px;width:40%"><span>Alamat Pemberitahuan</span><br/><span style="border-top:solid 1px #000000;padding:0 50px 0 0;"><i>Report/Adress</i></span></td>
											<td width="1%">:</td>
											<td style="padding:3px;" colspan="3">Telp. <?=@$abs->no_tlp_pas?></td>
										</tr>
										<tr style="border-top:1px solid #000000;">
											<td style="padding:3px;width:40%"><span>Kebangsaan</span><br/><span style="border-top:solid 1px #000000;padding:0 15px 0 0;"><i>Nationality</i></span></td>
											<td width="1%">:</td>
											<td style="padding:3px;" colspan="3"><?=@$abs->bangsa_pas?></td>
										</tr>
										<tr style="border-top:1px solid #000000;">
											<td style="padding:3px;width:40%"><span>Tanggal Periksa</span><br/><span style="border-top:solid 1px #000000;padding:0;"><i>Date of Examination</i></span></td>
											<td width="1%">:</td>
											<td style="padding:3px;" colspan="3"><?=@date("d/m/Y", strtotime($abs->tgl_awal_reg))?></td>
										</tr>
										<tr style="border-top:1px solid #000000;">
											<td style="padding:3px;width:40%"><span>No Arsip</span><br/><span style="border-top:solid 1px #000000;padding:0;"><i>File Number</i></span></td>
											<td width="1%">:</td>
											<td style="padding:3px;" colspan="3"><?=@$abs->no_filemcu?></td>
										</tr>
									</table>
								<?php } else if($um == "2") { ?>
									<table width="100%" style="0;font-size:11px;font-family: arial;" cellpadding="1px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>KESIMPULAN</span><br/>
												<span style="border-top:solid 1px #000000;padding:0 10px 0 10px;">SUMMARY</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="0;font-size:11px;font-family: arial;border:solid 0PX;height:8cm;">
										<tr >
											<td>
												<?php
													//$kesansaran['kesimpulan_saran']
												?>
												<?php
													//print_r($kesansaran);
													$dddd = unserialize($kesansaran['kesimpulan']);
													//$eeee = unserialize($kesansaran['detailsaran']);
												?>
												<table width="100%" style="font-size:11px;font-family: arial;margin:0;">
													<?php 
														foreach(range(1,10) as $gsdd){ 
															if($dddd[$gsdd] != ""){
													?>
													<tr>
														<td width="1%" style="padding:2px;"><?=@$gsdd?>. </td>
														<td style="padding:2px;"><?=@$dddd[$gsdd]?></td>
													</tr>
														<?php } ?>
													<?php } ?>
												</table>
											</td>
										</tr>
									</table>
								<?php } else if($um == "3") { ?>
									<table width="100%" style="0;font-size:11px;font-family: arial;" cellpadding="1px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>SARAN</span><br/>
												<span style="border-top:solid 1px #000000;padding:0;">SUGGESTION</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="0;font-size:11px;font-family: arial;border:solid 0PX;height:8cm;">
										<tr >
											<td>
												<?php
													//print_r(unserialize($kesansaran['kesimpulan']));
												?>
												<?php
													$mcnsd = unserialize($kesansaran['kesimpulan']);
													$dsdsr = unserialize($kesansaran['saran']);
													$sfghs = unserialize($kesansaran['detailsaran']);
													//print_r($sfghs);
													if($mcnsd['atas'] != ""){
														echo "".$mcnsd['atas']."<br /><br />";
													}
													
												?>
												<table width="100%" style="font-size:11px;font-family: arial;margin:0;">
													<?php 
														foreach(range(1,10) as $gsdd){ 
															if($dsdsr[$gsdd] != "" OR $sfghs[$gsdd] != ""){
																$isisaraneok = $dsdsr[$gsdd];
																if(!empty($sfghs[$gsdd])){
																	$isisaraneok .= ": ". $sfghs[$gsdd];
																}
													?>
													<tr>
														<td width="1%" style="padding:2px;"><?=@$gsdd?>. </td>
														<td style="padding:2px;"><?=@$isisaraneok?></td>
													</tr>
														<?php } ?>
													<?php } ?>
												</table>
												<?php
													//print_r($sfghs);
													if($mcnsd['bawah'] != ""){
														echo "<br /><br />".$mcnsd['bawah']."";
													}
												?>
											</td>
										</tr>
									</table>
									<table width="100%" style="font-size:12.5px;">
										<td></td>
										<td width="20%"></td>
													<td>
														<div align="center">
															<?php
																	//ambil nama penanggung jawab kodde KALA
																	$this->db->where('kd_dok', 'KADEP');
																	$kklids = $this->db->get('tb_dokter');
																	$sghdfs = $kklids->row();
																?>
															KETUA TIM EVALUASI<br/><br/><br/><br/><br/><?=@$sghdfs->nm_dok?><br /><?=@$sghdfs->pangkat?>
														</div>
													</td>
									</table>
								<?php } else if($um == "4") { ?>
									<table width="100%" style="0;font-size:11px;font-family: arial;" cellpadding="1px">
										<tr>
											<td colspan="3"><div align="center">
												<h3 style="font-size:15px;font-weight:bold;"><span>RIWAYAT KESEHATAN</span><br/>
												<span style="border-top:solid 1px #000000;padding:0 50px 0 50px;">HISTORY</span></h3>
											</div></td>
										</tr>
									</table>
									<table width="100%" style="0;font-size:11px;font-family: arial;border:solid 0PX;">
										<tr>
											<td style="padding:3px;width:30%"><span>Keluhan Utama</span><br/><span style="border-top:solid 1px #000000;padding:0;"><i>Chief Complaint</i></span></td>
											<td width="1%">:</td>
											<td><?=@$getAnamnesa?></td>
										</tr>
									</table>
									<table width="100%" style="0;font-size:11px;font-family: arial;border:solid 0PX;margin:10px 0 0 0">
										<tr>
											<td colspan="6" style="padding:0 0 5px 0;"><span>Penyakit yang pernah diderita :</span><br/><span style="border-top:solid 1px #000000;padding:0 100px 0 0"><i>Past History</i></span></td>
										</tr>
										<tr>
											<?php
												$sasc = 1;
												foreach(is_penyakit_lama() as $gsf => $sgd){ 
												$trsa = $sasc++;
												$jufd = "";
												$sgshbx = '<img src="'.base_url('assets/img/cekdua.png').'" style="width:14px;">';
												if($getcek['riwayatpasien'][$gsf]){
													$sgshbx = '<img src="'.base_url('assets/img/ceksatu.png').'" style="width:14px;">';
												}
												
											?>
												<td width="5%" style="vertical-align:middle"><?=@$sgshbx?></td>
												<td width="30%"><span><?=@$gsf?></span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0"><i><?=@$sgd?></i></span></td>
											<?php 
												if($trsa > 2){
													$sasc = 1;
													echo "</tr><tr>";
												}
											} ?>
												<td colspan="4"><?=@$getcekisiok['riwayatpasien']['Lainnya'] != "" ? ": ". $getcekisiok['riwayatpasien']['Lainnya'] : ""?></td>
											</tr>
											<tr>
												<td colspan="6" style="padding:10px 0 0 0;">Penjelasan : <?=@$val3?></td>
											</tr>
									</table>
									<table width="100%" style="0;font-size:11px;font-family: arial;border:solid 0PX;margin:10px 0 0 0">
										<tr>
											<td colspan="6" style="padding:0 0 5px 0;"><span>Penyakit Keluarga :</span><br/><span style="border-top:solid 1px #000000;padding:0 20px 0 0"><i>Family History</i></span></td>
										</tr>
										<tr>
											<?php
												$sasc = 1;
												//print_r($getcek);
												foreach(is_penyakit_keluarga() as $gsf => $sgd){ 
												$trsa = $sasc++;
												$jufd = "";
												if($getcek['riwayatkeluarga'][$gsf]){
													$jufd = 'checked="true"';
												}
												$sgshbsg = '<img src="'.base_url('assets/img/cekdua.png').'" style="width:14px;">';
												if($getcek['riwayatkeluarga'][$gsf]){
													$sgshbsg = '<img src="'.base_url('assets/img/ceksatu.png').'" style="width:14px;">';
												}
											?>
												<td width="5%" style="vertical-align:middle"><?=@$sgshbsg?></td>
												<td width="30%"><span><?=@$gsf?></span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0"><i><?=@$sgd?></i></span></td>
											<?php 
												if($trsa > 3){
													$sasc = 1;
													echo "</tr><tr>";
												}
											} ?>
												<td colspan="6"><?=@$getcekisiok['riwayatkeluarga']['Lainnya'] != "" ? ": ". $getcekisiok['riwayatkeluarga']['Lainnya'] : ""?></td>
											</tr>
											<tr>
												<td colspan="8" style="padding:10px 0 0 0;">Penjelasan : <?=@$val4?></td>
											</tr>
									</table>
									<?php } else if($um == "5") { ?>
										<table width="100%" style="0;font-size:11px;font-family: arial;" cellpadding="1px">
											<tr>
												<td colspan="3"><div align="center">
													<h3 style="font-size:15px;font-weight:bold;"><span>PEMERIKSAAN UMUM</span><br/>
													<span style="border-top:solid 1px #000000;padding:0;">PHYSICAL EXAMINATION</span></h3>
												</div></td>
											</tr>
										</table>
										<table width="125%" style="0;font-size:11px;font-family: arial;border:solid 0PX;">
											<tr>
												<td style="padding:1px;width:40%"><span>Tinggi Badan</span><br/><span style="border-top:solid 1px #000000;padding:0 36px 0 0;"><i>Height</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['tinggibadan']?></td>
												<td style="padding:1px;">cm</td>
												<td style="padding:1px;" width="20%"></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>Berat Badan</span><br/><span style="border-top:solid 1px #000000;padding:0 29px 0 0;"><i>Weight</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['beratbadan']?></td>
												<td style="padding:1px;">kg</td>
												<td style="padding:1px;"></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>Berat Badan Ideal</span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>Ideal Body Weight</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['beratbadanideal']?></td>
												<td style="padding:1px;">kg</td>
												<td style="padding:1px;"></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>Berat Badan Minimal</span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>Minimal Body Weight</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['beratbadanmin']?></td>
												<td style="padding:1px;">kg</td>
												<td style="padding:1px;"></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>Berat Badan Maksimal</span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>Maximal Body Weight</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['beratbadanmax']?></td>
												<td style="padding:1px;">kg</td>
												<td style="padding:1px;"></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>Tekanan Darah</span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>Blood Pressure</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['tekanan_darah1']?>/<?=@$pemkss['tekanan_darah2']?></td>
												<td style="padding:1px;">mmHg</td>
												<td style="padding:1px;"></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>Denyut Nadi</span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>Pulse Rate</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['nadi']?></td>
												<td style="padding:1px;">/Menit<br />/Minute</td>
												<td style="padding:1px;"></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>Frekwensi Pernapasan</span><br/><span style="border-top:solid 1px #000000;padding:0 35px 0 0;"><i>Respiration Rate</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['pernafasan']?></td>
												<td style="padding:1px;">/Menit<br />/Minute</td>
												<td style="padding:1px;"></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span>Lingkaran Dada</span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>Chest Circumference</i></span></td>
												<td width="1%"></td>
												<td style="padding:1px;"></td>
												<td style="padding:1px;"></td>
												<td style="padding:1px;"></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span style="margin:0 0 0 10px">a. Ekspirasi</span><br/><span style="margin:0 0 0 20px;"></span><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>Expiration</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['lingkardada1']?></td>
												<td style="padding:1px;">cm</td>
												<td style="padding:1px;"></td>
											</tr>
											<tr>
												<td style="padding:1px;"><span style="margin:0 0 0 10px">b. Inspirasi</span><br/><span style="margin:0 0 0 20px;"></span><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>Inspiration</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['lingkardada2']?></td>
												<td style="padding:1px;">cm</td>
												<td style="padding:1px;"></td>
											</tr>
											<tr>
												<td style="padding:1px;width:45%"><span>Lingkar Perut</span><br/><span style="border-top:solid 1px #000000;padding:0 0 0 0;"><i>Abdominal Circumference</i></span></td>
												<td width="1%">:</td>
												<td style="padding:1px;"><?=@$pemkss['lingkarperut']?></td>
												<td style="padding:1px;">cm</td>
												<td style="padding:1px;" width="20%"></td>
											</tr>
										</table>
									<?php } ?>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<table width="100%" style="font-size:12.5px;">
					<td></td>
					<td><div align="right"><?=@$um?></div></td>
				</table>
			</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
			<?php 
				if($countloping >= 1){ 
					if($_GET['cetakdarikanan']){
						$cetaktataloopdinamic = $nm+$countloping-1;
						$hdhhhd = $cetaktataloopdinamic/2;
						if(is_float($hdhhhd)){
							$cetaktataloopdinamic = $nm+$countloping;
							$countloping = $countloping+1;
						}
					}
					$f = range(1,$countloping);
					$akhirpage = $countloping;
					if($_GET['cetakdarikanan']){
						arsort($f);
					}
					//terus loopingane diwalik yaaaaaaaaaaa
					foreach($f as $val){
					if($_GET['cetakdarikanan']){
						$um = $cetaktataloopdinamic--;
					} else {
						$um = $nm++;
					}
			?>
			<?php if($_GET['viewpage'][$um]){ ?>
			<div class="page">
				<div style="<?=@get_ukuran_buku('kecil')?>;">
					<table width="100%" style="margin:0;font-size:11px;font-family: arial;" cellpadding="0px">
						<tr>
							<td width="50%">
							</td>
							<td width="40%">
								<div style="padding:5px;">
									<?php foreach($broloping[$val] as $valueloopingdinamiic){ ?>
										<?=@$valueloopingdinamiic?>
									<?php } ?>
								</div>
							</td>
						</tr>	
					</table>
				</div>
				
				<table width="100%" style="font-size:11px;">
					<td></td>
					<td><div align="right"><?=@$um?></div></td>
				</table>
			</div>
			<?php } ?>
				<?php } ?>	
			<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php
	//echo $nm;
	if($_GET['hidecetakdanjangantampiltombol']){
	//pertama adalah buat total halama
	$prtCtkTotHal = round($um/2);
?>
<hr style="margin:5px;">
<div align="center">
<table style="width:98%;font-size:11px;">
	<tr>
		<td width="48%" style="border:solid 1px #cccccc;padding:3px;">
			<p style="background:#eeeeee;padding:3px;text-align:center"><b>Lihat Laporan</b></p>
			<table style="width:98%;font-size:11px;">
				<tr>
					<td style="padding:3px;" colspan="3"><div align="center"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumum')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&coverpage=true&noprint=true&posisiprint=kanan')">Halaman Cover</button></div></td>
				</tr>
				<?php
					$dasc = 1;
					$dgfa = range(1, $prtCtkTotHal);
					foreach($dgfa as $gds){
						//gawe halaman kananae
						$halkan = ($prtCtkTotHal*2)+1-$gds;
				?>
				<tr>
					<td style="padding:3px;"><div align="right"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumum')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$gds?>]=<?=@$gds?>&noprint=true&posisiprint=kiri')">Halaman <?=@$gds?></button></div></td>
					<td style="padding:3px;" width="1%"> & </td>
					<td style="padding:3px;"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumum')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$halkan?>]=<?=@$halkan?>&noprint=true&posisiprint=kanan')">Halaman <?=@$halkan?></button></td>
				</tr>
				<?php
					}
				?>
			</table>
		</td>
		<td></td>
		<td width="48%" style="border:solid 1px #cccccc;padding:3px;">
			<p style="background:#eeeeee;padding:3px;text-align:center"><b>Cetak Laporan</b></p>
			<table style="width:98%;font-size:11px;">
				<tr>
					<td style="padding:3px;" colspan="3"><div align="center"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumum')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&coverpage=true&posisiprint=kanan')">Halaman Cover</button></div></td>
				</tr>
				<?php
					$dasc = 1;
					$dgfa = range(1, $prtCtkTotHal);
					foreach($dgfa as $gds){
						//gawe halaman kananae
						
						$halkan = ($prtCtkTotHal*2)+1-$gds;
						$hakirik[$gds] = $gds;
						$hakanak[$halkan] = $halkan;
				?>
				<tr>
					<td style="padding:3px;"><div align="right"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumum')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$gds?>]=<?=@$gds?>&posisiprint=kiri')">Halaman <?=@$gds?></button></div></td>
					<td style="padding:3px;" width="1%"> & </td>
					<td style="padding:3px;"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumum')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&viewpage[<?=@$halkan?>]=<?=@$halkan?>&posisiprint=kanan')">Halaman <?=@$halkan?></button></td>
				</tr>
				<?php
					}
				?>
				<tr>
					<?php
						//buat halaman kiri
						foreach($hakirik as $iku){
							$newkiri[] = "viewpage[".$iku."]=". $iku;
						}
						foreach($hakanak as $iku){
							$newkanan[] = "viewpage[".$iku."]=". $iku;
						}
					?>
					<td style="padding:3px;"><div align="right"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumum')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&<?=@implode("&", $newkiri)?>')">Halaman Kiri</button></div></td>
					<td style="padding:3px;" width="1%"> & </td>
					<?php if($prtCtkTotHal >= 5){ ?>
					<td style="padding:3px;"><button type="button" onclick="window.open('<?=@base_url($this->u1.'/cetakresumekesimpulansaranframeumum')?>/?kode_transaksi=<?=@$_GET['kode_transaksi']?>&id_paket=<?=@$_GET['id_paket']?>&cetakdarikanan=okcuy&<?=@implode("&", $newkanan)?>')">Halaman Kanan</button></td>
					<?php } else { ?>
					<td style="padding:3px;"><b>Minimal 10 Halaman</b>
					</td>
					<?php } ?>
				</tr>
			</table>
		</td>
	</tr>
</table>
</div>
<?php } ?>