	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php echo $oUSER->getLangElem('SITE_TITLE'); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>favicon.ico" />
    <link rel="icon" type="image/x-icon" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>favicon.ico" />
	<link rel="stylesheet" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5.min.css">

    <link rel="stylesheet" href="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/css/main.mobi.css">
    <script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/js/_lib/frameworks/jquery_mobi/jquery.js"></script>
	<!--<script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/js/_lib/frameworks/jquery/3.4.1/jquery-3.4.1.min.js"></script>-->
	<script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/js/_lib/frameworks/jquery_mobi/index.js"></script>
    <script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5.min.js"></script>

    <style>
        .ui-header .ui-title { /*margin-left: 1em;*/ margin-right: 4em; }

    </style>
    
    <!-- EVIFWEB SUPPORT-->
    <script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/form/form_mobi.js"></script>
    <script src="<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/main_admin.js"></script>

    <!-- SEARCH SUPPORT
	<script>
    $( document ).on( "pagecreate", "#myPage", function() {
        $( "#autocomplete" ).on( "filterablebeforefilter", function ( e, data ) {
            var $ul = $( this ),
                $input = $( data.input ),
                value = $input.val(),
                html = "";
            $ul.html( "" );
            if ( value && value.length > 2 ) {
                $ul.html( "<li><div class='ui-loader'><span class='ui-icon ui-icon-loading'></span></div></li>" );
                $ul.listview( "refresh" );
                $.ajax({

                    //
                    // DON'T WORRY ABOUT CHANGING THIS RIGHT NOW FOR OVERLAY SUPPORT. PROLLY GONNA USE SEARCH FOR LANGUAGE SUPPORT.
                    url: "<?php echo $oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_ENV->getEnvParam('ROOT_PATH_CLIENT_HTTP_DIR'); ?>dashboard/search/ajax/m/main/",
                    //url: "http://gd.geobytes.com/AutoCompleteCity",
                    dataType: "jsonp",
                    crossDomain: true,
                    data: {
                        q: $input.val()
                    }
                })
                .then( function ( response ) {
                    $.each( response, function ( i, val ) {
                        html += "<li data-filtertext='"+val['kivotossearch']+"|"+val['kivotosname'] +"'><a href='" + val['kivotosuri'] + "' data-ajax='false'>" + val['kivotosname'] + "</a></li>";
                        
                    });
                    
                    $ul.html( html );
                    $ul.listview('refresh');
                    $ul.trigger( "updatelayout");
                });
            }
        });
    });
    </script>

-->