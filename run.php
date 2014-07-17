<?php
	include('include/simple_html_dom.php');
	require('Smarty/libs/Smarty.class.php');
	
	
	/*读取article文件夹下的所有文件，把文件名存入数组*/
    function traverse($path = '.') {
    	$isArticle = array();
    	$num = 0;
        $current_dir = opendir($path);    //opendir()返回一个目录句柄,失败返回false
        while(($file = readdir($current_dir)) !== false) {    //readdir()返回打开目录句柄中的一个条目
            $sub_dir = $path . DIRECTORY_SEPARATOR . $file;    //构建子目录路径
            if($file == '.' || $file == '..') {
                continue;
            } else {    //如果是文件,直接输出
                $isArticle[$num] = basename($file,".html");//获取文件名，去掉后缀
                $num++;
            }
        }
        return $isArticle;
    }
    
    $arrArticle = traverse('article');

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
    if(($jsRes=fopen("data.js","w+")) === FALSE){
	 
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