<?php


$url = "http://www.xxx.com/e/admin/ecmsadmin.php";
$post_data["enews"] = "login";
$post_data["username"] = "admin";
$post_data["password"] = "Password";
$post_data["equestion"] = "0";
$post_data["eanswer"] = "";
$post_data["adminwindow"] = "0";
$post_data["empirecmskey1"] = "";
$post_data["empirecmskey2"] = "";
$post_data["empirecmskey3"] = "";
$post_data["empirecmskey4"] = "";
$post_data["empirecmskey5"] = "";
$post_data["imageField"] = "";



$cookie = dirname(__FILE__) . '/cookie.txt'; 



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt ($ch,CURLOPT_REFERER,'http://www.xxx.com/e/admin/index.php');
//帝国cms 判断来路不是本站后台提交就拒绝
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
//帝国cms post成功后，会 重定向到页面。必须跟踪获取cookie
curl_setopt($ch,CURLOPT_POST,1);
// 添加post数据到请求中
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

//设置cookie保存文件
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);


// 执行post请求，获得回复
$response= curl_exec($ch);
curl_close($ch);

//print_r($response);



        //登录后要获取信息的地址
    

	$urls = 'http://www.xxx.com/e/admin/ListAllInfo.php';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$urls);
curl_setopt($ch,CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);

	curl_setopt($ch,CURLOPT_COOKIEFILE,$cookie); 
$contents=curl_exec($ch);
curl_close($ch);
//转码显示
echo $contents;
?>
