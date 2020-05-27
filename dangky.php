
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>MUA BÁN ĐIỆN THOẠI </title>
        <link rel="stylesheet" href="index.css">
        
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
            

                
                
                <div id="slogan">
                    <img src="/bg/bgslogan.jpg" width="100%" height="140px">

                    <h1> MUA BÁN ĐIỆN THOẠI </h1>
                    
                 </div>

                <div id="noidung">              
                            <div id="dangki">
                                <h2>Đăng kí</h2>
                                <br>
                                <br>
                               <div id="dk">
                                   <form method="post">
            
            <table >
                <tr>
                    <td>Tên tài khoản:</td>
                    <td><input type="text"  name="Taikhoan"/>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr><td>Mật khẩu:</td>
                    <td><input type="password" name="Matkhau"/>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td>Họ và tên:</td>
                    <td><input type="text" name="Hoten"/>                 
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                     <td>giới tính:</td>
                    <td><select name="gt">
                        <option value="nam">nam</option>
                        <option value="nu">nu</option>
                        </select><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td>địa chỉ:</td>
                    <td><input type="text" name="Diachi"/>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td>số điện thoại:</td>
                    <td><input type="number" name="Sdt" />
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td>chứng minh nhan dân:</td>
                    <td><input type="number" name="cmnd" />
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input id="nutdk" type="submit" value="Đăng Kí" name="Dangki"/>
                    </td>
                </tr>
            </table>

            <?php

                if (isset($_POST['Dangki'])) {
                    //lấy thông tin từ các form bằng phương thức POST
                    $tk = $_POST['Taikhoan'];
                    $mk = md5($_POST['Matkhau']);
                    $hotenKH = $_POST['Hoten'];
                    $gt = $_POST['gt'];
                    $diachi = $_POST['Diachi'];
                    $sdt = $_POST['Sdt'];
                    $cmnd = $_POST['cmnd'];
                    //Kiểm tra điều kiện bắt buộc không được bỏ trống
                    if ($tk == "" || $mk == ""  || $hotenKH == "" || $gt == "" || $diachi == "" || $sdt == ""|| $cmnd == "") {
                           echo "bạn vui lòng nhập đầy đủ thông tin";
                    }else{
                            // Kiểm tra tài khoản đã tồn tại chưa
                        $jsondata = @file_get_contents('http://localhost/banhang/api/khachhang/' .$tk);
                        if( $jsondata === false){
                            $lenh = "tkkh="  .$tk ."&mkkh=" .$mk ."&htkh=" .$hotenKH ."&gioitinhkh=" .$gt
                                ."&dckh=" .$diachi ."&sdtkh="  .$sdt ."&cmndkh=" .$cmnd ;
                            $params = array('http' => array(
                                'method' => 'POST',
                                'content' => $lenh
                            ));
                            $ctx = stream_context_create($params);
                            $sUrl = 'http://localhost/banhang/api/khachhang/?' .$lenh;
                            $fp = @fopen($sUrl, 'rb', false, $ctx);
                            $response = @stream_get_contents($fp);
                            if ((string)$response == 'false')
                            {
                                echo "loi !";

                            }else echo '<META http-equiv="refresh" content="0;URL=./dangnhap.php' .'">';


                        }else echo "Tài khoản đã tồn tại";;

                      }
                }
              ?>
        </form>
                                </div>
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