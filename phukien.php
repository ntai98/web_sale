<?php session_start(); ?>
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

        <div id="menu2">
            <div id="dt" >
                <h2>ĐIỆN THOẠI</h2>
                <ul>
                    <?php
                    $jsondatamh = file_get_contents('http://localhost/banhang/api/nhomhang/?maloai=dt');
                    $jsonmh = json_decode($jsondatamh,true);
                    foreach($jsonmh as $nh) {
                        echo "<li><a href=\"dienthoai.php?id=" . $nh['manhom'] . "\">" . $nh['tennhom'] . "</a></li>";
                    }
                    ?>
                </ul>

            </div>
            <br><br>
            <div id="pk" >
                <h2>PHỤ KIỆN</h2>
                <ul>
                    <?php
                    $jsondatamh = file_get_contents('http://localhost/banhang/api/nhomhang/?maloai=pk');
                    $jsonmh = json_decode($jsondatamh,true);
                    foreach($jsonmh as $nh) {
                        echo "<li><a href=\"phukien.php?id=" . $nh['manhom'] . "\">" . $nh['tennhom'] . "</a></li>";
                    }
                    ?>
                </ul>

            </div>
        </div>

        <div id="noidungchinh">
            <div id="noibac">
                <h3>SẢN PHẨM NỔI BẬC</h3>
                <br>
                <?php
                include 'noibac.php';
                ?>

            </div>

            <br>
            <br>
            <div id="sanphammoi">
                <h3><?php
                    if (isset($_GET['id'])) {
                        $id=$_GET['id'];
                        $jsondatamn = file_get_contents('http://localhost/banhang/api/nhomhang/'.$id);
                        $jsonmn = json_decode($jsondatamn,true);
                        echo $jsonmn['tennhom'];

                    }

                    ?></h3>
                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $jsondatasp = file_get_contents('http://localhost/banhang/api/hanghoa/?manhom=' . $id);
                    $jsonsp = json_decode($jsondatasp, true);
                    foreach ($jsonsp as $hh) {
                        echo "<div class=\"sp\">";
                        echo("<a href=\"sanpham.php?id=" . $hh['mahang'] . "\" target=\"\"><img src=\"hinh/" . $hh['hinh']
                            . "\" width=\"100%\" height=\"280px\"></a>");
                        echo "<br>";
                        echo "<br>";

                        echo("<a href=\"sanpham.php?id=" . $hh['mahang'] . "\" target=\"\"> " . $hh['tenhang'] . "</a>");
                        echo "<br>";
                        echo "<br>";
                        echo("<p align=\"center\">" . $hh['gia'] . "VNĐ" . "</p>");
                        echo "</div>";
                    }
                }

                ?>



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