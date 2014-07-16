<?php

	// function runScript($path, $param) {
	// 	exec($path . " " . $param , $rtnData);
	// 	return $rtnData;
	// }
	

	$article = "article";  //文件夹名

	if(!is_dir($article)){
		mkdir($article,0777);
	}

	for ($i=100000; $i <= 100050; $i++) { 
		//$output = runScript("php getData.php",$i);
		$curlobj = curl_init();
		curl_setopt($curlobj, CURLOPT_URL, "http://moment.douban.com/post/".$i."/");
		curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($curlobj);
		curl_close($curlobj);

		if(strpos($output,'id="title">')){

			if(($TxtRes=fopen($article."/".$i.".html","w+")) === FALSE){
			 
				echo("创建文章模版失败");   
				exit(); 
			}

			 
			if(!fwrite ($TxtRes,$output)){ //将信息写入文件
				echo ("尝试向文件写入内容失败！");
				fclose($TxtRes);
				exit();       
			}  
			 
			echo "文章爬下来啦！！\n\n";

			fclose ($TxtRes);
		}
		
	}

?>