<?php
	$id_qc=$_GET["id_qc"];
	
	$sql="delete from quangcao where id_qc='$id_qc'";
	$kq=mysql_query($sql);
	if(!$kq)
		echo "<script>alert('Có lỗi trong khi xóa!!!');window.location='../admincp/?m=lienhe';</script>";
	else
	{
		$n=mysql_affected_rows();
		echo "<script>alert('Đã xóa'); window.history.go(-1);</script>";		
	}

?>