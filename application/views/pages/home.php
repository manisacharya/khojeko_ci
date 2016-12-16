
        <div id="banner_section">
            <div class="col-sm-4 small_banner" >
                <div id="up"><img src="<?php echo base_url('public/images/banners/2.png');?>" class="img-responsive"></div>
                <div id="down"><img src="<?php echo base_url('public/images/banners/3.jpg');?>" class="img-responsive"></div>
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
                            <img src="<?php echo base_url('public/images/banners/5.jpg');?>" alt="Flower">
                        </div>

                        <div class="item">
                            <img src="<?php echo base_url('public/images/banners/3.jpg');?>" alt="Flower">
                        </div>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <i class="fa fa-angle-left icon"></i>

                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <i class="fa fa-angle-right icon"></i>

                    </a>
                </div>
            </div>  <!--col-sm-8-->
        </div>  <!--banner section-->

        <div class="clearfix"></div>

        <div class="listCon">
            <div id="viewcontrols" data-enhance="false">
                <a class="info" >For Sale   ::  Latest Ads >> (
                    <?php
                    $a = 0;
                    foreach($items as $i){
                        $a++;
                    }
                    echo $a;
                    ?>
                    ) </a>
                <a class="gridview" href="#!"><span class="glyphicon glyphicon-th"></span></a>
                <a class="listview" href="#!"><span class="glyphicon glyphicon-th-list"></span></a>
                <button value="View More" id="view_btn">View More</button>
            </div>

            <ul class="list">
                <?php foreach ($items as $key): ?>
                    <a href="<?php echo base_url('details/'.$key->item_id);?>">
                        <li>
                            <div class="col-sm-2" id="image_content">
                                <img src="<?php echo base_url('public/images/item_images/'.$key->image); ?>" class="img-responsive"/>
                            </div>

                            <div class="col-sm-10" id="info_content">
                                <section class="list-right">
                                    <span class="price">
                                        <a class="button">
<!--                                            --><?php
                                            //                                                echo ($details->gg_parent) ? $details->gg_parent.' >> ' : '';
                                            //                                                echo ($details->g_parent) ? $details->g_parent.' >> ' : '';
                                            //                                                echo ($details->parent) ? $details->parent.' >> ' : '';
                                            //                                                echo $details->category;
                                            //                                            ?>
                                        </a><br>

                                        <label style="float: right;">
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $key->views; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                            <span class="glyphicon glyphicon-time"></span>
                                            <span class="glyphicon glyphicon-heart"></span>
                                            <span class="glyphicon glyphicon-comment"></span>
                                        </label>
                                    </span>
                                </section>

                                <section class="list-left">
                                    <span class="title">
                                        <b>Rs. <?php echo $key->price; ?><label style="color:#f00;">&nbsp;(<?php echo $key->item_type; ?>)</label></b><br>
                                        <a class="sub" href="!#"><?php echo $key->title; ?></a><br>

                                        <span class="name">
                                            <?php if($key->is_verified==1) { ?>
                                                <i class="fa fa-check-circle" id="tick"></i>
                                            <?php } else {?>
                                                <i class='fa fa-exclamation-circle' id='danger'></i>
                                            <?php } ?>

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
                    </a>
                <?php endforeach ?>
            </ul>
        </div><!--listcon ends-->

        <?php foreach($section_position as $row): ?>
            <div class="clearfix"></div>

            <div id="viewcontrols" data-enhance="false">
                <a class="info" >
                    <?php echo $row->c_name; ?> Latest Ads >> (
                    <?php
//                    $a = 0;
//                    foreach($items as $i){
//                        $a++;
//                    }
//                    echo $a;
                    ?>
                    <?php echo $row->c_id; ?>
                    ) </a>
                <a class="gridview" href="#!"><span class="glyphicon glyphicon-th"></span></a>
                <a class="listview" href="#!"><span class="glyphicon glyphicon-th-list"></span></a>
                <button value="View More" id="view_btn">View More</button>
            </div>

            <ul class="list">
                <?php foreach ($filtered_items as $key): ?>
                    <a href="<?php echo base_url('details/'.$key->item_id);?>">
                        <li>
                            <div class="col-sm-2" id="image_content">
                                <img src="<?php echo base_url('public/images/item_images/'.$key->image); ?>" class="img-responsive"/>
                            </div>

                            <div class="col-sm-10" id="info_content">
                                <section class="list-right">
                                    <span class="price">
                                        <a class="button">
<!--                                            --><?php
                                            //                                                echo ($details->gg_parent) ? $details->gg_parent.' >> ' : '';
                                            //                                                echo ($details->g_parent) ? $details->g_parent.' >> ' : '';
                                            //                                                echo ($details->parent) ? $details->parent.' >> ' : '';
                                            //                                                echo $details->category;
                                            //                                            ?>
                                        </a><br>

                                        <label style="float: right;">
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="<?php echo $key->views; ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                            <span class="glyphicon glyphicon-time"></span>
                                            <span class="glyphicon glyphicon-heart"></span>
                                            <span class="glyphicon glyphicon-comment"></span>
                                        </label>
                                    </span>
                                </section>

                                <section class="list-left">
                                    <span class="title">
                                        <b>Rs. <?php echo $key->price; ?><label style="color:#f00;">&nbsp;(<?php echo $key->item_type; ?>)</label></b><br>
                                        <a class="sub" href="!#"><?php echo $key->title; ?></a><br>

                                        <span class="name">
                                            <?php if($key->is_verified==1) { ?>
                                                <i class='fa fa-check-circle' id='tick'></i>
                                            <?php } else {?>
                                                <i class='fa fa-exclamation-circle' id='danger'> </i>
                                            <?php } ?>

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
                    </a>
                <?php endforeach ?>
            </ul>
        <?php endforeach ?>
</div> <!--col-sm-9-->

</div>  <!--row ends-->
</div>  <!--row container-->
