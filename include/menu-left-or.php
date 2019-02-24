	<div id="nav-vertical">
     	<div class="title-nav">
           	<div class="line-menu">
              	<i></i>
                <i></i>
                <i></i>
    	    </div>
        	<span class="title-menu">
            	Danh mục sản phẩm
            </span>
        </div>
        
	
    <?php
		
		if(isset($_REQUEST["b"]))
		{				
			echo " <ul class=\"ul ul_menu\">";
		}
		else 
			echo "<ul class=\"ul\">";
		?>
	<?php
	
		include "connect.php";
		$sql="select * from nhomsanpham";
		$kq=mysql_query($sql);		
		while($r=mysql_fetch_array($kq))
		{
			$id_nhom=$r["id_nhom"];
			$tennhom=$r["tennhom"];
			if($id_nhom==1)
			{
				echo "<li><a class=\"root\" href=?b=nsp&idn=$id_nhom>$tennhom</a>";
			
				$sql2="select * from loaisanpham where id_nhom=1";
				$kq2=mysql_query($sql2);
				$numrow2=mysql_num_rows($kq2);
				if($numrow2==0)
					echo "";
				else
				{
				echo "<div class=\"sub-menu\">";		
				while($r2=mysql_fetch_array($kq2))
					{	
						echo"<div class=\"box\">";
						$tenloai=$r2["tenloaisp"];$id_loai=$r2["id_loai"];	
						$c1=mysql_query("select count(*) from sanpham where id_loai=$id_loai and (ghichu='hienthi' or ghichu='new')");
						$rc1=mysql_fetch_array($c1);$nc1=$rc1[0];
						 echo "<a class=\"sub1\" href=?b=lsp&idl=$id_loai>$tenloai</a>";	
						 echo "</div>";			
					}
					
				echo "</div></li>";
				}
				
			}
			else
			{
				echo "<li><a class=\"root\" href=?b=nsp&idn=$id_nhom>$tennhom</a>";
			
				$sql2="select * from loaisanpham where id_nhom=$id_nhom";
				$kq2=mysql_query($sql2);
				$numrow2=mysql_num_rows($kq2);
				if($numrow2==0)
					echo "";
				else
				{
				echo "<div class=\"sub-menu\">";	
				while($r2=mysql_fetch_array($kq2))
					{
						echo"<div class=\"box\">";
						$tenloai=$r2["tenloaisp"];$id_loai=$r2["id_loai"];	
						$c1=mysql_query("select count(*) from sanpham where id_loai=$id_loai");
						$rc1=mysql_fetch_array($c1);$nc1=$rc1[0];
						echo "<a class=\"sub1\" href=?b=lsp&idl=$id_loai>$tenloai</a>";	
						echo "</div>";	
					}
				echo "</div></li>";
				}
			}
			
		}
		
	?>
    </ul>
</div>
