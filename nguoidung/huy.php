    <?php
    session_start();

    if (!isset($_SESSION['tk'])){
        header('Location: index.php');
    }else if (isset($_GET['id']))
    {   $conn =  new mysqli('localhost','root','','banhang') or die  ('kết nối thất bại');
        mysqli_query($conn, 'SET NAMES UTF8');
        $id=$_GET['id'];
        $tk=$_SESSION['tk'];
        $lenh2 = "UPDATE donhang SET tinhtrang = 'huy' WHERE tkkh = '$tk' AND masodh = '$id' ";
        mysqli_query($conn, $lenh2);
        header('Location: donhang.php');
    }

    ?>
