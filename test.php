<?php
$ch = curl_init();
// 2. 设置选项，包括URL
curl_setopt ($ch, CURLOPT_PROXY, 'http://123.190.46.20:8080');
curl_setopt($ch, CURLOPT_URL, "http://moment.douban.com/post/103097/");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
// 3. 执行并获取HTML文档内容
$output = curl_exec($ch);
var_dump($output);
// 4. 释放curl句柄
curl_close($ch);
?>