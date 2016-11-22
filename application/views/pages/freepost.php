<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Khojeko</title>

        <link href="<?php echo base_url('public'); ?>/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <link href="<?php echo base_url('public'); ?>/css/main.css" rel="stylesheet">
        <link href="<?php echo base_url('public'); ?>/css/responsive.css" rel="stylesheet">
        <link href="<?php echo base_url('public'); ?>/css/category.css" rel="stylesheet">
        <link href="<?php echo base_url('public'); ?>/css/list_grid.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public'); ?>/css/jquery-ui.css">
        <link href="<?php echo base_url('public'); ?>/css/login.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo base_url('public'); ?>/css/app/app.v1.css" />
        <link rel="stylesheet" href="<?php echo base_url('public'); ?>/css/app/admin.css" />
        <link rel="stylesheet" href="<?php echo base_url('public'); ?>/css/fileinput.css" />
        <style>
            .info{
                color:#000;
                text-decoration:none;
                text-align:center;
                display: inline;
            }

            .info span{display: none}

            .info:hover span{ /*the span will display just on :hover state*/
                border-radius: 15px;
                background-color:#cff; color:#000;
                text-align: center;
                padding:10px;
                font-size: 10px;
                display: block;
            }

            .info:hover span:after{ /*the span will display just on :hover state*/
                content:'';
                background:#cff;
                margin-left:-5px;
              }
        </style>

        <link rel="shortcut icon" href="<?php echo base_url('public'); ?>/images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('public'); ?>/images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('public'); ?>/images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('public'); ?>/images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('public'); ?>/images/ico/apple-touch-icon-57-precomposed.png">
        <link href='https://fonts.googleapis.com/css?family=cabin' rel='stylesheet' type='text/css'>

        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/categori.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/display.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/list_grid.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jssor.slider.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/back.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/dropdown.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/searchable_dropdown.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/live_preview.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery.MultiFile.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/livepreview.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/hawa.js"></script>

        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/ad_detail_slider.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/count.js"></script>
        <script type="text/javascript" src="<?php echo base_url('public'); ?>/js/multiple_upload.js"></script>

        <!-- Custom JQuery -->
        <script src="<?php echo base_url('public'); ?>/js/app/custom.js" type="text/javascript"></script>
        <script src="<?php echo base_url('public'); ?>/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url('public'); ?>/js/categori.js"></script>
        <script src="<?php echo base_url('public'); ?>/js/popup.js"></script>
        <script src="<?php echo base_url('public'); ?>/js/jquery.MultiFile.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#select").searchable();
            });
        </script>

        <script>
            $(document).bind("mobileinit", function() {
              $.mobile.ignoreContentEnabled = true;
            });
        </script>

        <script>
            $(window).load(function(){
                var i=1;
                $('#add').click(function(){
                    //i++;
                    if(i<=3) {
                        $('#dynamic_field').append('<div class="row"><div class="col-md-10"><input type="file" name="upload_images'+i+'" accept="image/*"  onchange="showMyImage(this)" /></div></div>');
                        i++;
                    }
                });
            });
        </script>

        <script language="javascript" type="text/javascript">
            $(document).ready(function() {
                var text_max = 300;
                $('#textarea_feedback').html(text_max + ' characters remaining');

                $('#ad_details').keyup(function() {
                    var text_length = $('#ad_details').val().length;
                    var text_remaining = text_max - text_length;

                    $('#textarea_feedback').html(text_remaining + ' characters remaining');
                });
            });
        </script>

        <script type="javascript">
            $(document).ready(funtion(){
                $(".category0 li a" || ".category1 li a").on("click", function () {
                    var x = $(this).attr('id');
                    var y = this.text;
                    document.getElementById("parent").innerHTML = x;
                    document.getElementById("display_parent").innerHTML = y;
                    $("#display_parent").css('color','black');
                    //alert(y);
                });
            });
         </script>

    </head>

    <body id="page-wrap">
        <div id="fb-root"></div>

        <script>
            $(document).ready(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];

                if (d.getElementById(id)) 
                    return;
                
                js = d.createElement(s); js.id = id;
                
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

        <header id="header">      
            <div class="container">
                <div class="col-sm-12 col-md-12">
                    <div class="col-md-3">
                        <a href="#"><img src="<?php echo base_url('public'); ?>/images/khojeko.png" class="img-responsive"></a>
                    </div>
                
                    <div class="col-md-9">
                        <nav class="navbar navbar-inverse menu" data-enhance="false">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" id="nav-buttton">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>

                            <div class="collapse navbar-collapse" id="myNavbar" >
                                <ul class="nav navbar-nav">
                                    <li><a href="#" class="nav"> Home</a></li>
                                    <li class="divider"><a>|</a></li>
                                    <li><a href="#" class="nav">About Us</a></li>
                                    <li class="divider"><a>|</a></li>
                                    <li><a href="#" class="nav">Features</a></li>
                                    <li class="divider"><a>|</a></li>
                                    <li><a href="#" class="nav">FAQ</a></li>
                                    <li class="divider"><a>|</a></li>
                                    <li><a href="#" class="nav">Contact Us</a></li>
                                    <li class="divider"><a>|</a></li>
                                    <li><a href="#" class="nav"><i class="fa fa-file-text"></i>&nbsp;Free Registration</a></li>
                                    <li class="divider"><a>|</a></li>
                                    <li><a href="#" class="nav"><i class="fa fa-lock"></i>&nbsp;Login</a></li>
                                    <li class="divider"><a>|</a></li>
                                    <li><a href="#" class="nav"> My Account</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div><!--col-md-9  end-->
                </div><!--row end-->
            </div><!--top container-->
        </header>
        <!--/#header-->

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 ads_number">
                        <li>
                            <a href="#!">All Ads (1250)</a>
                            <a href="#!">Dealer Ads (150)</a>
                            <a href="#!">Individual Ads (145)</a>
                            <a href="#!">New Ads (456)</a>
                            <a href="#!">Used Ads (326)</a>
                        </li>
                    </div>

                    <div class="col-sm-3 col-xs-12 left_block">
                        <div class="category_block">
                            <div class="category" data-enhance="false">
                                Categories
                                <select name="dropdown" id="drop1">
                                    <option >All Ads</option> 
                                    <option >Dealer Ads</option>  
                                    <option >Individual Ads</option>  
                                    <option >New Ads</option>  
                                    <option >Used Ads</option>  
                                </select> 
                            </div>
                                        
                            <div class="cat" data-enhance="false">
                                <?php
                                    //require_once('admin/templates/category.php');
                                    //print_list(0, 0, $category, 'adpost');
                                ?>
                            </div>
                        </div><!--category_block End--> 
                                    
                        <div class="banner"> 
                            <img src="<?php echo base_url('public'); ?>/images/shipping.jpg" class="img-responsive">
                        </div>
                            
                        <div class="video">      
                            <video controls>
                                <source src="#" type="video/mp4">
                                <source src="#" type="video/ogg">
                                Your browser does not support HTML5 video.
                            </video>
                            <a href="http://www.youtube.com" target="_blank" >Khojeko.com official promo Ad  </a>
                        </div> 
                                    
                        <div class="banner">
                            <img src="<?php echo base_url('public'); ?>/images/ad2.jpg" class="img-responsive">
                        </div>
                       
                        <div class="fb-page" data-href="https://www.facebook.com/facebook" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/facebook">
                                    <a href="https://www.facebook.com/facebook">Facebook</a>
                                </blockquote>
                            </div>
                        </div>                           
                    </div> <!--end of col-sm-3-->

                    <div class="col-sm-9" id="main-content" data-enhance="false">
                        <div id="guts">
                            <div class="search_bar">
                                <select name="dropdown" class="select">
                                    <option>All district</option> <option>Kathmandu</option> <option>Lalitpur</option>
                                    <option>Bhaktapur</option>    <option>Jhapa</option>     <option>Gorkha</option>
                                    <option>Kaski</option>        <option>Lamjung</option>   <option>Syangja</option>
                                    <option>Tanahun</option>      <option>Manang</option>    <option>Okhaldhunga</option>
                                    <option>Khotang</option>      <option>Udayapur</option>  <option>Siraha</option>
                                    <option>Saptari</option>      <option>Solukhumbu</option><option>Dhanusa</option>
                                    <option>Mahottari</option>    <option>Sarlahi</option>   <option>Sindhuli</option>
                                    <option>Ramechhap</option>    <option>Dolakha</option>   <option>Dhading</option>
                                    <option>Kavrepalanchok</option> <option>Nuwakot</option>      <option>Rasuwa</option>    
                                    <option>Sindhupalchok</option> <option>Bara</option>         <option>Parsa</option>     
                                    <option>Rautahat</option>     <option>Chitwan</option>      <option>Makwanpur</option> 
                                    <option>Sankhuwasabha</option> <option>Terhathum</option>    <option>Dhankuta</option>  
                                    <option>Ilam</option>         <option>Panchthar</option>    <option>Taplejung</option> 
                                    <option>Morang</option>       <option>Sunsari</option>      <option>Bhojpur</option>
                                </select>

                                <input type="text" name="search" class="search" placeholder="What are you looking for?">

                                <button id="search_btn"><i class="fa fa-search"> </i> Search</button>

                                <a href="adpost">
                                    <button id="ad_btn">POST FREE ADS</button>
                                </a>
                            </div><!--search bar ends-->

                            <div class="login_title">
                                <h2><!--<img src="image/" alt="">-->Free Registration Page </h2>
                                <p>Buy and sell anything that may be 1st hand or 2nd hand stuffs, post service ads, vacancies, events, jobs, rent, real state land and building, all advertisement services are available free of cost. Enjoy.</p>        
                            </div><!--login_title-->

                            <div class="post_admin">
                                <div class="stepwizard">
                                    <div class="stepwizard">
                                        <div class="stepwizard-row setup-panel">
                                            <div class="stepwizard-step">
                                                <a href="#step-1" type="button" class="btn btn-primary btn-circle steps">1</a>
                                                <p>Step 1</p>
                                            </div>
                                            <div class="stepwizard-step">
                                                <a href="#step-2" type="button" class="btn btn-default btn-circle steps" disabled="disabled">2</a>
                                                <p>Step 2</p>
                                            </div>
                                            <div class="stepwizard-step">
                                                <a href="#step-3" type="button" class="btn btn-default btn-circle steps" disabled="disabled">3</a>
                                                <p>Step 3</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php echo form_open_multipart("adpost"); ?>
                                    <div class="setup-content" id="step-1">
                                        <div class="form-group">
                                            <h3> Step 1&nbsp;&nbsp;(Select category for ad posting)</h3>
                                            
                                            <?php
                                                require_once('templates/require/category.php');
                                                print_list(0, 0, $categories, 'front/');
                                                //require_once('/../admin/templates/category.php');
                                            ?>
                                    
                                            <div class="search_section">
                                                <table>
                                                    <tr>
                                                        <td style="width:30%">
                                                            To find best category quick search is here:    
                                                        </td>
                                                        
                                                        <td style="width:50%">
                                                            <input type="text" class="search" style="width:40%">
                                                            <button>Search</button>
                                                        </td>       
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td>
                                                            Suggested Category:
                                                        </td>
                                                        
                                                        <td>
                                                            <textarea name="display_cat" id="display_parent" readonly></textarea>
                                                            <textarea name="parent_id" id="parent" hidden="hidden"></textarea>       
                                                        </td>
                                                    </tr>    
                                                </table>
                                            </div><!--search_section ends-->
                                                                        
                                            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                        </div>
                                    </div>

                                    <div class="setup-content step-2" id="step-2">  
                                        <div class="form-group">
                                            <h3> Step 2</h3>

                                            <?php 
                                                echo "<strong>*Ad Title:</strong><br>";    
                                                echo form_input('ad_title', $this->input->post('ad_title'), 'maxlength="100" class="sstep" placeholder="Title of the product" required'); 
                                            ?>

                                            <br /><br />

                                            <?php 
                                               // echo "<strong>*Short Description:</strong><br>";    
                                                //echo form_input('shrt_description', $this->input->post('shrt_description'), 'maxlength="100" class="sstep" placeholder="Description of the product" '); 
                                            ?>
                                            
                                            <!-- <br /><br /> -->

                                            <?php 
                                                if($user_type == "personal"){ 
                                                    echo '
                                                    <span class="ad_type">
                                                        <strong>Ad Type:</strong><br />

                                                        <input type="radio" name="ad_type_personal" id="used" value="Used" checked="checked">Used<br />
                                                        <input type="radio" name="ad_type_personal" id="like_new" value="Likely New">Likely New<br />
                                                    </span>';
                                                } else { 
                                                    echo '
                                                    <span id="ad_type">
                                                      <strong>Ad Type:</strong><br /> 
                                                        <input type="radio" name="ad_type_dealer" id="used" value="Used" checked="checked" onclick="serviceCheck(this)">Used
                                                        <input type="radio" name="ad_type_dealer" id="new" value="Brand_New" onclick="serviceCheck(this)">Brand New (For Dealer ad)
                                                        <input type="radio" name="ad_type_dealer" id="service" value="Service" onclick="serviceCheck(this)">Service Ad/ General Ad
                                                        <input type="radio" name="ad_type_dealer" id="event" value="Event" onclick="serviceCheck(this)">Event (Time Based)<br /> <br />
                                                    </span>';
                                                } 
                                            ?>

                                            <br /><br />

                                            <span id="bought_from">
                                                <strong>Bought From:</strong><br />
                                              
                                                <input type="radio" name="bought_from" id="nepal" value="Nepal" checked="checked">Nepal<br />
                                                <input type="radio" name="bought_from" id="abroad" value="Abroad">Abroad<br />
                                                <input type="text" placeholder="Type Country Name" name="abroad_country" id="country_name">
                                            </span>
                                                
                                            <br /><br />

                                            <span id="offer" style="display: block;">
                                                <strong>Offer Price:</strong><br>
                                                <input name="offer" type="text" class="sstep"/>

                                                <span>
                                                    <a href="#!"><i class="fa fa-question-circle" id="popup1"></i></a>
                                                    <a class="popuptext" id="myPopup1" >If it is Service or Advertisement ad leave box blank</a>
                                                </span><br/><br/>
                                            </span>

                                            <span id="used_for" style="display: block;">
                                                <strong>Used for days/month/year:</strong><br>
                                                <input type="text" name="used_for" class="sstep"/>

                                                <span>
                                                    <a href="#!">
                                                        <i class="fa fa-question-circle" id="popup2"></i>
                                                    </a>
                                                    <a class="popuptext" id="myPopup2"> If service related ad (ignore it)</a>
                                                </span><br /><br />
                                            </span>

                                            <span id="market_price" style="display: block;">
                                                <strong>Market Price:</strong><br>
                                                <input type="text" name="market_price" class="sstep"/>
                                                <span>
                                                    <a href="#!">
                                                        <i class="fa fa-question-circle" id="popup3"></i>
                                                    </a>
                                                    <a class="popuptext" id="myPopup3">If you don't know indicative market price leave it blank.</a>
                                                </span>
                                                <br /><br />
                                            </span>

                                            <span id="document_no">
                                                <strong>(Identification no/Chasis no/Document no/IMEI no):</strong><br>
                                                
                                                <input type="text" name="document_no" class="sstep"/>
                                                <span>
                                                    <a href="#!">
                                                        <i class="fa fa-question-circle" id="popup4"></i>
                                                    </a>

                                                    <a class="popuptext" id="myPopup4" >this is optional but if you mention ad id no. your ad is fully verified and trustful and may sold out quickly</a>
                                                </span>
                                                <br /><br />
                                            </span>

                                            <strong>
                                                Product or Service ad details/ full specification: ( submit with full specification and product details):
                                            </strong><br />
                                            <input type="text" name="ad_details" id="ad_details" style="width:60%; height:100px;text-align:center" placeholder="TEXT EDITOR" required="required"/>
                                            <div id="textarea_feedback"></div>
                                            <br /><br />

                                            <strong>Please select your free ad running time</strong>
                                            <select name="ad_running_time">
                                                <option>7 days</option>
                                                <option>15 days</option>
                                                <option>30 days</option>
                                                <option>60 days</option>
                                                <option>90 days</option>
                                            </select><br /><br />
                                               
                                            <strong>Own Web site url link:</strong>
                                            <input type="text" name="site_url" class="sstep"/>
                                            <a href="#!" id="popup5">
                                                <i class="fa fa-question-circle"  ></i>
                                            </a>
                                            <a class="popuptext" id="myPopup5">if not leave it blank.</a>
                                            <br /><br />

                                            <span id="home_delivery">
                                                <strong>Home delivery facility:</strong><br>
                                                <input type="radio" name="home_delivery" id="yes" value="yes" checked="checked" onclick="deliveryCheck(this)" />Yes<br>
                                                <input type="radio" name="home_delivery" id="no" value="no" onclick="deliveryCheck(this)" />No<br /><br />
                                            </span>
                                               
                                            <div id="delivery_charge" style="display: block;">
                                                <strong>Delivery Charges:</strong><br>
                                                <input type="text" name="delivery_charge" class="sstep"/>
                                                <a href="#!" id="popup6">
                                                    <i class="fa fa-question-circle"  ></i>
                                                </a>
                                                <a class="popuptext" id="myPopup6">if not leave it blank.</a><br /><br />
                                            </div>

                                            <span id="warranty">
                                                <strong>Warranty Time:</strong><br>
                                                <input type="text" name="warranty" id="input" class="sstep"/>
                                                <a href="#!" id="popup7">
                                                    <i class="fa fa-question-circle"></i>
                                                </a>
                                                <a class="popuptext" id="myPopup7">if not leave it blank.</a><br /><br />
                                            </span>

                                            <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                                            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                                        </div>
                                    </div>

                                    <div class="setup-content" id="step-3">
                                        <div class="form-group">
                                            <h3> Step 3</h3>

                                            <strong> owner proof document:</strong><br /> 
                                            <input type="checkbox" name="owner_proof[]" noneoption="false" value="Vat/Pan Bill" />Vat/Pan Bill<br />
                                            <input type="checkbox" name="owner_proof[]" noneoption="false" value="Product warranty card" />Product warranty card<br />
                                            <input type="checkbox" name="owner_proof[]" noneoption="false" value="Product Paking Box" />Product Paking Box<br />
                                            <input type="checkbox" name="owner_proof[]" id="none" noneoption="true" value="Not" />Not any above<br /><br />

                                            <span id="reason">
                                                <strong>If not any above.<br />specify reason</strong>
                                                <input type="text" name="reason" style="height:30px; width:160px" />
                                            </span><br /><br />

                                            <div id="dynamic_field">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <strong>Upload your images here:</strong>
                                                        <h5 style="color:blue">First image will be displayed as primary.</h5>
                                                        <input type="file" name="upload_images" accept="image/*" onchange="showMyImage(this)" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="button" name="add" id="add" class="btn btn-primary btn-xs pull-right">Add More Photos (Maximum 4)</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr/>

                                            <strong>
                                                Upload Video Url ( From Youtube embeed):<br /><br> Video 1. 
                                            </strong>
                                            <input type="text" name="video1_url" id="input">
                                            <a href="#!" class="info">
                                                <i class="fa fa-question-circle"></i>
                                                <span>if not leave it blank.</span>
                                            </a>
                                            <br />

                                            <strong>Video 2.</strong>
                                            <input type="text" name="video2_url" id="input"/>
                                            <a href="#!" class="info">
                                                <i class="fa fa-question-circle"  ></i>
                                                <span>if not leave it blank.</span>
                                            </a>
                                            <br /><br>

                                            <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                                            <button class="btn btn-success btn-lg pull-right" type="submit">Done!</button>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div><!--end of post_admin-->
                        </div><!--guts-->
                    </div><!-- col-sm-9 -->

                    <div class="col-sm-12">
                        <div class="dealer_listing">
                            <div class="dealer_list_topic">
                                Dealer Listing >>>
                                <a href="!#" id="test">Show List in alphabetic order</a>
                            </div>

                            <ul id="list">
                                <?php
                                    foreach ($dealer_list as $one) {
                                        echo '
                                            <li>
                                                <a href="'.base_url().'dealer/'.$one->khojeko_username.'/All">'.$one->name.'</a>
                                            </li>';
                                    }
                                ?>
                            </ul>
                        </div><!--dealer listing ends-->

                        <div class="logosl">
                            <div id="dealer_logo">
                                <a >Dealers/Retailer Partners</a>
                            </div>

                            <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 980px; height: 100px; overflow: hidden; visibility: hidden;clear: both;">
                                <!-- Loading Screen -->

                                <div data-u="slides" style="cursor: default; position: relative; top: 10px; left: 0px; width: 980px; height: 80px; overflow: hidden;clear: both;">

                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/amazon.jpg" />
                                    </div>

                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/android.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/bitly.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/blogger.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/dnn.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/drupal.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/ebay.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/facebook.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/google.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/ibm.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/ios.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/joomla.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/linkedin.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/mac.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/magento.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/pinterest.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/samsung.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/twitter.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/windows.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/wordpress.jpg" />
                                    </div>
                                    
                                    <div style="display: none;">
                                        <img data-u="image" src="<?php echo base_url('public'); ?>/images/logos/youtube.jpg" />
                                    </div>
                                </div>
                            </div><!--jssor_1 ends-->
                        </div><!--logos1 ends-->

                        <script>
                            jssor_1_slider_init();
                        </script>

                        <div class="listing">
                            <div class="col-sm-4 popular_district" >
                                <u><a> Popular District by Listing</a></u>
                                <div class="child">
                                    <ol>
                                        <li> Kathmandu</li>
                                        <li> Bhaktapur</li>
                                        <li> Lalitpur</li>
                                        <li> Kaski</li>
                                        <li> Morang</li>
                                        <li> Sunsari</li>
                                        <li> Saptari</li>
                                        <li> Kabrepalanchok</li>
                                        <li> Dolkha</li>
                                        <li> jhapa</li>
                                        <li> Banke</li>
                                        <li> mustang</li>
                                        <li> Magdi</li>
                                        <li> Gorkha</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="col-sm-1"></div>

                            <div class="col-sm-3 popular_cat">
                                <u> <a> Popular Categories</a></u>
                                <div id="ppChild">
                                    <ol>
                                        <li>Mobile & Tablet Pcs</li>
                                        <li>Mobile </li>
                                        <li>Mobile & Tablet Pcs</li>
                                        <li>Mobile  Pcs</li>
                                        <li>Mobile & Tablet Pcs</li>
                                        <li>Mobile & Tablet Pcs</li>
                                        <li>Mobile & Tablet Pcs</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="col-sm-1"></div>
                            
                            <div class="col-sm-3 popular_Dea">
                                <u><a>Popular Dealers</a></u>
                                <div id="ddChild">
                                    <ol>
                                        <li>Rojeko dot com</li>
                                        <li>LS Mobile</li>

                                        <li>E-Bazzar</li>

                                        <li>RedEye Trade Link</li>

                                        <li>CG Impex Pvt LTD</li>

                                        <li>Computer Bazar</li>
                                        <li>Brothers International</li>
                                    </ol>
                                </div>
                            </div>
                        </div><!--col-sm-4 ends-->

                        <div class="clearfix"></div>

                        <div class="history">
                            <div class="history_title">
                                <a>Your recently viewed Ads</a>
                                <a class="a_history">View your all browsing history>></a>
                            </div>

                            <div class="history_section">
                                <li>
                                    <img src="<?php echo base_url('public'); ?>/images/s8.jpg"><br>
                                    <span class="title">
                                        <b>Rs 12300</b><br>
                                        <a class="sub" href="!#">Samsung S8</a><br>
                                    </span>
                                </li>

                                <li>
                                    <img src="<?php echo base_url('public'); ?>/images/s8.jpg"><br>
                                    <span class="title">
                                        <b>Rs 12300</b><br>
                                        <a class="sub" href="!#">Samsung S8</a><br>
                                    </span>
                                </li>

                                <li>
                                    <img src="<?php echo base_url('public'); ?>/images/s8.jpg"><br>
                                    <span class="title">
                                        <b>Rs 12300</b><br>
                                        <a class="sub" href="!#">Samsung S8</a><br>
                                    </span>
                                </li>
                            </div>
                        </div>
                    </div><!--col-sm-12 ends-->
                </div> <!-- row ends -->
            </div>  <!--container ends-->
        </section>
        <!-- section end -->

        <footer>
            <div class="container">
                <div class="col-sm-12">
                    <div class="down_menu">
                        <li><a href="#!">Home</a></li>
                        <li>|</li>
                        <li><a href="#!">About Us</a></li>
                        <li>|</li>
                        <li><a href="#!">Features</a></li>
                        <li>|</li>
                        <li><a href="#!">FAQ</a></li>
                        <li>|</li>
                        <li><a href="#!">Contact Us</a></li>
                    </div>

                    <div class="copy_right">
                        <a href="#!">Copyright Khojeko.com &copy; 2012-2014</a>&nbsp;&nbsp;
                        <a href="#!">Kojeko dot com Pvt. Ltd. Nepal.</a>&nbsp;&nbsp;
                        <a> All Rights Reserved</a>
                    </div>
                </div>
            </div>
        </footer>
    
        <a href="#" class="back-to-top">
            <i class="fa fa-arrow-up"></i>
        </a>

    </body>
</html>
