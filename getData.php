<?php
	include('include/comFuc.php');

	// function runScript($path, $param) {
	// 	exec($path . " " . $param , $rtnData);
	// 	return $rtnData;
	// }
	

	// $article = "article";  //文件夹名

	// if(!is_dir($article)){
	// 	mkdir($article,0777);
	// }

	// $arrArt = traverse('article');
	// $fromNo = end($arrArt);//这种做法只能在本地执行

	//获取最新的js数据文件
	$sqlArrLast = (int)max(traverse('sqlData'));//记得替换路径


	//{"artId":104071,"dataJsNo":41}，里面的变量要双引号json_decode才有效果！
	$keepObj = json_decode(str_replace('var signal = ','',file_get_contents('js/keepTheArticleNo.js')),true);
	$fromNo = $keepObj['artId'];

	$noneNum = 0;
	$keepNo = array();
	//$artIdArr = array();
	$liArr = array();

	for ($i=($fromNo+1); $i <= ($fromNo+101); $i++) { 
		//$output = runScript("php getData.php",$i);

		$sUrl = "http://moment.douban.com/post/".$i."/";
		$proxyArr = array(0=>"http://121.248.150.107:8080",1=>"218.75.155.242:8888",2=>"http://116.228.80.186:8080");
		for ($j=0; $j < 3; $j++) { 
			$output = poster($sUrl,$proxyArr[$j]);
			if($output[1]!="403"){
				break; //这个才是跳出循环往下执行，不能用return
			}
		}
		
		
		
		if(strpos($output[0],'id="title">')&&strpos($output[0],'class="avatar"')){

			//array_push($artIdArr,$i);

			array_push($liArr,getHtmlDom($output[0],$i));

			// if(($TxtRes=fopen($article."/".$i.".html","w+")) === FALSE){
			 
			// 	echo("创建文章模版失败");   
			// 	exit(); 
			// }

			 
			// if(!fwrite ($TxtRes,$output[0])){ //将信息写入文件
			// 	echo ("尝试向文件写入内容失败！");
			// 	fclose($TxtRes);
			// 	exit();       
			// }  
			 
			// echo ("Hey!文章爬下来啦！！\n\n");

			// fclose ($TxtRes);
			$keepNo = $i;//记下文章序号
			$noneNum = 0;//清零

		}else{
			$noneNum++; echo $noneNum;
		}
		
		if($noneNum==100){echo "估计没有文章了(⊙０⊙)"; break;} 
	}

	$getLastArtNum = $keepObj['lastArtNum'];

	//空的话就不要建文件
	if(count($liArr)!=0){
		if($getLastArtNum<20){
			$getLastArt = json_decode(str_replace('var down_json = ','',file_get_contents('sqlData/data'.$sqlArrLast.'.js')),true);//获取最新的js数据文件内容
			if(count($liArr)<=(20-$getLastArtNum)){
				for ($i=0; $i < count($liArr); $i++) { 
					array_unshift($getLastArt,$liArr[$i]);					
				}
				$getLastArt = array_reverse($getLastArt);//低级错误啊啊啊，直接一句array_reverse($getLastArt);就完事了！！！！忘了重新赋值
				writeDown($getLastArt,$keepNo,($sqlArrLast-1),false);//-1是因为这里没有新增js数据文件
			}else{
				for ($i=0; $i < (20-$getLastArtNum); $i++) {
					array_unshift($getLastArt,$liArr[$i]);					
				}
				$getLastArt = array_reverse($getLastArt);
				writeDown($getLastArt,$keepNo,($sqlArrLast-1),false);//更新一下原来的js
				array_splice($liArr,0,(20-$getLastArtNum));//新爬到的文章ID补缺之后需要删除
				if(count($liArr)>20){
					longTimeNoCut($liArr,$keepNo,$sqlArrLast);
				}else{
					writeDown($liArr,$keepNo,$sqlArrLast,true);
				}
				
			}
		}else{
			if(count($liArr)>20){
				longTimeNoCut($liArr,$keepNo,$sqlArrLast);
			}else{
				writeDown($liArr,$keepNo,$sqlArrLast,true);
			}
		}
	}

	

	/*不生成文件，只是把文章id存入数组*/
	// $artIdArr = json_encode($liArr,true);
	// if(($jsRes=fopen("js/artIdArrData.js","w+")) === FALSE){	 
	// 	echo("Yo!js文件创建失败！！");   	 
	// 	exit(); 
	// }
	// if(!fwrite ($jsRes,$artIdArr)){
	// 	echo ("Shit!js写入失败！！");
	// 	fclose($jsRes);
	// 	exit();  
	// }else{
	// 	echo ("Yeah!js写入成功！！");
	// }

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