(function(window, $, undefined){
	var loadTimes = 0;
    var loaded = true;//加载过程中，滚动失效，防止重复加载
	var loadData = function(loadTimes){
		$.getScript("http://localhost/data.js",function(){//data.js放在本地访问，浏览器会报错
	    	if (typeof down_json != 'undefined' && down_json!=null) {
	    		var html = [];
	    		
	    		var totalNum = down_json.length;
	    		
	    		var perNum = loadTimes*10;
	    		
	    		for (var i = perNum; i < (perNum+10); i++) {
	    			
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
	loadData(loadTimes);

	

	var addData = function(){
		var anchor = $(".footer").offset().top + 100;
		if(loaded && ($(window).scrollTop() + $(window).height() > anchor)){
			loaded = false;
			$('#contentBar').fadeIn(1500);
			loadTimes++;
			setTimeout(function(){
				$('#contentBar').fadeOut(1500,function(){loadData(loadTimes);});				
			},2000);
		}
	};

	$(window).scroll(addData); 



})(window, jQuery);