<?php
/* 
// J5
// Code is Poetry */
self::$oCRNRSTN_USR->initFormHandling('crnrstn_form_search');
self::$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_search', 't', true);

$tmp_uri = self::$oCRNRSTN_USR->getEnvResource("ROOT_PATH_CLIENT_HTTP").self::$oCRNRSTN_USR->getEnvResource("ROOT_PATH_CLIENT_HTTP_DIR").'search';

$html_out = '
<div id="search_wrapper">
<form action="'.self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'search/" method="post" name="s" id="s"  enctype="multipart/form-data" >
    <div id="search_input_wrapper" >
        <input crnrstn_search="t" name="t" id="t" type="text" maxlength="255" value="" autocomplete="off">
        <div id="s_results_wrapper">
            <ul id="s_results"></ul>
        </div>
    </div>
    <div id="search_submit_btn" onMouseOver="searchBtnMouseOver(this); return false;" onMouseOut="searchBtnMouseOut(this); return false;" onClick="$(\'#s\').submit(); return false;">Search</div>
    <div class="hidden">
        <input name="submitin" type="submit" value="submit">
    </div>
    '.self::$oCRNRSTN_USR->injectInputSerialization('crnrstn_form_search').'
    </form>
    <script>
    $( "#s" ).submit(function( event ) {
      var tmp_sval = $("#t").val();
      
      if(tmp_sval==""){
          
          event.preventDefault();
          
      }
        
    });
    
    $( "#t" ).mouseover(function() {
      $( this ).addClass( "s_box_bg", 500, "easeOutBounce" );
    });
   
    </script>
<div class="cb"></div></div>'.$html_out;