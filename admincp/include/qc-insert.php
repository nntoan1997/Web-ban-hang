<?php
include "connect.php";
$ten="";$anh="";$diachianh="";
if(isset($_POST["act"]))
{//(1)
	$ten=$_POST["ten"];
	//echo "loaisp: $loaisp<hr>";
	$diachianh=$_POST["diachianh"];
	
	$kd=khongdau2($_POST["ten"]);
	
	$sql2="select MAX(id) from quangcao";
	$kq2=mysql_query($sql2);
	while($r2=mysql_fetch_row($kq2)){
		$id=$r2[0];
	}
	$id+=1;
	
	$kt="select count(*) from quangcao where Ten='$ten'";
	$kq_kt=mysql_query($kt);
	$r_kt=mysql_fetch_array($kq_kt);
	$n_kt=$r_kt[0];
	if($n_kt!=0){
		echo "<script>alert('Sản phẩm này đã có trong cơ sỡ dữ liệu');</script>";}
	else{//(2)	
	$file_name = $_FILES["hinh"]["name"];
	$tmp_name = $_FILES['hinh']['tmp_name'];	
	$imageInfo = explode('.', $file_name);  //cắt chuỗi ở những nơi có dấu .		
	$newName = $kd.".".$imageInfo[1]; 			

	switch($imageInfo[1]){
	case "jpg":
		$src = imagecreatefromjpeg($tmp_name);
	break;
			
	case "jpeg":
		$src = imagecreatefromjpeg($tmp_name);
	break;
	
	case "gif":
		$src = imagecreatefromgif($tmp_name);
	break;
					
	case "png":
		$src = imagecreatefrompng($tmp_name);
	break;	
		
	}//end - switch
{
		$sql="insert into quangcao(id_qc,Ten,href,anh) 
		values ('$id','$ten','$diachianh','$newName')";}
echo "$sql<hr>";
	$kq=mysql_query($sql);
	if(!$kq){
	echo "<script>alert('Có lỗi SQL! Nhập lại!');</script>";		
	}
	else {//(4)
		
//********************************resize hinh ********************************//
	list($width,$height)=getimagesize($tmp_name);  //lấy kích thước của file
	$newwidth=900;
	$newheight=450;
	$tmp=imagecreatetruecolor($newwidth,$newheight); //tạo kíck thước mới rồi gán vào 1 file hình
	imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height); //chép hình từ file src ( ng ta gửi ) sang khung hình kíck thước mới
	$pathfile="./slide/".$newName;	
	$pathfull="./slide2/".$newName;	
	move_uploaded_file($_FILES["hinh"]["tmp_name"], $pathfile);
	imagejpeg($tmp,$pathfull,100);		   //lưu hình tmp với đường dẫn là pathfull
	imagedestroy($src); imagedestroy($tmp); //xóa hình tạm khỏi bộ nhớ
//********************************resize hinh ********************************//	
		
		$n=mysql_affected_rows();
		echo "<script>alert('Đã thêm quang cao!');window.location='?m=qc-insert'</script>";
		$ten="";$anh="";$diachianh="";
	}//(4)

	}//(2)
}//(1)

?>
<script language="javascript">
function createXMLHttp()
    {
        var xmlHttp =false;
        try{
          xmlHttp = new XMLHttpRequest();
        }
        catch(e)
        {
          xmlHttp = new ActiveXObject("Microsoft.XMLHttp");
        }
        if (!xmlHttp)
        {
          alert("Loi ...");
        }
        else
        {
          return xmlHttp;
        
        }
    
    }   
        
var xmlHttp = new createXMLHttp();
function comboChange(v)
{
  var url = "./admincp/include/get-loaisp.php?idn="+v;
//alert(url);
 if (xmlHttp.readyState==4 || xmlHttp.readyState==0)
      {
        xmlHttp.open("GET", url, true);
        xmlHttp.onreadystatechange=Func;
        xmlHttp.send(null);
      }
  }
    
 function Func()
    {
//    alert("Here xmlHttp.readyState="+xmlHttp.readyState);
   		
        if (xmlHttp.readyState==4)
        {
            if (xmlHttp.status==200)
            {
             
				var s="";
				//s +="     <option value='chonlsp'>-- Chọn loại sản phẩm --</option> ";
				s += xmlHttp.responseText;
				//alert(s);
				var oXml = xmlHttp.responseXML.documentElement;
				
				var select = document.getElementById("loaisp");
				select.innerHTML="";				
				
				var arrLoai = oXml.getElementsByTagName("value");
				var arrTextLoai=oXml.getElementsByTagName("text");
				for(i=0; i<arrLoai.length; i++)
				{
				  var opt = document.createElement("option");
				  
				  opt.setAttribute("value", arrLoai[i].firstChild.data);
				  var text = document.createTextNode(arrTextLoai[i].firstChild.data);
				   opt.appendChild(text);
				   select.appendChild(opt);
				}				
       		}
			else
			 alert("Coloi tu server."+xmlHttp.statusText);
		}
		
}
</script>
<?php
	include("connect.php");
	function print_option($sql)
	{
		$kq=mysql_query($sql);
		while ($r=mysql_fetch_array($kq))
			echo "<option value=$r[0]> $r[1] </option>";
	}
?>
<table width="900" border="0" cellspacing="0" cellpadding="0" ">
  <tr>
    <td colspan="2" class="tieude" align="center" border-left:1px solid #CCCCCC">THÊM SẢN PHẨM MỚI</td>
  </tr>  
  <?php
	  echo "<form method=\"post\" enctype=\"multipart/form-data\" onsubmit=\"return qc_insert(ten.value,diachianh.value,hinh.value);\" id=\"forminsert\" name=\"forminsert\">";
  
  ?>
  <tr>
    <td style="padding-left:80px" height="30">Tên quảng cáo:</td>
    <td><input type="text" name="ten" style="width:240px" value="<?php echo "$tensp"; ?>"></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td style="padding-left:80px" height="30">Địa chỉ ảnh </td>  
    <td><textarea name="diachianh" cols="27" rows="5"  style="width:240px"></textarea> </td>
  </tr>
  <tr>
    <td style="padding-left:80px" height="30">Hình ảnh:</td>
    <td><input name="hinh" type="file" size="30"></td>
  </tr>
  <tr>
  	<td align="center" colspan="2" height="35" style="border-bottom:1px solid #CCCCCC ">
    <input name="" type="submit" value="Thêm" class="button" onmouseover="style.background='url(./images/button-2-o.gif)'" onmouseout="style.background='url(./images/button-o.gif)'">
    <input name="" type="reset" value="Xóa trắng" class="button" onmouseover="style.background='url(./images/button-2-o.gif)'" onmouseout="style.background='url(./images/button-o.gif)'">    
    </td>
  </tr>
  <input type="hidden" name="act">
  </form>
</table>
