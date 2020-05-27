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
                    <li><a href="doimk.php"><b><span style="color: red;">Đổi mật khẩu</span></b></a></li>
                    <li><a href="donhang.php">Đơn hàng</a></li>
                  </ul>
                </div>
                                <div id="thongtintk"> 
                                <h3>Cập nhật thông tin</h3>
                                    <br>
                                    <br>
                                    <br>
                                <form  method="post">
            <div id="tttk">
            <table >
                <tr>
                    <td>nhập mật khẩu hiện tại:</td>
                    <td><input type="password" name="mk" />                 
                </tr>
                 <tr><td><br></td><td><br></td></tr><tr>
                    <td>mật khẩu mới:</td>
                    <td><input type="password" name="mk1"/>
                </tr><tr><td><br></td><td><br></td></tr><tr>
                    <td>nhập lại mật khẩu mới:</td>  
                    <td><input type="password" name="mk2" />
                </tr>
                <tr><td><br></td><td><br></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input id="capnhat"  type="submit" value="Cập nhật" name="capnhat"/>
                    </td>
                </tr>

                

              
            </table>
            </div>
            <?php 
                if (isset($_POST['capnhat'])) {
                    $tk=$_SESSION['tk'];
                    $mk = md5($_POST['mk']);
                    $mk1 = md5($_POST['mk1']);
                    $mk2 = md5($_POST['mk2']);

                        if($mk1 != $mk2){
                           echo '<script language="javascript">
                    alert("mật khẩu mới và nhập lại mật khẩu mới không giống nhau !");
                </script>';
                        }else{
                            $lenh = "tkkh="  .$tk ."&mkkh=" .$mk ."&mkmoi=" .$mk2 ;
                            $params = array('http' => array(
                                'method' => 'PUT',
                                'content' => $lenh
                            ));
                            $ctx = stream_context_create($params);
                            $sUrl = 'http://localhost/banhang/api/khachhang/?' .$lenh;
                            $fp = @fopen($sUrl, 'rb', false, $ctx);
                            $response = @stream_get_contents($fp);
                            if ((string)$response == 'false')
                            {
                                echo '<script language="javascript">
                    alert("lõi! có thể bạn nhập sai mật khẩu hiện tại !");
                </script>';

                            }else echo '<script language="javascript">
                    alert("thành công !");
                </script>';


                        }

                }
              ?>
        </form>        
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