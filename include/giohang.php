 <div id="content">
<?php
if(!isset($_SESSION)) session_start();
if (isset($_SESSION["gh"]))
  $gh = $_SESSION["gh"];
else
 $gh = array();

$id = "";
$sl=1;

if (isset($_GET["sl"]))
{
	$sl = $_GET["sl"];
	$sl =floor($sl*1);
}
$hoten=$_GET["hoten"];
$diachi=$_GET["diachi"];
$email=$_GET["email"];
$dt=$_GET["dt"];
$fax=$_GET["fax"];
$cty=$_GET["cty"];
$now=date("Y-m-d H:i:s");

if (isset($_GET["id"]))
{
	$id=$_GET["id"];	
	$act = "a";
}
if (isset($_GET["act"])) $act=$_GET["act"];
if ($act=="a")
{
	themGH($id, $sl);
	}
if ($act=="u")
   capnhatGH( $id, $sl);
if ($act=="d")
   xoaGH( $id);
if ($act=="tt") dathang($gh,$hoten,$diachi,$email,$dt,$fax,$cty,$now);
hienthiGH($gh);


//========================
function themGH($id, $sl)
{
  global $gh;
  //echo "themGH($id, $sl)";
   if (isset($gh[$id])) 
    {
       $gh[$id] = $gh[$id]+$sl;
    }
  else
       $gh[$id] = $sl;
  $_SESSION["gh"] =$gh;
}

                    
function hienthiGH($gh)
{
  include "connect.php"; 
  	echo " <div id=\"guide_cart\">
                  <i class=\"bg icon_large_cart\"></i>
                  <h1>Chi tiết giỏ hàng</h1>
                  <p>Để xóa sản phẩm khỏi giỏ hàng, bấm <img src=\"\" alt=\"\" />, để mua thêm bấm <b>\"Chọn thêm sản phẩm\"</b>.
                    Để sang bước đặt hàng tiếp theo, bấm <b>\"Tiếp tục\"</b></p>
                </div>";
    echo "<table cellpadding=\"5\" border=\"1\" class=\"table-cart-1\" id=\"tbl_list_cart\">

  <tr class=\"tr-table-cart-heading\">
    <td ><b>Sản phẩm</b></td>
    <td ><b>Số lượng</td>
    <td ><b>Giá</td>
    <td><b>Tổng</td>
	<td ><b>Cập Nhật</td>	
    <td ><b>Xóa</td>                
  	</tr>
   <span style=\"display: none;\"></span>";
$tongtien=0;
    foreach($gh as $id=>$sl)
      {
		  $count=count($gh);
//		  echo "$count<hr>";
		if($id!=""){	
		 $sql = "select * from sanpham where id='$id' ";
         $ketqua = mysql_query($sql); 		 
         $r = mysql_fetch_array($ketqua);
			$hinh=$r["hinh"];
        	$id=$r["id"];
			$tensp=$r["tensp"];
			$gia=$r["gia"]; $gia2=number_format($gia,0,'','.');
			$tong=$gia*$sl; $tong2=number_format($tong,0,'','.');
			$tongtien+=$tong;$tongtien2=number_format($tongtien,0,'','.');				
       
                    
          echo "<tr>

            <td class=\"product_cart\">
				<img src='sanpham/small/$hinh' style=\"vertical-align: middle; margin-right: 10px; float:left; width:100px;\" /> 
				<div style=\"margin-left:120px;\">
                                <a href=\"?b=ct&id=$id\" style=\"text-decoration:none; padding-top:10px; display:block;\"><b>
								</b></a>
                                <p class=\"red\">$tensp</p>
                                <p>Bảo hành:12 tháng </p>      
                          </p>      
                </div>
			</td>
            <td style=\"border-right:1px solid #666; border-bottom:1px solid #666\">
			<form id='f$id'>
			<input type=hidden name='act' /><input type=hidden name=id value='$id' />
			<input type=hidden name=b value='gh'>
            	<input type=\"text\" name=\"sl\" value='$sl' onchange=\"\" size='5' />
            </td></form>
            <td class=\"product_cart\"><span id=''>$gia2</span> VND </td>
			<td class=\"product_cart\"><span id=''>$tong2</span> VND </td>
            <td >
            <a onClick=\"subMitF('f$id', 'u');\">Cập Nhật</a>
            </td>               
            <td>
			<a onClick=\"subMitF('f$id', 'd');\">Xóa</a>
            </td>               
     	  </tr>";
	  }
	  }
	  
if($count=="")
{
	echo "<tr><td height=30 colspan=6 align=center style=\"padding-right:5px; padding-bottom:5px; color:#F00\">Không có sản phẩm nào trong giỏ hàng của Quý khách!</td></tr>";
}
else{
  echo "<tr>
  	<td height=30 colspan=6 align=right style=\"padding-right:5px; padding-bottom:5px; color:#F00\">Tổng số tiền phải thanh toán: $tongtien2 VND</td></tr>";
  echo "<tr>
  	<td colspan=\"6\" bgcolor=\"#fff\" align=\"center\" height=\"35\">
	<form name=form>
    <input type=\"button\" name=\"tieptucmuahang\" value=\"Tiếp Tục Mua Hàng\" class=\"btn_cyan float_r btn_cart\" onclick=\"document.form.action='index.php'; document.form.submit();\" />
	<input type=\"button\" name=\"dathang\" value=\"Đặt Hàng\" class=\"btn_red float_r btn_cart\" onclick=\"document.getElementById('thanhtoan').style.display='block'\"/>
	</form>
    </td>
  </tr>";  
}
    echo "</table>";
	echo "<div id='thanhtoan' style='display:none '>
	<form id='k$id'>
		<table width=\"560\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"padding-top:10px; border:1px solid #333\">		
		<td colspan=\"6\" class=\"tieude\" align=\"center\">THÔNG TIN LIÊN HỆ</td>
	  </tr>
	  <tr>
		<td height=\"30\"><div style=\"padding-left:70px\">Họ và tên: </div></td>
		<td width=\"350\">		
		<input type=hidden name='act' /><input type=hidden name=id value='$id' />
			<input type=hidden name=b value='gh'>
		<input name=\"hoten\" type=\"text\" size=\"35\" maxlength=\"50\" > <font color=\"#FF0000\">*</font></td>
	  </tr>
	  <tr>
		<td height=\"30\"><div style=\"padding-left:70px\">Địa chỉ:</div></td>
		<td><input name=\"diachi\" type=\"text\" size=\"35\" maxlength=\"50\"> <font color=\"#FF0000\"> *</font> </td>
	  </tr>
	  <tr>
		<td height=\"30\"><div style=\"padding-left:70px\">Email:</div> </td>
		<td><input name=\"email\" type=\"text\" size=\"35\" maxlength=\"50\"> <font color=\"#FF0000\"> *</font></td>
	  </tr>
	  <tr>
		<td height=\"30\"><div style=\"padding-left:70px\">Số điện thoại:</div></td>
		<td><input name=\"dt\" type=\"text\" size=\"35\" maxlength=\"50\" onkeyup=\"valid(this,'numbers')\" onblur=\"valid(this,'numbers')\" ><font color=\"#FF0000\"> *</font></td>
	  </tr>
	  <tr>
		<td height=\"30\"><div style=\"padding-left:70px\">Fax:</div></td>
		<td><input name=\"fax\" type=\"text\" size=\"35\" maxlength=\"50\" onkeyup=\"valid(this,'numbers')\" onblur=\"valid(this,'numbers')\"></td>
	  </tr>
	  <tr>
		<td height=\"30\"><div style=\"padding-left:70px\">Công ty:</div></td>
		<td><input name=\"cty\" type=\"text\" size=\"35\" maxlength=\"50\"></td>
	  </tr>
      <tr>
        <td colspan=\"2\" bgcolor=\"#fff\" align=\"center\" height=\"35\">
		<input type=\"button\" value=\"Gửi\" class=\"button\" onmouseover=\"style.background='url(images/button-2-o.gif)'\" onmouseout=\"style.background='url(images/button-o.gif)'\" onclick=\"subMitF('k$id', 'tt');\">
          <input type=\"reset\" value=\"Nhập lại\" class=\"button\" onmouseover=\"style.background='url(images/button-2-o.gif)'\" onmouseout=\"style.background='url(images/button-o.gif)'\"  >
         </td>
      </tr>	  
    </table>
	</form>
	</div>";
}

function dathang($gh,$hoten,$diachi,$email,$dt,$fax,$cty,$now)
{
  mysql_connect("localhost", "root", "");
  mysql_select_db("shop");
  if($hoten==""||$diachi==""||$email==""||$dt=="")
		echo "<script>alert('Quý khách phải nhập đầy đủ thông tin vào những nơi có dấu *');</script>";
  else{
  foreach($gh as $id=>$sl)
  {	  	
		$q=mysql_query("select gia from sanpham where id='$id'");
		while($rq=mysql_fetch_array($q))
		{
			$gia=$rq["gia"];
			$tien=$gia*$sl;
		$sql2 = "insert into hoadon(hoten,diachi,email,dienthoai,fax,cty,id,soluong,tongtien,ngaydat,tinhtrang) values ('$hoten','$diachi','$email','$dt','$fax','$cty','$id',$sl,'$tien','$now','dathang')";
		$sql2.=';';
		$ketqua2 = mysql_query($sql2);
		
		echo "<script>alert('Quý khách đã gửi đơn hàng thành công!');window.location='index.php'</script>";
	// echo "$sql2<br>";
		}
		session_destroy();
  }
  }
}

function xoaGH( $item)
{
	global $gh;

   if (isset($gh[$item])) 
    {
		unset($gh[$item]);
   		$_SESSION["gh"]=$gh;
	}
}

function capnhatGH( $id, $sl)
{
		global $gh;
	
	if (isset($gh[$id])) 
    {
		$gh[$id] = $sl;
		if ($sl<1)
		{
			unset($gh[$id]);
		    echo "Xoa...";
		}
		$_SESSION["gh"]=$gh;
	}
   		
}

?>
<script language="javascript">
function subMitF(fn, type)
{
var a=document.getElementById(fn);
//alert(a.nodeName);
b=a.getElementsByTagName('input')[0];
//alert("Co "+b.length+" node Input");
b.value=type;
a.submit();

}
</script>
</div>