<?php
if(isset($_POST["act"]))
{
	if(isset($_POST["xoa"]))
	{
		$chon=$_POST["chon"];
		$count=count($chon);
		if($count==0)
			echo "<script>alert('Chưa chọn quảng cáo cần xóa');</script>";
		else{
			for ($j=0;$j<$count;$j++)
			{	
				$SQL= "DELETE FROM quangcao WHERE id_qc='$chon[$j]'";
			//	echo "$SQL";
				$kq=mysql_query($SQL);
				$n+=mysql_affected_rows();
			}					
			echo "<script>alert('Đã xóa $n quangcao');</script>";
		}		
	
	}
}
?>
<form method="post">
<table width="960" height="70" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" bordercolordark="#FFFFFF">
	  <tr>
      	<td style="border-top:1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; border-left:1px solid #CCCCCC"><div align="left" style="color:#d4340c; font-family:Tahoma; font-size: 16px; font-weight:bold; padding-left:20px">QUẢN LÝ QUẢNG CÁO 	 
      	</div></td>
         <td style="border-top:1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; border-right:1px solid #CCCCCC; height:65px; width:55px">
		<a href="?m=qc-insert"><img src="./images/bt_them.jpg" height="65px" width="55px"/></a>
        </td>
        <td style="border-top:1px solid #CCCCCC; border-bottom: 1px solid #CCCCCC; border-right:1px solid #CCCCCC; height:65px; width:55px">
        <input type="button" value='' onClick="return checklh();document.form.submit();" style="background:url(./images/bt_xoa.jpg); width:55px; height:65px;">                
        </td>
      </tr>
</table>

<table width="960" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6" class="tieude" align="center">DANH SÁCH QUẢNG CÁO</td>
  </tr>
  <tr height="30" bgcolor="#ffcc99">
    <td align="center" width="50" style="border-left:1px solid #333;border-right:1px solid #333"><strong>Chọn</strong></td>
    <td align="center" width="200" style="border-right:1px solid #333"><strong>Tên</strong></td>
    <td width="200" align="center" style="border-right:1px solid #333"><strong>Hình</strong><strong></strong></td>
    <td align="center" width="460" style="border-right:1px solid #333"><strong>Địa chỉ ảnh</strong></td>
    <td align="center" width="50" style="border-right:1px solid #333">Xóa</td>
    
  </tr>  
<?php
        $kq=mysql_query("select count(*) from quangcao"); 
        $r=mysql_fetch_array($kq);
        $numrow=$r[0];		
        //số record cho 1 trang
        $pagesize=20;
        //Tính tổng số trang
        $pagecount=ceil($numrow/$pagesize);			
        //Xác định số trang cho mỗi lần hiển thị
        $segsize=5;
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
		
	//******************************** Nội Dung *********************************//
		$sql3="select * from quangcao order by id_qc DESC limit $k,$pagesize";
		$kq3=mysql_query($sql3);
		if(!$kq3)
			echo "";
		else{
		while($r3=mysql_fetch_array($kq3))
		{
			$id_qc=$r3["id_qc"];
			$ten=$r3["Ten"];
			$diachianh=$r3["href"];
			$hinh=$r3["anh"];
  ?>
  <tr>
  <td width="50" align="center" style="border-left:1px solid #333;border-bottom:1px solid #333; border-right:1px solid #333">
  <input type="checkbox" name="chon[]" value="<?php echo $idlh; ?>"/></td>  
    <td width="200" height="30" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333"><b><?php echo "$ten"; ?></b></td>
    <td width="200" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333">
   <?php echo "$hinh"; ?>
    </td>
    <td width="460" align="left" style="border-bottom:1px solid #333; border-right:1px solid #333; padding-left:5px; padding-right:5px"><?php echo "$diachianh"; ?></td>
    <td width="50" align="center" style="border-bottom:1px solid #333; border-right:1px solid #333"><a href="?m=qc-del&id_qc=<?php echo "$id_qc"; ?>" onclick="return checklh()">Xóa</a></td>   
  </tr>
 <?php
		}
		}
 ?>
  <tr>
	<td colspan="6" class="ketthuc">
 <?php
    if($numrow==0)
		echo "Hiện tại chưa có quảng cáo nào!!";
	else{  
    if($curseg>1)
        echo "<a href='?m=qc&page=".(($curseg-1)*$segsize)."'><b>Previous</b></a> &nbsp;";
        $n=$curseg*$segsize<=$pagecount?$curseg*$segsize:$pagecount;
        for($i=($curseg-1)*$segsize+1;$i<=$n;$i++)
		{
			if($curpage==$i)
				echo "<a href='?m=qc&page=".$i."'><font color='#FF0000'>[".$i."]</font></a> &nbsp;";
			else
				echo "<a href='?m=qc&page=".$i."'><font color='#FFF'>[".$i."]</font></a> &nbsp;";
		}
        if($curseg<$numseg)
		echo "<a href='?m=qc&page=".(($curseg*$segsize)+1)."'><b>Next</b></a> &nbsp;";		
	}
?>
    </td>
  </tr> 
</table>
  <input type="hidden" name="act">
</form>