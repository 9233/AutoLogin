	<?php
	
	$cookieVerify = dirname(__FILE__)."/1tingverify.txt";
    $cookieSuccess = dirname(__FILE__)."/1tingsuccess.txt";
	if(!$_POST){
	// 获取cookie并保存
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "http://my.1ting.com/login");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieVerify);
	$rs = curl_exec($ch);
	curl_close($ch); 
 
	// 带上cookie抓取验证码，必须带上cookie，否则验证码不对应
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "http://my.1ting.com/login/captcha");
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieVerify);
	$rs = curl_exec($ch);
	// 把验证码在本地生成，二次拉取验证码可能无法通过验证
	@file_put_contents("verify.jpg",$rs);
	curl_close($ch); 
	// 手工验证码表单
	echo "<form action=\"\" method=\"post\"><input type=\"text\" name=\"vcode\"><img src=\"verify.jpg\" /><br><input type=\"submit\" value=\"ok\"></form>";
}else{
	// 登录
	$ch = curl_init(); 
	// 用户名\密码 

	$verify = $_POST["vcode"];
	$url = "http://my.1ting.com/login"; 
 
	// 返回结果存放在变量中，不输出
    $ch = curl_init();	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieVerify);
	curl_setopt($ch, CURLOPT_HEADER, 1); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); 
			curl_setopt($ch,CURLOPT_POST,1);
		$post_data["user_login"] = "tarzany";
		$post_data["user_passwd"] = "7758521";
		$post_data["captcha"] = $verify;
		$post_data["remember"] = "1";
		$post_data["redirect"] = "/";
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_login); 
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieSuccess);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result= curl_exec($ch);
	curl_close($ch);
	// 登录成功,查看1769.tmp cookie文件有相应用户名等信息
	
	$url ="http://my.1ting.com/profile";
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieSuccess);
	curl_setopt($ch, CURLOPT_HEADER, 0); 

	$result= curl_exec($ch);
	curl_close($ch);
	
	echo $result;
	
}
		


		?>
