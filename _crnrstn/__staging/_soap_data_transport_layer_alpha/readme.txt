Why is this here? DEMONSTRATION OF requirements to support:
    ~ CRNRSTN :: SOAP Data Transport (SDT) Layer

NOTE ::
This is the site code for a current and active redesign of http://jony5.com where
the browser is being turned into a SOAP (UN/PWD authenticated) client for all AJAX
requests to SERVER. These SDT R&D project implementation learnings will be used
as the foundation for the CRNRSTN :: User Authentication Services (read as user
log-in) layer.

CRNRSTN :: SOAP Data Transport (SDT) Layer Alpha prototype development.

Until documentation or complete SDT Layer implementation within CRNRSTN ::, please refer to use of "JONY5_CONTENT_SOAP_DATA_TUNNEL" within the following ::
[_crnrstn/__staging/_soap_data_transport_layer_alpha/jony5.com/index.php]

I left the CRNRSTN :: SOAP authorization configuration meta basically unchanged from my dev and prod...so in theory this should work if you simply edit...by UNCOMMENTING the use of $oCRNRSTN->init_SOAP_permissions()...the following ::
[_crnrstn/__staging/_soap_data_transport_layer_alpha/jony5.com/_crnrstn.config.inc.php file .

Pro Tip: Maybe at least change the SOAP account usernames, passwords, and keys first [_crnrstn/__staging/_soap_data_transport_layer_alpha/jony5.com/_crnrstn/_config/config.soap.secure/_crnrstn.soap.config.inc.php]!!
(I know, right! This should, like totally be managed within a database!)

Thx!
J5