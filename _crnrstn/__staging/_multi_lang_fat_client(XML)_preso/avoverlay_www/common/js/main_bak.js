/* 
// J5
// Code is Poetry */

// OVERLAY CONTROLS
// lowly JavaScript Document

var myAjax = "";
var requestedmodule = "";

//
// INIT TIMER AND STATE CONTROLLER
miniOverlayTimer = setTimeout( "syncTimerState()", 1000 );
clearTimeout(miniOverlayTimer);

langPackRotate = setTimeout( "rotateLangPackActiveOverlay()", 2000 );
clearTimeout(langPackRotate);

masterOverlaySyncCtrl = setTimeout( "syncProfileStateXML()", 5000 );
clearTimeout(masterOverlaySyncCtrl);

// DOCUMENT CONNECTION STRING ROOT
// ** MUST BE ABSOLUTE TO HTTP FOR XML TO PARSE **
var urlbase = "";

//
// OBJECT CONTROLLER
var showbg_demo = '0';
var profile_overload_xml_ARRAY = new Array();
var profile_overload = false;
var log_controller = 1;   // [0=off|1=on]
var activity_log_FLAG;
var test_oAudio;
var ai_oMode_set_return_to = false;
var ai_lang_pack_rotation_cnt = 0;
var ai_oMode_sleep = 'OFF';
var ai_sleep_rotate_FLAG = 0;
var ai_trk_sleep_time = 0;
var ai_oMode_return_to_omode = 'FULL';
var authFlag_langPack_MiniFull_rotate = 1;
var authFlag_langPack_FullScrn_rotate = 1;
var MINI_copy_scroll_transition_gap = 4000;
var mini_scroll_init = 1;
var total_index_invalid = 0;
var delay_initial_copy_onload = true;
var forced_endpoint_update_BOOL = false;
var hmm_buffer = 25;
var mini_full_ai_lang_pack_rotation_cnt = 0;
var mini_scrl_ai_lang_pack_rotation_cnt = 0;
var mini_overlay_original_height = 0;
var sub_rotate_two_count_selah = 0;
var sub_rotate_FS_two_count_selah = 0;
var overlay_MINI_curr_bg_height = 0;
var overlay_MINI_new_bg_height = 0;
var overlay_MINI_curr_bg_pxtop = 0;
var overlay_MINI_new_bg_pxtop = 0;
var overlay_FULL_hold_opacity_at_zero = false;
var overlay_FULL_visible_state = 'showall';  // hidecopy, hideall
var langPack_FULL_rotationLock_BOOL = true;
var langPack_Mini_rotationLock_BOOL = true;
var langPack_Mini_curr_langID = 'en';
var langPack_FULL_curr_langID = 'en';
var langPack_FULL_curr_langID_INDEX = 0;
var langPack_FULL_Count_langID = 0;
var langPack_MINI_Count_langID = 0;
var langPack_MINI_maxheight_ScrlAll = 0;
var langPack_MINI_maxheight_FullAll = 0;
var langPack_MINI_maxheight_FullSectA = 0;
var langPack_MINI_maxheight_FullSectB = 0;
var langPack_MINI_COPY_ORIG_TOGGLE = 'orig';
var langPack_Mini_IDtoIndex_ARRAY = new Array();
var langPack_Mini_fullgate_ARRAY = new Array();
var langPack_Mini_langID_ARRAY = new Array();
var langPack_FULL_langID_ARRAY = new Array();

var langPack_rotation_interval_MINI_cnt = 0;
var langPack_rotation_interval_MINI_FULL_cnt = 0;
var langPack_rotation_interval_MINI_FULL_SUB_cnt = 0;
var langPack_rotation_interval_FULLSCRN_cnt = 0;
var langPack_rotation_interval_FULLSCRN_SUB_cnt = 0;
var langPack_rotation_interval_FULL = 20;
var langPack_rotation_interval_MINI_FULL = 42;
var langPack_rotation_interval_MINI_SCROLL = 42;

var langPack_SUB_rotation_interval_MINI_FULL = 12;
var langPack_rotation_interval = 45;
var langPack_rotation_interval_cnt = 0;
var myAjax_profile;
var objectArrayProfileIndex = 0;
var objectArrayProfileOverlay_cnt = 0;
var xml_profile_cnt = 0;
var fullLangPackCnt = 0;
var miniLangPackCnt = 0;
var profileLangPackARRAY = new Array();
var profileIndexARRAY = new Array();
var profileOverlayARRAY = new Array();
var oOverlayProfileDataARRAY = new Array();
var overlayProfileData_cnt = 0;
var profileLoadLck = new Array();
var urlbase =  '';

var bounce_OUT_distance_px = 15;
var bounce_OUT_num_times = 1;
var bounce_OUT_speed = 360;

var bounce_IN_distance_px = 8;
var bounce_IN_num_times = 1;
var bounce_IN_speed = 120;

profileLoadLck['mini'] = 0;
profileLoadLck['full'] = 0;

//
// INITIALIZE
$.when(
	//$.getJSON( "ajax/test.json" ),
	$.ready
).done(function( ) {
	// Document is ready.
	// Value of test.json can be passed in as `data`.

	log_activity("DOM ready.");

	if($('#overlay_body').length){

		ajax_root = $('#ajax_root').html();
		var is_prod = ajax_root.indexOf("jony5.com");

		loginLnkTmr = setInterval("timeOutLogin()",1000);

		//
		// ACTIVATE LOGIN LINK(S)
		$('#login_lnk').click(function() {
			window.location.href = ajax_root + 'account/signin/';
		});
/*
		$('#mini_overlay_handle').click(function() {
			window.location.href = ajax_root + 'account/signin/';
		});

		$('#login_lnk').click(function() {
			window.location.href = ajax_root + 'account/signin/';
		});
*/
		setTimeout(hideLogin, 5000);

	}

	//
	// logs=true
	var tmp_logging = getUrlParameter('logs');
	var tmp_audio = getUrlParameter('audio');
	var tmp_overlayfs = getUrlParameter('fullscreen');
	var tmp_overlaymini = getUrlParameter('mini');

	if(tmp_logging==true || tmp_logging=='true') {

        showbg_demo='1';

		ajax_root = $('#ajax_root').html();
		//tmp_http_uri = ajax_root + 'common/imgs/overlay_OBS_demo_bg_compressed.jpg';

		//document.body.style.backgroundColor = "#0057F6";
		//document.body.style.backgroundImage = "url('"+tmp_http_uri+"')";

	}else{

		log_controller = 0;

		urlbase =  $('#ajax_root').html();

	}

	if(tmp_audio==true || tmp_audio=='true') {

		// SOURCE :: https://stackoverflow.com/questions/38316679/autoplay-html-audio-created-with-javascript
		// AUTHOR :: https://stackoverflow.com/users/1927618/radiantstatic

		ajax_root = $('#ajax_root').html();
		var source = ajax_root + "common/audio/jehovah_has_revealed_his_heart.mp3";

		//test_oAudio = new Audio(); // use the constructor in JavaScript, just easier that way
		/*
                tmp_html = '<audio autoplay loop>' +
                    '      <source src="' + source + '">' +
                    '</audio>';

                test_oAudio.addEventListener("load", function() {
                    test_oAudio.play();
                }, true);
                test_oAudio.src = source;
                test_oAudio.autoplay = true; // add this

              //  setTimeout(autoPlayCheck, 4000);
           */

		tmp_html = '<audio id="sample_audio" controls autoplay>' +
			'<source src="' + source + '" type="audio/mpeg">' +
			'Your browser does not support the audio element.' +
		'</audio>';

		var objFlagDiv = document.createElement('div');
		objFlagDiv.setAttribute('id', 'testAudio');
		objFlagDiv.setAttribute('class','hidden');

		$( "#mini_overlay_handle" ).append( objFlagDiv );

		//$('#testAudio').html(tmp_html);
		objFlagDiv.innerHTML = tmp_html;
		log_activity('Load AUDIO TEST file [' + source + '] Play for 30 seconds.');

		//var sample_audio = document.getElementById("sample_audio");
		//sample_audio.autoplay = true;
		//sample_audio.loop = true;
		//sample_audio.load();
		//sample_audio.play();

		setTimeout(changeAudioTest, 30000);

	}

	if(tmp_overlayfs==true || tmp_overlayfs=='true'){

		//
		// LOAD FULL SCREEN DEMO
        showbg_demo='1';
		ajax_root = $('#ajax_root').html();
		//tmp_http_uri = ajax_root + 'common/imgs/overlay_OBS_demo_bg_compressed.jpg';

		//document.body.style.backgroundColor = "#0057F6";
		//document.body.style.backgroundImage = "url('"+tmp_http_uri+"')";

		profile_xml_http = ajax_root + 'common/xml/_profiles/2019seblendjville_fullscrn4674863872.xml';

		profile_overload = true;
		profile_overload_xml_ARRAY.push(profile_xml_http);

		profile_xml_http = ajax_root + 'common/xml/_profiles/2019seblendjville_mini4674863872f.xml';
		profile_overload_xml_ARRAY.push(profile_xml_http);

		syncOverlayStateXML(1);

	}

	if(tmp_overlaymini==true || tmp_overlaymini=='true'){

		//
		// LOAD FULL SCREEN DEMO
        showbg_demo='1';
		ajax_root = $('#ajax_root').html();
		//tmp_http_uri = ajax_root + 'common/imgs/overlay_OBS_demo_bg_compressed.jpg';

		//document.body.style.backgroundColor = "#0057F6";
		//document.body.style.backgroundImage = "url('"+tmp_http_uri+"')";

		profile_xml_http = ajax_root + 'common/xml/_profiles/2019seblendjville_fullscrn4674863872f.xml';

		profile_overload = true;
		profile_overload_xml_ARRAY.push(profile_xml_http);

		profile_xml_http = ajax_root + 'common/xml/_profiles/2019seblendjville_mini4674863872.xml';
		profile_overload_xml_ARRAY.push(profile_xml_http);

		//syncOverlayStateXML(0);
		syncOverlayStateXML(1);

	}

	if((tmp_logging==true || tmp_logging=='true')){
		activity_log_FLAG = 'WeloveJesus!';

		$("#activity_log").animate({
			opacity: 0.8
		}, {
			duration: 1000,
			queue: false,
			specialEasing: {
				opacity: "swing"
			},
			step: function (now, fx) {

			},
			complete: function () {


			}
		});
	}

	//
	// START HEARTBEATS
	startHeartbeats();

	//
	// GRAB XML
	syncProfileStateXML();


    if(showbg_demo=='1'){
        //
        // SHOW DEMO BG
        ajax_root = $('#ajax_root').html();
        tmp_http_uri = ajax_root + 'common/imgs/overlay_OBS_demo_bg_compressed.jpg';

        document.body.style.backgroundColor = "#0057F6";
        document.body.style.backgroundImage = "url('"+tmp_http_uri+"')";

        showbg_demo='0';

    }

});

function timeOutLogin(){

	tmp_login_time_remain = $('#login_lnk_tmr').html();

	switch(tmp_login_time_remain){
		case '(5)':
			$('#login_lnk_tmr').html('(4)');
		break;
		case '(4)':
			$('#login_lnk_tmr').html('(3)');
		break;
		case '(3)':
			$('#login_lnk_tmr').html('(2)');
		break;
		case '(2)':
			$('#login_lnk_tmr').html('(1)');
		break;
		case '(1)':
			$('#login_lnk_tmr').html('(0)');
		break;
		default:
			$('#login_lnk_tmr').html('(0)');
		break;

	}

}

function hideLogin(){

	$('#login_lnk').animate({
		opacity: 0
	}, {
		duration: 2000,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		step: function (now, fx) {

		},
		complete: function () {
			$('#login_lnk').animate({
				width: 0,
				height: 0
			}, {
				duration: 2000,
				queue: false,
				specialEasing: {
					width: "swing"
				},
				step: function (now, fx) {

				},
				complete: function () {
					$('#login_lnk').empty();
					clearInterval(loginLnkTmr);

				}
			});

		}
	});


}

function changeAudioTest(){

	$('#testAudio').html('');

	ajax_root = $('#ajax_root').html();
	var source = ajax_root + "common/audio/butter_and_honey.mp3";

	tmp_html = '<audio id="sample_audio" controls autoplay>' +
		'<source src="' + source + '" type="audio/mpeg">' +
		'Your browser does not support the audio element.' +
		'</audio>';

	$( "#testAudio" ).html( tmp_html );
	log_activity('Load AUDIO TEST file [' + source + '] Play for 24.7 seconds.');


	setTimeout(changeAudioBckTest, 24700);

}

function changeAudioBckTest(){

	$('#testAudio').html('');

	ajax_root = $('#ajax_root').html();
	var source = ajax_root + "common/audio/jehovah_has_revealed_his_heart.mp3";

	tmp_html = '<audio id="sample_audio" controls autoplay>' +
		'<source src="' + source + '" type="audio/mpeg">' +
		'Your browser does not support the audio element.' +
		'</audio>';

	$( "#testAudio" ).html( tmp_html );

	log_activity('Load AUDIO TEST file [' + source + '] Play for 30 seconds.');
	setTimeout(changeAudioTest, 30000);

}

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
	clearTimeout(miniOverlayTimer);
	miniOverlayTimer = setInterval("syncTimerState()",1000);
	log_activity("1 sec interval timer process started.");

	clearTimeout(langPackRotate);
	langPackRotate = setInterval( "rotateLangPackActiveOverlay()", 2000 );


	syncOverlayState();


}

function syncOverlayState(){
	clearTimeout(masterOverlaySyncCtrl);
	masterOverlaySyncCtrl = setInterval( "syncProfileStateXML()", 5000 );
	log_activity("XML SYNC (FIVE SECOND INTERVAL) STARTED. READY TO RECEIVE UPDATES.");
}

function rotateLangPackActiveOverlay(){

		tmp_index_cnt = profileOverlayARRAY.length;
		for(i=0;i<tmp_index_cnt;i++){

			tmp_type = profileOverlayARRAY[i].type;

			switch(tmp_type){
				case 'mini':

					if(profileOverlayARRAY[i].master_overlay_visible_BOOL==true || profileOverlayARRAY[i].master_overlay_visible_BOOL=='true'){
						langPack_rotation_interval_MINI_cnt = langPack_rotation_interval_MINI_cnt + 2;
						langPack_rotation_interval_MINI_FULL_cnt = langPack_rotation_interval_MINI_FULL_cnt + 2;
						langPack_rotation_interval_MINI_FULL_SUB_cnt = langPack_rotation_interval_MINI_FULL_SUB_cnt + 2;

					}else{
						//
						// IF HIDDEN. NO ROTATE.
						authFlag_langPack_MiniFull_rotate = 0;
						langPack_Mini_langPack_rotation_LCK = 1;
					}

					//
					// OVERLAY STATUS
					tmp_master_visibility = profileOverlayARRAY[i].master_overlay_visible_BOOL;
					tmp_overlay_mode = profileOverlayARRAY[i].overlay_mode;
					tmp_mdscrl_lang_rotate_interval = profileOverlayARRAY[i].mdscrl_lang_rotate_interval;
					tmp_mdfull_lang_rotate_interval = profileOverlayARRAY[i].mdfull_lang_rotate_interval;
					tmp_mdfull_sub_copy_rotate_interval = profileOverlayARRAY[i].mdfull_sub_copy_rotate_interval;
					tmp_mini_full_ai_sleep_time = profileOverlayARRAY[i].mini_full_ai_sleep_time;
					tmp_mini_full_ai_lang_pack_iteration_cnt = profileOverlayARRAY[i].mini_full_ai_lang_pack_iteration_cnt;
					tmp_mini_scrl_ai_sleep_time = profileOverlayARRAY[i].mini_scrl_ai_sleep_time;
					tmp_mini_scrl_ai_lang_pack_iteration_cnt = profileOverlayARRAY[i].mini_scrl_ai_lang_pack_iteration_cnt;
					tmp_mini_ai_alternate_overlay_mode = profileOverlayARRAY[i].mini_ai_alternate_overlay_mode;
					tmp_lang_cnt = profileOverlayARRAY[i].lang_pack_translations.lang_id.length;

					if(ai_oMode_set_return_to === false){

						switch(tmp_mini_ai_alternate_overlay_mode){
							case 'EQUAL':
								if(ai_oMode_return_to_omode=='FULL'){

									//
									// WILL RETURN TO SCROLL
									ai_oMode_return_to_omode = 'SCROLL';
									ai_oMode_set_return_to = true;
								}else{

									//
									// WILL RETURN TO FULL
									ai_oMode_return_to_omode = 'FULL';
									ai_oMode_set_return_to = true;
								}

								break;
							default:
								ai_oMode_return_to_omode = tmp_overlay_mode;
								ai_oMode_set_return_to = true;

								break;

						}

						log_activity('***** SLEEP RETURN MODE=['+ai_oMode_return_to_omode+']');

					}

					switch(tmp_mini_ai_alternate_overlay_mode){
						case 'EQUAL':
							switch(ai_oMode_return_to_omode){
								case 'SCROLL':

									tmp_ai_sleep_duration = tmp_mini_full_ai_sleep_time;
									tmp_ai_rotate_cnt = mini_full_ai_lang_pack_rotation_cnt;
									max_lang_pack_rotate = Number(tmp_mini_full_ai_lang_pack_iteration_cnt);
									break;
								case 'FULL':

									tmp_ai_sleep_duration = tmp_mini_scrl_ai_sleep_time;
									tmp_ai_rotate_cnt = mini_scrl_ai_lang_pack_rotation_cnt;
									max_lang_pack_rotate = Number(tmp_mini_scrl_ai_lang_pack_iteration_cnt);
									break;
							}

						break;
						default:

							switch(ai_oMode_return_to_omode){
								case 'FULL':

									tmp_ai_sleep_duration = tmp_mini_full_ai_sleep_time;
									tmp_ai_rotate_cnt = mini_full_ai_lang_pack_rotation_cnt;
									max_lang_pack_rotate = Number(tmp_mini_full_ai_lang_pack_iteration_cnt);
									break;
								case 'SCROLL':

									tmp_ai_sleep_duration = tmp_mini_scrl_ai_sleep_time;
									tmp_ai_rotate_cnt = mini_scrl_ai_lang_pack_rotation_cnt;
									max_lang_pack_rotate = Number(tmp_mini_scrl_ai_lang_pack_iteration_cnt);
									break;
							}
						break;

					}

					//
					// AI MANAGEMENT
					log_activity('OH, DEAREST LORD,...WE ENTER HEARTBEAT WITH-> AI['+ai_oMode_sleep+'] ai_lang_pack_rotation_cnt['+ai_lang_pack_rotation_cnt+'] tmp_ai_rotate_cnt['+tmp_ai_rotate_cnt+'] max_lang_pack_rotate['+max_lang_pack_rotate+'] tmp_ai_sleep_duration['+tmp_ai_sleep_duration+']');

					//
					// CHECK THIS BEFORE IT RUNS BELOW...PREIMPTIVELY ADJUST
					switch(tmp_overlay_mode) {
						case 'SCROLL':
							if(langPack_rotation_interval_MINI_cnt>tmp_mdscrl_lang_rotate_interval){

								if(Number(tmp_ai_rotate_cnt) == Number(max_lang_pack_rotate)) {
									tmp_curr_lang_id = current_lang_pack(profileOverlayARRAY[i]);

									tmp_freshNxtLangPack = returnNextLangPack(profileOverlayARRAY[i], tmp_curr_lang_id);

									log_activity('***** AI FLAG LAST LANG PACK BEFORE SLEEP...' + tmp_curr_lang_id);
									log_activity('***** AI FLAG RESUMPTION LANG PACK AFTER SLEEP...' + tmp_freshNxtLangPack);
									$('#nxt_langpack').html(tmp_freshNxtLangPack);
									ai_sleep_rotate_FLAG = 1;

								}

							}

						break;
						case 'FULL':
							if (langPack_rotation_interval_MINI_FULL_cnt > tmp_mdfull_lang_rotate_interval) {
								tmp_rotate_chk = tmp_ai_rotate_cnt + 1;
								//tmp_rotate_chk = tmp_ai_rotate_cnt;

								if (tmp_rotate_chk > max_lang_pack_rotate) {
									//tmp_ai_rotate_cnt = tmp_rotate_chk;
									//mini_full_ai_lang_pack_rotation_cnt = tmp_rotate_chk;

								}

								if(Number(tmp_ai_rotate_cnt) == Number(max_lang_pack_rotate)) {
									tmp_curr_lang_id = current_lang_pack(profileOverlayARRAY[i]);

									tmp_freshNxtLangPack = returnNextLangPack(profileOverlayARRAY[i], tmp_curr_lang_id);

									log_activity('***** AI FLAG LAST LANG PACK BEFORE SLEEP...' + tmp_curr_lang_id);
									log_activity('***** AI FLAG RESUMPTION LANG PACK AFTER SLEEP...' + tmp_freshNxtLangPack);
									ai_sleep_rotate_FLAG = 1;

								}

							}
						break;
					}

					if(tmp_ai_rotate_cnt > max_lang_pack_rotate && Number(tmp_ai_sleep_duration) > 100){

						switch(ai_oMode_sleep){
							case 'ON':
								log_activity('***** SWITCH THROW ::  AI['+ai_oMode_sleep+'] tmp_ai_sleep_duration['+tmp_ai_sleep_duration+'] ai_trk_sleep_time['+ai_trk_sleep_time+']');
								if(tmp_ai_sleep_duration>ai_trk_sleep_time){
									ai_trk_sleep_time = Number(ai_trk_sleep_time) + 2000;

								}else{

									ai_oMode_sleep = 'TURN_OFF';
									ai_trk_sleep_time = 0;
								}
							break;
							case 'TURN_OFF':
								log_activity('***** SWITCH THROW :: AI['+ai_oMode_sleep+'] tmp_ai_sleep_duration['+tmp_ai_sleep_duration+'] ai_trk_sleep_time['+ai_trk_sleep_time+']');

								tmp_curr_lang_id = current_lang_pack(profileOverlayARRAY[i]);

								tmp_freshNxtLangPack = returnNextLangPack(profileOverlayARRAY[i], tmp_curr_lang_id);
								current_lang_pack(profileOverlayARRAY[i], tmp_freshNxtLangPack);

								//$('#om').html('TIMER'); // IF SET TOO SOON, CANNOT RETRIEVE
								// PREVIOUS MODE FOR PROPER TRANSITION
								log_activity('***** OVERLAY MODE OVERRIDE oProfile.overlay_mode TO ['+ai_oMode_return_to_omode+'] tmp_freshNxtLangPack['+tmp_freshNxtLangPack+']');
								profileOverlayARRAY[i].overlay_mode = ai_oMode_return_to_omode;

								transitionToNewMode(profileOverlayARRAY[i], ai_oMode_return_to_omode);
								ai_oMode_set_return_to = false;

								switch(ai_oMode_return_to_omode){
									case 'FULL':
										//
										// RESET COUNTS ONLY. FIRE AUTH FLAGS AT END OF TRANSITION TO KEEP FROM FIRING TOO SOON
										mini_scrl_ai_lang_pack_rotation_cnt = 0;
										mini_full_ai_lang_pack_rotation_cnt = 0;
										langPack_rotation_interval_MINI_cnt = 0;
										langPack_rotation_interval_MINI_FULL_cnt = 0;

									break;
									default:
										langPack_Mini_langPack_rotation_LCK = 0;
										mini_scrl_ai_lang_pack_rotation_cnt = 0;

										authFlag_langPack_MiniFull_rotate = 1;
										mini_full_ai_lang_pack_rotation_cnt = 0;

										langPack_rotation_interval_MINI_cnt = 0;
									break;

								}

								ai_oMode_sleep = 'OFF';

							break;
							default:
								//
								// CURRENT STATE IS OFF
								// ENTER SLEEP MODE
								ai_oMode_sleep = 'ON';

								//
								// SHUT DOWN SCROLLER LANG PACK ROTATION - LOCK ON
								langPack_Mini_langPack_rotation_LCK = 1;

								//
								// SHUT DOWN FULL LANG PACK ROTATION - AUTH OFF
								authFlag_langPack_MiniFull_rotate = 0;

								//
								// TRANSITION TO TIMER MODE
								transitionToNewMode(profileOverlayARRAY[i], 'TIMER');

								//switch(ai_oMode_return_to_omode){
								switch(tmp_overlay_mode){
									case 'FULL':
										ai_trk_sleep_time = -6000;
									break;
									case 'SCROLL':
										ai_trk_sleep_time = -2000;
									break;

								}

							break;


						}


					}

					if(mini_full_ai_lang_pack_rotation_cnt>1000){
						mini_full_ai_lang_pack_rotation_cnt=0;

					}

					/*
                            <mini_full_ai_sleep_time>120000</mini_full_ai_sleep_time>
                    <mini_full_ai_lang_pack_iteration_cnt>2</mini_full_ai_lang_pack_iteration_cnt>

                    <mini_scrl_ai_sleep_time>60000</mini_scrl_ai_sleep_time>
                    <mini_scrl_ai_lang_pack_iteration_cnt>2</mini_scrl_ai_lang_pack_iteration_cnt>

                    <mini_ai_alternate_overlay_mode>EQUAL</mini_ai_alternate_overlay_mode>
                            * */


					if((tmp_master_visibility==='true' || tmp_master_visibility===true) && (ai_oMode_sleep!="ON" && ai_oMode_sleep!='TURN_OFF')){

						//switch(tmp_overlay_mode){
						switch($('#om').html()){
							case 'SCROLL':

								if(sub_rotate_two_count_selah>0){
									sub_rotate_two_count_selah = Number(sub_rotate_two_count_selah) - 2;

								}


								if((langPack_Mini_langPack_rotation_LCK===0 || langPack_Mini_langPack_rotation_LCK==='0') && sub_rotate_two_count_selah==0 ){

									if(langPack_rotation_interval_MINI_cnt>tmp_mdscrl_lang_rotate_interval){
										langPack_rotation_interval_MINI_cnt = 0;

										tmp_lang_cnt = profileOverlayARRAY[i].lang_pack_translations.lang_id.length;

										if(ai_oMode_sleep=="OFF"){
											if(Number(tmp_ai_rotate_cnt) == Number(max_lang_pack_rotate)) {

												if (ai_sleep_rotate_FLAG == 0 || ai_sleep_rotate_FLAG == '0') {

													//
													// RUN ONE LANG PACK PAST - RETURN TO ORIGINAL FOR THIS RUN
													// ai_sleep_rotate_FLAG = 1;

													ai_lang_pack_rotation_cnt++;

													//
													// ONLY INCREMENT WHEN PASSED THROUGH ALL LANG PACKS
													if(ai_lang_pack_rotation_cnt==tmp_lang_cnt){

														mini_scrl_ai_lang_pack_rotation_cnt++;
														ai_lang_pack_rotation_cnt=0;

													}

													log_activity('ROTATE (SCROLL MODE) LANGUAGE PACK TO NEXT LANGUAGE PACK.');
													rotateMiniScrlLangPack(profileOverlayARRAY[i]);
													//throwTransitions(profileOverlayARRAY[i], profileOverlayARRAY[i].type, 'main');

												} else {

													//ai_oMode_sleep = 'ON';
													//mini_full_ai_lang_pack_rotation_cnt = 5000;

													log_activity('***** THROW SLEEP MODE TO ON AT NEXT HEARTBEAT! ai_oMode_sleep['+ai_oMode_sleep+'] ***** FROM LANG_ID=['+tmp_curr_lang_id+']');

													switch(tmp_overlay_mode) {
														case 'SCROLL':
															mini_scrl_ai_lang_pack_rotation_cnt++;
															break;
														case 'FULL':
															mini_full_ai_lang_pack_rotation_cnt++;
															break;
													}

													//tmp_lang_cnt = oProfile.lang_pack_translations.type.length;

													//
													// WE SHOULD BE SUB CONTENT MODE 1.
													// CLOSE OUT FULL MODE CONTENT. TRANSITION TO TIMER.

													//
													// LOCK LANG ROTATE. LOCK SUB COPY ROTATE. RESET COUNTERS...MAYBE...
													//langPack_Mini_langPack_rotation_LCK = 1;
													//mini_scrl_ai_lang_pack_rotation_cnt = 0;
													//authFlag_langPack_MiniFull_rotate = 0;
													//mini_full_ai_lang_pack_rotation_cnt = 0;

													//transitionToNewMode(profileOverlayARRAY[i], 'TIMER');

												}


											}else{

												ai_lang_pack_rotation_cnt++;

												if(ai_lang_pack_rotation_cnt==tmp_lang_cnt){

													mini_scrl_ai_lang_pack_rotation_cnt++;
													ai_lang_pack_rotation_cnt=0;

												}

												log_activity('ROTATE (SCROLL MODE) LANGUAGE PACK TO NEXT LANGUAGE PACK.');
												rotateMiniScrlLangPack(profileOverlayARRAY[i]);

											}

										}

										// ###########

										//
										// ROTATE LANG PACK IN SCROLL MODE.
										//throwTransitions(profileOverlayARRAY[i], profileOverlayARRAY[i].type, 'main');

									}
								}

								break;
							case 'FULL':

								if(sub_rotate_two_count_selah>0){
									sub_rotate_two_count_selah = Number(sub_rotate_two_count_selah) - 2;

								}

								if((authFlag_langPack_MiniFull_rotate==1 || authFlag_langPack_MiniFull_rotate=='1') && sub_rotate_two_count_selah==0 ){

									if(langPack_rotation_interval_MINI_FULL_cnt>tmp_mdfull_lang_rotate_interval){
										langPack_rotation_interval_MINI_FULL_cnt = 0;

										tmp_lang_cnt = profileOverlayARRAY[i].lang_pack_translations.lang_id.length;

										if(tmp_lang_cnt>1){

											//
											// ROTATE LANG PACK IN FULL MODE.
											log_activity('**** READY TO CALL ROTATION OF LANG PACK IN FULL MODE. SLEEP_MODE['+ai_oMode_sleep+'] ai_sleep_rotate_FLAG['+ai_sleep_rotate_FLAG+'] tmp_ai_rotate_cnt['+tmp_ai_rotate_cnt+'] max_lang_pack_rotate['+max_lang_pack_rotate+'] authFlag_langPack_MiniFull_rotate['+authFlag_langPack_MiniFull_rotate+'].');
											if(ai_oMode_sleep=="OFF"){
												if(Number(tmp_ai_rotate_cnt) == Number(max_lang_pack_rotate)) {

													if (ai_sleep_rotate_FLAG == 0 || ai_sleep_rotate_FLAG == '0') {

														//
														// RUN ONE LANG PACK PAST - RETURN TO ORIGINAL FOR THIS RUN
														// ai_sleep_rotate_FLAG = 1;

														ai_lang_pack_rotation_cnt++;

														//
														// ONLY INCREMENT WHEN PASSED THROUGH ALL LANG PACKS
														if(ai_lang_pack_rotation_cnt==tmp_lang_cnt){

															mini_full_ai_lang_pack_rotation_cnt++;
															ai_lang_pack_rotation_cnt=0;

														}

														log_activity('ROTATE (FULL MODE) LANGUAGE PACK TO NEXT LANGUAGE PACK.');
														rotateMiniFullLangPack(profileOverlayARRAY[i]);

													} else {

														//ai_oMode_sleep = 'ON';
														//mini_full_ai_lang_pack_rotation_cnt = 5000;

														log_activity('***** THROW SLEEP MODE TO ON AT NEXT HEARTBEAT! ai_oMode_sleep['+ai_oMode_sleep+'] ***** FROM LANG_ID=['+tmp_curr_lang_id+']');

														switch(tmp_overlay_mode) {
															case 'SCROLL':
																mini_scrl_ai_lang_pack_rotation_cnt++;
															break;
															case 'FULL':
																mini_full_ai_lang_pack_rotation_cnt++;
															break;
														}

														//tmp_lang_cnt = oProfile.lang_pack_translations.type.length;

														//
														// WE SHOULD BE SUB CONTENT MODE 1.
														// CLOSE OUT FULL MODE CONTENT. TRANSITION TO TIMER.

														//
														// LOCK LANG ROTATE. LOCK SUB COPY ROTATE. RESET COUNTERS...MAYBE...
														//langPack_Mini_langPack_rotation_LCK = 1;
														//mini_scrl_ai_lang_pack_rotation_cnt = 0;
														//authFlag_langPack_MiniFull_rotate = 0;
														//mini_full_ai_lang_pack_rotation_cnt = 0;

														//transitionToNewMode(profileOverlayARRAY[i], 'TIMER');

													}


												}else{

													ai_lang_pack_rotation_cnt++;

													if(ai_lang_pack_rotation_cnt==tmp_lang_cnt){

														mini_full_ai_lang_pack_rotation_cnt++;
														ai_lang_pack_rotation_cnt=0;

													}

													log_activity('ROTATE (FULL MODE) LANGUAGE PACK TO NEXT LANGUAGE PACK.');
													rotateMiniFullLangPack(profileOverlayARRAY[i]);

												}

											}

										}else{
											if(langPack_rotation_interval_MINI_FULL_SUB_cnt>tmp_mdfull_sub_copy_rotate_interval){
												langPack_rotation_interval_MINI_FULL_SUB_cnt = 0;

												//
												// ROTATE SUB COPY LANG PACK DATA IN FULL MODE.
												log_activity('**** CALL ROTATION OF SUB COPY FOR LANG PACK IN FULL MODE.');
												rotateMiniFullSubCopy(profileOverlayARRAY[i]);

											}

										}

										//throwTransitions(profileOverlayARRAY[i], profileOverlayARRAY[i].type, 'main');
									}else{

										if(langPack_rotation_interval_MINI_FULL_SUB_cnt>tmp_mdfull_sub_copy_rotate_interval){
											langPack_rotation_interval_MINI_FULL_SUB_cnt = 0;

											//
											// ROTATE SUB COPY LANG PACK DATA IN FULL MODE.
											//log_activity('**** READY TO CALL ROTATION OF SUB COPY IN LANG PACK IN FULL MODE.');
											log_activity('**** CALL ROTATION OF SUB COPY FOR LANG PACK IN FULL MODE.');
											rotateMiniFullSubCopy(profileOverlayARRAY[i]);

										}

									}


								}

								break;
						}

					}

					break;
				case 'full':

					if(profileOverlayARRAY[i].master_overlay_visible_BOOL==true || profileOverlayARRAY[i].master_overlay_visible_BOOL=='true'){
						langPack_rotation_interval_FULLSCRN_cnt = langPack_rotation_interval_FULLSCRN_cnt + 2;
						langPack_rotation_interval_FULLSCRN_SUB_cnt = langPack_rotation_interval_FULLSCRN_SUB_cnt + 2;

						tmp_lang_pack_rotation_interval_secs = profileOverlayARRAY[i].lang_pack_rotation_interval_secs;

					}else{
						//
						// IF HIDDEN. NO ROTATE.
						//authFlag_langPack_FullScrn_rotate = 0;

					}

					if(sub_rotate_FS_two_count_selah>0){
						sub_rotate_FS_two_count_selah = Number(sub_rotate_FS_two_count_selah) - 2;

					}

					tmp_lang_cnt = profileOverlayARRAY[i].lang_pack_translations.lang_id.length;
					tmp_subcopy_rotation_interval_secs = profileOverlayARRAY[i].subcopy_rotation_interval_secs;
					tmp_lang_pack_rotation_interval_secs = profileOverlayARRAY[i].lang_pack_rotation_interval_secs;

					if((authFlag_langPack_FullScrn_rotate==1 || authFlag_langPack_FullScrn_rotate=='1') && sub_rotate_FS_two_count_selah==0 && tmp_lang_cnt>1 ){

						if(langPack_rotation_interval_FULLSCRN_cnt>tmp_lang_pack_rotation_interval_secs){
							langPack_rotation_interval_FULLSCRN_cnt = 0;

							log_activity('ROTATE FULL SCREEN LANGUAGE PACK TO NEXT LANGUAGE PACK.');
							rotateFullScrnLangPack(profileOverlayARRAY[i]);

						}else{

							//
							// CHECK FOR SUB COPY ROTATION
							if(langPack_rotation_interval_FULLSCRN_SUB_cnt>tmp_subcopy_rotation_interval_secs){
								langPack_rotation_interval_FULLSCRN_SUB_cnt = 0;
								log_activity('FULL SCREEN - Rotate sub copy...');
							}


						}


					}

				break;

			}


		}

}

function returnNxtSubContentMini(oProfile, content_req=-1){

	/*
	newHTML = '<div id="minimax_SectA_view_window_'+ lang_id +'" class="view_window"><div id="minimax_primary_copy_sectA_'+ lang_id +'" class="minimax_primary_copy_sectA"><div id="minimax_primary_copy_sectA_handle_'+lang_id+'" class="minimax_primary_copy_sectA_handle">' + copy_m_title + '</div></div></div>' +
		'<div class="cb"></div>' +
		'<div id="minimax_hr_'+ lang_id +'" class="minimax_hr"></div>' +
		'<div id="timer_copy_'+ lang_id +'" class="timer_copy">' + tmp_wall_time + '</div>' +
		'<div id="minimax_primary_copy_sectB_'+ lang_id +'" class="minimax_primary_copy_sectB">' + copy_m_message + '</div>'+
		'<div class="cb"></div>' +
		'<div class="hidden">' +
		'<div id="mini_sub_total_height_'+ lang_id +'"></div>' +
		'<div id="mini_sub_sectA_height_'+ lang_id +'"></div>' +
		'<div id="mini_sub_sectA_maxheight_'+ lang_id +'"></div>' +
		'<div id="mini_sub_sectB_height_'+ lang_id +'"></div>' +
		'<div id="mini_sub_sectB_maxheight_'+ lang_id +'"></div>' +
		'<div id="mini_sub_rotate_elem_hash_' + lang_id +'">' + copy_hash + '</div>' +
		'<div id="mini_rotate_elem_title_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_title + '</div>' +
		'<div id="mini_rotate_elem_conf_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_conference + '</div>' +
		'<div id="mini_rotate_elem_date_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_date + '</div>' +
		'<div id="mini_rotate_elem_meta_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_message + '</div>' +
		'</div>';

		var lang_id = oProfile.lang_pack_translations.lang_id[pos];

		var copy_m_scroll_speed = oProfile.lang_pack_translations.copy_m_scroll_speed[pos];
		var copy_m_scroll_direction = oProfile.lang_pack_translations.copy_m_scroll_direction[pos];
		var copy_m_font_size_percentage = oProfile.lang_pack_translations.copy_m_font_size_percentage[pos];
		var copy_m_padding_top_px = oProfile.lang_pack_translations.copy_m_padding_top_px[pos];
		var timer_m_font_size_percentage = oProfile.lang_pack_translations.timer_m_font_size_percentage[pos];
		var cleartext_endpoint = oProfile.lang_pack_translations.cleartext_endpoint[pos];
		var copy_hash = oProfile.lang_pack_translations.copy_hash[pos];

	* */

	tmp_lang_id = current_lang_pack(oProfile);
	pos = langPack_Mini_IDtoIndex_ARRAY[tmp_lang_id];

	var copy_m_title = oProfile.lang_pack_translations.copy_m_title[pos];
	var copy_m_message = oProfile.lang_pack_translations.copy_m_message[pos];
	var copy_m_conference = oProfile.lang_pack_translations.copy_m_conference[pos];
	var copy_m_date = oProfile.lang_pack_translations.copy_m_date[pos];

	tmp_subcontent_view = returnMiniSubContentState();

	if(content_req>-1){

		tmp_subcontent_view = content_req;
	}

	switch(tmp_subcontent_view){
		case 0:
			tmp_html = copy_m_title;
		break;
		case 1:
			tmp_html = copy_m_date + '<div class="cb_20"></div>' + copy_m_conference;
		break;

	}

	return tmp_html;

}

function returnMiniSubContentState(){

	tmp_mini_subcontent_mode = $('#msm').html();

	if(tmp_mini_subcontent_mode=='0' || tmp_mini_subcontent_mode==0){

		//
		// TOGGLE THE STORED VALUE FOR NEXT TIME. SUCH A DEEP TECHNIQUE.
		$('#msm').html('1');
		return 1;
	}else{

		$('#msm').html('0');
		return 0;
	}

}

function syncTimerState(){
	if($('#timer_lck').html()=="OFF"){

		if($("#timer_copy_persist").length){
			var time_shown = $("#timer_copy_persist").html();
			var time_chunks = time_shown.split(":");
			var hour, mins, secs;

			hour=Number(time_chunks[0]);
			mins=Number(time_chunks[1]);
			secs=Number(time_chunks[2]);
			secs++;

            if (secs==5){
                //alert($('#minimax_primary_copy_sectA_handle_en').html()+'<--END]');
                //id="minimax_primary_copy_sectA_handle_'+lang_id+'"
            }

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

			$("#timer_copy_persist").html(hour +":" + plz(mins) + ":" + plz(secs));
			$("#timer_copy").html(hour +":" + plz(mins) + ":" + plz(secs));

		}
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

//
// LOAD INDEX XML
function syncProfileStateXML(){

	if(profile_overload=='true' || profile_overload==true) {

	}else{

		objectArrayProfileIndex = 0;
		overlayProfileData_cnt = 0;
		profileIndexARRAY = new Array();

		generate_cachebust();
		log_activity("Requesting Overlay Index XML doc ["+$('#cache_bust').html()+"]");

		var datafile = urlbase;
		var pars = "xml=i&t=" + $('#timer_copy_persist').html() + "&cache_b=" + $('#cache_bust').html();
		var uri = datafile+'?'+ pars;

		log_activity("Sending request [_GET]["+uri+"]");
		$.ajax({
			type: "GET",
			url: uri,
			dataType: "xml",
			success: parseProfileIndexXML
		});

	}


}

//
// LOAD PROFILE XML
function syncOverlayStateXML(pos){

	generate_cachebust();
	log_activity("Send an XML request for fresh profile data of index <profile> at node "+pos+".");

	//
	// RESET PROFILE ARRAY FOR REUSE WITH n+1 PROFILES
	//profileOverlayARRAY = new Array();
	//oOverlayProfileDataARRAY = new Array();

	if(profile_overload==true || profile_overload=='true'){
		//profile_overload = false;
		tmp_overload_cnt = profile_overload_xml_ARRAY.length;

		for(ol_cnt=0;ol_cnt<tmp_overload_cnt;ol_cnt++){

			var datafile = profile_overload_xml_ARRAY[ol_cnt];
			var pars = "t=" + $('#timer_copy_persist').html() + "&cache_b=" + $('#cache_bust').html();
			var uri = datafile+'?'+ pars;

			log_activity("Sending request [_GET]["+uri+"]");
			$.ajax({
				type: "GET",
				url: uri,
				dataType: "xml",
				success: parseOverlayProfileXML
			});

		}


	}else{

		var datafile = profileIndexARRAY[pos].profile_endpoint;
		var pars = "t=" + $('#timer_copy_persist').html() + "&cache_b=" + $('#cache_bust').html();
		var uri = datafile+'?'+ pars;

		log_activity("Sending request [_GET]["+uri+"]");
		$.ajax({
			type: "GET",
			url: uri,
			dataType: "xml",
			success: parseOverlayProfileXML
		});

	}


}

function parseOverlayProfileXML(xml){
	log_activity("Profile XML returned from endpoint.");

	$(xml).find("profile").each(function () {
		overlayProfileData_cnt++;
		tmp_type = $(this).find("type").text();

		log_activity("Traversing XML <profile> node ["+overlayProfileData_cnt+"] [type="+tmp_type+"]");

		xml_profile_cnt = 0;
		profileLoadLck[tmp_type] = 0;

		//
		// SEND RESPONSE NODE TO XML LOAD CONTROLLER FOR PROFILE
		loadOverlayProfile(this);

	});
}

function loadOverlayProfile(oItemNode){
	ii = xml_profile_cnt;
	for(ii;ii<overlayProfileData_cnt; ii++) {
		xml_profile_cnt++;

		var type = $(oItemNode).find("type").text();

		if(profileLoadLck[type]==0){
			profileLoadLck[type] = 1;

			switch(type){
				case 'mini':

					log_activity("Extracting "+type+" data from returned XML doc.");

					//
					// FOR XML OBJECT CONVERSION
					var temp_profile_param_array = new Array();

					temp_profile_param_array['type'] = type;
					temp_profile_param_array['pid'] = $(oItemNode).find("pid").text();
					temp_profile_param_array['lastmodified'] = $(oItemNode).find("lastmodified").text();
					temp_profile_param_array['master_overlay_visible_BOOL'] = $(oItemNode).find("master_overlay_visible_BOOL").text();
					temp_profile_param_array['timer_overlay_visible_BOOL'] = $(oItemNode).find("timer_overlay_visible_BOOL").text();
					temp_profile_param_array['overlay_mode'] = $(oItemNode).find("overlay_mode").text();
					temp_profile_param_array['timer_mode'] = $(oItemNode).find("timer_mode").text();
					temp_profile_param_array['height_mgmt_mode'] = $(oItemNode).find("height_mgmt_mode").text();
					temp_profile_param_array['timer_override_parameter'] = $(oItemNode).find("timer_override_parameter").text();
					temp_profile_param_array['timer_override_transaction_hash'] = $(oItemNode).find("timer_override_transaction_hash").text();

					temp_profile_param_array['mini_full_ai_sleep_time'] = $(oItemNode).find("mini_full_ai_sleep_time").text();
					temp_profile_param_array['mini_full_ai_lang_pack_iteration_cnt'] = $(oItemNode).find("mini_full_ai_lang_pack_iteration_cnt").text();
					temp_profile_param_array['mini_scrl_ai_sleep_time'] = $(oItemNode).find("mini_scrl_ai_sleep_time").text();
					temp_profile_param_array['mini_scrl_ai_lang_pack_iteration_cnt'] = $(oItemNode).find("mini_scrl_ai_lang_pack_iteration_cnt").text();
					temp_profile_param_array['mini_ai_alternate_overlay_mode'] = $(oItemNode).find("mini_ai_alternate_overlay_mode").text();

					temp_profile_param_array['mdtmr_bgwidth'] = $(oItemNode).find("mdtmr_bgwidth").text();
					temp_profile_param_array['mdtmr_bgheight'] = $(oItemNode).find("mdtmr_bgheight").text();
					temp_profile_param_array['mdtmr_bgopacity'] = $(oItemNode).find("mdtmr_bgopacity").text();
					temp_profile_param_array['mdtmr_bgcolor'] = $(oItemNode).find("mdtmr_bgcolor").text();
					temp_profile_param_array['mdtmr_bgbrdrcolor'] = $(oItemNode).find("mdtmr_bgbrdrcolor").text();
					temp_profile_param_array['mdtmr_pxfromtop'] = $(oItemNode).find("mdtmr_pxfromtop").text();
					temp_profile_param_array['mdtmr_pxfromleft'] = $(oItemNode).find("mdtmr_pxfromleft").text();
					temp_profile_param_array['mdtmr_brdrleftwidth'] = $(oItemNode).find("mdtmr_brdrleftwidth").text();
					temp_profile_param_array['mdtmr_brdrtopwidth'] = $(oItemNode).find("mdtmr_brdrtopwidth").text();
					temp_profile_param_array['mdtmr_brdrrightwidth'] = $(oItemNode).find("mdtmr_brdrrightwidth").text();
					temp_profile_param_array['mdtmr_brdrbttmwidth'] = $(oItemNode).find("mdtmr_brdrbttmwidth").text();
					temp_profile_param_array['mdtmr_copy_time_padleft'] = $(oItemNode).find("mdtmr_copy_time_padleft").text();
					temp_profile_param_array['mdtmr_copy_time_padright'] = $(oItemNode).find("mdtmr_copy_time_padright").text();

					temp_profile_param_array['mdscrl_bgwidth'] = $(oItemNode).find("mdscrl_bgwidth").text();
					temp_profile_param_array['mdscrl_bgheight'] = $(oItemNode).find("mdscrl_bgheight").text();
					temp_profile_param_array['mdscrl_bgopacity'] = $(oItemNode).find("mdscrl_bgopacity").text();
					temp_profile_param_array['mdscrl_bgcolor'] = $(oItemNode).find("mdscrl_bgcolor").text();
					temp_profile_param_array['mdscrl_bgbrdrcolor'] = $(oItemNode).find("mdscrl_bgbrdrcolor").text();
					temp_profile_param_array['mdscrl_pxfromtop'] = $(oItemNode).find("mdscrl_pxfromtop").text();
					temp_profile_param_array['mdscrl_pxfromleft'] = $(oItemNode).find("mdscrl_pxfromleft").text();
					temp_profile_param_array['mdscrl_brdrleftwidth'] = $(oItemNode).find("mdscrl_brdrleftwidth").text();
					temp_profile_param_array['mdscrl_brdrtopwidth'] = $(oItemNode).find("mdscrl_brdrtopwidth").text();
					temp_profile_param_array['mdscrl_brdrrightwidth'] = $(oItemNode).find("mdscrl_brdrrightwidth").text();
					temp_profile_param_array['mdscrl_brdrbttmwidth'] = $(oItemNode).find("mdscrl_brdrbttmwidth").text();
					temp_profile_param_array['mdscrl_copy_time_padleft'] = $(oItemNode).find("mdscrl_copy_time_padleft").text();
					temp_profile_param_array['mdscrl_copy_time_padright'] = $(oItemNode).find("mdscrl_copy_time_padright").text();

					temp_profile_param_array['mdfull_bgwidth'] = $(oItemNode).find("mdfull_bgwidth").text();
					temp_profile_param_array['mdfull_bgheight'] = $(oItemNode).find("mdfull_bgheight").text();
					temp_profile_param_array['mdfull_bgopacity'] = $(oItemNode).find("mdfull_bgopacity").text();
					temp_profile_param_array['mdfull_bgcolor'] = $(oItemNode).find("mdfull_bgcolor").text();
					temp_profile_param_array['mdfull_bgbrdrcolor'] = $(oItemNode).find("mdfull_bgbrdrcolor").text();
					temp_profile_param_array['mdfull_pxfromtop'] = $(oItemNode).find("mdfull_pxfromtop").text();
					temp_profile_param_array['mdfull_pxfromleft'] = $(oItemNode).find("mdfull_pxfromleft").text();
					temp_profile_param_array['mdfull_brdrleftwidth'] = $(oItemNode).find("mdfull_brdrleftwidth").text();
					temp_profile_param_array['mdfull_brdrtopwidth'] = $(oItemNode).find("mdfull_brdrtopwidth").text();
					temp_profile_param_array['mdfull_brdrrightwidth'] = $(oItemNode).find("mdfull_brdrrightwidth").text();
					temp_profile_param_array['mdfull_brdrbttmwidth'] = $(oItemNode).find("mdfull_brdrbttmwidth").text();
					temp_profile_param_array['mdfull_copy_time_padleft'] = $(oItemNode).find("mdfull_copy_time_padleft").text();
					temp_profile_param_array['mdfull_copy_time_padright'] = $(oItemNode).find("mdfull_copy_time_padright").text();

					temp_profile_param_array['mdfull_lang_rotate_interval'] = $(oItemNode).find("mdfull_lang_rotate_interval").text();
					temp_profile_param_array['mdscrl_lang_rotate_interval'] = $(oItemNode).find("mdscrl_lang_rotate_interval").text();
					temp_profile_param_array['mdfull_sub_copy_rotate_interval'] = $(oItemNode).find("mdfull_sub_copy_rotate_interval").text();
					temp_profile_param_array['mdscrl_scroll_speed'] = $(oItemNode).find("mdscrl_scroll_speed").text();
					temp_profile_param_array['mdfull_copy_sect_a_color'] = $(oItemNode).find("mdfull_copy_sect_a_color").text();
					temp_profile_param_array['mdfull_copy_sect_b_color'] = $(oItemNode).find("mdfull_copy_sect_b_color").text();
					temp_profile_param_array['mdfull_hr_color'] = $(oItemNode).find("mdfull_hr_color").text();
					temp_profile_param_array['mdtmr_copy_time_color'] = $(oItemNode).find("mdtmr_copy_time_color").text();
					temp_profile_param_array['mdfull_copy_time_color'] = $(oItemNode).find("mdfull_copy_time_color").text();
					temp_profile_param_array['mdscrl_copy_time_color'] = $(oItemNode).find("mdscrl_copy_time_color").text();
					temp_profile_param_array['mdfull_copy_sect_a_size_px'] = $(oItemNode).find("mdfull_copy_sect_a_size_px").text();
					temp_profile_param_array['mdfull_copy_sect_b_size_px'] = $(oItemNode).find("mdfull_copy_sect_b_size_px").text();

					temp_profile_param_array['mdtmr_copy_time_size_px'] = $(oItemNode).find("mdtmr_copy_time_size_px").text();
					temp_profile_param_array['mdscrl_copy_time_size_px'] = $(oItemNode).find("mdscrl_copy_time_size_px").text();
					temp_profile_param_array['mdfull_copy_time_size_px'] = $(oItemNode).find("mdfull_copy_time_size_px").text();

					temp_profile_param_array['name'] = $(oItemNode).find("name").text();
					temp_profile_param_array['config_hash'] = $(oItemNode).find("config_hash").text();

					var lang_pack_translations = new Array();
					var lang_pack_params = new Array();
					var lang_index = 0;

					$(oItemNode).find("lang_pack_translations").children().each(function () {

						//alert('23-> '+$(this).find("lang_id").text());
						lang_pack_params["lang_id"] = $(this).find("lang_id").text();
						lang_pack_params["copy_m_title"] = $(this).find("copy_m_title").text();
						lang_pack_params["copy_m_message"] = $(this).find("copy_m_message").text();
						lang_pack_params["copy_m_conference"] = $(this).find("copy_m_conference").text();
						lang_pack_params["copy_m_date"] = $(this).find("copy_m_date").text();
						lang_pack_params["copy_m_scroll_speed"] = $(this).find("copy_m_scroll_speed").text();
						lang_pack_params["copy_m_scroll_direction"] = $(this).find("copy_m_scroll_direction").text();
						lang_pack_params["copy_m_font_size_percentage"] = $(this).find("copy_m_font_size_percentage").text();
						lang_pack_params["content_shell_padding_top"] = $(this).find("content_shell_padding_top").text();
						lang_pack_params["copy_m_padding_top_px"] = $(this).find("copy_m_padding_top_px").text();
						lang_pack_params["copy_m_font_color_hex"] = $(this).find("copy_m_font_color_hex").text();
						lang_pack_params["timer_m_font_size_percentage"] = $(this).find("timer_m_font_size_percentage").text();
						lang_pack_params["cleartext_endpoint"] = $(this).find("cleartext_endpoint").text();
						lang_pack_params["copy_hash"] = $(this).find("copy_hash").text();

						lang_pack_translations.push(lang_pack_params);
						langPack_Mini_IDtoIndex_ARRAY[lang_pack_params["lang_id"]] = lang_index;

						lang_index++;

						lang_pack_params = new Array();

					});

					langPack_Mini_langID_ARRAY = lang_pack_translations;
					langPack_rotation_interval_MINI_SCROLL = temp_profile_param_array['mdscrl_lang_rotate_interval'];
					langPack_rotation_interval_MINI_FULL = temp_profile_param_array['mdfull_lang_rotate_interval'];
					langPack_SUB_rotation_interval_MINI_FULL = temp_profile_param_array['mdfull_sub_copy_rotate_interval'];

					log_activity("XML Extraction report for "+type+" data :: pid["+temp_profile_param_array['pid']+"] lang_pack_translations["+lang_pack_translations.length+"].");

					setOverlayProfileComponentObject(temp_profile_param_array, lang_pack_translations);

				break;
				case 'full':

					//
					// FOR XML OBJECT CONVERSION
					var temp_profile_param_array = new Array();

					temp_profile_param_array['type'] = type;
					temp_profile_param_array['pid'] = $(oItemNode).find("pid").text();
					temp_profile_param_array['lastmodified'] = $(oItemNode).find("lastmodified").text();
					temp_profile_param_array['master_overlay_visible_BOOL'] = $(oItemNode).find("master_overlay_visible_BOOL").text();
					temp_profile_param_array['copy_overlay_visible_BOOL'] = $(oItemNode).find("copy_overlay_visible_BOOL").text();
					temp_profile_param_array['height_mgmt_mode'] = $(oItemNode).find("height_mgmt_mode").text();
					temp_profile_param_array['master_overlay_display_area_width_in_px'] = $(oItemNode).find("master_overlay_display_area_width_in_px").text();
					temp_profile_param_array['master_overlay_display_area_height_in_px'] = $(oItemNode).find("master_overlay_display_area_height_in_px").text();
					temp_profile_param_array['copy_display_area_width_in_px'] = $(oItemNode).find("copy_display_area_width_in_px").text();
					temp_profile_param_array['copy_display_area_height_in_px'] = $(oItemNode).find("copy_display_area_height_in_px").text();

					temp_profile_param_array['master_overlay_bgcolor'] = $(oItemNode).find("master_overlay_bgcolor").text();
					temp_profile_param_array['master_overlay_bgopacity'] = $(oItemNode).find("master_overlay_bgopacity").text();
					temp_profile_param_array['overlay_copy_color'] = $(oItemNode).find("overlay_copy_color").text();
					temp_profile_param_array['name'] = $(oItemNode).find("name").text();
					temp_profile_param_array['lang_pack_rotation_interval_secs'] = $(oItemNode).find("lang_pack_rotation_interval_secs").text();
					temp_profile_param_array['subcopy_rotation_interval_secs'] = $(oItemNode).find("subcopy_rotation_interval_secs").text();

					temp_profile_param_array['config_hash'] = $(oItemNode).find("config_hash").text();

					var lang_pack_translations = new Array();
					var lang_pack_params = new Array();

					$(oItemNode).find("lang_pack_translations").children().each(function () {

						lang_pack_params["lang_id"] = $(this).find("lang_id").text();
						lang_pack_params["copy_fullscrn_header"] = $(this).find("copy_fullscrn_header").text();
						lang_pack_params["copy_fullscrn_title"] = $(this).find("copy_fullscrn_title").text();
						lang_pack_params["copy00_fullscrn_body"] = $(this).find("copy00_fullscrn_body").text();
						lang_pack_params["copy_fullscrn_font_size_percentage"] = $(this).find("copy_fullscrn_font_size_percentage").text();
						lang_pack_params["copy_fullscrn_font_color_hex"] = $(this).find("copy_fullscrn_font_color_hex").text();

						lang_pack_params["cleartext_endpoint"] = $(this).find("cleartext_endpoint").text();
						lang_pack_params["copy_hash"] = $(this).find("copy_hash").text();

						lang_pack_translations.push(lang_pack_params);

						lang_pack_params = new Array();

					});

					langPack_FULL_langID_ARRAY = lang_pack_translations;
					langPack_rotation_interval_FULL = temp_profile_param_array['lang_pack_rotation_interval_secs'];

					log_activity("XML Extraction report for "+type+" data :: pid["+temp_profile_param_array['pid']+"] lang_pack_translations["+lang_pack_translations.length+"].");

					setOverlayProfileComponentObject(temp_profile_param_array, lang_pack_translations);

					break;

			}
		}
	}

}

// MANAGE DOM THROUGH OBJECT INSTANTIATION...EXCLUSIVELY
function syncToProfile(){

	//
	// THIS SHOULD RUN EVEN IF ONLY ONE PROFILE PULLED THROUGH AJAX.
	if(objectArrayProfileOverlay_cnt>(total_index_invalid-1)){

		objectArrayProfileOverlay_cnt--;

		//alert('XML loading is complete...ready to transition '+profileOverlayARRAY.length+' profiles...');
		//$('msg_title').innerHTML = 'XML loading is complete. Now ready to transition '+profileOverlayARRAY.length+' overlay profile(s) to the UI. '+ $('msg_title').innerHTML;

		tmp_profile_cnt = profileOverlayARRAY.length;
		for(i=0;i<tmp_profile_cnt;i++){

			//alert(profileOverlayARRAY[i].type);
			//alert(profileOverlayARRAY.length);
			//alert(profileOverlayARRAY[i].type);

			switch(profileOverlayARRAY[i].type){

				case 'full':

					//
					// LOAD LANG PACK DATA
					tmp_lang_cnt = profileOverlayARRAY[i].lang_pack_translations.lang_id.length;

					for(ii=0; ii<tmp_lang_cnt; ii++){

						/*
						this.type = type_ARRAY;
						this.lang_id = lang_id_ARRAY;
						this.copy_fullscrn_header = copy_fullscrn_header_ARRAY;
						this.copy_fullscrn_title = copy_fullscrn_title_ARRAY;
						this.copy00_fullscrn_body = copy00_fullscrn_body_ARRAY;
						this.copy_fullscrn_font_size_percentage  = copy_fullscrn_font_size_percentage_ARRAY;
						this.cleartext_endpoint  = cleartext_endpoint_ARRAY;
						this.copy_hash = copy_hash_ARRAY;
						*/

						//
						// GRIP DATA
						var tmp_lang_id = profileOverlayARRAY[i].lang_pack_translations.lang_id[ii];
						var tmp_copy_fullscrn_header = profileOverlayARRAY[i].lang_pack_translations.copy_fullscrn_header[ii];
						var tmp_copy_fullscrn_title = profileOverlayARRAY[i].lang_pack_translations.copy_fullscrn_title[ii];
						var tmp_copy00_fullscrn_body = profileOverlayARRAY[i].lang_pack_translations.copy00_fullscrn_body[ii];
						var tmp_copy_fullscrn_font_size_percentage = profileOverlayARRAY[i].lang_pack_translations.copy_fullscrn_font_size_percentage[ii];

						var tmp_cleartext_endpoint = profileOverlayARRAY[i].lang_pack_translations.cleartext_endpoint[ii];
						var tmp_copy_hash = profileOverlayARRAY[i].lang_pack_translations.copy_hash[ii];

						//
						// CREATE CONTAINER DIV FOR LANG PACK DATA
						if($('#langpack_full_copy_' + tmp_lang_id).length){
							$('#langpack_full_copy_' + tmp_lang_id).html('');
							var objLangPack = $('#langpack_full_copy_' + tmp_lang_id);

						}else{

							//var objUIMitigator = $('overlay_content_shell');
							var objLangPack = document.createElement('div');
							objLangPack.setAttribute('id', 'langpack_full_copy_' + tmp_lang_id);
							objLangPack.setAttribute('class', 'overlay_content');

							//objUIMitigator.appendChild(objLangPack);
							$( "#overlay_content_shell").append( objLangPack );
						}

						//
						// HIDE THE NEW DIV
						objLangPack.style.display = "none";

						tmp_innerHTML = '<div class="cb_20"></div><div class="main_copy_header"><h3>' + tmp_copy_fullscrn_header + '</h3></div>' +
							'<div class="cb_30"></div>' +
							'<div class="main_document_title"><h1>' + tmp_copy_fullscrn_title + '</h1></div>' +
							'<div class="cb_15"></div>' +
							'<div class="main_document_body">' + tmp_copy00_fullscrn_body + '</div>';

						objLangPack.innerHTML = tmp_innerHTML;

						//
						// APPLY LANG PROFILE SETTINGS TO NEW PACK WRAPPER WITH FRESH CONTENT
						applyLangPackStyles_FULL(profileOverlayARRAY[i].type, objLangPack,tmp_copy_fullscrn_font_size_percentage, tmp_cleartext_endpoint,tmp_copy_hash);

						if(tmp_lang_id=='en') {

							//	tmp_pos = i;
							//	langPack_Mini_curr_langID = tmp_lang_id;
							//	langPack_Mini_Profile_with_langID = tmp_pos;

							//
							// UNLOCK LANG PACK DIV ROTATION
							langPack_FULL_rotationLock_BOOL = false;

						}

					}

					break;

			}

		}

	}

}

function applyLangPackStyles_FULL(overlay_type, objLangPack, tmp_copy_fullscrn_font_size_percentage, cleartext_endpoint,copy_hash){

	//
	// APPLY CSS STYLES  [font_size_percentage]
	objLangPack.getElementsByClassName("main_copy_header")[0].style.fontSize = tmp_copy_fullscrn_font_size_percentage+"%";
	objLangPack.getElementsByClassName("main_document_title")[0].style.fontSize = tmp_copy_fullscrn_font_size_percentage+"%";
	objLangPack.getElementsByClassName("main_document_body")[0].style.fontSize = tmp_copy_fullscrn_font_size_percentage+"%";

}

function setOverlayProfileComponentObject(paramArray, lang_pack_translations){

	//profileOverlayARRAY[objectArrayProfileOverlay_cnt++] = new oProfileOverlay(paramArray, lang_pack_translations);

	tmp_obj = new oProfileOverlay(paramArray, lang_pack_translations);

	//
	// WE WILL DEFINE FULL SCREEN AS 0 AND MINI AS 1
	switch(tmp_obj.type){
		case 'full':
			profileOverlayARRAY[0] = tmp_obj;
		break;
		case 'mini':
			profileOverlayARRAY[1] = tmp_obj;

		break;

	}

	//profileOverlayARRAY.push(tmp_obj);  // DOES NOT SUPPORT SYNC'ING ONLY 1 FILE...AND KEEPING PREV OF THE OTHER.
	objectArrayProfileOverlay_cnt++;

}

//
// TREAT THIS OBJECT AS A REAL-TIME MIRROR OF THE OVERLAY...EFFECTIVELY MAKING
// THIS THE UI CONTROLLER UPON IT'S INSTANTIATION
function oProfileOverlay(paramArray, langPackArray){
	this.type = paramArray['type'];

	switch(this.type){
		case 'mini':
			log_activity("Building "+this.type+" object [pid="+paramArray['pid']+"] [config_hash="+paramArray['config_hash']+"].");

			this.pid = paramArray['pid'];
			this.lastmodified = paramArray['lastmodified'];
			this.master_overlay_visible_BOOL = paramArray['master_overlay_visible_BOOL'];
			this.timer_overlay_visible_BOOL = paramArray['timer_overlay_visible_BOOL'];
			this.overlay_mode = paramArray['overlay_mode'];
			this.timer_mode = paramArray['timer_mode'];
			this.height_mgmt_mode = paramArray['height_mgmt_mode'];
			this.timer_override_parameter = paramArray['timer_override_parameter'];
			this.timer_override_transaction_hash = paramArray['timer_override_transaction_hash'];

			this.mini_full_ai_sleep_time = paramArray['mini_full_ai_sleep_time'];
			this.mini_full_ai_lang_pack_iteration_cnt = paramArray['mini_full_ai_lang_pack_iteration_cnt'];
			this.mini_scrl_ai_sleep_time = paramArray['mini_scrl_ai_sleep_time'];
			this.mini_scrl_ai_lang_pack_iteration_cnt = paramArray['mini_scrl_ai_lang_pack_iteration_cnt'];
			this.mini_ai_alternate_overlay_mode = paramArray['mini_ai_alternate_overlay_mode'];

			this.mdtmr_bgwidth = paramArray['mdtmr_bgwidth'];
			this.mdtmr_bgheight = paramArray['mdtmr_bgheight'];
			this.mdtmr_bgopacity = paramArray['mdtmr_bgopacity'];
			this.mdtmr_bgcolor = paramArray['mdtmr_bgcolor'];
			this.mdtmr_bgbrdrcolor = paramArray['mdtmr_bgbrdrcolor'];
			this.mdtmr_pxfromtop = paramArray['mdtmr_pxfromtop'];
			this.mdtmr_pxfromleft = paramArray['mdtmr_pxfromleft'];
			this.mdtmr_brdrleftwidth = paramArray['mdtmr_brdrleftwidth'];
			this.mdtmr_brdrtopwidth = paramArray['mdtmr_brdrtopwidth'];
			this.mdtmr_brdrrightwidth = paramArray['mdtmr_brdrrightwidth'];
			this.mdtmr_brdrbttmwidth = paramArray['mdtmr_brdrbttmwidth'];
			this.mdtmr_copy_time_padleft = paramArray['mdtmr_copy_time_padleft'];
			this.mdtmr_copy_time_padright = paramArray['mdtmr_copy_time_padright'];

			this.mdscrl_bgwidth = paramArray['mdscrl_bgwidth'];
			this.mdscrl_bgheight = paramArray['mdscrl_bgheight'];
			this.mdscrl_bgopacity = paramArray['mdscrl_bgopacity'];
			this.mdscrl_bgcolor = paramArray['mdscrl_bgcolor'];
			this.mdscrl_bgbrdrcolor = paramArray['mdscrl_bgbrdrcolor'];
			this.mdscrl_pxfromtop = paramArray['mdscrl_pxfromtop'];
			this.mdscrl_pxfromleft = paramArray['mdscrl_pxfromleft'];
			this.mdscrl_brdrleftwidth = paramArray['mdscrl_brdrleftwidth'];
			this.mdscrl_brdrtopwidth = paramArray['mdscrl_brdrtopwidth'];
			this.mdscrl_brdrrightwidth = paramArray['mdscrl_brdrrightwidth'];
			this.mdscrl_brdrbttmwidth = paramArray['mdscrl_brdrbttmwidth'];
			this.mdscrl_copy_time_padleft = paramArray['mdscrl_copy_time_padleft'];
			this.mdscrl_copy_time_padright = paramArray['mdscrl_copy_time_padright'];

			this.mdfull_bgwidth = paramArray['mdfull_bgwidth'];
			this.mdfull_bgheight = paramArray['mdfull_bgheight'];
			this.mdfull_bgopacity = paramArray['mdfull_bgopacity'];
			this.mdfull_bgcolor = paramArray['mdfull_bgcolor'];
			this.mdfull_bgbrdrcolor = paramArray['mdfull_bgbrdrcolor'];
			this.mdfull_pxfromtop = paramArray['mdfull_pxfromtop'];
			this.mdfull_pxfromleft = paramArray['mdfull_pxfromleft'];
			this.mdfull_brdrleftwidth = paramArray['mdfull_brdrleftwidth'];
			this.mdfull_brdrtopwidth = paramArray['mdfull_brdrtopwidth'];
			this.mdfull_brdrrightwidth = paramArray['mdfull_brdrrightwidth'];
			this.mdfull_brdrbttmwidth = paramArray['mdfull_brdrbttmwidth'];
			this.mdfull_copy_time_padleft = paramArray['mdfull_copy_time_padleft'];
			this.mdfull_copy_time_padright = paramArray['mdfull_copy_time_padright'];

			this.mdfull_lang_rotate_interval = paramArray['mdfull_lang_rotate_interval'];
			this.mdscrl_lang_rotate_interval = paramArray['mdscrl_lang_rotate_interval'];
			this.mdfull_sub_copy_rotate_interval = paramArray['mdfull_sub_copy_rotate_interval'];
			this.mdscrl_scroll_speed = paramArray['mdscrl_scroll_speed'];
			this.mdfull_copy_sect_a_color = paramArray['mdfull_copy_sect_a_color'];
			this.mdfull_copy_sect_b_color = paramArray['mdfull_copy_sect_b_color'];
			this.mdfull_hr_color = paramArray['mdfull_hr_color'];
			this.mdtmr_copy_time_color = paramArray['mdtmr_copy_time_color'];
			this.mdfull_copy_time_color = paramArray['mdfull_copy_time_color'];
			this.mdscrl_copy_time_color = paramArray['mdscrl_copy_time_color'];
			this.mdfull_copy_sect_a_size_px = paramArray['mdfull_copy_sect_a_size_px'];
			this.mdfull_copy_sect_b_size_px = paramArray['mdfull_copy_sect_b_size_px'];
			this.mdtmr_copy_time_size_px = paramArray['mdtmr_copy_time_size_px'];
			this.mdscrl_copy_time_size_px = paramArray['mdscrl_copy_time_size_px'];
			this.mdfull_copy_time_size_px = paramArray['mdfull_copy_time_size_px'];

			this.name = paramArray['name'];
			this.config_hash = paramArray['config_hash'];

			//
			// ## APPLY UI TRANSFORMS / CSS
			// ## BEEF THIS UP FOR...e.g....ON-TRAIN-TRACK(aka RAILS) TRANSITIONS
			// CAPTURE HIGH LEVEL UI DELTAS FROM REALITY
			this.curr_master_overlay_visible_BOOL = $('#mov').html();
			this.curr_timer_overlay_visible_BOOL = $('#tov').html();
			this.curr_copy_overlay_visible_BOOL = $('#cov').html();
			this.curr_overlay_mode = $('#om').html();
			this.curr_height_mgmt_mode = $('#hmm').html();

			tmp_elemid = 'config_hash_'+this.pid;
			tmp_elemval = this.config_hash;
			if($('#'+tmp_elemid).length){

			}else{

				var objFlagDiv = document.createElement('div');
				objFlagDiv.setAttribute('id', tmp_elemid);
				objFlagDiv.setAttribute('class','hidden');
				$( "#overlay_dyn_flags_container" ).append( objFlagDiv );

				$('#'+tmp_elemid).html(tmp_elemval);

			}

			//
			// UPDATE TO DESIRED REALIZATION OF REALITY
			$('#mov').html(this.master_overlay_visible_BOOL);
			$('#tov').html(this.timer_overlay_visible_BOOL);
			$('#om').html(this.overlay_mode);
			$('#hmm').html(this.height_mgmt_mode);

			this.lang_pack_translations = new oLangPack(langPackArray, this.type);

			//
			// PERFORM DOM TRANSFORMATION TO CONFORM TO DATABASE DEFINED, XML COMMUNICATED REALITY
			// THINK UI RAILS MOVING FORWARD
			syncVisibilityDeltas(this);

			log_activity("Finished building mini overlay object, where pid="+this.pid);

		break;
		case 'full':
			this.pid = paramArray['pid'];
			this.lastmodified = paramArray['lastmodified'];
			this.master_overlay_visible_BOOL = paramArray['master_overlay_visible_BOOL'];
			this.copy_overlay_visible_BOOL = paramArray['copy_overlay_visible_BOOL'];
			this.height_mgmt_mode = paramArray['height_mgmt_mode'];
			this.master_overlay_display_area_width_in_px = paramArray['master_overlay_display_area_width_in_px'];
			this.master_overlay_display_area_height_in_px = paramArray['master_overlay_display_area_height_in_px'];
			this.copy_display_area_width_in_px = paramArray['copy_display_area_width_in_px'];
			this.copy_display_area_height_in_px = paramArray['copy_display_area_height_in_px'];
			this.master_overlay_bgcolor = paramArray['master_overlay_bgcolor'];
			this.master_overlay_bgopacity = paramArray['master_overlay_bgopacity'];
			this.overlay_copy_color = paramArray['overlay_copy_color'];
			this.name = paramArray['name'];
			this.lang_pack_rotation_interval_secs = paramArray['lang_pack_rotation_interval_secs'];
			this.subcopy_rotation_interval_secs = paramArray['subcopy_rotation_interval_secs'];
			this.config_hash = paramArray['config_hash'];

			//
			// APPLY UI CSS
			//applyOverlayUICSS(this);

			tmp_elemid = 'config_hash_'+this.pid;
			tmp_elemval = this.config_hash;
			if($('#'+tmp_elemid).length){
				//$(tmp_elemid).innerHTML = this.config_hash;

			}else{

				//objFlagDataContainer = $('overlay_dyn_flags_container');

				var objFlagDiv = document.createElement('div');
				objFlagDiv.setAttribute('id', tmp_elemid);
				objFlagDiv.setAttribute('class','hidden');

				$( "#overlay_dyn_flags_container" ).append( objFlagDiv );

				//objFlagDiv.html(tmp_elemval);
				$('#'+tmp_elemid).html(tmp_elemval);

			}

			this.curr_master_overlay_visible_BOOL = $('#full_mov').html();
			this.curr_copy_overlay_visible_BOOL = $('#full_cov').html();

			$('#full_mov').html(this.master_overlay_visible_BOOL);
			$('#full_cov').html(this.copy_overlay_visible_BOOL);

			this.lang_pack_translations = new oLangPack(langPackArray, this.type);

			//
			// PERFORM DOM TRANSFORMATION TO CONFORM TO DATABASE DEFINED, XML COMMUNICATED REALITY
			// THINK UI RAILS MOVING FORWARD
			syncVisibilityDeltas(this);

			log_activity("Finished building full overlay object, where pid="+this.pid);
		break;

	}

}


// SOURCE :: https://stackoverflow.com/questions/14129953/how-to-encode-a-string-in-javascript-for-displaying-in-html
// AUTHOR :: https://stackoverflow.com/users/616443/j08691
function htmlEntities(str) {
	return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function log_activity(str){

	switch(log_controller){
		case 1:

			if(activity_log_FLAG!='') {

				//
				// LOG ACTIVITY TO SCREEN
				var timeStampInMs = window.performance && window.performance.now && window.performance.timing && window.performance.timing.navigationStart ? window.performance.now() + window.performance.timing.navigationStart : Date.now();

				var walltime = $("#timer_copy_persist").html();
				var objFlagDiv = document.createElement('div');
				objFlagDiv.setAttribute('class', 'log_entry');

				$("#activity_log_output").prepend(objFlagDiv);

				//
				// CLEAN STRING FOR HTML
				// &lt;profile&gt;
				str_clean = htmlEntities(str);

				objFlagDiv.innerHTML = timeStampInMs + ' (' + walltime + ') :: ' + str_clean;
				console.log(timeStampInMs + ' (' + walltime + ') :: ' + str);

			}

		break;
		case 0:
			//
			// SILENCE IS GOLDEN
		break;
		default:
			alert('The logger param [var log_controller] is not visible to me.');
		break;


	}

}

function syncVisibilityDeltas(oProfile) {

	log_activity("Ready to sync UI for "+oProfile.type+" overlay type.");

	switch(oProfile.type) {
		case 'mini':
			mini_overlay_original_height = Number($('#timer_copy').height()) + Number(hmm_buffer);

			master_overlay_visible = oProfile.master_overlay_visible_BOOL;
			timer_overlay_visible = oProfile.timer_overlay_visible_BOOL;
			curr_master_overlay_visible = oProfile.curr_master_overlay_visible_BOOL;
			curr_timer_overlay_visible = oProfile.curr_timer_overlay_visible_BOOL;
			curr_copy_overlay_visible = oProfile.curr_copy_overlay_visible_BOOL;
			curr_overlay_mode = oProfile.curr_overlay_mode;

			if(curr_master_overlay_visible==true || curr_master_overlay_visible=='true'){

				if(master_overlay_visible==true || master_overlay_visible=='true') {

					//
					// HANDLE TRANSITIONS TO RESOLVE UI DELTA FROM DATA
					// SWITCH OFF OF CURRENT OVERLAY MODE...NOT DESIRED MODE
					switch (curr_overlay_mode) {
						// TIMER,SCROLL,FULL
						case 'TIMER':
							log_activity("Transition " + oProfile.type + " overlay from " + curr_overlay_mode + " mode to " + oProfile.overlay_mode + " mode.");

							switch (oProfile.overlay_mode) {
								case 'SCROLL':

									//
									// NO NEED TO HIDE ANY COPY COMING FROM TIMER MODE

									//
									// BUILD XML DRIVEN STYLED COPY CONTENT,
									// UPDATE ENVIRONMENT TO CSS PER CONTENT REQ'S,
									transferLangPackToDOM(oProfile);

									//
									// SEND IT.
									transitionToNewMode(oProfile);

								break;
								case 'FULL':

									//
									// NO NEED TO HIDE ANY COPY COMING FROM TIMER MODE

									//
									// BUILD XML DRIVEN STYLED COPY CONTENT,
									// UPDATE ENVIRONMENT TO CSS PER CONTENT REQ'S,
									transferLangPackToDOM(oProfile);

									//
									// SEND IT.
									transitionToNewMode(oProfile);

								break;

							}

							break;
						case 'SCROLL':
							log_activity("**ERROR** JS SECTION NOT COMPLETE - transition request for taking " + oProfile.type + " overlay from " + curr_overlay_mode + " mode to " + oProfile.overlay_mode + " mode.");


							break;
						case 'FULL':
							log_activity("**ERROR** JS SECTION NOT COMPLETE - transition request for taking " + oProfile.type + " overlay from " + curr_overlay_mode + " mode to " + oProfile.overlay_mode + " mode.");


							break;
						default:
							log_activity("**ERROR** UNKNOWN transition request for taking " + oProfile.type + " overlay from " + curr_overlay_mode + " mode to " + oProfile.overlay_mode + " mode.");

							break;

					}
				}else{

					//
					// NEW MASTER OVERLAY VISIBILITY BOOL IS FALSE
					// HIDE OVERLAY AND DEACTIVATE LANG PACK TRANSITION ROTATION
					hideOverlay(oProfile, false);	// resetCount = [SCROLL, FULL, MINI(SCROLL+FULL), FULLSCRN]

				}
			}else{

				//
				// CURRENT IS FALSE. DO WE SHOW?
				if(master_overlay_visible==true || master_overlay_visible=='true') {

					//
					// SHOW OVERLAY AND ACTIVATE LANG PACK TRANSITION ROTATION
					showOverlay(oProfile, 'MINI');	// resetCount = [SCROLL, FULL, MINI(SCROLL+FULL), FULLSCRN]

					//
					// ANYTHING ELSE TO DO HERE?

				}else{

					//
					// LET'S TRY ENSURE LANG PACK ROTATION OFF HERE
					stopRotation(oProfile);

				}

			}

		break;
		case 'full':
			master_overlay_visible = oProfile.master_overlay_visible_BOOL;
			//copy_overlay_visible = oProfile.copy_overlay_visible_BOOL;

			if(master_overlay_visible==true || master_overlay_visible=='true'){

				//
				// BUILD XML DRIVEN STYLED COPY CONTENT,
				// UPDATE ENVIRONMENT TO CSS PER CONTENT REQ'S,
				transferLangPackToDOM(oProfile);

				//
				// SEND IT...
				transitionToNewMode(oProfile);

				//rotateFullScrnLangPack(oProfile);
				authFlag_langPack_FullScrn_rotate = 1;

			}else{

				//
				// HIDE OVERLAY AND DEACTIVATE LANG PACK TRANSITION ROTATION
				hideOverlay(oProfile, false);	// resetCount = [SCROLL, FULL, MINI(SCROLL+FULL), FULLSCRN]

			}


		break;
	}

}

function hideOverlay(oProfile, resetCount){

	//
	// STOP LANG PACK ROTATION
	stopRotation(oProfile, resetCount);

	switch(oProfile.type){
		case 'mini':

			//
			// JUST HIDE THE OVERLAY
			$( "#mini_overlay_handle").animate({
				opacity: 0.0
			}, {
				duration: 2000,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				step: function( now, fx ) {

				},
				complete: function () {


				}
			});


		break;
		case 'full':
			tmp_curr_lang_id = current_lang_pack(oProfile);

			//
			// STOP LANG PACK ROTATION
			stopRotation(oProfile, false);

			$( "#fullscrn_overlay_handle").animate({
				opacity: 0.0
			}, {
				duration: 2000,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				step: function( now, fx ) {

				},
				complete: function () {

					//
					// HIDE COPY
					$( "#fullscrn_content_" + tmp_curr_lang_id).animate({
						opacity: 0.0
					}, {
						duration: 0,
						queue: false,
						specialEasing: {
							opacity: "swing"
						},
						step: function( now, fx ) {

						},
						complete: function () {

							//
							// HIDE BACKGROUND
							$('#fullscrn_overlay_bg_wrapper').animate({
								opacity: 0.0
							}, {
								duration: 0,
								queue: false,
								specialEasing: {
									opacity: "swing"
								},
								step: function( now, fx ) {

								},
								complete: function () {

									//
									// RESET PARENT CONTAINER
									$('#fullscrn_overlay_handle').animate({
										opacity: 1
									}, {
										duration: 0,
										queue: false,
										specialEasing: {
											opacity: "swing"
										},
										step: function( now, fx ) {

										},
										complete: function () {


										}
									});

								}
							});

						}
					});


				}
			});

		break;

	}

}

function showOverlay(oProfile){

	switch(oProfile.type){
		case 'mini':

			//
			// START LANG PACK ROTATION
			startRotation(oProfile, oProfile.overlay_mode);  // resetCount = [SCROLL, FULL, MINI(SCROLL+FULL), FULLSCRN]

			//
			// JUST HIDE THE OVERLAY
			$( "#mini_overlay_handle").animate({
				opacity: 1.0
			}, {
				duration: 2000,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				step: function( now, fx ) {

				},
				complete: function () {

					//
					// START LANG PACK ROTATION - CALL TOO LATE? ROTATE AUTH REST TO 0 FROM HIDDEN STATE?
					//startRotation(oProfile, oProfile.overlay_mode);  // resetCount = [SCROLL, FULL, MINI(SCROLL+FULL), FULLSCRN]


				}
			});


			break;
		case 'full':

			authFlag_langPack_FullScrn_rotate = 1;
		break;

	}

}

// resetCount = [SCROLL, FULL, MINI(SCROLL+FULL), FULLSCRN]
function startRotation(oProfile, resetCount=false){
	switch(oProfile.type){
		case 'mini':
			mini_scrl_ai_lang_pack_rotation_cnt = 0;
			mini_full_ai_lang_pack_rotation_cnt = 0;
			langPack_rotation_interval_MINI_cnt = 0;
			langPack_rotation_interval_MINI_FULL_cnt = 0;

			switch(oProfile.overlay_mode){
				case 'SCROLL':

					langPack_Mini_langPack_rotation_LCK = 0;
					/*
					if(resetCount!=false && resetCount!='false') {

						switch (resetCount) {
							case 'SCROLL':
								mini_scrl_ai_lang_pack_rotation_cnt = 0;
								langPack_rotation_interval_MINI_cnt = 0;
								break;
							case 'FULL':
								mini_full_ai_lang_pack_rotation_cnt = 0;
								langPack_rotation_interval_MINI_cnt = 0;
								break;
							case 'MINI':
								mini_scrl_ai_lang_pack_rotation_cnt = 0;
								langPack_rotation_interval_MINI_cnt = 0;
								mini_full_ai_lang_pack_rotation_cnt = 0;
								langPack_rotation_interval_MINI_cnt = 0;
								break;
							case 'FULLSCRN':

								break;
						}
					}
 					*/

				break;
				case 'FULL':

					authFlag_langPack_MiniFull_rotate = 1;
					/*
					if(resetCount!=false && resetCount!='false') {

						switch (resetCount) {
							case 'SCROLL':
								mini_scrl_ai_lang_pack_rotation_cnt = 0;
								langPack_rotation_interval_MINI_cnt = 0;
								break;
							case 'FULL':
								mini_full_ai_lang_pack_rotation_cnt = 0;
								langPack_rotation_interval_MINI_cnt = 0;
								break;
							case 'MINI':
								mini_scrl_ai_lang_pack_rotation_cnt = 0;
								langPack_rotation_interval_MINI_cnt = 0;
								mini_full_ai_lang_pack_rotation_cnt = 0;
								langPack_rotation_interval_MINI_cnt = 0;
								break;
							case 'FULLSCRN':

								break;
						}
					}
					*/

				break;

			}

			break;
		case 'full':
			//
			// START FULL SCREEN LANG PACK ROTATION

		break;

	}

}

// resetCount = [SCROLL, FULL, MINI(SCROLL+FULL), FULLSCRN]
function stopRotation(oProfile, resetCount=false){

	tmp_type = oProfile.type;

	switch(tmp_type){
		case 'mini':

			authFlag_langPack_MiniFull_rotate = 0;
			langPack_Mini_langPack_rotation_LCK = 1;

			if(resetCount!=false && resetCount!='false') {

				switch (resetCount) {
					case 'SCROLL':
						mini_scrl_ai_lang_pack_rotation_cnt = 0;
						langPack_rotation_interval_MINI_cnt = 0;
					break;
					case 'FULL':
						mini_full_ai_lang_pack_rotation_cnt = 0;
						langPack_rotation_interval_MINI_cnt = 0;
					break;
					case 'MINI':
						mini_scrl_ai_lang_pack_rotation_cnt = 0;
						langPack_rotation_interval_MINI_cnt = 0;
						mini_full_ai_lang_pack_rotation_cnt = 0;
						langPack_rotation_interval_MINI_cnt = 0;
					break;
					case 'FULLSCRN':

					break;
				}
			}
			break;
		case 'full':
			//
			// STOP FULL SCREEN LANG PACK ROTATION
			langPack_rotation_interval_FULLSCRN_cnt = 0;
			authFlag_langPack_FullScrn_rotate = 0;

		break;

	}

}

function current_lang_pack(oProfile, newlang_id=''){

	switch(oProfile.type){
		case 'mini':

			if(newlang_id==''){

				//
				// RETRIEVE AND RETURN CURRENT LANG PACK
				tmp_curr_mini_lang_pack_HTML = $('#curr_mini_lang_pack').html();

				if(tmp_curr_mini_lang_pack_HTML==''){

					//
					// RETRIEVE LANG_ID [0] AND STORE AS CURRENT, AND RETURN
					tmp_curr_mini_lang_pack_HTML = oProfile.lang_pack_translations.lang_id[0];
					$('#curr_mini_lang_pack').html(tmp_curr_mini_lang_pack_HTML);

				}

				return tmp_curr_mini_lang_pack_HTML;

			}else{

				//
				// UPDATE CURRENT LANG PACK
				$('#curr_mini_lang_pack').html(newlang_id);

			}
		break;
		case 'full':

			if(newlang_id==''){

				//
				// RETRIEVE AND RETURN CURRENT LANG PACK
				tmp_curr_lang_pack_HTML = $('#curr_full_lang_pack').html();

				if(tmp_curr_lang_pack_HTML==''){

					//
					// RETRIEVE LANG_ID [0] AND STORE AS CURRENT, AND RETURN
					tmp_curr_lang_pack_HTML = oProfile.lang_pack_translations.lang_id[0];
					$('#curr_full_lang_pack').html(tmp_curr_lang_pack_HTML);

				}

				return tmp_curr_lang_pack_HTML;

			}else{

				//
				// UPDATE CURRENT LANG PACK
				$('#curr_full_lang_pack').html(newlang_id);

			}
		break;

	}


}

function retrieve_overlay_bg_height(oProfile){
	//
	// APPLY UI TRANSFORMS FOR OVERLAY AND CONTENT
	var type = oProfile.type;

	switch(type){
		case 'mini':
			var overlay_mode = oProfile.overlay_mode;
			var curr_mini_lang_pack = current_lang_pack(oProfile);

			switch(overlay_mode){
				case 'FULL':
					//
					// APPLY DYNAMIC OR STRAIGHT LINE HEIGHT CALCS
					tmp_height_mgmt_mode = oProfile.height_mgmt_mode;
					switch(tmp_height_mgmt_mode){
						case 'STRAIGHT_LINE':

							overlay_MINI_new_bg_height = Number(langPack_MINI_maxheight_FullAll) + Number(hmm_buffer);

							break;
						default:

							//
							// DYNAMIC HEIGHT MGMT
							overlay_MINI_new_bg_height = Number(hmm_buffer) + Number($('#mini_sub_total_height_' + curr_mini_lang_pack).html());


							// 75 - 200  (+125)
							// 700 - 575  (-125)
							break;

					}
					log_activity('**** NEW OVERLAY BG HEIGHT->'+overlay_MINI_new_bg_height+', which came from ['+curr_mini_lang_pack+']['+$("#mini_sub_total_height_" + curr_mini_lang_pack).html()+']');
					//return overlay_MINI_new_bg_height;

				break;
				case 'SCROLL':
					//
					// APPLY DYNAMIC OR STRAIGHT LINE HEIGHT CALCS
					tmp_height_mgmt_mode = oProfile.height_mgmt_mode;
					switch(tmp_height_mgmt_mode){
						case 'STRAIGHT_LINE':

							overlay_MINI_new_bg_height = Number(langPack_MINI_maxheight_FullAll) + Number(hmm_buffer);

							break;
						default:

							//
							// DYNAMIC HEIGHT MGMT
							overlay_MINI_new_bg_height = Number(hmm_buffer) + Number($('#mini_scrl_total_height_' + curr_mini_lang_pack).html());

							// 75 - 200  (+125)
							// 700 - 575  (-125)
							break;

					}

					//return overlay_MINI_new_bg_height;

				break;
				case 'TIMER':
					//
					// TRANSITION MINI TO TIMER OVERLAY MODE AND RUN

					// #MODIFY BG COORD/DIMENSIONS (2000)

					// complete: #MODIFY COPY COORD/DIMENSIONS (0)
					// complete: #SET ANY RUN FLAG(S) TRUE?

					// #BEGIN RUN OF COPY (WILL RUN WHEN FLAGS SET)

					overlay_MINI_new_bg_height = Number($('#timer_copy').height()) + Number(hmm_buffer);
					log_activity('************ MAKE TIMER HEIGHT DYNAMIC...['+mini_overlay_original_height+']');
					//return overlay_MINI_new_bg_height;

				break;


			}

			return overlay_MINI_new_bg_height;

		break;
		case 'full':
			return 4000;
		break;

	}

}

function retrieve_overlay_content_pxfrmtop(oProfile){
	// 75 - 200  (+125)
	// 700 - 575  (-125)

	var overlay_bg_height = retrieve_overlay_bg_height(oProfile);
	// copy_pxfrmtop =  -1 * (newHeight - originalHeight(h=50))

	tmp_pxfrmtop = -1 * (overlay_bg_height - mini_overlay_original_height - 13);

	return tmp_pxfrmtop;
}

function retrieve_overlay_bg_pxfrmtop(oProfile){

	// FOR LOGGING
	var lang_id = current_lang_pack(oProfile);

	switch(oProfile.height_mgmt_mode){
		case 'STRAIGHT_LINE':

			switch(oProfile.overlay_mode){
				case 'FULL':
					overlay_MINI_curr_bg_height = $('#mini_overlay_bg').height();
				break;
				case 'SCROLL':
					overlay_MINI_curr_bg_height = $('#mini_overlay_bg').height();
				break;
				case 'TIMER':
					overlay_MINI_curr_bg_height = $('#mini_overlay_bg').height();
				break;

			}

		break;
		default:
			//
			// DYNAMIC HMM
			switch(oProfile.overlay_mode){
				case 'FULL':
					//var lang_id = current_lang_pack(oProfile);
					overlay_MINI_curr_bg_height = $('#mini_overlay_bg').height();
					//overlay_MINI_curr_bg_height = retrieve_overlay_bg_height(oProfile);

				break;
				case 'SCROLL':
					//var curr_mini_lang_pack = current_lang_pack(oProfile);
					//overlay_MINI_curr_bg_height = langPack_MINI_maxheight_ScrlAll + hmm_buffer;
					overlay_MINI_curr_bg_height = $('#mini_overlay_bg').height();

				break;
				case 'TIMER':
					overlay_MINI_curr_bg_height = $('#mini_overlay_bg').height();

				break;

			}

		break;

	}

	if(overlay_MINI_curr_bg_height==0){
		overlay_MINI_curr_bg_height = $('#mini_overlay_bg').height();

	}

	//if(overlay_MINI_curr_bg_pxtop==0){
		//var x =$("#mini_overlay_content").position();
		var x = $('#mini_overlay_bg').position();
		overlay_MINI_curr_bg_pxtop = x.top;
		log_activity('CALCULATED mini_overlay_bg PX TOP='+overlay_MINI_curr_bg_pxtop+' FOR '+ lang_id);

	//}

	newheight_DELTA = Number(overlay_MINI_new_bg_height) - Number(overlay_MINI_curr_bg_height);

	if(newheight_DELTA<0){

		newheight_DELTA = -(newheight_DELTA);
	}

	//overlay_MINI_curr_bg_height = overlay_MINI_new_bg_height;

	//if(Number(newheight_DELTA)>0 || overlay_MINI_new_bg_height<overlay_MINI_curr_bg_height){
	if(overlay_MINI_new_bg_height>overlay_MINI_curr_bg_height){
		overlay_MINI_new_bg_pxtop = Number(overlay_MINI_curr_bg_pxtop) - Number(newheight_DELTA);
		log_activity('**** 2328 overlay_MINI_curr_bg_pxtop['+overlay_MINI_curr_bg_pxtop+'] overlay_MINI_new_bg_pxtop['+overlay_MINI_new_bg_pxtop+']');
	}else{
		overlay_MINI_new_bg_pxtop = Number(overlay_MINI_curr_bg_pxtop) + Number(newheight_DELTA);
		log_activity('**** 2331 overlay_MINI_curr_bg_pxtop['+overlay_MINI_curr_bg_pxtop+'] overlay_MINI_new_bg_pxtop['+overlay_MINI_new_bg_pxtop+']');
	}

	log_activity('**** overlay_MINI_new_bg_height['+overlay_MINI_new_bg_height+'] overlay_MINI_curr_bg_height['+overlay_MINI_curr_bg_height+']');
	log_activity('**** newheight_DELTA['+newheight_DELTA+'] overlay_MINI_curr_bg_pxtop['+overlay_MINI_curr_bg_pxtop+'] overlay_MINI_new_bg_pxtop TOP='+overlay_MINI_new_bg_pxtop);

	overlay_MINI_curr_bg_pxtop = overlay_MINI_new_bg_pxtop;
	overlay_MINI_curr_bg_height = overlay_MINI_new_bg_height;

	return overlay_MINI_new_bg_pxtop;
}

function transitionToNewMode(oProfile, o_mode_override=''){
	log_activity(" **** READY TO transitionToNewMode "+oProfile.type+" OVERLAY FROM "+oProfile.curr_overlay_mode+" MODE TO "+oProfile.overlay_mode+" OR OVERRIDE ["+o_mode_override+"] MODE.");

	//
	// APPLY UI TRANSFORMS FOR OVERLAY AND CONTENT
	var type = oProfile.type;

	switch(type){
		case 'mini':
			var overlay_mode = oProfile.overlay_mode;
			var curr_mini_lang_pack = current_lang_pack(oProfile);

			if(o_mode_override!=''){
				overlay_mode = o_mode_override;
				//log_activity('***** UPDATING oProfile.overlay_mode TO ['+o_mode_override+'] VIA o_mode_override.');
				oProfile.overlay_mode = o_mode_override;

			}

			switch(overlay_mode){
				case 'FULL':

					//
					// TRANSITION MINI TO FULL OVERLAY MODE AND RUN
					// APPLY DYNAMIC OR STRAIGHT LINE HEIGHT CALCS
					tmp_height_mgmt_mode = oProfile.height_mgmt_mode;
					switch(tmp_height_mgmt_mode){
						case 'STRAIGHT_LINE':

							var overlay_bg_height = langPack_MINI_maxheight_FullAll;
							var overlay_bg_pxfrmtop = retrieve_overlay_bg_pxfrmtop(oProfile);
							var overlay_content_pxfrmtop = retrieve_overlay_content_pxfrmtop(oProfile);

						break;
						default:

							//
							// DYNAMIC HEIGHT MGMT
							var overlay_bg_height = retrieve_overlay_bg_height(oProfile);
							var overlay_bg_pxfrmtop = retrieve_overlay_bg_pxfrmtop(oProfile);
							var overlay_content_pxfrmtop = retrieve_overlay_content_pxfrmtop(oProfile);

						break;

					}

					tmp_curr_lang_id = current_lang_pack(oProfile);

					log_activity('BUILDING BG COORD/POSITION FOR FULL MODE tmp_curr_lang_id['+tmp_curr_lang_id+'] overlay_bg_height['+overlay_bg_height+'] overlay_bg_pxfrmtop['+overlay_bg_pxfrmtop+']');

					//
					// UPDATE LEFT GATE IMAGE
					tmp_lang_index = langPack_Mini_IDtoIndex_ARRAY[tmp_curr_lang_id];
					tmp_lang_gate_FILENAME = langPack_Mini_fullgate_ARRAY[tmp_lang_index];
					tmp_gate_http_uri = returnImageUri(tmp_lang_gate_FILENAME, 'gate');
					document.getElementById('full_gate_left').style.backgroundImage = "url('"+tmp_gate_http_uri+"')";

					tmp_gate_top = overlay_bg_pxfrmtop + 5;

					$( "#full_gate_left").animate({
						top: tmp_gate_top,
						opacity: 0
					}, {
						duration: 0,
						queue: false,
						step: function( now, fx ) {

						},
						complete: function () {
							log_activity('2718 **** FULL TRANSITION tmp_curr_lang_id='+tmp_curr_lang_id+'|overlay_bg_pxfrmtop='+overlay_bg_pxfrmtop);

							$( "#langpack_mini_full_shell_"+ tmp_curr_lang_id).animate({
								top: overlay_content_pxfrmtop
							}, {
								duration: 0,
								queue: false,
								step: function( now, fx ) {

								},
								complete: function () {

									$( "#mini_overlay_bg" ).animate({
										top: overlay_bg_pxfrmtop,
										width: oProfile.mdfull_bgwidth,
										height: overlay_bg_height
									}, {
										duration: 2000,
										queue: false,
										specialEasing: {
											top: "swing",
											height: "swing",
											width: "swing"
										},
										step: function( now, fx ) {

										},
										complete: function () {

											$( "#langpack_mini_full_shell_"+ tmp_curr_lang_id).animate({
												opacity: 1.0
											}, {
												duration: 2000,
												queue: false,
												step: function( now, fx ) {

												},
												complete: function () {

													//
													// AUTH FLAGS MOVED HERE TO PREVENT PREMATURE RUN OF LANG GATE OPENING
													langPack_Mini_langPack_rotation_LCK = 0;
													mini_scrl_ai_lang_pack_rotation_cnt = 0;

													authFlag_langPack_MiniFull_rotate = 1;
													mini_full_ai_lang_pack_rotation_cnt = 0;

													langPack_rotation_interval_MINI_cnt = 0;
													langPack_rotation_interval_MINI_FULL_cnt = 0;

												}
											});

										}
									});


								}
							});

						}
					});

					ai_sleep_rotate_FLAG = 0;

					$('#om').html('FULL');

				break;
				case 'SCROLL':

					//
					// TRANSITION MINI TO SCROLL OVERLAY MODE AND RUN
					//var langPack_MINI_maxheight_ScrlAll = 0;

					// #MODIFY BG COORD/DIMENSIONS (2000)

					// complete: #MODIFY COPY COORD/DIMENSIONS (0)
					// complete: #SET ANY RUN FLAG(S) TRUE?

					// #BEGIN RUN OF COPY (WILL RUN WHEN FLAGS SET)

					log_activity("*** Animate "+oProfile.type+" overlay to width of "+oProfile.mdscrl_bgwidth+".");
					$( "#mini_overlay_bg" ).animate({
						width: oProfile.mdscrl_bgwidth,
						height: oProfile.mdscrl_bgheight,
						opacity: oProfile.mdscrl_bgopacity,
						backgroundColor: oProfile.mdscrl_bgcolor,
						borderColor: oProfile.mdscrl_bgbrdrcolor,
						top: oProfile.mdscrl_pxfromtop,
						left: oProfile.mdscrl_pxfromleft,
						borderLeftWidth: oProfile.mdscrl_brdrleftwidth,
						borderRightWidth: oProfile.mdscrl_brdrrightwidth,
						borderTopWidth: oProfile.mdscrl_brdrtopwidth,
						borderBottomWidth: oProfile.mdscrl_brdrbttmwidth
					}, {
						duration: 1500,
						queue: false,
						specialEasing: {
							width: "swing",
							height: "linear"
						},
						step: function( now, fx ) {
							//var data = fx.elem.id + " " + fx.prop + ": " + now;
							//log_activity("*** Animation in action :: " + data);
						},
						complete: function () {
							log_activity("*** Animation COMPLETE :: mini_overlay_bg");

							if($('#scroll_view_window_append_handle').length){

								//
								// SIMPLY RUN NEXT LANG PACK
								initTransitions(oProfile);

							}else{

								activateContent_MINI(oProfile);

							}
						}
					});

					$( "#timer_copy" ).animate({
						paddingLeft: oProfile.mdscrl_copy_time_padleft,
						paddingRight: oProfile.mdscrl_copy_time_padright,
						color: oProfile.mdscrl_copy_time_color,
						fontSize: oProfile.mdscrl_copy_time_size_px
					}, {
						duration: 1500,
						queue: false,
						specialEasing: {
							paddingLeft: "swing",
							paddingRight: "swing"
						},
						step: function( now, fx ) {
							//var data = fx.elem.id + " " + fx.prop + ": " + now;
							//log_activity("*** Animation in action :: " + data);
						},
						complete: function () {
							log_activity("*** Animation COMPLETE :: timer_copy");
						}
					});

					$('#om').html('SCROLL');

				break;
				case 'TIMER':

					//
					// CLEAR / RESET PREVIOUS EXPERIENCE
					tmp_previous_overlay_mode = $('#om').html();
					switch(tmp_previous_overlay_mode){
						case 'FULL':
							log_activity('2549 ***** NOW WIRING UP ENTER SLEEP/TIMER MODE FROM FULL MODE...CLEAR/RESET ALL OLD/SET NEW');

							//
							// CLEAR FULL MODE CLUTTER
							// TURN ALL ALPHA TO 0.0
							clearout_MiniFullMode(oProfile);

							// JUST TO BE SURE...
							langPack_Mini_langPack_rotation_LCK = 1;
							authFlag_langPack_MiniFull_rotate = 0;

							$('#ui_retardation_handle').animate({
								color: '#FFFFFF'
							}, {
								duration: 6000,
								queue: false,
								specialEasing: {
									color: "linear"
								},
								step: function( now, fx ) {

								},
								complete: function () {

									//
									// TRANSITION MINI TO TIMER OVERLAY MODE
									$( "#mini_overlay_bg" ).animate({
										width: oProfile.mdtmr_bgwidth,
										height: oProfile.mdtmr_bgheight,
										opacity: oProfile.mdtmr_bgopacity,
										backgroundColor: oProfile.mdtmr_bgcolor,
										borderColor: oProfile.mdtmr_bgbrdrcolor,
										top: oProfile.mdtmr_pxfromtop,
										left: oProfile.mdtmr_pxfromleft,
										borderLeftWidth: oProfile.mdtmr_brdrleftwidth,
										borderRightWidth: oProfile.mdtmr_brdrrightwidth,
										borderTopWidth: oProfile.mdtmr_brdrtopwidth,
										borderBottomWidth: oProfile.mdtmr_brdrbttmwidth
									}, {
										duration: 2000,
										queue: false,
										specialEasing: {
											width: "swing",
											height: "swing"
										},
										step: function( now, fx ) {
											//var data = fx.elem.id + " " + fx.prop + ": " + now;
											//log_activity("*** Animation in action :: " + data);
										},
										complete: function () {
											//log_activity("*** Animation COMPLETE :: mini_overlay_bg");
											//activateContent_MINI(oProfile);

										}
									});

									$( "#timer_copy" ).animate({
										paddingLeft: oProfile.mdtmr_copy_time_padleft,
										paddingRight: oProfile.mdtmr_copy_time_padright,
										color: oProfile.mdtmr_copy_time_color,
										fontSize: oProfile.mdtmr_copy_time_size_px
									}, {
										duration: 1000,
										queue: false,
										specialEasing: {
											paddingLeft: "swing",
											paddingRight: "swing"
										},
										step: function( now, fx ) {
											//var data = fx.elem.id + " " + fx.prop + ": " + now;
											//log_activity("*** Animation in action :: " + data);
										},
										complete: function () {
											//log_activity("*** Animation COMPLETE :: timer_copy");
										}
									});


								}
							});

						break;
						case 'SCROLL':
							log_activity('2913 ***** WIRE UP ENTER SLEEP MODE FROM SCROLL MODE...CLEAR/RESET ALL OLD/SET NEW');

							//
							// CLEAR SCROLL MODE CLUTTER
							clearout_MiniScrlMode(oProfile);

							$('#ui_retardation_handle').animate({
								color: '#FFFFFF'
							}, {
								duration: 3000,
								queue: false,
								specialEasing: {
									color: "linear"
								},
								step: function( now, fx ) {

								},
								complete: function () {

									//
									// TRANSITION MINI TO TIMER OVERLAY MODE
									$( "#mini_overlay_bg" ).animate({
										width: oProfile.mdtmr_bgwidth,
										height: oProfile.mdtmr_bgheight,
										opacity: oProfile.mdtmr_bgopacity,
										backgroundColor: oProfile.mdtmr_bgcolor,
										borderColor: oProfile.mdtmr_bgbrdrcolor,
										top: oProfile.mdtmr_pxfromtop,
										left: oProfile.mdtmr_pxfromleft,
										borderLeftWidth: oProfile.mdtmr_brdrleftwidth,
										borderRightWidth: oProfile.mdtmr_brdrrightwidth,
										borderTopWidth: oProfile.mdtmr_brdrtopwidth,
										borderBottomWidth: oProfile.mdtmr_brdrbttmwidth
									}, {
										duration: 2000,
										queue: false,
										specialEasing: {
											width: "swing",
											height: "swing"
										},
										step: function( now, fx ) {
											//var data = fx.elem.id + " " + fx.prop + ": " + now;
											//log_activity("*** Animation in action :: " + data);
										},
										complete: function () {
											//log_activity("*** Animation COMPLETE :: mini_overlay_bg");
											//activateContent_MINI(oProfile);

										}
									});


								}
							});


						break;

					}


					$('#om').html('TIMER');

				break;


			}

		break;
		case 'full':

			tmp_curr_lang_id = current_lang_pack(oProfile);

			$( "#fullscrn_overlay_bg_wrapper").animate({
				width: oProfile.master_overlay_display_area_width_in_px,
				height: oProfile.master_overlay_display_area_height_in_px,
				opacity: oProfile.master_overlay_bgopacity,
				backgroundColor: oProfile.master_overlay_bgcolor
			}, {
				duration: 2000,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				step: function( now, fx ) {

				},
				complete: function () {

					log_activity('***** FULL SCREEN OVERLAY SHOW COPY FOR LANG PACK -> ' + tmp_curr_lang_id);

					//width: oProfile.copy_display_area_width_in_px,
					//height: oProfile.copy_display_area_height_in_px,

					$( "#fullscrn_content_" + tmp_curr_lang_id).animate({
						opacity: 1.0
					}, {
						duration: 1000,
						queue: false,
						specialEasing: {
							opacity: "swing"
						},
						step: function( now, fx ) {

						},
						complete: function () {

						}
					});

				}
			});

		break;

	}

}

function clearout_MiniFullMode(oProfile){

	//
	// HIDE ALL AND RESET SUB CONTENT TO LEFT:0PX
	tmp_loop_size = oProfile.lang_pack_translations.type.length;

	//
	/* BG UP...
		complete: SLIDE OUT SECTA
		complete:
			CLOSE LANG GATE,
			FADE OUT SECTB
				complete: SET X-POS TO -1000 FOR SECTA OF NEW LANG PACK (0) [MIGHT ALREADY BE THERE...NP]

	*/
	$( "#mini_overlay_bg" ).animate({
		opacity: 1.0
	}, {
		duration: 500,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		step: function( now, fx ) {

		},
		complete: function () {

			//
			// CURRENT LANG_ID
			tmp_curr_lang_id = current_lang_pack(oProfile);
			tmp_freshNxtLangPack = returnNextLangPack(oProfile, tmp_curr_lang_id);

			//
			// RAISE LANG GATE
			$( "#full_gate_left" ).animate({
				opacity: 1.0
			}, {
				duration: 2000,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				step: function( now, fx ) {

				},
				complete: function () {

					/*
					minimax_primary_copy_sectA_

					minimax_primary_copy_sectA_handle_
					* */

					// RESEST NEXT LANG ID - MINI FULL MODE
					$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).animate({
						left: '-1000px'
					}, {
						duration: 0,
						queue: false,
						specialEasing: {
							left: "linear"
						},
						step: function( now, fx ) {

						},
						complete: function () {


						}
					});

					$('#minimax_primary_copy_sectB_' + tmp_freshNxtLangPack).animate({
						opacity: 1.0
					}, {
						duration: 0,
						queue: false,
						specialEasing: {
							opacity: "swing"
						},
						step: function( now, fx ) {

						},
						complete: function () {


						}
					});

					//
					// REMOVE EXPIRED SUB COPY
					$('#minimax_primary_copy_sectA_' + tmp_curr_lang_id).effect( "bounce", {direction:'right', distance: bounce_OUT_distance_px, times: bounce_OUT_num_times }, bounce_OUT_speed );

					$('#minimax_primary_copy_sectA_' + tmp_curr_lang_id).animate({
						left: '-1000px'
					}, {
						duration: 1000,
						queue: true,
						specialEasing: {
							left: "swing"
						},
						step: function( now, fx ) {

						},
						complete: function () {

							//
							// HIDE current SECTB COPY
							$('#minimax_primary_copy_sectB_' + tmp_curr_lang_id).animate({
								opacity: 0.0
							}, {
								duration: 1000,
								queue: false,
								specialEasing: {
									opacity: "swing"
								},
								step: function( now, fx ) {

								},
								complete: function () {



								}
							});

							//
							// CLOSE LANG GATE
							$( "#full_gate_left" ).animate({
								opacity: 0
							}, {
								duration: 1000,
								queue: false,
								specialEasing: {
									opacity: "swing"
								},
								step: function( now, fx ) {

								},
								complete: function () {

									//
									// FADE OUT PREV SHELL
									$( "#langpack_mini_full_shell_"+ tmp_curr_lang_id).animate({
										opacity: 0.0
									}, {
										duration: 800,
										queue: false,
										step: function( now, fx ) {
											//var data = fx.elem.id + " " + fx.prop + ": " + now;
											//log_activity("*** Animation in action :: " + data);
										},
										complete: function () {

											//
											// RESET OPACITY OF SECTB COPY
											$('#minimax_primary_copy_sectB_' + tmp_curr_lang_id).animate({
												opacity: 1.0
											}, {
												duration: 0,
												queue: false,
												specialEasing: {
													opacity: "swing"
												},
												step: function( now, fx ) {

												},
												complete: function () {



												}
											});


										}
									});

								}
							});


						}
					});
				}
			});


		}
	});


	//
	// SHOW TIMER_COPY
	$( "#timer_copy" ).animate({
		opacity: 1.0
	}, {
		duration: 1000,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		step: function( now, fx ) {

		},
		complete: function () {


		}
	});

}

function clearout_MiniScrlMode(oProfile){

	//lang_id = $('#curr_mini_lang_pack').html();
	lang_id = current_lang_pack(oProfile);
	langPack_Mini_langPack_rotation_LCK = 1;

	//
	// CLOSE LANG GATES
	throwLangGates('close');


	$( '#langpack_mini_copy_' + lang_id ).animate({
		opacity: 0.0
	}, {
		duration: 2000,
		queue: false,
		step: function( now, fx ) {

		},
		complete: function () {


		}
	});

	/*
	//
	// HIDE ALL AND RESET SUB CONTENT TO LEFT:0PX
	tmp_loop_size = oProfile.lang_pack_translations.type.length;
	for(i=0;i<tmp_loop_size;i++){

		var lang_id = oProfile.lang_pack_translations.lang_id[i];

	}
	*/
}

function transferLangPackToDOM(oProfile){

	//
	// LANG PACK SECTION TMP GLOBALS
	tmp_lang_cnt = oProfile.lang_pack_translations.type.length;

	switch(oProfile.type){
		case 'mini':
			//
			// INTEGRATE LANG PACK DATA
			switch(oProfile.overlay_mode) {
				case 'SCROLL':
					log_activity('**** LANG PACK GOOD LOOK FOR SCROLL INTEGRATION ->'+oProfile.lang_pack_translations.type.length);
					for (i = 0; i < tmp_lang_cnt; i++) {

						var tmp_lang_id = oProfile.lang_pack_translations.lang_id[i];

						if ($('#scroll_view_window_append_handle').length) {

						} else {
							tmpHTML = '<div id="gate_wrapper">' +
								'            <div id="scroll_gate_left"></div>' +
								'            <div id="scroll_gate_right"></div>' +
								'        </div>' +
								'        <div id="scroll_view_window_append_handle" class="scroll_view_window_append_handle"></div>';

							$("#mini_overlay_content").append(tmpHTML);
						}

						var objFlagDiv = document.createElement('div');
						objFlagDiv.setAttribute('id', 'langpack_mini_copy_' + tmp_lang_id);
						objFlagDiv.setAttribute('class', 'scrolling_content_container');

						$('#scroll_view_window_append_handle').append(objFlagDiv);

						newHTML = returnMini_innerHTML(oProfile, i);
						objFlagDiv.innerHTML = newHTML;

						//
						// BEST LOCATION TO STRAIGHT-LINE DYNAMIC HEIGHT MGMT?
						// THIS IS SCROLL MODE

						//
						// APPLY CSS TO THIS NEW CONTENT - PREPPING FOR PROPER HEIGHT CALCULATIONS L8TR
						styleLangPack(oProfile, i);

						tmp_DOM_height_all = Number($('#langpack_mini_copy_' + tmp_lang_id).height());

						$('#mini_scrl_total_height_' + tmp_lang_id).html(tmp_DOM_height_all);

						if (langPack_MINI_maxheight_ScrlAll < tmp_DOM_height_all) {
							langPack_MINI_maxheight_ScrlAll = tmp_DOM_height_all;

						}

						log_activity("*** Lang Pack [" + i + "] " + tmp_lang_id + " [" + oProfile.lang_pack_translations.copy_m_title[i] + "] mode=" + oProfile.overlay_mode + " LOADED TO DOM AND STYLED! HEIGHT["+langPack_MINI_maxheight_ScrlAll+"]");

					}

					break;
				case 'FULL':

					log_activity('***** CALC FULL MODE OVERLAY CONTENT... LANGS->'+oProfile.lang_pack_translations.type.length);

					for (i = 0; i < tmp_lang_cnt; i++) {

						var lang_id = oProfile.lang_pack_translations.lang_id[i];

						if ($('#full_gate_left').length) {


						} else {

							var objFULLGDiv = document.createElement('div');
                            objFULLGDiv.setAttribute('id', 'full_gate_left');
                            objFULLGDiv.setAttribute('class', 'full_gate_left');

							$("#mini_overlay_handle").append(objFULLGDiv);

						}

						if ($('#langpack_mini_full_shell_' + lang_id).length) {


						} else {

							var objFULLDiv = document.createElement('div');
                            objFULLDiv.setAttribute('id', 'langpack_mini_full_shell_' + lang_id);
                            objFULLDiv.setAttribute('class', 'langpack_mini_full_shell');

							$("#mini_overlay_content").append(objFULLDiv);

						}

						newHTML = returnMini_innerHTML(oProfile, i);

						if (newHTML != 'silence' && newHTML != '') {

							//
							// EMPTY DIV AND RETURN FRESH CONTENT WITH CURRENT HASH
							$('#langpack_mini_full_shell_' + lang_id).empty();
							$('#langpack_mini_full_shell_' + lang_id).html(newHTML);

							//
							// APPLY CSS SETTINGS FROM XML TO DOM ELEMENTS BEFORE CALC HEIGHT IN DOM
							styleLangPack(oProfile,i);

							//
							// CALCULATE HEIGHT OF DOM ELEMENT. 2 MODES FOR ACCOMADATION.
							// DYNAMIC FIT (STORE HEIGHT IN DOM, THEN DYNAMIC DRIVE) AND STRAIGHT LINE (RUN HIGHEST VALUE).
							tmp_DOM_height_all = Number($('#langpack_mini_full_shell_' + lang_id).height());
							tmp_DOM_height_sectA = Number($('#minimax_primary_copy_sectA_' + lang_id).height());
							tmp_DOM_height_sectB = Number($('#minimax_primary_copy_sectB_' + lang_id).height());

							//
							// TEST ALT SUB CONTENT HEIGHT FOR MAX HEIGHT
							tmp_original_content = $('#minimax_primary_copy_sectA_' + lang_id).html();
							tmp_alt_contentA = $('#mini_rotate_elem_conf_' + lang_id).html();
							tmp_alt_contentB = $('#mini_rotate_elem_date_' + lang_id).html();

							$('#minimax_primary_copy_sectA_' + lang_id).html(tmp_alt_contentA + '<div class="cb_20"></div>' + tmp_alt_contentB);
							tmp_DOM_height_sectA_ALT = Number($('#minimax_primary_copy_sectA_' + lang_id).height());
							tmp_DOM_height_all_ALT = Number($('#langpack_mini_full_shell_' + lang_id).height());

							$('#minimax_primary_copy_sectA_' + lang_id).html(tmp_original_content);

							if(tmp_DOM_height_sectA_ALT>tmp_DOM_height_sectA){

								tmp_DOM_height_sectA = tmp_DOM_height_sectA_ALT;

							}

							if(tmp_DOM_height_all_ALT>tmp_DOM_height_all){

								tmp_DOM_height_all = tmp_DOM_height_all_ALT;

							}

							$('#minimax_primary_copy_sectA_' + lang_id).animate({
								height: tmp_DOM_height_sectA
							}, {
								duration: 0,
								queue: false,
								specialEasing: {
									height: "linear"
								},
								step: function( now, fx ) {

								},
								complete: function () {


								}
							});

							//
							// HEIGHT OF LEFT GATE FOR 252px content should be next available
							// after 252 + 30 or 282px min = avoverlay_ui_gate_285_left.png

							tmp_lang_gate = returnLangGate(tmp_DOM_height_sectA, 'FULL');
							langPack_Mini_fullgate_ARRAY.push(tmp_lang_gate);

							preload_Image(tmp_lang_gate, 'gate');

							log_activity('**** Pushed lang gate '+tmp_lang_gate+' for perfect fit of this content height -->'+tmp_DOM_height_sectA);

							$('#mini_sub_total_height_' + lang_id).html(tmp_DOM_height_all);
							$('#mini_sub_sectA_height_' + lang_id).html(tmp_DOM_height_sectA);
							$('#mini_sub_sectB_height_' + lang_id).html(tmp_DOM_height_sectB);


							if (langPack_MINI_maxheight_FullAll < tmp_DOM_height_all) {
								langPack_MINI_maxheight_FullAll = tmp_DOM_height_all;

							}

							if (langPack_MINI_maxheight_FullSectA < tmp_DOM_height_sectA) {
								langPack_MINI_maxheight_FullSectA = tmp_DOM_height_sectA;

							}

							if (langPack_MINI_maxheight_FullSectB < tmp_DOM_height_sectB) {
								langPack_MINI_maxheight_FullSectB = tmp_DOM_height_sectB;

							}

							log_activity("*** Lang Pack [" + i + "] " + lang_id + " [" + oProfile.lang_pack_translations.copy_m_title[i] + "] mode=" + oProfile.overlay_mode + " LOADED TO DOM AND STYLED! HEIGHT["+langPack_MINI_maxheight_FullAll+"]");

						} else {
							log_activity("**** Lang Pack SILENCED [" + i + "] " + lang_id + " [" + oProfile.lang_pack_translations.copy_m_title[i] + "] mode=" + oProfile.overlay_mode + " COMPLETE!");

						}


					}

					break;
				case 'TIMER':
					// NO COPY
					var objFlagDiv = document.createElement('div');
					objFlagDiv.setAttribute('id', 'timer_copy');
					objFlagDiv.setAttribute('class', 'timer_copy');

					$("#mini_overlay_content").empty();
					$("#mini_overlay_content").append(objFlagDiv);

					break;
			}
		break;
		case 'full':
			log_activity('***** PREPARE FULL SCREEN OVERLAY LANG PACK CONTENT...LANGS->'+oProfile.lang_pack_translations.type.length);

			$("#fullscrn_content_shell").empty();

			for (q = 0; q < tmp_lang_cnt; q++) {

				var lang_id_fs = oProfile.lang_pack_translations.lang_id[q];
				//$('#fullscrn_page_code').append('<br/>' + lang_id);

				//
				// BUILD OUT DYNAMIC LANG PACK CONTAINERS
				/*
<div id="fullscrn_content" class="fullscrn_content">
                <div class="cb_20"></div>
                <div id="fullscrn_page_header" class="fullscrn_page_header">
                    <h3>[tmp_full_page_header]</h3>
                </div>
                <div class="cb_30"></div>
                <div id="fullscrn_document_title"  class="fullscrn_document_title"><h1>[tmp_full_page_title]</h1></div>
                <div class="cb_30"></div>

                <div id="fullscrn_page_code" class="fullscrn_page_code">
                    <div style="height:500px; background-color: #0000cc; color: #FFF;">[tmp_full_page_code]</div>
                    <div style="height:500px; background-color:#8E141A; color: #FFF;">[tmp_full_page_code]</div>
                </div>
            </div>

				* */

				tmp_lang_html = '<div id="fullscrn_content_' + lang_id_fs + '" class="fullscrn_content">' +
                '<div class="cb_20"></div>' +
					'<div id="fullscrn_page_header_' + lang_id_fs + '" class="fullscrn_page_header">' +
					'<h3>' + oProfile.lang_pack_translations.copy_fullscrn_header[q] + '</h3>' +
					'</div>' +
					'<div class="cb_30"></div>' +
					'<div id="fullscrn_document_title_' + lang_id_fs + '"  class="fullscrn_document_title"><h1>' + oProfile.lang_pack_translations.copy_fullscrn_title[q] + '</h1></div>' +
					'<div class="cb_5"></div>' +

					'<div id="fullscrn_page_code_' + lang_id_fs + '" class="fullscrn_page_code">' +
					 oProfile.lang_pack_translations.copy00_fullscrn_body[q] +
					'</div>' +
					'</div>';

				var objFSDiv = document.createElement('div');
				objFSDiv.setAttribute('id', 'fullscrn_content_' + lang_id_fs);
				objFSDiv.setAttribute('class', 'fullscrn_content');

				$("#fullscrn_content_shell").append(objFSDiv);

				objFSDiv.innerHTML = tmp_lang_html;

				$('#fullscrn_content_' + lang_id_fs).animate({
					fontSize: oProfile.lang_pack_translations.copy_fullscrn_font_size_percentage[q]+'%',
					opacity: 0.0
				}, {
					duration: 0,
					queue: false,
					specialEasing: {
						opacity: "swing"
					},
					step: function( now, fx ) {

					},
					complete: function () {


					}
				});

			}

		break;
	}

}

function preload_Image(img_filename, img_type){

	var site_root = $('#ajax_root').html();

	switch(img_type){
		case 'gate':
			tmp_dir_path = 'common/imgs/';

		break;

	}

	image_http_uri = site_root + tmp_dir_path + img_filename;

	if($('#img_filename').length){


	}else{

		log_activity('**** Preload image ->'+image_http_uri);

		var objImg = document.createElement('img');
		objImg.setAttribute('id',  img_filename);
		objImg.setAttribute('src',  image_http_uri);

		$("#overlay_dyn_flags_container").append(objImg);

	}
}

function returnLangGate(content_height, mode){

	switch(mode){
		case 'FULL':

			increment = 15;
			content_buffer = 30;
			tmp_content_height = Number(content_height) + content_buffer;

			//**** CONTENT HEIGHT[308] tmp_content_height[338]
			log_activity('**** CONTENT HEIGHT['+content_height+'] tmp_content_height['+tmp_content_height+']');

			for(iii=3;iii<40;iii++){
				tmp_gate_height = iii * increment;

				if(tmp_gate_height>tmp_content_height){

					iii=420;

					if(tmp_gate_height>555){
						log_activity('**** RETURN 555 CONTENT tmp_gate_height['+tmp_gate_height+'] tmp_content_height['+tmp_content_height+']');
						return 'avoverlay_ui_gate_555_left.png';
					}else{

						log_activity('**** RETURN CONTENT tmp_gate_height['+tmp_gate_height+'] tmp_content_height['+tmp_content_height+']');
						return 'avoverlay_ui_gate_'+tmp_gate_height+'_left.png';

					}

				}

			}

			if(tmp_gate_height>555){
				log_activity('**** RETURN 555 CONTENT tmp_gate_height['+tmp_gate_height+'] tmp_content_height['+tmp_content_height+']');
				return 'avoverlay_ui_gate_555_left.png';
			}

		break;
		case 'SCROLL':

		break;

	}

}

function oLangPack(langPackArray, type) {

	var tmp_lang_loop_size = langPackArray.length;

	//
	// MINI PARAMS
	var type_ARRAY = new Array();
	var lang_id_ARRAY = new Array();
	var copy_m_title_ARRAY = new Array();
	var copy_m_message_ARRAY = new Array();
	var copy_m_conference_ARRAY = new Array();
	var copy_m_date_ARRAY = new Array();
	var copy_m_scroll_speed_ARRAY = new Array();
	var copy_m_scroll_direction_ARRAY = new Array();
	var copy_m_font_size_percentage_ARRAY = new Array();
	var copy_m_font_color_hex_ARRAY = new Array;
	var content_shell_padding_top_ARRAY = new Array;
	var copy_m_padding_top_px_ARRAY = new Array()
	var timer_m_font_size_percentage_ARRAY = new Array();
	var cleartext_endpoint_ARRAY = new Array();
	var copy_hash_ARRAY = new Array();

	//
	// FULL SCREEN PARAMS
	var copy_fullscrn_header_ARRAY = new Array();
	var copy_fullscrn_title_ARRAY = new Array();
	var copy00_fullscrn_body_ARRAY = new Array();
	var copy_fullscrn_font_size_percentage_ARRAY = new Array();
	var copy_fullscrn_font_color_hex_ARRAY = new Array();

	//
	// BUILD OUT LANG PACK ELEMENT ARRAYS
	for (var i = 0; i < tmp_lang_loop_size; i++) {

		switch (type) {
			case 'mini':
				var lang_pack = langPackArray[i];

				var lang_id = lang_pack['lang_id'];
				var copy_m_title = lang_pack['copy_m_title'];
				var copy_m_message = lang_pack['copy_m_message'];
				var copy_m_conference = lang_pack['copy_m_conference'];
				var copy_m_date = lang_pack['copy_m_date'];
				var copy_m_scroll_speed = lang_pack['copy_m_scroll_speed'];
				var copy_m_scroll_direction = lang_pack['copy_m_scroll_direction'];
				var copy_m_font_size_percentage = lang_pack['copy_m_font_size_percentage'];
				var copy_m_font_color_hex = lang_pack['copy_m_font_color_hex'];
				var content_shell_padding_top = lang_pack['content_shell_padding_top'];
				var copy_m_padding_top_px = lang_pack['copy_m_padding_top_px'];
				var timer_m_font_size_percentage = lang_pack['timer_m_font_size_percentage'];
				var cleartext_endpoint = lang_pack['cleartext_endpoint'];
				var copy_hash = lang_pack['copy_hash'];

				//log_activity('*** Lang Pack Test copy_m_title['+i+']-> '+copy_m_title);

				type_ARRAY[i] = type;
				lang_id_ARRAY[i] = lang_id;
				copy_m_title_ARRAY[i] = copy_m_title;
				copy_m_message_ARRAY[i] = copy_m_message;
				copy_m_conference_ARRAY[i] = copy_m_conference;
				copy_m_date_ARRAY[i] = copy_m_date;
				copy_m_scroll_speed_ARRAY[i] = copy_m_scroll_speed;
				copy_m_scroll_direction_ARRAY[i] = copy_m_scroll_direction;
				copy_m_font_size_percentage_ARRAY[i] = copy_m_font_size_percentage;
				copy_m_font_color_hex_ARRAY[i] = copy_m_font_color_hex;
				content_shell_padding_top_ARRAY[i] = content_shell_padding_top;
				copy_m_padding_top_px_ARRAY[i] = copy_m_padding_top_px;
				timer_m_font_size_percentage_ARRAY[i] = timer_m_font_size_percentage;
				cleartext_endpoint_ARRAY[i] = cleartext_endpoint;
				copy_hash_ARRAY[i] = copy_hash;

				break;
			case 'full':
				var lang_pack = langPackArray[i];

				var lang_id = lang_pack['lang_id'];
				var copy_fullscrn_header = lang_pack['copy_fullscrn_header'];
				var copy_fullscrn_title = lang_pack['copy_fullscrn_title'];
				var copy00_fullscrn_body = lang_pack['copy00_fullscrn_body'];
				var copy_fullscrn_font_size_percentage = lang_pack['copy_fullscrn_font_size_percentage'];
				var copy_fullscrn_font_color_hex = lang_pack['copy_fullscrn_font_color_hex'];

				var cleartext_endpoint = lang_pack['cleartext_endpoint'];
				var copy_hash = lang_pack['copy_hash'];

				type_ARRAY[i] = type;
				lang_id_ARRAY[i] = lang_id;
				copy_fullscrn_header_ARRAY[i] = copy_fullscrn_header;
				copy_fullscrn_title_ARRAY[i] = copy_fullscrn_title;
				copy00_fullscrn_body_ARRAY[i] = copy00_fullscrn_body;
				copy_fullscrn_font_size_percentage_ARRAY[i] = copy_fullscrn_font_size_percentage;
				copy_fullscrn_font_color_hex_ARRAY[i] = copy_fullscrn_font_color_hex;
				cleartext_endpoint_ARRAY[i] = cleartext_endpoint;
				copy_hash_ARRAY[i] = copy_hash;

				break;

		}

	}

	//
	// SAVE LANG PACK ELEMENT ARRAYS TO OBJECT
	switch (type) {
		case 'mini':

			this.type = type_ARRAY;
			this.lang_id = lang_id_ARRAY;
			this.copy_m_title = copy_m_title_ARRAY;
			this.copy_m_message = copy_m_message_ARRAY;
			this.copy_m_conference = copy_m_conference_ARRAY;
			this.copy_m_date = copy_m_date_ARRAY;
			this.copy_m_scroll_speed = copy_m_scroll_speed_ARRAY;
			this.copy_m_scroll_direction = copy_m_scroll_direction_ARRAY;
			this.copy_m_font_size_percentage = copy_m_font_size_percentage_ARRAY;
			this.copy_m_font_color_hex = copy_m_font_color_hex_ARRAY;
			this.content_shell_padding_top  = content_shell_padding_top_ARRAY;
			this.copy_m_padding_top_px = copy_m_padding_top_px_ARRAY;
			this.timer_m_font_size_percentage = timer_m_font_size_percentage_ARRAY;
			this.cleartext_endpoint = cleartext_endpoint_ARRAY;
			this.copy_hash = copy_hash_ARRAY;
			log_activity("Lang packs completed for "+type+" overlay object. [pack size="+lang_id_ARRAY.length+"].");

		break;
		case 'full':

			this.type = type_ARRAY;
			this.lang_id = lang_id_ARRAY;
			this.copy_fullscrn_header = copy_fullscrn_header_ARRAY;
			this.copy_fullscrn_title = copy_fullscrn_title_ARRAY;
			this.copy00_fullscrn_body = copy00_fullscrn_body_ARRAY;
			this.copy_fullscrn_font_size_percentage = copy_fullscrn_font_size_percentage_ARRAY;
			this.copy_fullscrn_font_color_hex = copy_fullscrn_font_color_hex_ARRAY;
			this.cleartext_endpoint = cleartext_endpoint_ARRAY;
			this.copy_hash = copy_hash_ARRAY;
			log_activity("Lang packs completed for "+type+" overlay object. [pack size="+lang_id_ARRAY.length+"].");

			break;
	}
}

function styleLangPack(oProfile,i){

	var type = oProfile.type;
	var lang_id = oProfile.lang_pack_translations.lang_id[i];

	switch(type){
        case 'mini':

			var overlay_mode = oProfile.overlay_mode;
			var height_mgmt_mode = oProfile.height_mgmt_mode;
			var mdtmr_bgwidth = oProfile.mdtmr_bgwidth;
			var mdscrl_bgwidth = oProfile.mdscrl_bgwidth;
			var mdfull_bgwidth = oProfile.mdfull_bgwidth;

			var copy_m_title = oProfile.lang_pack_translations.copy_m_title[i];
			var copy_m_message = oProfile.lang_pack_translations.copy_m_message[i];
			var copy_m_conference = oProfile.lang_pack_translations.copy_m_conference[i];
			var copy_m_date = oProfile.lang_pack_translations.copy_m_date[i];
			var copy_m_scroll_speed = oProfile.lang_pack_translations.copy_m_scroll_speed[i];
			var copy_m_scroll_direction = oProfile.lang_pack_translations.copy_m_scroll_direction[i];
			var copy_m_font_size_percentage = oProfile.lang_pack_translations.copy_m_font_size_percentage[i];
			var copy_m_font_color_hex = oProfile.lang_pack_translations.copy_m_font_color_hex[i];
			var content_shell_padding_top = oProfile.lang_pack_translations.content_shell_padding_top[i];
			var copy_m_padding_top_px = oProfile.lang_pack_translations.copy_m_padding_top_px[i];
			var timer_m_font_size_percentage = oProfile.lang_pack_translations.timer_m_font_size_percentage[i];
			var cleartext_endpoint = oProfile.lang_pack_translations.cleartext_endpoint[i];
			var copy_hash = oProfile.lang_pack_translations.copy_hash[i];



			/*
			 <mdtmr_bgwidth>175</mdtmr_bgwidth>
            <mdtmr_bgheight>75</mdtmr_bgheight>
            <mdtmr_bgopacity>0.7</mdtmr_bgopacity>
            <mdtmr_bgcolor>#FFFFFF</mdtmr_bgcolor>
            <mdtmr_bgbrdrcolor>#9499A6</mdtmr_bgbrdrcolor>
            <mdtmr_pxfromtop>550</mdtmr_pxfromtop>
            <mdtmr_pxfromleft>0</mdtmr_pxfromleft>
            <mdtmr_brdrleftwidth>0</mdtmr_brdrleftwidth>
            <mdtmr_brdrtopwidth>3</mdtmr_brdrtopwidth>
            <mdtmr_brdrrightwidth>3</mdtmr_brdrrightwidth>
            <mdtmr_brdrbttmwidth>3</mdtmr_brdrbttmwidth>
            <mdtmr_copy_time_padleft>20</mdtmr_copy_time_padleft>
            <mdtmr_copy_time_padright>0</mdtmr_copy_time_padright>

            <mdscrl_bgwidth>575</mdscrl_bgwidth>
            <mdscrl_bgheight>75</mdscrl_bgheight>
            <mdscrl_bgopacity>1.0</mdscrl_bgopacity>
            <mdscrl_bgcolor>#FFFFFF</mdscrl_bgcolor>
            <mdscrl_bgbrdrcolor>#9499A6</mdscrl_bgbrdrcolor>
            <mdscrl_pxfromtop>550</mdscrl_pxfromtop>
            <mdscrl_pxfromleft>0</mdscrl_pxfromleft>
            <mdscrl_brdrleftwidth>0</mdscrl_brdrleftwidth>
            <mdscrl_brdrtopwidth>3</mdscrl_brdrtopwidth>
            <mdscrl_brdrrightwidth>3</mdscrl_brdrrightwidth>
            <mdscrl_brdrbttmwidth>3</mdscrl_brdrbttmwidth>
            <mdscrl_copy_time_padleft>20</mdscrl_copy_time_padleft>
            <mdscrl_copy_time_padright>0</mdscrl_copy_time_padright>

            <mdfull_bgwidth>275</mdfull_bgwidth>
            <mdfull_bgheight>200</mdfull_bgheight>
            <mdfull_bgopacity>0.7</mdfull_bgopacity>
            <mdfull_bgcolor>#FFFFFF</mdfull_bgcolor>
            <mdfull_bgbrdrcolor>#9499A6</mdfull_bgbrdrcolor>
            <mdfull_pxfromtop>425</mdfull_pxfromtop>
            <mdfull_pxfromleft>0</mdfull_pxfromleft>
            <mdfull_brdrleftwidth>0</mdfull_brdrleftwidth>
            <mdfull_brdrtopwidth>3</mdfull_brdrtopwidth>
            <mdfull_brdrrightwidth>3</mdfull_brdrrightwidth>
            <mdfull_brdrbttmwidth>3</mdfull_brdrbttmwidth>
            <mdfull_copy_time_padleft>20</mdfull_copy_time_padleft>
            <mdfull_copy_time_padright>0</mdfull_copy_time_padright>

            <mdfull_lang_rotate_interval>42</mdfull_lang_rotate_interval>
            <mdfull_sub_copy_rotate_interval>12</mdfull_sub_copy_rotate_interval>
            <mdscrl_scroll_speed>5</mdscrl_scroll_speed>
            <mdscrl_lang_rotate_interval>42</mdscrl_lang_rotate_interval>
            <mdfull_copy_sect_a_color>#262626</mdfull_copy_sect_a_color>
            <mdfull_copy_sect_b_color>#1A182D</mdfull_copy_sect_b_color>
            <mdfull_hr_color>#757B8D</mdfull_hr_color>
            <mdtmr_copy_time_color>#1A182D</mdtmr_copy_time_color>
            <mdfull_copy_time_color>#1A182D</mdfull_copy_time_color>
            <mdscrl_copy_time_color>#1A182D</mdscrl_copy_time_color>
            <mdtmr_copy_time_size_px>36</mdtmr_copy_time_size_px>
            <mdscrl_copy_time_size_px>36</mdscrl_copy_time_size_px>
            <mdfull_copy_time_size_px>36</mdfull_copy_time_size_px>
            <mdfull_copy_sect_a_size_px>24</mdfull_copy_sect_a_size_px>
            <mdfull_copy_sect_b_size_px>24</mdfull_copy_sect_b_size_px>

			* */

            switch(overlay_mode) {
				case 'SCROLL':

                	//
					// APPLY WIDTH TO COPY AREAS
					/*
                    INPUT FOR THESE CALCS ::
                    mdscrl_bgwidth

                    INPUT AFFECTS ::
                    width of mini_overlay_content
                    width of gate_wrapper
                    margin-left: 150px; of scroll_gate_left [NOPE!]

					<mdscrl_copy_time_color>#1A182D</mdscrl_copy_time_color>
					<mdscrl_copy_time_size_px>36</mdscrl_copy_time_size_px>
					copy_m_font_color_hex

                    * */
					$( '#langpack_mini_copy_' + lang_id ).animate({
						color: copy_m_font_color_hex,
						fontSize: copy_m_font_size_percentage+'%'
					}, {
						duration: 0,
						queue: false,
						complete: function () {


						}
					});



                break;
				case 'FULL':

                    /*
                    //
                    // APPLY WIDTH TO COPY AREAS - INPUT FOR THESE CALCS ::
                    mdfull_bgwidth
                    * */

					$( '#langpack_mini_full_shell_' + lang_id ).animate({
						width: mdfull_bgwidth,
						left: oProfile.mdfull_pxfromleft + 'px',
						paddingTop: content_shell_padding_top + 'px'
					}, {
						duration: 0,
						queue: false,
						complete: function () {


						}
					});
/*
					//tmp_view_window_width = mdfull_bgwidth - 42;
					$( '#minimax_SectA_view_window_' + lang_id ).animate({
						width: '78%'
					}, {
						duration: 0,
						queue: false,
						complete: function () {


						}
					});
*/


					//
					// STYLE THIS COPY ::
					// timer_copy_'+ tmp_lang_id +'
					// minimax_primary_copy_sectA_'+ lang_id +'
					// minimax_primary_copy_sectB_'+ lang_id +'
					/*

					<mdfull_copy_sect_a_color>#5B5870</mdfull_copy_sect_a_color>
					<mdfull_copy_sect_b_color>#1A182D</mdfull_copy_sect_b_color>
					<mdfull_hr_color>#757B8D</mdfull_hr_color>
					<mdfull_copy_time_color>#1A182D</mdfull_copy_time_color>
					<mdfull_copy_time_size_px>36</mdfull_copy_time_size_px>
					<mdfull_copy_sect_a_size_px>24</mdfull_copy_sect_a_size_px>
					<mdfull_copy_sect_b_size_px>24</mdfull_copy_sect_b_size_px>

					* */


					$( '#minimax_primary_copy_sectA_' + lang_id ).animate({
						color: oProfile.mdfull_copy_sect_a_color,
						fontSize: oProfile.mdfull_copy_sect_a_size_px
					}, {
						duration: 0,
						queue: false,
						complete: function () {


						}
					});

					$( '#minimax_primary_copy_sectB_' + lang_id ).animate({
						color: oProfile.mdfull_copy_sect_b_color,
						fontSize: oProfile.mdfull_copy_sect_b_size_px
					}, {
						duration: 0,
						queue: false,
						complete: function () {


						}
					});

					$( '#minimax_hr_' + lang_id ).animate({
						borderBottomColor: oProfile.mdfull_hr_color
					}, {
						duration: 0,
						queue: false,
						complete: function () {


						}
					});

					$( '#timer_copy_' + lang_id ).animate({
						color: oProfile.mdfull_copy_time_color,
						fontSize: oProfile.mdfull_copy_time_size_px
					}, {
						duration: 0,
						queue: false,
						complete: function () {


						}
					});

                break;

            }

        break;
        case 'full':


        break;

	}


}


// REPLACED BY loadContent_MINI(oProfile)
function activateContent_MINI(oProfile){

	//
	// LANG PACK SECTION TMP GLOBALS
	tmp_lang_cnt = oProfile.lang_pack_translations.type.length;

	//
	// INTEGRATE LANG PACK DATA
	switch(oProfile.overlay_mode){
		case 'SCROLL':
			log_activity('**** 4428 LANG PACK GOOD LOOK FOR SCROLL INTEGRATION ->'+oProfile.lang_pack_translations.type.length);

			if($('#scroll_view_window_append_handle').length){

			}else {
				tmpHTML = '<div id="gate_wrapper">' +
					'            <div id="scroll_gate_left"></div>' +
					'            <div id="scroll_gate_right"></div>' +
					'        </div>' +
					'        <div id="scroll_view_window_append_handle" class="scroll_view_window_append_handle"></div>';

				$("#mini_overlay_content").append(tmpHTML);
			}

			for(i=0;i<tmp_lang_cnt;i++){

				var lang_id = oProfile.lang_pack_translations.lang_id[i];

				var objFlagDiv = document.createElement('div');
				objFlagDiv.setAttribute('id', 'langpack_mini_copy_' + lang_id);
				objFlagDiv.setAttribute('class','scrolling_content_container');

				$( '#scroll_view_window_append_handle').append( objFlagDiv );

				newHTML = returnMini_innerHTML(oProfile,i);
				objFlagDiv.innerHTML = newHTML;

				log_activity("*** Lang Pack ["+i+"] "+lang_id+" ["+oProfile.lang_pack_translations.copy_m_title[i]+"] mode="+oProfile.overlay_mode+" COMPLETE!");

			}

		break;
		case 'FULL':

			for(i=0;i<tmp_lang_cnt;i++){

				var lang_id = oProfile.lang_pack_translations.lang_id[i];

				if($('#langpack_mini_full_shell_' + lang_id).length){


				}else{

					var objFlagDiv = document.createElement('div');
					objFlagDiv.setAttribute('id', 'langpack_mini_full_shell_' + lang_id);
					objFlagDiv.setAttribute('class','langpack_mini_full_shell');

					//objFlagDataContainer.appendChild(objFlagDiv);
					$( "#mini_overlay_content" ).prepend( objFlagDiv );

				}

				newHTML = returnMini_innerHTML(oProfile,i);

				if(newHTML!='silence'){
					objFlagDiv.innerHTML = newHTML;

					//
					// CALCULATE HEIGHT OF DOM ELEMENT. 2 MODES FOR ACCOMADATION.
					// DYNAMIC FIT (STORE HEIGHT IN DOM, THEN DYNAMIC DRIVE) AND STRAIGHT LINE (RUN HIGHEST VALUE).
					tmp_DOM_height_all = $('#langpack_mini_full_shell_'+ tmp_lang_id).height();
					tmp_DOM_height_sectA = $('#minimax_primary_copy_sectA_'+ tmp_lang_id).height();
					tmp_DOM_height_sectB = $('#minimax_primary_copy_sectB_'+ tmp_lang_id).height();

					$('#mini_sub_total_height_'+ tmp_lang_id).html(tmp_DOM_height_all);
					$('#mini_sub_sectA_height_'+ tmp_lang_id).html(tmp_DOM_height_sectA);
					$('#mini_sub_sectB_height_'+ tmp_lang_id).html(tmp_DOM_height_sectB);


					if(langPack_MINI_maxheight_FullAll<tmp_DOM_height_all){
						langPack_MINI_maxheight_FullAll = tmp_DOM_height_all;

					}

					if(langPack_MINI_maxheight_FullSectA<tmp_DOM_height_sectA){
						langPack_MINI_maxheight_FullSectA = tmp_DOM_height_sectA;

					}

					if(langPack_MINI_maxheight_FullSectB<tmp_DOM_height_sectB){
						langPack_MINI_maxheight_FullSectB = tmp_DOM_height_sectB;

					}


					log_activity("*** Lang Pack ["+i+"] "+lang_id+" height=["+tmp_DOM_height_all+"] ["+oProfile.lang_pack_translations.copy_m_title[i]+"] mode="+oProfile.overlay_mode+" COMPLETE!");

				}else{
					log_activity("**** Lang Pack SILENCED ["+i+"] "+lang_id+" ["+oProfile.lang_pack_translations.copy_m_title[i]+"] mode="+oProfile.overlay_mode+" COMPLETE!");

				}


			}

		break;
		case 'TIMER':
			// NO COPY
		break;
	}

	//switch(oProfile.overlay_mode) {
	switch($('#om').html()) {
		case 'SCROLL':

			//
			// ROTATION OF LANG PACK CAN BEGIN. TRACK mdscrl_lang_rotate_interval STORED IN langPack_rotation_interval_MINI_SCROLL
			// AUTHORIZE COPY dx-SLIDE TRANSITIONS FOR ACTIVE LANG PACK. TRACK mdscrl_scroll_speed
			log_activity('*** Authorize SCROLL transitions, and get it started.');

			initTransitions(oProfile);

		break;
		case 'FULL':

			//
			// ROTATION OF LANG PACK CAN BEGIN. TRACK mdfull_lang_rotate_interval STORED IN langPack_rotation_interval_MINI_FULL
			// ROTATION OF SUB-COPY ELEM WITHIN LANG PACK CAN BEGIN. TRACK mdfull_sub_copy_rotate_interval
			log_activity('*** Authorize FULL transitions and SUB-COPY-ROTATION...and get it all started.');

			initTransitions(oProfile);

		break;
	}

}

function initTransitions(oProfile){

	switch(oProfile.overlay_mode){
		case 'SCROLL':

			//
			// ROTATION OF LANG PACK CAN BEGIN. TRACK mdscrl_lang_rotate_interval
			// AUTHORIZE COPY dx-SLIDE TRANSITIONS FOR ACTIVE LANG PACK. TRACK mdscrl_scroll_speed
			initMiniScroll(oProfile);



			break;
		case 'FULL':

			//
			// ROTATION OF LANG PACK CAN BEGIN. TRACK mdfull_lang_rotate_interval
			// ROTATION OF SUB-COPY ELEM WITHIN LANG PACK CAN BEGIN. TRACK mdfull_sub_copy_rotate_interval





			break;



	}


}

function initMiniScroll(oProfile){

	//
	// TURN OFF LANG PACK ROTATION LOCK
	langPack_Mini_langPack_rotation_LCK = 0;
	//throwLangGates('open');

	mini_scroll_init = 1;
	sendScrollCopy(oProfile);

}

function sendScrollCopy(oProfile){

	//
	// RETRIEVE NEXT LANG PACK
	tmp_nextLangPack = current_lang_pack(oProfile);

	//tmp_nextLangPack = $('#nxt_langpack').html();

	if(tmp_nextLangPack!=''){
		//
		// UPDATE WITH NEXT LANG PACK. SEND CURRENT LANG PACK.
		tmp_freshNxtLangPack = returnNextLangPack(oProfile, tmp_nextLangPack);
		$('#nxt_langpack').html(tmp_freshNxtLangPack);

		//
		// SCROLL LANG_ID = tmp_nextLangPack
		log_activity('4544 Sending LANG_ID['+tmp_nextLangPack+'] to scrollCopy() for scroll.');
		scrollCopy(oProfile, tmp_nextLangPack);

	}else{

		log_activity('2230 Sending LANG_ID TO GET NEXT for scroll->'+tmp_nextLangPack);
		tmp_freshNxtLangPack = returnNextLangPack(oProfile,tmp_nextLangPack);
		tmp_nextLangPack = returnNextLangPack(oProfile,tmp_freshNxtLangPack);
		$('#nxt_langpack').html(tmp_nextLangPack);

		//
		// SCROLL LANG_ID = tmp_freshNxtLangPack
		log_activity('4555 Sending LANG_ID['+tmp_freshNxtLangPack+'] to scrollCopy() for scroll.');
		current_lang_pack(oProfile, tmp_freshNxtLangPack);
		scrollCopy(oProfile, tmp_freshNxtLangPack);

	}

}

function returnNextLangPack(oProfile, tmp_nextLangPack){

	tmp_prev_lang_id = tmp_nextLangPack;
	tmp_nxt_lang_id = tmp_nextLangPack;
	tmp_match_flag = 0;
	tmp_found_nxt_flag = 0;
	following_lang_pass_flag = 0;

	//
	// RECEIVE LANG_ID AND USE oProfile DATA TO RETURN
	// NEXT LANG_ID IN SEQUENCE AS FROM THE XML DOC.
	tmp_lang_cnt = oProfile.lang_pack_translations.type.length;

	for(s=0;s<tmp_lang_cnt;s++){

		var tmp_lang_id = oProfile.lang_pack_translations.lang_id[s];

		if(tmp_nextLangPack=='' && s==0){
			//
			// WE HAVE FIRST RUN, EVER. INIT AND GO.
			tmp_prev_lang_id = tmp_lang_id;
			tmp_nxt_lang_id = tmp_lang_id;
			tmp_lang_id_zero = tmp_lang_id;

			//
			// JUMP LOOP
			s=144000;
		}

		if(tmp_match_flag==1 && following_lang_pass_flag==0){
			following_lang_pass_flag=1;
		}

		if(s==0){
			if(tmp_lang_cnt==1){
				tmp_nxt_lang_id = tmp_lang_id;
				tmp_lang_id_zero = tmp_lang_id;

			}else{
				tmp_lang_id_zero = tmp_lang_id;
			}

		}

		if(tmp_match_flag==1 && tmp_found_nxt_flag==0){

			tmp_nxt_lang_id = tmp_lang_id;
			tmp_found_nxt_flag=1;
		}

		if(tmp_prev_lang_id==tmp_lang_id){

			tmp_match_flag=1;
		}

	}


	if(tmp_match_flag==1 && following_lang_pass_flag==0){
/*
		switch(ai_oMode_return_to_omode){
			case 'FULL':

				mini_full_ai_lang_pack_rotation_cnt++;

			break;
			case 'SCROLL':

				mini_scrl_ai_lang_pack_rotation_cnt++;

			break;
		}
*/
		//log_activity('***** BURN CONTROL MECH FOR LANG PACK/SLEEP INTEGRATION - INCREMENT LANG PACK ROTATION COUNT *****');
		tmp_nxt_lang_id = tmp_lang_id_zero;
	}

	// IF CNT=1 AND NO MATCH...WE HAVE THE COPY OF SINGLE LANG
	// PACK...RETURN NODE[ZERO]...BE OPEN TO RETURN WHAT WE DID NOT COME IN THE DOOR WITH, THO.
	if(tmp_lang_cnt==1 && tmp_match_flag==0){

		//
		// CARBON-COPY RUNNING. NEXT, INDEED, WILL BE ORIGINAL...XML NODE[0].
		// SEE tmp_nxt_lang_id

	}else{

		if(tmp_lang_cnt==1 && tmp_match_flag==1) {

			//
			// ORIGINAL LANG_PACK RUNNING. NEXT SHOULD BE CARBON-COPY.
			tmp_nxt_lang_id=tmp_nxt_lang_id+'01';

		}
	}

	return tmp_nxt_lang_id;
}

function scrollCopy(oProfile, tmp_nextLangPack){

	log_activity('Begin scroll for LANG_PACK[' + tmp_nextLangPack+']');
	//$('#curr_mini_lang_pack').html(tmp_nextLangPack);

	//
	// WE HAVE LANG_ID (OR CARBON-COPY) TO PREPARE FOR SCROLL
	// AND TO BEGIN SCROLL IMMEDIATELY.
	if($('#langpack_mini_copy_opacity_'+tmp_nextLangPack).length){


	}else{

		//
		// CREATE DIV
		objFlagDiv = document.createElement('div');
		objFlagDiv.setAttribute('id', 'langpack_mini_copy_opacity_'+tmp_nextLangPack);
		objFlagDiv.setAttribute('class','hidden');

		$( "#overlay_dyn_flags_container" ).append( objFlagDiv );

	}

	//
	// CHECK FOR EXISTENSE OF LANG_ID IN DOM.
	if($('#langpack_mini_copy_'+tmp_nextLangPack).length){


	}else{

		//
		// ASSUME CARBON REQUEST. TRIM 2 CHAR FROM END TO DISCOVER ORIGINAL FOR COPY.
		tmp_nextLangPack_orig = tmp_nextLangPack.slice(0, -2);

		//
		// CREATE CARBON
		objFlagDiv = document.createElement('div');
		objFlagDiv.setAttribute('id', 'langpack_mini_copy_'+tmp_nextLangPack);
		objFlagDiv.setAttribute('class','scrolling_content_container');

		$( "#scroll_view_window_append_handle" ).append( objFlagDiv );

		//
		// COPY CONTENT FROM ORIGINAL TO CARBON
		$('#langpack_mini_copy_'+tmp_nextLangPack).html($('#langpack_mini_copy_'+tmp_nextLangPack_orig).html());

		//
		// DO WE NEED TO APPLY CSS STYLES? WILL SEE...

	}

	// RESET
	resetScrollElem(tmp_nextLangPack);

	//
	// TIMING REQUIREMENT SPECIFICATION
	if(mini_scroll_init==1){

		mini_scroll_lang_id_gap=0;
		mini_scroll_init = 0;

	}else{
		mini_scroll_lang_id_gap = MINI_copy_scroll_transition_gap;

	}

	//
	// BUFFER SENDING
	$( "#ui_retardation_handle_duo" ).animate({
		color: '#FFFFFF'
	}, {
		duration: mini_scroll_lang_id_gap,
		queue: false,
		specialEasing: {
			color: "linear"
		},
		step: function( now, fx ) {
			//var data = fx.elem.id + " " + fx.prop + ": " + now;
			//log_activity("*** Animation in action :: " + data);
		},
		complete: function () {

			//
			// BEGIN ANIMATION
			throwLangGates('open');

			// ui_retardation_handle
			$( "#ui_retardation_handle" ).animate({
				color: '#FFFFFF'
			}, {
				duration: 1900,
				queue: false,
				specialEasing: {
					color: "linear"
				},
				step: function( now, fx ) {
					//var data = fx.elem.id + " " + fx.prop + ": " + now;
					//log_activity("*** Animation in action :: " + data);
				},
				complete: function () {

					$( "#langpack_mini_copy_"+ tmp_nextLangPack).animate({
						left: '-3600px'
					}, {
						duration: 55500,
						queue: false,
						specialEasing: {
							left: "linear"
						},
						step: function( now, fx ) {
							var em = document.getElementById("langpack_mini_copy_"+tmp_nextLangPack);
							var  tmp_opacity = window.getComputedStyle(em).getPropertyValue("opacity");

							$('#langpack_mini_copy_opacity_'+tmp_nextLangPack).html(tmp_opacity);

							//var data = fx.elem.id + " " + fx.prop + ": " + now;
							//log_activity("*** Animation in action :: " + data);
						},
						complete: function () {
							log_activity("*** SCROLL Animation COMPLETE :: langpack_mini_copy_"+tmp_nextLangPack);
						}
					});


				}
			});

			langPack_Mini_langPack_rotation_LCK = 0;

		}
	});

}

function resetScrollElem(lang_id){

	$( "#langpack_mini_copy_"+ lang_id).animate({
		left: '0px'
	}, {
		duration: 0,
		queue: false,
		specialEasing: {
			left: "linear"
		},
		step: function( now, fx ) {

		},
		complete: function () {

			$( "#langpack_mini_copy_"+ lang_id).animate({
				opacity: 1.0
			}, {
				duration: 0,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				step: function( now, fx ) {

				},
				complete: function () {

				}
			});

		}
	});


}

function throwLangGates(mode){
		switch(mode){
			case 'open':

				$( "#scroll_gate_right" ).animate({
					opacity: 1.0
				}, {
					duration: 2000,
					queue: false,
					step: function( now, fx ) {
						//var data = fx.elem.id + " " + fx.prop + ": " + now;
						//log_activity("*** Animation in action :: " + data);
					},
					complete: function () {

						$( "#ui_retardation_handle_duo" ).animate({
							color: '#000000'
						}, {
							duration: 2500,
							queue: false,
							step: function( now, fx ) {
								//var data = fx.elem.id + " " + fx.prop + ": " + now;
								//log_activity("*** Animation in action :: " + data);
							},
							complete: function () {
								//log_activity("*** Animation COMPLETE :: langpack_mini_copy_en");

								$( "#scroll_gate_left" ).animate({
									opacity: 1.0
								}, {
									duration: 4000,
									queue: false,
									step: function( now, fx ) {
										//var data = fx.elem.id + " " + fx.prop + ": " + now;
										//log_activity("*** Animation in action :: " + data);
									},
									complete: function () {


									}
								});

							}
						});


					}
				});


			break;
			case 'close':

				$( "#scroll_gate_right" ).animate({
					opacity: 0.0
				}, {
					duration: 2000,
					queue: false,
					step: function( now, fx ) {
						//var data = fx.elem.id + " " + fx.prop + ": " + now;
						//log_activity("*** Animation in action :: " + data);
					},
					complete: function () {
						$( "#scroll_gate_left" ).animate({
							opacity: 0.0
						}, {
							duration: 1000,
							queue: false,
							step: function( now, fx ) {
								//var data = fx.elem.id + " " + fx.prop + ": " + now;
								//log_activity("*** Animation in action :: " + data);
							},
							complete: function () {




							}
						});



					}
				});

			break;

		}

	}

function returnMini_innerHTML(oProfile,pos){

	newHTML = '';

	var lang_id = oProfile.lang_pack_translations.lang_id[pos];
	var copy_m_title = oProfile.lang_pack_translations.copy_m_title[pos];
	var copy_m_message = oProfile.lang_pack_translations.copy_m_message[pos];
	var copy_m_conference = oProfile.lang_pack_translations.copy_m_conference[pos];
	var copy_m_date = oProfile.lang_pack_translations.copy_m_date[pos];
	var copy_m_scroll_speed = oProfile.lang_pack_translations.copy_m_scroll_speed[pos];
	var copy_m_scroll_direction = oProfile.lang_pack_translations.copy_m_scroll_direction[pos];
	var copy_m_font_size_percentage = oProfile.lang_pack_translations.copy_m_font_size_percentage[pos];
	var copy_m_padding_top_px = oProfile.lang_pack_translations.copy_m_padding_top_px[pos];
	var timer_m_font_size_percentage = oProfile.lang_pack_translations.timer_m_font_size_percentage[pos];
	var cleartext_endpoint = oProfile.lang_pack_translations.cleartext_endpoint[pos];
	var copy_hash = oProfile.lang_pack_translations.copy_hash[pos];

	switch(oProfile.overlay_mode){
		case 'SCROLL':
			newHTML = '<div id="message_meta_'+lang_id+'" class="message_meta">' + copy_m_message + '</div>' +
				'<div id="message_title_'+lang_id+'" class="message_title">' + copy_m_title + '</div><div id="conference_date_'+lang_id+'" class="conference_date">' + copy_m_date + '</div>' +
				'<div id="conference_title_'+lang_id+'" class="conference_title">' + copy_m_conference + '</div><div class="lang_pack_buffer">&nbsp;</div><div id="message_meta_'+lang_id+'2" class="message_meta">' + copy_m_message + '</div><div id="message_title_'+lang_id+'2" class="message_title">' + copy_m_title + '</div>' +
				'<div id="conference_date_'+lang_id+'2" class="conference_date">' + copy_m_date + '</div><div id="conference_title_'+lang_id+'2" class="conference_title">' + copy_m_conference + '</div><div class="cb"></div><div id="mini_scrl_total_height_'+lang_id+'" class="hidden"></div>';

		break;
		case 'FULL':
			//log_activity('2535 - **** Building MINI-FULL LANG PACK DOM Struct...');
			log_activity('**** Building MINI-FULL - HTML TEST-> copy_m_title :: '+copy_m_title);
			if($('#mini_sub_rotate_elem_hash_'+lang_id).length){
				tmp_curr_copy_hash = $('#mini_sub_rotate_elem_hash_'+lang_id).html();

				//alert(copy_hash + '<-->' + tmp_curr_copy_hash);
				if(copy_hash==tmp_curr_copy_hash){
					//
					// DO NOTHING
					log_activity('**** SILENCE LANG PACK '+lang_id+' DOM WRITE! ****');
					return 'silence';

				}else{

					//$( "#mini_overlay_content" ).empty();

					//alert($( "#mini_overlay_content" ).html());

					tmp_wall_time = $('#timer_copy_persist').html();
					newHTML = '<div id="minimax_SectA_view_window_'+ lang_id +'" class="view_window"><div id="minimax_primary_copy_sectA_'+ lang_id +'" class="minimax_primary_copy_sectA"><div id="minimax_primary_copy_sectA_handle_'+lang_id+'" class="minimax_primary_copy_sectA_handle">' + copy_m_title + '</div></div></div>' +
						'<div class="cb"></div>' +
						'<div id="minimax_hr_'+ lang_id +'" class="minimax_hr"></div>' +
						/*'<div id="timer_copy_'+ lang_id +'" class="timer_copy">' + tmp_wall_time + '</div>' + */
						'<div id="timer_copy_'+ lang_id +'" class="timer_copy"></div>' +
						'<div id="minimax_primary_copy_sectB_'+ lang_id +'" class="minimax_primary_copy_sectB">' + copy_m_message + '</div>'+
						'<div class="cb"></div>' +
						'<div class="hidden">' +
						'<div id="mini_sub_total_height_'+ lang_id +'"></div>' +
						'<div id="mini_sub_sectA_height_'+ lang_id +'"></div>' +
						'<div id="mini_sub_sectA_maxheight_'+ lang_id +'"></div>' +
						'<div id="mini_sub_sectB_height_'+ lang_id +'"></div>' +
						'<div id="mini_sub_sectB_maxheight_'+ lang_id +'"></div>' +
						'<div id="mini_sub_rotate_elem_hash_' + lang_id +'">' + copy_hash + '</div>' +
						'<div id="mini_rotate_elem_title_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_title + '</div>' +
						'<div id="mini_rotate_elem_conf_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_conference + '</div>' +
						'<div id="mini_rotate_elem_date_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_date + '</div>' +
						'<div id="mini_rotate_elem_meta_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_message + '</div>' +
						'</div>';

				}

			}else{

				tmp_wall_time = $('#timer_copy_persist').html();
				newHTML = '<div id="minimax_SectA_view_window_'+ lang_id +'" class="view_window"><div id="minimax_primary_copy_sectA_'+ lang_id +'" class="minimax_primary_copy_sectA"><div id="minimax_primary_copy_sectA_handle_'+lang_id+'" class="minimax_primary_copy_sectA_handle">' + copy_m_title + '</div></div></div>' +
					'<div class="cb"></div>' +
					'<div id="minimax_hr_'+ lang_id +'" class="minimax_hr"></div>' +
					/*'<div id="timer_copy_'+ lang_id +'" class="timer_copy">' + tmp_wall_time + '</div>' + */
					'<div id="timer_copy_'+ lang_id +'" class="timer_copy"></div>' +
					'<div id="minimax_primary_copy_sectB_'+ lang_id +'" class="minimax_primary_copy_sectB">' + copy_m_message + '</div>'+
					'<div class="cb"></div>' +
					'<div class="hidden">' +
					'<div id="mini_sub_total_height_'+ lang_id +'"></div>' +
					'<div id="mini_sub_sectA_height_'+ lang_id +'"></div>' +
					'<div id="mini_sub_sectA_maxheight_'+ lang_id +'"></div>' +
					'<div id="mini_sub_sectB_height_'+ lang_id +'"></div>' +
					'<div id="mini_sub_sectB_maxheight_'+ lang_id +'"></div>' +
					'<div id="mini_sub_rotate_elem_hash_' + lang_id +'">' + copy_hash + '</div>' +
					'<div id="mini_rotate_elem_title_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_title + '</div>' +
					'<div id="mini_rotate_elem_conf_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_conference + '</div>' +
					'<div id="mini_rotate_elem_date_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_date + '</div>' +
					'<div id="mini_rotate_elem_meta_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_message + '</div>' +
					'</div>';

			}

		break;
		case 'TIMER':
			curr_time_copy = $('#timer_copy_persist').html();
			newHTML = '<div id="timer_copy_'+lang_id+'" class="timer_copy>'+curr_time_copy+'</div>';
		break;

	}

	return newHTML;

}

function parseProfileIndexXML(xml){
	log_activity("XML returned from endpoint - profile_index.xml");
	clearProfileLoadLck();

	var cnt = 0;
	$(xml).find("profile").each(function () {
		log_activity("Traversing returned profile_index.xml node [pid="+$(this).find("pid").text()+"] [config_hash="+$(this).find("config_hash").text()+"] loop cnt=["+cnt+"]");
		cnt++;

		//
		// SEND RESPONSE NODE TO XML LOAD CONTROLLER FOR PROFILE INDEX
		loadProfileIndex(this);

	});

	syncToProfileIndex();
}

function syncToProfileIndex(){

	if(profile_overload==true || profile_overload=='true'){

		syncOverlayStateXML(0);

	}else{

		//alert('XML node cnt in memory = '+profileindexARRAY.length);
		var tmp_watch = 0;
		var tmp_len = profileIndexARRAY.length;

		//log_activity("XML index sync check for "+tmp_len+" <profile> nodes from endpoint.");
		for(i=0; tmp_watch<tmp_len; i++){

			if(sync_modified(tmp_watch)){

				//
				// A CHANGE WAS MADE

			}else{

				//
				// NO CHANGE REQUESTED.
			}

			tmp_watch++;
			//alert('check hash for '+profileIndexARRAY[i].profile_endpoint);

		}

	}

}

function sync_modified(pos){

	total_index_invalid = 0;
	tmp_flag = false;
	tmp_pos_expire_FLAG = new Array();
	tmp_pos_expire_FLAG[pos] = '0';
	tmp_hash_elem_id = 'config_hash_'+profileIndexARRAY[pos].pid;
	tmp_hash_elem_val = profileIndexARRAY[pos].config_hash;

	tmp_profile_elem_id = 'profile_endpoint_'+profileIndexARRAY[pos].pid;
	tmp_profile_elem_val = profileIndexARRAY[pos].profile_endpoint;

	//log_activity("...checking for profile "+pos+" deltas of all index <profile> nodes from endpoint.");

	if(flag_delta_check('hash', tmp_hash_elem_id, tmp_hash_elem_val)){
		//
		// DELTA FOUND
		tmp_flag = true;

		//
		// AJAX REQUEST [FROM HERE IN THIS LOOP] REFRESH PROFILE FROM ENDPOINT
		tmp_pos_expire_FLAG[pos] = '1';
		syncOverlayStateXML(pos);
	}

	if(flag_delta_check('profile', tmp_profile_elem_id, tmp_profile_elem_val)){
		//
		// DELTA FOUND
		tmp_flag = true;
		//log_activity("** WE HAVE CHANGE DETECTED ** XML index profile sync check for <profile> node "+pos+".");

		//
		// AJAX REQUEST [FROM HERE IN THIS LOOP] REFRESH PROFILE FROM ENDPOINT
		if(tmp_pos_expire_FLAG[pos]!='1'){
			syncOverlayStateXML(pos);
		}

	}

	return tmp_flag;

}

//
// PRIMARY XML LOAD CONTROLLER - INDEX
function loadProfileIndex(oItemNode){

	//alert($(oItemNode).find("config_hash").text());
	var requestor_id= $(oItemNode).find("requestor_id").text();
	var pid= $(oItemNode).find("pid").text();
	var config_hash= $(oItemNode).find("config_hash").text();
	var profile_endpoint= $(oItemNode).find("profile_endpoint").text();
	var profile_endpoint_prod = $(oItemNode).find("profile_endpoint_prod").text();
	var lastmodified= $(oItemNode).find("lastmodified").text();

	var is_prod = ajax_root.indexOf("jony5.com");

	if(is_prod>2){
		profile_endpoint = profile_endpoint_prod;
	}

	//
	// STORE IN OBJECT
	setOverlayProfileIndexObject(requestor_id,pid,config_hash,profile_endpoint,lastmodified);

}


function flag_delta_check(type, elem_id, newval){
	//
	// TREAT ANY NEW VALUE AS HANDLED BEFORE RETURN
	if($('#'+elem_id).length){

		tmp_curr_val = $('#'+elem_id).html();
		//log_activity("Check DELTA of FLAG for "+type+" type. Element "+elem_id+". old/new = "+tmp_curr_val+"/"+newval+" ");

		if(tmp_curr_val==newval){

			return false;

		}else{

			if(type=='profile'){
				forced_endpoint_update_BOOL = true;

			}

			total_index_invalid++;
			$('#'+elem_id).html(newval);
			log_activity("**ALERT** We have DELTA for "+type+" type. Dynamically build element "+elem_id+". Initialize old to new == "+tmp_curr_val+" to "+newval+" ");
			return true;
		}

	}else{
		//objFlagDataContainer = $('overlay_dyn_flags_container');

		objFlagDiv = document.createElement('div');
		objFlagDiv.setAttribute('id', elem_id);
		objFlagDiv.setAttribute('class','hidden');

		$( "#overlay_dyn_flags_container" ).append( objFlagDiv );
		//objFlagDiv.html(newval);
		$('#'+elem_id).html(newval);
		log_activity("**ALERT** We have DELTA for "+type+" type. Dynamically build element "+elem_id+". Initialize old to new = undefined to "+newval+" ");

		return true;

	}

}

function syncDOM_Flags(dataType, pos){

	switch(dataType){
		case 'index':
			var pid = profileIndexARRAY[pos].pid;

			addOrUpdateFlag('config_hash_'+pid, profileIndexARRAY[pos].config_hash);
			addOrUpdateFlag('profile_endpoint_'+pid, profileIndexARRAY[pos].profile_endpoint);

			break;
		case 'profile':
			//var pid = profileIndexARRAY[pos].pid;

			//addOrUpdateFlag('config_hash_'+pid, profileIndexARRAY[pos].config_hash);
			//addOrUpdateFlag('profile_endpoint_'+pid, profileIndexARRAY[pos].profile_endpoint);

			break;
	}

}

function rotateFullScrnLangPack(oProfile){

	//
	// LOCK LANG PACK ROTATION - TURN OFF
	lang_id = current_lang_pack(oProfile);
	tmp_freshNxtLangPack = returnNextLangPack(oProfile, lang_id);
	current_lang_pack(oProfile, tmp_freshNxtLangPack);

	authFlag_langPack_FullScrn_rotate = 0;

	$( '#fullscrn_content_' + lang_id ).animate({
		opacity: 0.0
	}, {
		duration: 2000,
		queue: false,
		step: function( now, fx ) {

		},
		complete: function () {

			$( '#fullscrn_content_' + tmp_freshNxtLangPack).animate({
				opacity: 1.0
			}, {
				duration: 2000,
				queue: false,
				step: function( now, fx ) {

				},
				complete: function () {
					authFlag_langPack_FullScrn_rotate = 1;

				}
			});


		}
	});

}


function rotateMiniScrlLangPack(oProfile){

	//
	// LOCK LANG PACK ROTATION - TURN OFF
	lang_id = current_lang_pack(oProfile);
	tmp_freshNxtLangPack = returnNextLangPack(oProfile, lang_id);
	current_lang_pack(oProfile, tmp_freshNxtLangPack);

	//lang_id = $('#curr_mini_lang_pack').html();
	langPack_Mini_langPack_rotation_LCK = 1;
	throwLangGates('close');

	$( '#langpack_mini_copy_' + lang_id ).animate({
		opacity: 0.0
	}, {
		duration: 2000,
		queue: false,
		step: function( now, fx ) {

		},
		complete: function () {
			//log_activity("*** Animation COMPLETE :: langpack_mini_copy_opacity_zh");

			log_activity('634 FADED OUT ['+lang_id+']. RUNNING rotateMiniScrlLangPack().');
			sendScrollCopy(oProfile);

		}
	});



}

function rotateMiniFullLangPack(oProfile){
	/*

	IF ONLY 1 LANG PACK, SIMPLY CONTINUE TO ROTATE SUB COPY....NOTHING TO DO HERE.

	BG UP
	complete: GATE OPEN
		complete: SectA OUT
			complete: FADE OUT CURR LANG PACK SectB
				complete: SET X-POS TO -1000 FOR SECTA OF NEW LANG PACK (0) [MIGHT ALREADY BE THERE...NP]
					IF HMM IS DYNAMIC, APPLY CALC OF BG DIMENSIONS. IF NEEDS ADJUSTMENT...
					- CLOSE LANG GATE
						complete: RESIZE/REPOSITION BG, RESIZE/REPOSITION ANY CONTENT
						complete: OPEN NEW LANG GATE

					complete: FADE IN NEW LANG PACK (Timer/SectB only visible)
						complete: SectA OF NEW LANG PACK IN
							complete: GATE CLOSE,
							PREVIOUS LANG PACK SectB FADE BACK IN,
							FADE OUT PREVIOUS LANG PACK SHELL

	* */
	authFlag_langPack_MiniFull_rotate = 0;

	tmp_curr_lang_id = current_lang_pack(oProfile);
	tmp_freshNxtLangPack = returnNextLangPack(oProfile, tmp_curr_lang_id);
	$('#nxt_langpack').html(tmp_freshNxtLangPack);
	current_lang_pack(oProfile,tmp_freshNxtLangPack);

	$( "#mini_overlay_bg" ).animate({
		opacity: 1.0
	}, {
		duration: 500,
		queue: false,
		specialEasing: {
			opacity: "swing"
		},
		step: function( now, fx ) {

		},
		complete: function () {

			//
			// RAISE LANG GATE
			$( "#full_gate_left" ).animate({
				opacity: 1.0
			}, {
				duration: 2000,
				queue: false,
				specialEasing: {
					opacity: "swing"
				},
				step: function( now, fx ) {

				},
				complete: function () {

					//
					// REMOVE SUB COPY
					$('#minimax_primary_copy_sectA_' + tmp_curr_lang_id).effect( "bounce", {direction:'right', distance: bounce_OUT_distance_px, times: bounce_OUT_num_times }, bounce_OUT_speed );

					$('#minimax_primary_copy_sectA_' + tmp_curr_lang_id).animate({
						left: '-1000px'
					}, {
						duration: 1000,
						queue: true,
						specialEasing: {
							left: "swing"
						},
						step: function( now, fx ) {

						},
						complete: function () {

							//
							// FADE OUT SECT B COPY AND HR
							$( "#minimax_hr_"+ tmp_curr_lang_id).animate({
								opacity: 0.0
							}, {
								duration: 1000,
								queue: false,
								specialEasing: {
									opacity: "swing"
								},
								step: function( now, fx ) {
									//var data = fx.elem.id + " " + fx.prop + ": " + now;
									//log_activity("*** Animation in action :: " + data);
								},
								complete: function () {


								}
							});

							$( '#minimax_primary_copy_sectB_' + tmp_curr_lang_id ).animate({
								opacity: 0.0
							}, {
								duration: 1000,
								queue: false,
								specialEasing: {
									opacity: "swing"
								},
								step: function( now, fx ) {

								},
								complete: function () {

									//
									// PREP NEXT LANG PACK
									$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).animate({
										left: '-1000px'
									}, {
										duration: 0,
										queue: false,
										specialEasing: {
											left: "linear"
										},
										step: function( now, fx ) {

										},
										complete: function () {

											//
											// READY WITH NEW LANG PACK. DO WE NEED TO RESIZE/RE-COORD THE ENVIRONMENT?
											tmp_hmm = oProfile.height_mgmt_mode;

											if(tmp_hmm=='DYNAMIC'){

												//
												// IS THE NEXT LANG PACK OF SAME HEIGHT?
												// RECALC THE SITUATION
												var overlay_bg_height = retrieve_overlay_bg_height(oProfile);
												var overlay_bg_pxfrmtop = retrieve_overlay_bg_pxfrmtop(oProfile);
												var overlay_content_pxfrmtop = retrieve_overlay_content_pxfrmtop(oProfile);
												log_activity('overlay_bg_height['+overlay_bg_height+'] overlay_bg_pxfrmtop['+overlay_bg_pxfrmtop+']  overlay_content_pxfrmtop['+overlay_content_pxfrmtop+']  ');
												//tmp_copy_top = -(overlay_bg_pxfrmtop+155);

												//
												// SET NEW LANG GATE BG IMAGE
												tmp_prev_lang_index = langPack_Mini_IDtoIndex_ARRAY[tmp_curr_lang_id];
												tmp_lang_index = langPack_Mini_IDtoIndex_ARRAY[tmp_freshNxtLangPack];

												tmp_lang_gate_prev_FILENAME = langPack_Mini_fullgate_ARRAY[tmp_prev_lang_index];
												tmp_lang_gate_FILENAME = langPack_Mini_fullgate_ARRAY[tmp_lang_index];

												if(tmp_lang_gate_prev_FILENAME==tmp_lang_gate_FILENAME){

													//
													// NO CHANGE TO LANG GATE OR CONTENT SIZE.
													// POSITION AND SHOW NEW CONTENT - COPY
													$( "#langpack_mini_full_shell_"+ tmp_freshNxtLangPack).animate({
														top: overlay_content_pxfrmtop
													}, {
														duration: 0,
														queue: false,
														step: function( now, fx ) {
															//var data = fx.elem.id + " " + fx.prop + ": " + now;
															//log_activity("*** Animation in action :: " + data);
														},
														complete: function () {


														}
													});

													$( "#langpack_mini_full_shell_"+ tmp_freshNxtLangPack).animate({
														opacity: 1.0
													}, {
														duration: 1000,
														queue: false,
														step: function( now, fx ) {
															//var data = fx.elem.id + " " + fx.prop + ": " + now;
															//log_activity("*** Animation in action :: " + data);
														},
														complete: function () {

															//
															// FADE OUT/RESET PREVIOUS LANG PACK
															$( "#langpack_mini_full_shell_"+ tmp_curr_lang_id).animate({
																opacity: 0.0
															}, {
																duration: 0,
																queue: false,
																specialEasing: {
																	opacity: "linear"
																},
																step: function( now, fx ) {

																},
																complete: function () {

																	//
																	// FADE IN HR OF THE PREVIOUS LANG PACK...STILL IN HIDDEN PARENT THO.
																	$( "#minimax_hr_"+ tmp_curr_lang_id).animate({
																		opacity: 1.0
																	}, {
																		duration: 0,
																		queue: false,
																		specialEasing: {
																			opacity: "linear"
																		},
																		step: function( now, fx ) {
																			//var data = fx.elem.id + " " + fx.prop + ": " + now;
																			//log_activity("*** Animation in action :: " + data);
																		},
																		complete: function () {


																		}
																	});

																	//
																	// FADE IN SECT B OF THE PREVIOUS LANG PACK...STILL IN HIDDEN PARENT THO.
																	$( "#minimax_primary_copy_sectB_"+ tmp_curr_lang_id).animate({
																		opacity: 1.0
																	}, {
																		duration: 0,
																		queue: false,
																		specialEasing: {
																			opacity: "linear"
																		},
																		step: function( now, fx ) {

																		},
																		complete: function () {


																		}
																	});

																}
															});

															//
															// UPDATE CONTENT TO ORIGINAL
															tmp_html = $('#mini_rotate_elem_title_' + tmp_freshNxtLangPack).html();
															$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).html(tmp_html);

															//
															// SLIDE IN SECT A OF NEW LANG PACK
															$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).animate({
																left: '0px'
															}, {
																duration: 1000,
																queue: false,
																specialEasing: {
																	left: "swing"
																},
																step: function( now, fx ) {

																},
																complete: function () {
																	$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).effect( "bounce", {direction:'left', distance: bounce_IN_distance_px, times: bounce_IN_num_times }, bounce_IN_speed );

																	//
																	// CLOSE LANG GATE
																	$( "#full_gate_left" ).animate({
																		opacity: 0
																	}, {
																		duration: 1000,
																		queue: false,
																		specialEasing: {
																			opacity: "linear"
																		},
																		step: function( now, fx ) {

																		},
																		complete: function () {

																			//
																			// BG DOWN
																			tmp_overlay_bg_opacity = oProfile.mdfull_bgopacity;

																			$( "#mini_overlay_bg" ).animate({
																				opacity: tmp_overlay_bg_opacity
																			}, {
																				duration: 2000,
																				queue: false,
																				specialEasing: {
																					opacity: "linear"
																				},
																				step: function( now, fx ) {

																				},
																				complete: function () {
																					authFlag_langPack_MiniFull_rotate = 1;
																					langPack_rotation_interval_MINI_FULL_cnt = 0;
																					langPack_rotation_interval_MINI_FULL_SUB_cnt = 0;
																					$('#msm').html('0');
																				}
																			});

																		}
																	});


																}
															});

														}
													});

												}else{

													// LOAD NEW LANG GATE
													// CLOSE LANG GATE
													$( "#full_gate_left" ).animate({
														opacity: 0
													}, {
														duration: 1000,
														queue: false,
														specialEasing: {
															opacity: "linear"
														},
														step: function( now, fx ) {

														},
														complete: function () {

															//
															// REFRESH LANG GATE
															tmp_gate_http_uri = returnImageUri(tmp_lang_gate_FILENAME, 'gate');
															document.getElementById('full_gate_left').style.backgroundImage = "url('"+tmp_gate_http_uri+"')";

															//
															// RESIZE BG FOR NEW CONTENT
															$( "#mini_overlay_bg" ).animate({
																top: overlay_bg_pxfrmtop,
																width: oProfile.mdfull_bgwidth,
																height: overlay_bg_height
															}, {
																duration: 1000,
																queue: false,
																specialEasing: {
																	top: "swing",
																	height: "swing",
																	width: "swing"
																},
																step: function( now, fx ) {
																	//var data = fx.elem.id + " " + fx.prop + ": " + now;
																	//log_activity("*** Animation in action :: " + data);
																},
																complete: function () {

																	//
																	// REPOSITION OVERLAY CONTENT - LANG GATE
																	//log_activity('359 **** tmp_copy_top='+tmp_copy_top+'|overlay_bg_pxfrmtop='+overlay_bg_pxfrmtop);

																	tmp_gate_top = overlay_bg_pxfrmtop + 5;
																	$( "#full_gate_left").animate({
																		top: tmp_gate_top
																	}, {
																		duration: 0,
																		queue: false,
																		step: function( now, fx ) {
																			//var data = fx.elem.id + " " + fx.prop + ": " + now;
																			//log_activity("*** Animation in action :: " + data);
																		},
																		complete: function () {


																		}
																	});

																	//
																	// REPOSITION OVERLAY CONTENT - COPY
																	$( "#langpack_mini_full_shell_"+ tmp_freshNxtLangPack).animate({
																		top: overlay_content_pxfrmtop
																	}, {
																		duration: 0,
																		queue: false,
																		step: function( now, fx ) {
																			//var data = fx.elem.id + " " + fx.prop + ": " + now;
																			//log_activity("*** Animation in action :: " + data);
																		},
																		complete: function () {


																		}
																	});

																	//
																	// SHOW OVERLAY CONTENT - COPY
																	$( "#langpack_mini_full_shell_"+ tmp_freshNxtLangPack).animate({
																		opacity: 1.0
																	}, {
																		duration: 2000,
																		queue: false,
																		step: function( now, fx ) {
																			//var data = fx.elem.id + " " + fx.prop + ": " + now;
																			//log_activity("*** Animation in action :: " + data);
																		},
																		complete: function () {

																			//
																			// HIDE PREVIOUS LANG PACK
																			$( "#langpack_mini_full_shell_"+ tmp_curr_lang_id).animate({
																				opacity: 0.0
																			}, {
																				duration: 0,
																				queue: false,
																				specialEasing: {
																					opacity: "linear"
																				},
																				step: function( now, fx ) {

																				},
																				complete: function () {

																					//
																					// UPDATE CONTENT TO ORIGINAL
																					tmp_html = $('#mini_rotate_elem_title_' + tmp_freshNxtLangPack).html();
																					$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).html(tmp_html);

																					$( "#minimax_hr_"+ tmp_curr_lang_id).animate({
																						opacity: 1.0
																					}, {
																						duration: 0,
																						queue: false,
																						specialEasing: {
																							opacity: "linear"
																						},
																						step: function( now, fx ) {
																							//var data = fx.elem.id + " " + fx.prop + ": " + now;
																							//log_activity("*** Animation in action :: " + data);
																						},
																						complete: function () {


																						}
																					});

																					//
																					// FADE IN SECT B OF THE PREVIOUS LANG PACK...STILL IN HIDDEN PARENT THO.
																					$( "#minimax_primary_copy_sectB_"+ tmp_curr_lang_id).animate({
																						opacity: 1.0
																					}, {
																						duration: 0,
																						queue: false,
																						specialEasing: {
																							opacity: "linear"
																						},
																						step: function( now, fx ) {

																						},
																						complete: function () {


																						}
																					});

																				}
																			});

																			//
																			// OPEN LANG GATE
																			$( "#full_gate_left" ).animate({
																				opacity: 1.0
																			}, {
																				duration: 1000,
																				queue: false,
																				specialEasing: {
																					opacity: "linear"
																				},
																				step: function( now, fx ) {

																				},
																				complete: function () {

																					//
																					// SLIDE IN SECT A OF NEW LANG PACK
																					$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).animate({
																						left: '0px'
																					}, {
																						duration: 1000,
																						queue: false,
																						specialEasing: {
																							left: "swing"
																						},
																						step: function( now, fx ) {

																						},
																						complete: function () {
																							$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).effect( "bounce", {direction:'left', distance: bounce_IN_distance_px, times: bounce_IN_num_times }, bounce_IN_speed );

																							//
																							// CLOSE LANG GATE
																							$( "#full_gate_left" ).animate({
																								opacity: 0
																							}, {
																								duration: 1000,
																								queue: false,
																								specialEasing: {
																									opacity: "linear"
																								},
																								step: function( now, fx ) {

																								},
																								complete: function () {

																									//
																									// BG DOWN
																									tmp_overlay_bg_opacity = oProfile.mdfull_bgopacity;

																									$( "#mini_overlay_bg" ).animate({
																										opacity: tmp_overlay_bg_opacity
																									}, {
																										duration: 2000,
																										queue: false,
																										specialEasing: {
																											opacity: "linear"
																										},
																										step: function( now, fx ) {

																										},
																										complete: function () {
																											authFlag_langPack_MiniFull_rotate = 1;
																											langPack_rotation_interval_MINI_FULL_cnt = 0;
																											langPack_rotation_interval_MINI_FULL_SUB_cnt = 0;
																											$('#msm').html('0');
																										}
																									});

																								}
																							});


																						}
																					});



																				}
																			});



																		}
																	});



																}
															});



														}
													});

												}



											}else{

												//
												// PROCEED WITH CURRENT ENVIRONMENTAL CONFIG
												// FADE IN NEXT LANG PACK (ONLY TIMER/SECTB WILL BE VISIBLE)
												$( "#langpack_mini_full_shell_"+ tmp_freshNxtLangPack).animate({
													opacity: 1.0
												}, {
													duration: 2000,
													queue: false,
													specialEasing: {
														opacity: "linear"
													},
													step: function( now, fx ) {

													},
													complete: function () {

														//
														// FADE OUT PREVIOUS LANG PACK. FADE IN SECT B OF THE SAME.
														$( "#langpack_mini_full_shell_"+ tmp_curr_lang_id).animate({
															opacity: 0.0
														}, {
															duration: 0,
															queue: false,
															specialEasing: {
																opacity: "linear"
															},
															step: function( now, fx ) {

															},
															complete: function () {

																//
																// UPDATE CONTENT TO ORIGINAL
																tmp_html = $('#mini_rotate_elem_title_' + tmp_freshNxtLangPack).html();
																$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).html(tmp_html);

																//
																// FADE IN SECT B OF THE PREVIOUS LANG PACK...STILL IN HIDDEN PARENT THO.
																$( "#minimax_primary_copy_sectB_"+ tmp_curr_lang_id).animate({
																	opacity: 1.0
																}, {
																	duration: 0,
																	queue: false,
																	specialEasing: {
																		opacity: "linear"
																	},
																	step: function( now, fx ) {

																	},
																	complete: function () {


																	}
																});

															}
														});

														//
														// SLIDE IN SECT A OF NEW LANG PACK
														$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).animate({
															left: '0px'
														}, {
															duration: 1000,
															queue: false,
															specialEasing: {
																left: "swing"
															},
															step: function( now, fx ) {

															},
															complete: function () {
																$('#minimax_primary_copy_sectA_' + tmp_freshNxtLangPack).effect( "bounce", {direction:'left', distance: bounce_IN_distance_px, times: bounce_IN_num_times }, bounce_IN_speed );

																//
																// CLOSE LANG GATE
																$( "#full_gate_left" ).animate({
																	opacity: 0
																}, {
																	duration: 1000,
																	queue: false,
																	specialEasing: {
																		opacity: "linear"
																	},
																	step: function( now, fx ) {

																	},
																	complete: function () {

																		//
																		// BG DOWN
																		tmp_overlay_bg_opacity = oProfile.mdfull_bgopacity;

																		$( "#mini_overlay_bg" ).animate({
																			opacity: tmp_overlay_bg_opacity
																		}, {
																			duration: 2000,
																			queue: false,
																			specialEasing: {
																				opacity: "linear"
																			},
																			step: function( now, fx ) {

																			},
																			complete: function () {
																				authFlag_langPack_MiniFull_rotate = 1;
																				langPack_rotation_interval_MINI_FULL_cnt = 0;
																				langPack_rotation_interval_MINI_FULL_SUB_cnt = 0;
																				$('#msm').html('0');
																			}
																		});

																	}
																});


															}
														});






													}
												});
											}


										}
									});

								}
							});



						}
					});



				}
			});



		}
	});


}

function rotateMiniFullSubCopy(oProfile){

	/*
	newHTML = '<div id="minimax_primary_copy_sectA_'+ lang_id +'" class="minimax_primary_copy_sectA">' + copy_m_title + '</div>' +
	'<div class="cb"></div>' +
	'<div id="minimax_hr_'+ lang_id +'" class="minimax_hr"></div>' +
	'<div id="timer_copy_'+ lang_id +'" class="timer_copy">' + tmp_wall_time + '</div>' +
	'<div id="minimax_primary_copy_sectB_'+ lang_id +'" class="minimax_primary_copy_sectB">' + copy_m_message + '</div>'+
	'<div class="cb"></div>' +
	'<div class="hidden">' +
	'<div id="mini_sub_total_height_'+ lang_id +'"></div>' +
	'<div id="mini_sub_sectA_height_'+ lang_id +'"></div>' +
	'<div id="mini_sub_sectA_maxheight_'+ lang_id +'"></div>' +
	'<div id="mini_sub_sectB_height_'+ lang_id +'"></div>' +
	'<div id="mini_sub_sectB_maxheight_'+ lang_id +'"></div>' +
	'<div id="mini_sub_rotate_elem_hash_' + lang_id +'">' + copy_hash + '</div>' +
	'<div id="mini_rotate_elem_title_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_title + '</div>' +
	'<div id="mini_rotate_elem_conf_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_conference + '</div>' +
	'<div id="mini_rotate_elem_date_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_date + '</div>' +
	'<div id="mini_rotate_elem_meta_' + lang_id +'" class="minifull_sub_rotate_copy">' + copy_m_message + '</div>' +
	'</div>';

	* */


	//
	// RAISE LANG GATE (UP-LIFT THE BACKGROUND, YO)
	/*

	BG UP (500)
		complete: RAISE GATE (2000)
			complete: REMOVE EXPIRED COPY (1000)
				complete: BRING IN FRESH COPY (1500)
					complete:  CLOSE LANG GATE (1000)
						complete: BG DOWN (2000)

	* */

	authFlag_langPack_MiniFull_rotate = 0;
	$( "#mini_overlay_bg" ).animate({
		opacity: 1.0
	}, {
		duration: 500,
		queue: false,
		specialEasing: {
			opacity: "linear"
		},
		step: function( now, fx ) {

		},
		complete: function () {

			tmp_curr_lang_id = current_lang_pack(oProfile);

			tmp_lang_index = langPack_Mini_IDtoIndex_ARRAY[tmp_curr_lang_id];

			tmp_lang_gate_FILENAME = langPack_Mini_fullgate_ARRAY[tmp_lang_index];

			tmp_gate_http_uri = returnImageUri(tmp_lang_gate_FILENAME, 'gate');

			//log_activity('**** FULL LANG GATE OPEN tmp_curr_lang_id['+tmp_curr_lang_id+'] tmp_gate_http_uri['+tmp_gate_http_uri+']');

			document.getElementById('full_gate_left').style.backgroundImage = "url('"+tmp_gate_http_uri+"')";

			//
			// RAISE LANG GATE
			$( "#full_gate_left" ).animate({
				opacity: 1.0
			}, {
				duration: 2000,
				queue: false,
				specialEasing: {
					opacity: "linear"
				},
				step: function( now, fx ) {

				},
				complete: function () {

					/*
					minimax_primary_copy_sectA_

					minimax_primary_copy_sectA_handle_
					* */

					//
					// REMOVE EXPIRED SUB COPY
					$('#minimax_primary_copy_sectA_' + tmp_curr_lang_id).effect( "bounce", {direction:'right', distance: bounce_OUT_distance_px, times: bounce_OUT_num_times }, bounce_OUT_speed );

					$('#minimax_primary_copy_sectA_' + tmp_curr_lang_id).animate({
						left: '-1000px'
					}, {
						duration: 1000,
						queue: true,
						specialEasing: {
							left: "swing"
						},
						step: function( now, fx ) {

						},
						complete: function () {

							//
							// BRING IN FRESH COPY
							tmp_html = returnNxtSubContentMini(oProfile);

							$('#minimax_primary_copy_sectA_' + tmp_curr_lang_id).html(tmp_html);

							//
							// RETURN COPY
							$('#minimax_primary_copy_sectA_' + tmp_curr_lang_id).animate({
								left: '0px'
							}, {
								duration: 1000,
								queue: false,
								specialEasing: {
									left: "swing"
								},
								step: function( now, fx ) {

								},
								complete: function () {
									var bounce_IN_distance_px = 8;
									var bounce_IN_num_times = 1;
									var bounce_IN_speed = 120;
									$('#minimax_primary_copy_sectA_' + tmp_curr_lang_id).effect( "bounce", {direction:'left', distance: bounce_IN_distance_px, times: bounce_IN_num_times }, bounce_IN_speed );

									//
									// CLOSE LANG GATE
									$( "#full_gate_left" ).animate({
										opacity: 0
									}, {
										duration: 1000,
										queue: false,
										specialEasing: {
											opacity: "linear"
										},
										step: function( now, fx ) {

										},
										complete: function () {

											//
											// BG DOWN
											tmp_overlay_bg_opacity = oProfile.mdfull_bgopacity;

											$( "#mini_overlay_bg" ).animate({
												opacity: tmp_overlay_bg_opacity
											}, {
												duration: 2000,
												queue: false,
												specialEasing: {
													opacity: "linear"
												},
												step: function( now, fx ) {

												},
												complete: function () {

													authFlag_langPack_MiniFull_rotate = 1;
													sub_rotate_two_count_selah = 4;
													//langPack_rotation_interval_MINI_FULL_cnt = 0;
													//langPack_rotation_interval_MINI_FULL_SUB_cnt = 0;
												}
											});

										}
									});


								}
							});


						}
					});
				}
			});


		}
	});


}

function returnImageUri(img_filename, img_type){

	var site_root = $('#ajax_root').html();

	switch(img_type){
		case 'gate':
			tmp_dir_path = 'common/imgs/';

			break;

	}

	image_http_uri = site_root + tmp_dir_path + img_filename;

	return image_http_uri;

}

function addOrUpdateFlag(flagID, flagValue){

	if($('#'+flagID).length){

		$('#'+flagID).html(flagValue);

	}else{

		var objFlagDiv = document.createElement('div');
		objFlagDiv.setAttribute('id', flagID);
		objFlagDiv.setAttribute('class','hidden');

		$( "#overlay_dyn_flags_container" ).append( objFlagDiv );
		//objFlagDiv.html(flagValue);
		$('#'+flagID).html(flagValue);

	}

}

function setOverlayProfileIndexObject(requestor_id,pid,config_hash,profile_endpoint,lastmodified){

	tmp_obj = new oProfileIndex(requestor_id,pid,config_hash,profile_endpoint,lastmodified);
	profileIndexARRAY.push(tmp_obj);
	objectArrayProfileIndex++;
}

function oProfileIndex(requestor_id,pid,config_hash,profile_endpoint,lastmodified) {
	this.requestor_id = requestor_id;
	this.pid = pid;
	this.config_hash = config_hash;
	this.profile_endpoint = profile_endpoint;
	this.lastmodified = lastmodified;
	log_activity("Object created: oProfileIndex ["+this.pid+"] config_hash ["+this.config_hash+"]");

}

function clearProfileLoadLck(){

	objectArrayProfileOverlay_cnt = 0;
	profileLoadLck['mini'] = 0;
	profileLoadLck['full'] = 0;
}

function generate_cachebust(){
	//https://gist.github.com/6174/6062387
	//http://stackoverflow.com/questions/105034/how-to-create-a-guid-uuid-in-javascript
	$('#cache_bust').html(Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15));
}
