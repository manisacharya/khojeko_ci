<div class="col-sm-12" style="margin-top: 20px;">
    <div class="dealer_listing">
        <div class="dealer_list_topic">
            <label>Dealer Listing</label>
            <a href="!#" id="test">Show List in alphabetic order</a>
        </div>
        <ul id="list">
            <?php foreach ($dealer_list as $one):?>
            <li><?php echo anchor('dealer/'.$one->khojeko_username, $one->name);?></li>
            <?php endforeach;?>
        </ul>
    </div><!--dealer listing ends-->

    <div class="logosl">
        <div class="dealer_list_topic">
            <label>Dealers/Retailer Partners</label>
        </div>

        <div id="jssor_1" class="partners">
            <!-- Loading Screen -->

            <div data-u="slides" class="partners_slider">
                <div style="display: none;">
                    <img data-u="image" src="<?php echo base_url('public/images/logos/'.$retailer_partners->row()->image);?>" />
                </div>
                <?php foreach ($retailer_partners->result() as $row) { ?>
                    <div style="display: none;">
                        <img data-u="image" src="<?php echo base_url('public/images/logos/'.$row->image);?>" />
                    </div>
                <?php } ?>
            </div>
        </div><!--jssor_1 ends-->
    </div><!--logos1 ends-->

    <div class="listing">
        <div class="col-sm-4 popular" >
            <div class="popular_title"><strong>Popular District</strong></div>
            <div class="child">
                <ol>
                    <?php foreach ($popular_district as $one):?>
                        <li><?php echo $one->district."(".$one->views.")";?></li>
                    <?php endforeach;?>
                </ol>
            </div>
        </div>
        <div class="col-sm-4 popular">
            <div class="popular_title"><strong>Popular Categories</strong></div>
            <div class="child">
                <ol>
                    <li>Mobile & Tablet Pcs</li>
                    <li>Apple </li>
                    <li>Mobile & Tablet Pcs</li>
                    <li>Apple </li>
                    <li>Mobile & Tablet Pcs</li>
                    <li>Apple </li>
                    <li>Mobile & Tablet Pcs</li>
                    <li>Apple </li>
                    <li>Apple </li>
                    <li>Mobile & Tablet Pcs</li>
                    <li>Mobile  Pcs</li>
                    <li>Mobile & Tablet Pcs</li>
                    <li>Mobile & Tablet Pcs</li>
                    <li>Mobile & Tablet Pcs</li>
                </ol>
            </div>
        </div>
        <div class="col-sm-4 popular">
            <div class="popular_title"><strong>Popular Dealer</strong></div>
            <div class="child">
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
            <a>Your recently viewed Advertisements</a>
            <a class="a_history">View your all browsing history</a>
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

            <?php
                // set default timezone
                $info = getdate();
                $year = $info['year'];
            ?>
            <div class="copy_right">
                <a href="#!">Copyright Khojeko.com &copy; 2015 - <?php echo $year; ?></a>|<a> All Rights Reserved</a>
            </div>

        </div>
    </div>
</footer>
<a href="#" class="back-to-top"><i class="fa fa-arrow-up"></i></a>

<script type="text/javascript" src="<?php echo base_url('public/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/wNumb.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/slider/nouislider.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('public/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/category.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/list_grid.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/jssor.slider.min.js');?>"></script>
<!-- Custom JQuery -->
<script type="text/javascript" src="<?php echo base_url('public/js/app/custom.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/plugins/nicescroll/jquery.nicescroll.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/popup.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('public/js/back.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/dropdown.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/searchable_dropdown.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/live_preview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/next-prev-btn.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('public/js/ad_detail_slider.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/count.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/multiple_upload.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/slider/price_slider.js'); ?>"></script>


<script type="text/javascript">
    $("#ques").hide();
    function showBox(data,url) {
        if(data){
            $("#ques").show().focus();
        } else {
            window.location.href = url;
        }
    }
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
                $('#dynamic_field').append('<input type="file" name="upload_images'+i+'" accept="image/*"  onchange="showMyImage(this)" />');
                i++;
            }
        });
    });
</script>

<script>
    $(document).bind("mobileinit", function() {
        $.mobile.ignoreContentEnabled = true;
    });
</script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!--to check spam click from same user on same item.-->
<script type="text/javascript">
    function same_spam () {
        alert ("Your report already registered for this item.");
    }
</script>
</body>
</html>