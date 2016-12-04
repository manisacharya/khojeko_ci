<div class="col-sm-12" style="margin-top: 20px;">
    <div class="dealer_listing">
        <div class="dealer_list_topic">
            <label>Dealer Listing >>></label>
            <a href="!#" id="test">Show List in alphabetic order</a>
        </div>
        <ul id="list">
            <?php foreach ($dealer_list as $one):?>
            <li><?php echo anchor('dealer/'.$one->khojeko_username, $one->name);?></li>
            <?php endforeach;?>
        </ul>
    </div><!--dealer listing ends-->

    <div class="logosl">
        <div id="dealer_logo">
            <a >Dealers/Retailer Partners</a>
        </div>

        <div id="jssor_1" class="partners">
            <!-- Loading Screen -->

            <div data-u="slides" class="partners_slider">

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
            <u><a>Popular District</a></u>
            <div class="child">
                <ol>
                    <?php foreach ($popular_district as $one):?>
                        <li><?php echo $one->district."(".$one->views.")";?></li>
                    <?php endforeach;?>
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
                    <?php foreach ($popular_dealer as $one):?>
                        <li><?php echo $one->name."(".$one->views.")";?></li>
                    <?php endforeach;?>
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
                <a href="<?php echo base_url('details/'.$rv->item_id);?>">
                <li style="height:140px; width:160px;">
                    <img src="<?php echo base_url('public/images/item_images/'.$rv->image);?>" style="height:100px; width:100px; padding:5px"><br>
                    <span class="title">
                    <b>Rs. <?php echo $rv->price; ?></b><br>
                    <a class="sub" href="!#"><?php echo (strlen($rv->title) > 15) ? substr($rv->title, 0, 15).'...' : $rv->title; ?></a><br>
                </span>
                </li>
                </a>
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

<script type="text/javascript" src="<?php echo base_url('public/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/categori.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/list_grid.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/jssor.slider.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/display.js"></script>
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


<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<script type="text/javascript">
    $("#ques").hide();
    $(".post").click(function() {
        $("#ques").show().focus();
    })
</script>

<script>
    jssor_1_slider_init();
</script>

<!-- part of post ad -->
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

<style type="text/css">
    .category3 i {
        display: none;
    }
</style>

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
    $(".category0 li a" || ".category1 li a").on("click", function () {
        var x = $(this).attr('id');
        var y = this.text;
        document.getElementById("parent").innerHTML = x;
        document.getElementById("display_parent").innerHTML = y;
        $("#display_parent").css('color','black');
    });
</script>

</body>
</html>