    <?php
		session_start();
	?>
	<html>
    <head>
    </head>
    <body>
    <object width="500" height="350" data="croflash.swf" type="application/x-shockwave-flash">
    <param name="data" value="croflash.swf" /><param name="src" value="croflash.swf" />
    <embed src="croflash.swf" type="application/x-shockwave-flash" width="600" height="400"></embed>
    </object>
	
	<?php if(isset($_GET['cetak'])){ ?>
	<script type="text/javascript">
		window.open('../pendaftaran/cetakkartu/<?=@$_SESSION['normnew']?>');
	</script>
	<?php } ?>
    </body>
    </html>
	