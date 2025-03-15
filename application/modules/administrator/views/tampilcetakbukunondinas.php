<?php $uri2 = base_url($this->u1.'/cetakresumekesimpulansaranframeumum/?kode_transaksi='. $_GET['kode_transaksi'] .'&id_paket='. $_GET['id_paket'] .'&hidecetakdanjangantampiltombol=true'); ?>
<iframe src="<?=@$uri2?>" style="width:100%;border:0;height:450px;overflow:hidden;overflow:hidden"></iframe> 
<?php
	
?>
