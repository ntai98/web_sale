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
                            <div id="giohang">
                                <div id="thongtingiohang">
                                    <h2>THÔNG TIN GIỎ HÀNG</h2>
                                    <?php
                                    if (!isset($_SESSION['tk'])) {
                                        header('Location: index.php');
                                    }else{
                                        $tk = $_SESSION['tk'];
                                        $tongtien = 0;
                                        echo "<table >";
                                        $jsondatagh = file_get_contents('http://localhost/banhang/api/giohang/' .$tk);
                                        $jsongh = json_decode($jsondatagh,true);
                                        foreach ($jsongh as $gh){
                                            $jsondatahh = file_get_contents('http://localhost/banhang/api/hanghoa/'
                                                .$gh['mahang']);
                                            $hh = json_decode($jsondatahh,true);
                                            $tongtien = $tongtien + $hh['gia'] * $gh['soluong'];
                                            echo "<tr>";
                                            echo "<td><br></td>";
                                            echo "<td><br></td>";
                                            echo "<td><br></td>";
                                            echo "<td><br></td>";
                                            echo "<td><br></td>";
                                            echo "</tr>";
                                            echo "<tr>";
                                            echo "<td class=\"giohinh\">";
                                            echo("<a href=\"sanpham.php?id=".$gh['mahang'] ."\" target=\"\"><img src=\"hinh/"
                                                .$hh['hinh'] ."\" width=\"60px\" height=\"65px\"></a>" );
                                            echo "</td>";
                                            echo "<td class=\"gioten\">";
                                            echo("<a href=\"sanpham.php?id=".$gh['mahang'] ."\" target=\"\"> " .$hh['tenhang'] ."</a>" );
                                            echo "</td>";
                                            echo "<td class=\"giogia\">";
                                            echo '' .'<span style="color: red">' .$hh['gia'] .'VND</span>';
                                            echo "</td>";
                                            echo "<td class=\"giosl\">";
                                            echo "" .$gh['soluong'];
                                            echo "</td>";
                                            echo "<td class=\"gioxoa\">";
                                            echo("<a href=\"xoa.php?id=".$gh['mahang'] ."\" target=\"\"> " ."xóa</a>" );
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</table >";
                                        echo "<table >";

                                        echo "<tr>";
                                        echo "<td><br></td>";
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
                                        echo '<td colspan="2">&emsp;<button id="thanhtoangiohang" onclick="window.location.href=' .'\'thanhtoangiohang.php\'' .'">
          THANH TOÁN
          
       </button></td>';
                                        echo "</tr>";
                                        echo "</table>";
                                    }

                                    ?>
                                
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