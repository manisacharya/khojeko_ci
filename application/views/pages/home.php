
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
                    foreach($dat as $i){
                        if($i->primary == 1)
                            $a++;
                    }
                    echo  $a;
                    ?>
                    ) </a>
                <a class="gridview" href="#!"><i class="fa fa-th fa-2x" ></i></a>
                <a class="listview" href="#!"><i class="fa fa-list fa-2x"></i></a>
                <button value="View More" id="view_btn">View More</button>
            </div>
            <ul class="list">

                <?php
                $i = 4;
                foreach ($dat as $key) {
                    if($key->primary == 1){
                        ?>
                        <li>
                            <div class="col-sm-2" id="image_content">
                                <?php
                                echo "<a href=".base_url()."details/".$key->item_id."><img src='".base_url('public')."/images/item_images/".$key->image."' class='img-responsive' width='304' height='236' value='".$key->image_id."'/></a>";
                                ?>
                            </div>

                            <div class="col-sm-10" id="info_content">
                                <section class="list-right">
                                    <span class="price">
                                        <a class="button">mobile>>nokia</a><br>
                                        <?php foreach ($oth as $k) {
                                            if($key->item_id == $k->item_id)
                                                echo $k->views;
                                        }?>
                                        <i class="fa fa-eye" ></i>
                                        <i class="fa fa-clock-o" ></i>
                                        <i class="fa fa-heart" ></i>
                                        <i class="fa fa-comment-o"></i>
                                    </span>
                                </section>

                                <section class="list-left">
                                    <span class="title">
                                        <b><?php echo "Rs. ".$key->price; ?><font color="red">&nbsp;(
                                                <?php
                                                foreach ($oth as $k) {
                                                if($key->item_id == $k->item_id){
                                                //echo $k->title;
                                                echo $k->item_type;
                                                // if($k->verified==1){
                                                //   echo " (Verified)";
                                                // }else{
                                                //   echo " (Not Verified)";
                                                // }
                                                // echo "<br />Views:".$k->views;
                                                ?>
                                                )</font></b><br>
                                        <a class="sub" href="!#"><?php echo $k->title; ?></a><br />
                                        <span class="name">
                                            <?php
                                            if($k->is_verified==1 && $k->visibility){
                                                echo "<i class='fa fa-check-circle' id='tick'></i>";
                                            }else{
                                                echo "<i class='fa fa-exclamation-circle' id='danger'> </i>";
                                            }
                                            ?>

                                            <b>
                                                <?php
                                                foreach ($othUs as $ku) {
                                                    if($key->item_id == $ku->item_id && $ku->type == "personal"){
                                                        echo "Ad By:".$ku->khojeko_username. " ";
                                                    }else  if($key->item_id == $ku->item_id && $ku->type == "dealer"){
                                                        echo "Seller:".$ku->khojeko_username." " ;
                                                    }
                                                }
                                                ?>
                                            </b>
                                        </span>
                                        <span class="address">
                                            <span>  <?php echo $k->avaibility_address; ?>,</span>
                                            <span><?php echo date('y-M-D', $k->published_date); ?></span>
                                        </span>
                                    </span>
                                    <p><?php echo $k->specs; ?></p>

                                    <?php }} ?>
                                </section>
                            </div>
                        </li>
                        <?php
                        $i--;
                        if($i==0)
                            break;
                    }
                }
                ?>
            </ul>
        </div><!--listcon ends-->

        <div class="clearfix"></div>

        <div class="listCon">
            <div id="viewcontrols" data-enhance="false">
                <a class="info" >Real State Latest Ads >> (
                    <?php
                    $a = 0;
                    foreach($house as $i){
//if($i->name=="House" || $i->name=="Land")
                        $a++;

                    }
                    echo  $a;
                    ?>
                    )</a>
                <button value="View More" id="view_btn">View More</button>
            </div>

            <ul class="grid">
                <?php
                $i = 8;
                foreach ($house as $key) { ?>
                    <li>
                        <div class="col-sm-2" id="image_content">
                            <?php
                            echo "<a href=".base_url()."details/".$key->item_id."><img src='".base_url('public')."/images/item_images/".$key->image."' class='img-responsive' width='304' height='236' value='".$key->image_id."'/></a>";
                            ?>
                        </div>

                        <div class="col-sm-10" id="info_content">
                            <section class="list-right">
                                <span class="price">
                                    <a class="button">mobile>>nokia</a><br>
                                    <?php
                                    foreach ($oth as $k) {
                                        if($key->item_id == $k->item_id)
                                            echo $k->views;
                                    }
                                    ?>
                                    <i class="fa fa-eye" ></i>
                                    <i class="fa fa-clock-o" ></i>
                                    <i class="fa fa-heart" ></i>
                                    <i class="fa fa-comment-o"></i>
                                </span>
                            </section>

                            <section class="list-left">
                                <span class="title">
                                    <b><?php echo "Rs. ".$key->price; ?><font color="red" size="2">
                                        <?php
                                        echo $key->title;
                                        ?>
                                    </font></b><br>
                                    <a class="sub" href="!#"><?php echo $key->title; ?></a><br>
                                    <span class="name">
                                        <?php
                                        if($key->is_verified==1){
                                            echo "<i class='fa fa-check-circle' id='tick'></i>";
                                        }else{
                                            echo "<i class='fa fa-exclamation-circle' id='danger'> </i>";
                                        }
                                        ?>

                                        <b>
                                            <?php
                                            foreach ($othUs as $ku) {
                                                if($key->item_id == $ku->item_id && $ku->type == "personal"){
                                                    echo "Ad By:".$ku->khojeko_username. " ";
                                                }else  if($key->item_id == $ku->item_id && $ku->type == "dealer"){
                                                    echo "Seller:".$ku->khojeko_username. " ";
                                                }
                                            }
                                            ?>
                                        </b>
                                    </span>
                                    <span class="address">
                                        <span>  <?php echo $k->avaibility_address; ?>,</span>
                                        <span><?php echo date('y-M-D', $k->published_date); ?></span>
                                    </span>
                                </span>
                                <p><?php echo $k->specs; ?></p>
                                <?php ?>
                            </section>
                        </div>
                    </li>
                    <?php
                    $i--;
                    if($i==0)
                        break;
                }
                ?>
            </ul>
        </div><!--listcon ends-->

        <div class="clearfix"></div>

        <div class="listCon">
            <div id="viewcontrols" data-enhance="false">
                <a class="info" >Service Ads >> (
                    <?php
                    $a = 0;
                    foreach($service as $i){
                        $a++;

                    }
                    echo  $a;
                    ?>
                    )</a>
                <button value="View More" id="view_btn">View More</button>
            </div>

            <ul class="grid">
                <?php
                $i = 4;
                foreach ($service as $key) { ?>
                    <li>
                        <div class="col-sm-2" id="image_content">
                            <?php
                            echo "<a href=".base_url()."details/".$key->item_id."><img src='".base_url('public')."/images/item_images/".$key->image."' class='img-responsive' width='304' height='236' value='".$key->image_id."'/></a>";
                            ?>
                        </div>

                        <div class="col-sm-10" id="info_content">
                            <section class="list-right">
                                <span class="price">
                                    <a class="button">mobile>>nokia</a><br>
                                    <?php
                                    foreach ($oth as $k) {
                                        if($key->item_id == $k->item_id)
                                            echo $k->views;
                                    }
                                    ?>
                                    <i class="fa fa-eye" ></i>
                                    <i class="fa fa-clock-o" ></i>
                                    <i class="fa fa-heart" ></i>
                                    <i class="fa fa-comment-o"></i>
                                </span>
                            </section>

                            <section class="list-left">
                                <span class="title">
                                    <b><font color="red" size="2">
                                        <?php
                                        echo $key->title;
                                        ?>
                                    </font></b><br>
                                    <a class="sub" href="!#"><?php echo $key->title; ?></a><br>
                                    <span class="name">
                                        <?php
                                        if($key->is_verified==1){
                                            echo "<i class='fa fa-check-circle' id='tick'></i>";
                                        }else{
                                            echo "<i class='fa fa-exclamation-circle' id='danger'> </i>";
                                        }
                                        ?>

                                        <b>
                                            <?php
                                            foreach ($othUs as $ku) {
                                                if($key->item_id == $ku->item_id){
                                                    echo "Ad By:".$ku->khojeko_username. " ";
                                                }
                                            }
                                            ?>
                                        </b>
                                    </span>
                                    <span class="address">
                                        <span>  <?php echo $k->avaibility_address; ?>,</span>
                                        <span><?php echo date('y-M-D', $k->published_date); ?></span>
                                    </span>
                                </span>
                                <p><?php echo $k->specs; ?></p>
                            </section>
                        </div>
                    </li>
                    <?php
                    $i--;
                    if($i==0)
                        break;
                }
                ?>
            </ul>
        </div><!--listcon ends-->

        <div class="clearfix"></div>

        <div class="listCon">
            <div id="viewcontrols" data-enhance="false">
                <a class="info" >Job Ads >> (
                    <?php
                    $a = 0;
                    foreach($job as $i){
                        $a++;
                    }
                    echo  $a;
                    ?>
                    )</a>
                <button value="View More" id="view_btn">View More</button>
            </div>

            <ul class="grid">
                <?php
                $i = 4;
                foreach ($job as $key) { ?>
                    <li>
                        <div class="col-sm-2" id="image_content">
                            <?php
                            echo "<a href=".base_url()."details/".$key->item_id."><img src='".base_url('public')."/images/item_images/".$key->image."' class='img-responsive' width='304' height='236' value='".$key->image_id."'/></a>";
                            ?>
                        </div>

                        <div class="col-sm-10" id="info_content">
                            <section class="list-right">
                                <span class="price">
                                    <a class="button">mobile>>nokia</a><br>
                                    <?php
                                    foreach ($oth as $k) {
                                        if($key->item_id == $k->item_id)
                                            echo $k->views;
                                    }
                                    ?>
                                    <i class="fa fa-eye" ></i>
                                    <i class="fa fa-clock-o" ></i>
                                    <i class="fa fa-heart" ></i>
                                    <i class="fa fa-comment-o"></i>
                                </span>
                            </section>

                            <section class="list-left">
                                    <span class="title">
                                        <b><font color="red" size="2">
                                            <?php
                                            echo $key->title;

                                            ?>
                                        </font></b><br>
                                        <a class="sub" href="!#"><?php echo $key->title; ?></a><br>
                                        <span class="name">
                                            <?php
                                            if($key->is_verified==1){
                                                echo "<i class='fa fa-check-circle' id='tick'></i>";
                                            }else{
                                                echo "<i class='fa fa-exclamation-circle' id='danger'> </i>";
                                            }
                                            ?>

                                            <b>
                                                <?php
                                                foreach ($othUs as $ku) {
                                                    if($key->item_id == $ku->item_id){
                                                        echo "Ad By:".$ku->khojeko_username. " ";
                                                    }
                                                }
                                                ?>
                                            </b>
                                        </span>
                                        <span class="address">
                                            <span>  <?php echo $k->avaibility_address; ?>,</span>
                                            <span><?php echo date('y-M-D', $k->published_date); ?></span>
                                        </span>
                                    </span>
                                <p><?php echo $k->specs; ?></p>

                                <?php ?>
                            </section>
                        </div>
                    </li>
                    <?php
                    $i--;
                    if($i==0)
                        break;
                }
                ?>
            </ul>
        </div><!--listcon ends-->

</div> <!--col-sm-9-->

</div>  <!--row ends-->
</div>  <!--row container-->
