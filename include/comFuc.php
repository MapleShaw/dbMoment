<?php 
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
 ?>