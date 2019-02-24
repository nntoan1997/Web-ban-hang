<div class="container">
<?php
//session_destroy();
	if(isset($_POST["dathang"]))
	{
		$gia=$_POST["gia"];
	//	echo "$gia<hr>";
		$id = $_GET["id"];	
		if(isset($_SESSION['user']))
		{				
			$user=$_SESSION ['user'];
			$query="SELECT * FROM giohang WHERE id='$id' AND user='$user' AND tinhtrang='themgiohang'";
			$result=mysql_query ($query);
			$numrow=mysql_num_rows($result);
			if($numrow!=0)
			{
				echo "<script>alert('Sản phẩm này đã có trong giỏ hàng của Quý khách');</script>";
			}		
			else	
			{
				$ngaydat=date("Y-m-d");
				$query2="INSERT INTO giohang(id,user,soluong,tinhtrang,ngaydat) VALUES ('$id','$user',1,'themgiohang','$ngaydat')";			
			//	echo "$query2";
				$result2=mysql_query($query2) or die(mysql_error());
				if($result2)			
					echo "<script>window.location='index.php?b=showcart';</script>";			
				else			
					echo "<script> alert('Có lỗi xảy ra trong quá trình mua hàng!');</script>";			
			}	
		}
		}
?>
<?php
	include "connect.php";
	$id=$_GET["id"];
	$sql="SELECT sanpham.*,loaisanpham.*,nhomsanpham.* from sanpham,loaisanpham,nhomsanpham where sanpham.id_loai=loaisanpham.id_loai AND loaisanpham.id_nhom=nhomsanpham.id_nhom AND sanpham.id='$id'";
	$kq=mysql_query($sql);
	$r=mysql_fetch_array($kq);	
	$tensp=$r["tensp"];$tenloaisp=$r["tenloaisp"];$tinhtrang=$r["tinhtrang"];
	$tennhom=$r["tennhom"];$id_nhom=$r["id_nhom"];
	$hinh=$r["hinh"];$gia=$r["gia"];$gia2=number_format($gia,0,'','.');
	$id_loai=$r["id_loai"];
	$mota=$r["mota"];
	$mota_ngan=$r["mota_ngan"];
	if($mota=="") $mt='Mô tả của sản phẩm này đang được cập nhật!'; else $mt=$mota;
	if($mota_ngan=="") $mtn='Mô tả của sản phẩm này đang được cập nhật!'; else $mtn=$mota_ngan;
?>



     <div id="location">
    <a href="index.php"><i class="bg icon_home"></i></a>    
    <span>&raquo;</span>
    <a href="?b=nsp&idn=<?php echo $id_nhom; ?>"><?php echo "$tennhom"; ?></a>   
    <span>&raquo;</span>    
    <a href="?b=lsp&idl=<?php echo $id_loai; ?>"><?php echo "$tenloaisp"; ?></a>       
    <span>&raquo;</span>  
    <a href="?b=ct&id=<?php echo $id ?>"><?php echo "$tensp"; ?></a>
  	<div id="pro_detail_page">
                <div id="product_detail">
                  <h1><?php echo "$tensp"; ?>)</h1>
                  <ul class="ul-review-share">
                        <li><img class="rate-san-pham-product" src="/template/default/images/star_0.png" alt="đánh giá phi long"/></li>                   
                        <li><span class="stock-status-bold">Còn hàng</span></li>
                        <li> <span class="stock-status-red">Bảo hành:</span><span class="stock-status-bold"style="text-transform: lowercase;">12 tháng</span></li>
                    <li><i class="bg icon_fav"></i><a href="">Lưu sản phẩm yêu thích</a></li>

                  </ul>
                  <div class="clear"></div>
    			</div>
                <div id="wrap_scroll" class="wrap-content-main">
                            <img src="sanpham/small/<?php echo $hinh; ?>" style="width:80%">
               </div>
   

	
    <div id="overview">
                    
                    <div class="clear"></div>

                    
                              <div id="summary_detail">
                              
                                
                                <?php echo $mtn; ?><br/>
                                
                              </div>
                          
                    <div class="table_div">
 
                      <div id="price_detail" style="border:none;">
                        <div class="price_detail_left">
                          
                          
                          <div class="img_price_full"><span>Giá bán: </span><span class="price_color_sales"><?php  echo "$gia2 VND"; ?><u>đ</u></span></div>
                          
                          
                          
                        </div>
                        <div class="price_detail_left_vat">
                          
                          <div style="">[Giá đã bao gồm VAT]</div>
                          
                          
                          
                        </div>
                        <div class="clear"></div>
                      </div>
                      
                      <div id="offer_detail">
                        
                        <div class="product_info_gifts_container">                          
                          
                          QUÀ TẶNG / KHUYẾN MẠI <br/> 
                        </div>
                      </div>
                      
            
                    </div>                        
                    <div class="clear"></div>  
                    
                     <form method="post" name="form">
                    
                    <div id="button_buy">
                   
                        <input type="hidden" name="dathang" />
                        <input type="hidden" value=<?php echo "$id"; ?> name="catid" /> 
                        <input type="hidden" name="gia" value="<?php echo "$gia"; ?>" />
                        <?php 
                        if(isset($_SESSION["user"]))
                        {
                            echo"<a onClick=\"document.form.submit();\" class=\"btn-large-add btn_large_red\">
                            Mua ngay</a>";
                        }
                        else
                            echo "<a href=\"index.php?b=gh&id=$id&g=$gia\" class=\"btn-large-add btn_large_red\">Mua ngay</a>";
                        ?>
   
                    </div>
                    </form>
                    <div class="space"></div>
                  <table id="tbl_cacchinhsach" style="border:solid 1px #f1f1f1; padding:3px;">
                      <tr>
                        <td style="padding-top:5px;"><img src="/template/default/images/icon-5-dich-vu.png" alt=""/><span>Sản phẩm chính hãng</span></td>
                        <td style="padding-top:5px;"><img src="/template/default/images/icon-5-dich-vu.png" alt="" /><span>Sản phẩm có sẵn, đa dạng</span></td>
                      </tr>
                      <tr>
                        <td style="padding-top:5px"><img src="/template/default/images/icon-5-dich-vu.png" alt="" /><span>Giá cả cạnh tranh</span></td>
                        <td style="padding-top:5px"><a href="/page/huong-dan-mua-hang-tra-gop"><img src="/template/default/images/icon-5-dich-vu.png" alt="" /><span>Mua hàng trả góp với lãi suất ưu đãi</span>
                          </a>
                          </td>
                      </tr>
                    </table>  
                    
                    </div>
                    <div class="clear"></div>
            	</div>

    </div>
    <div id="title_tab_scroll_pro" style="margin-top:10px;z-index: 99999; background: #313131;">
                    <a href="">Thông số kỹ thuât</a>                       
                    <a href="">Đánh giá & Nhận xét</a>                 
                    <a href="">Sản phẩm liên quan</a>                
              	</div>
                <div id="tab4" class="content_scroll_tab content-scroll-width-float-left" style="display:block;">
                    <h2 class="cufon title_box_scroll">Thông số kỹ thuât</h2>
                    <div class="nd">
                    	<?php echo $mt; ?>
                    </div>
                    <div class="clear"></div>
               	</div>
                <div id="tab8" class="content_scroll_tab content-scroll-width-float-left">      
                    <h2 class="cufon title_box_scroll">Sản phẩm liên quan</h2>
                         <?php
            include "connect.php";
            $sql2="select * from sanpham where id_loai=$id_loai and ( ghichu='hienthi' or ghichu='new' ) and id<>'$id' order by rand() limit 0,10";
            $kq2=mysql_query($sql2);
			 	
			echo "<div class=\"product-list container \" style=\"width:1200px;min-height:600px;\">
            	<ul class=\"ul\" id=\"pro-home1\">";		
            while($r2=mysql_fetch_array($kq2))
            {
                $id2=$r2["id"];
                $tensp2=$r2["tensp"];	
                $hinh2=$r2["hinh"];		
                $gia2=$r2["gia"];$gia3=number_format($gia2,0,'','.');
				
                if($gia2==0) $s2="(liên hệ)"; else { $s2=$gia3; }				
				if($id2==$id) echo "";
				else {
					
                echo "<li>
                    	<div class=\"p-containter\" >
						<a href=\"?b=ct&id=$id2\" class=\"p-img\">
                          	<img src='sanpham/small/$hinh2'  class=\"img-hover-scale\"/>
                        </a>
						<a href=?b=ct&id=$id2 class=\"p-name\">$tensp2</a> 	
                        <div class=\"p-price-index img-price\">
                          	$gia2
                           	<u>đ</u>
                        </div>
                        <a href=\"index.php?b=gh&id=$id&g=$gia2\" class=\"btn-cart-shop\">Giỏ hàng</a>
						</div>
					</li>";
				}
            }
			echo "</ul></div>";	
        ?>
            </div>    
        </div>
<div class="clear space2"></div>
      


<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
