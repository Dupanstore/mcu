<?php
	$this->db->where('id_paket', clean_data($this->uri->segment(3)));
	$this->db->limit('1');
	$jjus = $this->db->get('tb_paket');
	$tsts = $jjus->result();
?>
