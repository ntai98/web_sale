<?php session_start(); 
if (!isset($_SESSION['tk'])) {
	 header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>MUA BÁN ĐIỆN THOẠI </title>
        <link rel="stylesheet" href="index.css">
        <script src="jquery.min.js" type="text/javascript"></script> 
        <script language="javascript">
           $(document).ready(function() {
                $('#previous').on('click', function(){
                // Change to the previous image
                $('#im_' + currentImage).stop().fadeOut(1);
                decreaseImage();
                $('#im_' + currentImage).stop().fadeIn(1);
                });
                $('#next').on('click', function(){
                // Change to the next image
                $('#im_' + currentImage).stop().fadeOut(1);
                increaseImage();
                $('#im_' + currentImage).stop().fadeIn(1);
                });
               window.setInterval(function() {
                $('#next').click();
                }, 3000);
                var currentImage = 1;
                var totalImages = 3;

                function increaseImage() {
                /* Increase currentImage by 1.
                * Resets to 1 if larger than totalImages
                */
                ++currentImage;
                if(currentImage > totalImages) {
                currentImage = 1;
                }
                }
                function decreaseImage() {
                /* Decrease currentImage by 1.
                * Resets to totalImages if smaller than 1
                */
                --currentImage;
                if(currentImage < 1) {
                currentImage = totalImages;
                }
                }
                });
             
        </script>
    </head>
    <body >
        <div id="toancuc">             
                <div id="menu">
                  <ul>
                    <li><a href="index.php">Trang chủ</a></li>
                    <li><a href="#">Hướng dẫn</a></li>
                    <li><a href="#">Liên hệ</a></li>
                  </ul>
                </div>
                 <div id="search">
                        <form action="search.php" method="get">
                            <input id="timnhap" type="text" name="search" placeholder="   tìm kiếm sản phẩm" />
                            <input id="nuttim" type="submit" value="SEARCH" />
                        </form>
                    </div>
            
                <div id="login">
                        <ul>
                            <?php 
                               if(isset($_SESSION['tk'])){
                                   
                                   echo "<li><a href=\"logout.php\">Logout</a>";
                                   echo "<li><a href=\"./nguoidung/tk.php\">" .$_SESSION['tk'] ."</a></li>";
                               }
                               else{
                                   echo "<li><a href=\"dangky.php\">đăng kí</a></li>";
                                   echo  "<li><a href=\"dangnhap.php\">đăng nhập</a></li>";
                               }
                               ?>
                            
                            <div id="gioh"><a href="giohang.php"><img src="bg/giohang.png" width="48px" height="30px"></a></div>
                            
                        </ul>
                    </div>

                
                
                <div id="slogan">
                    <img src="bg/bgslogan.jpg" width="100%" height="140px">

                    <h1> MUA BÁN ĐIỆN THOẠI </h1>
                    
                 </div>

                <div id="noidung">              
                            <br>
                            <div id="thanhtoan">
                                <div id="tieudethanhtoan"><h2>XÁC NHẬN-THANH TOÁN</h2></div>
                                <br>
                                <br>
                               <div id="thongtindiachi"> 
                                <h3>Địa chỉ nhận hàng</h3>
                                <br>
                                <?php
                                 $tk=$_SESSION['tk'];
                                $jsondatakh = file_get_contents('http://localhost/banhang/api/khachhang/' .$tk);
                                $jsonkh = json_decode($jsondatakh,true);
                                echo "<b>" .$jsonkh['hotenkh'] ."</b>";
                                echo " | " ;
                                echo "0" .$jsonkh['sdtkh'];
                                echo "<br>" ;
                                echo "" .$jsonkh['diachikh'];

                                    ?></div>
                                <div id="thongtinsanpham"> 
                                <h3>thông tin sản phẩm</h3>
                                <br>
                                
                                <div class="hinhsp">
                                <?php
                            if (isset($_GET['id'])) {
                                $sl=$_GET['sl'];
                                $id=$_GET['id'];
                                $link =  'http://localhost/banhang/api/hanghoa/' .$id;
                                $jsondatahh = file_get_contents($link);
                                $hh = json_decode($jsondatahh,true);
                                echo "<img src=\"hinh/" .$hh['hinh'] ."\" width=\"60px\" height=\"65px\">" ;
                            }
                            
                        ?>
                                    </div>
                                    <div class="thongtinsp">
                                <?php

                                        echo "<h4>" .$hh['tenhang'] ."</h4>";
                                        echo "<br>";
                                        echo "giá :" .$hh['gia'] ."VND &emsp; số lượng:" .$sl ;
                            
                        ?>
                                        <div id="tongtien">
                                        <br>
                                        <br>
                                    <?php

                                       $gia=$hh['gia'];

                                        $tong=$sl * $gia;
                                    echo 'TỔNG TIỀN HÀNG &emsp; &emsp; ' .'<span style="color: red">' .$tong .'VND</span>';
                                    ?>
                                    </div>
                                </div>
                                   
                    </div>
                            <br>
                            <br>
                           <div id="gichu-thanhtoan">
                               <h3>Ghi chú</h3>
                               <br>
                               <form method="post">
            <table >
                <tr>
                    <td><input id="ghichu" type="text"  name="ghichu" placeholder="  500 kí tự"/>
                </tr>
                <tr>
                    <td >
                        <input id="nutthanhtoan" type="submit" value="THANH TOÁN" name="thanhtoan"/>
                    </td>
                </tr>
                    
                
            </table>
                                   
            <?php 
                if (isset($_POST['thanhtoan'])) {
                    $tk=$_SESSION['tk'];
                    $ghichu=$_POST['ghichu'];
                    $id=$_GET['id'];
                    $sl=$_GET['sl'];
                    $diachi=$jsonkh['diachikh'];
                    $hientai = date('Y-m-d H:i:s') ;

                    $lenh = 'tkkh='.$tk .'&ngaydathang=' .$hientai .'&diachi=' .$diachi .'&ghichu=' .$ghichu ;
                    $lenh=str_replace(" ","+",$lenh);
                    $params = array('http' => array(
                        'method' => 'POST',
                        'content' => $lenh
                    ));

                    $ctx = stream_context_create($params);
                    $sUrl = 'http://localhost/banhang/api/donhang/?' .$lenh;
                    $fp = @fopen($sUrl, 'rb', false, $ctx);
                    $kq = stream_get_contents($fp);

                    $lenh2 = 'masodh='.$kq .'&mahang=' .$id .'&soluong=' .$sl .'&gia1sp=' .$gia ;
                    $params2 = array('http' => array(
                        'method' => 'POST',
                        'content' => $lenh
                    ));

                    $ctx2 = stream_context_create($params2);
                    $sUrl2 = 'http://localhost/banhang/api/chitietdonhang/?' .$lenh2;
                    $fp2 = @fopen($sUrl2, 'rb', false, $ctx2);
                    $kq2 = @stream_get_contents($fp2);
                    if((string)$kq2 == 'false'){
                        echo '<script language="javascript">
                                            alert("loi roi!!!!!!!!!!!");
                                        </script>';

                    }else {
                        echo '<META http-equiv="refresh" content="0;URL=./nguoidung/chitietdonhang.php?iddh=' .$kq .'">';
                    }



                    

                }
              ?>
        </form>      
                               <?php
                                   if (!isset($_GET['id'])){ echo '<META http-equiv="refresh" content="0;URL=index.php">';}
                                   ?>
                               <br>
                               <br>
                               <br>
                               <br>
                                </div>
                            
                    </div>
                        
                    
                    
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />
                    <br />

                
                </div>
            </div>
    </body>
</html>