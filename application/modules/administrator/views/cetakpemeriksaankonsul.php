<?php
	$ss = "";
	$hh = 'width="0%" height="0px"';
	if($_GET['view']){
		$ss = '&view=ok';
		$hh = 'width="100%" height="350px"';
	}
	$uri2 = base_url($this->u1.'/cetakpemeriksaankonsulframe/?id_reg='. $_GET['id_reg'] . $ss);
?>
<iframe src="<?=@$uri2?>" frameborder="0" <?=@$hh?>></iframe> 