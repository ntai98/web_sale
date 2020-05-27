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
                                <h3>Thông tin đơn hàng</h3>
                                    <br>
                                    <div id="chucnang2"> 
                                        <ul>
                                   <?php
                                   $tt = '';
                        if(isset($_GET['tt'])){
                            $tt=$_GET['tt'];
                            if ($tt == 'xn'){
                                echo '<li><a href="donhang.php">chưa xác nhận</a></li>
                    <li><a href="donhang.php?tt=xn"><b><span style="color: red;">đã xác nhận</span></b></a></li>
                    <li><a href="donhang.php?tt=ht">hoàn tất</a></li>
                    <li><a href="donhang.php?tt=huy">hủy</a></li>';
                            }else if ($tt == 'ht'){
                                echo '<li><a href="donhang.php">chưa xác nhận</a></li>
                    <li><a href="donhang.php?tt=xn">đã xác nhận</a></li>
                    <li><a href="donhang.php?tt=ht"><b><span style="color: red;">hoàn tất</span></b></a></li>
                    <li><a href="donhang.php?tt=huy">hủy</a></li>';
                            }else  if ($tt == 'huy'){
                                echo '<li><a href="donhang.php">chưa xác nhận</a></li>
                    <li><a href="donhang.php?tt=xn">đã xác nhận</a></li>
                    <li><a href="donhang.php?tt=ht">hoàn tất</a></li>
                    <li><a href="donhang.php?tt=huy"><b><span style="color: red;">hủy</span></b></a></li>';
                            }
                            
                        }else{
                            echo '<li><a href="donhang.php"><b><span style="color: red;">chưa xác nhận</span></b></a></li>
                    <li><a href="donhang.php?tt=xn">đã xác nhận</a></li>
                    <li><a href="donhang.php?tt=ht">hoàn tất</a></li>
                    <li><a href="donhang.php?tt=huy">hủy</a></li>' ;
                        }
                      ?>
                  
                    
                  </ul>
                </div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    
            <div id="tttk">
            
                <?php
                $tk=$_SESSION['tk'];
                $i=0;
                echo "<table >";
                if(isset($_GET['tt'])){
                            $tt=$_GET['tt'];
                            $tinhtrang = "";
                            switch ($tt){
                                case "xn" :
                                    $tinhtrang = 'daxacnhan';
                                    break;
                                case 'ht':
                                    $tinhtrang = 'hoantat';
                                    break;
                                case 'huy':
                                    $tinhtrang = 'huy';
                                    break;
                                default:
                                    break;
                            }
                }
                            if ($tt == 'xn'||$tt == 'ht'||$tt == 'huy'){
                                $jsondatadh = file_get_contents('http://localhost/banhang/api/donhang?tkkh='
                                    .$tk. '&tinhtrang=' .$tinhtrang);
                                $jsondh = json_decode($jsondatadh,true);
                                echo "<tr>";
                                echo "<td class=\"gioten\">Đơn hàng  </td>";
                                echo "<td class=\"giosl\" >Ngày khởi tạo</td>";
                                echo "<td class=\"gioxoa\">Địa chỉ nhận hàng</td>";
                                echo "</tr>";
                                foreach($jsondh as $dh) {
                                        $i++;
                                        echo "<tr>";
                                        echo "<td><br></td>";
                                        echo "<td><br></td>";
                                        echo "<td><br></td>";

                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td class=\"gioten\">";
                                        echo("<a href=\"chitietdonhang.php?iddh=".$dh['masodh'] ."\" target=\"\"> " .$dh['masodh'] ."</a>" );
                                        echo "</td>";

                                        echo "<td class=\"giosl\">";
                                        echo "" .$dh['ngaydathang'];
                                        echo "</td>";
                                        echo "<td class=\"gioxoa\">";
                                        echo "" .$dh['diachinhanhang'];
                                        echo "</td>";

                                        echo "</tr>";
                                        echo "<tr>";
                                        echo "<td><br></td>";
                                        echo "<td><br></td>";
                                        echo "<td><br></td>";

                                        echo "</tr>";

                                    }
                                    echo "</table>";
                                    echo "</div>
                    
                    <br>
                                
                    </div>";
                                    for ($j=0;$j <= $i;$j++){
                                        echo "<br>";
                                        echo "<br>";
                                        echo "<br>";
                                        echo "<br>";
                                        echo "<br>";


                                    }
                                }else {
                    $jsondatadh = file_get_contents('http://localhost/banhang/api/donhang?tkkh='
                        .$tk. '&tinhtrang=chuaxacnhan');
                    $jsondh = json_decode($jsondatadh,true);
                    echo "<tr>";
                    echo "<td class=\"gioten\">Đơn hàng  </td>";
                    echo "<td class=\"giosl\" >Ngày khởi tạo</td>";
                    echo "<td class=\"gioxoa\">Địa chỉ nhận hàng</td>";
                    echo "<td><br></td>";
                    echo "</tr>";
                    foreach($jsondh as $dh) {

                        $i++;
                        echo "<tr>";
                        echo "<td><br></td>";
                        echo "<td><br></td>";
                        echo "<td><br></td>";
                        echo "<td><br></td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td class=\"gioten\">";
                        echo("<a href=\"chitietdonhang.php?iddh=".$dh['masodh'] ."\" target=\"\"> " .$dh['masodh'] ."</a>" );
                        echo "</td>";

                        echo "<td class=\"giosl\">";
                        echo "" .$dh['ngaydathang'];
                        echo "</td>";
                        echo "<td class=\"gioten\">";
                        echo "" .$dh['diachinhanhang'];
                        echo "</td>";
                        echo "<td class=\"gioxoa\">";
                        echo("<a href=\"huy.php?id=".$dh['masodh'] ."\" target=\"\"> " ."huy" ."</a>" );
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td><br></td>";
                        echo "<td><br></td>";
                        echo "<td><br></td>";
                        echo "<td><br></td>";

                        echo "</tr>";

                    }
                    echo "</table>";
                    echo "</div>
                    
                    <br>
                                
                    </div>";
                    for ($j=0;$j <= $i;$j++){
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";
                        echo "<br>";


                    }
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
    </body>
</html>