<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Khojeko - Online Buying and Selling</title>

    <link href="<?php echo base_url('public/css/bootstrap.min.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/main.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/responsive.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/category.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/dealer_page.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/item_detail.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/user_panel.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/list_grid.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/login.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/signup.css'); ?>"  rel="stylesheet">

    <link href="<?php echo base_url('public');?>/css/jquery.mobile-1.4.5.min.css" rel="stylesheet" />

    <link href="<?php echo base_url('public/images/ico/apple-touch-icon-144-precomposed.png');?>" rel="apple-touch-icon-precomposed" sizes="144x144" />
    <link href="<?php echo base_url('public/images/ico/apple-touch-icon-114-precomposed.png');?>" rel="apple-touch-icon-precomposed" sizes="114x114" />
    <link href="<?php echo base_url('public/images/ico/apple-touch-icon-72-precomposed.png');?>" rel="apple-touch-icon-precomposed" sizes="72x72" />
    <link href="<?php echo base_url('public/images/ico/apple-touch-icon-57-precomposed.png');?>" rel="apple-touch-icon-precomposed" />
    <link href="<?php echo base_url('public/images/icons/icon.ico')?>" rel="shortcut icon" />

    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" />


</head>
<body id="page-wrap">
    <div id="fb-root"></div>
    <header id="header">
        <div class="container">
            <div class="col-md-3">
                <?php echo anchor(base_url(), '<img src="'.base_url('public/images/khojeko.png').'" class="img-responsive">')?>
            </div>

            <div class="col-md-9">
                <nav class="navbar navbar-inverse menu">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" id="nav-buttton">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li><?php echo anchor('','Home');?></li>
                            <li class="divider"><a>|</a></li>
                            <li><a href="#" class="nav">About Us</a></li>
                            <li class="divider"><a>|</a></li>
                            <li><a href="#" class="nav">Features</a></li>
                            <li class="divider"><a>|</a></li>
                            <li><a href="#" class="nav">FAQ</a></li>
                            <li class="divider"><a>|</a></li>
                            <li><a href="#" class="nav">Contact Us</a></li>
                            <li class="divider"><a>|</a></li>

                            <?php
                            $set_data = $this->session->all_userdata();
                            if (isset($set_data['logged_in'])):?>
                                <?php if($set_data['logged_in']['type'] =='dealer'):?>
                                    <li><?php echo anchor('dpanel/'.$set_data['logged_in']['username'], 'My Account'); ?></li>
                                <?php else:?>
                                    <li><?php echo anchor('upanel/'.$set_data['logged_in']['username'], 'My Account'); ?></li>
                                <?php endif ?>
                                <li class="divider"><a>|</a></li>
                                <li><a href="<?php echo base_url('logout')?>" class="nav"><i class="fa fa-lock"></i>&nbsp;Logout</a></a></li>
                                <li class="divider"><a>|</a></li>
                            <?php else: ?>
                                <li><a href="<?php echo base_url('login')?>" class="nav"><i class="fa fa-lock"></i>&nbsp;Login</a></a></li>
                                <li class="divider"><a>|</a></li>
                                <li><a href="<?php echo base_url('signup');?>" class="nav"><i class="fa fa-file-text"></i>&nbsp;Free Registration</a></li>
                                <li class="divider"><a>|</a></li>
                            <?php endif; ?>

                        </ul>
                    </div>
                </nav>
            </div><!--col-md-9 	end-->
        </div><!--top container-->
    </header><!--/#header-->

    <section>
        <div class="container" >
            <div class="col-sm-12 ads_number">
                <li>
                    <a href="#!">All Ads (<?php echo $total_items;?>)</a>
                    <a href="#!">Dealer Ads (<?php echo $dealer_items;?>)</a>
                    <a href="#!">Individual Ads (<?php echo $user_items;?>)</a>
                    <a href="#!">New Ads (<?php echo $new_items;?>)</a>
                    <a href="#!">Used Ads (<?php echo $used_items;?>)</a>
                </li>
            </div>

            <div class="col-sm-3 col-xs-12 left_block">
                <div class="category_block">
                    <div class="category">
                        Categories
                        <select name="dropdown" id="drop1">
                            <option>All Ads</option>
                            <option>Dealer Ads</option>
                            <option>Individual Ads</option>
                            <option>New Ads</option>
                            <option>Used Ads</option>
                        </select>
                    </div>

                    <div class="cat">
                        <div>
                            <?php
                            require_once('require/category.php');
                            print_list(0, 0, $category);
                            ?>
                        </div>
                    </div>
                </div><!--category_block End-->

                <div class="banner">
                    <img src="<?php echo base_url('public/images/shipping.jpg');?>" class="img-responsive">
                </div>

                <div class="fb-page" data-href="https://www.facebook.com/technorio" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>

            </div> <!--end of col-sm-3-->

            <div class="col-sm-9"  id="main-content">
                <div id="guts">
                    <?php echo form_open('results', array('method' => 'GET', 'style' => 'padding:0px;')); ?>
                    <div class="search_bar">
                        <select name="city" id="drop2">
                            <option value="all-district">All district</option>
                            <option value="kathmandu">Kathmandu</option>
                            <option value="lalitpur">Lalitpur</option>
                            <option value="bhaktapur">Bhaktapur</option>
                        </select>
                        <input type="text" name="search" class="search" placeholder="What are you looking for?">
                        <button type="submit" id="search_btn"><i class="fa fa-search"> </i> Search</button>
                        <?php echo form_close(); ?>

                        <a href="<?php echo base_url('adpost'); ?>"><button type="button" id="ad_btn">POST FREE ADS</button></a>

                    </div>