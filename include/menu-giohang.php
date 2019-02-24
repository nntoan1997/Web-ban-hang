<div id="cart">
    <i class="bg icon_cart"></i>


    <?php 
		if(isset($_SESSION["user"]))
		{
			$user=$_SESSION["user"];
			$sql="select count(*) from giohang where user='$user' AND tinhtrang='themgiohang'";			
			$kq=mysql_query($sql);
			$r=mysql_fetch_array($kq);
			$numrow=$r[0];		
			echo "<span><a href=\"index.php?b=showcart\">Giỏ Hàng</a></span>";	
			if($numrow==0)
			{	echo "<b id=\"count_cart\">0</b>"; }
			else
			{	echo "<b id=\"count_cart\">$numrow</b>"; }
		}
		else{
			$ghang=$_SESSION["gh"];
			$count=count($ghang);
			echo "<span><a href=\"index.php?b=gh\">Giỏ Hàng</a></span>";
		 	echo "<b id=\"count_cart\">$count</b>";
			
		}
	?>  
	
</div>
				