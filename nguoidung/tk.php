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
                    <li><a href="tk.php"><b><span style="color: red;">Thông tin tài khoản</span></b></a></li>
                    <li><a href="Capnhat.php">cập nhật thông tin</a></li>
                    <li><a href="doimk.php">Đổi mật khẩu</a></li>
                    <li><a href="donhang.php">Đơn hàng</a></li>
                  </ul>
                </div>
                                <div id="thongtintk"> 
                                <h3>Thông tin tài khoản</h3>
                                    <br>
                                    <br>
                                    <br>
            <div id="tttk">
            <table >
                <?php
                $tk=$_SESSION['tk'];
                $jsondatakh = file_get_contents('http://localhost/banhang/api/khachhang/' .$tk);
                $jsonkh = json_decode($jsondatakh,true);
                echo '<tr>
                                            <td>Họ và tên:</td>
                                            <td>' .$jsonkh['hotenkh'] .'</td>                 
                                        </tr>';
                echo "<tr>";

                echo "<td><br></td>";
                echo "<td><br></td>";
                echo "</tr>";
                echo '<tr>
                                                 <td>giới tính:</td>
                                                <td>' .$jsonkh['gioitinhkh'] .'</td>
                                            </tr>';
                echo "<tr>";

                echo "<td><br></td>";
                echo "<td><br></td>";
                echo "</tr>";
                echo '<tr>
                                            <td>địa chỉ:</td>
                                            <td>'  .$jsonkh['diachikh'] .'</td></tr>';
                echo "<tr>";

                echo "<td><br></td>";
                echo "<td><br></td>";
                echo "</tr>";
                echo '<tr>
                                            <td>số điện thoại:</td>  
                                            <td>0' .$jsonkh['sdtkh'] .'</td>
                                        </tr>';
                echo "<tr>";

                echo "<td><br></td>";
                echo "<td><br></td>";
                echo "</tr>";
                echo '<tr>
                                                    <td>chứng minh nhan dân:</td>
                                                    <td>' .$jsonkh['cmndkh'] .'</td>
                                                </tr>';
                echo "<tr>";

                echo "<td><br></td>";
                echo "<td><br></td>";
                echo "</tr>";



                ?>
              
            </table>
            </div>
                    
                    <br>
                                
                    </div>
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