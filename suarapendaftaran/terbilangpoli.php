<div style="display:none">
<?php
include "FungsiTerbilang.php";
terbilangSuarapoli(antrianterbilangpoli($_GET['no'], $_GET['loket']));

?>
</div>
 <script type="text/javascript" src="swfobject.js"></script>
 <div id="flashPlayer">
 </div>
 <script type="text/javascript">
   var so = new SWFObject("playerMultipleList.swf", "mymovie", "0", "0", "7", "#FFFFFF"); 
   so.addVariable("autoPlay","yes")
   so.addVariable("repeat","false")
   so.addVariable("playlistPath","playlist.xml")
   so.write("flashPlayer");
</script>

