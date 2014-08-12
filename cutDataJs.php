<?php
	$temp = file('js/dataTmp.js'); 
	
    $getArrIdJs = implode($temp); 

    $getArrIdJs = array_reverse(json_decode($getArrIdJs)); 

    $arrIdJsLen = count($getArrIdJs);
    
    for ($i=0; $i < ceil($arrIdJsLen/20); $i++) { //尽量不要出现写死的常量
    	$arrTmp = array();
    	for ($j=0; $j < 20; $j++) { 
    		$no = $i*20+$j;
    		if($no<$arrIdJsLen){
    			array_push($arrTmp, $getArrIdJs[$no]);
    		}else{
    			break;
    		}   		
    	}

    	$liJson = 'var down_json = '.json_encode(array_reverse($arrTmp),true);

	    if(($jsRes=fopen("sqlData/data".$i.".js","w+")) === FALSE){
		 
			echo("Yo!js文件创建失败！！");   	 
			exit(); 
		}
		 
		if(!fwrite ($jsRes,$liJson)){

			echo ("Shit!js写入失败！！");
			fclose($jsRes);
			exit();  

		} 
		echo "Shit!js".$i."写入成功！！\n\n";


    }
?>