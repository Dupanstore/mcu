<form method="POST" id="formdetailtambahajaxpem" action="<?=base_url($this->u1 .'/'. $this->u1 .'_action/simpandetailtmbhpempolibaru')?>">
<input type="hidden" name="kd_tind_simp" value="<?=@$this->uri->segment(4)?>">
<table class="tableeasyui" style="width:100%" data-options="singleSelect:true,rownumbers:true,fitColumns:true">
	 <thead>
            <tr style="background:#cccccc;">
                <th field="ugyu1" width="1%"></th>
                <th field="ugyu2" width="50">Jenis Pemeriksaan</th>
				 <th field="ugyu2" width="50">Setting Buku (contoh: 12P1)</th>
            </tr>                          
        </thead> 
		<tbody>
	<?php
	$do = "select * from tb_pemeriksaan, tb_grouptind where tb_pemeriksaan.kd_group=tb_grouptind.kd_grouptindakan and tb_grouptind.id_grouptindakan='". $this->uri->segment(3) ."' order by  rad_namapemeriksaan ASC ";
	$ai = $this->db->query($do);
	//print_r($ai->result());
	//die();
	if($ai->result()){
		$dkk = "";
		foreach($ai->result() as $h){
		$dkk = "";
		$this->db->where('id_pem', $h->id_pem);
		$this->db->where('id_tind', $this->uri->segment(4));
		$dao = $this->db->get('tb_pemeriksaan_meta');
		$srt = $dao->result();
		if($srt){
			$dkk = 'checked="true"';
		}
	?>
	<tr>
		<td><input type="checkbox" name="cek[<?=@$h->id_pem?>]" value="<?=@$h->id_pem?>" <?=$dkk?>></td>
		<td><?=@$h->rad_namapemeriksaan?></td>
		<td><input type="text" name="periksaok[<?=@$h->id_pem?>]" value="<?=@$h->nomorbuku?>"></td>
	</tr>
		<?php } ?>
	<?php } ?>
	</tbody>
</table>
</form>