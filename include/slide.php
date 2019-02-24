<?php
	include "connect.php";
	$sql="select * from quangcao";
	$kq=mysql_query($sql);
	$sl=0;
	echo "<div class=\"slideshow-container\">";
	while($r=mysql_fetch_array($kq)){
		$id_qc=$r["id_qc"];$ten=$r["ten"];$href=$r["href"];$anh=$r["anh"];
		if($sl==0)
		echo "<div class=\"mySlides fade\" style=\"display:block\">
			<a href=\"$href\">
			<img src=\"$anh\" style=\"width:100%\">
            <div class=\"text\">$ten</div>
			</a></div>";
		else
		echo "<div class=\"mySlides fade\">
			<a href=\"$href\">
			<img src=\"$anh\" style=\"width:100%\">
            <div class=\"text\">$ten</div>
			</a></div>";
		$sl=$sl+1;
		
	};
	echo " <a class=\"prev\" onclick=\"plusSlides(-1)\">&#10094;</a>
                <a class=\"next\" onclick=\"plusSlides(1)\">&#10095;</a>";
	echo "</div>";
	$dem=0;
	echo"<div style=\"text-align:center\">";
	while($dem!=$sl){
	echo" <span class=\"dot\" onclick=\"currentSlide($dem)\"></span>";       
		$dem=$dem+1;
	}
	echo "</div>";
?>
         