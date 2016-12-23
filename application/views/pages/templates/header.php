<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Khojeko - Online Buying and Selling</title>

    <link href="<?php echo base_url('public/css/slider/nouislider.min.css'); ?>"  rel="stylesheet">
    <link href="<?php echo base_url('public/css/bootstrap/bootstrap.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/main.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/category.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/dealer_page.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/item_detail.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/user_panel.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/list_grid.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/login.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('public/css/signup.css'); ?>"  rel="stylesheet">

    <link href="<?php echo base_url('public/images/icons/icon.ico')?>" rel="shortcut icon" />
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><?php echo anchor('','<span class="glyphicon glyphicon-home"></span> Home');?></li>
                    <li><a href="#" class="nav"><span class="glyphicon glyphicon-list-alt"></span> About Us</a></li>
                    <li><a href="#" class="nav"><span class="glyphicon glyphicon-question-sign"></span> FAQ</a></li>
                    <li><a href="#" class="nav"><span class="glyphicon glyphicon-envelope"></span> Contact Us</a></li>

                    <?php
                    $set_data = $this->session->all_userdata();
                    if (isset($set_data['logged_in'])):?>
                        <?php if($set_data['logged_in']['type'] =='dealer'):?>
                            <li><?php echo anchor('dpanel/'.$set_data['logged_in']['username'], '<span class="glyphicon glyphicon-user"></span> My Profile'); ?></li>
                        <?php else:?>
                            <li><?php echo anchor('upanel/'.$set_data['logged_in']['username'], '<span class="glyphicon glyphicon-user"></span> My Profile'); ?></li>
                        <?php endif ?>
                        <li><a href="<?php echo base_url('logout')?>" class="nav"><span class="glyphicon glyphicon-lock"></span> Logout</a></a></li>
                    <?php else: ?>
                        <li><a href="<?php echo base_url('login')?>" class="nav"><span class="glyphicon glyphicon-lock"></span> Login</a></a></li>
                        <li><a href="<?php echo base_url('signup');?>" class="nav"><span class="glyphicon glyphicon-user"></span> Free Registration</a></li>
                    <?php endif; ?>
                </ul>
            </div><!--collapse-navbar-->
        </div><!--container-->
    </nav>

    <header class="container">
        <div class="row">
            <div class="col-sm-3">
                <?php echo anchor(base_url(), '<img src="'.base_url('public/images/khojeko.png').'" class="img-responsive">')?>
            </div>

            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-6">
                        <img src="<?php echo base_url('public/images/banners/banner1.jpg');?>" class="img-responsive">
                    </div>
                    <div class="col-sm-6">
                        <img src="<?php echo base_url('public/images/banners/banner2.jpg');?>" class="img-responsive">
                    </div>
                </div>
                <div class="website-details">
                    <a href="#">All Ads (<?php echo $total_items;?>)</a>
                    <a href="#">Dealer Ads (<?php echo $dealer_items;?>)</a>
                    <a href="#">Individual Ads (<?php echo $user_items;?>)</a>
                    <a href="#">New Ads (<?php echo $new_items;?>)</a>
                    <a href="#">Used Ads (<?php echo $used_items;?>)</a>
                </div>
            </div><!--col-sm-9-->
        </div><!--row-->
    </header>

    <section>
        <div class="container" >
            <div class="col-sm-3 left_block">
                <?php echo form_open('filter', array('method' => 'GET')); ?>
                <div class="category_block">
                    <div class="category row">
                        <div class="col-sm-5">
                            <label for="category_drop" class="category-label">Categories</label>
                        </div>
                        <div class="col-sm-7">
                            <select name="type" id="category_drop" class="form-control">
                                <option>All Ads</option>
                                <option>Dealer Ads</option>
                                <option>Individual Ads</option>
                                <option>New Ads</option>
                                <option>Used Ads</option>
                            </select>
                        </div><!--col-sm-7-->
                    </div><!--col-sm-5-->

                    <div class="hierarchy">
                        <div class="category_filter">
                            <?php
                            function filter_by_parent($parent_id, $array) {
                                $retval = array();
                                foreach($array as $key => $value){
                                    if($value->parent_id == $parent_id)
                                        $retval[] = $value;
                                }
                                return $retval;
                            }
                            require_once('require/category.php');
                            print_list(0, 0, $category);
                            ?>
                        </div><!--category_filter-->
                    </div><!--hierarchy-->
                </div><!--category_block-->

                <div id="filter">
                    <label class="filter_title">Price Filter</label><br />
                    <div id="slider-snap"></div>
                    <div class="row control-value">
                        <div class="col-sm-6">
                            <input type="text" name="min" readonly id="slider-snap-value-lower" class="form-control"/>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" name="max" readonly id="slider-snap-value-upper" class="form-control text-right"/>
                        </div>
                    </div>
                    <div class="row text-center">
                        <button class="btn btn-default" type="submit">Apply Filter</button>
                    </div>
                    <?php echo form_close();?>
                </div>

                <div class="banner">
                    <img src="<?php echo base_url('public/images/shipping.jpg');?>" class="img-responsive">
                    <img src="<?php echo base_url('public/images/shipping.jpg');?>" class="img-responsive">
                </div>

                <div class="fb-page" data-href="https://www.facebook.com/technorio" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/facebook"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>
            </div> <!--end of col-sm-3-->

            <div class="col-sm-9">
                <?php echo form_open('results', array('method' => 'GET', 'style' => 'padding:0px;')); ?>
                <div class="row search-bar">
                    <div class="col-sm-2">
                        <select name="city" class="form-control">
                            <option value="all-district">All district</option>
                            <option value="kathmandu">Kathmandu</option>
                            <option value="lalitpur">Lalitpur</option>
                            <option value="bhaktapur">Bhaktapur</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-9">
                            <input type="text" name="search" class="form-control" placeholder="What are you looking for?"  value="<?php echo $this->input->get('search');?>" />
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn form-control"><span class="glyphicon glyphicon-search"></span> Search</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <a href="<?php echo base_url('adpost'); ?>"><button type="button" class="btn form-control post-ad-btn">POST FREE ADVERTISEMENT</button></a>
                    </div>
                </div>
                <div id="error_content"></div>
                <div id="content">