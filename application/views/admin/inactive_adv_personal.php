<?php
$item_num = ($per_page*($page_number-1)+count($unverified_personal));
if ($item_num>$total)
    $item_num = 0;
?>
<div class="col-sm-12">
    <div class="active_inactive">
        <form class="search" method="get" action="<?php echo base_url('admin/inactive_adv_personal') ?>">
            <a>Search:</a><a href="#">All Inactive</a>
            <input type="text" name="search" class="search_active" placeholder="Search by productor adv by or user email">
            <button type="submit" id="search_btn"><i class="fa fa-search"> </i> </button>
        </form>
    </div><!--active_inactive-->

    <div class="inactive_ads">
        <form method="post" action="<?php echo base_url('admin/Admin_pages/verify_validation/inactive_adv_personal') ?>">
            <div class="top_title">
                <a>Latest Ads</a> <a class="red">(Inactive/Unverified ads)</a>
                <a class="underline">Total Inactive Ad <?php echo $item_num; ?> of <?php echo $total; ?></a>
                <a href="#">View All >></a>
                <a>Click to:</a><!--a class="green" href="#">Verify</a-->
                <input class="green" type="submit" name="verify" value="Verify">
                <!--a class="green" href="#">Unverify</a-->
                <a>select all   <input type="checkbox" onClick="toggle1(this)"></a>
            </div>
            <ol>
                <?php foreach ($unverified_personal as $row): ?>
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
                                <?php
                                $datestring = '%d %M %Y';
                                $days = date_diff(date_create(mdate($datestring, $published_date)), date_create(mdate($datestring, time())));
                                $ad_duration = $row->ad_duration;
                                $edays = $ad_duration - $days->format("%a");
                                if(intval($edays)<0) {
                                    $item_days = $days->format("%a");
                                    ?>
                                    <expiry style="color:red;">Expired</expiry><br>
                                    <?php echo "Extend for:"; ?>
                                    <select name="extended_date<?php echo $item_id; ?>">
                                        <option value="7">7</option>
                                        <option value="14">14</option>
                                        <option value="30">30</option>
                                    </select>
                                    <label>Days</label><br>
                                    <button class="green" name="renew" type="submit" value="id:<?php echo $item_id; ?>,item_days:<?php echo $item_days; ?>">Renew</button>
                                    <?php
                                } else
                                    echo "Expiry after:".$edays." days";
                                ?>
                            <br>
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
                                    <a href="<?php echo base_url("admin/Admin_pages/sold_unsold/".$item_id."/".$sales_status."/inactive_adv_personal") ?>" class="red">Sold</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/sold_unsold/".$item_id."/".$sales_status."/inactive_adv_personal") ?>" class="green">Unsold</a><br>
                                <?php }
                                $visibility = $row->visibility;
                                if($visibility){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/hide_unhide/".$item_id."/".$visibility."/inactive_adv_personal") ?>" class="red">Hide</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/hide_unhide/".$item_id."/".$visibility."/inactive_adv_personal") ?>" class="green">Unhide</a><br>
                                <?php } ?>
                            </span>

                        <span>
                                <a title="delete" href="<?php echo base_url("admin/Admin_pages/delete/".$item_id."/inactive_adv_personal") ?>"><i class="fa fa-trash" style="color:red"></i></a>
                                <a title="edit" href="#"><i class="fa fa-edit" style="color:blue"></i></a>
                            </span>

                        <span>
                                <?php
                                $premium = $row->is_premium;
                                if($premium){
                                    ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/premium/".$item_id."/".$premium."/inactive_adv_personal") ?>" class="green">Not Premium</a><br>
                                <?php } else { ?>
                                    <a href="<?php echo base_url("admin/Admin_pages/premium/".$item_id."/".$premium."/inactive_adv_personal") ?>" class="red">Premium</a><br>
                                <?php } ?>
                            <a href="<?php echo base_url()."details/".$item_id ?>">View Ad</a>
                            </span>

                        <!--span><input type="checkbox" name="foo1"></span-->
                        <span><input type="checkbox" name="foo1[]" value="<?php echo $item_id; ?>"></span>
                    </li>
                <?php endforeach ?>
                <?php echo $active_page_links;?>
            </ol>
        </form>
    </div><!--inacctive_ads-->
</div>