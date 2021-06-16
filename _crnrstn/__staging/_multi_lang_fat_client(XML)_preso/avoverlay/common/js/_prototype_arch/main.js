/* 
// J5
// Code is Poetry */

//
// INITIALIZE
Event.observe(window, 'load', initGlobal, false);
//Event.observe(window, 'keydown', clearScriptures, false);

function initGlobal(){

	//
	// START TIMER
	if($('message_time_wrapper')) {
		startCount();
	}
}

function applyUpdate(elem){

	var http_dir = $("ajax_root").innerHTML;
	var uri = http_dir + 'social/fellowship/avsvc_overlay/admin/management/_update/';

	if($("script_popup_lock").innerHTML=="OFF") {

		$("script_popup_lock").innerHTML = "ON";

		var params = 'postid=' + elem.getAttribute('avreqid');

		var myAjax = new Ajax.Request(
			uri,
			{
				method: 'post',
				parameters: params,
				onComplete: function (xhr)
				{
					//var myHtml = xhr.responseText;
					var resp = xhr.responseText;
					var http_dir = $("ajax_root").innerHTML;

					//alert('return success redirect per success ['+resp+']');

					//if(resp=="success"){
						//
						// SEND BACK TO ADMIN PAGE
						//loadPageFromIndex(http_dir+'social/fellowship/avsvc_overlay/admin/');

					//}else{

						//
						// RESPONSE IS
						loadPageFromIndex(http_dir+'social/fellowship/avsvc_overlay/admin/?rs='+resp);

					//}
				}
			});

	}else{

		alert("I appear to be currently processing the previous request; nothing else should be done as of yet. Please stand by...whilst faithfully exercising rule number one (1). Amen.")
	}

}

function scripture_return(elem){

	// http://jony5.com/scriptures/?vv=matt3_15
	// alert(elem.id);

	var http_dir = $("ROOT_PATH_CLIENT_HTTP_DIR").innerHTML;
	var query = window.location.href;
	var vars = query.split("/");
	var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';

	var uri = http_dir + 'scriptures/';

	var arrayPageSize = getPageSize();

	// calculate top offset for the popup
	var arrayPageSize = getPageSize();
	var arrayPageScroll = getPageScroll();
	var scriptureTop = arrayPageScroll[1] + (arrayPageSize[3] / 15);
	var toppx = scriptureTop + 'px';

	$("script_popup_lock").innerHTML = "ON";

	if($("script_popup")) {
		$("script_popup").innerHTML = '<div id="script_wrapper">' +
			'<div id="script_loading_book_icon"><img src="' + HTTP_ROOT + http_dir + 'common/imgs/book_icon.jpg" width="600" height="200" alt="Holy Bible" title="Holy Bible"></div>' +
			'<div id="script_loading"><img src="' + HTTP_ROOT + http_dir + 'common/imgs/long_loader.gif" width="220" height="19" alt="CRNRSTN :: LOADING..." title="CRNRSTN :: LOADING..."></div>' +
			'<div class="cb"></div></div>';

		$("script_popup").style.setProperty("top", toppx);

		uri = HTTP_ROOT + uri;
		var params = 'vv=' + elem.getAttribute('vvid');
		var myAjax = new Ajax.Request(
			uri,
			{
				method: 'get',
				parameters: params,
				onComplete: displayScriptures
			});

	}

}

function displayScriptures(scriptRequest){
	var resp = scriptRequest.responseText;

	if(resp!=""){

		var arrayPageSize = getPageSize();

		// calculate top offset for the popup
		var arrayPageSize = getPageSize();
		var arrayPageScroll = getPageScroll();
		var scriptureTop = arrayPageScroll[1] + (arrayPageSize[3] / 15);
		var toppx = scriptureTop + 'px';

		$("script_popup_lock").innerHTML = "OFF";
		$("script_popup").innerHTML = resp;
		document.getElementById('script_popup').style.setProperty("top", toppx);

		var el;
		var i = 0;
		var fragment = document.createDocumentFragment();

		el = document.createElement('div');
		el.innerHTML = resp;
		fragment.appendChild(el);
		$("script_popup").innerHTML = '';
		$("script_popup").appendChild(fragment);

		/*
		var el;
		var i = 0;
		var fragment = document.createDocumentFragment();

		while (i < 200) {
			el = document.createElement('li');
			el.innerText = 'This is my list item number ' + i;
			fragment.appendChild(el);
			i++;
		}

		div.appendChild(fragment);
		*/

	}

}

function lockPopup(curr_action='silent'){

	$("script_popup_lock").innerHTML = "ON";

	switch(curr_action){
		case 'silent_the_ide':
		case 'silent':
			// is golden
		break;
		default:
			//
			launch_newwindow(curr_action);

		break;
	}

}

function clearScriptures(){

	if($("script_popup_lock").innerHTML=='OFF'){

		$("script_popup").innerHTML = "";
		
	}
}

function closePolarBearOverlay(){
	
	//new Effect.Appear('lightbox', { duration: 0.0, from: 0.0, to: 0.0, afterFinish: function(){
		//$('lightbox').style.display='none;';  
		
	//}  });

	//new Effect.Appear('overlay', { duration: 0.0, from: 0.0, to: 0.0, afterFinish: function(){
		//$('overlay').style.display='none;';  
		
	//}  });

	$('lightbox').hide();
	new Effect.Fade(('overlay'), { duration:1 });

}


//
// getPageScroll()
// Returns array with x,y page scroll values.
// Core code from - quirksmode.org
//
function getPageScroll(){

	var yScroll;

	if (self.pageYOffset) {
		yScroll = self.pageYOffset;
	} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
		yScroll = document.documentElement.scrollTop;
	} else if (document.body) {// all other Explorers
		yScroll = document.body.scrollTop;
	}

	arrayPageScroll = new Array('',yScroll)
	return arrayPageScroll;
}

// -----------------------------------------------------------------------------------

//
// getPageSize()
// Returns array with page width, height and window width, height
// Core code from - quirksmode.org
// Edit for Firefox by pHaez
//
function getPageSize(){

	var xScroll, yScroll;

	if (window.innerHeight && window.scrollMaxY) {
		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}

	var windowWidth, windowHeight;
	if (self.innerHeight) {	// all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}

	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else {
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){
		pageWidth = windowWidth;
	} else {
		pageWidth = xScroll;
	}


	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight)
	return arrayPageSize;
}


function rotateBanner() {

	var tmp_mode = $("banner_mode_track").innerHTML;

	if(tmp_mode=='PLAY'){

		var query = window.location.href;
		var vars = query.split("/");
		var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
		//alert(HTTP_ROOT);
		var uri = $("banner_endpoint").innerHTML;
		uri = HTTP_ROOT+uri;
		var params = '';
		var myAjax = new Ajax.Request(
		uri,
		{
			method: 'get',
			parameters: params,
			onComplete: updateBannerHTML
		});

	}

}


function updateBannerHTML(formRequest){
	var resp = formRequest.responseText;

	if(resp!=""){
		$("banner_lifestyle").innerHTML = $("banner_cache").innerHTML;
		$("banner_cache").innerHTML = resp;
	}
	
}

function toggleTransactionWrapperOpen(){
	new Effect.Appear('user_transaction_wrapper', { duration: 0.1, from: 0.0, to: 1.0 });
	new Effect.toggle('user_transaction_wrapper', 'slide');
	usr_transTimer = setTimeout(toggleTransactionWrapperClose, 15000);
}

function toggleTransactionWrapperClose(){
	new Effect.Appear('user_transaction_wrapper', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){
																 new Effect.toggle('user_transaction_wrapper', 'blind');
															   }  });
}
 
function toggleFeedbackForm(frmElem){
	//
	//
	if($("form_fb_shell").positionedOffset()[0]<-1){
		$("form_fb_shell").morph('left:0px', {duration: 1.0, afterFinish: function(){
																				   frmElem.innerHTML = '&nbsp;&nbsp;X'; 
																				   frmElem.morph('height:25px; font-size:18px', {duration: 0.5});
																				   }  });
		
	}else{
		$("form_fb_shell").morph('left:-352px', {duration: 0.5, afterFinish: function(){
																				   frmElem.morph('height:120px; font-size:14px', {duration: 0.5, afterFinish: function(){
																				   frmElem.innerHTML = '&nbsp;&nbsp;C<br>&nbsp;&nbsp;O<br>&nbsp;&nbsp;N<br>&nbsp;&nbsp;T<br>&nbsp;&nbsp;A<br>&nbsp;&nbsp;C<br>&nbsp;&nbsp;T';
																				   }});								   
																				   }  });

	}
	
	return false;
}

function toggle_banner_mode(){

	//if($('banner_control_play_wrapper').offsetWidth > 0 && $('banner_control_play_wrapper').offsetHeight > 0){
	if($('banner_control_play_wrapper').visible()){

		//
		// PLAY BUTTON CLICKED
		//alert('play');
		new Effect.Appear('banner_control_play_wrapper', { duration: 0.1, from: 1.0, to: 0.0, afterFinish: function(){
				//$('banner_control_play_wrapper').morph('display: unset;', {duration: 0.1});
				$('banner_control_play_wrapper').hide();
			}  });

		new Effect.Appear('banner_control_pause_wrapper', { duration: 0.3, from: 0.0, to: 1.0 });

		//var myVar = setInterval(rotateBanner, 7000);

		$("banner_mode_track").innerHTML = 'PLAY';

	}else{
		//alert('pause');

		new Effect.Appear('banner_control_pause_wrapper', { duration: 0.1, from: 1.0, to: 0.0 });

		$('banner_control_play_wrapper').show();

		new Effect.Appear('banner_control_play_wrapper', { duration: 0.3, from: 0.0, to: 1.0 });

		$("banner_mode_track").innerHTML = 'PAUSE';


		//$('banner_control_play_wrapper').morph('display: inline; opacity:0.0;', {duration: 0.1, afterFinish: function(){
		//		new Effect.Appear('banner_control_play_wrapper', { duration: 0.3, from: 0.0, to: 1.0 });
		//	}  });

	}

}

function crnrstn_chkbxSel(elem,inputName){

	//alert(elem.id);

	if($('crnrstn_'+elem.id).className=='crnrstn_chkbx_on'){
		//
		// UNCHECK THIS CHECKBOX
		$('crnrstn_'+elem.id).removeClassName('crnrstn_chkbx_on');
		$('crnrstn_'+elem.id).addClassName('crnrstn_chkbx');
		$(inputName).value = '0';
	}else{
		//
		// CHECK THIS CHECKBOX
		$('crnrstn_'+elem.id).removeClassName('crnrstn_chkbx');
		$('crnrstn_'+elem.id).addClassName('crnrstn_chkbx_on');
		$(inputName).value = '1';
	}
}

function crnrstn_radioSel(elem, elem_IDSeed, radio_qty, inputName, inputValue){
	for(var i=0; i<(radio_qty*1); i++){
		if(elem.id=='crnrstn_'+elem_IDSeed+'_'+i){
			$(elem_IDSeed+'_'+i).removeClassName('crnrstn_radio');
			$(elem_IDSeed+'_'+i).addClassName('crnrstn_radio_on');
			$(inputName).value = inputValue;
		}else{
			$(elem_IDSeed+'_'+i).removeClassName('crnrstn_radio_on');
			$(elem_IDSeed+'_'+i).addClassName('crnrstn_radio');
		}
	}
}

function loadPage(requestCaller, pageUri){

	var ns = '';
	var classes = $('ns_opt').innerHTML;
	
	//
	// REMAIN STILL WHILE YOUR LIFE IS EXTRACTED
	classes.split('|').each(
		function(navElemName) { 
			//
			// APPEND NAMES OF ANY OPEN CLASS SUBNAVS
			if($(navElemName+'_subnav')){
				if($(navElemName+'_subnav').visible()){
					ns=ns+navElemName+'|';
				}
			}
	});
	
	
	//
	// 	IF pageUri HAS ?, &ns. ELSE ?ns
	if(pageUri.split("?").length>1){
		//
		// REQUEST NEW PAGE APPENDING TO EXISTING GET PARAMS
		if(ns.length>0){
			ns = ns.replace(/^\||\|+$/g, '');		// TRIM LEADING AND TRAILING PIPE
			window.location = pageUri+'&ns='+ns;
		}else{
			window.location = pageUri;
		}
	}else{
		//
		// REQUEST NEW PAGE. INITIALIZING GET PARAMS WITH ?
		if(ns.length>0){
			ns = ns.replace(/^\||\|+$/g, '');		// TRIM LEADING AND TRAILING PIPE
			window.location = pageUri+'?ns='+ns;
		}else{
			window.location = pageUri;
		}
	}
}

function loadPageFromIndex(pageUri){
	window.location = pageUri;	
}

function launch_popup(uri,popup_width,popup_height){
	newwindow=window.open(uri,'name','height='+popup_height+',width='+popup_width+'');
	if (window.focus) {newwindow.focus()}
	return false;
	
}

function launch_newwindow(pageUri){
	window.open(pageUri);	
	
}

function scrollTo_PageLoad(){
	if($("page_scrl")){
		var brwsr_offset = 0;
		var scrlPos = $("page_scrl").innerHTML;
		var src_brwsr = $("brwsr").innerHTML;
		var tgt_brwsr = '';

		if(Prototype.Browser.WebKit){
			tgt_brwsr = 'webkit';
		}
		
		if(Prototype.Browser.IE){
			tgt_brwsr = 'ie';
		}
		
		if(Prototype.Browser.Opera){
			tgt_brwsr = 'opera';
		}
		
		if(Prototype.Browser.Gecko){
			tgt_brwsr = 'gecko';
		}
		
		if(Prototype.Browser.MobileSafari){
			tgt_brwsr = 'mobilesafari';
		}
		
		if(scrlPos!=''){
			if($('content_wrapper')){
				new Effect.ScrollTo("content_wrapper", {offset: (scrlPos*1)+(brwsr_offset*1)});
			}

		}
	}
}

function initScrollTo_lnk(elem,uri){
	var pos = elem.positionedOffset()[1];
	var brwsr = '';

	if(Prototype.Browser.WebKit){
		brwsr = 'webkit';
	}
	
	if(Prototype.Browser.IE){
		brwsr = 'ie';
	}
	
	if(Prototype.Browser.Opera){
		brwsr = 'opera';
	}
	
	if(Prototype.Browser.Gecko){
		brwsr = 'gecko';
	}
	
	if(Prototype.Browser.MobileSafari){
		brwsr = 'mobilesafari';
	}
	
	//alert('cumulativeOffset :: ' + elem.cumulativeOffset()[1]);
	//alert('positionedOffset :: ' + elem.positionedOffset()[1]);
	window.location = uri+'&scrl='+pos+'&brwsr='+brwsr;
}

function fullYear(theDate){
	x = theDate.getYear();
	var y = x % 100;
	y += (y < 38) ? 2000 : 1900;
	return y;
}


/*MISC FORM CONTROLS :: CHECKBOX BEHAVIOR*/
function checkMe(elemID){
	if($(elemID).checked){
		$(elemID).checked=false;
	}else{
		$(elemID).checked=true;
	}
}

/*SEARCH CONTROLS*/
function s_ovr(element){
	element.morph('background-color:#ff0000; color:#FFF;', {duration: 0.1});	
}

function s_out(element){
	element.morph('background-color:#E1E2E5; color:#6F6F6F;', {duration: 0.3});
}

function searchBtnMouseOver(element){
	//ç
}

function searchBtnMouseOut(element){
	element.morph('background-color:#FF0000; color:#E7E7E7;', {duration: 0.3});
}

function loadUGCSearch(commentID,elementID, targetID){
	var query = window.location.href; 
	var vars = query.split("/"); 
	var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';

	var params = 'c=' + commentID + '&e=' + elementID;
	var uri = HTTP_ROOT + 'crnrstn/search/ugc/';

	//
	// FIRE AJAX TOOL TIP :: WEB SERVICES REQUEST
	var ajax = new Ajax.Updater(
	{success: targetID},
	uri,
	{method: 'get', parameters: params});
	
}

function crnrstn_search_radioSel(elem, elem_IDSeed, radio_qty){
	for(var i=0; i<(radio_qty*1); i++){
		if(elem.id==elem_IDSeed+'_'+i){
			$('s_results_filter_radio_'+i).removeClassName('s_results_filter_radio');
			$('s_results_filter_radio_'+i).addClassName('s_results_filter_radio_on');
		}else{
			$('s_results_filter_radio_'+i).removeClassName('s_results_filter_radio_on');
			$('s_results_filter_radio_'+i).addClassName('s_results_filter_radio');
		}
	}
}

function initFilterRadio(){
	var tmp_pointer = '0';
	var query = window.location.href; 
	var vars_Filter = query.split("&"); 
	for(var i=0;i<vars_Filter.length;i++){
		switch(vars_Filter[i]){
			case 'filter=all':
				var tmp_pointer = '0';
			break;
			case 'filter=code':
				var tmp_pointer = '2';
			break;
			case 'filter=desc':
				var tmp_pointer = '3';
			break;
			case 'filter=ugc':
				var tmp_pointer = '1';
			break;
		}
	}
	
	for(var i=0; i<4; i++){
		if('s_results_filter_radio_'+tmp_pointer=='s_results_filter_radio_'+i){
			$('s_results_filter_radio_'+i).removeClassName('s_results_filter_radio');
			$('s_results_filter_radio_'+i).addClassName('s_results_filter_radio_on');
		}else{
			$('s_results_filter_radio_'+i).removeClassName('s_results_filter_radio_on');
			$('s_results_filter_radio_'+i).addClassName('s_results_filter_radio');
		}
	}
}

function crnrstn_search_filter(filterType){
	var query = window.location.href;
	var query_clean = query.split("#");
	var query_Filter = query_clean[0].split("&filter=");
	//alert(query_clean[0]+'&filter=' + filterType);
	window.location = query_Filter[0] + '&filter='+filterType;
}

var hoverCount = 0;
var tt_timer;
var tt_locktimer;
var tt_currElemId = '';
var tt_lock = 0;

function ttMsOvr(element){
	tt_currElemId = element.id;
	tt_timer = setTimeout(loadToolTip, 500);
}

function clear_tt_lock(){
	tt_lock=0;
	clearInterval(tt_locktimer);
	tt_locktimer = null;
}

function loadToolTip(){
	if(tt_lock==0){
		tt_lock = 1;
		var query = window.location.href; 
		var vars = query.split("/"); 
		var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
		var tmp_id = tt_currElemId
		var tmp_id_delim = tmp_id.split("_");
		var params = 'e=' + tmp_id_delim[0] + '&rnd='+tmp_id_delim[1];
		var url = HTTP_ROOT + 'crnrstn/search/tt/';
		
		if(!$('tt_'+tt_currElemId)){
			var ttContent = document.createElement("div");
			//ttContent.setAttribute('id','tt_'+element.id);
			ttContent.setAttribute('id','tt_'+tt_currElemId);
			ttContent.setAttribute('class','tooltip_wrapper');
			$(tt_currElemId).appendChild(ttContent);
			
			ttContent.innerHTML = '<div class="tt_logo" style="margin-top:5px;"><img src="'+HTTP_ROOT+'crnrstn/common/imgs/the_R.gif"></div><div class="tt_loader"><img src="'+HTTP_ROOT+'crnrstn/common/imgs/long_loader.gif"></div>';
			
			//
			// FIRE AJAX TOOL TIP :: WEB SERVICES REQUEST
			var ajax = new Ajax.Updater(
			{success: 'tt_'+tt_currElemId},
			url,
			{method: 'get', parameters: params});
			
			clearInterval(tt_timer);
			tt_timer = null;
		}
	}
}

function ttMsOut(element){
	clearInterval(tt_timer);
	tt_timer = null;
}

function toolTipClose(elementid){
	$(elementid).removeChild($('tt_'+elementid));
	tt_locktimer = setTimeout(clear_tt_lock, 500);
}

/*NAVIGATION CONTROLS :: MOUSEOVER OVERLAY*/
var currOverlayLnkNm="";

function lnkMouseOver(lnkName){
	if(lnkName!=currOverlayLnkNm){
		new Effect.Appear(lnkName+'_lnk_activity_overlay', { duration: 0.2, from: 0.0, to: 0.4 });
	}
	currOverlayLnkNm=lnkName;
}

function lnkMouseOut(lnkName){
	if(lnkName==currOverlayLnkNm){
		new Effect.Appear(lnkName+'_lnk_activity_overlay', { duration: 0.2, from: 0.4, to: 0.0 });
		currOverlayLnkNm="";
	}
}

function sublnkMouseOver(element){
	$(element.id).removeClassName('subnav_lnk_clear');
	$(element.id).removeClassName('subnav_lnk_highlighted');
	$(element.id).addClassName('subnav_lnk_highlighted');
}

function sublnkMouseOut(element){
	$(element.id).removeClassName('subnav_lnk_highlighted');
	$(element.id).addClassName('subnav_lnk_clear');
}

function submitBtnMouseOver(element){
	element.removeClassName('submit_btn_clear');
	element.removeClassName('submit_btn_highlighted');
	element.addClassName('submit_btn_highlighted');
}

function submitBtnMouseOut(element){
	element.removeClassName('submit_btn_highlighted');
	element.addClassName('submit_btn_clear');
}

function gup( name )
{
  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regexS = "[\\?&]"+name+"=([^&#]*)";
  var regex = new RegExp( regexS );
  var results = regex.exec( window.location.href );
  if( results == null )
    return "";
  else
    return results[1];
}

function startCount()
{
	//
	// TIMER SEC INTERVAL
	timer = setInterval(count,1000);

	if($('test_mode')){
		//
		// AJAX SYNC INTERVAL - 10 SECS
		// FOR IMPLEMENTATION OF TIMER AND COPY UPDATES
		timer_sync = setInterval(overlay_sync,5000);

	}
}

function overlay_sync() {
	//
	// EVERY 5 SECONDS, CHECK VIEW STATE @ SERVER
	// TIMER :: SHOW-AND-RESET, SHOW-AND-RESUME, SHOW-AND-INITIALIZE, REINITIALIZE or HIDE timer
	// OVERLAY :: SHOW-WITH-TIMER, SHOW-SANS-TIMER, HIDE

	//
	// BUILD REQUEST FOR OVERLAY STATE ACQUISITION FROM SERVER
	overlay_update();


}

function overlay_update(){

	var query = window.location.href;
	var vars = query.split("/");
	//var HTTP_ROOT = vars[0]+'//'+vars[2]+'/';
	var HTTP_ROOT = $('ajax_root').innerHTML;
	//alert(HTTP_ROOT);

	var uri = 'social/fellowship/avsvc_overlay/admin/state_request.php';
	uri = HTTP_ROOT+uri;
	var params = 'sid='+$('sid').innerHTML;
	var myAjax = new Ajax.Request(
		uri,
		{
			method: 'get',
			parameters: params,
			onComplete: updateOverlayHTML
		});



}

function updateOverlayHTML(formRequest){
	var resp = formRequest.responseText;

	if(resp!=""){

		//
		// PARSE OUT RESPONCE - <||>
		var delim_output = resp.split("<||>");

		ole_mini_state_html = $('mini_state').innerHTML;
		ole_full_state_html = $('full_state').innerHTML;

		ole_mod_id_html = $('mod_id').innerHTML;
		ole_mini_opacity_html = $('mini_opacity').innerHTML;
		ole_fullscreen_opacity_html = $('fullscreen_opacity').innerHTML;
		ole_mini_bgcolor_html = $('mini_bgcolor').innerHTML;
		ole_fullscreen_bgcolor_html = $('fullscreen_bgcolor').innerHTML;

		//
		// FULL SCREEN OVERLAY CHANGES AND TRANSITIONS


		//
		// MINI OVERLAY CHANGES AND TRANSITIONS
		//alert(delim_output[0]+ " vs "+ole_mini_state_html+"...is the desired new mini overlay state.");

		if(ole_mini_state_html!=delim_output[3] || ole_full_state_html!=delim_output[4]){

			//
			// WE HAVE STATE CHANGE TO MAKE IN MINI OVERLAY
			novum_fullscrn_page_header_html = delim_output[0];
			novum_fullscrn_page_title_html = delim_output[1];
			novum_fullscrn_page_code_html = delim_output[2];
			novum_mini_state_html = delim_output[3];
			novum_full_state_html = delim_output[4];
			novum_mod_id_html = delim_output[5];
			novum_mini_opacity_html = delim_output[6];
			novum_fullscreen_opacity_html = delim_output[7];
			novum_mini_bgcolor_html = delim_output[8];
			novum_fullscreen_bgcolor_html = delim_output[9];
			novum_mini_conference_title_html = delim_output[10];
			novum_mini_message_title_html = delim_output[11];
			novum_mini_message_number_html = delim_output[12];
			novum_mini_message_speaker_html = delim_output[13];
			novum_copy_timer_html = delim_output[14];


			$('fullscrn_page_header').innerHTML = "<h3>"+novum_fullscrn_page_header_html+"</h3>";
			$('fullscrn_document_title').innerHTML = "<h1>"+novum_fullscrn_page_title_html+"</h1>";
			$('fullscrn_page_code').innerHTML = novum_fullscrn_page_code_html;


			switch(novum_mini_state_html){
				case '8':
					// HIDE TIMER AND RESET TO 00:00
					//alert('Timer about to be hidden...');

					if($('timer_UI_update_lck').innerHTML == "OFF"){
						$('timer_lck').innerHTML = "ON";
						//alert('946 updating mini state to new id of '+ novum_mini_state_html);
						$('mini_state').innerHTML = novum_mini_state_html;
						new Effect.Appear('message_time_wrapper', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){ timer_UI_update_lock('ON', 'reset_timer');  }  });

					}

				break;
				case '7':
					// HIDE TIMER AND KEEP UP WITH IT
					if($('timer_UI_update_lck').innerHTML == "OFF"){
						//alert('956 updating mini state to new id of '+ novum_mini_state_html);
						$('mini_state').innerHTML = novum_mini_state_html;
						new Effect.Appear('message_time_wrapper', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){ }  });
					}

				break;
				case '6':
					// HIDE TIMER AND PAUSE
					if($('timer_UI_update_lck').innerHTML == "OFF"){
						//alert('965 updating mini state to new id of '+ novum_mini_state_html);
						$('mini_state').innerHTML = novum_mini_state_html;
						new Effect.Appear('message_time_wrapper', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){  }  });
						$('timer_lck').innerHTML = "ON";

					}

				break;
				case '3':
					// HIDE OVERLAY - RESET TIMER
					if($('mini_UI_update_lck').innerHTML == "OFF"  || ole_mini_state_html!='5'  || ole_mini_state_html!='1'){
						$('timer_lck').innerHTML = "ON";
						//alert('977 updating mini state to new id of '+ novum_mini_state_html);
						$('mini_state').innerHTML = novum_mini_state_html;
						new Effect.Appear('mini_overlay_handle', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){ updatOverlayCopy(delim_output, 'mini'); $('mini_overlay_handle').style.left = '-3000px'; }  });
						mini_UI_update_lock('ON');
					}

				break;
				case '0':
					// HIDE OVERLAY - KEEP UP WITH TIMER
					if($('mini_UI_update_lck').innerHTML == "OFF"){
						//alert('987 updating mini state to new id of '+ novum_mini_state_html);
						$('mini_state').innerHTML = novum_mini_state_html;
						new Effect.Appear('mini_overlay_handle', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){ updatOverlayCopy(delim_output, 'mini'); }  });
						mini_UI_update_lock('ON');
						$('mini_overlay_handle').style.left = '-3000px';
					}else{
						new Effect.Appear('mini_overlay_handle', { duration: 0.1, from: 0.0, to: 0.0, afterFinish: function(){ updatOverlayCopy(delim_output, 'mini'); }  });
						mini_UI_update_lock('ON');
						$('mini_overlay_handle').style.left = '-3000px';
					}

				break;
				case '2':
					// HIDE OVERLAY - PAUSE TIMER
					if($('mini_UI_update_lck').innerHTML == "OFF"  || ole_mini_state_html!='5'  || ole_mini_state_html!='1'){
						//alert('1001 updating mini state to new id of '+ novum_mini_state_html);
						$('mini_state').innerHTML = novum_mini_state_html;
						new Effect.Appear('mini_overlay_handle', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){ updatOverlayCopy(delim_output, 'mini'); }  });
						$('timer_lck').innerHTML = "ON";
						mini_UI_update_lock('ON');
						$('mini_overlay_handle').style.left = '-3000px';
					}

				break;
				case '4':
					// SHOW TIMER

					//alert ($('timer_UI_update_lck').innerHTML + " --- "+ ole_mini_state_html);
					if($('timer_UI_update_lck').innerHTML == "OFF" || ole_mini_state_html!='4'){

						if(ole_mini_state_html=='6' || ole_mini_state_html=='8'){
							//
							// UNPAUSE TIMER
							$('timer_lck').innerHTML = "OFF";

						}

						timer_UI_update_lock('OFF', 'do nothing');
						//alert('1019 updating mini state to new id of '+ novum_mini_state_html);
						$('mini_state').innerHTML = novum_mini_state_html;
						new Effect.Appear('message_time_wrapper', { duration: 1.0, from: 0.0, to: 1.0, afterFinish: function(){ mini_UI_update_lock('OFF'); }  });

					}

				break;
				case '5':
					// SHOW OVERLAY
					if(ole_mini_state_html=='3' || ole_mini_state_html=='2'){
						//
						// UNPAUSE TIMER
						$('timer_lck').innerHTML = "OFF";

					}

					//if($('mini_UI_update_lck').innerHTML == "OFF"){
						updatOverlayCopy(delim_output, 'mini');
						$('mini_overlay_handle').style.left = '-80px';
						//alert('1030 updating mini state to new id of '+ novum_mini_state_html+ " and show overlay.");
						$('mini_state').innerHTML = novum_mini_state_html;
						new Effect.Appear('mini_overlay_handle', { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){  }  });

					//}

				break;
			}

			switch(novum_full_state_html){
				case '1':
					// SHOW
					if($('show_fullscrn_lck').innerHTML == "OFF" || ole_full_state_html=='3'){
						$('full_state').innerHTML= '1';
						new Effect.Appear('main_overlay_handle', { duration: 1.0, from: 0.0, to: 1.0, afterFinish: function(){ }  });
						$('show_fullscrn_lck').innerHTML = "ON";
						$('hide_fullscrn_lck').innerHTML = "OFF";
					}

				break;
				case '3':
					// HIDE
					$('show_fullscrn_lck').innerHTML = "OFF";

					if($('hide_fullscrn_lck').innerHTML == "OFF" || ole_full_state_html=='1'){
						$('full_state').innerHTML= '3';
						new Effect.Appear('main_overlay_handle', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){ }  });
						$('hide_fullscrn_lck').innerHTML = "ON";
					}
				break;
			}


		}


	}


}


function htmlEntities(str) {
	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}


function timer_UI_update_lock(param, reset_state){

	$('timer_UI_update_lck').innerHTML = param;

	if(reset_state=="reset_timer"){

		$("message_time_wrapper").innerHTML="0:00:00";
	}


}

function mini_UI_update_lock(param){

	$('mini_UI_update_lck').innerHTML = param;
}

function updatOverlayCopy(delim_output_array, overlay_type){

	/*
	* $tmp_fullscrn_page_header.$tmp_delim.[0]
	* $tmp_fullscrn_page_title.$tmp_delim.[1]
	* $tmp_fullscrn_page_code.$tmp_delim.[2]
	* $tmp_mini_state.$tmp_delim.[3]
	* $tmp_sess_fullscreen_state.$tmp_delim.[4]
	* $tmp_modifier_id.$tmp_delim.[5]
	* $tmp_mini_opacity.$tmp_delim. [6]
	* $tmp_fullscrn_opacity.$tmp_delim.[7]
	* $tmp_mini_bgcolor.$tmp_delim. [8]
	* $tmp_fullscrn_bgcolor.$tmp_delim.[9]
	* $tmp_mini_conference_title.$tmp_delim.[10]
	* $tmp_mini_message_title.$tmp_delim.[11]
	* $tmp_mini_message_number.$tmp_delim.[12]
	* $tmp_mini_message_speaker.$tmp_delim.[13]
	* $tmp_copy_timer.$tmp_delim;[14]

	* */

	novum_fullscrn_page_header = delim_output_array[0];
	novum_fullscrn_page_title = delim_output_array[1];
	novum_fullscrn_page_code = delim_output_array[2];

	$('fullscrn_page_header').innerHTML = "<h3>"+novum_fullscrn_page_header+"</h3>";
	$('fullscrn_document_title').innerHTML =  "<h1>"+novum_fullscrn_page_title+"</h1>";
	$('fullscrn_page_code').innerHTML = novum_fullscrn_page_code;

	novum_mini_state_html = delim_output_array[3];
	novum_full_state_html = delim_output_array[4];
	novum_mod_id_html = delim_output_array[5];
	novum_mini_opacity_html = delim_output_array[6];
	novum_fullscreen_opacity_html = delim_output_array[7];
	novum_mini_bgcolor_html = delim_output_array[8];
	novum_fullscreen_bgcolor_html = delim_output_array[9];
	novum_mini_conference_title_html = delim_output_array[10];
	novum_mini_message_title_html = delim_output_array[11];
	novum_mini_message_number_html = delim_output_array[12];
	novum_mini_message_speaker_html = delim_output_array[13];
	novum_copy_timer_html = delim_output_array[14];

	message_time_burnout = $('message_time_burnout').innerHTML;
	message_time_wrapper = $('message_time_wrapper').innerHTML;

	switch(overlay_type){
		case 'mini':
			//alert('updating mini state to new id of '+ novum_mini_state_html);
			$('mini_state').innerHTML = novum_mini_state_html;
			$('mod_id').innerHTML = novum_mod_id_html;
			$('conf_title').innerHTML = novum_mini_conference_title_html;
			$('msg_title').innerHTML = novum_mini_message_title_html;
			$('msg_num').innerHTML = novum_mini_message_number_html;
			$('msg_spkr').innerHTML = novum_mini_message_speaker_html;

			switch(novum_mini_state_html){
				case '3':
					$("message_time_wrapper").innerHTML="0:00:00";
				break;
				default:

					if(novum_copy_timer_html.length>5 && (message_time_burnout != message_time_wrapper)){

						$('message_time_wrapper').innerHTML = novum_copy_timer_html;
						$('message_time_burnout').innerHTML = novum_copy_timer_html;

					}
				break;

			}

		break;
		case 'full':
		break;

	}


}

function count()
{

	if($('timer_lck').innerHTML=="OFF"){

		if($("message_time_wrapper")){
			var time_shown = $("message_time_wrapper").innerHTML;
			var time_chunks = time_shown.split(":");
			var hour, mins, secs;

			hour=Number(time_chunks[0]);
			mins=Number(time_chunks[1]);
			secs=Number(time_chunks[2]);
			secs++;

			if (secs==60){
				secs = 0;
				mins=mins + 1;
			}
			if (mins==60){
				mins=0;
				hour=hour + 1;
			}
			if (hour==13){
				hour=1;
			}

			$("message_time_wrapper").innerHTML = hour +":" + plz(mins) + ":" + plz(secs);

		}
	}

}

function plz(digit){

	var zpad = digit + '';
	if (digit < 10) {
		zpad = "0" + zpad;
	}
	return zpad;
}