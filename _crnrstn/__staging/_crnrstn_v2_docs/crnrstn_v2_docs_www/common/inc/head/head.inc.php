<?php
switch($_SERVER['SCRIPT_NAME']){
    case '/social/fellowship/podcast/index.php':
        $social_url = "http://jony5.com/social/fellowship/podcast/";
        $social_title = "Welcome to Life Study of the Bible with Witness Lee. A program brought to you by Living Stream Ministry.";
        $social_img = 'lsm_logo.gif';
        $social_desc = "Life-Study of the Bible with Witness Lee is a 30-minute radio broadcast composed of excerpts from Witness Lee's spoken ministry that focuses on the enjoyment of the divine life as revealed in the Scriptures.";
        $prim_desc = "Welcome to Life Study of the Bible with Witness Lee. A program brought to you by Living Stream Ministry.";
    break;
    default:
        $tmp_uri = $_SERVER['SCRIPT_NAME'];
        $tmp_uri = str_replace("index.php", "", $tmp_uri);
        $social_url = $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').$tmp_uri;
        $social_title = "CRNRSTN Suite :: v2.0.0, An Open Source PHP Class Library.";
        $social_img = 'crnrstn_php_suite_socmed01.jpg';
        $social_desc = "CRNRSTN is a free open source PHP class library that facilitates the operation of a LAMP application within multiple server environments (e.g. localhost, stage, production, .etc) effectively and properly joining the \"wall of SERVER\" to the \"wall of application\"...creating the two into one house.";
        $prim_desc = "CRNRSTN is a free open source PHP class library that facilitates the operation of a LAMP application within multiple server environments (e.g. localhost, stage, production, .etc) effectively and properly joining the \"wall of SERVER\" to the \"wall of application\"...creating the two into one house. With this tool, data and functionality possessing characteristics which inherently create distinctions from one environment to the next...such as IP address restrictions, error logging profiles, and database authentication credentials...can all be managed through one framework for an entire application. CRNRSTN also provides a layer of encryption which can be configured for both cookie and session data.";
    break;

}

$mobileBOOL = $oCRNRSTN_USR->isClientMobile();
if($mobileBOOL==true){
    ?>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="Content-Language" content="en-us" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="distribution" content="Global" />
    <meta name="ROBOTS" content="index" />
    <meta name="ROBOTS" content="follow" />
    <meta name="msvalidate.01" content="FE0FE9054422153BDD8BBF130A022370" />
    <meta property="og:url" content="<?php echo $social_url; ?>"/>
    <meta property="og:site_name" content="<?php echo $social_title; ?>"/>
    <meta property="og:title" content="<?php echo $social_desc; ?>"/>
    <meta property="og:image" content="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/<?php echo $social_img; ?>"/>
    <meta property="og:description" content="<?php echo $prim_desc; ?>" />
    <meta property="og:type" content="website"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="<?php echo $social_title; ?>"/>
    <meta name="twitter:image" content="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/<?php echo $social_img; ?>"/>
    <meta name="twitter:description" content="<?php echo $social_desc; ?>" />
    <meta name="description" content="<?php echo $prim_desc; ?>" />
    <meta name="keywords" content="jesus, christ, jesus christ, gospel, j5, jonathan, harris, jonathan harris, johnny 5, jony5, atlanta, moxie, agency, web, christian, web services, email, web programming, marketing, CSS, XHTML, php, ajax" />

    <title>CRNRSTN Suite :: 2.0.0</title>
    <link rel="shortcut icon" href="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>favicon.ico?v=420" />

    <link rel="stylesheet" href="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/css/themes/crnrstn_v2.min.css" />
    <link rel="stylesheet" href="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/css/themes/jquery.mobile.icons.min.css" />

    <link rel="stylesheet" href="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/css/themes/jquery.mobile.structure-1.4.5.min.css" />
    <script src="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/css/themes/jquery-1.11.1.min.js"></script>
    <script src="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/js/_lib/frameworks/jquery_mobi/jquery.js"></script>
    <script src="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/js/_lib/frameworks/jquery_mobi/index.js"></script>
    <script src="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/js/_lib/frameworks/jquery_mobi/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR') ?>common/js/main.mobi.js"></script>

    <style>
        .ui-header .ui-title { /*margin-left: 1em;*/ margin-right: 4em; }
        a									{ text-decoration: none; font-weight: normal;}
        #hdr_dbl_hr_shell					{ width:100%;}
        #hdr_hr_top							{ width:100%; clear:both; background-color:#FC0D1B; height:10px; margin:0 0 2px 0;}
        #hdr_hr_btm							{ width:100%; clear:both; background-color:#606060; height:3px; margin:0 0 0 0;}

        .hdr_dbl_hr_shell					{ width:100%;}
        .hdr_hr_top							{ width:100%; clear:both; background-color:#000; height:10px; margin:0 0 2px 0;}
        .hdr_hr_btm							{ width:100%; clear:both; background-color:#606060; height:3px; margin:0 0 0 0;}
        .hdr_pg_ttl_hr_btm                  { width:100%; clear:both; background-color:#999; height:2px; margin:0 0 0 0;}

        .frm_errstatus						{ color:#FF0000; font-weight:bold; font-size:13px; text-align:right;}
        .req_star							{ font-weight:bold; font-size:14px; color:#F00;}
        .the_R								{ color:#F00;}
        .the_V								{ color:#F00;}

        .ui-filter-inset 					{ margin-top: 0; }
        .ui-li-aside						{ /*margin-top: 20px;*/}


        /*JQUERY*/
        @media ( min-width: 10em ) {
            /* Show the table header rows and set all cells to display: table-cell */
            .evif-asset-report td,
            .evif-asset-report th,
            .evif-asset-report tbody th,
            .evif-asset-report tbody td,
            .evif-asset-report thead td,
            .evif-asset-report thead th {
                display: table-cell;
                margin: 0;
            }
            /* Hide the labels in each cell */
            .evif-asset-report td .ui-table-cell-label,
            .evif-asset-report th .ui-table-cell-label {
                display: none;
            }
        }

        /*DASHBOARD*/
        .agg_element_hr						{border-top:solid 2px #EEE; width:100%; height:1px;}
        .agg_element_wrapper				{ }
        .icon_wrapper						{ position:relative; float:left; width:20px; height:20px; margin-top:5px;}
        .icon_img							{ position:absolute;}
        .element_detail_wrapper				{ float:left; padding-left:10px; width:88%;}
        .element_title a					{ text-decoration: none; font-weight:normal;}
        .element_date						{float: left;}
        .element_owner						{float: left; padding-left:8px;}
        .element_feeder_cnt					{ position:absolute; top:-8px; left:10px; background-color: #B50F23; color:#FFF; font-size:11px; font-weight:normal; padding:1px 3px 1px 3px; border-radius: 15px;}

        .ui-btn.cia00_submit			    { background-color:#CC3939; color:#F0F0F0; text-shadow:1px 1px 2px #C62222;}

        .main_copy_header					{ text-align: center;}
        .main_document_title				{ text-align: center;}

        #content_results_title				{ color:#333; font-size:38px; font-weight:bold;}
        .content_results_subtitle			{ font-weight:bold; color:#333; font-size:19px; margin-top:0;}
        .content_results_subtitle_divider	{ width:100%; background-color: #C3C8D6; height:2px; margin:5px 0 5px 0; border-bottom:1px dashed #7C8FC6;}


        .section_title                      { font-weight: bold; font-size:19px; padding:20px 0 0 0;}
        .tech_specs_wrapper                 { }
        .tech_specs_wrapper li              { list-style: square; line-height: 24px; font-size:17px; margin:0 0 15px 0; padding-bottom: 0;}

        .basic_section_content             { line-height: 24px; font-size:17px; margin:0 0 15px 0;}

        .method_parameter					{ font-size:17px; margin-top:15px; font-weight:normal; padding-bottom:0; margin-bottom: 0;}
        .method_parameter_definition		{ margin-left:30px; font-size:15px; padding-top: 0; margin-top: 0;}
        .parameter_require_optional			{ font-family:"Courier New", Courier, monospace; font-size:16px; font-style:italic; font-weight:normal;}
        .parameter_require_required			{ font-family:"Courier New", Courier, monospace; font-size:16px; font-style:italic; font-weight:normal; color:#FF0000;}


        iframe 								{ border: none;}

        /*CODE*/
        code                                { text-shadow: none;}
        .crnrstn_code_wrapper               { position:relative; background-color:#000; color:#DEDECB; width:98%; padding:0; margin-top:0; border:3px solid #CC9900; overflow:scroll; font-size:14px; text-shadow: none; max-width: 650px;}
        .crnrstn_code_shell                 { background-color:#000; color:#DEDECB; width:1920px; padding:10px; margin-top:0; padding-left:35px; line-height:20px; text-shadow: none;}
        .crnrstn_l_num                      { line-height:20px; position:absolute; width:25px; font-size:14px; font-family: Verdana, Arial, Helvetica, sans-serif; color:#00FF00; border-right:1px solid #333333; background-color:#161616; padding-top:10px; padding-left:4px; text-shadow: none;}

        .crnrstn_code_output_wrapper        { background-color:#FFF; width:98%; margin-top:10px; border: 3px solid #999; color:#333333; font-family: Verdana, Arial, Helvetica, sans-serif; overflow:scroll; font-size:14px; }
        .crnrstn_code_output_copy           { padding:20px; line-height: 25px; font-size:19px;}

        .crnrstn_note_wrapper               { width:98%; border:2px solid #CCC; font-size:15px; margin:20px 0 20px 0; background-color:#E6E6FF; max-width: 650px;}
        .crnrstn_note_notetitle             { float:left; width:75px; font-size:23px; padding:10px 0 0 10px; color:#45494E;}
        .crnrstn_note_notecopy              { float:left; padding:14px 10px 10px 10px; color:#45494E; line-height: 24px;}
        .crnrstn_note_crnrstn_icon          { padding:0 10px 0 0; margin-top:10px;}

        .crnrstn_page_description           { font-size:17px; padding:10px 0 0 20px; line-height: 24px; max-width: 650px;}
        .crnrstn_example_title_wrapper      { font-family: Arial, Helvetica, sans-serif; padding: 10px 0 10px 15px; max-width: 650px;}
        .crnrstn_example_title              { font-weight: bold; font-size:19px;}
        .crnrstn_example_description        { font-size:17px; padding:10px 0 0 0; line-height: 24px;}
        .crnrstn_example_output_title       { font-weight: bold; font-size:19px; line-height:24px; font-family: Arial, Helvetica, sans-serif; padding: 20px 0 10px 15px; max-width: 650px; }

        /*UTILITY*/
        .hidden								{ width:0px; height:0px; position:absolute; left:-2000px; overflow:hidden;}
        .cb 								{ display:block; clear:both; height:0px; line-height:0px; overflow:hidden; width:100%; font-size:1px;}
        .cb_5	 							{ display:block; clear:both; height:5px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_10	 							{ display:block; clear:both; height:10px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_15	 							{ display:block; clear:both; height:15px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_20								{ display:block; clear:both; height:20px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_30								{ display:block; clear:both; height:30px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_40								{ display:block; clear:both; height:40px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_50	 							{ display:block; clear:both; height:50px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_60	 							{ display:block; clear:both; height:60px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_75								{ display:block; clear:both; height:75px;  line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_100 							{ display:block; clear:both; height:100px; line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
        .cb_200								{ display:block; clear:both; height:200px; line-height:1px; overflow:hidden; border:0px; padding:0px; margin:0px; font-size:1px;}
    </style>

    <!-- SEARCH SUPPORT-->
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

                        url: "<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>search/ajax/m/",
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
                                //html += "<li><a>" + val + "</a></li>";
                                //html += "<li><a>" + val['kivotosname'] + "</a></li>";

                            });

                            $ul.html( html );
                            $ul.listview('refresh');
                            $ul.trigger( "updatelayout");
                        });
                }
            });
        });
    </script>
    
    <?php
}else{
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>favicon.ico?v=420.00<?php echo filesize($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/css/main.css').'.'.filemtime($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/css/main.css').'.0'; ?>" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta name="distribution" content="Global" />
    <meta name="ROBOTS" content="index" />
    <meta name="ROBOTS" content="follow" />
    <meta name="msvalidate.01" content="FE0FE9054422153BDD8BBF130A022370" />
    <meta property="og:url" content="<?php echo $social_url; ?>"/>
    <meta property="og:site_name" content="<?php echo $social_title; ?>"/>
    <meta property="og:title" content="<?php echo $social_desc; ?>"/>
    <meta property="og:image" content="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/<?php echo $social_img; ?>"/>
    <meta property="og:description" content="<?php echo $prim_desc; ?>" />
    <meta property="og:type" content="website"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="<?php echo $social_title; ?>"/>
    <meta name="twitter:image" content="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/imgs/<?php echo $social_img; ?>"/>
    <meta name="twitter:description" content="<?php echo $social_desc; ?>" />
    <meta name="description" content="<?php echo $prim_desc; ?>" />
    <meta name="keywords" content="jesus, christ, jesus christ, gospel, j5, jonathan, harris, jonathan harris, johnny 5, jony5, atlanta, moxie, agency, web, christian, web services, email, web programming, marketing, CSS, XHTML, php, ajax" />
    <title>CRNRSTN Suite :: 2.0.0</title>
    <script type="text/javascript" language="javascript" src="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/_lib/frameworks/jquery/3.5.1/jquery-3.5.1.min.js" ></script>
    <link rel="stylesheet" href="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/css/main.css?v=420.00<?php echo filesize($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/css/main.css').'.'.filemtime($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/css/main.css').'.0'; ?>">
    <!--<link rel="stylesheet" href="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/_lib/frameworks/lightbox/2.11.1/css/lightbox.min.css" type="text/css" />-->

    <!-- <script src="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/_lib/frameworks/jquery_mobi/jquery.js"></script>-->
    <script src="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR');  ?>common/js/_lib/frameworks/jquery_ui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" language="javascript" src="<?php echo $oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR'); ?>common/js/main.js?v=420.00<?php echo filesize($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/js/main.js').'.'.filemtime($oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT').$oCRNRSTN_USR->getEnvResource('DOCUMENT_ROOT_DIR').'/common/js/main.js').'.0'; ?>"></script>

<?php
}
?>