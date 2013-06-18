<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>
<body>
<?php
/**
 * php curl用例
 * site http://www.jbxue.com
*/
function curlrequest($url,$data,$method='post'){
 $ch = curl_init(); //初始化CURL句柄 
 curl_setopt($ch, CURLOPT_URL, $url); //设置请求的URL
 curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //设为TRUE把curl_exec()结果转化为字串，而不是直接输出 
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method); //设置请求方式
 
 curl_setopt($ch,CURLOPT_HTTPHEADER,array("X-HTTP-Method-Override: $method"));//设置HTTP头信息
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);//设置提交的字符串
 $document = curl_exec($ch);//执行预定义的CURL
 print_r($document);
 if(!curl_errno($ch)){ 
   $info = curl_getinfo($ch); 
   print_r($info);
   echo 'Took ' . $info['total_time'] . ' seconds to send a request to ' . $info['url']; 
 } else { 
   echo 'Curl error: ' . curl_error($ch); 
 }
 curl_close($ch);
 
 return $document;
}
//$url = 'http://bcs.duapp.com/mybucket?sign=MBO:********************';
$url = 'http://bcs.duapp.com/mybucket?sign=MBO:********************88888';
$data =  rawurldecode(json_encode(array (
			'statements' => array ( array (
							'user' => array ('*'), 
							'effect'=>'allow',
							'resource' => array ('mybucket\/'), 
							'action' => array ('get_object'), 
							'referer' => array('http://vip.mydemo.com/*','http://www.mydemo.com/*','http://mydemo.duapp.com//*','http://*.mydemo.duapp.com//*') ) ) )
			));
 
$return = curlrequest($url, $data, 'put');
var_dump($return);exit;
?>
</body>
</html>