<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <title>豆瓣一刻web版</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="MapleShaw，豆瓣一刻，web版">
    <meta name="description" content="「一刻」是豆瓣推出的优质内容精选应用,每日为你推荐豆瓣上最新最有趣的文字和图片:精彩文章,热门话题,犀利评论,搞笑图片">
    <link rel="shortcut icon" href="http://img3.douban.com/dae/ps/favicon-1a867e6c05ced53a937e8f74ccea8b74.ico" type="image/x-icon">
    <link href="http://img3.douban.com/dae/ps/packed__init_-c74a4ad402548ed14a459b05088557e2.css" rel="stylesheet">
    <script>
      var Do=function(){
        Do.actions.push([].slice.call(arguments))
      };
      Do.ready=function(){
        Do.actions.push([].slice.call(arguments))
      };
      Do.add=Do.define=function(a,b){
        Do.mods[a]=b
      };
      Do.global=function(){
        Do.global.mods=Array.prototype.concat(Do.global.mods,[].slice.call(arguments))
      };
      Do.global.mods=[];Do.mods={};Do.actions=[];
    </script>
    
  <link href="http://img3.douban.com/dae/ps/packed_post-99bb6000696d86769c78886c3a0adc80.css" rel="stylesheet">

    <style>      
      .img span {
        display:block;
        text-align:center; 
        font-size:12px; 
        color:#999;
      }
      div.img {
        text-align:center; 
        display:block;
      }
      #content li{
        border-bottom:thin dotted #E4E4E4;
      }
      #content .avatar {
        display: inline;
        margin-right: 10px;
        border-radius: 50%;
        vertical-align: middle;
      }
    </style>
    <!-- COLLECTED CSS -->
  </head>

  <body>
    <div class="bs-header">
      <div class="container">
      <ul>
        
            <li><a href="/download/?source=post_header&amp;from_rec=&amp;target=android&amp;from_pid=100003" class="prestoicon-android">下载Android版</a>
          <li><a href="/download/?source=post_header&amp;from_rec=&amp;target=ios&amp;from_pid=100003" class="prestoicon-apple">下载iPhone版</a>
        
      </ul>
      <div class="nav-logo">
          <a class="logo" href="/">
            <img width="48" height="48" src="http://img3.douban.com/dae/ps/logo_56-3ef03413a90e85f954c144ced276b089.png" />
          </a>
          <a class="slogan" href="/">
            一刻
          <span>豆瓣每日内容精选，网页版精彩呈现</span>
          </a>
      </div>
      </div>
    </div>

    <div class="container bs-docs-container">
      
  <div class="post-container">
    <div>
      <h1 id="title">豆瓣一刻WEB版</h1>
    </div>
    <div class="meta">
      
      <img class="avatar" width="34" height="34" src="http://img3.douban.com/icon/u2718098-2.jpg" />
      
    
      <a href="http://www.douban.com/people/mapleshaw/">MapleShaw</a>
      
    
      
    </div>
    <div class="post-body">
      <div id="content">
        <ul>
        {foreach from=$liArr key=num item=value}
          <li>
            <p><a href="{$value.href}" target="_blank">{$value.title}</a></p>
            <img class="avatar" width="34" height="34" src="{$value.avatarImg}">
            <a href="{$value.authorHref}" target="_blank">{$value.author}</a>
            {if $value.contentImg!=''}
            <img src="{$value.contentImg}">
            {/if}
            <p>{$value.firstP}</p>
          </li>
        {/foreach}
        </ul>
      </div>
    </div>
    <div class="post-ft">
      
        <a href="http://www.douban.com/people/mapleshaw/">作者： MapleShaw</a>
      
      <div id="share">
        <a href="javascript: void 0;" class="bn-sharing" data-pic="http://img3.douban.com/dae/ps/rec-9e40bb1aeca2817802c192618a03df7d.jpg">分享到</a>
      </div>
    </div>
    <div style="width: 1px; height: 1px; overflow: hidden;">
      <img src="http://img3.douban.com/dae/ps/logo_300-073a230b5f6120f692791b46839d1d67.png" />
    </div>
  </div>

      
    </div>

    <div class="footer container">
      
  <div class="download">
    <div class="qrcode">
      
        <img width="130" height="130" src="http://img3.douban.com/dae/ps/qr_code_post-0e0fd81d11f7aa259db4ef75ecb3ba84.png" />
      
      <p>
        扫描二维码下载「一刻」
        <br /><span>支持&nbsp;iPhone&nbsp;和&nbsp;Android</span>
      </p>
    </div>
    <div class="intro">
      <h3>「一刻」是豆瓣推出的优质内容精选应用，web版本只为方便使用PC的时候阅读。当然还是希望伙伴们下载APP去enjoy！！</h3>
      <p class="download-links">
        <a href="/download/?source=post_bottom&amp;from_rec=&amp;target=ios&amp;from_pid=100003" class="prestoicon-apple">下载iPhone版</a>
        <a href="/download/?source=post_bottom&amp;from_rec=&amp;target=android&amp;from_pid=100003" class="prestoicon-android">下载Android版</a>
      </p>
    </div>
  </div>

      <p class="copyright">
        &#169;&nbsp;20013－2014&nbsp;www.mapleshaw.com, all rights reserved<br />
        夜小枫 
      </p>
    </div>
    <script src="http://img3.douban.com/dae/ps/packed_jquery-3f65fca509a1f376102d495e49aab3d3.js"></script>
    <script src="http://img3.douban.com/dae/ps/packed__init_-b0dff6b88063d6e7ba8d50aed4d2ece0.js"></script>
    
  <script>
    DoubanShareMenuList = [ 'sina', 'qzone', 'tx', 'renren', 'qqim' ];
    var __cache_url = __cache_url || {};
    (function(u){
      if(__cache_url[u]) return;
      __cache_url[u] = true;
      window.DoubanShareIcons = 'http://img3.douban.com/dae/ps/ic_shares-f68503761d6af275c750921ae009ec48.png';
      var initShareButton = function() {
        $.ajax({
          url:u,
          dataType:'script',
          cache:true
        });
      };
      Do('http://img3.douban.com/dae/ps/packed_dialog-00858c95c47f9a8b7c4dfa8b46873bd6.css',
         'http://img3.douban.com/dae/ps/packed_dialog-18636d243a9685d7a6acba9eb2846569.js',
         initShareButton);
      })('http://img3.douban.com/dae/ps/packed_sharebutton-d7d59156c913ec6298c013c972d6f64b.js');

    
  </script>

    <!-- COLLECTED JS -->
  </body>
</html>

