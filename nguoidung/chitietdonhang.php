<?php session_start(); 
if (!isset($_SESSION['tk'])) {
	 header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>MUA BÁN ĐIỆN THOẠI </title>
        <link rel="stylesheet" href="../index.css">
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
                    <li><a href="../index.php">Trang chủ</a></li>
                    <li><a href="#">Hướng dẫn</a></li>
                    <li><a href="#">Liên hệ</a></li>
                  </ul>
                </div>
                 <div id="search">
                        <form action="../search.php" method="get">
                            <input id="timnhap" type="text" name="search" placeholder="   tìm kiếm sản phẩm" />
                            <input id="nuttim" type="submit" value="SEARCH" />
                        </form>
                    </div>
            
                <div id="login">
                        <ul>
                            <?php 
                               if(isset($_SESSION['tk'])){
                                   
                                   echo "<li><a href=\"../logout.php\">Logout</a>";
                                   echo "<li><a href=\"./nguoidung/tk.php\">" .$_SESSION['tk'] ."</a></li>";
                               }
                               else{
                                   echo "<li><a href=\"dangky.php\">đăng kí</a></li>";
                                   echo  "<li><a href=\"dangnhap.php\">đăng nhập</a></li>";
                               }
                               ?>
                            
                            <div id="gioh"><a href="../giohang.php"><img src="../bg/giohang.png" width="48px" height="30px"></a></div>
                            
                        </ul>
                    </div>

                
                
                <div id="slogan">
                    <img src="../bg/bgslogan.jpg" width="100%" height="140px">

                    <h1> MUA BÁN ĐIỆN THOẠI </h1>
                    
                 </div>

                <div id="noidung">              
                            <br>
                            <div id="tk">

                               <div id="chucnang"> 
                                   
                  <ul>
                    <li><a href="tk.php">Thông tin tài khoản</a></li>
                    <li><a href="Capnhat.php">cập nhật thông tin</a></li>
                    <li><a href="doimk.php">Đổi mật khẩu</a></li>
                    <li><a href="donhang.php"><b><span style="color: red;">Đơn hàng</span></b></a></li>
                  </ul>
                </div>
                                <div id="thongtintk"> 
                                <h3>Chi tiết đơn hàng </h3>
                                    <br>
                                    <br>
                                    <br>
            <div id="tttk">
            <table >
                <?php
                if(isset($_GET['iddh'])){
                    $iddh=$_GET['iddh'];
                    $tk=$_SESSION['tk'];
                    $tongtien = 0;
                    $i = 0;
                    $jsondatadh = file_get_contents('http://localhost/banhang/api/donhang/' .$iddh);
                    $dh = json_decode($jsondatadh,true);
                    echo "<table >";
                    echo "<tr>";
                    echo "<td>";
                    echo "Mã đơn hàng: ";
                    echo "</td>";
                    echo "<td>";
                    echo "".$iddh ;
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>";
                    echo "ngày tạo: ";
                    echo "</td>";
                    echo "<td>";
                    echo "".$dh['ngaydathang'] ;
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>";
                    echo "Địa chỉ: ";
                    echo "</td>";
                    echo "<td>";
                    echo "".$dh['diachinhanhang'] ;
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>";
                    echo "tình trạng: ";
                    echo "</td>";
                    echo "<td>";
                    echo "".$dh['tinhtrang'] ;
                    echo "</td>";
                    echo "</tr>";


                    echo "</table >";
                    echo '<br>';
                    echo '<br>';
                    echo "<table >";
                    $jsondatactdh = file_get_contents('http://localhost/banhang/api/chitietdonhang/' .$iddh);
                    $chitietdh = json_decode($jsondatactdh,true);
                    echo "<tr>";
                    echo "<td class=\"giohinh\">hình</td>";
                    echo "<td class=\"gioten\">tên sản phẩm</td>";
                    echo "<td class=\"giogia\">giá</td>";
                    echo "<td class=\"giosl\">số lượng</td>";

                    echo "</tr>";
                    foreach ($chitietdh as $ctdh){
                        $jsondatahh = file_get_contents('http://localhost/banhang/api/hanghoa/' .$ctdh['mahang']);
                        $hh = json_decode($jsondatahh,true);
                        $i++;
                        $tongtien = $tongtien + $ctdh['giadathang1sp'] * $ctdh['soluong'];
                        echo "<tr>";
                        echo "<td><br></td>";
                        echo "<td><br></td>";
                        echo "<td><br></td>";
                        echo "<td><br></td>";
                        echo "<td><br></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"giohinh\">";
                        echo("<a href=\"sanpham.php?id=".$hh['mahang'] ."\" target=\"\"><img src=\"../hinh/" .$hh['hinh']
                            ."\" width=\"60px\" height=\"65px\"></a>" );
                        echo "</td>";
                        echo "<td class=\"gioten\">";
                        echo("<a href=\"sanpham.php?id=".$hh['mahang'] ."\" target=\"\"> " .$hh['tenhang'] ."</a>" );
                        echo "</td>";
                        echo "<td class=\"giogia\">";
                        echo '' .'<span style="color: red">' .$ctdh['giadathang1sp'] .'VND</span>';
                        echo "</td>";
                        echo "<td class=\"giosl\">";
                        echo "" .$ctdh['soluong'];
                        echo "</td>";

                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "<tr>";
                    echo "<td><br></td>";
                    echo "<td><br></td>";
                    echo "<td><br></td>";
                    echo "<td><br></td>";

                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>&emsp;</td>";
                    echo "<td >";
                    echo "&emsp; &emsp; &emsp; &emsp; &emsp; TỔNG TIỀN";
                    echo "</td>";
                    echo "<td >";
                    echo '' .'<span style="color: red">&emsp;' .$tongtien .'VND</span>';
                    echo "</td>";

                    echo "</tr>";
                    echo "</table>";

                }
                echo "</table>
            </div>
                    
                    <br>
                                
                    </div>";
                for ($j=0;$j <= $i;$j++){
                                        echo "<br>";
                                        echo "<br>";
                                        echo "<br>";
                                        echo "<br>";
                                        echo "<br>";
                                        

                                    }
                
                
                ?>
              
            
                           
                          
                               <br>
                               <br>
                                <br>
                               <br>
                               <br>
                               <br>
                                <br>
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
    </body>
</html>