<div id="content_center">
<?php
	$idl=$_GET["idl"];
	$sql="select loaisanpham.*,nhomsanpham.* from loaisanpham,nhomsanpham where loaisanpham.id_nhom=nhomsanpham.id_nhom AND loaisanpham.id_loai=$idl";
	$kq=mysql_query($sql);
	$sort=$_GET["sort"];
	$r=mysql_fetch_array($kq);
	$id_nhom=$r["id_nhom"];$tennhom=$r["tennhom"];
	$id_loai=$r["id_loai"];$tenloaisp=$r["tenloaisp"];
?>	
<?php
     
					//Xác định tổng số bài viết

					$kq=mysql_query("select count(*) from sanpham where id_loai=$id_loai and (ghichu='hienthi' or ghichu='new')");
					
					$r=mysql_fetch_array($kq);
					$numrow=$r[0];		
					//số sản phẩm được hiển thị trên mộ trang cho 1 trang
					$pagesize=12;
					//Tính tổng số trang
					$pagecount=ceil($numrow/$pagesize);			
					//Xác định số trang cho mỗi lần hiển thị
					$segsize=3;
					//Thiết lập trang hiện hành
					if(!isset($_GET["page"]))
						 $curpage=1;
					else	
						 $curpage=$_GET["page"];
					if($curpage<1)
						 $curpage=1;
					if($curpage>$pagecount) $curpage=$pagecount;
					//Xác định số phân đoạn của trang
					$numseg=($pagecount % $segsize==0)?($pagecount/$segsize):(int)($pagecount/$segsize+1);
					//Xác định phân đoạn hiện hành của trang
					$curseg=($curpage % $segsize==0)?($curpage/$segsize):(int)($curpage/$segsize+1);   
					$k=($curpage-1)*$pagesize;
?>
 <div id="location">
    <a href="index.php"><i class="bg icon_home"></i></a>    
    <span>&raquo;</span>
    <a href="?b=nsp&idn=<?php echo $id_nhom; ?>"><?php echo "$tennhom"; ?></a>
    <span>&raquo;</span>    
    <a href="?b=lsp&idl=<?php echo $id_loai; ?>"><?php echo "$tenloaisp"; ?></a>        
  </div>
<div class="top_area_list_page">
          		<h1><?php echo $tennhom;?></h1>
                <div class="sort_pro">
                    <span>Sắp xếp sản phẩm <span class="bg icon_drop"></span> </span>
                    <ul>                  
                      <li><?php echo " <a href=\"?b=lsp&idl=$id_loai&sort=tc\">"; ?>Giá: thấp -> cao</a> </li>
                        <li><?php echo " <a href=\"?b=lsp&idl=$id_loai&sort=ct\">"; ?>Giá: cao -> thấp</a> </li>
                    </ul>
                </div>
                
                 <div class="paging">
                 	<?php
     
							//*******************************Xuất số trang*******************************************
						if($numrow==1)
							echo "<script>alert('Dòng sản phẩm này đang được cập nhật');window.location='index.php';</script>";
						else{
						echo "<br>";
						if($sort==""){
						if($curseg>1)
							echo "<a href='?b=lsp&idl=$id_loai&page=".(($curseg-1)*$segsize)."'><b>Previous</b></a> &nbsp;";
							$n=$curseg*$segsize<=$pagecount?$curseg*$segsize:$pagecount;
							for($i=($curseg-1)*$segsize+1;$i<=$n;$i++)
							{
								if($curpage==$i)
									echo "<a href='?b=lsp&idl=$id_loai&page=".$i."'><font color='#0000FF'>".$i."</font></a> &nbsp;";
								else
									echo "<a href='?b=lsp&idl=$id_loai&page=".$i."'>".$i."</a> &nbsp;";
							}
							if($curseg<$numseg)
							echo "<a href='?b=lsp&idl=$id_loai&page=".(($curseg*$segsize)+1)."'><b>Next</b></a> &nbsp;";		
						}
						else{
							if($curseg>1)
							echo "<a href='?b=lsp&idl=$id_loai&sort=$sort&page=".(($curseg-1)*$segsize)."'><b>Previous</b></a> &nbsp;";
							$n=$curseg*$segsize<=$pagecount?$curseg*$segsize:$pagecount;
							for($i=($curseg-1)*$segsize+1;$i<=$n;$i++)
							{
								if($curpage==$i)
									echo "<a href='?b=lsp&idl=$id_loai&sort=$sort&page=".$i."'><font color='#0000FF'>".$i."</font></a> &nbsp;";
								else
									echo "<a href='?b=lsp&idl=$id_loai&sort=$sort&page=".$i."'>".$i."</a> &nbsp;";
							}
							if($curseg<$numseg)
							echo "<a href='?b=lsp&idl=$id_loai&sort=$sort&page=".(($curseg*$segsize)+1)."'><b>Next</b></a> &nbsp;";		
						
						}
						}
						
							
					?>               
                </div>
                <div class="clear space"></div>
            </div> 



    <?php     
		
		
//******************************** Nội Dung ***********************************************//
		if($sort==""){
			$sql3="select * from sanpham where id_loai=$id_loai and (ghichu='hienthi' or ghichu='new') ORDER BY ghichu DESC limit $k,$pagesize";						
			}else if($sort=="ct"){
						$sql3="select * from sanpham where id_loai=$id_loai and (ghichu='hienthi' or ghichu='new') ORDER BY gia DESC limit $k,$pagesize";
					}
					else{
						$sql3="select * from sanpham where id_loai=$id_loai and (ghichu='hienthi' or ghichu='new') ORDER BY gia asc limit $k,$pagesize";
					}

		
	//	echo "$sql3<hr>";
		$kq3=mysql_query($sql3);
		if(!$kq3)
			echo "";
		else{
		
		echo "<div class=\"product-list float-l\" style=\"width:926px;min-height:270px;\">
            	<ul class=\"ul\" id=\"pro-home1\">";		
		while($r3=mysql_fetch_array($kq3))
		{
				
			$id=$r3["id"];$tensp=$r3["tensp"];$hinh=$r3["hinh"];$ghichu=$r3["ghichu"];
			$gia=$r3["gia"];$gia2=number_format($gia,0,'','.');
			if( $gia==0) $s="(liên hệ)";	else { $s=$gia2." VND"; }	
			
			if($ghichu=="new")	
					
				echo "<li>
                    	<div class=\"p-containter\">
						<a href=\"?b=ct&id=$id\" class=\"p-img\">
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
			else
			echo "<li>
                    	<div class=\"p-containter\">
						<a href=\"?b=ct&id=$id\" class=\"p-img\">
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
		}
?>
<div class="clear space"></div>
<div class="top_area_list_page">
	<div class="paging">
                 	<?php
     
							//*******************************Xuất số trang*******************************************
						if($numrow==0)
							echo "<script>alert('Dòng sản phẩm này đang được cập nhật');window.location='index.php';</script>";
						else{
						echo "<br>";
						if($curseg>1)
							echo "<a href='?b=lsp&idl=$id_loai&page=".(($curseg-1)*$segsize)."'><b>Previous</b></a> &nbsp;";
							$n=$curseg*$segsize<=$pagecount?$curseg*$segsize:$pagecount;
							for($i=($curseg-1)*$segsize+1;$i<=$n;$i++)
							{
								if($curpage==$i)
									echo "<a href='?b=lsp&idl=$id_loai&page=".$i."'><font color='#0000FF'>".$i."</font></a> &nbsp;";
								else
									echo "<a href='?b=lsp&idl=$id_loai&page=".$i."'>".$i."</a> &nbsp;";
							}
							if($curseg<$numseg)
							echo "<a href='?b=lsp&idl=$id_loai&page=".(($curseg*$segsize)+1)."'><b>Next</b></a> &nbsp;";		
						}
							
					?>               
                </div>
</div>

</div>
<div id="content_right">		
<?php
				echo "<div class=\"box_right\">";
				echo "<div class=\"title_box_right\">";	
				echo "<a href=?b=nsp&idn=$id_nhom><h2>$tennhom</h2></a></div>";
			
				$sql2="select * from loaisanpham where id_nhom=$id_nhom";
				$kq2=mysql_query($sql2);
				$numrow2=mysql_num_rows($kq2);
				if($numrow2==0)
					echo "";
				else
				{
				echo "<div class=\"content_box\">";		
				echo "<ul class\"ul\">";
				while($r2=mysql_fetch_array($kq2))
					{	

						$tenloai=$r2["tenloaisp"];$id_loai=$r2["id_loai"];	
						$c1=mysql_query("select count(*) from sanpham where id_loai=$id_loai and (ghichu='hienthi' or ghichu='new')");
						$rc1=mysql_fetch_array($c1);$nc1=$rc1[0];
						 echo "<li><a href=?b=lsp&idl=$id_loai>$tenloai</a></li>";			
					}
				echo "</ul>";				
				}
				echo "</div><div class=\"clear space\"></div>";
?>
</div>