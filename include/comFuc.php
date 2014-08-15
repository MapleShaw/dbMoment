<?php 
include('include/simple_html_dom.php');

/*读取article文件夹下的所有文件，把文件名存入数组*/
    function traverse($path = '.') {
        $isArticle = array();
        $num = 0;
        $current_dir = opendir($path);    //opendir()返回一个目录句柄,失败返回false
        while(($file = readdir($current_dir)) !== false) {    //readdir()返回打开目录句柄中的一个条目
            $sub_dir = $path . DIRECTORY_SEPARATOR . $file;    //构建子目录路径

            if($file == '.' || $file == '..' || strstr($file,'_')) {
                continue;
            } else {    //如果是文件,直接输出
                $isArticle[$num] = substr(basename($file,".js"),4);//获取文件名，去掉后缀
                $num++;
            }
        }
        return $isArticle;
    }



    function getHtmlDom($output,$i){
        $html = new simple_html_dom();
        $html->load($output);

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
        $href = "http://moment.douban.com/post/".$i."/";

        /*存到模版数组*/
        $liArr[$i]['title'] = $title;
        $liArr[$i]['avatarImg'] = $avatarImg;
        $liArr[$i]['author'] = $author;
        $liArr[$i]['authorHref'] = $authorHref;
        $liArr[$i]['contentImg'] = $contentImg;
        $liArr[$i]['firstP'] = $firstP;
        $liArr[$i]['href'] = $href;

        $html->clear();

        return $liArr[$i];
    }

    function writeDown($liArr,$keepNo,$sqlArrLast,$addOrUpdate){
        $lastArtNum = count($liArr);
        $liArr = array_reverse($liArr);
        $liJson = 'var down_json = '.json_encode($liArr,true);

        if(($jsRes=fopen("sqlData/data".($sqlArrLast+1).".js","w+")) === FALSE){
         
            echo("Yo!js文件创建失败！！");       
            exit(); 
        }
         
        if(!fwrite ($jsRes,$liJson)){

            echo ("Shit!js写入失败！！");
            fclose($jsRes);
            exit();  

        } 

        /*增加js文件记录文章序号和数据文件序号，如果只是更新js就不需要这一步*/
        if($addOrUpdate){
            $keepNo = array("artId"=>$keepNo,"dataJsNo"=>($sqlArrLast+1),"lastArtNum"=>$lastArtNum);
            $keepNoJson = 'var signal = '.json_encode($keepNo,true);
            if(($txtRes=fopen("js/keepTheArticleNo.js","w+")) === FALSE){
             
                echo("Yo!记录文件创建失败！！");       
                exit(); 
            }
            
            if(!fwrite ($txtRes,$keepNoJson)){

                echo ("Shit!记录写入失败！！");
                fclose($txtRes);
                exit();  

            }
            echo ("Yeah!js写入成功！！"); 
        }
        
    }

    function longTimeNoCut($arr,$arrNo,$sqlArrLast){
        $arrNum = count($arr);
        for ($i=0; $i < ceil($arrNum/20); $i++) { //尽量不要出现写死的常量
            $arrTmp = array();
            for ($j=0; $j < 20; $j++) { 
                $no = $i*20+$j;
                if($no<$arrNum){
                    array_push($arrTmp, $arr[$no]);
                }else{
                    break;
                }           
            }
            //array_splice($arr,0,20);不需要这个，上面for循环超过二十之后是继续叠加21，22...这样，加上这句反而会出现undefined offset
            writeDown($arrTmp,$arrNo,$sqlArrLast+$i,true);
        }
    }

 ?>