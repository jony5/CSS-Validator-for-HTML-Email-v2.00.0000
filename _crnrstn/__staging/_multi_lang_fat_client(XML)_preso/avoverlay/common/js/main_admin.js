/* 
// J5
// Code is Poetry */

// OVERLAY CONTROLS
// lowly JavaScript Document

var ojson_packet_ARRAY = [];
var ojson_packet_output_ARRAY = [];
ojson_packet_output_ARRAY['json_cummulative'] = '';
var ojson_elem_flag_HANDLE_ARRAY = [];
var ojson_elem_flag_ARRAY = [];
var ojson_packet_txt = '';
var ojson_stringify_ARRAY = [];


//
// INIT TIMER AND STATE CONTROLLER
miniOverlayTimer = setTimeout( "syncTimerState()", 1000 );
clearTimeout(miniOverlayTimer);

var urlbase = "";

//
// INITIALIZE
$.when(
	//$.getJSON( "ajax/test.json" ),
	$.ready
).done(function( ) {
	// Document is ready.
	// Value of test.json can be passed in as `data`.

	var urlbase =  $('#ajax_root').html();
	tmp_walltime = $("#timer_copy_admin").html();
	$("#timer_copy_persist").html(tmp_walltime);



	//
	// START HEARTBEATS
	startHeartbeats();

});

// SOURCE :: https://stackoverflow.com/questions/19491336/get-url-parameter-jquery-or-how-to-get-query-string-values-in-js
// AUTHOR :: https://stackoverflow.com/users/1897010/sameer-kazi
// SOURCE [ORIGINAL] :: http://www.jquerybyexample.net/2012/06/get-url-parameters-using-jquery.html
function getUrlParameter(sParam_cust) {
	var sPageURL_cust = window.location.search.substring(1),
		sURLVariables_cust = sPageURL_cust.split('&'),
		sParameterName_cust,
		aaa;

	for (aaa = 0; aaa < sURLVariables_cust.length; aaa++) {
		sParameterName_cust = sURLVariables_cust[aaa].split('=');

		if (sParameterName_cust[0] === sParam_cust) {
			return sParameterName_cust[1] === undefined ? true : decodeURIComponent(sParameterName_cust[1]);
		}
	}
}

function startHeartbeats(){

	//
	// TIMER SEC INTERVAL
	if($('#admin_curr_status_content_wrapper').length){
		clearTimeout(miniOverlayTimer);
		miniOverlayTimer = setInterval("syncCurrentStatus()",1000);
	}

}


function syncCurrentStatus(){

	// admin_curr_status_content_wrapper
	syncTimerState();

	generate_cachebust();
	tmp_obs_id = $('#obs_id').html();

	var datafile = urlbase;
	var pars = "obs_id="+tmp_obs_id+"&rt=currentstatus&cache_b=" + $('#cache_bust').html();
	var uri = datafile+'?'+ pars;

	$.ajax({
		type: "GET",
		url: uri,
		dataType: "html",
		success: injectCurrentStatus
	});

}

function injectCurrentStatus(respHTML){

	$('#admin_curr_status_content_wrapper').html(respHTML);
	$("#timer_copy_admin").html($("#timer_copy_persist").html());

}

function syncTimerState(){
	//if($('#timer_lck').html()=="OFF"){

		if($("#timer_copy_persist").length){
			var time_shown = $("#timer_copy_persist").html();
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
			//if (hour==13){
			//	hour=1;
			//}

			$("#timer_copy_persist").html(hour +":" + plz(mins) + ":" + plz(secs));
			$("#timer_copy_admin").html(hour +":" + plz(mins) + ":" + plz(secs));

	//	}
	}else{

		//alert('timer locked...');
	}

}

function plz(digit){

	var zpad = digit + '';
	if (digit < 10) {
		zpad = "0" + zpad;
	}
	return zpad;
}

function generate_cachebust(){
	//https://gist.github.com/6174/6062387
	//http://stackoverflow.com/questions/105034/how-to-create-a-guid-uuid-in-javascript
	$('#cache_bust').html(Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15));
}
