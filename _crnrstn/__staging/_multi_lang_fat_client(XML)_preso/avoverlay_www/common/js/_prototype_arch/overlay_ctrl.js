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
// INITIALIZE
Event.observe(window, 'load', initGlobal, false);

//
// OBJECT CONTROLLER
var total_index_invalid = 0;
var delay_initial_copy_onload = true;
var forced_endpoint_update_BOOL = false;
var overlay_FULL_hold_opacity_at_zero = false;
var overlay_FULL_visible_state = 'showall';  // hidecopy, hideall
var langPack_FULL_rotationLock_BOOL = true;
var langPack_Mini_rotationLock_BOOL = true;
var langPack_Mini_curr_langID = 'en';
var langPack_FULL_curr_langID = 'en';
var langPack_FULL_curr_langID_INDEX = 0;
var langPack_FULL_Count_langID = 0;
var langPack_MINI_Count_langID = 0;
var langPack_MINI_COPY_ORIG_TOGGLE = 'orig';
var langPack_Mini_langID_ARRAY = new Array();
var langPack_FULL_langID_ARRAY = new Array();
var langPack_rotation_interval_FULL = 20;
var langPack_rotation_interval_MINI = 20
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

profileLoadLck['mini'] = 0;
profileLoadLck['full'] = 0;

function initGlobal(){

	urlbase =  $('ajax_root').innerHTML;
	new Effect.Appear('right_gate_fade', { duration: 0.0, from: 0.0, to: 0.0, afterFinish: function(){

		}  });

	new Effect.Appear('left_gate_fade', { duration: 0.0, from: 0.0, to: 0.0, afterFinish: function(){

		}  });

    new Effect.Appear('mini_overlay_handle', { duration: 0.0, from: 0.0, to: 0.0, afterFinish: function(){

        }  });

	loadDemoBg();

	//
	// START HEARTBEATS
	startHeartbeats();

	//
    // GRAB XML IMMEDIATELY
    syncProfileStateXML();
}

function loadDemoBg(){

	if($('demo_bg_img').innerHTML!=""){
		document.body.style.backgroundImage = "url('"+urlbase+"common/imgs/overlay_OBS_demo_bg.jpg')";
		document.body.style.backgroundRepeat = "no-repeat";
		document.body.style.backgroundColor = "#0057F6";

	}

}

function startHeartbeats(){

	//
	// TIMER SEC INTERVAL
	clearTimeout(miniOverlayTimer);
	miniOverlayTimer = setInterval("syncTimerState()",1000);

	clearTimeout(langPackRotate);
	langPackRotate = setInterval( "rotateLangPackActiveOverlay()", 2000 );

	//if($('test_mode')){
		//
		// AJAX SYNC INTERVAL - X SECS
		// FOR IMPLEMENTATION OF TIMER AND COPY UPDATES
		//timer_sync = setInterval(overlay_sync,5000);
		syncOverlayState();

	//}
}

function rotateLangPackActiveOverlay(){

	//
	// SETINTERVAL INTIALIZED AT 2 SECS...
	langPack_rotation_interval_cnt = langPack_rotation_interval_cnt + 2;
	tmp_auth_rotate = 0;
	tmp_curr_active = 5;
	tmp_curr_active_FULL = 5;
	tmp_mini_lang_loop_size = langPack_Mini_langID_ARRAY.length;
	tmp_full_lang_loop_size = langPack_FULL_langID_ARRAY.length;

	//
	// FADE OUT ALL DYNAMIC COPY OVERLAY [ON COMPLETE, SET TO LEFT:0]
	if(langPack_rotation_interval_cnt > langPack_rotation_interval){

		tmp_auth_rotate = 1;
		langPack_rotation_interval_cnt = 0;

	}else{

		if($('lang_pack_rotate_lock').innerHTML!='ON'){

			tmp_auth_rotate = 1;

		}

	}

	if(tmp_auth_rotate==1){

		//
		// SILENCE THE ACTIVE - MINI
		//if(tmp_mini_lang_loop_size>1) {
			for (i = 0; i < tmp_mini_lang_loop_size; i++) {

				if (langPack_Mini_langID_ARRAY[i] == langPack_Mini_curr_langID) {

					//
					// THIS IS ACTIVE...OR JUST WAS...SILENCE...
					langPackTransition('hideandreset', langPack_Mini_curr_langID, 'mini');

					tmp_curr_active = i;

				}

			}
		//}

		tmp_full_active_silenced = 0;
		langPack_FULL_Count_langID = tmp_full_lang_loop_size;

		if(tmp_full_lang_loop_size>1) {
			//
			// SILENCE THE ACTIVE - FULL
			for (i = 0; i < tmp_full_lang_loop_size; i++) {

				if (langPack_FULL_langID_ARRAY[i] == langPack_FULL_curr_langID && tmp_full_active_silenced == 0 && overlay_FULL_visible_state == 'showall') {

					//
					// THIS IS ACTIVE...OR JUST WAS...SILENCE...
					langPackTransition('hideandreset', langPack_FULL_curr_langID, 'full');

					tmp_curr_active_FULL = i;
					tmp_full_active_silenced = 1;

					//
					// LOAD NEXT LANG PACK - FULL
					if (tmp_curr_active_FULL > (tmp_full_lang_loop_size - 1) || tmp_curr_active_FULL == '3') {

						tmp_next_active = 0;
						langPack_FULL_curr_langID = langPack_FULL_langID_ARRAY[0];
						langPack_FULL_curr_langID_INDEX = 0;

					} else {

						tmp_next_active = tmp_curr_active_FULL + 1;
						langPack_FULL_curr_langID = langPack_FULL_langID_ARRAY[tmp_next_active];
						langPack_FULL_curr_langID_INDEX = tmp_next_active;

					}

					//
					// DELAY FULL "NEXT LANG" PRESENTATION
					$('full_ui_retardation_handle').morph('left:-3200px', {
						duration: 2.5, afterFinish: function () {

							//
							// ACTIVATE NEXT FULL LANG PACK
							langPackTransition('shownext', langPack_FULL_curr_langID, 'full');

							$('full_ui_retardation_handle').morph('left:0px', {
								duration: 0.1, afterFinish: function () {

								}
							});


						}
					});

				}

			}
		}

		//if(tmp_mini_lang_loop_size>1) {
			//
			// LOAD NEXT LANG PACK - MINI
			if (tmp_curr_active > (tmp_mini_lang_loop_size - 1) || tmp_curr_active == '3' || tmp_mini_lang_loop_size==1) {

				tmp_next_active = 0;
				langPack_Mini_curr_langID = langPack_Mini_langID_ARRAY[0];

			} else {

				tmp_next_active = tmp_curr_active + 1;
				langPack_Mini_curr_langID = langPack_Mini_langID_ARRAY[tmp_next_active];

			}

			//
			// DELAY MINI "NEXT LANG" PRESENTATION
			$('ui_retardation_handle').morph('left:-3200px', {
				duration: 10.0, afterFinish: function () {

					//
					// ACTIVATE NEXT MINI LANG PACK
					langPackTransition('shownext', langPack_Mini_curr_langID, 'mini');

					$('ui_retardation_handle').morph('left:0px', {
						duration: 0.0, afterFinish: function () {

						}
					});

				}
			});
		//}
	}

}

function langPackTransition(transition_mode, lang_code, overlay_type){

	switch(overlay_type){
		case 'mini':

			switch(transition_mode){
				case 'hideandreset':
					if($('langpack_mini_copy_' + lang_code)){

						throwLangGates('close');

						if(langPack_MINI_Count_langID==1) {

								if (langPack_MINI_COPY_ORIG_TOGGLE == 'orig') {
									$('langpack_mini_copy_' + lang_code + '_copy').morph('top:-3200px;left:0px;', {duration: 0.0,  afterFinish: function(){
										}  });
									$('langpack_mini_copy_' + lang_code).morph('top:0px;left:0px;', {duration: 0.0,  afterFinish: function(){
										}  });
									new Effect.Appear('langpack_mini_copy_' + lang_code, { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){

											$('langpack_mini_copy_' + lang_code).morph('top:-3200px;left:0px;', {duration: 0.1,  afterFinish: function(){


												}  });

										}  });
								}else{

									if ($('langpack_mini_copy_' + lang_code + '_copy')) {
										$('langpack_mini_copy_' + lang_code).morph('top:-3200px;left:0px;', {duration: 0.0,  afterFinish: function(){
											}  });
										$('langpack_mini_copy_' + lang_code + '_copy').morph('top:0px;left:0px;', {duration: 0.0,  afterFinish: function(){
											}  });
										new Effect.Appear('langpack_mini_copy_' + lang_code + '_copy', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){

												$('langpack_mini_copy_' + lang_code + '_copy').morph('top:-3200px;left:0px;', {duration: 0.1,  afterFinish: function(){


													}  });

											}  });

									}

								}

						}else{
							$('langpack_mini_copy_' + lang_code).morph('top:0px;left:0px;', {duration: 0.0,  afterFinish: function(){
								}  });
							new Effect.Appear('langpack_mini_copy_' + lang_code, { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){

									//$('langpack_mini_copy_' + lang_code).style.top = "-3200px";
									$('langpack_mini_copy_' + lang_code).morph('top:-3200px;left:0px;', {duration: 0.1,  afterFinish: function(){


										}  });

								}  });

						}

					}

				break;
				case 'shownext':

					langPack_Mini_rotationLock_BOOL = true;

					if(langPack_MINI_Count_langID==1){

						if($('langpack_mini_copy_' + lang_code+'_copy')){

							if(langPack_MINI_COPY_ORIG_TOGGLE=='orig'){
								//
								// DO COPY DIV
								langPack_MINI_COPY_ORIG_TOGGLE = 'copy';
								$('langpack_mini_copy_' + lang_code+'_copy').morph('left:0px; top:0px; opacity: 1.0;', {
									duration: 0.0, afterFinish: function () {

										throwLangGates('open');

										$('langpack_mini_copy_' + lang_code+'_copy').morph('left:-3200px', {
											duration: 55.0, afterFinish: function () {


											}
										});

									}
								});

							}else{
								//
								// DO ORIG DIV
								langPack_MINI_COPY_ORIG_TOGGLE = 'orig';
								$('langpack_mini_copy_' + lang_code).morph('left:0px; top:0px; opacity: 1.0;', {
									duration: 0.0, afterFinish: function () {

										throwLangGates('open');

										$('langpack_mini_copy_' + lang_code).morph('left:-3200px', {
											duration: 55.0, afterFinish: function () {

											}
										});

									}
								});
							}

						}else{

							tmp_profile_cnt = profileOverlayARRAY.length;
							for(i=0;i<tmp_profile_cnt;i++) {

								switch (profileOverlayARRAY[i].type) {
									case 'mini':

										//
										// GRIP DATA
										var tmp_lang_id = profileOverlayARRAY[i].lang_pack_translations.lang_id[0];
										var tmp_message_title = profileOverlayARRAY[i].lang_pack_translations.copy_m_title[0];
										var tmp_message_meta = profileOverlayARRAY[i].lang_pack_translations.copy_m_message[0];
										var tmp_conference_title = profileOverlayARRAY[i].lang_pack_translations.copy_m_conference[0];
										var tmp_date = profileOverlayARRAY[i].lang_pack_translations.copy_m_date[0];

										var tmp_copy_m_scroll_speed = profileOverlayARRAY[i].lang_pack_translations.copy_m_scroll_speed[0];
										var tmp_copy_m_scroll_direction = profileOverlayARRAY[i].lang_pack_translations.copy_m_scroll_direction[0];
										var tmp_copy_m_font_size_percentage = profileOverlayARRAY[i].lang_pack_translations.copy_m_font_size_percentage[0];
										var tmp_copy_m_padding_top_px = profileOverlayARRAY[i].lang_pack_translations.copy_m_padding_top_px[0];
										var tmp_cleartext_endpoint = profileOverlayARRAY[i].lang_pack_translations.cleartext_endpoint[0];
										var tmp_copy_hash = profileOverlayARRAY[i].lang_pack_translations.copy_hash[0];

										break;
								}
							}

							//
							// WE HAVE ONE COPY CONTAINER...PROBABLY STILL IN FLUX. COPY COPY TO NEW SHELL, POSITION, AND TRANSITION.
							if ($('langpack_mini_copy_' + lang_code)) {
								//
								// CREATE NEW DOM ELEMENT
								var objUIMitigator = $('scroll_extension_ui_mitigator');
								var objLangPack = document.createElement('div');
								objLangPack.setAttribute('id', 'langpack_mini_copy_' + tmp_lang_id+'_copy');
								objLangPack.setAttribute('class', 'mini_content_wrapper_scroll_content');
								objUIMitigator.appendChild(objLangPack);

								objLangPack.innerHTML = '<div class="message_meta">[COPY]</div>' + $('langpack_mini_copy_' + lang_code).innerHTML;

								//
								// APPLY LANG PROFILE SETTINGS TO NEW PACK WRAPPER WITH FRESH CONTENT
								applyLangPackStyles_MINI('mini', objLangPack, tmp_copy_m_scroll_speed,tmp_copy_m_scroll_direction,tmp_copy_m_font_size_percentage,tmp_copy_m_padding_top_px,tmp_cleartext_endpoint,tmp_copy_hash);

								$('langpack_mini_copy_' + tmp_lang_id).morph('left:0px; top:0px; opacity: 1.0;', {
									duration: 0.0, afterFinish: function () {

										throwLangGates('open');

										$('langpack_mini_copy_' + tmp_lang_id).morph('left:-3200px', {
											duration: 55.0, afterFinish: function () {


											}
										});

									}
								});


							} else {
								langPack_Mini_rotationLock_BOOL = false;

							}

						}

					}else {

						if ($('langpack_mini_copy_' + lang_code)) {

							$('langpack_mini_copy_' + lang_code).morph('left:0px; top:0px; opacity: 1.0;', {
								duration: 0.0, afterFinish: function () {

									throwLangGates('open');

									$('langpack_mini_copy_' + lang_code).morph('left:-3200px', {
										duration: 55.0, afterFinish: function () {


										}
									});

								}
							});

						} else {
							langPack_Mini_rotationLock_BOOL = false;

						}
					}
				break;
				case 'shownow':

					langPack_Mini_rotationLock_BOOL = true;
					if($('langpack_mini_copy_' + lang_code)){

						$('langpack_mini_copy_' + lang_code).morph('left:0px; top:0px; opacity: 1.0;', {duration: 0.0,  afterFinish: function(){

							throwLangGates('open');

							$('langpack_mini_copy_' + lang_code).morph('left:-3200px', {duration: 55.0,  afterFinish: function(){


								}  });
							}  });


					}else{
						langPack_Mini_rotationLock_BOOL = false;

					}

				break;

			}

		break;
		case 'full':

			switch(transition_mode){
				case 'hideandreset':
					if($('langpack_full_copy_' + lang_code)){

						new Effect.Appear('langpack_full_copy_' + lang_code, { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){

							}  });

					}

					break;
				case 'shownext':

					langPack_FULL_rotationLock_BOOL = true;

					if($('langpack_full_copy_' + lang_code)){


						new Effect.Appear('langpack_full_copy_' + lang_code, { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){

							}  });

					}else{
						langPack_FULL_rotationLock_BOOL = false;

					}

					break;
				case 'shownow':

					langPack_FULL_rotationLock_BOOL = true;
					if($('langpack_full_copy_' + lang_code)){

						new Effect.Appear('langpack_full_copy_' + lang_code, { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){

							}  });


					}else{
						langPack_FULL_rotationLock_BOOL = false;

					}

					break;

			}

			break;

	}

}

function throwLangGates(state){
	switch(state){
		case 'open':

			new Effect.Appear('right_gate_fade', { duration: 4.0, from: 0.0, to: 1.0, afterFinish: function(){

					new Effect.Appear('left_gate_fade', { duration: 10.0, from: 0.0, to: 1.0, afterFinish: function(){

						}  });
				}  });
		break;
		case 'close':

			new Effect.Appear('right_gate_fade', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){

					new Effect.Appear('left_gate_fade', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){

						}  });
				}  });


		break;

	}

}

function syncOverlayState(){
	clearTimeout(masterOverlaySyncCtrl);
	masterOverlaySyncCtrl = setInterval( "syncProfileStateXML()", 5000 );
}



//
// LOAD INDEX XML
function syncProfileStateXML(){
    objectArrayProfileIndex = 0;
    generate_cachebust();

	var datafile = urlbase + 'social/fellowship/avsvc_overlay/_lib/xml/profile_index.xml';
	var pars = "cache_b=" + $('cache_bust').innerHTML;
	var myAjax_index = new Ajax.Request(
		datafile,
		{
			method: 'get',
			parameters: pars,
			onComplete: parseProfileIndexXML
		});


}

function generate_cachebust(){
    //https://gist.github.com/6174/6062387
    //http://stackoverflow.com/questions/105034/how-to-create-a-guid-uuid-in-javascript
    $('cache_bust').innerHTML = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
}

//
// LOAD PROFILE XML
function syncOverlayStateXML(pos){

    generate_cachebust();

    //
    // RESET PROFILE ARRAY FOR REUSE WITH n+1 PROFILES
    //profileOverlayARRAY = new Array();
    oOverlayProfileDataARRAY = new Array();

	var datafile = profileIndexARRAY[pos].profile_endpoint;
    var pars = "cache_b=" + $('cache_bust').innerHTML;
	myAjax_profile = new Ajax.Request(
		datafile,
		{
			method: 'get',
			parameters: pars,
			onComplete: parseOverlayProfileXML
		});

}


//
// PARSE XML TO OBJECT
//function parseMyXML(originalRequest){
//	var oprofiledata = originalRequest.responseXML.getElementsByTagName("profile");
//	loadprofiles(oprofiledata);
//}

function parseProfileIndexXML(originalRequest){

	clearProfileLoadLck();
	var oProfileIndexData = originalRequest.responseXML.getElementsByTagName("profile");

	//
	// SEND RESPONSE TO XML LOAD CONTROLLER FOR PROFILE INDEX
	loadProfileIndex(oProfileIndexData);

	syncToProfileIndex();
}

function parseOverlayProfileXML(originalRequest){

	oOverlayProfileDataARRAY[overlayProfileData_cnt++] = originalRequest.responseXML.getElementsByTagName("profile");

	loadOverlayProfile(oOverlayProfileDataARRAY);

	syncToProfile();
}

//
// PRIMARY XML LOAD CONTROLLER - INDEX
function loadProfileIndex(oItemNode){
	var i=0;

	//alert('node_len='+oItemNode.length);
	var tmp_len = oItemNode.length;
	for(i; i<tmp_len; i++){
		var oProfile = oItemNode[i];

		var oRequestor_id=oProfile.getElementsByTagName("requestor_id");
		var oPid= oProfile.getElementsByTagName("pid");
		var oConfig_hash= oProfile.getElementsByTagName("config_hash");
		var oProfile_endpoint= oProfile.getElementsByTagName("profile_endpoint");
		var oProfile_endpoint_prod = oProfile.getElementsByTagName("profile_endpoint_prod");
		var oCache_bust= oProfile.getElementsByTagName("cache_bust");
		var oLastmodified= oProfile.getElementsByTagName("lastmodified");

		var requestor_id = oRequestor_id[0];
		var pid = oPid[0];
		var config_hash = oConfig_hash[0];
		var profile_endpoint = oProfile_endpoint[0];
		var profile_endpoint_prod = oProfile_endpoint_prod[0];
		var cache_bust = oCache_bust[0];
		var lastmodified = oLastmodified[0];

		//
		// STORE VALUES FROM XML
		if(requestor_id.childNodes[0]){
			var requestor_id = requestor_id.childNodes[0].nodeValue;
		}else {requestor_id="";}

		if(pid.childNodes[0]){
			var pid=pid.childNodes[0].nodeValue
		}else{ pid=""; }

		if(config_hash.childNodes[0]){
			var config_hash=config_hash.childNodes[0].nodeValue;
		}else {config_hash="";}

		if(profile_endpoint.childNodes[0]){
			var profile_endpoint=profile_endpoint.childNodes[0].nodeValue;
		}else {profile_endpoint="";}

		if(profile_endpoint_prod.childNodes[0]){
			var profile_endpoint_prod=profile_endpoint_prod.childNodes[0].nodeValue;
		}else {profile_endpoint_prod="";}

		if(cache_bust.childNodes[0]){
			var cache_bust=cache_bust.childNodes[0].nodeValue;
		}else {cache_bust="";}

		if(lastmodified.childNodes[0]){
			var lastmodified=lastmodified.childNodes[0].nodeValue;
		}else {lastmodified="";}

		var is_prod = urlbase.indexOf("jony5.com");

		if(is_prod>2){
				profile_endpoint = profile_endpoint_prod;
		}

		//
		// STORE IN OBJECT
		setOverlayProfileIndexObject(requestor_id,pid,config_hash,profile_endpoint,cache_bust,lastmodified);

	}

}

function clearProfileLoadLck(){

    objectArrayProfileOverlay_cnt = 0;
	profileLoadLck['mini'] = 0;
	profileLoadLck['full'] = 0;
}

function loadOverlayProfile(oItemNodeARRAY){
	ii = xml_profile_cnt;
	for(ii;ii<overlayProfileData_cnt; ii++) {
		xml_profile_cnt++;

		oItemNode = oItemNodeARRAY[ii];

		var oProfile = oItemNode[0];

		var oType= oProfile.getElementsByTagName("type");
		var type = oType[0];
		if(type.childNodes[0]){
			var type = type.childNodes[0].nodeValue;
		}else {  }

		if(profileLoadLck[type]==0){
			profileLoadLck[type] = 1;

			switch(type){
				case 'mini':
					var oPid = oProfile.getElementsByTagName("pid");
					var oLastmodified = oProfile.getElementsByTagName("lastmodified");
					var oMaster_overlay_visible_BOOL = oProfile.getElementsByTagName("master_overlay_visible_BOOL");
					var oTimer_overlay_visible_BOOL = oProfile.getElementsByTagName("timer_overlay_visible_BOOL");
					var oCopy_overlay_visible_BOOL = oProfile.getElementsByTagName("copy_overlay_visible_BOOL");
					var oTimer_mode = oProfile.getElementsByTagName("timer_mode");
					var oTimer_override_parameter = oProfile.getElementsByTagName("timer_override_parameter");
					var oTimer_override_transaction_hash = oProfile.getElementsByTagName("timer_override_transaction_hash");
					var oMaster_overlay_display_area_width_in_px = oProfile.getElementsByTagName("master_overlay_display_area_width_in_px");
					var oMaster_overlay_display_area_height_in_px = oProfile.getElementsByTagName("master_overlay_display_area_height_in_px");
					var oContent_area_width_in_px = oProfile.getElementsByTagName("content_area_width_in_px");
					var oTimer_display_area_width_in_px = oProfile.getElementsByTagName("timer_display_area_width_in_px");
					var oTimer_display_area_height_in_px = oProfile.getElementsByTagName("timer_display_area_height_in_px");
					var oCopy_display_area_width_in_px = oProfile.getElementsByTagName("copy_display_area_width_in_px");
					var oCopy_display_area_height_in_px = oProfile.getElementsByTagName("copy_display_area_height_in_px");
					var oMaster_overlay_bgcolor = oProfile.getElementsByTagName("master_overlay_bgcolor");
					var oMaster_overlay_bgopacity = oProfile.getElementsByTagName("master_overlay_bgopacity");
					var oOverlay_copy_color = oProfile.getElementsByTagName("overlay_copy_color");
					var oTimer_copy_color = oProfile.getElementsByTagName("timer_copy_color");
					var oName = oProfile.getElementsByTagName("name");
					var oConfig_hash = oProfile.getElementsByTagName("config_hash");
					var oLang_pack_translations = oProfile.getElementsByTagName("lang_pack_translations");

					var pid = oPid[0];
					var lastmodified = oLastmodified[0];
					var master_overlay_visible_BOOL = oMaster_overlay_visible_BOOL[0];
					var timer_overlay_visible_BOOL = oTimer_overlay_visible_BOOL[0];
					var copy_overlay_visible_BOOL = oCopy_overlay_visible_BOOL[0];
					var timer_mode = oTimer_mode[0];
					var timer_override_parameter = oTimer_override_parameter[0];
					var timer_override_transaction_hash = oTimer_override_transaction_hash[0];
					var master_overlay_display_area_width_in_px = oMaster_overlay_display_area_width_in_px[0];
					var master_overlay_display_area_height_in_px = oMaster_overlay_display_area_height_in_px[0];
					var content_area_width_in_px = oContent_area_width_in_px[0];
					var timer_display_area_width_in_px = oTimer_display_area_width_in_px[0];
					var timer_display_area_height_in_px = oTimer_display_area_height_in_px[0];
					var copy_display_area_width_in_px = oCopy_display_area_width_in_px[0];
					var copy_display_area_height_in_px = oCopy_display_area_height_in_px[0];
					var master_overlay_bgcolor = oMaster_overlay_bgcolor[0];
					var master_overlay_bgopacity = oMaster_overlay_bgopacity[0];
					var overlay_copy_color = oOverlay_copy_color[0];
					var timer_copy_color = oTimer_copy_color[0];
					var name = oName[0];
					var config_hash = oConfig_hash[0];
					var lang_pack_translations = oLang_pack_translations[0];

					//
					// FOR OBJECT CONVERSION
					var temp_profile_param_array = new Array();

					temp_profile_param_array['type'] = type;

					//
					// STORE VALUES FROM XML
					if(pid.childNodes[0]){
						temp_profile_param_array['pid'] = pid.childNodes[0].nodeValue;
					}else {  }

					if(lastmodified.childNodes[0]){
						temp_profile_param_array['lastmodified'] = lastmodified.childNodes[0].nodeValue;
					}else {  }

					if(master_overlay_visible_BOOL.childNodes[0]){
						temp_profile_param_array['master_overlay_visible_BOOL'] = master_overlay_visible_BOOL.childNodes[0].nodeValue;
					}else {  }

					if(timer_overlay_visible_BOOL.childNodes[0]){
						temp_profile_param_array['timer_overlay_visible_BOOL'] = timer_overlay_visible_BOOL.childNodes[0].nodeValue;
					}else {  }

					if(copy_overlay_visible_BOOL.childNodes[0]){
						temp_profile_param_array['copy_overlay_visible_BOOL'] = copy_overlay_visible_BOOL.childNodes[0].nodeValue;
					}else {  }

					if(timer_mode.childNodes[0]){
						temp_profile_param_array['timer_mode'] = timer_mode.childNodes[0].nodeValue;
					}else {  }

					if(timer_override_parameter.childNodes[0]){
						temp_profile_param_array['timer_override_parameter'] = timer_override_parameter.childNodes[0].nodeValue;
					}else {  }

					if(timer_override_transaction_hash.childNodes[0]){
						temp_profile_param_array['timer_override_transaction_hash'] = timer_override_transaction_hash.childNodes[0].nodeValue;
					}else {  }

					if(master_overlay_display_area_width_in_px.childNodes[0]){
						temp_profile_param_array['master_overlay_display_area_width_in_px'] = master_overlay_display_area_width_in_px.childNodes[0].nodeValue;
					}else {  }

					if(master_overlay_display_area_height_in_px.childNodes[0]){
						temp_profile_param_array['master_overlay_display_area_height_in_px'] = master_overlay_display_area_height_in_px.childNodes[0].nodeValue;
					}else {  }

					if(content_area_width_in_px.childNodes[0]){
						temp_profile_param_array['content_area_width_in_px'] = content_area_width_in_px.childNodes[0].nodeValue;
					}else {  }

					if(copy_display_area_width_in_px.childNodes[0]){
						temp_profile_param_array['copy_display_area_width_in_px'] = copy_display_area_width_in_px.childNodes[0].nodeValue;
					}else {  }

					if(copy_display_area_height_in_px.childNodes[0]){
						temp_profile_param_array['copy_display_area_height_in_px'] = copy_display_area_height_in_px.childNodes[0].nodeValue;
					}else {  }

					if(timer_display_area_width_in_px.childNodes[0]){
						temp_profile_param_array['timer_display_area_width_in_px'] = timer_display_area_width_in_px.childNodes[0].nodeValue;
					}else {  }

					if(timer_display_area_height_in_px.childNodes[0]){
						temp_profile_param_array['timer_display_area_height_in_px'] = timer_display_area_height_in_px.childNodes[0].nodeValue;
					}else {  }

					if(master_overlay_bgcolor.childNodes[0]){
						temp_profile_param_array['master_overlay_bgcolor'] = master_overlay_bgcolor.childNodes[0].nodeValue;
					}else {  }

					if(master_overlay_bgopacity.childNodes[0]){
						temp_profile_param_array['master_overlay_bgopacity'] = master_overlay_bgopacity.childNodes[0].nodeValue;
					}else {  }

					if(overlay_copy_color.childNodes[0]){
						temp_profile_param_array['overlay_copy_color'] = overlay_copy_color.childNodes[0].nodeValue;
					}else {  }

					if(timer_copy_color.childNodes[0]){
						temp_profile_param_array['timer_copy_color'] = timer_copy_color.childNodes[0].nodeValue;
					}else {  }

					if(name.childNodes[0]){
						temp_profile_param_array['name'] = name.childNodes[0].nodeValue;
					}else {  }

					if(config_hash.childNodes[0]){
						temp_profile_param_array['config_hash'] = config_hash.childNodes[0].nodeValue;
					}else {  }

					setOverlayProfileComponentObject(temp_profile_param_array, lang_pack_translations);

				break;
				case 'full':

					var oPid = oProfile.getElementsByTagName("pid");
					var oLastmodified = oProfile.getElementsByTagName("lastmodified");
					var oMaster_overlay_visible_BOOL = oProfile.getElementsByTagName("master_overlay_visible_BOOL");
					var oCopy_overlay_visible_BOOL = oProfile.getElementsByTagName("copy_overlay_visible_BOOL");
					var oMaster_overlay_display_area_width_in_px = oProfile.getElementsByTagName("master_overlay_display_area_width_in_px");
					var oMaster_overlay_display_area_height_in_px = oProfile.getElementsByTagName("master_overlay_display_area_height_in_px");
					var oCopy_display_area_width_in_px = oProfile.getElementsByTagName("copy_display_area_width_in_px");
					var oCopy_display_area_height_in_px = oProfile.getElementsByTagName("copy_display_area_height_in_px");
					var oMaster_overlay_bgcolor = oProfile.getElementsByTagName("master_overlay_bgcolor");
					var oMaster_overlay_bgopacity = oProfile.getElementsByTagName("master_overlay_bgopacity");
					var oOverlay_copy_color = oProfile.getElementsByTagName("overlay_copy_color");
					var oName = oProfile.getElementsByTagName("name");
					var oLang_pack_rotation_interval_secs = oProfile.getElementsByTagName("lang_pack_rotation_interval_secs");
					var oConfig_hash = oProfile.getElementsByTagName("config_hash");
					var oLang_pack_translations = oProfile.getElementsByTagName("lang_pack_translations");

					var pid = oPid[0];
					var lastmodified = oLastmodified[0];
					var master_overlay_visible_BOOL = oMaster_overlay_visible_BOOL[0];
					var copy_overlay_visible_BOOL = oCopy_overlay_visible_BOOL[0];
					var master_overlay_display_area_width_in_px = oMaster_overlay_display_area_width_in_px[0];
					var master_overlay_display_area_height_in_px = oMaster_overlay_display_area_height_in_px[0];
					var copy_display_area_width_in_px = oCopy_display_area_width_in_px[0];
					var copy_display_area_height_in_px = oCopy_display_area_height_in_px[0];
					var master_overlay_bgcolor = oMaster_overlay_bgcolor[0];
					var master_overlay_bgopacity = oMaster_overlay_bgopacity[0];
					var overlay_copy_color = oOverlay_copy_color[0];
					var name = oName[0];
					var lang_pack_rotation_interval_secs = oLang_pack_rotation_interval_secs[0];
					var config_hash = oConfig_hash[0];
					var lang_pack_translations = oLang_pack_translations[0];

					//
					// FOR OBJECT CONVERSION
					var temp_profile_param_array = new Array();

					temp_profile_param_array['type'] = type;

					//
					// STORE VALUES FROM XML
					if(pid.childNodes[0]){
						temp_profile_param_array['pid'] = pid.childNodes[0].nodeValue;
					}else {  }

					if(lastmodified.childNodes[0]){
						temp_profile_param_array['lastmodified'] = lastmodified.childNodes[0].nodeValue;
					}else {  }

					if(copy_overlay_visible_BOOL.childNodes[0]){
						temp_profile_param_array['copy_overlay_visible_BOOL'] = copy_overlay_visible_BOOL.childNodes[0].nodeValue;

						if(temp_profile_param_array['master_overlay_visible_BOOL']==='false' || temp_profile_param_array['master_overlay_visible_BOOL']===false){

							overlay_FULL_visible_state = 'hidecopy';
						}

					}else {  }

					if(master_overlay_visible_BOOL.childNodes[0]){
						temp_profile_param_array['master_overlay_visible_BOOL'] = master_overlay_visible_BOOL.childNodes[0].nodeValue;

						if(temp_profile_param_array['master_overlay_visible_BOOL']==='false' || temp_profile_param_array['master_overlay_visible_BOOL']===false){

							overlay_FULL_visible_state = 'hideall';
						}

					}else {  }

					if(master_overlay_display_area_width_in_px.childNodes[0]){
						temp_profile_param_array['master_overlay_display_area_width_in_px'] = master_overlay_display_area_width_in_px.childNodes[0].nodeValue;
					}else {  }

					if(master_overlay_display_area_height_in_px.childNodes[0]){
						temp_profile_param_array['master_overlay_display_area_height_in_px'] = master_overlay_display_area_height_in_px.childNodes[0].nodeValue;
					}else {  }

					if(copy_display_area_width_in_px.childNodes[0]){
						temp_profile_param_array['copy_display_area_width_in_px'] = copy_display_area_width_in_px.childNodes[0].nodeValue;
					}else {  }

					if(copy_display_area_height_in_px.childNodes[0]){
						temp_profile_param_array['copy_display_area_height_in_px'] = copy_display_area_height_in_px.childNodes[0].nodeValue;
					}else {  }

					if(master_overlay_bgcolor.childNodes[0]){
						temp_profile_param_array['master_overlay_bgcolor'] = master_overlay_bgcolor.childNodes[0].nodeValue;
					}else {  }

					if(master_overlay_bgopacity.childNodes[0]){
						temp_profile_param_array['master_overlay_bgopacity'] = master_overlay_bgopacity.childNodes[0].nodeValue;
					}else {  }

					if(overlay_copy_color.childNodes[0]){
						temp_profile_param_array['overlay_copy_color'] = overlay_copy_color.childNodes[0].nodeValue;
					}else {  }

					if(name.childNodes[0]){
						temp_profile_param_array['name'] = name.childNodes[0].nodeValue;
					}else {  }

					if(lang_pack_rotation_interval_secs.childNodes[0]){
						temp_profile_param_array['lang_pack_rotation_interval_secs'] = lang_pack_rotation_interval_secs.childNodes[0].nodeValue;
					}else {  }

					if(config_hash.childNodes[0]){
						temp_profile_param_array['config_hash'] = config_hash.childNodes[0].nodeValue;
					}else {  }

					setOverlayProfileComponentObject(temp_profile_param_array, lang_pack_translations);

				break;

			}
		}
	}
}

function setOverlayProfileComponentObject(paramArray, lang_pack_translations){

	profileOverlayARRAY[objectArrayProfileOverlay_cnt++] = new oProfileOverlay(paramArray, lang_pack_translations);

}

function setOverlayProfileIndexObject(requestor_id,pid,config_hash,profile_endpoint,cache_bust,lastmodified){

	profileIndexARRAY[objectArrayProfileIndex++] = new oProfileIndex(requestor_id,pid,config_hash,profile_endpoint,cache_bust,lastmodified);

}

function oProfileIndex(requestor_id,pid,config_hash,profile_endpoint,cache_bust,lastmodified) {
	this.requestor_id = requestor_id;
	this.pid = pid;
	this.config_hash = config_hash;
	this.profile_endpoint = profile_endpoint;
	this.cache_bust = cache_bust;
	this.lastmodified = lastmodified;

}

//
// TREAT THIS OBJECT AS A REAL-TIME MIRROR OF THE OVERLAY...EFFECTIVELY MAKING THIS THE UI CONTROLLER UPON IT'S INSTANTIATION
function oProfileOverlay(paramArray, oLang_pack_translations){
	this.type = paramArray['type'];

	switch(this.type){
		case 'mini':
			this.pid = paramArray['pid'];
			this.lastmodified = paramArray['lastmodified'];
			this.master_overlay_visible_BOOL = paramArray['master_overlay_visible_BOOL'];
			this.timer_overlay_visible_BOOL = paramArray['timer_overlay_visible_BOOL'];
			this.copy_overlay_visible_BOOL = paramArray['copy_overlay_visible_BOOL'];
			this.timer_mode = paramArray['timer_mode'];
			this.timer_override_parameter = paramArray['timer_override_parameter'];
			this.timer_override_transaction_hash = paramArray['timer_override_transaction_hash'];
			this.master_overlay_display_area_width_in_px = paramArray['master_overlay_display_area_width_in_px'];
			this.master_overlay_display_area_height_in_px = paramArray['master_overlay_display_area_height_in_px'];
			this.content_area_width_in_px = paramArray['content_area_width_in_px'];
			this.timer_display_area_width_in_px = paramArray['timer_display_area_width_in_px'];
			this.timer_display_area_height_in_px = paramArray['timer_display_area_height_in_px'];
			this.copy_display_area_width_in_px = paramArray['copy_display_area_width_in_px'];
			this.copy_display_area_height_in_px = paramArray['copy_display_area_height_in_px'];
			this.master_overlay_bgcolor = paramArray['master_overlay_bgcolor'];
			this.master_overlay_bgopacity = paramArray['master_overlay_bgopacity'];
			this.overlay_copy_color = paramArray['overlay_copy_color'];
			this.timer_copy_color = paramArray['timer_copy_color'];
			this.name = paramArray['name'];
			this.config_hash = paramArray['config_hash'];

			//
			// APPLY UI CSS
			applyOverlayUICSS(this);

			tmp_elemid = 'config_hash_'+this.pid;
			tmp_elemval = this.config_hash;
			if($(tmp_elemid)){

            }else{

                objFlagDataContainer = $('overlay_dyn_flags_container');
                var objFlagDiv = document.createElement('div');
                objFlagDiv.setAttribute('id', tmp_elemid);
                objFlagDiv.setAttribute('class','hidden');
                objFlagDataContainer.appendChild(objFlagDiv);
                objFlagDiv.innerHTML = tmp_elemval;

            }

			//
            // APPLY HIGH LEVEL UI DELTAS FROM REALITY
            //this.master_overlay_visible_BOOL = paramArray['master_overlay_visible_BOOL'];
            //this.timer_overlay_visible_BOOL = paramArray['timer_overlay_visible_BOOL'];
            //this.copy_overlay_visible_BOOL = paramArray['copy_overlay_visible_BOOL'];
            var curr_master_overlay_visible = $('mov').innerHTML;
            var curr_timer_overlay_visible = $('tov').innerHTML;
            var curr_copy_overlay_visible = $('cov').innerHTML;

            $('mov').innerHTML = this.master_overlay_visible_BOOL;
            $('tov').innerHTML = this.timer_overlay_visible_BOOL;
            $('cov').innerHTML = this.copy_overlay_visible_BOOL;

            syncVisibilityDeltas(this,curr_master_overlay_visible,curr_timer_overlay_visible,curr_copy_overlay_visible);

            //this.timer_mode = paramArray['timer_mode'];
            //this.timer_override_parameter = paramArray['timer_override_parameter'];
            //this.timer_override_transaction_hash = paramArray['timer_override_transaction_hash'];

            //this.master_overlay_display_area_width_in_px = paramArray['master_overlay_display_area_width_in_px'];
            //this.master_overlay_display_area_height_in_px = paramArray['master_overlay_display_area_height_in_px'];
            //this.timer_display_area_width_in_px = paramArray['timer_display_area_width_in_px'];
            //this.timer_display_area_height_in_px = paramArray['timer_display_area_height_in_px'];
            //this.copy_display_area_width_in_px = paramArray['copy_display_area_width_in_px'];
            //this.copy_display_area_height_in_px = paramArray['copy_display_area_height_in_px'];

			this.lang_pack_translations = new oLangPack(oLang_pack_translations, this.type);

		break;
		case 'full':
			this.pid = paramArray['pid'];
			this.lastmodified = paramArray['lastmodified'];
			this.master_overlay_visible_BOOL = paramArray['master_overlay_visible_BOOL'];
			this.copy_overlay_visible_BOOL = paramArray['copy_overlay_visible_BOOL'];
			this.master_overlay_display_area_width_in_px = paramArray['master_overlay_display_area_width_in_px'];
			this.master_overlay_display_area_height_in_px = paramArray['master_overlay_display_area_height_in_px'];
			this.copy_display_area_width_in_px = paramArray['copy_display_area_width_in_px'];
			this.copy_display_area_height_in_px = paramArray['copy_display_area_height_in_px'];
			this.master_overlay_bgcolor = paramArray['master_overlay_bgcolor'];
			this.master_overlay_bgopacity = paramArray['master_overlay_bgopacity'];
			this.overlay_copy_color = paramArray['overlay_copy_color'];
			this.name = paramArray['name'];
			this.lang_pack_rotation_interval_secs = paramArray['lang_pack_rotation_interval_secs'];
			this.config_hash = paramArray['config_hash'];

			//
			// APPLY UI CSS
			applyOverlayUICSS(this);

            tmp_elemid = 'config_hash_'+this.pid;
            tmp_elemval = this.config_hash;
            if($(tmp_elemid)){
                //$(tmp_elemid).innerHTML = this.config_hash;

            }else{

                objFlagDataContainer = $('overlay_dyn_flags_container');
                var objFlagDiv = document.createElement('div');
                objFlagDiv.setAttribute('id', tmp_elemid);
                objFlagDiv.setAttribute('class','hidden');
                objFlagDataContainer.appendChild(objFlagDiv);
                objFlagDiv.innerHTML = tmp_elemval;

            }

			var curr_master_overlay_visible = $('full_mov').innerHTML;
			var curr_copy_overlay_visible = $('full_cov').innerHTML;
			var curr_timer_overlay_visible = 0;

			$('full_mov').innerHTML = this.master_overlay_visible_BOOL;
			$('full_cov').innerHTML = this.copy_overlay_visible_BOOL;

			syncVisibilityDeltas(this,curr_master_overlay_visible,curr_timer_overlay_visible,curr_copy_overlay_visible);

			if(this.master_overlay_visible_BOOL==='true' || this.master_overlay_visible_BOOL===true) {
				//alert('1010 update lang pack - full');
				this.lang_pack_translations = new oLangPack(oLang_pack_translations, this.type)
			}

		break;

	}

}

function applyOverlayUICSS(oProfile){
	tmp_type = oProfile.type;

	switch(tmp_type) {
		case 'mini':

			/*
			*
			seblend_mini_overlay_wrapper
			this.master_overlay_display_area_width_in_px = paramArray['master_overlay_display_area_width_in_px'];
			this.master_overlay_display_area_height_in_px = paramArray['master_overlay_display_area_height_in_px'];
			this.master_overlay_bgcolor = paramArray['master_overlay_bgcolor'];
			this.master_overlay_bgopacity = paramArray['master_overlay_bgopacity'];
			*
			message_time_wrapper
			//this.timer_display_area_width_in_px = paramArray['timer_display_area_width_in_px'];
			//this.timer_display_area_height_in_px = paramArray['timer_display_area_height_in_px'];
			this.timer_copy_color = paramArray['timer_copy_color'];
			*
			scroll_extension_ui_mitigator
			this.copy_display_area_width_in_px = paramArray['copy_display_area_width_in_px'];
			this.copy_display_area_height_in_px = paramArray['copy_display_area_height_in_px'];
			this.overlay_copy_color = paramArray['overlay_copy_color'];
			* */

			tmp_css = 'width:' + oProfile.master_overlay_display_area_width_in_px + 'px;';
			tmp_css = tmp_css + 'height:' + oProfile.master_overlay_display_area_height_in_px + 'px;';
			tmp_css = tmp_css + 'background-color:' + oProfile.master_overlay_bgcolor + ';';
			tmp_css = tmp_css + 'opacity:' + oProfile.master_overlay_bgopacity + ';';

			$('seblend_mini_overlay_wrapper').morph(tmp_css, {duration: 0.0,  afterFinish: function(){
				}  });

			tmp_css = 'width:' + oProfile.content_area_width_in_px + 'px;';
			$('seblend_minioverlay_content_wrapper').morph(tmp_css, {duration: 0.0,  afterFinish: function(){
				}  });

			tmp_css = 'color:' + oProfile.timer_copy_color + ';';

			$('message_time_wrapper').morph(tmp_css, {duration: 0.0,  afterFinish: function(){
			}  });

			var tmp_val = oProfile.copy_display_area_width_in_px;
			tmp_val = tmp_val - 30;
			tmp_css = 'width:' + oProfile.copy_display_area_width_in_px + 'px;';
			tmp_css = tmp_css + 'height:' + oProfile.copy_display_area_height_in_px + 'px;';
			tmp_css = tmp_css + 'color:' + oProfile.overlay_copy_color + ';';

			$('scroll_extension_ui_mitigator').morph(tmp_css, {duration: 0.0,  afterFinish: function(){
				}  });


		break;
		case 'full':

			/*
			*
			this.pid = paramArray['pid'];
			this.lastmodified = paramArray['lastmodified'];
			*
			* main_overlay_handle
			this.master_overlay_visible_BOOL = paramArray['master_overlay_visible_BOOL'];
			this.master_overlay_bgcolor = paramArray['master_overlay_bgcolor'];
			this.master_overlay_bgopacity = paramArray['master_overlay_bgopacity'];
			this.master_overlay_display_area_width_in_px = paramArray['master_overlay_display_area_width_in_px'];
			this.master_overlay_display_area_height_in_px = paramArray['master_overlay_display_area_height_in_px'];
			*
			* overlay_content_shell
			this.copy_overlay_visible_BOOL = paramArray['copy_overlay_visible_BOOL'];
			* this.overlay_copy_color = paramArray['overlay_copy_color'];
			*
			* overlay_content_shell
			this.copy_display_area_width_in_px = paramArray['copy_display_area_width_in_px'];
			this.copy_display_area_height_in_px = paramArray['copy_display_area_height_in_px'];
			*
			* */

			tmp_css = 'width:' + oProfile.master_overlay_display_area_width_in_px + 'px;';
			tmp_css = tmp_css + 'height:' + oProfile.master_overlay_display_area_height_in_px + 'px;';
			tmp_css = tmp_css + 'background-color:' + oProfile.master_overlay_bgcolor + ';';

			if(overlay_FULL_hold_opacity_at_zero == true){
				overlay_FULL_hold_opacity_at_zero = false;

				tmp_opacity = oProfile.master_overlay_bgopacity;

				switch(tmp_opacity){
					case '1.0':
						new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){

							}  });
					break;
					case '0.9':
						new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.0, to: 0.9, afterFinish: function(){

							}  });
						break;
					case '0.8':
						new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.0, to: 0.8, afterFinish: function(){

							}  });
						break;
					case '0.7':
						new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.0, to: 0.7, afterFinish: function(){

							}  });
						break;
					case '0.6':
						new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.0, to: 0.6, afterFinish: function(){

							}  });
						break;
					default:
						new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.0, to: 0.5, afterFinish: function(){

							}  });
						break;

				}


			}else{
				tmp_css = tmp_css + 'opacity:' + oProfile.master_overlay_bgopacity + ';';

			}

			$('main_overlay_handle').morph(tmp_css, {duration: 0.0,  afterFinish: function(){
				}  });

			tmp_css = 'width:' + oProfile.copy_display_area_width_in_px + 'px;';
			tmp_css = tmp_css + 'height:' + oProfile.copy_display_area_height_in_px + 'px;';
			tmp_css = tmp_css + 'color:' + oProfile.overlay_copy_color + ';';

			$('overlay_content_shell').morph(tmp_css, {duration: 0.0,  afterFinish: function(){
				}  });

		break;
	}
}

function showMini(oProfile){
	switch($('mini_state').innerHTML){
		case 'hideovrly_rt':
			$('timer_lck').innerHTML = "OFF";
			$('mini_state').innerHTML = oProfile.timer_mode;
			$('message_time_wrapper').innerHTML = '0:00:00';

			//
			// RESET COPY
			syncToProfile();

			new Effect.Appear('mini_overlay_handle', { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){  }  });

			break;
		case 'hideovrly_pt':

			//
			// UNPAUSE TIMER
			$('timer_lck').innerHTML = "OFF";

			//if($('mini_UI_update_lck').innerHTML == "OFF"){
			//updatOverlayCopy(delim_output, 'mini');
			//$('mini_overlay_handle').style.left = '-80px';
			//alert('1030 updating mini state to new id of '+ novum_mini_state_html+ " and show overlay.");
			$('mini_state').innerHTML = oProfile.timer_mode;
			new Effect.Appear('mini_overlay_handle', { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){  }  });

			//}
			break;
		case 'hideovrly_kt':
			$('mini_state').innerHTML = oProfile.timer_mode;
			new Effect.Appear('mini_overlay_handle', { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){  }  });
			break;
		case 'hidetmr_p':
		case 'hidetmr_r':
			// SHOW TIMER

			//alert ($('timer_UI_update_lck').innerHTML + " --- "+ ole_mini_state_html);
			//if($('timer_UI_update_lck').innerHTML == "OFF"){

				//
				// UNPAUSE TIMER
				$('timer_lck').innerHTML = "OFF";

				timer_UI_update_lock('OFF', 'do nothing');
				//alert('1019 updating mini state to new id of '+ novum_mini_state_html);
				$('mini_state').innerHTML = oProfile.timer_mode;
				if($('mini_state').innerHTML=='hidetmr_r'){
					$('message_time_wrapper').innerHTML = '0:00:00';
				}
				new Effect.Appear('message_time_wrapper', { duration: 1.0, from: 0.0, to: 1.0, afterFinish: function(){ mini_UI_update_lock('OFF'); }  });

			//}

			break;
		case 'hidetmr_k':
			if($('timer_UI_update_lck').innerHTML == "OFF"){

				//
				// UNPAUSE TIMER
				$('timer_lck').innerHTML = "OFF";

				timer_UI_update_lock('OFF', 'do nothing');
				//alert('1019 updating mini state to new id of '+ novum_mini_state_html);
				$('mini_state').innerHTML = oProfile.timer_mode;
				new Effect.Appear('message_time_wrapper', { duration: 1.0, from: 0.0, to: 1.0, afterFinish: function(){ mini_UI_update_lock('OFF'); }  });

			}

			break;
		case 'show_overlay':
			$('timer_lck').innerHTML = "OFF";
			$('mini_state').innerHTML = oProfile.timer_mode;
			new Effect.Appear('message_time_wrapper', { duration: 1.0, from: 0.0, to: 1.0, afterFinish: function(){ mini_UI_update_lock('OFF'); }  });

			break;

	}

}

function hideMini(oProfile){
	switch(oProfile.timer_mode){
		case 'hideovrly_rt':
			// HIDE OVERLAY RESET TIMER
			if($('mini_UI_update_lck').innerHTML == "OFF"){
				$('timer_lck').innerHTML = "ON";
				//alert('977 updating mini state to new id of '+ novum_mini_state_html);
				$('mini_state').innerHTML = oProfile.timer_mode;
				//new Effect.Appear('mini_overlay_handle', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){ updatOverlayCopy(delim_output, 'mini'); $('mini_overlay_handle').style.left = '-3000px'; }  });
				mini_UI_update_lock('ON');
			}
			break;
		case 'hideovrly_kt':
			// HIDE OVERLAY - KEEP UP WITH TIMER
			//if($('mini_UI_update_lck').innerHTML == "OFF"){
				//alert('987 updating mini state to new id of '+ novum_mini_state_html);
				$('mini_state').innerHTML = oProfile.timer_mode;
				//new Effect.Appear('mini_overlay_handle', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){   }  });
				mini_UI_update_lock('ON');
				//$('mini_overlay_handle').style.left = '-3000px';
			//}else{
			//	new Effect.Appear('mini_overlay_handle', { duration: 0.1, from: 0.0, to: 0.0, afterFinish: function(){ }  });
			//	mini_UI_update_lock('ON');
				//$('mini_overlay_handle').style.left = '-3000px';
			//}
			break;
		case 'hideovrly_pt':
			// HIDE OVERLAY - PAUSE TIMER
			if($('mini_UI_update_lck').innerHTML == "OFF"){
				//alert('1001 updating mini state to new id of '+ novum_mini_state_html);
				$('mini_state').innerHTML = oProfile.timer_mode;
				//new Effect.Appear('mini_overlay_handle', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){ updatOverlayCopy(delim_output, 'mini'); }  });
				$('timer_lck').innerHTML = "ON";
				mini_UI_update_lock('ON');
				//$('mini_overlay_handle').style.left = '-3000px';
			}
			break;
		case 'hidetmr_p':
			//   HIDE TIMER AND PAUSE
			if($('timer_UI_update_lck').innerHTML == "OFF"){
				//alert('965 updating mini state to new id of '+ novum_mini_state_html);
				$('mini_state').innerHTML = oProfile.timer_mode;
				//new Effect.Appear('message_time_wrapper', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){  }  });
				$('timer_lck').innerHTML = "ON";

			}
			break;
		case 'hidetmr_k':
			//   HIDE TIMER AND KEEP IT GOING
			if($('timer_UI_update_lck').innerHTML == "OFF"){
				//alert('956 updating mini state to new id of '+ novum_mini_state_html);
				$('mini_state').innerHTML = oProfile.timer_mode;
			}

			break;
		case 'hidetmr_r':
			//   HIDE TIMER AND RESET
			if($('timer_UI_update_lck').innerHTML == "OFF"){
				$('timer_lck').innerHTML = "ON";
				//alert('946 updating mini state to new id of '+ novum_mini_state_html);
				$('mini_state').innerHTML = oProfile.timer_mode;
				//new Effect.Appear('message_time_wrapper', { duration: 1.0, from: 1.0, to: 0.0, afterFinish: function(){ timer_UI_update_lock('ON', 'reset_timer');  }  });
				timer_UI_update_lock('ON', 'reset_timer');
			}

			break;

	}


}

function syncVisibilityDeltas(oProfile, curr_master_overlay_visible, curr_timer_overlay_visible, curr_copy_overlay_visible){

    switch(oProfile.type){
        case 'mini':

            if(curr_master_overlay_visible != oProfile.master_overlay_visible_BOOL){

                //
                // APPLY MASTER OVERLAY UPDATES
                if(oProfile.master_overlay_visible_BOOL==='false' || oProfile.master_overlay_visible_BOOL===false){
                    //if($('mini_overlay_handle').visible()){
						tmp_opacity = $('mini_overlay_handle').style.opacity;

					switch(tmp_opacity){
						case '1.0':
							new Effect.Appear('mini_overlay_handle', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){
									hideMini(oProfile);

								}  });
							break;
						case '0.9':
							new Effect.Appear('mini_overlay_handle', { duration: 2.0, from: 0.9, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
							break;
						case '0.8':
							new Effect.Appear('mini_overlay_handle', { duration: 2.0, from: 0.8, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
							break;
						case '0.7':
							new Effect.Appear('mini_overlay_handle', { duration: 2.0, from: 0.7, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
							break;
						case '0.6':
							new Effect.Appear('mini_overlay_handle', { duration: 2.0, from: 0.6, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
							break;
						default:
							new Effect.Appear('mini_overlay_handle', { duration: 2.0, from: 0.5, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
						break;

					}

                    //}
                }else{

					showMini(oProfile);

                }

            }

            if(curr_timer_overlay_visible != oProfile.timer_overlay_visible_BOOL){

                //
                // APPLY TIMER UPDATES
                if(oProfile.timer_overlay_visible_BOOL=='false'){
					tmp_opacity = $('message_time_wrapper').style.opacity;

					switch(tmp_opacity){
						case '1.0':
							new Effect.Appear('message_time_wrapper', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
							break;
						case '0.9':
							new Effect.Appear('message_time_wrapper', { duration: 2.0, from: 0.9, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
							break;
						case '0.8':
							new Effect.Appear('message_time_wrapper', { duration: 2.0, from: 0.8, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
							break;
						case '0.7':
							new Effect.Appear('message_time_wrapper', { duration: 2.0, from: 0.7, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
							break;
						case '0.6':
							new Effect.Appear('message_time_wrapper', { duration: 2.0, from: 0.6, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
							break;
						default:
							new Effect.Appear('message_time_wrapper', { duration: 2.0, from: 0.5, to: 0.0, afterFinish: function(){
									hideMini(oProfile);
								}  });
							break;

					}

                }else{

					showMini(oProfile);

                    //new Effect.Appear('message_time_wrapper', { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){
                    //    }  });

                }
            }

            if(curr_copy_overlay_visible != oProfile.copy_overlay_visible_BOOL){

                //
                // APPLY COPY UPDATES
                if(oProfile.timer_overlay_visible_BOOL=='false'){
					tmp_opacity = $('scroll_extension_ui_mitigator').style.opacity;

					switch(tmp_opacity){
						case '1.0':
							new Effect.Appear('scroll_extension_ui_mitigator', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.9':
							new Effect.Appear('scroll_extension_ui_mitigator', { duration: 2.0, from: 0.9, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.8':
							new Effect.Appear('scroll_extension_ui_mitigator', { duration: 2.0, from: 0.8, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.7':
							new Effect.Appear('scroll_extension_ui_mitigator', { duration: 2.0, from: 0.7, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.6':
							new Effect.Appear('scroll_extension_ui_mitigator', { duration: 2.0, from: 0.6, to: 0.0, afterFinish: function(){

								}  });
							break;
						default:
							new Effect.Appear('scroll_extension_ui_mitigator', { duration: 2.0, from: 0.5, to: 0.0, afterFinish: function(){

								}  });
							break;

					}

                }else{

                    new Effect.Appear('scroll_extension_ui_mitigator', { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){

                        }  });

                }
            }

        break;
        case 'full':
			if(curr_master_overlay_visible != oProfile.master_overlay_visible_BOOL){

				//
				// APPLY MASTER OVERLAY UPDATES
				if(oProfile.master_overlay_visible_BOOL==='false' || oProfile.master_overlay_visible_BOOL===false){

					//
					// EMPTY INNERHTML OF ALL NON-SHOWING LANG PACKS

					//
					// HIDE MAIN OVERLAY
					tmp_opacity = $('main_overlay_handle').style.opacity;
					overlay_FULL_hold_opacity_at_zero = true;

					switch(tmp_opacity){
						case '1.0':
							new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){

								}  });
						break;
						case '0.9':
							new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.9, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.8':
							new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.8, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.7':
							new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.7, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.6':
							new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.6, to: 0.0, afterFinish: function(){

								}  });
							break;
						default:
							new Effect.Appear('main_overlay_handle', { duration: 2.0, from: 0.5, to: 0.0, afterFinish: function(){

								}  });
							break;

					}


				}else{

					//
					//
					//langPackTransition('shownext', langPack_FULL_curr_langID, 'full');
					//if(!($('mini_overlay_handle').visible())){
					tmp_next_active = langPack_FULL_curr_langID_INDEX + 1;

					if(tmp_next_active>(langPack_FULL_Count_langID-1)){
						tmp_next_active = 0;
						langPack_FULL_curr_langID_INDEX = 0;

					}

					langPack_FULL_curr_langID = langPack_FULL_langID_ARRAY[tmp_next_active];

					new Effect.Appear('langpack_full_copy_'+langPack_FULL_curr_langID, { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){

							//langPackTransition('shownext', langPack_FULL_curr_langID, 'full');
						}  });

					//}

				}

			}

			if(curr_copy_overlay_visible != oProfile.copy_overlay_visible_BOOL){

				//
				// APPLY COPY UPDATES
				if(oProfile.copy_overlay_visible_BOOL=='false'){
					tmp_opacity = $('overlay_content').style.opacity;

					switch(tmp_opacity){
						case '1.0':
							new Effect.Appear('overlay_content', { duration: 2.0, from: 1.0, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.9':
							new Effect.Appear('overlay_content', { duration: 2.0, from: 0.9, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.8':
							new Effect.Appear('overlay_content', { duration: 2.0, from: 0.8, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.7':
							new Effect.Appear('overlay_content', { duration: 2.0, from: 0.7, to: 0.0, afterFinish: function(){

								}  });
							break;
						case '0.6':
							new Effect.Appear('overlay_content', { duration: 2.0, from: 0.6, to: 0.0, afterFinish: function(){

								}  });
							break;
						default:
							new Effect.Appear('overlay_content', { duration: 2.0, from: 0.5, to: 0.0, afterFinish: function(){

								}  });
							break;

					}

				}else{

					new Effect.Appear('overlay_content', { duration: 2.0, from: 0.0, to: 1.0, afterFinish: function(){

						}  });

				}
			}
        break;

    }

}

function oLangPack(oLang_pack_translations, type) {

    var oLang_pack = oLang_pack_translations.getElementsByTagName("lang_pack");

    var tmp_lang_loop_size = oLang_pack.length;

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
    var copy_m_padding_top_px_ARRAY = new Array()
    var timer_m_font_size_percentage_ARRAY = new Array();
    var cleartext_endpoint_ARRAY = new Array();
    var copy_hash_ARRAY = new Array();

    //
    // FULL SCREEN PARAMS
    var copy_fullscrn_header_ARRAY = new Array();
    var copy_fullscrn_title_ARRAY = new Array();
    var copy_fullscrn_body_ARRAY = new Array();
    var copy_fullscrn_font_size_percentage_ARRAY = new Array();

    if (type == 'mini') {
		langPack_MINI_Count_langID = tmp_lang_loop_size;
        for (var i = 0; i < tmp_lang_loop_size; i++) {
            var lang_pack = oLang_pack[i];
            var oLang_id = lang_pack.getElementsByTagName("lang_id");
            var lang_id = oLang_id[0];

            langPack_Mini_langID_ARRAY[i] = lang_id.childNodes[0].nodeValue;
        }
    }

	if (type == 'full') {
		for (var i = 0; i < tmp_lang_loop_size; i++) {
			var lang_pack = oLang_pack[i];
			var oLang_id = lang_pack.getElementsByTagName("lang_id");
			var lang_id = oLang_id[0];

			langPack_FULL_langID_ARRAY[i] = lang_id.childNodes[0].nodeValue;
		}
	}

	for(var i=0;i<tmp_lang_loop_size; i++){

		switch(type){
			case 'mini':
				var lang_pack = oLang_pack[i];

				var oLang_id = lang_pack.getElementsByTagName("lang_id");
				var oCopy_m_title = lang_pack.getElementsByTagName("copy_m_title");
				var oCopy_m_message = lang_pack.getElementsByTagName("copy_m_message");
				var oCopy_m_conference = lang_pack.getElementsByTagName("copy_m_conference");
				var oCopy_m_date = lang_pack.getElementsByTagName("copy_m_date");
				var oCopy_m_scroll_speed = lang_pack.getElementsByTagName("copy_m_scroll_speed");
				var oCopy_m_scroll_direction = lang_pack.getElementsByTagName("copy_m_scroll_direction");
				var oCopy_m_font_size_percentage = lang_pack.getElementsByTagName("copy_m_font_size_percentage");
                var oCopy_m_padding_top_px = lang_pack.getElementsByTagName("copy_m_padding_top_px");
				var oTimer_m_font_size_percentage = lang_pack.getElementsByTagName("timer_m_font_size_percentage");
				var oCleartext_endpoint = lang_pack.getElementsByTagName("cleartext_endpoint");
				var oCopy_hash = lang_pack.getElementsByTagName("copy_hash");

				var lang_id = oLang_id[0];
				var copy_m_title = oCopy_m_title[0];
				var copy_m_message = oCopy_m_message[0];
				var copy_m_conference = oCopy_m_conference[0];
				var copy_m_date = oCopy_m_date[0];
				var copy_m_scroll_speed = oCopy_m_scroll_speed[0];
				var copy_m_scroll_direction = oCopy_m_scroll_direction[0];
				var copy_m_font_size_percentage = oCopy_m_font_size_percentage[0];
                var copy_m_padding_top_px = oCopy_m_padding_top_px[0];
				var timer_m_font_size_percentage = oTimer_m_font_size_percentage[0];
				var cleartext_endpoint = oCleartext_endpoint[0];
				var copy_hash = oCopy_hash[0];

				if(lang_id.childNodes[0]){
					lang_id_ARRAY[i] = lang_id.childNodes[0].nodeValue;
				}else {  }

				if(copy_m_title.childNodes[0]){
					copy_m_title_ARRAY[i] = copy_m_title.childNodes[0].nodeValue;
				}else {  }

				if(copy_m_message.childNodes[0]){
					copy_m_message_ARRAY[i] = copy_m_message.childNodes[0].nodeValue;
				}else {  }

				if(copy_m_conference.childNodes[0]){
					copy_m_conference_ARRAY[i] = copy_m_conference.childNodes[0].nodeValue;
				}else {  }

				if(copy_m_date.childNodes[0]){
					copy_m_date_ARRAY[i] = copy_m_date.childNodes[0].nodeValue;
				}else {  }

				if(copy_m_scroll_speed.childNodes[0]){
					copy_m_scroll_speed_ARRAY[i] = copy_m_scroll_speed.childNodes[0].nodeValue;
				}else {  }

				if(copy_m_scroll_direction.childNodes[0]){
					copy_m_scroll_direction_ARRAY[i] = copy_m_scroll_direction.childNodes[0].nodeValue;
				}else {  }

				if(copy_m_font_size_percentage.childNodes[0]){
					copy_m_font_size_percentage_ARRAY[i] = copy_m_font_size_percentage.childNodes[0].nodeValue;
				}else {  }

                if(copy_m_padding_top_px.childNodes[0]){
                    copy_m_padding_top_px_ARRAY[i] = copy_m_padding_top_px.childNodes[0].nodeValue;
                }else {  }

				if(timer_m_font_size_percentage.childNodes[0]){
					timer_m_font_size_percentage_ARRAY[i] = timer_m_font_size_percentage.childNodes[0].nodeValue;
				}else {  }

				if(cleartext_endpoint.childNodes[0]){
					cleartext_endpoint_ARRAY[i] = cleartext_endpoint.childNodes[0].nodeValue;
				}else {  }

				if(copy_hash.childNodes[0]){
					copy_hash_ARRAY[i] = copy_hash.childNodes[0].nodeValue;
				}else {  }

				type_ARRAY[i] = type;
                //langPack_Mini_langID_ARRAY[i] = lang_id_ARRAY[i];

				this.type = type_ARRAY;
				this.lang_id = lang_id_ARRAY;
				this.copy_m_title = copy_m_title_ARRAY;
				this.copy_m_message = copy_m_message_ARRAY;
				this.copy_m_conference = copy_m_conference_ARRAY;
				this.copy_m_date  = copy_m_date_ARRAY;
				this.copy_m_scroll_speed  = copy_m_scroll_speed_ARRAY;
				this.copy_m_scroll_direction = copy_m_scroll_direction_ARRAY;
				this.copy_m_font_size_percentage = copy_m_font_size_percentage_ARRAY;
                this.copy_m_padding_top_px = copy_m_padding_top_px_ARRAY;
				this.timer_m_font_size_percentage = timer_m_font_size_percentage_ARRAY;
				this.cleartext_endpoint  = cleartext_endpoint_ARRAY;
				this.copy_hash = copy_hash_ARRAY;

				break;
			case 'full':
				var lang_pack = oLang_pack[i];

				/*
				* <lang_id>en</lang_id>
                    <copy_fullscrn_header>Southeast Blending Conference April 6-8, 2019 Atlanta, Georgia</copy_fullscrn_header>
                    <copy_fullscrn_title>Conference Schedule</copy_fullscrn_title>
                    <copy_fullscrn_body>[ALL COPY CODE HERE - EN]</copy_fullscrn_body>
                    <copy_fullscrn_font_size_percentage>100</copy_fullscrn_font_size_percentage>
                    <cleartext_endpoint>http://172.16.225.128/jony5/social/fellowship/avsvc_overlay/_lib/xml/_cleartext/?pid=123&amp;amp;type=full&amp;amp;lang_id=en</cleartext_endpoint>
                    <copy_hash>aazwswaQRznxOwlDvFsP</copy_hash>
				* */

				var oLang_id = lang_pack.getElementsByTagName("lang_id");
				var oCopy_fullscrn_header = lang_pack.getElementsByTagName("copy_fullscrn_header");
				var oCopy_fullscrn_title = lang_pack.getElementsByTagName("copy_fullscrn_title");
				var oCopy_fullscrn_body = lang_pack.getElementsByTagName("copy_fullscrn_body");
				var oCopy_fullscrn_font_size_percentage = lang_pack.getElementsByTagName("copy_fullscrn_font_size_percentage");
				var oCleartext_endpoint = lang_pack.getElementsByTagName("cleartext_endpoint");
				var oCopy_hash = lang_pack.getElementsByTagName("copy_hash");

				var lang_id = oLang_id[0];
				var copy_fullscrn_header = oCopy_fullscrn_header[0];
				var copy_fullscrn_title = oCopy_fullscrn_title[0];
				var copy_fullscrn_body = oCopy_fullscrn_body[0];
				var copy_fullscrn_font_size_percentage = oCopy_fullscrn_font_size_percentage[0];
				var cleartext_endpoint = oCleartext_endpoint[0];
				var copy_hash = oCopy_hash[0];

				/*
				* 	var copy_fullscrn_header_ARRAY = new Array();
					var copy_fullscrn_title_ARRAY = new Array();
					var copy_fullscrn_body_ARRAY = new Array();
					var copy_fullscrn_font_size_percentage_ARRAY = new Array();
				* */

				if(lang_id.childNodes[0]){
					lang_id_ARRAY[i] = lang_id.childNodes[0].nodeValue;
				}else {  }

				if(copy_fullscrn_header.childNodes[0]){
					copy_fullscrn_header_ARRAY[i] = copy_fullscrn_header.childNodes[0].nodeValue;
				}else {  }

				if(copy_fullscrn_title.childNodes[0]){
					copy_fullscrn_title_ARRAY[i] = copy_fullscrn_title.childNodes[0].nodeValue;
				}else {  }

				if(copy_fullscrn_body.childNodes[0]){
					copy_fullscrn_body_ARRAY[i] = copy_fullscrn_body.childNodes[0].nodeValue;
				}else {  }

				if(copy_fullscrn_font_size_percentage.childNodes[0]){
					copy_fullscrn_font_size_percentage_ARRAY[i] = copy_fullscrn_font_size_percentage.childNodes[0].nodeValue;
				}else {  }

				if(cleartext_endpoint.childNodes[0]){
					cleartext_endpoint_ARRAY[i] = cleartext_endpoint.childNodes[0].nodeValue;
				}else {  }

				if(copy_hash.childNodes[0]){
					copy_hash_ARRAY[i] = copy_hash.childNodes[0].nodeValue;
				}else {  }

				type_ARRAY[i] = type;

				this.type = type_ARRAY;
				this.lang_id = lang_id_ARRAY;
				this.copy_fullscrn_header = copy_fullscrn_header_ARRAY;
				this.copy_fullscrn_title = copy_fullscrn_title_ARRAY;
				this.copy_fullscrn_body = copy_fullscrn_body_ARRAY;
				this.copy_fullscrn_font_size_percentage  = copy_fullscrn_font_size_percentage_ARRAY;
				this.cleartext_endpoint  = cleartext_endpoint_ARRAY;
				this.copy_hash = copy_hash_ARRAY;

				//alert(copy_fullscrn_header_ARRAY[i]);

				break;

		}

	}

}

function syncToProfileIndex(){

	//alert('XML node cnt in memory = '+profileindexARRAY.length);
    var tmp_watch = 0;
	var tmp_len = profileIndexARRAY.length;
	for(i=0; tmp_watch<tmp_len; i++){

		if(index_modified(i)){

		    //tmp_len = tmp_len - total_index_invalid;


		}else{

			//
			// NO CHANGE REQUESTED.
			//alert('813 no change plz..');

		}

		//alert('check hash for '+profileIndexARRAY[i].profile_endpoint);

	}

	syncDOM_Flags('index', i);

}

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
				case 'mini':

					//
					// LOAD LANG PACK DATA
					langPack_MINI_Count_langID = profileOverlayARRAY[i].lang_pack_translations.lang_id.length;

					for(ii=0; ii<langPack_MINI_Count_langID; ii++){

						//
						// GRIP DATA
						var tmp_lang_id = profileOverlayARRAY[i].lang_pack_translations.lang_id[ii];
						var tmp_message_title = profileOverlayARRAY[i].lang_pack_translations.copy_m_title[ii];
						var tmp_message_meta = profileOverlayARRAY[i].lang_pack_translations.copy_m_message[ii];
						var tmp_conference_title = profileOverlayARRAY[i].lang_pack_translations.copy_m_conference[ii];
						var tmp_date = profileOverlayARRAY[i].lang_pack_translations.copy_m_date[ii];

						var tmp_copy_m_scroll_speed = profileOverlayARRAY[i].lang_pack_translations.copy_m_scroll_speed[ii];
						var tmp_copy_m_scroll_direction = profileOverlayARRAY[i].lang_pack_translations.copy_m_scroll_direction[ii];
						var tmp_copy_m_font_size_percentage = profileOverlayARRAY[i].lang_pack_translations.copy_m_font_size_percentage[ii];
						var tmp_copy_m_padding_top_px = profileOverlayARRAY[i].lang_pack_translations.copy_m_padding_top_px[ii];
						var tmp_cleartext_endpoint = profileOverlayARRAY[i].lang_pack_translations.cleartext_endpoint[ii];
						var tmp_copy_hash = profileOverlayARRAY[i].lang_pack_translations.copy_hash[ii];

						//
						// CREATE CONTAINER DIV FOR LANG PACK DATA
						var objUIMitigator = $('scroll_extension_ui_mitigator');
						var objLangPack = document.createElement('div');
						objLangPack.setAttribute('id', 'langpack_mini_copy_' + tmp_lang_id);
						objLangPack.setAttribute('class', 'mini_content_wrapper_scroll_content');
						objUIMitigator.appendChild(objLangPack);

						//langPack_Mini_langID_ARRAY[ii] = tmp_lang_id;
/*
						tmp_innerHTML = '<div id="msg_title" class="message_title">' + tmp_message_title + '</div>' +
							'<div class="message_meta">' + tmp_message_meta + '</div>' +
							'<div id="conf_title" class="conference_title">' + tmp_conference_title + '</div>' +
							'<div id="conf_date" class="conference_title">' + tmp_date + '</div><div class="lang_pack_buffer">&nbsp;</div>' ;
							*/

						tmp_innerHTML = '<div class="message_meta">' + tmp_message_meta + '</div>' +
							'<div class="message_title">' + tmp_message_title + '</div><div class="conference_title">' + tmp_date + '</div>' +
							'<div class="conference_title">' + tmp_conference_title + '</div>' +
							'<div class="lang_pack_buffer">&nbsp;</div><div class="message_meta">' + tmp_message_meta + '</div><div class="message_title">' + tmp_message_title + '</div>' +
							'<div class="conference_title">' + tmp_date + '</div><div class="conference_title">' + tmp_conference_title + '</div>';

						objLangPack.innerHTML = tmp_innerHTML;

						//
						// APPLY LANG PROFILE SETTINGS TO NEW PACK WRAPPER WITH FRESH CONTENT
						applyLangPackStyles_MINI(profileOverlayARRAY[i].type, objLangPack, tmp_copy_m_scroll_speed,tmp_copy_m_scroll_direction,tmp_copy_m_font_size_percentage,tmp_copy_m_padding_top_px,tmp_cleartext_endpoint,tmp_copy_hash);

						if(tmp_lang_id=='en') {

						//	tmp_pos = i;

						//	langPack_Mini_curr_langID = tmp_lang_id;
						//	langPack_Mini_Profile_with_langID = tmp_pos;

							//
							// UNLOCK LANG PACK DIV ROTATION
							langPack_Mini_rotationLock_BOOL = false;

						}

					}

                    //
                    // ACTIVATE NEXT MINI LANG PACK
                    langPackTransition('shownext', langPack_Mini_curr_langID, 'mini');

				break;
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
						this.copy_fullscrn_body = copy_fullscrn_body_ARRAY;
						this.copy_fullscrn_font_size_percentage  = copy_fullscrn_font_size_percentage_ARRAY;
						this.cleartext_endpoint  = cleartext_endpoint_ARRAY;
						this.copy_hash = copy_hash_ARRAY;
						*/

						//
						// GRIP DATA
						var tmp_lang_id = profileOverlayARRAY[i].lang_pack_translations.lang_id[ii];
						var tmp_copy_fullscrn_header = profileOverlayARRAY[i].lang_pack_translations.copy_fullscrn_header[ii];
						var tmp_copy_fullscrn_title = profileOverlayARRAY[i].lang_pack_translations.copy_fullscrn_title[ii];
						var tmp_copy_fullscrn_body = profileOverlayARRAY[i].lang_pack_translations.copy_fullscrn_body[ii];
						var tmp_copy_fullscrn_font_size_percentage = profileOverlayARRAY[i].lang_pack_translations.copy_fullscrn_font_size_percentage[ii];

						var tmp_cleartext_endpoint = profileOverlayARRAY[i].lang_pack_translations.cleartext_endpoint[ii];
						var tmp_copy_hash = profileOverlayARRAY[i].lang_pack_translations.copy_hash[ii];

						//
						// CREATE CONTAINER DIV FOR LANG PACK DATA
						if($('langpack_full_copy_' + tmp_lang_id)){
							$('langpack_full_copy_' + tmp_lang_id).innerHTML = '';
							var objLangPack = $('langpack_full_copy_' + tmp_lang_id);

						}else{

							var objUIMitigator = $('overlay_content_shell');
							var objLangPack = document.createElement('div');
							objLangPack.setAttribute('id', 'langpack_full_copy_' + tmp_lang_id);
							objLangPack.setAttribute('class', 'overlay_content');
							objUIMitigator.appendChild(objLangPack);
						}

						//
						// HIDE THE NEW DIV
						objLangPack.style.display = "none";

						tmp_innerHTML = '<div class="cb_20"></div><div class="main_copy_header"><h3>' + tmp_copy_fullscrn_header + '</h3></div>' +
							'<div class="cb_30"></div>' +
							'<div class="main_document_title"><h1>' + tmp_copy_fullscrn_title + '</h1></div>' +
							'<div class="cb_15"></div>' +
							'<div class="main_document_body">' + tmp_copy_fullscrn_body + '</div>';

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

					//
					// ACTIVATE NEXT MINI LANG PACK
					langPackTransition('shownext', langPack_FULL_curr_langID, 'full');

				break;

			}

		}

	}

}
			// applyLangPackStyles_MINI(profileOverlayARRAY[i].type, objLangPack, tmp_copy_m_scroll_speed,tmp_copy_m_scroll_direction,tmp_copy_m_font_size_percentage,tmp_cleartext_endpoint,tmp_copy_hash){
function applyLangPackStyles_MINI(overlay_type, objLangPack, scroll_speed,scroll_direction,font_size_percentage, padding_top, cleartext_endpoint,copy_hash){

	//
	// APPLY CSS STYLES  [font_size_percentage,]
	//alert(font_size_percentage+" is a new font percentage...");
	//$(elem_id).style.fontSize = font_size_percentage+"%";
    objLangPack.style.paddingTop = padding_top+"px";
	//objLangPack.morph('padding-top:'+padding_top+'px;', {duration: 0.0,  afterFinish: function(){
    //	}  });

    for(iii=0;iii<2;iii++){
        objLangPack.getElementsByClassName("message_title")[iii].style.fontSize = font_size_percentage+"%";
        objLangPack.getElementsByClassName("conference_title")[iii].style.fontSize = font_size_percentage+"%";
        objLangPack.getElementsByClassName("message_meta")[iii].style.fontSize = font_size_percentage+"%";
    }

	objLangPack.getElementsByClassName("conference_title")[2].style.fontSize = font_size_percentage+"%";

	//
	// APPLY STYLES NECESSARY FOR LEFT TO RIGHT SCROLLING [NEED MORE R&D]
	// scroll_direction

	//
	// PERFORM NECESSARY TASKS TO CUSTOMIZE SCROLL SPEED [NEED MORE R&D]
	// scroll_speed

}

function applyLangPackStyles_FULL(overlay_type, objLangPack, tmp_copy_fullscrn_font_size_percentage, cleartext_endpoint,copy_hash){

	//
	// APPLY CSS STYLES  [font_size_percentage]
	objLangPack.getElementsByClassName("main_copy_header")[0].style.fontSize = tmp_copy_fullscrn_font_size_percentage+"%";
	objLangPack.getElementsByClassName("main_document_title")[0].style.fontSize = tmp_copy_fullscrn_font_size_percentage+"%";
	objLangPack.getElementsByClassName("main_document_body")[0].style.fontSize = tmp_copy_fullscrn_font_size_percentage+"%";

}

function index_modified(pos){

    total_index_invalid = 0;
    tmp_flag = false;
    tmp_pos_expire_FLAG = new Array();
    tmp_pos_expire_FLAG[pos] = '0';
    tmp_hash_elem_id = 'config_hash_'+profileIndexARRAY[pos].pid;
    tmp_hash_elem_val = profileIndexARRAY[pos].config_hash;

    tmp_profile_elem_id = 'profile_endpoint_'+profileIndexARRAY[pos].pid;
    tmp_profile_elem_val = profileIndexARRAY[pos].profile_endpoint;

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

        //
        // AJAX REQUEST [FROM HERE IN THIS LOOP] REFRESH PROFILE FROM ENDPOINT
        if(tmp_pos_expire_FLAG[pos]!='1'){
            syncOverlayStateXML(pos);
        }

    }

    return tmp_flag;

}

function flag_delta_check(type, elem_id, newval){
    //
    // TREAT ANY NEW VALUE AS HANDLED BEFORE RETURN
    if($(elem_id)){

        tmp_curr_val = $(elem_id).innerHTML;

        if(tmp_curr_val==newval){

            return false;

        }else{

            if(type=='profile'){
                forced_endpoint_update_BOOL = true;

            }

            total_index_invalid++;
            $(elem_id).innerHTML = newval;
            return true;
        }

    }else{
        objFlagDataContainer = $('overlay_dyn_flags_container');
        objFlagDiv = document.createElement('div');
        objFlagDiv.setAttribute('id', elem_id);
        objFlagDiv.setAttribute('class','hidden');
        objFlagDataContainer.appendChild(objFlagDiv);
        objFlagDiv.innerHTML = newval;

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

function addOrUpdateFlag(flagID, flagValue){

	if($(flagID)){

		$(flagID).innerHTML = flagValue;

	}else{

		objFlagDataContainer = $('overlay_dyn_flags_container');
		var objFlagDiv = document.createElement('div');

		objFlagDiv.setAttribute('id', flagID);
		objFlagDiv.setAttribute('class','hidden');

		objFlagDataContainer.appendChild(objFlagDiv);

		objFlagDiv.innerHTML = flagValue;

	}

}

function syncTimerState(){

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

function syncMasterState(){

	syncProfileStateXML();

}


//
// GRUNT FUNCTIONS

//
// PARSE XML TO OBJECT
//function parseMyXML(originalRequest){
//	var oprofiledata = originalRequest.responseXML.getElementsByTagName("profile");
//	loadprofiles(oprofiledata);
//}


function showemployees(officeID, deptID){
	var HTMLoutput="";
	for(var i=0;i<employeeprofileARRAY.length; i++){
		if(employeeprofileARRAY[i]){
			var employeeprofile = employeeprofileARRAY[i];
			if((deptID=="0" || employeeprofile.deptid==$("dpt").value) && (officeID=="0" || employeeprofile.office==$("office").value)){
				if(employeeprofile.alias!="0" && employeeprofile.alias!=""){
					var employeename=employeeprofile.firstname+" '"+employeeprofile.alias+"' "+employeeprofile.lastname;
				}else{
					var employeename=employeeprofile.firstname+" "+employeeprofile.lastname;
				}

				var officename=returnoffice(employeeprofile.office);
				var emp_ext=employeeprofile.extension;
				var office_num = returnOfficeNumPrefix(emp_ext);

				HTMLoutput=HTMLoutput+"<div class='profile_shell'>"+
					"<div class='profile_thumb'><img src='imgs/thumbs/"+employeeprofile.thumbnail+"' width='"+employeeprofile.width+"' height='"+employeeprofile.height+"' alt='"+employeeprofile.firstname+"' /></div>"+
					"<div class='profile_data'>"+
					"<div class='profile_name'>"+employeename+"</div>"+
					"<div class='profile_email'><a href='mailto:'"+employeeprofile.email+" target='_blank'>"+employeeprofile.email+"</a></div>"+
					"<div class='profile_title'>"+employeeprofile.position+"</div>"+
					"<div class='profile_dpt'>"+employeeprofile.department+" - "+officename+"</div>"+
					"<div class='profile_ext'>office - <span style='color:#B5B5B5;'>"+office_num+"</span>"+employeeprofile.extension+"</div>"+
					"<div class='profile_mobile'>wireless - "+employeeprofile.mobilenumber+"</div>"+

					"<div class='profile_im'>"+
					"<div class='profile_im_icon'><img src='imgs/y_icon.gif' width='36' height='38' alt='IM' /></div>"+
					"<div class='profile_im_id'><a href='ymsgr:sendim?"+employeeprofile.yahooim+"' style='color:#000000;'>"+employeeprofile.yahooim+"</a></div>"+
					"</div>"+
					"</div>"+
					"</div>";
			}
		}
	}

	$("results").innerHTML=HTMLoutput;


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



function oEmployeeProfile(eid, FirstName, LastName,Email, Alias,Position, Extension,Mobilenumber,Department,Office,Thumbnail,Yahooim,width,height, deptid) {
	this.eid = eid;
	this.firstname = FirstName;
	this.lastname = LastName;
	this.email = Email;
	this.alias = Alias;
	this.position = Position;
	this.extension = Extension;
	this.mobilenumber = Mobilenumber;
	this.department = Department;
	this.office = Office;
	this.thumbnail = Thumbnail;
	this.yahooim = Yahooim;
	this.width = width;
	this.height = height;
	this.deptid = deptid;
}

function setEmployeeProfileObject(Eid, FirstName, LastName,Email, Alias,Position, Extension,Mobilenumber,Department,Office,Thumbnail,Yahooim,width,height, deptid) {
	employeeprofileARRAY[objectArrayProfileIndex++] = new oEmployeeProfile(Eid, FirstName, LastName,Email, Alias,Position, Extension,Mobilenumber,Department,Office,Thumbnail,Yahooim,width,height, deptid);
}


function returnOfficeNumPrefix(mynum){
	var officeNumPrefix="";

	var mylen=mynum.length.toString();
	if(mylen=="4"){

		var i=mynum.charAt(0);

		switch(i){
			case "4":
				officeNumPrefix="678.916.";
				return officeNumPrefix;
				break;
			case "6":
				officeNumPrefix="678.891.";
				return officeNumPrefix;
				break;
		}
	}
	return officeNumPrefix;
}

function returnoffice(officeid){
	officeid=officeid-0;
	switch(officeid){
		case 1:
			return "Moxie ATL";
			break;
		case 2:
			return "Moxie NYC";
			break;
		case 3:
			return "Moxie West";
			break;
		case 4:
			return "ZMS Atlanta";
			break;
		case 5:
			return "Optimedia";
			break;
		default:
			return "Moxie Interactive";
			break;

	}



}

//
// OVERLAY STATE MANAGEMENT FUNCTIONALITY
function prepsearchFilter(){
	clearTimeout(searchfilterTimerId);
	searchfilterTimerId = setTimeout( "filterbySearch()", 600 );
}


function prepsearchFilter(){
	var deptID=$("dpt").value;
	var officeID=$("office").value;
	var filterstring =$("s").value;
	var HTMLoutput="";

	if(filterstring.length>1){
		for(var i=0;i<employeeprofileARRAY.length; i++){
			if(employeeprofileARRAY[i]){
				var employeeprofile = employeeprofileARRAY[i];
				if((deptID=="0" || employeeprofile.deptid==$("dpt").value) && (officeID=="0" || employeeprofile.office==$("office").value)){
					if(employeeprofile.alias!="0" && employeeprofile.alias!=""){
						var employeename=employeeprofile.firstname+" '"+employeeprofile.alias+"' "+employeeprofile.lastname;
					}else{
						var employeename=employeeprofile.firstname+" "+employeeprofile.lastname;
					}

					filterstring=filterstring.toLowerCase();
					var employeename_chk=employeename.toLowerCase();
					var employeeprofile_email_chk=employeeprofile.email.toLowerCase();
					var employeeprofile_position_chk=employeeprofile.position.toLowerCase();
					var employeeprofile_yahooim_chk=employeeprofile.yahooim.toLowerCase();
					var emp_ext=employeeprofile.extension;
					var office_num = returnOfficeNumPrefix(emp_ext);

					if(employeename_chk.indexOf(filterstring)>-1 || employeeprofile_email_chk.indexOf(filterstring)>-1 || employeeprofile_position_chk.indexOf(filterstring)>-1 || employeeprofile.extension.indexOf(filterstring)>-1 || employeeprofile_yahooim_chk.indexOf(filterstring)>-1 ){

						var officename=returnoffice(employeeprofile.office);

						HTMLoutput=HTMLoutput+"<div class='profile_shell'>"+
							"<div class='profile_thumb'><img src='imgs/thumbs/"+employeeprofile.thumbnail+"' width='"+employeeprofile.width+"' height='"+employeeprofile.height+"' alt='"+employeeprofile.firstname+"' /></div>"+
							"<div class='profile_data'>"+
							"<div class='profile_name'>"+employeename+"</div>"+
							"<div class='profile_email'><a href='mailto:'"+employeeprofile.email+" target='_blank'>"+employeeprofile.email+"</a></div>"+
							"<div class='profile_title'>"+employeeprofile.position+"</div>"+
							"<div class='profile_dpt'>"+employeeprofile.department+" - "+officename+"</div>"+
							"<div class='profile_ext'>office - <span style='color:#B5B5B5;'>"+office_num+"</span>"+employeeprofile.extension+"</div>"+
							"<div class='profile_mobile'>wireless - "+employeeprofile.mobilenumber+"</div>"+

							"<div class='profile_im'>"+
							"<div class='profile_im_icon'><img src='imgs/y_icon.gif' width='36' height='38' alt='IM' /></div>"+
							"<div class='profile_im_id'><a href='ymsgr:sendim?"+employeeprofile.yahooim+"'  style='color:#000000;'>"+employeeprofile.yahooim+"</a></div>"+
							"</div>"+
							"</div>"+
							"</div>";
					}
				}
			}
		}

		$("results").innerHTML=HTMLoutput;
	}else{

		showemployees($("office").value,$("dpt").value);
	}
}

function launch_help(){
	window.open('help.html','helpwindow','scrollbars=no,width=515,height=600,resizable=no');

}

