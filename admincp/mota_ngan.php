<?php
include "connect.php";
$id=$_GET["id"];
$kq=mysql_query("select * from sanpham where id='$id'");
while($r=mysql_fetch_array($kq))
{	$mota_ngan=$r["mota_ngan"];
	if($mota_ngan=="")
		echo "sản phẩm này chưa có mô tả!!";
	else{
?>
<div style="overflow:auto; width:550px; height:300px">
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="line-height:25px"><?php echo $mota_ngan; ?></td>
  </tr>
</table>
</div>
<?php
	}
}
?>