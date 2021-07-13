<?php

if($oCRNRSTN_USR->is_client_mobile(true)){

    $tmp_str = '<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="Content-Language" content="en-us" />
    <link rel="shortcut icon" type="image/x-icon" href="'.$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'favicon.ico?v=420.00'.filesize($oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/favicon.ico').'.'.filemtime($oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/favicon.ico').'.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="distribution" content="Global" />
    <meta name="ROBOTS" content="index" />
    <meta name="ROBOTS" content="follow" />
    <meta name="msvalidate.01" content="FE0FE9054422153BDD8BBF130A022370" />
    <meta name="keywords" content="jesus, christ, jesus christ, gospel, j5, jonathan, harris, jonathan harris, johnny 5, jony5, atlanta, moxie, agency, web, christian, web services, email, web programming, marketing, CSS, XHTML, php, ajax" />

    <title>Hi, I\'m Jonathan \'J5\' Harris.</title>
    <!--<link rel="stylesheet" href="'.$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'common/css/themes/crnrstn_v2.min.css" />-->
    '.$oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_MOBILE).'

';

    $oUSER->add_content_resource($tmp_str, JONY5_CONTENT_MOBILE_HEAD, 'page');

}else{

    $tmp_str = '<meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="'.$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'favicon.ico?v=420.00'.filesize($oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/favicon.ico').'.'.filemtime($oCRNRSTN_USR->get_resource('DOCUMENT_ROOT').$oCRNRSTN_USR->get_resource('DOCUMENT_ROOT_DIR').'/favicon.ico').'.0" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta name="distribution" content="Global" />
    <meta name="ROBOTS" content="index" />
    <meta name="ROBOTS" content="follow" />
    <meta name="msvalidate.01" content="FE0FE9054422153BDD8BBF130A022370" />
    <meta name="keywords" content="jesus, christ, jesus christ, gospel, j5, jonathan, harris, jonathan harris, johnny 5, jony5, atlanta, moxie, agency, web, christian, web services, email, web programming, marketing, CSS, XHTML, php, ajax" />
    <title>Hi, I\'m Jonathan \'J5\' Harris.</title>
    '.$oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_JS_JQUERY_UI).'
    '.$oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_JS_LIGHTBOX_DOT_JS).'
    
    <style>
    
        .bg_effect_pillar            { background-image:url("'.$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR') . 'common/imgs/wood.jpg"); background-repeat: repeat; }

    </style>
    
   ';

    $oUSER->add_content_resource($tmp_str, JONY5_CONTENT_DESKTOP_HEAD, 'page');

}

//
////if(1==2) {
//
/*    <meta property="og:url" content="<?php echo $social_url; ?>"/>*/
/*    <meta property="og:site_name" content="<?php echo $social_title; ?>"/>*/
/*    <meta property="og:title" content="<?php echo $social_desc; ?>"/>*/
//    <meta property="og:image"
/*          content="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/<?php echo $social_img; ?>"/>*/
/*    <meta property="og:description" content="<?php echo $prim_desc; ?>"/>*/
//    <meta property="og:type" content="website"/>
//    <meta name="twitter:card" content="summary"/>
/*    <meta name="twitter:title" content="<?php echo $social_title; ?>"/>*/
//    <meta name="twitter:image"
/*          content="<?php echo $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP') . $oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/imgs/<?php echo $social_img; ?>"/>*/
/*    <meta name="twitter:description" content="<?php echo $social_desc; ?>"/>*/
/*    <meta name="description" content="<?php echo $prim_desc; ?>"/>*/
//
//}

