<?php
		$que 	 = "select * from tb_user, tb_instalasi where tb_user.level=tb_instalasi.id_ins and id_user <> '".$this->uri->segment(3)."' ";
		if (@!empty($_POST['cari'])){
			$que 	.= " and (username like '%".strip_tags(trim($_POST['cari']))."%' OR  email like '%".strip_tags(trim($_POST['cari']))."%')";
		}
		if (@!empty($_POST['ins'])){
			if ($_POST['ins'] != "Semua"){				
				$que 	.= " and id_ins='".strip_tags(trim($_POST['ins']))."' ";
			}
		}
		$que 	.= " order by username ASC";
		$data['query'] 	= $this->db->query($que);
		$sggg = $data['query']->result();
		foreach($sggg as $ggs){
			//cek apakah sudah ada data apa belun
			$this->db->where("user_pengikut", $ggs->id_user);
			$this->db->limit(1);
			$sghg = $this->db->get("tb_userbersama");
			$ghgh = $sghg->result();
			$hgh = "";
			if($ghgh){
				$hgh = 'checked="true"';
			}
			$ggs->centang = '<input type="checkbox" '.$hgh.' name="iduser['.$ggs->id_user.']" value="'.$ggs->id_user.'">';
			$tgav[] = $ggs;
			
		}
			$object = new stdClass();
			$object->rows = $tgav;
			print_r (json_encode($object));
?>