/*
// J5
// Code is Poetry */

//
// lowly JavaScript Document
var JONY5_TTL_SOCIAL_NAV = 5;
var JONY5_TTL_BANNER_LIFESTYLE = 15;        // http://jony5.com/_crnrstn/soa/?wsdl
var JONY5_TTL_BASSDRIVE_STATS_SYNC = 5;     // http://jony5.com/_crnrstn/soa/?wsdl

var ajax_root;
var animation_mgmt_array = [];
var social_lnk_timeout_in;


// 0 = OFF. 1 = ON/visible. 2 = IN FLUX.
animation_mgmt_array['social_nav'] = 0;

//
// INIT TIMER AND STATE CONTROLLER
baseHeartBeat = setTimeout( "syncTimerState()", 1000 );
clearTimeout(baseHeartBeat);


//
// OBJECT CONTROLLER
var log_controller = 1;   // [0=off|1=on]
var activity_log_FLAG;

//
// INITIALIZE
$.when(
    //$.getJSON( "ajax/test.json" ),
    $.ready
).done(function( ) {

    // Document is ready.
    // Value of test.json can be passed in as `data`.
    //
    //log_activity("DOM ready.");
    ajax_root = $('#ajax_root').html();
    
    //
    // SYNC UI COMPONENTS
    sync_ui_state();
    
    //
    // startHeartbeats();
    //
    // $( "#body_wrapper" ).click(function() {
    //
    //     clearSearchAjaxResults();
    //
    // });
    //
    // $('.sidenav_sub_sub_li').each(function (index) {
    //
    //     $(this).mouseover(function() {
    //
    //         $(this).animate({
    //             backgroundColor:"#FF6A6A"
    //         }, {
    //             duration: 100,
    //             queue: false,
    //             specialEasing: {
    //                 backgroundColor: "swing",
    //                 color: "swing"
    //             },
    //             step: function( now, fx ) {
    //
    //             },
    //             complete: function () {
    //
    //             }
    //         });
    //
    //         $(this).children().css('color', '#FFF !important');
    //
    //     });
    //
    //     $(this).mouseout(function() {
    //
    //         $(this).animate({
    //             backgroundColor:"#E3E5EE"
    //         }, {
    //             duration: 300,
    //             queue: false,
    //             specialEasing: {
    //                 backgroundColor: "linear"
    //             },
    //             step: function( now, fx ) {
    //
    //             },
    //             complete: function () {
    //
    //
    //             }
    //         });
    //
    //         $(this).children().css('color', '#333 !important');
    //
    //     });
    //
    // });

});

function sync_ui_state() {

    //
    // KEEP TIGHT, THE TWO PILLARS
    $('#bg_effect_boaz').height($('#body_shell').height());
    $('#bg_effect_jachin').height($('#body_shell').height());


}

function mouse_out_social_lnk_array(element) {

    var pos = $(element).position();

    //alert(pos.left);
    if(pos.left < -110 ){

        social_lnk_hide(element);

    }

}

function mouse_over_social_lnk_array(element){

    var pos = $(element).position();

    if($('#body_shell').width() < 1301){

        if(pos.left > -12 ){
            animation_mgmt_array['social_nav'] = 2;
            //element.morph('left:-120;', {duration: 0.3});
            social_lnk_show(element);

            social_lnk_timeout_in = JONY5_TTL_SOCIAL_NAV;

        }

    }

}

function social_lnk_hide(element){

    if(animation_mgmt_array['social_nav'] < 2){

        $(element).animate({
            left: "-10"
        }, {
            duration: 100,
            queue: false,
            specialEasing: {
                left: "swing"
            },
            step: function( now, fx ) {

            },
            complete: function () {

                $(element).css('border', '2px solid #FFF');

            }
        });

    }

}

function social_lnk_show(element){

    $(element).css('border', '2px solid #CCC');

    $(element).animate({
        left: "-120",
    }, {
        duration: 500,
        queue: false,
        specialEasing: {
            left: "swing"
        },
        step: function( now, fx ) {

        },
        complete: function () {

            animation_mgmt_array['social_nav'] = 1;

        }
    });

}

function toggle_nav(section_target){

    $('.sidenav_sub_sub_ul').each(function (index) {

        if(this.id != section_target){

            $(this).slideUp( "slow", function() {
                // Animation complete.
            });

        }

    });

    $("#"+section_target).toggle( "slow", function() {
        // Animation complete.
    });

}


function navLinkMouseOver(elem){

    $("#"+elem.id).animate({
        backgroundColor:"#FF6A6A",
        color:"#FFF"
    }, {
        duration: 100,
        queue: false,
        specialEasing: {
            backgroundColor: "swing"
        },
        step: function( now, fx ) {

        },
        complete: function () {

            animation_mgmt_array['social_nav'] = 1;

        }
    });

}

function navLinkMouseOut(elem){

    $("#"+elem.id).animate({
        backgroundColor:"#E3E5EE",
        color:"#333"
    }, {
        duration: 1000,
        queue: false,
        specialEasing: {
            backgroundColor: "linear"
        },
        step: function( now, fx ) {

        },
        complete: function () {


        }
    });
}


function clearSearchAjaxResults(){

    $('#s_results').html('');

}

function searchAutoSuggest(){

    var ugc_str = $('#t').val();

    if(ugc_str!=undefined){

        if(ugc_str.length>2 && ugc_str!=ugc_str_ajaxed){

            ugc_str_ajaxed = ugc_str;

            //
            // AJAX SUBMIT
            var data = $("#s").serializeArray();
            var uri = ajax_root + "search/ajax/";

            $.ajax({
                type: "POST",
                url: uri,
                data: data,
                success: processAJAXSearchResults,
                dataType: "html"
            });
        }
    }
}

function searchBtnMouseOver(elem){

    $("#"+elem.id).animate({
        backgroundColor:"#FF6A6A",
        color:"#FFFFFF"
    }, {
        duration: 100,
        queue: false,
        specialEasing: {
            backgroundColor: "swing"
        },
        step: function( now, fx ) {

        },
        complete: function () {

        }
    });

}

function searchBtnMouseOut(elem){

    $("#"+elem.id).animate({
        backgroundColor:"#F91628",
        color:"#E0E0E0"
    }, {
        duration: 1000,
        queue: false,
        specialEasing: {
            backgroundColor: "linear"
        },
        step: function( now, fx ) {

        },
        complete: function () {


        }
    });
}

function ajax_search_result(elem_id, mode){

    switch(mode){
        case 'mouseover':

            var result_bgcolor = '#FDD9DC';
            var result_copycolor = '#3C3C3C';
            var transition_duration = 100;

            break;
        default:

            //
            // MOUSE OUT
            var result_bgcolor = '#FAFAFA';
            var result_copycolor = '#636363';
            var transition_duration = 500;

            break;
    }

    //console.log('132 main js - '+mode+' '+elem_id + ' start now...');

    $(elem_id).animate({
        backgroundColor: result_bgcolor,
        color: result_copycolor
    }, {
        duration: transition_duration,
        queue: false,
        specialEasing: {
            backgroundColor: "linear"
        },
        step: function( now, fx ) {

        },
        complete: function () {
            //console.log('147 main js - '+mode+' '+elem_id + ' finished now...');
        }
    });

}

function processAJAXSearchResults(data){

    $('#s_results').html(data);
    //console.log('163 processAJAXSearchResults() - onSuccess Fires ME. data=['+data+']');

}

function loadPage(uri){
    //alert('Go to ' + uri);
    window.location = uri;

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
    clearTimeout(baseHeartBeat);
    baseHeartBeat = setInterval("syncTimerState()",1000);

    log_activity("1 sec interval heartbeat started.");

}

//
// SOURCE :: https://joe-riggs.com/blog/2012/05/javascript-count-up-timer-with-hours-minutes-second-hours-minutes/
// AUTHOR :: https://joe-riggs.com/blog/author/jriggs/
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

            if($("#timer_copy").length){

                $("#timer_copy").html(hour +":" + plz(mins) + ":" + plz(secs));
            }

            searchAutoSuggest();

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
                //var objLOGDiv = document.createElement('div');
                //objLOGDiv.setAttribute('class', 'log_entry');
                //$("#activity_log_output").prepend(objLOGDiv);

                //
                // CLEAN STRING FOR HTML
                // &lt;profile&gt;
                //str_clean = htmlEntities(str);

                //objLOGDiv.innerHTML = timeStampInMs + ' (' + walltime + ') :: ' + str_clean;
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

function generate_cachebust(){
    //https://gist.github.com/6174/6062387
    //http://stackoverflow.com/questions/105034/how-to-create-a-guid-uuid-in-javascript
    $('#cache_bust').html(Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15));
}
