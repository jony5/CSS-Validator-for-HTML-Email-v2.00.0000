<?php

/* 
// J5
// Code is Poetry */
require('_crnrstn.root.inc.php');
include_once($CRNRSTN_ROOT . '_crnrstn.config.inc.php');
require($CRNRSTN_ROOT . 'common/classes/banner_carousel.inc.php');

$tmp_path = 'common/imgs/jony5_banner_1180x250/';

$oCarousel = new banner_carousel($oCRNRSTN_ENV);
$tmp_xml_node_inject = $oCarousel->return_proxy_nodes($tmp_path);

header("Content-Type: text/plain");
echo $tmp_xml_node_inject;