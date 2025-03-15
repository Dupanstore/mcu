<?php
	if($this->uri->segment(3)){
		//echo $this->uri->segment(3);
		$this->db->where('id_tind', clean_data($this->uri->segment(3)));
		$this->db->limit('1');
		$jjus = $this->db->get('tb_tindakan');
		$tsts = $jjus->result();
		//print_r($tsts);
?>
<input type="hidden" name="id_tindakan" value="<?=@$this->uri->segment(3)?>">
<textarea id="editor1" name="syair_radiologi"><?=@$tsts[0]->syair_radiologi?>
</textarea>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
</script>
<?php } ?>