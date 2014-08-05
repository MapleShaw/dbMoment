<?php
	include('include/simple_html_dom.php');
	require('Smarty/libs/Smarty.class.php');
	include('include/comFuc.php');
	
	
    
    $arrArticle = array_reverse(traverse('article'));//文章从最新的加载

	$smarty = new Smarty;	
	$html = new simple_html_dom();

	
	$count  =  count($arrArticle);

	$liArr = array();
	for ($i=0; $i < $count; $i++) { 

		$articleID = $arrArticle[$i];
		$html->load_file('article/'.$articleID.'.html');

		/*自定义想取的变量http://www.ecartchina.com/php-simple-html-dom/manual.htm*/
		$title = $html->find('h1[id=title]',0)->plaintext;
		$avatar = ($html->find('.avatar',0))?($html->find('.avatar',0)):'0';//取的是class，记得加上0，不管对象是不是只有一个
		$avatarImg = ($avatar=='0')?'http://img3.douban.com/dae/ps/logo_56-3ef03413a90e85f954c144ced276b089.png':$avatar->src;
		$author = ($avatar=='0')?'没有作者':$avatar -> next_sibling ()->plaintext;
		$authorHref = ($avatar=='0')?'http://www.douban.com':$avatar -> next_sibling ()->href;
		$content = $html->find('div[id=content]',0);

		if($html->find('img[id=img_1]',0)){
			$contentImg = $html->find('img[id=img_1]',0)->src;			
		}else{
			$contentImg = '';
		}
		echo $i;
		$firstP = $content -> find('p',0)?($content -> find('p',0)->plaintext):'没有文字';
		if($firstP == ''){
			$firstP = $content -> find('p',1)->plaintext;
		}
	    $href = "http://moment.douban.com/post/".$articleID."/";

	    /*存到模版数组*/
	    $liArr[$i]['title'] = $title;
	    $liArr[$i]['avatarImg'] = $avatarImg;
	    $liArr[$i]['author'] = $author;
	    $liArr[$i]['authorHref'] = $authorHref;
	    $liArr[$i]['contentImg'] = $contentImg;
	    $liArr[$i]['firstP'] = $firstP;
	    $liArr[$i]['href'] = $href;
	}

	$html->clear();//避免解析器消耗过多内存

    $smarty->assign('liArr',$liArr);
	
	$liJson = 'var down_json = '.json_encode($liArr,true);
    if(($jsRes=fopen("/js/data.js","w+")) === FALSE){
	 
		echo("Yo!js文件创建失败！！");   	 
		exit(); 
	}

	 
	if(!fwrite ($jsRes,$liJson)){

		echo ("Shit!js写入失败！！");
		fclose($jsRes);
		exit();  

	} 

	$indexOutput = $smarty->fetch('Smarty/demo/templates/index.tpl');


	if(($indexRes=fopen("index.html","w+")) === FALSE){
	 
		echo("Yo!首页创建失败！！");   	 
		exit(); 
	}

	 
	if(!fwrite ($indexRes,$indexOutput)){

		echo ("Shit!首页写入失败！！");
		fclose($indexRes);
		exit();  

	}  
	 
	echo "Hey!首页生成啦！！\n\n";

	fclose ($indexRes);
		
?>