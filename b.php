<?php
$lenh = 'tkkh=ntai97&htkh=nguyen T tai&gioitinhkh=nam&dckh=tam binh vinh long&sdtkh=0327964989&cmndkh=123456789';
$lenh=str_replace(" ","+",$lenh);
//$lenh = 'tkkh=ntai97&htkh=a&gioitinhkh=nam&dckh=a&sdtkh=0327964989&cmndkh=123456789';
//$lenh = "tkkh=ntai97&mkkh=cdc7bf5424c4a07a383368400b5764c9&mkmoi=1dc7bf5424c4a07a383368400b5764c9";
/*$params = array('http' => array(
    'method' => 'PUT',
    'content' => $lenh,
));
$ctx = stream_context_create($params);
$sUrl = 'http://localhost/banhang/api/khachhang/?' .$lenh;
$fp = fopen($sUrl, 'rb', false, $ctx);
$response = file_get_contents($fp);*/
$params = array('http' => array(
    'method' => 'PUT',
    'content' => $lenh
));

$ctx = stream_context_create($params);
$sUrl = 'http://localhost/banhang/api/khachhang/?' .$lenh;
$fp = @fopen($sUrl, 'rb', false, $ctx);
$response = stream_get_contents($fp);

//true
/*$params = array('http' => array(
    'method' => 'PUT',
    'content' => $lenh
));
$ctx = stream_context_create($params);
$sUrl = 'http://localhost/banhang/api/khachhang/?' .$lenh;
$fp = @fopen($sUrl, 'rb', false, $ctx);
$response = stream_get_contents($fp);*/
print_r($response);

?>