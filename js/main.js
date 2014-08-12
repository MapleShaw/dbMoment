(function(window, $, undefined){

	$(window).resize(function(){resizeLoad();});
	
	/*侧边栏做自适应*/
	var resizeLoad = function(){
		var downHtml = '';
		$('.download').remove();
		if(document.body.clientWidth < 1500){

			downHtml = '<div class="download"><div class="qrcode"><img width="130" height="130" src="images/qr_code.png" /><p>扫描二维码下载「一刻」<br /><span>支持&nbsp;iPhone&nbsp;和&nbsp;Android</span></p></div><div class="intro"><h3>「一刻」是豆瓣推出的优质内容精选应用，web版本只为方便使用PC的时候阅读。当然还是希望伙伴们下载APP去enjoy！！</h3><p class="download-links"><a href="/download/?source=post_bottom&amp;from_rec=&amp;target=ios&amp;from_pid=100003" class="prestoicon-apple">下载iPhone版</a><a href="/download/?source=post_bottom&amp;from_rec=&amp;target=android&amp;from_pid=100003" class="prestoicon-android">下载Android版</a></p></div></div>';
			$('.footer').prepend(downHtml);
		}else{
			downHtml = '<div class="download"><div class="intro"><h3>「一刻」是豆瓣推出的优质内容精选应用，web版本只为方便使用PC的时候阅读。当然还是希望伙伴们下载APP去enjoy！！</h3><p class="download-links"><a href="/download/?source=post_bottom&amp;from_rec=&amp;target=ios&amp;from_pid=100003" class="prestoicon-apple">下载iPhone版</a><a href="/download/?source=post_bottom&amp;from_rec=&amp;target=android&amp;from_pid=100003" class="prestoicon-android">下载Android版</a></p></div><div class="qrcode"><img width="130" height="130" src="images/qr_code.png" /><p>扫描二维码下载「一刻」<br /><span>支持&nbsp;iPhone&nbsp;和&nbsp;Android</span></p></div></div>';
			$('body').append(downHtml);
		}
	};
	resizeLoad();

    //对getScript的一个优化，目前data.js还没有分割，一个文件随着文章数量的提升会变得很大，getScript在每次滚动加载都会调用，会重新请求一次data.js
	var scriptsArray = new Array();
    $.cachedScript = function(url, options) {
        //循环script标记数组 
        for (var s in scriptsArray) {
            //console.log(scriptsArray[s]); 
            //如果某个数组已经下载到了本地 
            if (scriptsArray[s] == url) {
                return { //则返回一个对象字面量，其中的done之所以叫做done是为了与下面$.ajax中的done相对应 
                    done: function(method) {
                        if (typeof method == 'function') { //如果传入参数为一个方法 
                            method();
                        }
                    }
                };
            }
        }
        //这里是jquery官方提供类似getScript实现的方法，也就是说getScript其实也就是对ajax方法的一个拓展 
        options = $.extend(options || {}, {
            dataType: "script",
            url: url,
            cache: true //其实现在这缓存加与不加没多大区别 
        });
        scriptsArray.push(url); //将url地址放入script标记数组中 
        return $.ajax(options);
    };




	var loadTimes = 0;
    var loaded = true;//加载过程中，滚动失效，防止重复加载
	var loadData = function(loadTimes){
		$.cachedScript("http://localhost/sqlData/data"+loadTimes+".js").done(function(){//data.js放在本地访问，浏览器会报错，http://www.mapleshaw.com/wp-content/moment/js/data.js
	    	if (typeof down_json != 'undefined' && down_json!=null) {
	    		var html = []; 
	    		
	    		var totalNum = down_json.length;
	    		
	    		//var perNum = loadTimes*10; 
	    		
	    		// for (var i = perNum; i < (perNum+10); i++) {
	    		// 	console.log(totalNum)
	    		// 	if(down_json[i].contentImg != ''){
	    		// 		html.push('<li>\
						 //            <p><a href="'+down_json[i].href+'" target="_blank" style="font-weight:bold;">'+down_json[i].title+'</a></p>\
						 //            <img class="avatar" width="34" height="34" src="'+down_json[i].avatarImg+'">\
						 //            <a href="'+down_json[i].authorHref+'" target="_blank">'+down_json[i].author+'</a>\
						 //            <img width="50%" height="50%" style="margin:10px;" src="'+down_json[i].contentImg+'">\
						 //            <p>'+down_json[i].firstP+'</p>\
						 //         </li>');
	    		// 	}else{
	    		// 		html.push('<li>\
						 //            <p><a href="'+down_json[i].href+'" target="_blank" style="font-weight:bold;">'+down_json[i].title+'</a></p>\
						 //            <img class="avatar" width="34" height="34" src="'+down_json[i].avatarImg+'">\
						 //            <a href="'+down_json[i].authorHref+'" target="_blank">'+down_json[i].author+'</a>\
						 //            <p>'+down_json[i].firstP+'</p>\
						 //         </li>');
	    		// 	}
	    				
	    		// }

	    		for (var i = 0; i < totalNum; i++) {
	    			
	    			if(down_json[i].contentImg != ''){
	    				html.push('<li>\
						            <p><a href="'+down_json[i].href+'" target="_blank" style="font-weight:bold;">'+down_json[i].title+'</a></p>\
						            <img class="avatar" width="34" height="34" src="'+down_json[i].avatarImg+'">\
						            <a href="'+down_json[i].authorHref+'" target="_blank">'+down_json[i].author+'</a>\
						            <img width="50%" height="50%" style="margin:10px;" src="'+down_json[i].contentImg+'">\
						            <p>'+down_json[i].firstP+'</p>\
						         </li>');
	    			}else{
	    				html.push('<li>\
						            <p><a href="'+down_json[i].href+'" target="_blank" style="font-weight:bold;">'+down_json[i].title+'</a></p>\
						            <img class="avatar" width="34" height="34" src="'+down_json[i].avatarImg+'">\
						            <a href="'+down_json[i].authorHref+'" target="_blank">'+down_json[i].author+'</a>\
						            <p>'+down_json[i].firstP+'</p>\
						         </li>');
	    			}
	    				
	    		}

	    		html = html.join('');
	    		$('#content').find('ul').append(html);
	    		loaded = true;
	    	}
	    });
	};

	//增加一个加载js文件的请求获得最新的dataJs文件序号
	$.cachedScript("http://localhost/keepTheArticleNo.js").done(function(){
		if (typeof signal != 'undefined' && signal!=null) {
			loadTimes = signal.dataJsNo;
			loadData(loadTimes);
		}
		
	});

	


	

	var addData = function(){
		var anchor = $(".footer").offset().top + 100;
		if(loaded && ($(window).scrollTop() + $(window).height() > anchor)){
			loaded = false;
			$('#contentBar').fadeIn(1500);
			loadTimes--;
			setTimeout(function(){
				$('#contentBar').fadeOut(1500,function(){loadData(loadTimes);});				
			},2000);
		}
	};

	$(window).scroll(addData); 



})(window, jQuery);