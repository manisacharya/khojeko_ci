
<div class="stat_report">
        <a>Statistics Report: </a><button class="default_button" id="show">Show</button><button class="default_button" id="hide">Hide</button>
    </div>
    <div class="col-sm-12 statics">

        <div class="col-sm-4 ">

            <div class="online_stat">
                <a  class="online_report">Online Statistics</a><br><br>
                <a href="#">Visitors Online .....</a><a>13</a><br>
                <a href="#">Indivisual User Online .....</a><a>13</a><br>
                <a href="#">Dealer Online .....</a><a>13</a><br>
                <a href="#">Website Visited:<br>
                    <span>(Today ... 1200 ,
                        Till today ... 12000)
                    </span>
                </a><br>
            </div><!--online_stat-->

            <div class="Report_div">

                <ol>
                    <li><a href="#" class="red">Report Fake Ad .....</a><a>13</a></li>
                    <li><a href="#">Today's Comment .....</a><a>13</a></li>
                    <li><a href="#">Total Comment .....</a><a>13</a></li>
                    <li><a href="#">Total Premium Ads .....</a><a>13</a></li>
                    <li><a href="#">No any post ac (cross 1 year) .....</a><a>13</a></li>
                    <li><a href="#">Total<a class="red"> Locked </a>ad By admin .....</a><a>13</a></li>
                    <li><a href="#">All Premium Ad .....</a><a>13</a></li>
                    <li><a href="#">All Modified Ad By User .....</a><a>13</a><a href="#" class="red">(View and Approve)</a></li>

                </ol>
            </div><!--report_div-->
        </div><!--col-sm-4-->
        <div class="col-sm-4">
            <div class="individual_div">
                <a class="online_report">Individiual User Details</a><br><br>

                <ol>

                    <li><a href="#">Today Email Verified User .....</a><a>13</a></li>
                    <li><a href="#">Today Email Unverified User .....</a><a>13</a></li>
                    <li><a href="#">All Verified User .....</a><a>13</a></li>
                    <li><a href="#" class="red">Total Blocked/Locked Users .....</a><a>13</a></li>

                </ol>

                <ol>
                    <li><a href="#">Today Active Ads .....</a><a>13</a></li>
                    <li><a href="#">Total Unverified Ads .....</a><a>13</a></li>
                    <li><a href="#">All Active Ads .....</a><a>13</a></li>
                    <li><a href="#">Today Sold Ads .....</a><a>13</a></li>
                    <li><a href="#">All Sold Ads .....</a><a>13</a></li>
                    <li><a href="#">Today Expire Ads .....</a><a>13</a></li>
                    <li><a href="#">All Expire Ads .....</a><a>13</a></li>
                    <li><a href="#">Total Hide Ads .....</a><a>13</a></li>
                    <li><a href="#">Total Deleted Ads .....</a><a>13</a></li>

                </ol>
            </div>
        </div><!--col-sm-4-->

        <div class="col-sm-4">
            <div class="dealer_div">
                <a class="online_report">Dealer Details</a><br><br>

                <ol>

                    <li><a href="#">Today Verified User .....</a><a>13</a></li>
                    <li><a href="#">Today Unverified User .....</a><a>13</a></li>
                    <li><a href="#">All Verified User .....</a><a>13</a></li>
                    <li><a href="#" class="red">Total Blocked Users .....</a><a>13</a></li>

                </ol>

                <ol>
                    <li><a href="#">Today Active Ads .....</a><a>13</a></li>
                    <li><a href="#">Total Unverified Ads .....</a><a>13</a></li>
                    <li><a href="#">All Active Ads .....</a><a>13</a></li>
                    <li><a href="#">Today Sold Ads .....</a><a>13</a></li>
                    <li><a href="#">All Sold Ads .....</a><a>13</a></li>
                    <li><a href="#">Today Expire Ads .....</a><a>13</a></li>
                    <li><a href="#">All Expire Ads .....</a><a>13</a></li>
                    <li><a href="#">Total Hide Ads .....</a><a>13</a></li>
                    <li><a href="#">Stock Out Ads .....</a><a>13</a></li>
                    <li><a href="#">Total Deleted Ads .....</a><a>13</a></li>

                </ol>
            </div>
        </div><!--col-sm-4-->

    </div><!--statics ends-->


    <div class="col-sm-12">
        <div class="active_inactive">
            <a>Active search:</a><a href="#">All Active</a><a>/</a><a href="#">All Unactive</a>
            <input type="text" class="search_active" placeholder="Search by name, email, city, district, product etc">
            <a href="#">Search >></a>
            <button class="default_button">POST BY ADMIN</button>
        </div><!--active_inactive-->

        <div class="inactive_ads">
            <form method="post" action="<?php echo base_url('admin/Admin_pages/verify_validation') ?>">
                <div class="top_title">
                    <a>Latest Ads</a> <a class="red">(Inactive/Unverified ads)</a>
                    <a class="underline">Total Inactive Ad 10 of 26</a>
                    <a href="#">View All >></a>
                    <a>Click to:</a><!--a class="green" href="#">Verify</a-->
                    <input class="green" type="submit" value="Verify">
                    <!--a class="green" href="#">Unverify</a-->
					<a>select all   <input type="checkbox" onClick="toggle1(this)"></a>
                </div>
                <ol>
                    <?php foreach ($unverified_personal->result() as $row): ?>
                        <li>
                            <span><img src="<?php echo base_url('public'); ?>/images/item_images/<?php echo $row->image;?>" class="img-rounded"><br>
                                ad id:<?php $item_id = $row->item_id; echo $item_id;?>
                            </span>

                            <span>
                                <a class="bold">Rs. <?php echo $row->price;?></a><br>
                                <a class="bold"><?php echo $row->title;?></a><br>
                                <a><?php echo $row->avaibility_address;?></a><br>
                                <?php
                                //default_timezone_set in config.php
                                $published_date = $row->published_date;
                                echo mdate('%d %M %Y %h:%i', $published_date);
                                ?>
                            </span>

                            <span>
                                By: <a href="<?php echo base_url("upanel/".$row->khojeko_username) ?>"><?php echo $row->name;?></a><br>
                                <email><?php echo $row->email;?></email><br>
                                <number><?php echo $row->primary_mob;?></number><br>
                            <!--a class="red">Alert:1</a>&nbsp;&nbsp;--><a class="red">Scam:<?php echo $row->spam_count;?></a>
                            </span>

                            <span>
                                <a>
                                    <?php
                                    $datestring = '%d %M %Y';
                                    $days = date_diff(date_create(mdate($datestring, $published_date)), date_create(mdate($datestring, time())));
                                    $ad_duration = $row->ad_duration;
                                    $edays = $ad_duration - $days->format("%a");
                                    if(intval($edays)<0) {
                                        $extend = $days->format("%a");
                                        echo "<a>Extend for:15 days</a><br>";
                                        echo "Expired";
                                    ?>
                                        <br><a href="<?php echo base_url("admin/Admin_pages/extend_date/".$item_id."/".$extend) ?>" class="green">Renew now</a>
                                    <?php
                                    } else
                                        echo "Expiry after:".$edays." days";
                                    ?>
                                </a><br>
                            </span>

                            <span>
                                <ac>Personal ac</ac><br>
                                <view><?php echo $row->views;?> views</view><br>
                                <comment><?php echo $row->comment_count;?> comments</comment><br>
                                <running>Running for:<?php echo $days->format("%a days"); ?></running>
                            </span>

                            <span>
                                <?php
                                $sales_status = $row->sales_status;
                                if($sales_status){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/sold_unsold/".$item_id."/".$sales_status) ?>" class="red">Sold</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/sold_unsold/".$item_id."/".$sales_status) ?>" class="green">Unsold</a><br>
                                <?php }
                                $visibility = $row->visibility;
                                if($visibility){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/hide_unhide/".$item_id."/".$visibility) ?>" class="red">Hide</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/hide_unhide/".$item_id."/".$visibility) ?>" class="green">Unhide</a><br>
                                <?php } ?>
                            </span>

                            <span>
                                <a title="delete" href="<?php echo base_url("admin/Admin_pages/delete/".$item_id) ?>"><i class="fa fa-trash" style="color:red"></i></a>
                                <a title="edit" href="#"><i class="fa fa-edit" style="color:blue"></i></a>
                            </span>

                            <span>
                                <?php
                                $premium = $row->is_premium;
                                if($premium){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/premium/".$item_id."/".$premium) ?>" class="green">Not Premium</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/premium/".$item_id."/".$premium) ?>" class="red">Premium</a><br>
                                <?php } ?>
                                        <a href="<?php echo base_url()."details/".$item_id ?>">View Ad</a>
                            </span>

							<!--span><input type="checkbox" name="foo1"></span-->
                            <span><input type="checkbox" name="foo1[]" value="<?php echo $item_id; ?>"></span>
                        </li>
                    <?php endforeach ?>

                    <?php foreach ($unverified_dealer->result() as $row):?>
                        <li>
                            <span>
                                <img src="<?php echo base_url('public'); ?>/images/item_images/<?php echo $row->image;?>" class="img-rounded"><br>
                                ad id:<?php $item_id = $row->item_id; echo $item_id;?>
                            </span>

                            <span>
                                <a class="bold">Rs. <?php echo $row->price;?></a><br>
                                <a class="bold"><?php echo $row->title;?></a><br>
                                <a><?php echo $row->avaibility_address;?></a><br>
                                <?php
                                //default_timezone_set in config.php
                                $published_date = $row->published_date;
                                echo mdate('%d %M %Y %h:%i', $published_date);
                                ?>
                            </span>

                            <span>
                                <user>By: <?php echo $row->name;?></user><br>
                                <email><?php echo $row->email;?></email><br>
                                <number><?php echo $row->primary_mob;?></number><br>
                            <!--a class="red">Alert:1</a>&nbsp;&nbsp;--><a class="red">Scam:<?php echo $row->spam_count;?></a>
                            </span>

                            <span>
                                <a>
                                    <?php
                                    $datestring = '%d %M %Y';
                                    $days = date_diff(date_create(mdate($datestring, $published_date)), date_create(mdate($datestring, time())));
                                    $ad_duration = $row->ad_duration;
                                    $edays = $ad_duration - $days->format("%a");
                                    if(intval($edays)<0) {
                                        $extend = $days->format("%a");
                                        echo "<a>Extend for:15 days</a><br>";
                                        echo "Expired";
                                    ?>
                                        <br><a href="<?php echo base_url("admin/Admin_pages/extend_date/".$item_id."/".$extend) ?>" class="green">Renew now</a>
                                    <?php
                                    } else
                                        echo "Expiry after:".$edays." days";
                                    ?>
                                </a><br>
                            </span>

                            <span>
                                <ac>Dealer ac</ac><br>
                                <view><?php echo $row->views;?> views</view><br>
                                <comment><?php echo $row->comment_count;?> comments</comment><br>
                                <running>Running for:<?php echo $days->format("%a days"); ?></running>
                            </span>

                            <span>
                                <?php
                                $sales_status = $row->sales_status;
                                if($sales_status){
                                ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/sold_unsold/".$item_id."/".$sales_status) ?>" class="red">Sold</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/sold_unsold/".$item_id."/".$sales_status) ?>" class="green">Unsold</a><br>
                                <?php }
                                $visibility = $row->visibility;
                                if($visibility){
                                ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/hide_unhide/".$item_id."/".$visibility) ?>" class="red">Hide</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/hide_unhide/".$item_id."/".$visibility) ?>" class="green">Unhide</a><br>
                                <?php } ?>
                            </span>

                            <span>
                                <a title="delete" href="<?php echo base_url("admin/Admin_pages/delete/".$item_id) ?>"><i class="fa fa-trash" style="color:red"></i></a>
                                <a title="edit" href="#"><i class="fa fa-edit" style="color:blue"></i></a>
                            </span>

                            <span>
                                <?php
                                $premium = $row->is_premium;
                                if($premium){
                                ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/premium/".$item_id."/".$premium) ?>" class="green">Not Premium</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/premium/".$item_id."/".$premium) ?>" class="red">Premium</a><br>
                                <?php } ?>
                                <a href="<?php echo base_url()."details/".$item_id ?>">View Ad</a>
                            </span>

                            <span><input type="checkbox" name="foo1[]" value="<?php echo $item_id; ?>"></span>
                        </li>
                    <?php endforeach ?>
                </ol>
            </form>
        </div><!--inacctive_ads-->


        <div class="active_ads">
            <form method="post" action="<?php echo base_url('admin/Admin_pages/unverify_validation') ?>">
                <div class="top_title">
                    <a>Latest Ads</a> <a class="green">(Active)</a>
                    <a class="underline">Total Active Ad 10 of 26</a>
                    <a href="#">View All >></a>
                    <!--a class="green">Inactive Now</a-->
                    <input class="green" type="submit" value="Unverify">
                    <a>select all   <input type="checkbox" onClick="toggle2(this)"></a>
                </div>
                <ol>
                    <?php foreach ($verified_personal->result() as $row): ?>
                        <li>
                            <span><img src="<?php echo base_url('public'); ?>/images/item_images/<?php echo $row->image;?>" class="img-rounded"><br>
                                ad id:<?php $item_id = $row->item_id; echo $item_id;?>
                            </span>

                            <span>
                                <a class="bold">Rs. <?php echo $row->price;?></a><br>
                                <a class="bold"><?php echo $row->title;?></a><br>
                                <a><?php echo $row->avaibility_address;?></a><br>
                                <?php
                                //default_timezone_set in config.php
                                $published_date = $row->published_date;
                                echo mdate('%d %M %Y %h:%i', $published_date);
                                ?>
                            </span>

                            <span>
                                <user>By: <?php echo $row->name;?></user><br>
                                <email><?php echo $row->email;?></email><br>
                                <number><?php echo $row->primary_mob;?></number><br>
                                <!--a class="red">Alert:1</a>&nbsp;&nbsp;--><a class="red">Scam:<?php echo $row->spam_count;?></a>
                            </span>

                            <span>
                                <a>
                                    <?php
                                    $datestring = '%d %M %Y';
                                    $days = date_diff(date_create(mdate($datestring, $published_date)), date_create(mdate($datestring, time())));
                                    $ad_duration = $row->ad_duration;
                                    $edays = $ad_duration - $days->format("%a");
                                    if(intval($edays)<0) {
                                        $extend = $days->format("%a");
                                        echo "<a>Extend for:15 days</a><br>";
                                        echo "Expired";
                                    ?>
                                        <br><a href="<?php echo base_url("admin/Admin_pages/extend_date/".$item_id."/".$extend) ?>" class="green">Renew now</a>
                                    <?php
                                    } else
                                        echo "Expiry after:".$edays." days";
                                    ?>
                                </a><br>
                            </span>

                            <span>
                                <ac>Personal ac</ac><br>
                                <view><?php echo $row->views;?> views</view><br>
                                <comment><?php echo $row->comment_count;?> comments</comment><br>
                                <running>Running for:<?php echo $days->format("%a days"); ?></running>
                            </span>

                            <span>
                                <?php
                                $sales_status = $row->sales_status;
                                if($sales_status){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/sold_unsold/".$item_id."/".$sales_status) ?>" class="red">Sold</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/sold_unsold/".$item_id."/".$sales_status) ?>" class="green">Unsold</a><br>
                                <?php }
                                $visibility = $row->visibility;
                                if($visibility){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/hide_unhide/".$item_id."/".$visibility) ?>" class="red">Hide</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/hide_unhide/".$item_id."/".$visibility) ?>" class="green">Unhide</a><br>
                                <?php } ?>
                            </span>

                            <span>
                                <a title="delete" href="<?php echo base_url("admin/Admin_pages/delete/".$item_id) ?>"><i class="fa fa-trash" style="color:red"></i></a>
                                <a title="edit" href="#"><i class="fa fa-edit" style="color:blue"></i></a>
                            </span>

                            <span>
                                <?php
                                $premium = $row->is_premium;
                                if($premium){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/premium/".$item_id."/".$premium) ?>" class="green">Not Premium</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/premium/".$item_id."/".$premium) ?>" class="red">Premium</a><br>
                                <?php } ?>
                                        <a href="<?php echo base_url()."details/".$item_id ?>">View Ad</a>
                            </span>

                            <span><input type="checkbox" name="foo2[]" value="<?php echo $item_id; ?>"></span>
                        </li>
                    <?php endforeach ?>

                    <?php foreach ($verified_dealer->result() as $row): ?>
                        <li>
                            <span><img src="<?php echo base_url('public'); ?>/images/item_images/<?php echo $row->image;?>" class="img-rounded"><br>
                                ad id:<?php $item_id = $row->item_id; echo $item_id;?>
                            </span>

                            <span>
                                <a class="bold">Rs. <?php echo $row->price;?></a><br>
                                <a class="bold"><?php echo $row->title;?></a><br>
                                <a><?php echo $row->avaibility_address;?></a><br>
                                <?php
                                //default_timezone_set in config.php
                                $published_date = $row->published_date;
                                echo mdate('%d %M %Y %h:%i', $published_date);
                                ?>
                            </span>

                            <span>
                                <user>By: <?php echo $row->name;?></user><br>
                                <email><?php echo $row->email;?></email><br>
                                <number><?php echo $row->primary_mob;?></number><br>
                                <!--a class="red">Alert:1</a>&nbsp;&nbsp;--><a class="red">Scam:<?php echo $row->spam_count;?></a>
                            </span>

                            <span>
                                <a>
                                    <?php
                                    $datestring = '%d %M %Y';
                                    $days = date_diff(date_create(mdate($datestring, $published_date)), date_create(mdate($datestring, time())));
                                    $ad_duration = $row->ad_duration;
                                    $edays = $ad_duration - $days->format("%a");
                                    if(intval($edays)<0) {
                                        $extend = $days->format("%a");
                                        echo "<a>Extend for:15 days</a><br>";
                                        echo "Expired";
                                    ?>
                                        <br><a href="<?php echo base_url("admin/Admin_pages/extend_date/".$item_id."/".$extend) ?>" class="green">Renew now</a>
                                    <?php
                                    } else
                                        echo "Expiry after:".$edays." days";
                                    ?>
                                </a><br>
                            </span>

                            <span>
                                <ac>Dealer ac</ac><br>
                                <view><?php echo $row->views;?> views</view><br>
                                <comment><?php echo $row->comment_count;?> comments</comment><br>
                                <running>Running for:<?php echo $days->format("%a days"); ?></running>
                            </span>

                            <span>
                                <?php
                                $sales_status = $row->sales_status;
                                if($sales_status){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/sold_unsold/".$item_id."/".$sales_status) ?>" class="red">Sold</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/sold_unsold/".$item_id."/".$sales_status) ?>" class="green">Unsold</a><br>
                                <?php }
                                $visibility = $row->visibility;
                                if($visibility){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/hide_unhide/".$item_id."/".$visibility) ?>" class="red">Hide</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/hide_unhide/".$item_id."/".$visibility) ?>" class="green">Unhide</a><br>
                                <?php } ?>
                            </span>

                            <span>
                                <a title="delete" href="<?php echo base_url("admin/Admin_pages/delete/".$item_id) ?>"><i class="fa fa-trash" style="color:red"></i></a>
                                <a title="edit" href="#"><i class="fa fa-edit" style="color:blue"></i></a>
                            </span>

                            <span>
                                <?php
                                $premium = $row->is_premium;
                                if($premium){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/premium/".$item_id."/".$premium) ?>" class="green">Not Premium</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/premium/".$item_id."/".$premium) ?>" class="red">Premium</a><br>
                                <?php } ?>
                                        <a href="<?php echo base_url()."details/".$item_id ?>">View Ad</a>
                            </span>

                            <span><input type="checkbox" name="foo2[]" value="<?php echo $item_id; ?>"></span>
                        </li>
                    <?php endforeach ?>
                </ol>
            </form>
        </div><!--acctive_ads-->



    </div><!--col-sm-12-->
</section>