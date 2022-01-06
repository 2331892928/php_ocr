<?php
	$_GET     && SafeFilter($_GET);
	$_POST    && SafeFilter($_POST);
	$_COOKIE  && SafeFilter($_COOKIE);
	$str =  isset($_POST['str']) ? $_POST['str'] : json(201,"图片不存在");//base64与链接
	$l =  isset($_POST['lg']) ? $_POST['lg'] : "";
	$type = isset($_POST['format']) ? $_POST['format'] : "json_txt";//json为json包含位置 json_txt是{code:200,msg:""} txt是纯字
	
	$mode = true;
	if(strpos($str, "http:") === 0) $mode = false;
	if(strpos($str, "https:") === 0) $mode = false;
	$wb = "";
	if($mode){//字节集
		$post_data = array(
		  'type' => 'commontext',
		  'image' => $str,
		  'image_url' => ''
		);
	}else{//链接
		$post_data = array(
		  'type' => 'commontext',
		  'image' => '',
		  'image_url' => $str
		);
	}
	$ym = send_post("https://cloud.baidu.com/aidemo",$post_data);
	$ym = json_decode($ym,true);
	if(!isset($ym['msg'])){
		json(500,"接口失效");
		
	}
	if($ym['msg']!='success'){
		json(500,$ym['msg']);
	}
	foreach ($ym['data']['words_result'] as $key => $value) {
		# code...
		$wb = $wb.$ym['data']['words_result'][$key]['words'];
	}
	if($type=="txt"){
		print($wb);
		exit();
	}
	if($type=="json_txt"){
		json(200,$wb);
	}else{
		json(200,$ym['data']['words_result']);
	}
	
	
	
	
	
	function SafeFilter ($arr)
	{
	   $ra=Array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/'
	   ,'/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/'
	   ,'/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/',
	   '/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/'
	   ,'/onmouseout/','/onmouseover/','/onmouseup/','/onunload/');
	     
	   if (is_array($arr))
	   {
	     foreach ($arr as $key => $value) 
	     {
	        if (!is_array($value))
	        {
	          if (!get_magic_quotes_gpc())  //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
	          {
	             $value  = addslashes($value); //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）  加上反斜线转义
	          }
	          $value       = preg_replace($ra,'',$value);     //删除非打印字符，粗暴式过滤xss可疑字符串
	          $arr[$key]     = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为 HTML 实体
	        }
	        else
	        {
	          SafeFilter($arr[$key]);
	        }
	     }
	   }
	}
	function json($code,$msg) {//json输出
		$udata = array('code'=>$code,'msg'=>$msg);
		$jdata = json_encode($udata);
		echo $jdata;
		exit;
	}
	function send_post($url, $post_data) {
	 
	  $postdata = http_build_query($post_data);
	  $options = array(
	    'http' => array(
	      'method' => 'POST',
	      'header' => 'Content-type:application/x-www-form-urlencoded',
	      'content' => $postdata,
	      'timeout' => 15 * 60 // 超时时间（单位:s）
	    )
	  );
	  $context = stream_context_create($options);
	  $result = file_get_contents($url, false, $context);
	 
	  return $result;
	}
	function is_not_json($str){  
	    return is_null(json_decode($str));
	}
?>
