<?php
$fields_string = 'tkkh=ntai97&ngaydathang=2020-05-19 04:56:31&diachi= ấp A xã B Huyện tam bình tỉnh vĩnh long&ghichu=test';
$fields_string=urlencode($fields_string);
$url = 'http://localhost/banhang/api/donhang?tkkh=ntai97&ngaydathang=2020-05-19 04:56:31&diachi= ấp A xã B Huyện tam bình tỉnh vĩnh long&ghichu=test' ;
$url=urlencode($url);
$ch = curl_init();
//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

//execute post
$result = curl_exec($ch);
echo $result;
/*
$mk = md5('ntai97');
$lenh = 'tkkh=ntai97&mkkh=' .$mk ;
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
    echo "f=".$lenh."=";
    print_r($response);
}else {
    echo "true=".$mk."=";
    print_r($response);
}*/

/*
$mk = md5('ntai97');
$lenh = '&maloai=1&tennhom=test12' ;
$params = array('http' => array(
    'method' => 'POST',
    'content' => $lenh
));

$ctx = stream_context_create($params);
$sUrl = 'http://localhost/banhang/api/nhomhang/?' .$lenh;
$fp = @fopen($sUrl, 'rb', false, $ctx);
$response = @stream_get_contents($fp);
if ($response === false)
{
    echo "f";
}else echo "true";


}/*
//
/*

//
$jsondata = file_get_contents('http://localhost/banhang/api/noibac/');
$json = json_decode($jsondata,true);
$out = "";
$i = 0;
echo $json['2']['mahang'];
*/
?>