<div class="col-sm-12">
    <div class="dealer_listing">
        <div class="dealer_list_topic">
            <label>Dealer Listing >>></label>
            <a href="!#" id="test">Show List in alphabetic order</a>
        </div>
        <ul id="list">
            <?php foreach ($dealer_list as $one):?>
            <li><?php echo anchor('dealer/'.$one->khojeko_username.'/All', $one->name);?></li>
            <?php endforeach;?>
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
                    <img data-u="image" src="<?php echo base_url('public/images/logos/amazon.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/android.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/bitly.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/blogger.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/dnn.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/drupal.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/ebay.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/facebook.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/google.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/ibm.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/ios.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/joomla.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/linkedin.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/mac.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/magento.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/pinterest.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/samsung.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/twitter.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/windows.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/wordpress.jpg');?>" />
                </div>
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/youtube.jpg');?>" />
                </div>
            </div>
        </div><!--jssor_1 ends-->
    </div><!--logos1 ends-->

    <div class="listing">
        <div class="col-sm-4 popular_district" >
            <u> <a> Popular District by Listing</a></u>
            <div class="child">
                <ol >
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
            <u><a>Popular Categories</a></u>
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

    <?php if ($this->session->has_userdata('logged_in')): ?>
    <div class="history">
        <div class="history_title">
            <a>Your recently viewed Ads</a>
            <a class="a_history">View your all browsing history>></a>
        </div>

        <div class="history_section">
            <?php foreach ($recent_views as $rv):?>
                <li style="height:140px; width:160px;">
                    <img src="<?php echo base_url('public/images/item_images/'.$rv->image);?>" style="height:100px; width:100px; padding:5px"><br>
                    <span class="title">
                    <b>Rs. <?php echo $rv->price; ?></b><br>
                    <a class="sub" href="!#"><?php echo (strlen($rv->title) > 15) ? substr($rv->title, 0, 15).'...' : $rv->title; ?></a><br>
                </span>
                </li>
            <?php endforeach;?>
        </div>
    </div> <!--history ends-->
    <?php endif; ?>

</div><!--col-sm-12 ends-->

</div>  <!--container ends-->
</section>

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
                <a href="#!">Rojeko dot com Pvt. Ltd. Nepal.</a>&nbsp;&nbsp;
                <a> All Rights Reserved</a>

            </div>

        </div>
    </div>
</footer>
<a href="#" class="back-to-top"><i class="fa fa-arrow-up"></i></a>

<script src="<?php echo base_url('public/js/jquery.js');?>"></script>
<script src="<?php echo base_url('public/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('public/js/category.js');?>"></script>
<script src="<?php echo base_url('public/js/display.js');?>"></script>
<script src="<?php echo base_url('public/js/list_grid.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/jssor.slider.min.js');?>"></script>
<script>// JavaScript Document

    function sortUnorderedList(ul, sortDescending) {
        if(typeof ul == "string")
            ul = document.getElementById(ul);

        var lis = ul.getElementsByTagName("LI");
        var vals = [];

        for(var i = 0, l = lis.length; i < l; i++)
            vals.push(lis[i].innerHTML);

        vals.sort();

        if(sortDescending)
            vals.reverse();

        for(var i = 0, l = lis.length; i < l; i++)
            lis[i].innerHTML = vals[i];
    }

    window.onload = function() {
        var desc = false;
        document.getElementById("test").onclick = function() {
            sortUnorderedList("list", desc);
            desc = !desc;
            return false;
        }
    }
</script>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script>
    jssor_1_slider_init();
</script>

</body>
</html>