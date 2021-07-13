<?php
/* 
// J5
// Code is Poetry */
$oCRNRSTN_USR->initFormHandling('crnrstn_form_search');
$oCRNRSTN_USR->addFormInputParamListener('crnrstn_form_search', 't', true);

$tmp_uri = $oCRNRSTN_USR->get_resource("ROOT_PATH_CLIENT_HTTP").$oCRNRSTN_USR->get_resource("ROOT_PATH_CLIENT_HTTP_DIR").'search';

$tmp_str = '
<div id="search_wrapper">
<form action="'.$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP').$oCRNRSTN_USR->get_resource('ROOT_PATH_CLIENT_HTTP_DIR').'search/" method="post" name="s" id="s"  enctype="multipart/form-data" >
    
    <div id="search_input_wrapper" >
        <div class="global_search_input_bdr"><input crnrstn_search="t" name="t" id="t" type="text" maxlength="255" value="" autocomplete="off"></div>
        <div id="s_results_wrapper">
            <ul id="s_results"></ul>
        </div>
    
    </div>
    
    <div class="search_submit_btn_border">
        <div id="global_search_submit_btn" onMouseOver="searchBtnMouseOver(this); return false;" onMouseOut="searchBtnMouseOut(this); return false;" onClick="$(\'#s\').submit(); return false;">Search</div>
    </div>
    
    <div class="hidden">
        <input name="submitin" type="submit" value="submit">
    </div>
    '.$oCRNRSTN_USR->ui_content_module_out(CRNRSTN_UI_FORM_INTEGRATION_PACKET, 'crnrstn_form_search').'
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
<div class="cb"></div></div>';

$oUSER->add_content_resource($tmp_str, JONY5_CONTENT_DESKTOP_SEARCH_INPUT);
unset($tmp_str);