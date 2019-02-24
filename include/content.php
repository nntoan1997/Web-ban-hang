
<?php
	include "connect.php";
	$sql10="select * from	sanpham where noibat=1 order by rand() limit 0,8";
	echo "<div class=\"clear space\"></div>";
	echo "<div class=\"box-prod-home\">";
	echo "<div class=\"title-box-center\">";
	echo "<a class=\"root\" href=?b=nsp&idn=$id_nhom><h2 class=\"cufon h-title\">san pham noi bat</h2></a>";
echo "</div >";

echo "<div class=\"clear space\"></div>";

$kq10=mysql_query($sql10);
echo "<div class=\"product-list float-l\" style=\"width:880px;min-height:270px;\">
			<ul class=\"ul\" id=\"pro-home1\">";
while($r10=mysql_fetch_array($kq10))
{
	$id=$r10["id"];$tensp=$r10["tensp"];$hinh=$r10["hinh"];
	$gia=$r10["gia"];$gia2=number_format($gia,0,'','.');
	 $s=$gia2." VND";
	echo "<li>
							<div class=\"p-containter\">
		<a href=?b=ct&id=$id class=\"p-img\">
										<img src='sanpham/small/$hinh'  class=\"img-hover-scale\"/>
								</a>
		<a href=?b=ct&id=$id class=\"p-name\">$tensp</a>
										<div class=\"p-price-index img-price\">
											$gia
												<u>đ</u>
										</div>
										<a href=\"index.php?b=gh&id=$id&g=$gia\" class=\"btn-cart-shop\">Giỏ hàng</a>
		</div>
	</li>";
}
echo "</ul></div>";
echo "</div >";

?>
<?php
	include "connect.php";
	$sql11="select * from	sanpham order by soluongban desc limit 0,8";
	echo "<div class=\"clear space\"></div>";
	echo "<div class=\"box-prod-home\">";
	echo "<div class=\"title-box-center\">";
	echo "<a class=\"root\" href=?b=nsp&idn=$id_nhom><h2 class=\"cufon h-title\">san pham ban chay</h2></a>";
echo "</div >";

echo "<div class=\"clear space\"></div>";

$kq11=mysql_query($sql11);
echo "<div class=\"product-list float-l\" style=\"width:880px;min-height:270px;\">
			<ul class=\"ul\" id=\"pro-home1\">";
while($r11=mysql_fetch_array($kq11))
{
	$id=$r11["id"];$tensp=$r11["tensp"];$hinh=$r11["hinh"];
	$gia=$r11["gia"];$gia2=number_format($gia,0,'','.');
	 $s=$gia2." VND";
	echo "<li>
							<div class=\"p-containter\">
		<a href=?b=ct&id=$id class=\"p-img\">
										<img src='sanpham/small/$hinh'  class=\"img-hover-scale\"/>
								</a>
		<a href=?b=ct&id=$id class=\"p-name\">$tensp</a>
										<div class=\"p-price-index img-price\">
											$gia
												<u>đ</u>
										</div>
										<a href=\"index.php?b=gh&id=$id&g=$gia\" class=\"btn-cart-shop\">Giỏ hàng</a>
		</div>
	</li>";
}
echo "</ul></div>";
echo "</div >";

?>
<?php
		include "connect.php";
		$sql="select * from nhomsanpham";
		$kq=mysql_query($sql);

		while($r=mysql_fetch_array($kq))
		{
			echo "<div class=\"clear space\"></div>";
			echo "<div class=\"box-prod-home\">";
			$id_nhom=$r["id_nhom"];
			$tennhom=$r["tennhom"];
			if($id_nhom==1)
			{
				echo "<div class=\"title-box-center\">";
				echo "<a class=\"root\" href=?b=nsp&idn=$id_nhom><h2 class=\"cufon h-title\">$tennhom</h2></a>";

				$sql2="select * from loaisanpham where id_nhom=1";
				$kq2=mysql_query($sql2);
				$numrow2=mysql_num_rows($kq2);
				if($numrow2==0)
					echo "";
				else
				{
				echo "<div class=\"sub-title\">";
				while($r2=mysql_fetch_array($kq2))
					{

						$tenloai=$r2["tenloaisp"];$id_loai=$r2["id_loai"];
						$c1=mysql_query("select count(*) from sanpham where id_loai=$id_loai and (ghichu='hienthi' or ghichu='new')");
						$rc1=mysql_fetch_array($c1);$nc1=$rc1[0];
						 echo "<a href=?b=lsp&idl=$id_loai>$tenloai</a>";
					}
				echo "</div>";
				}
				echo "</div>";
				echo "<div class=\"clear space\"></div>";
				$sql3="select * from sanpham as sp, loaisanpham as lsp where sp.id_loai= lsp.id_loai and (sp.ghichu='new' ) and lsp.id_nhom='1' order by rand() limit 0,8";
				$kq3=mysql_query($sql3);
				echo "<div class=\"product-list float-l\" style=\"width:880px;min-height:270px;\">
            	<ul class=\"ul\" id=\"pro-home1\">";
				while($r3=mysql_fetch_array($kq3))
				{
					$id=$r3["id"];$tensp=$r3["tensp"];$hinh=$r3["hinh"];
					$gia=$r3["gia"];$gia2=number_format($gia,0,'','.');
					 $s=$gia2." VND";
					echo "<li>
                    	<div class=\"p-containter\">
						<a href=?b=ct&id=$id class=\"p-img\">
                          	<img src='sanpham/small/$hinh'  class=\"img-hover-scale\"/>
                        </a>
						<a href=?b=ct&id=$id class=\"p-name\">$tensp</a>
                            <div class=\"p-price-index img-price\">
                            	$gia
                                <u>đ</u>
                            </div>
                            <a href=\"index.php?b=gh&id=$id&g=$gia\" class=\"btn-cart-shop\">Giỏ hàng</a>
						</div>
					</li>";
				}
				echo "</ul></div>";
							echo "<div class=\"banner-right-pro\">
									<a href=\"\">
										<img src=\"img/banner_3416a75f.jpg\" />
									</a>
								</div>";
			}
			else
			{
				echo "<div class=\"title-box-center\">";
				echo "<a class=\"root\" href=?b=nsp&idn=$id_nhom><h2 class=\"cufon h-title\">$tennhom</h2></a>";

				$sql2="select * from loaisanpham where id_nhom=$id_nhom";
				$kq2=mysql_query($sql2);
				$numrow2=mysql_num_rows($kq2);
				if($numrow2==0)
					echo "";
				else
				{
				echo "<div class=\"sub-title\">";
				while($r2=mysql_fetch_array($kq2))
					{
						$tenloai=$r2["tenloaisp"];$id_loai=$r2["id_loai"];
						$c1=mysql_query("select count(*) from sanpham where id_loai=$id_loai");
						$rc1=mysql_fetch_array($c1);$nc1=$rc1[0];
						echo "<a href=?b=lsp&idl=$id_loai>$tenloai</a>";
					}
				echo "</div>";
				}
				echo "</div>";
				echo "<div class=\"clear\"></div>";
				$sql3="select * from sanpham as sp, loaisanpham as lsp where sp.id_loai= lsp.id_loai and (sp.ghichu='new' ) and lsp.id_nhom=$id_nhom order by rand() limit 0,8";
				$kq3=mysql_query($sql3);
				echo "<div class=\"product-list float-l\" style=\"width:880px;min-height:270px;\">
            	<ul class=\"ul\" id=\"pro-home1\">";
				while($r3=mysql_fetch_array($kq3))
				{
					$id=$r3["id"];$tensp=$r3["tensp"];$hinh=$r3["hinh"];
					$gia=$r3["gia"];$gia2=number_format($gia,0,'','.');
					 $s=$gia2." VND";
					echo "<li>
                    	<div class=\"p-containter\">
						<a href=?b=ct&id=$id class=\"p-img\">
                          	<img src='sanpham/small/$hinh'  class=\"img-hover-scale\"/>
                        </a>
						<a href=?b=ct&id=$id class=\"p-name\">$tensp</a>
                        <div class=\"p-price-index img-price\">
                          	$gia
                           	<u>đ</u>
                        </div>
                        <a href=\"index.php?b=gh&id=$id&g=$gia\" class=\"btn-cart-shop\">Giỏ hàng</a>
						</div>
					</li>";
			}
			echo "</ul></div>";
			echo "<div class=\"banner-right-pro\">
            	<a href=\"\">
                	<img src=\"img/banner_3416a75f.jpg\" />
                </a>
            </div>";
		}
		echo "</div>";

	}
?>
