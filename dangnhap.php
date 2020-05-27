<?php session_start(); ?>

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
                                <h2>Đăng nhập</h2>
                                <br>
                                <br>
                               <div id="dk">
                                   <form method="POST" action="dangnhap.php">
	    	<table>
	    		<tr>
	    			<td>tài khoản</td>
	    			<td><input type="text" name="tk" size="30"></td>
	    		</tr>
	    		<tr>
	    			<td>mật khẩu</td>
	    			<td><input type="password" name="mk" size="30"></td>
	    		</tr>
	    		<tr>
	    			<td colspan="2" align="center"> <input type="submit" name="dangnhap" value="Đăng nhập"></td>
	    		</tr>
	    	</table>
  </form>
    <?php
	
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST['dangnhap'])) {
		// lấy thông tin người dùng
		$tk = $_POST['tk'];
		$mk = $_POST['mk'];
		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$tk = strip_tags($tk);
		$tk = addslashes($tk);
		$mk = strip_tags($mk);
		$mk = addslashes($mk);
        $mk=md5($mk);
        error_reporting(0); //tat thong bao loi
		if ($tk == "" || $mk =="") {
			echo "tài khoản hoặc mật khẩu bạn không được để trống!";
		}else{
            $lenh = 'tkkh='.$tk .'&mkkh=' .$mk ;
            $params = array('http' => array(
                'method' => 'POST',
                'content' => $lenh
            ));

            $ctx = stream_context_create($params);
            $sUrl = 'http://localhost/banhang/api/khachhang/?' .$lenh;
            $fp = fopen($sUrl, 'rb', false, $ctx);
            $response = stream_get_contents($fp);

            if ((string)$response == 'false')
            {
                echo "tên đăng nhập hoặc mật khẩu không đúng !";
            }else {
                //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
                $_SESSION['tk'] = $tk;
                // Thực thi hành động sau khi lưu thông tin vào session
                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
                header('Location: index.php');

            }
		}
	}
    ?>
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