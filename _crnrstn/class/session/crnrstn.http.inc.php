<?php
/*
// J5
// Code is Poetry */
#
#  CRNRSTN ::
#  VERSION :: 2.00.0000 PRE-ALPHA-DEV
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#  AUTHOR :: Jonathan 'J5' Harris, Lead Full Stack Developer
#  URI :: http://crnrstn.evifweb.com/
#  DESCRIPTION :: CRNRSTN :: An Open Source PHP Class Library providing a robust services interface layer to both
#       facilitate, augment, and enhance the operations of code base for an application across multiple hosting
#       environments. Copyright (C) 2012-2021 eVifweb development.
#  OVERVIEW :: CRNRSTN :: is an open source PHP class library that facilitates the operation of an application within
#       multiple server environments (e.g. localhost, stage, preprod, and production). With this tool, data and
#       functionality with characteristics that inherently create distinctions from one environment to the next...such
#       as IP address restrictions, error logging profiles, and database authentication credentials...can all be
#       managed through one framework for an entire application. Once CRNRSTN :: has been configured for your different
#       hosting environments, seamlessly release a web application from one environment to the next without having to
#       change your code-base to account for environmentally specific parameters. Receive the benefit of a robust and
#       polished framework for bubbling up exception notifications through any output of your choosing. Take advantage
#       of the CRNRSTN :: SOAP Services layer supporting many to 1 proxy messaging relationships between slave and
#       master servers; regarding server communications i.e. notifications, some architectures will depend on one
#       master to support the communications needs of many slaves with respect their roles and responsibilities in
#       regards to sending an email. With CRNRSTN ::, slaves configured to log exceptions via EMAIL_PROXY will send
#       all of their internal system notifications to one master server (proxy) which server would posses the (if
#       necessary) SMTP credentials for authorization to access and execute more restricted communications
#       protocols of the network.
#  LICENSE :: MIT
#		Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
#		documentation files (the "Software"), to deal in the Software without restriction, including without limitation
#       the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
#       and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
#
#		The above copyright notice and this permission notice shall be included in all copies or substantial portions
#		of the Software.
#
#		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
#       TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
#       THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
#       CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
#       DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # ##
#
#  CLASS :: crnrstn_http_manager
#  VERSION :: 1.00.0001
#  DATE :: October 24, 2014 @ 1819hrs
#  AUTHOR :: Jonathan 'J5' Harris, jharris@eVifweb.com
#  URI :: 
#  DESCRIPTION :: Testing for and retrieving data received via HTTP.
#  LICENSE :: MIT | http://crnrstn.evifweb.com/licensing/
#
class crnrstn_http_manager {

	public $httpHeaders;
	private static $httpHeader_ARRAY = array();
	private static $postHttpData;
	private static $getHttpData;
	
	public function __construct() {

	    /*
	    //
	    // March 31, 2021 1254hrs
	    // Just finished most (if not all) of the bitwise management within
	    // CRNRSTN :: for a CSS validation for Email HTML messaging project.
	    //
	    // http://css.validator.jony5.com
	    //
	    // * THIS IS A RE-ARCHITECTURE OF A 2008 PROJECT. THIS DEMONSTRATION WILL FLEX
	    //   THE DEVELOPMENT OF THE CRNRSTN :: BITWISE MANAGEMENT ENGINE TO STRENGTHEN
	    //   THE USE-CASE SUPPORT CONTAINED THEREIN TO BOTH MAXIMIZE OPPORTUNITIES FOR
	    //   AND SIMPLIFY IMPLEMENTATION OF PLANNED AND UPCOMING RE-ARCHITECTURES OF
	    //   CRNRSTN :: TO REMOVE (1) ALL THROW-A-FLAG-BASED ARCHITECTURES AND (2) ALL
	    //   SINGLE-SERVING BOOLEAN PARAMETER DATA STRUCTURES AND TO REPLACE THEM WITH
	    //   A CRNRSTN :: FRAMEWORK-MERGED AND INTEGER-BASED-BITWISE-DRIVEN PROTOCOL.
	    //
	    // Now I need to finish the other little details around this micro-site and
	    // RTM it to production before I can get back to this HTTP manager class (even
	    // before I can get back to all of CRNRSTN :: ) re-architecture initiative for
	    // low level multi-language integrations into CRNRSTN :: which key off of HTTP
	    // header Accept-language datum.
	    //
	    // "Also, my rug was stolen."  - the dude
	    //
	    // Also, my driver's license was just taken and on a day that I spent over $200
	    // for both me and J5, my boy, at Ruth's Chris Steakhouse. The Lord Spirit gives
	    // me no leading to make any move to replace my missing license...imagine that!
	    //
	    // Yesterday, or even today, I was going to go back to Ruth's Chris Steakhouse
	    // for another $150 (or whatever) steak. Apparently, I gave the first one THAT
	    // I EVER BOUGHT to my dog, and, as it turns out, the steak I ate was like $50
	    // or something.
	    //
	    // I don't know when I'll ever get to go back for that steak. Until then, only
	    // my dog knows this satisfaction; I still have yet to make this my own, and now
	    // the experience is being kept from me by Satan and his devils.
	    //
	    // Well, since I will not jump through any hoops to fix the situation without
	    // my Lord being "on board" with it. It looks like I will be having plenty
	    // of time in these days to make good progress on all of these HTTP_MANAGER things!
	    //
	    // Praise God! Even in the midst of suffering, the Lord is merciful.
	    //
	    // Upon having such a realization...why should I (and, dang-it, why would I)
	    // allow anyone or anything to hinder this project for any reason?
	    //
	    // Are you guys silly...still gonna send it!
	    //
	    // Now,...at this moment...THIS shit is becoming all gravy, baby!
	    //
	    // Jonathan J5 Harris and J5
	    // Wednesday, March 31, 2021 1356hrs
	    // https://www.youtube.com/watch?v=WIrWyr3HgXI


        //
	    // Notes from March (5th-ish?) of 2021
	    // SOURCE :: https://en.wikipedia.org/wiki/List_of_HTTP_header_fields
        List of HTTP header fields

	    The header fields are transmitted after the request line (in case of a
	    request HTTP message) or the response line (in case of a response HTTP
	    message), which is the first line of a message.

	    Header fields are colon-separated key-value pairs in clear-text string
	    format, terminated by a carriage return (CR) and line feed (LF)
	    character sequence.

	    The end of the header section is indicated by an empty field line,
	    resulting in the transmission of two consecutive CR-LF pairs.

	    A few fields can contain comments (i.e. in User-Agent, Server, Via
	    fields), which can be ignored by software.

        Many field values may contain a quality (q) key-value pair separated
	    by equals sign, specifying a weight to use in content negotiation.[8]
	    For example, a browser may indicate that it accepts information in
	    German or English, with German as preferred by setting the q value
	    for de higher than that of en, as follows:

	    Accept-Language: de; q=1.0, en; q=0.5

	    The standard imposes no limits to the size of each header field name
	    or value, or to the number of fields. However, most servers, clients,
	    and proxy software impose some limits for practical and security
	    reasons. For example, the Apache 2.3 server by default limits the
	    size of each field to 8,190 bytes, and there can be at most 100
	    header fields in a single request.

Request fields
    Accept
    Accept-Charset
    Accept-Datetime
    Accept-Encoding
    Accept-Language
    Authorization
    Cache-Control
    Connection
    Content-Encoding
    Content-Length
    Content-MD5
    Content-Type
    Cookie
    Date
    Expect
    Forwarded
    Host
    Proxy-Authorization
    Range
    Referer
    User-Agent
    Warning
    X-Requested-With
    DNT
    X-Forwarded-For
    X-Forwarded-Host
    X-Forwarded-Proto
    X-Wap-Profile
    X-UIDH[34][35][36]




Response fields
    Access-Control-Allow-Origin,
    Access-Control-Allow-Credentials,
    Access-Control-Expose-Headers,
    Access-Control-Max-Age,
    Access-Control-Allow-Methods,
    Access-Control-Allow-Headers[11
    Accept-Ranges
    Allow
    Cache-Control
    Content-Disposition[48]
    Content-Encoding
    Content-Language
    Content-Length
    Content-Range
    Content-Type
    Date
    Expires
    Last-Modified
    Location
    Proxy-Authenticate
    Retry-After
    Server
    Set-Cookie
    Tk
        Tracking Status header, value suggested to be sent in response to a DNT(do-not-track), possible values:
            "!" — under construction
            "?" — dynamic
            "G" — gateway to multiple parties
            "N" — not tracking
            "T" — tracking
            "C" — tracking with consent
            "P" — tracking only if consented
            "D" — disregarding DNT
            "U" — updated
    
    Warning
    Refresh
    Status
    X-Content-Type-Options[61]
    X-Powered-By[64]

= = = = = = =
https://www.php.net/manual/en/function.header.php
mjt at jpeto dot net ¶
I strongly recommend, that you use

header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

instead of

header("HTTP/1.1 404 Not Found");

I had big troubles with an Apache/2.0.59 (Unix) answering in HTTP/1.0 while I (accidentially) added
a "HTTP/1.1 200 Ok" - Header.

Most of the pages were displayed correct, but on some of them apache added weird content to it:

A 4-digits HexCode on top of the page (before any output of my php script), seems to be some kind of
checksum, because it changes from page to page and browser to browser. (same code for same page and browser)

"0" at the bottom of the page (after the complete output of my php script)

It took me quite a while to find out about the wrong protocol in the HTTP-header.
= = = = = = =

    */

	}
	
	public function extractData($requestMethod, $name){

		if(isset($requestMethod[$name])){

			return trim($requestMethod[$name]);

		}else{

			return "";

		}
	}
	
	public function getHeaders ($returnType=NULL){

		self::$httpHeader_ARRAY=headers_list();
		
		switch(strtolower($returnType)){
			case 'array':

				return self::$httpHeader_ARRAY;

			break;		
			default:

				$httpHeaders = "";

				$tmp_loop_size = sizeof(self::$httpHeader_ARRAY);

				for($i=0;$i<$tmp_loop_size;$i++){

					$httpHeaders .= self::$httpHeader_ARRAY[$i].',';
				}
				
				// 
				// STRIP TRAILING COMMA
				$httpHeaders = rtrim($httpHeaders, ',');
		
				return $httpHeaders;

			break;
		}
	}
	
	public function issetHTTP ($superGlobal){

		if(sizeof($superGlobal)>0){

			return true;

		}else{

			return false;

		}
	}
	
	public function issetParam($superGlobal, $param){

		if(isset($superGlobal[$param])){

			if(strlen($superGlobal[$param])>0){

				return true;

			}else{

				return false;

			}

		}else{

			return false;

		}
	
	}

	public function __destruct() {

	}
}