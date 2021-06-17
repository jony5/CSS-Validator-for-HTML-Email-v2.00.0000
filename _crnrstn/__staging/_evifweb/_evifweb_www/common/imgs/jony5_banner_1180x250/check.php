<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($CRNRSTN_ROOT . 'common/classes/banner_carousel.inc.php');

$tmp_path = 'common/imgs/jony5_banner_1180x250/';

$oCarousel = new banner_carousel($oCRNRSTN_ENV);
$tmp_html = $oCarousel->return_image_check($tmp_path);

echo $tmp_html;