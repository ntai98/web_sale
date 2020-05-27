<?php session_start();
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

                    <div >
                       <br>
                        <div id="sanpham">
                            <h2>SẢN PHẨM</h2>
                            <div id="hinh">
                                
                                <?php
                            if (isset($_GET['id'])) {
                                $id=$_GET['id'];
                                $jsondatahh = file_get_contents('http://localhost/banhang/api/hanghoa/'.$id);
                                $hh = json_decode($jsondatahh,true);
                                echo "<img src=\"hinh/" .$hh['hinh'] ."\" width=\"400px\" height=\"450px\">" ;

                            }
                            
                        ?>
                            </div>
                            <div id="thongtin">
                                <br>
                                <br>
                                <form method="POST" >
                                <?php
                            if (isset($_GET['id'])) {

                                        echo "<h3>" .$hh['tenhang'] ."</h3>";
                                        echo "<br>";
                                        echo "<br>";
                                        echo'
                                                <table>
                                                    <tr>
                                                        <td>Giá:</td>
                                                        <td>' .$hh['gia'] .' VND</td>
                                                    </tr>
                                                    <tr>
                                                        <td><br></td>
                                                        <td><br></td>
                                                    </tr>
                                                    <tr>
                                                        <td>số lượng:</td>
                                                        <td><input id="muasl" type="number" name="sl" value="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td > <input id="gio" type="submit" name="gio" value="THÊM VÀO GIỎ HÀNG"></td>
                                                        <td > <input id="mua" type="submit" name="mua" value="MUA NGAY!"></td>
                                                    </tr>
                                                </table>';
                            }
                            
                        ?>  
                                    <?php
                                
                                if(!isset($_SESSION['tk']) AND isset($_POST['gio'])){
                                   
                                   echo '<script language="javascript">
                                        alert("bạn chưa đăng nhập");
                                    </script>';
                                }else if(isset($_POST['gio'])){
                                   $tk=$_SESSION['tk'];
                                   $id=$_GET['id'];
                                   $sl=$_POST['sl'];

                                    $lenh = 'tkkh='.$tk .'&mahang=' .$id .'&soluong=' .$sl ;
                                    $params = array('http' => array(
                                        'method' => 'POST',
                                        'content' => $lenh
                                    ));

                                    $ctx = stream_context_create($params);
                                    $sUrl = 'http://localhost/banhang/api/giohang/?' .$lenh;
                                    $fp = @fopen($sUrl, 'rb', false, $ctx);
                                    $response = @stream_get_contents($fp);
                                    if ((string)$response == 'false')
                                    {
                                        echo '<script language="javascript">
                                                alert("Thêm thất bại! vui lòng kiểm tra lại sản phẩm này đã có " +
                                                 "trong giỏ hàng của bạn hay chưa");
                                            </script>';

                                    }else {
                                        echo '<script language="javascript">
                                                alert("đã thêm vào giỏ hàng của bạn");
                                            </script>';
                                        
                                    }

                                   
                                }
                                if(!isset($_SESSION['tk']) AND isset($_POST['mua'])){
                                   
                                    echo '<script language="javascript">
                                            alert("bạn chưa đăng nhập");
                                        </script>';
                               }else if(isset($_POST['mua'])){
                                   $id=$_GET['id'];
                                   $sl=$_POST['sl'];
                                   echo '<META http-equiv="refresh" content="0;URL=thanhtoan.php?id=' .$id ,'&sl=' .$sl .'">';
                                   
                                }
                               
                               ?>
                                    </form>
                                
                            </div>
                            <br>
                            <br>
                           <div id="mota">
                               <h3>MÔ TẢ SẢN PHẨM</h3>
                                <?php
                            if (isset($_GET['id'])) {

                                        echo "" .$hh['mota']  ;
                            }
                            
                        ?>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <br >
                    <br >
                    <br >
                    <br >
                    <br >
                    <br >

                
                </div>
            </div>
    </body>
</html>