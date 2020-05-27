    <?php
    session_start();
    if (!isset($_SESSION['tk'])){
        header('Location: index.php');
    }else if (isset($_GET['id']))
    {
        $id=$_GET['id'];
        $tk=$_SESSION['tk'];
        $lenh = 'tkkh=' .$tk .'&mahang='.$id;
        $params = array('http' => array(
            'method' => 'DELETE',
            'content' => $lenh
        ));

        $ctx = stream_context_create($params);
        $sUrl = 'http://localhost/banhang/api/giohang/?' .$lenh;
        $fp = @fopen($sUrl, 'rb', false, $ctx);
        $response = @stream_get_contents($fp);
        //echo $sUrl;
        header('Location: giohang.php');
    }

    ?>
