<?php
/*
// J5
// Code is Poetry */

#  CLASS :: content_source_controller
#  AUTHOR :: Jonathan 'J5' Harris <jharris@eVifweb.com>
#  CLASS VERSION :: 1.0.0
#  CLASS DATE :: July 4, 2020 @ 1620hrs

class content_source_controller {

    private static $oLogger;
    private static $oCRNRSTN_USR;
    private static $oContentGen;
    private static $oSideBitch_usr;

    public $page_path;
    private static $page_serial;

	public function __construct($oCRNRSTN_USR, $oSideBitch_USR, $oContent_GEN, $page_path) {

	    self::$oCRNRSTN_USR = $oCRNRSTN_USR;

	    //
		// INSTANTIATE LOGGER
		self::$oLogger = new crnrstn_logging(self::$oCRNRSTN_USR->debugMode, __CLASS__, self::$oCRNRSTN_USR->log_silo_key_piped);

		self::$oContentGen = $oContent_GEN;
		self::$oSideBitch_usr = $oSideBitch_USR;

		$this->page_path = $page_path;

	}

	public function loadContent(){
        try{
            switch($this->page_path){
                case '/search/':
                    $tmp_categ_name = 'search results';
                    $tmp_subcateg_name = 'search results';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'search results for';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    //self::$oSideBitch_usr->addPageElement(self::$page_serial,'SUB_TITLE','Scriptures :: <span style="font-size:11px;">(scrollable section)</span>');

                break;
                case '/amalek/':
                    $tmp_categ_name = 'amalek';
                    $tmp_subcateg_name = 'an amalekite princess';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'an amalekite princess';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'SUB_TITLE','Scriptures :: <span style="font-size:11px;">(scrollable section)</span>');

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','<div style="height:250px; overflow:scroll;">
                        	<p><strong>Gen. 25:23</strong> - And Jehovah said to her, / Two nations are in your womb, / And two peoples shall be separated from your bowels. / And the one people shall be stronger than the other people. / And the older shall serve the younger.</p>

<p><strong>Gen. 25:24-26</strong> - And when her days to be delivered were fulfilled, behold, there were twins in her womb. 25 And the first came forth red, all over like a hairy garment; and they called his name Esau. 26 And after that his brother came forth, and his hand was holding on to Esau\'s heel, so his name was called Jacob. And Isaac was sixty years old when she bore them.</p>
 
<p><strong>Gen. 36:12a</strong> - And Timna was a concubine to Eliphaz, Esau\'s son, and she bore Amalek to Eliphaz.</p>

<p><strong>Exo. 17:8-16</strong> - 8 Then Amalek came and fought with Isreal in Rephidim. 9 And Moses said to Joshua, Choose men for us, and go out; fight with Amalek. Tomorrow I will stand on the top of the hill with the staff of God in my hand. 10 So Joshua did as Moses has said to him and fought with Amalek; and Moses Aaron, and Hur went to the top of the hill. 11 And when Moses lifted his hand up, Israel prevailed; and when he let his hand down, Amalek prevailed. 12 But Moses\' hands were heavy, so they took a stone and put it under him, and he sat on it; and Aaron and Hur supported his hands, one on one side and one on the other side. So his hands were steady until the going down of the sun. 13 And Joshua defeated Amalek and his people with the edge of the sword. 14 And Jehovah said to Moses, Write this as a memorial in a book and recite it to Joshua, that I will utterly blot out the memory of Amalek from under heaven. 15 And Moses built an altar and called the name of it Jehovah-nissi; 16 For he said, For there is a hand against the throne of Jah! Jehovah will have war with Amalek from generation to generation. </p>

<p><strong>Mal. 1:2-3</strong> - I have loved you, says Jehovah; but you say, How have You loved us? Was not Esau Jacob\'s brother, declares Jehovah? Yet I loved Jacob; 3 But Esau I hated, and I made his mountains a desolation, and gave his inheritance to the jackals of the wilderness.</p>

<p><strong>Rom 9:13</strong> - As it is written, "Jacob have I loved, but Esau have I hated."</p>

<p><strong>Eph. 6:11-12</strong> - Put on the whole armor of God that you may be able to stand against the stratagems of the devil, 12 For our wrestling is not against blood and flesh but against the rulers, against the authorities, against the world-rulers of this darkness, against the spiritual forces of evil in the heavenlies.</p>
                  
                        </div>');

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'SUB_TITLE','Revelation');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Before these matters are laid at your feet for your consideration (and with the hope and expectation that the enlightenment of the Holy Spirit will follow), I have to humbly acknowledge my sources: 1) the faithful ministry of brothers Watchman Nee and Witness Lee (with those serving alongside them to shepherd the churches) combined with 2) the instant revelation...the instant speaking...of the Lord Jesus Christ as the all-inclusive, compound, seven-fold intensified, life-giving Spirit who dwells within my human spirit. The combination of these two (2) exposed the spiritual identity of an entity of people responsible for a certain vein of events which have been taking place in my life since beginning around Q3 of 2011.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','I say "spiritual identity" because the battle which God\'s people, the saints, are fighting at this very moment is not against blood and flesh (Eph. 6:11-12). There is a spiritual war taking place in this universe, and only a built up body of serving priests (the church)...God\'s saints...can be in a proper position to stand with God and gain the victory over God\'s enemy, Satan.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','To see "The Amalekite Princess", one must first have an understanding and an application of fundamental principles of God\'s economy. One must live their life by and according to their mingled spirit...allowing their spirit to be the leading organ in their being. One must spend their days abiding in the enjoyment of the Lord Jesus Christ...giving thanks for all things in simplicity.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Second, the saints must have the deep conviction and realization that when their conscience condemns them, that is God operating within their being to accuse or even excuse them regarding matters of their daily life and living (1 John 3:20). <strong>The divine revelation goes even further to identify our regenerated human spirit with the very throne of God in the universe (Heb. 4:16,12).</strong> The throne of God is the very center of God\'s divine administration in the whole universe. Saints, our human spirit is the very gate of heaven (Gen. 28:17)...the key to our entrance into (and existence in) the reality of God\'s kingdom.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Finally, one must understand the role of Amalek in God\'s economy. The divine revelation in the Holy Scriptures is very clear and consistent regarding the descendants of Esau...the Amalekites. Spiritually speaking, "Amalek typifies the flesh which is the totality of the fallen old man (Gal. 2:16). The fighting between Amalek and Israel depicts the conflict between the flesh and the Spirit within the believers." "The flesh is God\'s enemy. It has neither the intention nor the ability to obey God (Rom. 8:7-8)".');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','The role of Amalek can be summarized by Moses\' experience of building and naming an alter after the defeat of Amalek in Exo. 17. "And Moses built an altar and called the name of it Jehovah-nissi; For he said, For there is a hand against the throne of Jah!" The flesh...Amalek..."is a hand against" or a "raised...fist against the Lord\'s throne".');

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'SUB_TITLE','Application');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Now, why would I identify some group of people in my life as being the spiritual embodiment of an "Amalekite Princess"? The Lord revealed to me that certain oppressive situations which were being orchestrated around me were being done with the intention or expectation of "tricking my conscience" into telling me that I had done something wrong (when only appearances of wrong doing were being created). Why would someone try to trick my conscience?');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Modern science has discovered that when you feel guilty, there is activity in your brain which gives off a unique signature that can be monitored and recorded with technology. This Amalekite Princess knows when I feel guilty! And this particular data is what the Amalekite Princess was looking for when she was running her game around me. If this princess could show the whole world that a Christian\'s conscience was totally "trickable", it would follow that any "divine involvement in the inner being of a Christian" is just a figment of a Christian\'s imagination. This position would clearly give ground for Satan to attack the divine revelation in its application before the whole world.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','If this Amalekite Princess could show that a simple "spilled sugar trick" could trigger my conscience into condemning me and making me feel guilty, she would have the ground to go further and speculate that since an all-knowing God could never be tricked like this...God must not be leading Jonathan \'J5\' Harris (or perhaps anyone else on this planet!) in his human spirit as the Word of God clearly reveals and as I have been strongly testifying. <strong>The Lord revealed to me that someone was hovering around a position which was going to give ground to Satan to openly attack the Throne of God as it is made real in the experience of all of God\'s children through the Spirit. In the Bible, there is an entity...a body of people...known to raise a fist to attack the Throne of God in this universe: Amalek.</strong> And by the Lord\'s sovereign grace and mercy, I have had opportunity to live under the influence of not just any Amalekite...this corporate person is Amalekite royalty...she is a princess of the Amalekites...being so wealthy, so proud, and so sensitive of how she is made to appear before her own people.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Because I don\'t want to end on a down note, there is spiritual significance in how the victory over Amalek was won by God\'s people. Due to space and time I will just insert a quote from a footnote in my Recovery Version Bible (Exo. Footnote 11<sup>1</sup>, Recovery Version):');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','<blockquote><i><strong>We are victorious over the flesh by eating and drinking Christ as our life supply and by praying with the interceding Christ and putting the flesh to death with Christ as the fighting Spirit.</strong></i></blockquote>');

                break;
                case '/':
                    $tmp_categ_name = 'Home';
                    $tmp_subcateg_name = 'Home';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'Welcome';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Welcome to the C<span class="the_R">R</span>NRSTN Suite :: documentation and support website! C<span class="the_R">R</span>NRSTN is a free open source PHP class library that facilitates the operation of a LAMP application within multiple server environments (e.g. localhost, stage, production, .etc) effectively and properly joining the "wall of SERVER" to the "wall of application"...creating the two into one house. With this tool, data and functionality possessing characteristics which inherently create distinctions from one environment to the next...such as IP address restrictions, error logging profiles, and database authentication credentials...can all be managed through one framework for an entire application. C<span class="the_R">R</span>NRSTN also provides a layer of encryption which can be configured for both cookie and session data.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Thank you for taking the time to check out the C<span class="the_R">R</span>NRSTN Suite ::. If you would like to contribute to this project, consider <a href="https://github.com/jony5/crnrstn" target="_blank">following/watching this project on GitHub</a>. View the project <a href="https://www.facebook.com/media/set/?set=a.10152398953669503.1073741836.586549502&type=1&l=4ba17e313a" target="_blank">photo gallery</a>.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','As a "hat tip" to King Abdullah Bin Abdul Aziz\'s bold move to provide 500 tons of wheat to Syrian refugees in Jordan (as reported by <a href="http://english.alarabiya.net/en/News/2013/01/13/Saudi-king-orders-500-tons-of-wheat-to-Syrian-refugees-in-Jordan.html" target="_blank">Al Arabiya</a>), as of today (1/16/2013 @ 0600), I am undertaking a slightly less noble...but just as sincere...effort to "help the people" through my creation of an open source enterprise level PHP class library for the management of a web application\'s integration into n+1 hosting ($_SERVER) environments. This body of code is completely new, and I am only leveraging resources and knowledge as is readily and freely available to the open source PHP community at large for the benefit of exactly the same. No part of any application that I developed whilst under the employ of any agency or for-profit business entity has been lifted and placed into this work. Due to the fact that I am currently being subjected to extensive surveillance protocols by an entity which bears an inscription...even written upon it\'s very forehead...which reads as "<a href="'.self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP').self::$oCRNRSTN_USR->getEnvResource('ROOT_PATH_CLIENT_HTTP_DIR').'amalek/" target="_self">AMALEKITE PRINCESS</a>", I have a high degree of confidence that the genesis of this project has been recorded and documented in a very thorough manner; there are witnesses who can vouch for the originality of this work.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'SUB_TITLE','History');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','When I entered the workforce in 2006 as an HTML developer making $35 an hour (after having to to step away from my internet start up company...where I was a full stack developer who was to be compensated through a stock offering upon going public), within the first few DAYS on the job, I was quietly using PHP to stand up tools to help me control the quality my HTML code via rendering it in an email to myself so that I could QA my code (and tweak it if necessary) before submitting my work to the team for the next step of the email marketing process. The quality of my email HTML code went from zero (0) to one hundred (100) real quick (within a day or so), and I (and our small team) knew immediately that things were going to work out. As far as I know, HTML email developers at <a href="http://www.moxieusa.com/" target="_blank">Moxie</a> are using the tools that I put together to test HTML email quality and rendering to this very day.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Through out the course of my career at Moxie, I would use PHP to put together various portals, a file sharing and project management extranet complete with MySQL powered search and user administration, and...heck...even web services for EMAIL and SMS real-time messaging. <strong>Sadly however, I never had the time to carve out for myself a solid and reusable PHP class library for the gaining of efficiencies in product maintenance, development and deployment.</strong> While working at Moxie (2006-2012), <strong>I really could have used an out-of-the-box/plug-n-play <a href="https://en.wikipedia.org/wiki/LAMP_(software_bundle)" target="_blank">LAMP stack</a> class library with the capability of facilitating an application\'s compliance with the RTM processes of a mature development shop.</strong>');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','In 2012 (after my exodus from Moxie with...according to what I have been told...&quot;a bang&quot;) on a 09\' model unibody Macbook Pro that I purchased with my own personal money while at Moxie...for my web application development at Moxie, <strong>I began work on just such a solution...coining the project name C<span class="the_R">R</span>NRSTN, because I was going to use this "stone" to properly join the "wall of server environment" and the "wall of application codebase" together into one house.</strong> In hindsight (when I look at archived code from the period of the C<span class="the_R">R</span>NRSTN genesis)...the approach of my execution in the code was a little off...leaning hard on achieving light and fast performance and completely abandoning flexibility and usability. My mind needed to be uplifted; I needed to experience a paradigm shift. Well...between October of 2012 and Jan 16, 2013, I took a break from programming to go deep in my study of the Bible together with books of ministry to strengthen the foundation of my faith, deepen my daily walk with the Lord Jesus Christ, and validate my moment by moment Christian experience against the teaching and fellowship of the apostles.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','While following the leading of the Spirit in my study of the Word of God...during this sabbatical of sorts..., I also began to reconsider the C<span class="the_R">R</span>NRSTN project and what I wanted this tool to be able to do. By that point, I had thoroughly re-read (cover to cover a couple of times) my second edition copy of <a href="https://g.co/kgs/kJbTk5" target="_blank">High Performance MySQL</a> that was purchased for me by Moxie on the professional development budget. ');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','&lt;flashback&gt; While at Moxie and when I was approaching a massive redesign (LAMP) for a client extranet that was growing in number of users and activity, I requested to be enrolled in a MySQL course from <a href="http://education.oracle.com/" target="_blank">Oracle</a>. That request was denied with audible laughs. Not giving up on my quest for <i>the knowledge</i>...I then found and purchased the best 2 books I could on the topics of interest (<a href="https://g.co/kgs/kJbTk5" target="_blank">High Performance MySQL</a> and <a href="https://g.co/kgs/7ZgxfK" target="_blank">Ajax Design Patterns</a>) and then requested for Moxie to recoup my investment. This request was approved...but I got a stern talking to about making future purchases without getting all of the approvals first. No problem. I\'ve read the MySQL book maybe 5 times by now, and it has changed the way that I architect data drive applications. I also have a loose development roadmap which will be directing my ongoing R&amp;D for the C<span class="the_R">R</span>NRSTN Suite ::. Any useful results from this research will be incorporated into the C<span class="the_R">R</span>NRSTN Suite in a future release. &lt;/flashback&gt;');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','So beginning in Jan of 2013...while I continued my study of the Holy Scriptures...I picked up the C<span class="the_R">R</span>NRSTN project and (starting from scratch with a much more insightful approach) began to architect and build out this tool. Between July of 2013 and March of 2016 all application development was moved to my pre-Moxie development machine...a circa 2005 Toshiba Portege M100 running Windows XP&reg; pro and Apache as a service (via <a href="https://www.apachefriends.org/" target="_blank">Xampp</a>). The AC power adapter for my 09\' unibody Macbook Pro had broken, and I did not feel to move in a direction to resolve that problem...so good bye for now dear 09\' Macbook Pro. The bulk of this second (fresh from the ground up) iteration of C<span class="the_R">R</span>NRSTN development was done from within the Windows environment.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Fast-forward to March of 2016,...the broken power adapter for my 09\' Macbook Pro was replaced by a good friend of mine, and I immediately copied the C<span class="the_R">R</span>NRSTN project (which was approximately 90% complete) from my 2005 Widows XP Toshiba Portege M100 laptop back to my 09\' Macbook Pro. I then began to painstakingly crawl through both the C<span class="the_R">R</span>NRSTN Suite :: class library and it\'s accompanying documentation web site...testing all the work I had done within the Windows environment on my Toshiba in my 09\' Mac localhost hosting environment. Once I got C<span class="the_R">R</span>NRSTN in shape on my Macbook Pro, a couple of other projects (including a redesign of my personal website <a href="http://jony5.com" target="_blank">jony5.com</a>) fell on my plate, and so I had opportunity to test the implementation of C<span class="the_R">R</span>NRSTN on these new projects and new hosting environments and make changes wherever it made sense.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','December of 2017 came around along with a renewed desire to pick up, complete and release the C<span class="the_R">R</span>NRSTN project, but my 09\' Macbook Pro began to freeze up on me and was not up for the task at hand. I shared my frustrations with my dad, and he offered to get me a new laptop. On Dec. 28 2017, a new 2017 Macbook Pro was purchased for me from the <a href="https://www.apple.com/" target="_blank">Apple</a> store at <a href="https://www.perimetermall.com/en.html" target="_blank">Perimeter Mall</a> in Atlanta, GA; I copied all my project files along with my XP and Ubuntu virtual machines from my 09\' Macbook Pro to the new 2017 Macbook Pro. I then upgraded my Ubuntu Server VM to the latest which brought with it PHP7 (previously, I had only supported PHP5) and the extra work of having to crawl through C<span class="the_R">R</span>NRSTN and the documentation website making updates to account for the new version of PHP. Both PHP5 and PHP7 are now supported by C<span class="the_R">R</span>NRSTN!');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Between Dec of 2017 and April of 2018, I completed a third iterative pass through the C<span class="the_R">R</span>NRSTN class library and the accompanying documentation web site. On top of making updates for PHP7 compatibility, the code for the C<span class="the_R">R</span>NRSTN Suite :: was tightened up a little more, the session and cookie encryption layers were updated to stand on the openssl encryption cipher library (as opposed to the deprecated[PHP5] and removed[PHP7] mcrypt library), and the documentation with the accompanying code examples were thoroughly fleshed out and checked against the C<span class="the_R">R</span>NRSTN Suite :: codebase for clarity and accuracy.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','It is now June 20, 2018, and a hard launch date of July 4, 2018 has been set. The C<span class="the_R">R</span>NRSTN Suite :: version 1.0.0 documentation has been pushed to production, and the <a href="https://github.com/jony5/CRNRSTN" target="_blank">GitHub repository</a> for this project has been updated with the latest release. We have now entered into the realm of soft launch for the C<span class="the_R">R</span>NRSTN Suite :: version 1.0.0. Over the next couple of weeks leading up to the official release date, there will be plenty of &quot;tire kicking&quot;, fine tuning, and copy tweaks. After a solid 6 years spent in thoughtful contemplation and faithful laboring, we are finally ready to go! Thank You, Lord Jesus!');

                break;

                case '/suite_methods/configuration_file/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/crnrstn/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'crnrstn()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    $tmp_str = 'The successful instantiation of a c<span class="the_R">r</span>nrstn :: class 
                                object requires passing a user defined serial key for the purposes of serializing 
                                the environmentally specific configuration profile data that is stored by the 
                                C<span class="the_R">R</span>NRSTN Suite. If there are multiple config files running 
                                within the web application (read as multiple landing pages, micro-sites or web sites within the same hosting 
                                environment/directory structure), this $configSerial parameter needs to be unique 
                                per site in order to prevent resource contention within 
                                C<span class="the_R">R</span>NRSTN\'s internal session management policy whilst going 
                                from site to site. Also and optionally, a second parameter...an integer representing the desired 
                                debug profile...can be passed to the constructor.';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY', $tmp_str);

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','__construct($configSerial, $debugMode=0)');

                    $tmp_param_def = array();
                    $tmp_str = 'Serialization parameter for the C<span class="the_R">R</span>NRSTN Suite configuration 
                                profile. If the hosting environment has multiple C<span class="the_R">R</span>NRSTN 
                                configuration files, the value for this parameter needs to be unique per each 
                                configuration file to prevent resource contention within 
                                C<span class="the_R">R</span>NRSTN\'s internal session management policy.';
                    $tmp_param_def[0]['param_name'] = '$configSerial';
                    $tmp_param_def[0]['param_copy'] = $tmp_str;
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_str = '0=OFF,<br>1=ROLLING APPEND,<br>2=REAL-TIME ERROR_LOG OUTPUT';
                    $tmp_param_def[1]['param_name'] = '$debugMode';
                    $tmp_param_def[1]['param_copy'] = $tmp_str;
                    $tmp_param_def[1]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/addenvironment/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addEnvironment()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/initlogging/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initLogging()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/adddatabase/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDatabase()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/grantexclusiveaccess/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'grantExclusiveAccess()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/denyaccess/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'denyAccess()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/initsessionencryption/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initSessionEncryption()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/initcookieencryption/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initCookieEncryption()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/inittunnelencryption/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initTunnelEncryption()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/requireddetectionmatches/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'requiredDetectionMatches()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/configuration_file/defineenvresource/':
                    $tmp_categ_name = 'Configuration File';
                    $tmp_subcateg_name = 'Configuration File';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'defineEnvResource()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/logging/':
                    $tmp_categ_name = 'Logging';
                    $tmp_subcateg_name = 'Logging';                     # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/logging/error_log/':
                    $tmp_categ_name = 'Logging';
                    $tmp_subcateg_name = 'Logging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'error_log()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/logging/capturenotice/':
                    $tmp_categ_name = 'Logging';
                    $tmp_subcateg_name = 'Logging';                 # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'captureNotice()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/basic_functionality/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/getenvresource/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'getEnvResource()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/return_ocrnrstn_env/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_oCRNRSTN_ENV()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/isset_server_param/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isset_SERVER_param()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/get_server_param/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'get_SERVER_param()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/highlightcode/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'highlightCode()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/highlighttext/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'highlightText()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/generatenewkey/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'generateNewKey()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/capturenotice/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'captureNotice()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/create_adhocvar/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'create_AdHocVar()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/basic_functionality/get_adhocvar/':
                    $tmp_categ_name = 'Basic Functionality';
                    $tmp_subcateg_name = 'Basic Functionality';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'get_AdHocVar()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/device_detection/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);
                    //error_log('43 css - serial='.self::$page_serial);
                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','When it is desired to determine what type of client is making a request to the server, version 2.0.0 of the C<span class="the_R">R</span>NRSTN Suite provides a rich set of crnrstn_user :: class object methods for device detection, session persistence of said device detection results, and the reversion of session data back to a state of agnosticism wherein which C<span class="the_R">R</span>NRSTN can start from "zero" again with respect to meeting the needs of any given use-case scenario.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it\'s developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/isclientmobile/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isClientMobile()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','For the purposes of supporting front-end and back-end functional use case requirements which walk lock-step with the need to accurately determine client device type from the server-side, C<span class="the_R">R</span>NRSTN Suite :: v2.0.0 incorporates into itself an active and developer supported open source PHP project, <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a>, in order to leverage the deep specialization of that project in the areas of mobile device and tablet computer detection over HTTP/S. isClientMobile() will enable the running application to cater to the experience of an end-user request coming from the mobile (and also tablet) device channel.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it\'s developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/isclienttablet/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isClientTablet()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','For the purposes of supporting front-end and back-end functional use case requirements which walk lock-step with the need to accurately determine client device type from the server-side, C<span class="the_R">R</span>NRSTN Suite :: v2.0.0 incorporates into itself an active and developer supported open source PHP project, <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a>, in order to leverage the deep specialization of that project in the areas of mobile device and tablet computer detection over HTTP/S. isClientTablet() will enable the running application to cater to the experience of an end-user request coming from the tablet (and also mobile) device channel.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it\'s developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientTablet($mobileIsTablet=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$mobileIsTablet';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that mobile devices should be treated as tablet computer and where FALSE only allows identified-as-tablet user-agent and HTTP headers to qualify as tablet.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isTablet\'</em> on successful tablet match. <em>\'isMobile\'</em> will be returned, however, if $mobileIsTablet is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a mobile device. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientTablet_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientTablet_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/isclientmobilecustom/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isClientMobileCustom()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','For the purposes of supporting front-end and back-end functional use case requirements which walk lock-step with the need to accurately determine client device type from the server-side, C<span class="the_R">R</span>NRSTN Suite :: v2.0.0 incorporates into itself an active and developer supported open source PHP project, <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a>, in order to leverage the deep specialization of that project in the areas of mobile device and tablet computer detection over HTTP/S. isClientMobileCustom() will enable the running application to cater to the experience of an end-user request coming from the mobile/tablet device channel.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','This functionality stands on top of the <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> project which has been incorporated into C<span class="the_R">R</span>NRSTN Suite v2.0.0. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment. <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> is sponsored by it\'s developers and community, and they send thanks to the JetBrains team for providing <a href="https://www.jetbrains.com/phpstorm/" target="_blank">PHPStorm</a> and <a href="https://www.jetbrains.com/datagrip/" target="_blank">DataGrip</a> licenses for said project.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobileCustom($target_device=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$target_device';
                    $tmp_param_def[0]['param_copy'] = 'A string value representing a particular algorithm to be used to look for a specific mobile device or tablet computer platform. For a list of supported algorithms, you can check out the <a href="http://demo.mobiledetect.net/" target="_blank">Mobile Detect Demo</a>. While there, <strong>please feel free to help them improve the mobile detection algorithms by choosing an appropriate answer from the small user experience feedback form on that demo page. This will help to make future releases of <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> more robust and accurate for everyone...and the C<span class="the_R">R</span>NRSTN Suite ::</strong> They are listed here as well. As of Mobile Detect v2.8.34, the custom detection methods are listed as: 
isiPhone(), isBlackBerry(), isHTC(), isNexus(), isDell(), isMotorola(), isSamsung(), isLG(), isSony(), isAsus(), isNokiaLumia(), isMicromax(), isPalm(), isVertu(), isPantech(), isFly(), isWiko(), isiMobile(), isSimValley(), isWolfgang(), isAlcatel(), isNintendo(), isAmoi(), isINQ(), isOnePlus(), isGenericPhone(), isiPad(), isNexusTablet(), isGoogleTablet(), isSamsungTablet(), isKindle(), isSurfaceTablet(), isHPTablet(), isAsusTablet(), isBlackBerryTablet(), isHTCtablet(), isMotorolaTablet(), isNookTablet(), isAcerTablet(), isToshibaTablet(), isLGTablet(), isFujitsuTablet(), isPrestigioTablet(), isLenovoTablet(), isDellTablet(), isYarvikTablet(), isMedionTablet(), isArnovaTablet(), isIntensoTablet(), isIRUTablet(), isMegafonTablet(), isEbodaTablet(), isAllViewTablet(), isArchosTablet(), isAinolTablet(), isNokiaLumiaTablet(), isSonyTablet(), isPhilipsTablet(), isCubeTablet(), isCobyTablet(), isMIDTablet(), isMSITablet(), isSMiTTablet(), isRockChipTablet(), isFlyTablet(), isbqTablet(), isHuaweiTablet(), isNecTablet(), isPantechTablet(), isBronchoTablet(), isVersusTablet(), isZyncTablet(), isPositivoTablet(), isNabiTablet(), isKoboTablet(), isDanewTablet(), isTexetTablet(), isPlaystationTablet(), isTrekstorTablet(), isPyleAudioTablet(), isAdvanTablet(), isDanyTechTablet(), isGalapadTablet(), isMicromaxTablet(), isKarbonnTablet(), isAllFineTablet(), isPROSCANTablet(), isYONESTablet(), isChangJiaTablet(), isGUTablet(), isPointOfViewTablet(), isOvermaxTablet(), isHCLTablet(), isDPSTablet(), isVistureTablet(), isCrestaTablet(), isMediatekTablet(), isConcordeTablet(), isGoCleverTablet(), isModecomTablet(), isVoninoTablet(), isECSTablet(), isStorexTablet(), isVodafoneTablet(), isEssentielBTablet(), isRossMoorTablet(), isiMobileTablet(), isTolinoTablet(), isAudioSonicTablet(), isAMPETablet(), isSkkTablet(), isTecnoTablet(), isJXDTablet(), isiJoyTablet(), isFX2Tablet(), isXoroTablet(), isViewsonicTablet(), isVerizonTablet(), isOdysTablet(), isCaptivaTablet(), isIconbitTablet(), isTeclastTablet(), isOndaTablet(), isJaytechTablet(), isBlaupunktTablet(), isDigmaTablet(), isEvolioTablet(), isLavaTablet(), isAocTablet(), isMpmanTablet(), isCelkonTablet(), isWolderTablet(), isMediacomTablet(), isMiTablet(), isNibiruTablet(), isNexoTablet(), isLeaderTablet(), isUbislateTablet(), isPocketBookTablet(), isKocasoTablet(), isHisenseTablet(), isHudl(), isTelstraTablet(), isGenericTablet(), isAndroidOS(), isBlackBerryOS(), isPalmOS(), isSymbianOS(), isWindowsMobileOS(), isWindowsPhoneOS(), isiOS(), isiPadOS(), isMeeGoOS(), isMaemoOS(), isJavaOS(), iswebOS(), isbadaOS(), isBREWOS(), isChrome(), isDolfin(), isOpera(), isSkyfire(), isEdge(), isIE(), isFirefox(), isBolt(), isTeaShark(), isBlazer(), isSafari(), isWeChat(), isUCBrowser(), isbaiduboxapp(), isbaidubrowser(), isDiigoBrowser(), isMercury(), isObigoBrowser(), isNetFront(), isGenericBrowser(), and isPaleMoon().';
                    $tmp_param_def[0]['param_required'] = true;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns BOOLEAN TRUE if the algorithm aligns to the connecting client device or FALSE for no match.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve BOOLEAN response as an indication of the existence of conditions which confirm or deny that this is a request originating from a mobile device or tablet computer matching the provided algorithm.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobileCustom_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobileCustom_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/setclientmobile/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'setClientMobile()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Due to the fact that the C<span class="the_R">R</span>NRSTN Suite :: was engineered to sit so "low level" in the grand scheme of an application...sitting directly on top of the running $_SERVER environment and hooking into it at run time, it is necessary to provide functionality that will support the manual/brute force "straight lining" or persisting of the client\'s mobile device identity for the duration of their session (or until resetDeviceDetect() is appropriately called). Otherwise...for example, a mobile device or tablet user (maybe coming to the site from a link in an email) who clicks a link within the LAMP application to view the "desktop version" will still be met with whatever mobile device experience has been prepared in the application...with no way to change their stars. SO SAD! Enter stage left, setClientMobile(). This method forcefully pushes mobile device indicators to the C<span class="the_R">R</span>NRSTN managed session of said user, so that...regardless of their device or activity within the application...the user may receive the experience that they desire without any cursing and frustration. Hooray!!');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','setClientMobile()');

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','TRUE');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Set the client\'s sesson profile in the C<span class="the_R">R</span>NRSTN Suite :: to indicate that they are a mobile device.';
                    $tmp_example_presentation_file = '/common/inc/examples/setClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/setClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/setclienttablet/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'setClientTablet()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Due to the fact that the C<span class="the_R">R</span>NRSTN Suite :: was engineered to sit so "low level" in the grand scheme of an application...sitting directly on top of the running $_SERVER environment and hooking into it at run time, it is necessary to provide functionality that will support the manual/brute force "straight lining" or persisting of the client\'s mobile device identity for the duration of their session (or until resetDeviceDetect() is appropriately called). Otherwise...for example, a mobile device or tablet user (maybe coming to the site from a link in an email) who clicks a link within the LAMP application to view the "desktop version" will still be met with whatever mobile device experience has been prepared in the application...with no way to change their stars. SO SAD! Enter stage left, setClientTablet(). This method forcefully pushes tablet computer indicators to the C<span class="the_R">R</span>NRSTN managed session of said user, so that...regardless of their device or activity within the application...the user may receive the experience that they desire without any cursing and frustration. Hooray!!');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','setClientTablet()');

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','TRUE');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Set the client\'s sesson profile in the C<span class="the_R">R</span>NRSTN Suite :: to indicate that they are a tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/setClientTablet_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/setClientTablet_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/setclientmobilecustom/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'setClientMobileCustom()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Due to the fact that the C<span class="the_R">R</span>NRSTN Suite :: was engineered to sit so "low level" in the grand scheme of an application...sitting directly on top of the running $_SERVER environment and hooking into it at run time, it is necessary to provide functionality that will support the manual/brute force "straight lining" or persisting of the client\'s mobile device identity for the duration of their session (or until resetDeviceDetect() is appropriately called). Otherwise...for example, a mobile device or tablet user (maybe coming to the site from a link in an email) who clicks a link within the LAMP application to view the "desktop version" will still be met with whatever mobile device experience has been prepared in the application...with no way to change their stars. SO SAD! Enter stage left, setClientMobileCustom(). This method forcefully pushes a custom device profile indicator to the C<span class="the_R">R</span>NRSTN managed session of said user, so that...regardless of their device or activity within the application...the user may receive the experience that is desired for them without them needing to provide any cursing and frustration along the way. Hooray!!');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','setClientMobileCustom($target_device=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$target_device';
                    $tmp_param_def[0]['param_copy'] = 'A string value representing a particular algorithm to be used to look for a specific mobile device or tablet computer platform. For a list of supported algorithms, you can check out the <a href="http://demo.mobiledetect.net/" target="_blank">Mobile Detect Demo</a>. While there, <strong>please feel free to help them improve the mobile detection algorithms by choosing an appropriate answer from the small user experience feedback form on that demo page. This will help to make future releases of <a href="http://mobiledetect.net/" target="_blank">Mobile Detect</a> more robust and accurate for everyone...and the C<span class="the_R">R</span>NRSTN Suite ::</strong> They are listed here as well. As of Mobile Detect v2.8.34, the custom detection methods are listed as: 
isiPhone(), isBlackBerry(), isHTC(), isNexus(), isDell(), isMotorola(), isSamsung(), isLG(), isSony(), isAsus(), isNokiaLumia(), isMicromax(), isPalm(), isVertu(), isPantech(), isFly(), isWiko(), isiMobile(), isSimValley(), isWolfgang(), isAlcatel(), isNintendo(), isAmoi(), isINQ(), isOnePlus(), isGenericPhone(), isiPad(), isNexusTablet(), isGoogleTablet(), isSamsungTablet(), isKindle(), isSurfaceTablet(), isHPTablet(), isAsusTablet(), isBlackBerryTablet(), isHTCtablet(), isMotorolaTablet(), isNookTablet(), isAcerTablet(), isToshibaTablet(), isLGTablet(), isFujitsuTablet(), isPrestigioTablet(), isLenovoTablet(), isDellTablet(), isYarvikTablet(), isMedionTablet(), isArnovaTablet(), isIntensoTablet(), isIRUTablet(), isMegafonTablet(), isEbodaTablet(), isAllViewTablet(), isArchosTablet(), isAinolTablet(), isNokiaLumiaTablet(), isSonyTablet(), isPhilipsTablet(), isCubeTablet(), isCobyTablet(), isMIDTablet(), isMSITablet(), isSMiTTablet(), isRockChipTablet(), isFlyTablet(), isbqTablet(), isHuaweiTablet(), isNecTablet(), isPantechTablet(), isBronchoTablet(), isVersusTablet(), isZyncTablet(), isPositivoTablet(), isNabiTablet(), isKoboTablet(), isDanewTablet(), isTexetTablet(), isPlaystationTablet(), isTrekstorTablet(), isPyleAudioTablet(), isAdvanTablet(), isDanyTechTablet(), isGalapadTablet(), isMicromaxTablet(), isKarbonnTablet(), isAllFineTablet(), isPROSCANTablet(), isYONESTablet(), isChangJiaTablet(), isGUTablet(), isPointOfViewTablet(), isOvermaxTablet(), isHCLTablet(), isDPSTablet(), isVistureTablet(), isCrestaTablet(), isMediatekTablet(), isConcordeTablet(), isGoCleverTablet(), isModecomTablet(), isVoninoTablet(), isECSTablet(), isStorexTablet(), isVodafoneTablet(), isEssentielBTablet(), isRossMoorTablet(), isiMobileTablet(), isTolinoTablet(), isAudioSonicTablet(), isAMPETablet(), isSkkTablet(), isTecnoTablet(), isJXDTablet(), isiJoyTablet(), isFX2Tablet(), isXoroTablet(), isViewsonicTablet(), isVerizonTablet(), isOdysTablet(), isCaptivaTablet(), isIconbitTablet(), isTeclastTablet(), isOndaTablet(), isJaytechTablet(), isBlaupunktTablet(), isDigmaTablet(), isEvolioTablet(), isLavaTablet(), isAocTablet(), isMpmanTablet(), isCelkonTablet(), isWolderTablet(), isMediacomTablet(), isMiTablet(), isNibiruTablet(), isNexoTablet(), isLeaderTablet(), isUbislateTablet(), isPocketBookTablet(), isKocasoTablet(), isHisenseTablet(), isHudl(), isTelstraTablet(), isGenericTablet(), isAndroidOS(), isBlackBerryOS(), isPalmOS(), isSymbianOS(), isWindowsMobileOS(), isWindowsPhoneOS(), isiOS(), isiPadOS(), isMeeGoOS(), isMaemoOS(), isJavaOS(), iswebOS(), isbadaOS(), isBREWOS(), isChrome(), isDolfin(), isOpera(), isSkyfire(), isEdge(), isIE(), isFirefox(), isBolt(), isTeaShark(), isBlazer(), isSafari(), isWeChat(), isUCBrowser(), isbaiduboxapp(), isbaidubrowser(), isDiigoBrowser(), isMercury(), isObigoBrowser(), isNetFront(), isGenericBrowser(), and isPaleMoon().';
                    $tmp_param_def[0]['param_required'] = true;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','TRUE');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Set the client\'s sesson profile in the C<span class="the_R">R</span>NRSTN Suite :: to indicate that they are a very specific kind of device/computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/setClientMobileCustom_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/setClientMobileCustom_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/device_detection/resetdevicedetect/':
                    $tmp_categ_name = 'Device Detection';
                    $tmp_subcateg_name = 'Device Detection';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'resetDeviceDetect()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Due to the fact that the C<span class="the_R">R</span>NRSTN Suite :: was engineered to sit so "low level" in the grand scheme of an application...sitting directly on top of the running $_SERVER environment and hooking into it at run time, it is necessary to provide functionality that will support the manual/brute force "straight lining" or persisting of the client\'s mobile device identity for the duration of their session (or until resetDeviceDetect() is appropriately called). Otherwise...for example, a mobile device or tablet user (maybe coming to the site from a link in an email) who clicks another link within the LAMP application to view the "desktop version" will still be met with whatever mobile device experience has been prepared in the application...with no way to change their stars. SO SAD! It stands to be said, therefore, that there was no choice but to create resetDeviceDetect() as a reversion enabling component for the device detection functionality within the C<span class="the_R">R</span>NRSTN Suite :: wherein mobile device/tablet computer profile data...which has been pushed to the session for persistence with the user\'s experience...can thereupon be reset, and the user\'s experience in the application can return to "zero" to re-open opportunity for the persistence of other (read as "desktop") use-case scenarios.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','resetDeviceDetect()');

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','TRUE');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Set the client\'s sesson profile in the C<span class="the_R">R</span>NRSTN Suite :: to indicate that they are a mobile device. We then use resetDeviceDetect() on Line 20 to return to "zero" so that the user can still access the desktop version (literally,...in this case) of the C<span class="the_R">R</span>NRSTN Suite :: documentation site.<br><br>resetDeviceDetect() needs only to be called if setClientMobile(), setClientTablet(), or setClientMobileCustom() are called, and there is the desire to reset the user\'s session in order to reopen opportunity for desktop experiences within the application in the same user session.';
                    $tmp_example_presentation_file = '/common/inc/examples/resetDeviceDetect_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/resetDeviceDetect_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/web_services/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returncontent/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnContent()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnfault/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnFault()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnerror/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnError()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnresult/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnResult()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnclientrequest/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnClientRequest()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnclientresponse/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnClientResponse()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/web_services/returnclientgetdebug/':
                    $tmp_categ_name = 'Web Services';
                    $tmp_subcateg_name = 'Web Services';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnClientGetDebug()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/date_time/':
                    $tmp_categ_name = 'Date Time';
                    $tmp_subcateg_name = 'Date Time';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/date_time/elapsedtimemonitorfor/':
                    $tmp_categ_name = 'Date Time';
                    $tmp_subcateg_name = 'Date Time';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'elapsedTimeMonitorFor()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/date_time/prettydeltatime/':
                    $tmp_categ_name = 'Date Time';
                    $tmp_subcateg_name = 'Date Time';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'prettyDeltaTime()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/date_time/walltime/':
                    $tmp_categ_name = 'Date Time';
                    $tmp_subcateg_name = 'Date Time';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'wallTime()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/ip_address/':
                    $tmp_categ_name = 'IP Address';
                    $tmp_subcateg_name = 'IP Address';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/ip_address/returnclientip/':
                    $tmp_categ_name = 'IP Address';
                    $tmp_subcateg_name = 'IP Address';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnClientIP()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/ip_address/exclusiveaccess/':
                    $tmp_categ_name = 'IP Address';
                    $tmp_subcateg_name = 'IP Address';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'exclusiveAccess()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/ip_address/denyipaccess/':
                    $tmp_categ_name = 'IP Address';
                    $tmp_subcateg_name = 'IP Address';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'denyIPAccess()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/http_management/':
                    $tmp_categ_name = 'HTTP Management';
                    $tmp_subcateg_name = 'HTTP Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/http_management/isset_transport_protocol/':
                    $tmp_categ_name = 'HTTP Management';
                    $tmp_subcateg_name = 'HTTP Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isset_transport_protocol()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/http_management/isset_http_param/':
                    $tmp_categ_name = 'HTTP Management';
                    $tmp_subcateg_name = 'HTTP Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isset_HTTP_param()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/http_management/extract_http_paramvalue/':
                    $tmp_categ_name = 'HTTP Management';
                    $tmp_subcateg_name = 'HTTP Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'extract_HTTP_paramValue()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/http_management/return_http_headers/':
                    $tmp_categ_name = 'HTTP Management';
                    $tmp_subcateg_name = 'HTTP Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_HTTP_headers()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/cookie_management/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/addcookie/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addCookie()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/addrawcookie/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addRawCookie()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/getcookie/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'getCookie()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/deletecookie/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'deleteCookie()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/cookie_management/deleteallcookies/':
                    $tmp_categ_name = 'Cookie Management';
                    $tmp_subcateg_name = 'Cookie Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'deleteAllCookies()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/session_management/':
                    $tmp_categ_name = 'Session Management';
                    $tmp_subcateg_name = 'Session Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/session_management/getsessionparam/':
                    $tmp_categ_name = 'Session Management';
                    $tmp_subcateg_name = 'Session Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'getSessionParam()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/session_management/setsessionparam/':
                    $tmp_categ_name = 'Session Management';
                    $tmp_subcateg_name = 'Session Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'setSessionParam()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/session_management/issetsessionparam/':
                    $tmp_categ_name = 'Session Management';
                    $tmp_subcateg_name = 'Session Management';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'issetSessionParam()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/tunnel_encryption/':

                    $tmp_categ_name = 'HTTP Encryption Tunneling';
                    $tmp_subcateg_name = 'HTTP Encryption Tunneling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Application security and data hygiene can be <strong>significantly enhanced</strong> with the basic and consistent (only as strong as the weakest link) utilization of the C<span class="the_R">R</span>NRSTN Suite v2.0.0 and its encryption tunneling protocols. Sending data safely server to server (e.g. SOAP) and 
between the server and client can be achieved with minimal effort and maximum data integrity through the strategic application of this functionality across all data touch points within your application(s). I have some apps where all data contained within hidden form fields is encrypted. When I have foreign keys appended to a link that will go directly into the hidden fields of a form...and then directly into my database!!..I will NOT spend additional server resources to confirm their accuracy <strong>before the MySQL INSERT</strong> by racking up extra and peripheral MySQL database hits. If the data is corrupted in the link, paramTunnelDecrypt() will throw an exception that can be handled with grace before the face of the end user (which could be my boss), and the database will only receive bona fide clean data.');

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','There are many encryption algorithms available...even version to version (or configuration) of PHP...and they have different requirements as far as the processing resources (memory) needed for them to execute. Before <strong>globally</strong> applying a layer of encryption to a high traffic application, it is recommended that some baseline performance metrics be established and that at least some load testing be performed to ensure that the chosen encrypt/decrypt algorithm will not cause debilitating (e.g. leading to significant site response lag or crash) spikes in the resource requirements of the overall application.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Send data to hidden fields of a form or append variables to a link after 1) passing the raw data through paramTunnelEncrypt() and 2) receiving in return a unique and encrypted string that can be used in the form or link and then taken to point of insertion and decrypted at that location before..for example...a MySQL database INSERT. Be creative to save time and your effort; you can even append several sensitive parameters together (delimited by pipe, comma, ampersand, etc.), encrypt the entire string, and send it to where you need it before decryption and further processing to conclusion. For <a href="https://www.youtube.com/watch?v=LZosMwonEPM" target="_blank">just one second</a>, imagine ALL links in your site...apparently...having only one (1) variable (the name of which never changes) at the end.  ;)  Please note, objects and arrays are a couple of data structures that CANNOT BE ENCRYPTED (but...who puts an object in a hidden text input field of a form anyways, right?).';
                    $tmp_example_presentation_file = '/common/inc/examples/paramTunnelEncrypt_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/paramTunnelEncrypt_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/tunnel_encryption/paramtunnelencrypt/':

                    $tmp_categ_name = 'HTTP Encryption Tunneling';
                    $tmp_subcateg_name = 'HTTP Encryption Tunneling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'paramTunnelEncrypt()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Application security and data hygiene can be <strong>significantly enhanced</strong> with the basic and consistent (only as strong as the weakest link) utilization of the C<span class="the_R">R</span>NRSTN Suite v2.0.0 and its encryption tunneling protocols. Sending data safely server to server (e.g. SOAP) and between the server and client can be achieved with minimal effort and maximum data integrity through the strategic application of this functionality across all data touch points within your application(s). I have some apps where all data contained within hidden form fields is encrypted. When I have foreign keys appended to a link that will go directly into the hidden fields of a form...and then directly into my database!!..I will NOT spend additional server resources to confirm their accuracy <strong>before the MySQL INSERT</strong> by racking up extra and peripheral MySQL database hits. If the data is corrupted in the link, paramTunnelDecrypt() will throw an exception that can be handled with grace before the face of the end user (which could be my boss), and the database will only receive bona fide clean data.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','There are many encryption algorithms available...even version to version (or configuration) of PHP...and they have different requirements as far as the processing resources (memory) needed for them to execute. Before <strong>globally</strong> applying a layer of encryption to a high traffic application, it is recommended that some baseline performance metrics be established and that at least some load testing be performed to ensure that the chosen encrypt/decrypt algorithm will not cause debilitating (e.g. leading to significant site response lag or crash) spikes in the resource requirements of the overall application.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
                    $tmp_spec_array[2] = 'Some hash_algos() returned methods will NOT be compatible with hash_hmac() which C<span class="the_R">R</span>NRSTN Suite :: v2.0.0 uses in validating its decryption. And certain openssl encryption cipher / hash_algos algorithm combinations will not be compatible. Please test the compatibility of your desired combination of encryption cipher and hmac algoritm for each environment...especially before releasing to production code base.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','paramTunnelEncrypt($data=NULL, $cipher_override=NULL, $secret_key_override=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$data';
                    $tmp_param_def[0]['param_copy'] = 'The data that is to be encrypted. Please note, only string, integer, double, float, int data types will be successfully processed. All other data types will return NULL.';
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_param_def[1]['param_name'] = '$secret_key';
                    $tmp_param_def[1]['param_copy'] = 'If it is desired to override the environmentally specific and globally applied openssl-encryption-key passed into initTunnelEncryption(), this parameter will be used in place of the openssl encryption key provided there in the C<span class="the_R">R</span>NRSTN Suite :: configuration file for all of the environments within which the application code base will be running.';
                    $tmp_param_def[1]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','The raw data in an encrypted format or NULL on error...i.e. if the data is not able to be encrypted.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Send data to hidden fields of a form or append variables to a link after 1) passing the raw data through paramTunnelEncrypt() and 2) receiving in return a unique and encrypted string that can be used in the form or link and then taken to point of insertion and decrypted at that location before..for example...a MySQL database INSERT. Be creative to save time and your effort; you can even append several sensitive parameters together (delimited by pipe, comma, ampersand, etc.), encrypt the entire string, and send it to where you need it before decryption and further processing to conclusion. For <a href="https://www.youtube.com/watch?v=LZosMwonEPM" target="_blank">just one second</a>, imagine ALL links in your site...apparently...having only one (1) variable (the name of which never changes) at the end.  ;)  Please note, objects and arrays are a couple of data structures that CANNOT BE ENCRYPTED (but...who puts an object in a hidden text input field of a form anyways, right?).';
                    $tmp_example_presentation_file = '/common/inc/examples/paramTunnelEncrypt_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/paramTunnelEncrypt_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/tunnel_encryption/paramtunneldecrypt/':

                    $tmp_categ_name = 'HTTP Encryption Tunneling';
                    $tmp_subcateg_name = 'HTTP Encryption Tunneling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'paramTunnelDecrypt()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Application security and data hygiene can be <strong>significantly enhanced</strong> with the basic and consistent (only as strong as the weakest link) utilization of the C<span class="the_R">R</span>NRSTN Suite v2.0.0 and its encryption tunneling protocols. Sending data safely server to server (e.g. SOAP) and 
between the server and client can be achieved with minimal effort and maximum data integrity through the strategic application of this functionality across all data touch points within your application(s). I have some apps where all data contained within hidden form fields is encrypted. When I have foreign keys appended to a link that will go directly into the hidden fields of a form...and then directly into my database!!..I will NOT spend additional server resources to confirm their accuracy <strong>before the MySQL INSERT</strong> by racking up extra and peripheral MySQL database hits. If the data is corrupted in the link, paramTunnelDecrypt() will throw an exception that can be handled with grace before the face of the end user (which could be my boss), and the database will only receive bona fide clean data.');

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','There are many encryption algorithms available...even version to version (or configuration) of PHP...and they have different requirements as far as the processing resources (memory) needed for them to execute. Before <strong>globally</strong> applying a layer of encryption to a high traffic application, it is recommended that some baseline performance metrics be established and that at least some load testing be performed to ensure that the chosen encrypt/decrypt algorithm will not cause debilitating (e.g. leading to significant site response lag or crash) spikes in the resource requirements of the overall application.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
                    $tmp_spec_array[2] = 'Some hash_algos() returned methods will NOT be compatible with hash_hmac() which C<span class="the_R">R</span>NRSTN Suite :: v2.0.0 uses in validating its decryption. And certain openssl encryption cipher / hash_algos algorithm combinations will not be compatible. Please test the compatibility of your desired combination of encryption cipher and hmac algorithm for each environment...especially before releasing to production code base.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','paramTunnelDecrypt($data=NULL, $uri_passthrough=false, $cipher_override=NULL, $secret_key_override=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$data';
                    $tmp_param_def[0]['param_copy'] = 'The data that is to be encrypted. Please note, only <em>string</em>, <em>integer</em>, <em>double</em>, <em>float</em>, and <em>int</em> data types will be successfully processed. All other data types will return NULL.';
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_param_def[1]['param_name'] = '$uri_passthrough';
                    $tmp_param_def[1]['param_copy'] = 'When openssl tunnel encrypted data is sent through GET, this should be TRUE. Due to the character sets <a href="https://www.youtube.com/watch?v=217CdX7Z2tM" target="_blank">emerging</a> from many openssl encryption algorithms, it is necessary to clean the string before successful decryption can be accomplished. Otherwise, an exception will be thrown. Therefore, this is actually a required parameter when the data transport mechanism is HTTP/S GET.';
                    $tmp_param_def[1]['param_required'] = false;

                    $tmp_param_def[2]['param_name'] = '$secret_key';
                    $tmp_param_def[2]['param_copy'] = 'If it is desired to override the environmentally specific and globally applied openssl-encryption-key passed into initTunnelEncryption(), this parameter will be used in place of the openssl encryption key provided there in the C<span class="the_R">R</span>NRSTN Suite :: configuration file for all of the environments within which the application code base will be running.';
                    $tmp_param_def[2]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','The raw data in an encrypted format or NULL on error...i.e. if the data is not able to be encrypted.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Send data to hidden fields of a form or append variables to a link after 1) passing the raw data through paramTunnelEncrypt() and 2) receiving in return a unique and encrypted string that can be used in the form or link and then taken to point of insertion and decrypted at that location before..for example...a MySQL database INSERT. Be creative to save time and your effort; you can even append several sensitive parameters together (delimited by pipe, comma, ampersand, etc.), encrypt the entire string, and send it to where you need it before decryption and further processing to conclusion. For <a href="https://www.youtube.com/watch?v=LZosMwonEPM" target="_blank">just one second</a>, imagine ALL links in your site...apparently...having only one (1) variable (the name of which never changes) at the end.  ;)  Please note, objects and arrays are a couple of data structures that CANNOT BE ENCRYPTED (but...who puts an object in a hidden text input field of a form anyways, right?).';
                    $tmp_example_presentation_file = '/common/inc/examples/paramTunnelDecrypt_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/paramTunnelDecrypt_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/tunnel_encryption/istunnelencryptconfigured/':
                    $tmp_categ_name = 'HTTP Encryption Tunneling';
                    $tmp_subcateg_name = 'HTTP Encryption Tunneling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isTunnelEncryptConfigured()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/mysql_database/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';      # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','If your application touches n+1 database instances, the C<span class="the_R">R</span>NRSTN :: Suite v2.0.0 is going to be the release wherein you would want to fully sign on. In v1.0.0, C<span class="the_R">R</span>NRSTN :: laid a solid foundation for database support with its responsible and intelligent n+1 database connection management and mysqli batching of SQL request submissions to the database. However, as far as how to store and recall the data returned through said database connection(s)...this huge burden was still left to the whims of the wild wild west of web development.<br><br>Enter C<span class="the_R">R</span>NRSTN :: Suite v2.0.0! Territory has been expanded FAR BEYOND the database connection management and request delivery methods (which simply "send the query") boundaries. Requests will be batched together (per each connection), and...new to v2.0.0...micro-batches of query requests to the database connection can be carved out if desired. All query results are aggregated into and persisted by C<span class="the_R">R</span>NRSTN ::, and there are plans are for future releases to be able to cache any desired results (or query) to SESSION for persistence...and this is with seamless access to the "same" result set through the same methods. With query cache management will come configurable TTL restrictions for this result set data in session. <br><br>Currently in C<span class="the_R">R</span>NRSTN :: Suite v2.0.0, all results can be de-normalized (in memory) on up to 10 simultaneous fields (at the same time) to facilitate direct pointer lookup of result set values. One can also check for the existence of a result set, record count of a result set, or even the existence of a value within the result set (no loops...only pointers!). Finally, accessing and handling any database results for their output, manipulation, or use to construct additional query (for n+1 round trips to the database) is done programmatically with the use of a few simple methods. With C<span class="the_R">R</span>NRSTN :: Suite v2.0.0, expect a reduction in your database troubles, and an increase in efficiency with all things database.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Here, a database connection is made, and a query is sent to the database with some minor checks and tests being performed on the result data set afterwards.';
                    $tmp_example_presentation_file = '/common/inc/examples/returnConnection_MySQLi_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/returnConnection_MySQLi_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/returnconnection_mysqli/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnConnection_MySQLi()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','If your application touches n+1 database instances, the C<span class="the_R">R</span>NRSTN :: Suite v2.0.0 is going to be the release wherein you would want to fully sign on. In v1.0.0, C<span class="the_R">R</span>NRSTN :: laid a solid foundation for database support with its responsible and intelligent n+1 database connection management and mysqli batching of SQL request submissions to the database. However, as far as how to store and recall the data returned through said database connection(s)...this huge burden was still left to the whims of the wild wild west of web development.<br><br>Enter C<span class="the_R">R</span>NRSTN :: Suite v2.0.0! Territory has been expanded FAR BEYOND the database connection management and request delivery methods (which simply "send the query") boundaries. Requests will be batched together (per each connection), and...new to v2.0.0...micro-batches of query requests to the database connection can be carved out if desired. All query results are aggregated into and persisted by C<span class="the_R">R</span>NRSTN ::, and there are plans are for future releases to be able to cache any desired results (or query) to SESSION for persistence...and this is with seamless access to the "same" result set through the same methods. With query cache management will come configurable TTL restrictions for this result set data in session. <br><br>Currently in C<span class="the_R">R</span>NRSTN :: Suite v2.0.0, all results can be de-normalized (in memory) on up to 10 simultaneous fields (at the same time) to facilitate direct pointer lookup of result set values. One can also check for the existence of a result set, record count of a result set, or even the existence of a value within the result set (no loops...only pointers!). Finally, accessing and handling any database results for their output, manipulation, or use to construct additional query (for n+1 round trips to the database) is done programmatically with the use of a few simple methods. With C<span class="the_R">R</span>NRSTN :: Suite v2.0.0, expect a reduction in your database troubles, and an increase in efficiency with all things database.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','paramTunnelDecrypt($data=NULL, $uri_passthrough=false, $cipher_override=NULL, $secret_key_override=NULL)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$data';
                    $tmp_param_def[0]['param_copy'] = 'The data that is to be encrypted. Please note, only <em>string</em>, <em>integer</em>, <em>double</em>, <em>float</em>, and <em>int</em> data types will be successfully processed. All other data types will return NULL.';
                    $tmp_param_def[0]['param_required'] = true;

                    $tmp_param_def[1]['param_name'] = '$uri_passthrough';
                    $tmp_param_def[1]['param_copy'] = 'When openssl tunnel encrypted data is sent through GET, this should be TRUE. Due to the character sets <a href="https://www.youtube.com/watch?v=217CdX7Z2tM" target="_blank">emerging</a> from many openssl encryption algorithms, it is necessary to clean the string before successful decryption can be accomplished. Otherwise, an exception will be thrown. Therefore, this is actually a required parameter when the data transport mechanism is HTTP/S GET.';
                    $tmp_param_def[1]['param_required'] = false;

                    $tmp_param_def[2]['param_name'] = '$secret_key';
                    $tmp_param_def[2]['param_copy'] = 'If it is desired to override the environmentally specific and globally applied openssl-encryption-key passed into initTunnelEncryption(), this parameter will be used in place of the openssl encryption key provided there in the C<span class="the_R">R</span>NRSTN Suite :: configuration file for all of the environments within which the application code base will be running.';
                    $tmp_param_def[2]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','The raw data in an encrypted format or NULL on error...i.e. if the data is not able to be encrypted.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Here, a database connection is made, and a query is sent to the database with some minor checks and tests being performed on the result data set afterwards.';
                    $tmp_example_presentation_file = '/common/inc/examples/returnConnection_MySQLi_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/returnConnection_MySQLi_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/returnconnobject/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnConnObject()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/returnconnserial/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnConnSerial()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/new_crnrstn_query_profile_manager/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'new crnrstn_query_profile_manager()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/loadqueryprofile/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'loadQueryProfile()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/adddatabasequery/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDatabaseQuery()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/processquery/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'processQuery()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/returndatabasevalue/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnDatabaseValue()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/initlookupbyid/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initLookupByID()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/addlookupfielddata/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addLookupFieldData()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/loadpreviousrecordlookup/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'loadPreviousRecordLookup()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/retrievedatabyid/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'retrieveDataByID()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/pingvalueexistence/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'pingValueExistence()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/pingresultsetexistence/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'pingResultSetExistence()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/resultsetmerge/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'resultSetMerge()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/returnrecordcount/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnRecordCount()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/return_querydatetimestamp/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'return_queryDateTimeStamp()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/mysql_database/closeconnection_mysqli/':
                    $tmp_categ_name = 'MySQL Database Query/Response';
                    $tmp_subcateg_name = 'MySQL Database Query/Response';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'closeConnection_MySQLi()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/form_handling/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/initfi_handle/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initFI_handle()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/addfi_input_listener/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addFI_Input_Listener()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/addfi_hiddeninput_listener/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addFI_HiddenInput_Listener()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/redirectfi_onvalidation/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'redirectFI_OnValidation()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/errmsgfi_inputvalidation/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'errMsgFI_InputValidation()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/inputfi_prepopulateValue/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'inputFI_PrepopulateValue()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/injectfi_serializedpack/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'injectFI_SerializedPack()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/receivefi_packet/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'receiveFI_Packet()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/returnvalue_datafi_input/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnValue_dataFI_Input()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/isvalid_datafi_validcheck/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isValid_dataFI_ValidCheck()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/form_handling/returnerr_datafi_validcheck/':
                    $tmp_categ_name = 'Form Handling';
                    $tmp_subcateg_name = 'Form Handling';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnErr_dataFI_ValidCheck()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;

                case '/suite_methods/pagination/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/totalpgnate_results_increment/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'totalPGNATE_results_increment()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);
    
                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');
    
                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
    
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');
    
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;
    
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');
    
                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/setpgnate_max_result_count/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'setPGNATE_max_result_count()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);
    
                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');
    
                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
    
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');
    
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;
    
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');
    
                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/returnpgnate_serial/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnPGNATE_Serial()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);
    
                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');
    
                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';
    
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');
    
                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;
    
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');
    
                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/specifypgnate_httpvar/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'specifyPGNATE_HTTPVar()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/addpgnate_passthroughinputVal/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addPGNATE_PassthroughInputVal()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/pagination/returnpgnate_currentpage/':
                    $tmp_categ_name = 'Pagination';
                    $tmp_subcateg_name = 'Pagination';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'returnPGNATE_CurrentPage()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/email_messaging/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                case '/suite_methods/email_messaging/initialize_ogabriel/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'initialize_oGabriel()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addhostservers/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addHostServers()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addreplyto/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addReplyTo()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addfrom/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addFrom()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/wordwrap/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'wordWrap()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/ishtml/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isHTML()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addsubject/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addSubject()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addmsgbody_htmlversion/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addMsgBody_HTMLversion()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addmsgbody_textversion/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addMsgBody_HTMLversion()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/suppressemailduplicates/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'suppressEmailDuplicates()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/optoutdonotsendemail/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'optOutDoNotSendEmail()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addaddress/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addAddress()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addcc/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addCC()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addbcc/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addBCC()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;

                case '/suite_methods/email_messaging/adddynamiccontent_subject/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDynamicContent_SUBJECT()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/adddynamiccontent_html/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDynamicContent_HTML()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/adddynamiccontent_text/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDynamicContent_TEXT()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/adddynamiccontent_multipart/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addDynamicContent_MULTIPART()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/ogabriel_send/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'oGabriel_Send()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addaddressbulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addAddressBulk()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addhtmlver_bulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addHTMLver_Bulk()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addtextver_bulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addTEXTver_Bulk()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/ishtmlbulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'isHTMLBulk()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/wordwrapbulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'wordWrapBulk()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addreplytobulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addReplyToBulk()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addfrombulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addFromBulk()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/addsubjectbulk/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'addSubjectBulk()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/batchreadytosend/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'batchReadyToSend()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/sendstatusreportemail/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'sendStatusReportEmail()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/email_messaging/ogabriel_sendreport/':
                    $tmp_categ_name = 'Email Messaging';
                    $tmp_subcateg_name = 'Email Messaging';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = 'oGabriel_SendReport()';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                    break;
                case '/suite_methods/multi_language/returnpgnate_currentpage/':
                    $tmp_categ_name = 'Multi-Language Support';
                    $tmp_subcateg_name = 'Multi-Language Support';            # MATCHES SECTION TITLE LINK COPY
                    $tmp_subsubcat_name = '';
                    self::$page_serial = self::$oSideBitch_usr->initializePage('PAGE', $tmp_categ_name, $tmp_subcateg_name, $tmp_subsubcat_name);

                    //
                    // NOW COMPILE PAGE CONTENT IN ORDER OF PRESENTATION...TOP TO BOTTOM
                    // BASIC_COPY,NOTE_COPY,TECH_SPEC,INVOKING_CLASS,METHOD_DEFINITION,PARAMETER_DEFINITION,RETURNED_VALUE,EXAMPLE
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'BASIC_COPY','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu augue vel risus commodo porta ut viverra nibh. Cras placerat augue urna, congue facilisis urna dapibus nec. Aenean eget justo tortor. Aenean sit amet sem non nunc vulputate pellentesque. Nunc hendrerit scelerisque felis, vitae elementum lectus malesuada in. Integer vehicula odio convallis sem cursus, ac tempus erat mollis. In dapibus lobortis dui id sagittis.');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'NOTE_COPY','Fusce ipsum tellus, bibendum sit amet rhoncus in, facilisis at lectus. Fusce a augue maximus, pulvinar turpis vel, consectetur lacus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed turpis quam, bibendum at interdum eu, pharetra et tellus. Nam pharetra quam vel libero gravida aliquam. Curabitur consectetur felis a aliquam congue.');

                    //
                    // TECH SPECS...PASS IN ARRAY OF SPECS
                    $tmp_spec_array = array();
                    $tmp_spec_array[0] = 'Currently tested on an Ubuntu Server 18.04 running PHP 7.0.22/MySQLi 5.0.12 and CentOS 7 Linux (a 100% compatible rebuild of the Red Hat Enterprise Linux) running PHP 5.6.32/MySQLi 5.5.58.';
                    $tmp_spec_array[1] = 'It is recommended that you upgrade to the latest official release of PHP to take advantage of gains in security and processing efficiency together with the latest features and functionality.';

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'TECH_SPEC', $tmp_spec_array);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'INVOKING_CLASS','crnrstn_user');
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'METHOD_DEFINITION','isClientMobile($tabletIsMobile=false)');

                    $tmp_param_def = array();
                    $tmp_param_def[0]['param_name'] = '$tabletIsMobile';
                    $tmp_param_def[0]['param_copy'] = 'Boolean value where TRUE indicates that tablet devices should be treated as mobile and where FALSE only allows identified-as-mobile user-agent and HTTP headers to qualify as mobile.';
                    $tmp_param_def[0]['param_required'] = false;

                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'PARAMETER_DEFINITION', $tmp_param_def);
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'RETURNED_VALUE','Returns a string <em>\'isMobile\'</em> on successful mobile match. <em>\'isTablet\'</em> will be returned, however, if $tabletIsMobile is passed in as TRUE and the User-Agent and HTTP headers indicate that the client is a tablet computer. FALSE is returned for non-successful matches.');

                    $tmp_example_title_str = 'Example 1';
                    $tmp_example_description_str = 'Retrieve a multi data-type response as indication of the existence of conditions which...to a high degree of probability...confirm (or deny) that this is a request originating from a mobile device or tablet computer.';
                    $tmp_example_presentation_file = '/common/inc/examples/isClientMobile_show.php';
                    $tmp_example_execute_file = '/common/inc/examples/isClientMobile_exec.php';
                    self::$oSideBitch_usr->addPageElement(self::$page_serial,'EXAMPLE', $tmp_example_title_str, $tmp_example_description_str, $tmp_example_presentation_file, $tmp_example_execute_file);

                break;
                default:

                    //
                    // HOOOSTON...VE HAF PROBLEM!
                    throw new Exception('Error building page ['.$this->page_path.'] due to missing loadContent() switch case.');

                break;

            }

        } catch (Exception $e) {
            //
            // SEND THIS THROUGH THE LOGGER OBJECT
            //self::$oLogger->captureNotice('content_source_controller->loadContent()', LOG_EMERG, $e->getMessage());
            self::$oCRNRSTN_USR->catchException($e, LOG_ERR, __METHOD__, __NAMESPACE__);
        }

    }

    public function returnPageSerial(){

        return self::$page_serial;
    }

    public function returnLoadedBitch(){

        return self::$oSideBitch_usr;

    }

	public function __destruct() {
		
	}
}