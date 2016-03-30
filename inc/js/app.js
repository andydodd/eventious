/**
 * Created by andy on 28/07/15.
 */
$(window).bind( 'orientationchange', function(e){scaleOnRotation($.event.special.orientationchange.orientation());});

function scaleOnRotation(newOrientation){
	thisWidth = $(window).width();
	thisHeight = $(window).height();
	if (thisWidth > thisHeight) {
		var oriented = 'landscape';
	} else {
		var oriented = 'portrait';
	}
	var rota = document.getElementById('projectViewport');
	rota.setAttribute('content','width=device-width');
	/*
	 if (oriented == 'portrait') {
	 rota.setAttribute('content','initial-scale=1.0');
	 $('.box').width('96%');
	 }else{
	 rota.setAttribute('content','initial-scale=1.0');
	 if(thisWidth < 800){
	 $('.box').width('96%');
	 }else{
	 $('.box').width('29%');
	 }
	 }
	 */

	if (thisWidth < 500) {
		//$('#nav').css("bottom","0px");
		//$('#siteLogo').css("display","none");
		//$('#headerBar').css("height","10vh");
	}
	if (thisWidth >= 500) {
		//$('#nav').css("bottom","0px");
		//$('#siteLogo').css("display","block");
	}
}

//load url variable

function getUrlVars(){
	var vars = [], hash;
	var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');

	for(var i = 0; i < hashes.length; i++)
	{
		hash = hashes[i].split('=');
		vars.push(hash[0]);
		vars[hash[0]] = hash[1];
	}

	return vars;
}

//Cookies
function cookieMonster(name){
	if ($.cookie(name)) {
		return $.cookie(name);
	}else{
		var uuid = guid();
		$.cookie(name, uuid);
		return uuid;
	}
}
var guid = (function() {
	function s4() {
		return Math.floor((1 + Math.random()) * 0x10000)
			.toString(16)
			.substring(1);
	}
	return function() {
		return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
			s4() + '-' + s4() + s4() + s4();
	};
})();

//set initial var states
console.log(window.location);
console.log(window.location.pathname.substr(window.location.pathname.lastIndexOf('/') + 1));


var coreLocation = 'https://rumpr-1.appspot.com/core';

if(window.location.hostname === "dev-dot-slicethepie-0001.appspot.com"){
	var coreLocation = 'https://dev_core.soundout.com';
}



if(window.location.hostname === "http://rumpr-1.appspot.com/"){
	var coreLocation = 'https://rumpr-1.appspot.com/core';
}

var thisAppLocation = 'http://'+ window.location.hostname;
var thisApp = 'rumpr';
var hasPlayed = false;
var confShown = false;
var navOpen = false;
var popOpen = false;
var userId = cookieMonster(thisApp+'_uid');
var urlVars = getUrlVars();

var geolocationResponse = false;
var currentType = false;

var url = window.location.pathname;
var thisfilename = url.substring(url.lastIndexOf('/')+1);

var d = new Date();
var thisYear = d.getFullYear();
var thisMonth = d.getMonth() + 1;
var thisDay = d.getDate();


$(document).ready(function() {
	scaleOnRotation(window.orientation);
	/*
	setTimeout(function(){
		window.location.href = thisAppLocation;
	}, 1800000);
	*/
	if(urlVars.c) {
		pageController(urlVars.c);
	}else{
		pageController('splash');
	}
	load('footerBar');
});

function goTo(thisLink){
	window.location.href = thisAppLocation+"/?c="+thisLink;
}

function pageController(type){
	$('#loading').slideDown('fast');

	content(type);
	history.pushState(null, type, "?c="+type);
	load('navigation');

	var pageLoaded = setInterval(function() {
		if (!$.ajaxq.isRunning()) {
			$('#loading').slideUp('slow');
			clearInterval(pageLoaded);
		}
	}, 500); // check every x ms
}

function content(type){
	$.ajaxq('page',{
		type: "POST",
		url: coreLocation + '/content.php',
		data: {id: userId, type: type} ,
		timeout: 30000, // in milliseconds
		dataType: 'JSON',
		success: function(data) {
			if(data.result.redirect){
				pageController(data.result.redirect);
			}else {
				$('#contentContainer').html(data.result.content);
				$('#contentContainer').trigger('create');
				if(data.result.box_order){
					for(var key in data.result.box_order ){
						console.log(data.result.box_order[key]);
						$('#'+data.result.box_order[key]).appendTo('#contentContainer');
					}
				}
			}
		},
		error: function(request, status, err) {
			/*do something about the error*/
		}
	});
}

function load(type){
	$.ajaxq('page',{
		type: "POST",
		url: coreLocation + '/load.php',
		data: {id: userId, type: type} ,
		timeout: 30000, // in milliseconds
		dataType: 'JSON',
		success: function(data) {
			$('#'+type).html(data.result.content);
			$('#'+type).trigger('create');
		},
		error: function(request, status, err) {
			/*do something about the error*/
		}
	});
}
