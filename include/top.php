<?php
	if(!isset($_REQUEST["b"])) $b="home";
	else $b=$_REQUEST["b"];
                switch ($b) {
                        case 'home':
                        		$class0="class='current'";
                        		$class1="";
                        		$class2="";
                        		$class3="";
                        		$class4="";
                              break;
                        case 'gioithieu':
                        		$class1="class='current'";
                        		$class0="";
                        		$class2="";
                        		$class3="";
                        		$class4="";
                              break;
                        case 'huongdanmuahang':
                        		$class2="class='current'";
                        		$class0="";
                        		$class1="";
                        		$class3="";
                        		$class4="";
                              break;
                              
                        case 'tintuc':
                              	$class3="class='current'";
                        		$class0="";
                        		$class1="";
                        		$class2="";
                        		$class4="";
                              break;
                        case 'lienhe':
                             	$class4="class='current'";
                        		$class0="";
                        		$class1="";
                        		$class2="";
                        		$class3="";
                              break;
                        default: 
                             	$class0="class='current'";
                        		$class1="";
                        		$class2="";
                        		$class3="";
                        		$class4="";
                              break;
                  }
?>
<div class="container">
                <ul class="ul">
                    <li <?=$class0?> title="Trang chủ">
                        <a href="index.php" rel="nofollow">
                            <span style="color:#c2050b;">
                                <img  class="icon-top" style="margin-top: 2px;" src="img/home-page-red.png"  />Trang chủ
                            </span>
                        </a>
                    </li>    
                    <li id="view-showroom">
                    	<img class="icon-top" src="img/showroom-red.png" />
                        <a href="" rel="nofollow">Hệ thống Showroom
                            <div class="hnc-showroom">
                                <table>
                                    <tr>
                                        <td style="text-align:left; width:30%;">
                                            <b>Học viện kỹ thuật mật mã</b>
                                            <a href="" target="_blank">[Bản đồ}</a>
                                            <p>144 Chiến Thắng, Hà Đông, Hà Nội</p>
                                            <p>Tel: (022)3840631 - Fax" (022)3840063<br />Email:toansieucap@gmail.com</p>
                                            <a href="" target="_blank">[Liên hệ]</a>
                                        </td>
                                            <td width="20"></td>
                                            <td style="text-align:left; width:30%;">
                                            <b>Học viện kỹ thuật mật mã</b>
                                            <a href="" target="_blank">[Bản đồ}</a>
                                            <p>144 Chiến Thắng, Hà Đông, Hà Nội</p>
                                            <p>Tel: (022)3840631 - Fax" (022)3840063<br />Email:toansieucap@gmail.com</p>
                                            <a href="" target="_blank">[Liên hệ]</a>
                                        </td>
                                        <td style="text-align: left;" width="350">
                                            <b>Hỗ trợ qua email</b>
                                            <p><span class="bold">Bán hàng:</span> toansieucap@gmail.com</p>
                                            <p><span class="bold">Hỗ trợ kỹ thuật:</span> toansieucap@gmail.com</p>
                                            <p><span class="bold">Phòng kinh doanh:</span> toansieucap@gmail.com</p>
                                            <p><span class="bold">Ban Giám đốc:</span>toansieucap@gmail.com</p>
                                        </td>
                                    </tr>          
                                </table>
                            </div>        
                        </a>              
                    </li>
                    <li <?=$class1?>  id="support-top">
						<img class="icon-top" src="img/new_icon_banhang.png" />
                        <a href="?b=gioithieu">Chăm sóc khách hàng</a>                    
                    </li>
                    <li <?=$class2?> >
                    	<a href="?b=huongdanmuahang" rel="nofollow"><span>
       					<img  class="icon-top" src="img/new_icon_tragop.png"></img>Bán hàng trả góp</span></a>
      				</li>
                  	<li <?=$class3?>  id="list_hot_news_top">
                        <a href="?b=lienhe"><img class="icon-top" src="img/new_icon_tintuc.png" />Liên hệ</a> 
                        <i class="bg icon_drop"></i>
                        <ul class="ul">                                                 
                        </ul>
                  	</li>
      				
      				<li>|</li>
     				
      				<li <?=$class4?> >
                    <?php
						if(isset($_SESSION["success"])){
							include "include/login_success.php";
						}
						else
							include "include/login.php";
						?>     
                  	</li>                
                </ul>
        	</div>
       