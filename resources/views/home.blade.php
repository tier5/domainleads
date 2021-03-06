<!DOCTYPE html>
<!--
 * A Design by GraphBerry
 * Author: GraphBerry
 * Author URL: http://graphberry.com
 * License: http://graphberry.com/pages/license
-->
<html lang="en">
    
    <head>
        <meta charset=utf-8>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Domian Leads</title>
        <!-- Load Roboto font -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
        <!-- Load css styles -->

		{!! Html::style('theme/css/bootstrap.css') !!}
		{!! Html::style('theme/css/bootstrap-responsive.css') !!}
		{!! Html::style('theme/css/style.css') !!}
		{!! Html::style('theme/css/pluton.css') !!}
        
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="css/pluton-ie7.css" />
        <![endif]-->
		{!! Html::style('theme/css/jquery.cslider.css') !!}
		{!! Html::style('theme/css/jquery.bxslider.css') !!}
		{!! Html::style('theme/css/animate.css') !!}
		
    
      
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57.png">
        <link rel="shortcut icon" href="images/ico/favicon.ico">
    </head>
    
    <body>
   

        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a href="#" class="brand">
					
                        <!--<img src="images/logo.png" width="120" height="40" alt="Logo" />-->
						{!! HTML :: image('theme/images/logo.png')!!}
                        <!-- This is website logo -->
                    </a>
                    <!-- Navigation button, visible on small resolution -->
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <i class="icon-menu"></i>
                    </button>
                    <!-- Main navigation -->
                    <div class="nav-collapse collapse pull-right">
                        <ul class="nav" id="top-navigation">
                            <li class="active"><a href="{{url('/')}}">Home</a></li>
                            <li><a href="#service">Services</a></li>
                            <li><a href="#portfolio">How it works</a></li>
                            <li><a href="#about">About</a></li>
                            <li><a href="#clients">Clients</a></li>
                            <li><a href="{{url('/')}}/plans">Plans</a></li>
                            <li><a href="#price">Pricing</a></li>
                             @if (Auth::check())
                             <li> <a href="{{ URL::to('postSearchData') }}">Search Domain</a></li>
                             <li> <a href="{{ URL::to('logout') }}">Logout</a></li>
                              @else 


                            <li> <button class="" id="popupid" data-toggle="modal" data-target="#myModal">SignIn</button></li>
                            <li><button class="" id="popupid_for_reg" data-toggle="modal" data-target="#myModal_for_reg">SignUp</button></li>
                            @endif
                        </ul>
                       
                    </div>
                    <!-- End main navigation -->
                </div>
            </div>
        </div>
        <!-- Start home section -->
        <div id="home">
            <!-- Start cSlider -->
            <div id="da-slider" class="da-slider">
                <div class="triangle"></div>
                <!-- mask elemet use for masking background image -->
                <div class="mask"></div>
                <!-- All slides centred in container element -->
                <div class="container">
                    <!-- Start first slide -->
                    <div class="da-slide">
                        <h2 class="fittext2">Welcome to pluton theme</h2>
                        <h4>Clean & responsive</h4>
                        <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.</p>
                        <a href="#" class="da-link button">Read more</a>
                        <div class="da-img">
                      
                           {!! HTML :: image('theme/images/Slider01.png')!!}
                             
                        </div>
                    </div>
                    <!-- End first slide -->
                    <!-- Start second slide -->
                    <div class="da-slide">
                        <h2>Easy management</h2>
                        <h4>Easy to use</h4>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                        <a href="#" class="da-link button">Read more</a>
                        <div class="da-img">
                           <!-- <img src="images/Slider02.png" width="320" alt="image02">-->
                            {!! HTML :: image('theme/images/Slider02.png')!!}
                        </div>
                    </div>
                    <!-- End second slide -->
                    <!-- Start third slide -->
                    <div class="da-slide">
                        <h2>Revolution</h2>
                        <h4>Customizable</h4>
                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                        <a href="#" class="da-link button">Read more</a>
                        <div class="da-img">
                           <!-- <img src="images/Slider03.png" width="320" alt="image03"> -->
                            {!! HTML :: image('theme/images/Slider03.png')!!}
                        </div>
                    </div>
                    <!-- Start third slide -->
                    <!-- Start cSlide navigation arrows -->
                    <div class="da-arrows">
                        <span class="da-arrows-prev"></span>
                        <span class="da-arrows-next"></span>
                    </div>
                    <!-- End cSlide navigation arrows -->
                </div>
            </div>
        </div>
        <!-- End home section -->
        <!-- Service section start -->
        <div class="section primary-section" id="service">
            <div class="container">
                <!-- Start title section -->
                <div class="title">
                    <h1>Why use DomainLeads?</h1>
                    <!-- Section's title goes here -->
                    <p>Simple, our leads go out and your sales come in.</p>
                    <!--Simple description for section goes here. -->
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <div class="centered service">
                            <div class="circle-border zoom-in">
                          
                                {!! HTML :: image('theme/images/Service1.png')!!}
                            </div>
                            <h3>Pre-Verified Leads</h3>
                            <p>All our leads are pre-verfied and you can see how many other users are engaged with any lead before you unlock.</p>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="centered service">
                            <div class="circle-border zoom-in">
                            
                                {!! HTML :: image('theme/images/Service2.png')!!}
                            </div>
                            <h3>Powerfull Filters</h3>
                            <p>Easily filter by TDL, Location, Registered Date, Valid contact info, and much more. Search nitch specific domains quickly.</p>
                        </div>
                    </div>
                    <div class="span4">
                        <div class="centered service">
                            <div class="circle-border zoom-in">
                               
                                {!! HTML :: image('theme/images/Service3.png')!!}
                            </div>
                            <h3>Full CRM</h3>
                            <p>Not only do we provide fresh high quality leads, we also provide a full CRM for you SMS, Call, Email leads, manage contacts and call backs, and record sales.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service section end -->
        <!-- Portfolio section start -->
        <div class="section secondary-section " id="portfolio">
            <div class="triangle"></div>
            <div class="container">
                <div class=" title">
                    <h1>Want to see how it works?</h1>
                    <p>Watch our demo video to see how powerful our platform is.</p>
                </div>
                <!-- <ul class="nav nav-pills">
                    <li class="filter" data-filter="all">
                        <a href="#noAction">All</a>
                    </li>
                    <li class="filter" data-filter="web">
                        <a href="#noAction">Web</a>
                    </li>
                    <li class="filter" data-filter="photo">
                        <a href="#noAction">Photo</a>
                    </li>
                    <li class="filter" data-filter="identity">
                        <a href="#noAction">Identity</a>
                    </li>
                </ul>
                <div id="single-project">
                    <div id="slidingDiv" class="toggleDiv row-fluid single-project">
                        <div class="span6">    
                           {!! HTML :: image('theme/images/Portfolio01.png')!!}

                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>Believe in yourself! Have faith in your abilities! Without a humble but reasonable confidence in your own powers you cannot be successful or happy.</p>
                            </div>
                        </div>
                    </div>
                    <div id="slidingDiv1" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                          
                             {!! HTML :: image('theme/images/Portfolio02.png')!!}
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>Life is a song - sing it. Life is a game - play it. Life is a challenge - meet it. Life is a dream - realize it. Life is a sacrifice - offer it. Life is love - enjoy it.</p>
                            </div>
                        </div>
                    </div>
                    <div id="slidingDiv2" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                           
                            {!! HTML :: image('theme/images/Portfolio03.png')!!}
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>How far you go in life depends on your being tender with the young, compassionate with the aged, sympathetic with the striving and tolerant of the weak and strong. Because someday in your life you will have been all of these.</p>
                            </div>
                        </div>
                    </div>
                    <div id="slidingDiv3" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                           
                              {!! HTML :: image('theme/images/Portfolio04.png')!!}
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Project for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>Life's but a walking shadow, a poor player, that struts and frets his hour upon the stage, and then is heard no more; it is a tale told by an idiot, full of sound and fury, signifying nothing.</p>
                            </div>
                        </div>
                    </div>
                    <div id="slidingDiv4" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                      
                             {!! HTML :: image('theme/images/Portfolio05.png')!!}
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>We need to give each other the space to grow, to be ourselves, to exercise our diversity. We need to give each other space so that we may both give and receive such beautiful things as ideas, openness, dignity, joy, healing, and inclusion.</p>
                            </div>
                        </div>
                    </div>
                    <div id="slidingDiv5" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                           
                             {!! HTML :: image('theme/images/Portfolio06.png')!!}
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>I went to the woods because I wished to live deliberately, to front only the essential facts of life, and see if I could not learn what it had to teach, and not, when I came to die, discover that I had not lived.</p>
                            </div>
                        </div>
                    </div>
                    <div id="slidingDiv6" class="toggleDiv row-fluid single-project">

                        <div class="span6">
                            
                             {!! HTML :: image('theme/images/Portfolio07.png')!!}
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>Always continue the climb. It is possible for you to do whatever you choose, if you first get to know who you are and are willing to work with a power that is greater than ourselves to do it.</p>
                            </div>
                        </div>
                    </div>
                    <div id="slidingDiv7" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                        
                              {!! HTML :: image('theme/images/Portfolio08.png')!!}
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>What if you gave someone a gift, and they neglected to thank you for it - would you be likely to give them another? Life is the same way. In order to attract more of the blessings that life has to offer, you must truly appreciate what you already have.</p>
                            </div>
                        </div>
                    </div>
                    <div id="slidingDiv8" class="toggleDiv row-fluid single-project">
                        <div class="span6">
                          
                             {!! HTML :: image('theme/images/Portfolio09.png')!!}
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3>Webste for Some Client</h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i>
                                    </span>
                                </div>
                                <div class="project-info">
                                    <div>
                                        <span>Client</span>Some Client Name</div>
                                    <div>
                                        <span>Date</span>July 2013</div>
                                    <div>
                                        <span>Skills</span>HTML5, CSS3, JavaScript</div>
                                    <div>
                                        <span>Link</span>http://examplecomp.com</div>
                                </div>
                                <p>I learned that we can do anything, but we can't do everything... at least not at the same time. So think of your priorities not in terms of what activities you do, but when you do them. Timing is everything.</p>
                            </div>
                        </div>
                    </div>
                    <ul id="portfolio-grid" class="thumbnails row">
                        <li class="span4 mix web">
                            <div class="thumbnail">
                              
                                {!! HTML :: image('theme/images/Portfolio01.png')!!}
                                <a href="#single-project" class="more show_hide" rel="#slidingDiv">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix photo">
                            <div class="thumbnail">
                               
                                {!! HTML :: image('theme/images/Portfolio02.png')!!}
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv1">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix identity">
                            <div class="thumbnail">
                                
                                {!! HTML :: image('theme/images/Portfolio03.png')!!}
                                <a href="#single-project" class="more show_hide" rel="#slidingDiv2">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix web">
                            <div class="thumbnail">
                                
                                {!! HTML :: image('theme/images/Portfolio04.png')!!}
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv3">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix photo">
                            <div class="thumbnail">
                              
                                {!! HTML :: image('theme/images/Portfolio05.png')!!}
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv4">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix identity">
                            <div class="thumbnail">
                               
                                {!! HTML :: image('theme/images/Portfolio06.png')!!}
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv5">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix web">
                            <div class="thumbnail">
                               
                                {!! HTML :: image('theme/images/Portfolio07.png')!!}
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv6">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix photo">
                            <div class="thumbnail">
                                
                                {!! HTML :: image('theme/images/Portfolio08.png')!!}
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv7">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                        <li class="span4 mix identity">
                            <div class="thumbnail">
                             
                                {!! HTML :: image('theme/images/Portfolio09.png')!!}
                                <a href="#single-project" class="show_hide more" rel="#slidingDiv8">
                                    <i class="icon-plus"></i>
                                </a>
                                <h3>Thumbnail label</h3>
                                <p>Thumbnail caption...</p>
                                <div class="mask"></div>
                            </div>
                        </li>
                    </ul>
                </div> -->
                <div class="videosection">
                    <img src="theme/images/vdo-img.jpg" class="img-responsive">
                    <div class="video-container">
                        <iframe class="video" width="560" height="313" src="https://www.youtube.com/embed/vaf13ZhmFb8?enablejsapi=1&amp;version=3&amp;playerapiid=ytplayer&amp;rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" marginwidth="0" marginheight="0" hspace="0" vspace="0" scrolling="no" allowfullscreen="" allowscriptaccess="always"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio section end -->
        <!-- About us section start -->
        <div class="section primary-section" id="about">
            <div class="triangle"></div>
            <div class="container">
                <div class="title">
                    <h1>Industry Unique Features</h1>
                    <p>You won't find anyone else with these powerful features.</p>
                </div>
                <div class="row-fluid team">
                    <div class="span4" id="first-person">
                        <div class="thumbnail">
                           
                            {!! HTML :: image('theme/images/valid.png')!!}
                            <h3>Validated Phone Numbers</h3>
                            
                            <div class="mask">
                                <h2>So Powerful</h2>
                                <p>Before you ever unlock a lead we let you know if they have a valid phone number or not. We also let you know if it's a landline or Cell Phone. When you unlock the lead you get even more information like carrier and location of the phone number.</p>
                            </div>
                        </div>
                    </div>
                    <div class="span4" id="second-person">
                        <div class="thumbnail">
                           
                            {!! HTML :: image('theme/images/filters.jpg')!!}
                            <h3>Advanced Filters</h3>
                            
                            <div class="mask">
                                <h2>Find the leads you're looking for.</h2>
                                <p>With our advanced filters you can quickly find only the leads that matter to you. Filter by TDL, Location, Registration Date, State, City, Phone Type on file. You can even target specific keywords included in the domain.</p>
                            </div>
                        </div>
                    </div>
                    <div class="span4" id="third-person">
                        <div class="thumbnail">
                            
                            {!! HTML :: image('theme/images/crm.png')!!}
                            <h3>Full CRM</h3>
                           
                            <div class="mask">
                                <h2>Sales Automation</h2>
                                <p>We give you a full CRM to manage your leads. Our CRM offers: Bulk Email/SMS/Call blasts. SMS auto-responder, Voice IVR, in-browser dialer, lead dispositions, sales tracking, and much more..</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-text centered">
                    <h3>About Us</h3>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>
                </div>
                <h3>Typical Lead Conversions</h3>
                <div class="row-fluid">
                    <div class="span6">
                        <ul class="skills">
                            <li>
                                <span class="bar" data-width="80%"></span>
                                <h3>Graphic Design</h3>
                            </li>
                            <li>
                                <span class="bar" data-width="60%"></span>
                                <h3>Wordpress Website</h3>
                            </li>
                            <li>
                                <span class="bar" data-width="90%"></span>
                                <h3>SEO</h3>
                            </li>
                            <li>
                                <span class="bar" data-width="45%"></span>
                                <h3>Website Development</h3>
                            </li>
                        </ul>
                    </div>
                    <div class="span6">
                        <div class="highlighted-box center">
                            <h1>Get real results!</h1>
                            <p>If you need real conversions you should be using DomainLeads. We give you the newest leads with a proven high sales conversion rate. We also provide all the tools necessary to put your marketing campaigns on auto-piliot. Kick back and watch our system do all the work while you rack up the sales.</p>
                            <button class="button button-sp">Join Us</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About us section end -->
        <div class="section secondary-section">
            <div class="triangle"></div>
            <div class="container centered">
                <p class="large-text">Our leads are ready to buy your services, what are you waiting for?</p>
                <a href="#" class="button">Join now</a>
            </div>
        </div>
        <!-- Client section start -->
        <!-- Client section start -->
        <div id="clients">
            <div class="section primary-section">
                <div class="triangle"></div>
                <div class="container">
                    <div class="title">
                        <h1>What our users Say?</h1>
                        <p>Design Firms, Development Firms, Digital Marketing Agencies, they are all using our system to get new clients and sell their services. See how they like it.</p>
                    </div>
                    <div class="row">
                        <div class="span4">
                            <div class="testimonial">
                                <p>"We really love domainleads becuase we can quickly find only local leads looking for our service and contact them in bulk. DomainLeads saves us time and money in marketing and is always bringing in new clients."</p>
                                <div class="whopic">
                                    <div class="arrow"></div>
                                   
                                    {!! HTML :: image('theme/images/jon.jpg')!!}
                                    <strong>Jon Vaughn
                                        <small>CEO Tier5 LLC</small>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="testimonial">
                                <p>"Every website needs a logo, with domainleads I can search for specific keywords in domains and quickly send out MMS messages with samples of similar logos I've created. I'm constantly getting sales usings domainleads."</p>
                                <div class="whopic">
                                    <div class="arrow"></div>
                                   
                                    {!! HTML :: image('theme/images/steph.jpg')!!}
                                    <strong>Stephine Ayrs
                                        <small>Founder - Item Strategies LLC</small>
                                    </strong>
                                </div>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="testimonial">
                                <p>"I always go for the old leads, Skybound only does SEO and digital marketing. With domain leads I can quickly filter by leads that already have a website, I love this feature becuase that is my target audience for our service. DomainLeads gives me the tools I need to target leads and make sales."</p>
                                <div class="whopic">
                                    <div class="arrow"></div>
                                 
                                    {!! HTML :: image('theme/images/brandon.jpg')!!}
                                    <strong>Brandon Shavers
                                        <small>Founder - Skybound Digital</small>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        "With others you just buy bulk leads, with us you target, contact, and convert leads to sales."
                    </p>
                </div>
            </div>
        </div>
      
        <!-- Price section start -->
      
        <!-- Price section end -->
        <!-- Newsletter section start -->
        <div class="section third-section">
            <div class="container newsletter">
                <div class="sub-section">
                    <div class="title clearfix">
                        <div class="pull-left">
                            <h3>Newsletter</h3>
                        </div>
                    </div>
                </div>
                <div id="success-subscribe" class="alert alert-success invisible">
                    <strong>You're on your way!</strong>Check your email to finish up and get your free weekly leads and help from our experts.</div>
                <div class="row-fluid">
                    <div class="span5">
                        <p>Sign up to get 10 free leads a week plus the hottest tips and tricks to get more sales conversions from your leads.</p>
                    </div>
                    <div class="span7">
                        <form class="inline-form">
                            <input type="email" name="email" id="nlmail" class="span8" placeholder="Enter your email" required />
                            <button id="subscribe" class="button button-sp">Subscribe</button>
                        </form>
                        <div id="err-subscribe" class="error centered">Please provide valid email address.</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Newsletter section end -->
        <!-- Contact section start -->
        <div id="contact" class="contact">
            <div class="section secondary-section">
                <div class="container">
                    <div class="title">
                        <h1>Contact Us</h1>
                        <p>Have any doubts, we're here to clear the air.</p>
                    </div>
                </div>
                <div class="map-wrapper">
                    <div class="map-canvas" id="map-canvas">Loading map...</div>
                    <div class="container">
                        <div class="row-fluid">
                            <div class="span5 contact-form centered">
                                <h3>Engage with us!</h3>
                                <div id="successSend" class="alert alert-success invisible">
                                    <strong>We listen!</strong>Your message has been sent.</div>
                                <div id="errorSend" class="alert alert-error invisible">There was an error.</div>
                                <form id="contact-form" action="php/mail.php">
                                    <div class="control-group">
                                        <div class="controls">
                                            <input class="span12" type="text" id="name" name="name" placeholder="* Your name..." />
                                            <div class="error left-align" id="err-name">Please enter name.</div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <input class="span12" type="email" name="email" id="email" placeholder="* Your email..." />
                                            <div class="error left-align" id="err-email">Please enter valid email adress.</div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <textarea class="span12" name="comment" id="comment" placeholder="* Comments..."></textarea>
                                            <div class="error left-align" id="err-comment">Please enter your comment.</div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button id="send-mail" class="message-btn">Send message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="span9 center contact-info">
                        <p>123 Fifth Avenue, 12th,Belgrade,SRB 11000</p>
                        <p class="info-mail">ourstudio@somemail.com</p>
                        <p>+11 234 567 890</p>
                        <p>+11 286 543 850</p>
                        <div class="title">
                            <h3>We Are Social</h3>
                        </div>
                    </div>
                    <div class="row-fluid centered">
                        <ul class="social">
                            <li>
                                <a href="">
                                    <span class="icon-facebook-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-twitter-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-linkedin-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-pinterest-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-dribbble-circled"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="icon-gplus-circled"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact section edn -->
        <!-- Footer section start -->
        <div class="footer">
            <p>&copy; 2017 Powered by <a href="https://www.tier5.us">Tier5</a></p>
        </div>
        <!-- Footer section end -->
        <!-- ScrollUp button start -->
        <div class="scrollup">
            <a href="#">
                <i class="icon-up-open"></i>
            </a>
        </div>
        <!-- ScrollUp button end -->
        <!-- Include javascript -->
        {!! Html::script('theme/js/jquery.js') !!}
        {!! Html::script('theme/js/jquery.mixitup.js') !!}
        {!! Html::script('theme/js/bootstrap.js') !!}
        {!! Html::script('theme/js/modernizr.custom.js') !!}
        {!! Html::script('theme/js/jquery.bxslider.js') !!}
        {!! Html::script('theme/js/jquery.cslider.js') !!}
        {!! Html::script('theme/js/jquery.placeholder.js') !!}
        {!! Html::script('theme/js/jquery.inview.js') !!}
        
          {!! Html::script('theme/js/app.js') !!}
        {!! Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyB3PpQ1EOAybx-Bkx1X52noOoPR_Fh_d1w &callback=initializeMap') !!}
         
       
        <!-- Load google maps api and call initializeMap function defined in app.js -->
        
        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
      

<div class="modal fade loginsignup" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myModalLabel">
                    Login</h4>
                    <div id="errormsg"></div>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => '')) }}
                <div class="form-group">
                {{ Form::text('email','',array('id'=>'email_id_login','class'=>'form-control','placeholder' => 'Please Enter your Email')) }}
                <p class="errors">{{$errors->first('email')}}</p>
                </div>
                <div class="form-group">
                {{ Form::password('password',array('class'=>'form-control', 'placeholder' => 'Please Enter your Password','id'=>'password')) }}
                <p class="errors">{{$errors->first('password')}}</p>
                </div>
                <div class="form-group">
                {{ Form::button('Submit', array('class'=>'send-btn','id' => 'submitbtn')) }}
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade loginsignup" id="myModal_for_reg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×</button>
                <h4 class="modal-title" id="myLargeModalLabel">
                    Register</h4>
                    <div id="errormsg_reg"></div>
            </div>
            <div class="modal-body">
                                
                <div class="signup-form">
 
                   
                {!! Form::open(array('url'=>'')) !!}
                <div class="form-group">
                {!! Form ::text('first_name','',array('class'=>'formtext form-control','id'=>"first_name","placeholder"=>'First Name')) !!}
                </div>
                <div class="form-group">
                {!! Form ::text('last_name','',array('class'=>'formtext form-control','id'=>"last_name","placeholder"=>'Last Name')) !!}
                </div>
                <div class="form-group">
                {!! Form ::text('email','',array('class'=>'formtext form-control','id'=>"email_reg","placeholder"=>'Email Address')) !!}
                </div>
                <div class="form-group">
                {!! Form ::password('password',array('class'=>'formtext form-control','id'=>"password_reg","placeholder"=>'Password')) !!}
                </div>
                <div class="form-group">
                {!! Form ::password('c_password',array('class'=>'formtext form-control','id'=>"c_password_reg","placeholder"=>'Confirm Pasword')) !!}
                </div>
                <div class="form-group">
                {!! Form ::button('submit',array('class'=>'send-btn','id' => 'submitbtn_reg')) !!}
                </div>
                {!! Form::close() !!}
                </div> 

               
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
        // $("popupid").click(function(){
        //     $('#myModal').modal('show');
        // }); 
        // $("popupid_for_reg").click(function(){
        //     $('#myModal_for_reg').modal('show');
        // }); 

        $("#submitbtn").click(function(){
            var email=$("#email_id_login").val();
            var password=$("#password").val();
           $.ajax({
               type:'POST',
               url:'login',
               data:'email='+email+'&password='+password,
               success:function(data){
               // console.log(data);
                if(data=='success'){
                  window.location.href = 'importExport';
                }
                if(data=='error1'){
                   $("#errormsg").html('User is not registered');
                }
                if(data=='error2'){
                   $("#errormsg").html('Invalid login credentials');
                } 
                 
               }
            });
        });  
        $("#submitbtn_reg").click(function(){
            var first_name=$("#first_name").val();
            var last_name=$("#last_name").val();
            var email_reg=$("#email_reg").val();
            var password_reg=$("#password_reg").val();
            var c_password_reg=$("#c_password_reg").val();

           $.ajax({
               type:'POST',
               url:'signme',
               data:'first_name='+first_name+'&last_name='+last_name+'&email='+email_reg+'&password='+password_reg+'&c_password='+c_password_reg,
               success:function(data){
                console.log(data);
                if(data.msg =='success'){
                   $("#errormsg_reg").html('Successfully Signed');
                }
                if(data.msg =='error1'){
                   $("#errormsg_reg").html('Data not correct');
                }
                if(data.msg =='error2'){
                   $("#errormsg_reg").html('Please signup again');
                } 
                if(data.msg =='error3'){
                   $("#errormsg_reg").html('Email exists');
                } 
                 
               }
            });
        });  

});
   
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".videosection img").click(function(e){
            $(this).hide();
            $(this).parent().find(".video")[0].src += "&autoplay=1";
            e.preventDefault();
        });
    });
</script>
</body>
</html>