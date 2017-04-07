<div id="banner_section">
    <div class="col-sm-4" >
        <div class="left_image_banner"><img src="<?php echo base_url('public/images/banners/2.png');?>" class="img-responsive"></div>
        <div class="left_image_banner"><img src="<?php echo base_url('public/images/banners/3.jpg');?>" class="img-responsive"></div>
    </div>
    <div class="col-sm-8">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="<?php echo base_url('public/images/banners/1.jpg');?>" alt="Chania" >
                </div>

                <div class="item">
                    <img src="<?php echo base_url('public/images/banners/4.jpg');?>" alt="Chania">
                </div>

                <div class="item">
                    <img src="<?php echo base_url('public/images/banners/3.jpg');?>" alt="Chania">
                </div>

                <div class="item">
                    <img src="<?php echo base_url('public/images/carousel/1.jpg');?>" alt="Chania">
                </div>

                <div class="item">
                    <img src="<?php echo base_url('public/images/carousel/2.jpg');?>" alt="Flower">
                </div>

                <div class="item">
                    <img src="<?php echo base_url('public/images/carousel/4.jpg');?>" alt="Flower">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div><!--myCarousel-->
    </div><!--col-sm-8-->
</div><!--banner section-->

<div class="clearfix"></div>

<div class="listCon">
    <div id="viewcontrols" data-enhance="false">
        <a class="info" >Latest Ads (<?php echo count($items); ?>) </a>
        <a class="gridview" href="#"><span class="glyphicon glyphicon-th"></span></a>
        <a class="listview" href="#"><span class="glyphicon glyphicon-th-list"></span></a>
        <button type="button" value="View More" id="view_btn" >View More</button>
    </div>

    <ul class="list">
        <?php foreach ($items as $key): ?>
            <li>
                <div class="col-sm-2" id="image_content">
                    <a href="<?php echo base_url('details/'.$key->item_id);?>">
                        <img src="<?php echo base_url('public/images/item_images/'.$key->image); ?>" class="img-responsive"/>
                    </a>
                </div>

                <div class="col-sm-10" id="info_content">
                    <section class="list-right">
                        <span class="price">
                            <a class="button">
                                <?php
                                    echo ($key->gg_parent) ? $key->gg_parent.' >> ' : '';
                                    echo ($key->g_parent) ? $key->g_parent.' >> ' : '';
                                    echo ($key->parent) ? $key->parent.' >> ' : '';
                                    echo $key->category;
                                ?>
                            </a><br>
                            <label style="float: right;">
                                <a data-toggle="tooltip" data-placement="bottom" title="<?php echo $key->views; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <span class="glyphicon glyphicon-time"></span>
                                <span class="glyphicon glyphicon-heart"></span>
                                <a data-toggle="tooltip" data-placement="bottom" title="<?php echo $key->comment_count; ?>">
                                    <span class="glyphicon glyphicon-comment"></span>
                                </a>
                            </label>
                        </span>
                    </section>

                    <section class="list-left">
                        <span class="title">
                            <b>Rs. <?php echo $key->price; ?><label style="color:#f00;">&nbsp;(<?php echo $key->item_type; ?>)</label></b><br>
                            <a class="sub"><?php echo (strlen($key->title) > 21) ? substr($key->title, 0, 21).'...' : $key->title; ?></a>
                            <?php if ($key->is_verified == 1): ?>
                                <a data-toggle="tooltip" data-placement="top" title="Verified Advertisement"><span class="glyphicon glyphicon-ok-sign" id="tick"></span></a>
                            <?php else:?>
                                <a data-toggle="tooltip" data-placement="top" title="Not Verified Advertisement"><span class='glyphicon glyphicon-exclamation-sign' id='danger'></span></a>
                            <?php endif ?><br>

                            <span class="name">
                                <?php if($key->type == "personal") {?>
                                    <b>Ad By: <?php echo $key->khojeko_username;?></b>
                                <?php } else  if($key->type == "dealer") { ?>
                                <b>Seller: <?php echo $key->khojeko_username; } ?></b>
                            </span>
                            <br>
                            <span class="address">
                                <span><?php echo $key->avaibility_address; ?></span>
                                <span><?php echo date('Y-m-d', $key->published_date);?></span>
                            </span>
                        </span>

                        <p><?php echo $key->specs; ?></p>
                    </section>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</div><!--latest listcon ends-->

<?php foreach($filtered_items as $index => $key): ?>

    <div class="clearfix"></div>

    <div id="viewcontrols" data-enhance="false">
        <a class="info" >
            <?php echo $index.' Ads ('.count($key).')' ;?>
        </a>
        <button value="View More" id="view_btn">View More</button>
    </div>

    <ul class="list">
        <?php foreach($key as $row): ?>
            <li>
                <div class="col-sm-2" id="image_content">
                    <a href="<?php echo base_url('details/'.$row->item_id);?>">
                        <img src="<?php echo base_url('public/images/item_images/'.$row->image); ?>" class="img-responsive" >
                    </a>
                </div>

                <div class="col-sm-10" id="info_content">
                    <section class="list-right">
                        <span class="price">
                            <a class="button">
                                <?php
                                    echo ($row->gg_parent) ? $row->gg_parent.' >> ' : '';
                                    echo ($row->g_parent) ? $row->g_parent.' >> ' : '';
                                    echo ($row->parent) ? $row->parent.' >> ' : '';
                                    echo $row->category;
                                ?>
                            </a><br>

                            <label style="float: right;">
                                <a data-toggle="tooltip" data-placement="bottom" title="<?php echo $row->views; ?>">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                                <span class="glyphicon glyphicon-time"></span>
                                <span class="glyphicon glyphicon-heart"></span>
                                <a data-toggle="tooltip" data-placement="bottom" title="<?php echo $row->comment_count; ?>">
                                    <span class="glyphicon glyphicon-comment"></span>
                                </a>
                            </label>
                        </span>
                    </section>

                    <section class="list-left">
                            <span class="title">
                                <b>Rs. <?php echo $row->price; ?><label style="color:#f00;">&nbsp;(<?php echo $row->item_type; ?>)</label></b><br>
                                <a class="sub"><?php echo (strlen($row->title) > 21) ? substr($row->title, 0, 21).'...' : $row->title; ?></a>
                                <?php if ($row->is_verified == 1): ?>
                                    <a data-toggle="tooltip" data-placement="top" title="Verified Advertisement"><span class="glyphicon glyphicon-ok-sign" id="tick"></span></a>
                                <?php else:?>
                                    <a data-toggle="tooltip" data-placement="top" title="Not Verified Advertisement"><span class='glyphicon glyphicon-exclamation-sign' id='danger'></span></a>
                                <?php endif ?><br>

                                <span class="name">
                                    <?php if($row->type == "personal") {?>
                                        <b>Ad By: <?php echo $row->khojeko_username;?></b>
                                    <?php } else  if($row->type == "dealer") { ?>
                                    <b>Seller: <?php echo $row->khojeko_username; } ?></b>
                                </span>
                                <br>
                                <span class="address">
                                    <span><?php echo $row->avaibility_address; ?></span>
                                    <span><?php echo date('Y-m-d', $row->published_date);?></span>
                                </span>
                            </span>

                        <p><?php echo $row->specs; ?></p>
                    </section>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
<?php endforeach ?>
</div> <!--col-sm-9-->
</div>  <!--row ends-->
</div>  <!--row container-->
