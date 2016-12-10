
<div class="listCon">
    <div id="viewcontrols" data-enhance="false">
        <a class="info"  onMouseOver="this.style.color='#ffffff'" onMouseOut="this.style.color='#ffffff'">Showing 1 - 10 of 100 results of Items</a>
        <a class="gridview" href="#"><i class="fa fa-th fa-2x" ></i></a>
        <a class="listview" href="#"><i class="fa fa-list fa-2x"></i></a>
        <button value="View More" id="view_btn">View More</button>
    </div>

    <ul class="list">
        <?php foreach ($searched_items as $item): ?>
        <a href="<?php echo base_url('details/'.$item->item_id);?>">
            <li>
                <div class="col-sm-2" id="image_content">
                    <img src="<?php echo base_url('public/images/item_images/'.$item->image); ?>" class="img-responsive"/>
                </div>
                <div class="col-sm-10" id="info_content">
                    <section class="list-right">
                        <span class="price">
                            <a class="button"><?php echo $item->c_name;?></a><br>
                            <label><?php echo $item->views; ?></label>
                            <i class="fa fa-eye" ></i>
                            <i class="fa fa-clock-o" ></i>
                            <i class="fa fa-heart" ></i>
                            <i class="fa fa-comment-o"></i>
                        </span>
                    </section>
                    <section class="list-left">
                    <span class="title">
                        <b>Rs. <?php echo $item->price; ?><label style="color:#f00;">&nbsp;(<?php echo $item->item_type; ?>)</label></b><br>
                        <a class="sub" href="!#"><?php echo $item->title; ?></a><br>
                        <span class="address">
                            <span><?php echo $item->avaibility_address; ?></span>
                            <span><?php echo date('Y-m-d', $item->published_date);?></span>
                        </span>
                    </span>
                        <p><?php echo $item->specs; ?></p>
                    </section>

                </div>
            </li>
        </a>
        <?php endforeach;?>

    </ul>

</div><!--listcon ends-->
<div class="clearfix"></div>


<div id="viewcontrols" data-enhance="false">
    <a class="info"  onMouseOver="this.style.color='#ffffff'" onMouseOut="this.style.color='#ffffff'">Showing 1 - 10 of 100 results of Personals</a>
</div>
<div class="grid_view">
    <ul class="grid1" id="grid1">
    <?php foreach($searched_personals as $personal): ?>
        <a href="<?php echo base_url('user/'.$personal->khojeko_username)?>">
            <li>
            <div class="col-sm-2" id="image_content">
                <img src="<?php echo base_url('public/images/user.png');?>" class="img-rounded"/>
            </div>
            <div class="col-sm-10" id="info_content">
                <section class="list-left">
                    <span class="title1">
                        <b><?php echo $personal->name?></b><br>
                        <a class="sub1"><?php echo $personal->city?></a><br>
                        <span class="name1">
                            Personal Account
                        </span>
                    </span>
                </section>
            </div>
            </li>
        </a>
    <?php endforeach;?>
    </ul>
</div>

<div id="viewcontrols" data-enhance="false">
    <a class="info" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#ffffff'">Showing 1 - 10 of 100 results of Dealers</a>
</div>
<div class="grid_view">
    <ul class="grid1" id="grid1">
        <?php foreach($searched_dealers as $dealer): ?>
            <a href="<?php echo base_url('dealer/'.$dealer->khojeko_username.'/All');?>">
                <li>
                    <div class="col-sm-2" id="image_content">
                        <img src="<?php echo base_url();?>public/images/dealer_logos/<?php echo $dealer->logo;?>" class="img-rounded"/>
                    </div>
                    <div class="col-sm-10" id="info_content">

                        <section class="list-left">
                            <span class="title1">
                                <b><?php echo $dealer->name?></b><br>
                                <a class="sub1"><?php echo $dealer->city?></a><br>
                                <span class="name1">
                                    Dealer Account
                                </span>
                            </span>
                        </section>

                    </div>
                </li>
            </a>
        <?php endforeach;?>
    </ul>
</div>



</div>
</div> <!--col-sm-9-->
</div>
