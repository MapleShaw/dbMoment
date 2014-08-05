<?php
	include('include/comFuc.php');
	
	// function runScript($path, $param) {
	// 	exec($path . " " . $param , $rtnData);
	// 	return $rtnData;
	// }
	

	$article = "article";  //文件夹名

	if(!is_dir($article)){
		mkdir($article,0777);
	}

	$arrArt = traverse('article');
	$fromNo = end($arrArt);//这种做法只能在本地执行

	for ($i=$fromNo; $i <= ($fromNo+101); $i++) { 
		//$output = runScript("php getData.php",$i);

		$sUrl = "http://moment.douban.com/post/".$i."/";
		$proxyArr = array(0=>"http://123.190.46.20:8080",1=>"http://123.110.242.193:8088",2=>"http://1.59.159.176:18186");
		for ($j=0; $j < 3; $j++) { 
			$output = poster($sUrl,$proxyArr[$j]);
			if($output[1]!="403"){
				break; //这个才是跳出循环往下执行，不能用return
			}
		}
		
		
		
		if(strpos($output[0],'id="title">')&&strpos($output[0],'class="avatar"')){

			if(($TxtRes=fopen($article."/".$i.".html","w+")) === FALSE){
			 
				echo("创建文章模版失败");   
				exit(); 
			}

			 
			if(!fwrite ($TxtRes,$output[0])){ //将信息写入文件
				echo ("尝试向文件写入内容失败！");
				fclose($TxtRes);
				exit();       
			}  
			 
			echo ("Hey!文章爬下来啦！！\n\n");

			fclose ($TxtRes);
		}else{

		}
		
	}

	function poster($url,$proxy){
		$ua = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13';
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_PROXY, $proxy);//http://pachong.org/ 爬虫代理，会有问题，这些IP
		curl_setopt($ch,CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		$result = curl_exec($ch);


		$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		
		curl_close($ch);
		return array($result,$http_status);
	}
?>