<?php
	include('include/simple_html_dom.php');
	require('Smarty/libs/Smarty.class.php');
	
	$smarty = new Smarty;	
	$html = new simple_html_dom();

	
	$html->load_file('article/100003.html');


	$title = $html->find('h1[id=title]',0);

	$content = $html->find('div[id=content]',0);
    $firstP = $content -> first_child ();
	
    $smarty->assign('title','MapleShaw的豆瓣一刻');
    $smarty->assign('content',$content);
	
	$indexOutput = $smarty->fetch('Smarty/demo/templates/index.tpl');



	if(($indexRes=fopen("index.html","w+")) === FALSE){
	 
		echo("首页创建失败！！");   
	 
		exit(); 
	}

	 
	if(!fwrite ($indexRes,$indexOutput)){
		echo ("首页写入失败！！");
		fclose($indexRes);
		exit();       
	}  
	 
	echo "首页生成啦！！\n\n";

	fclose ($indexRes);
		
?>