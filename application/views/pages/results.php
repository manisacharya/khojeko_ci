
<div class="listCon">
    <div id="viewcontrols" data-enhance="false">
        <a class="info"  onMouseOver="this.style.color='#ffffff'" onMouseOut="this.style.color='#ffffff'">Showing 1 - 10 of 100 results of Items</a>
        <a class="gridview" href="#!"><i class="fa fa-th fa-2x" ></i></a>
        <a class="listview" href="#!"><i class="fa fa-list fa-2x"></i></a>
        <button value="View More" id="view_btn">View More</button>
    </div>

    <ul class="list">
        <?php
        $dateFormat = 'Y-m-d';
        foreach ($searched_items as $oneitem) {

            echo '
                            <li>
                                <div class="col-sm-2" id="image_content">
                                    <img src="'.base_url().'public/images/item_images/'.$oneitem->image.'" class="img-responsive"/>
                                </div>
                                <div class="col-sm-10" id="info_content">
                                    <section class="list-right">
                                <span class="price">
                                    <a class="button">'.$oneitem->c_name.'>>'.$oneitem->c_name.'</a><br>
                                    <i class="fa fa-eye" ></i>
                                    <i class="fa fa-clock-o" ></i>
                                    <i class="fa fa-heart" ></i>
                                    <i class="fa fa-comment-o"></i>
                                </span>
                                    </section>
                                    <section class="list-left">
                                <span class="title">
                                    <b>Rs '.$oneitem->price.'<font color="red">&nbsp;('.$oneitem->item_type.')</font></b><br>
                                    <a class="sub" href="!#">'.$oneitem->title.'</a><br>
                                    <span class="address">
                                        <span>'.$oneitem->avaibility_address.'</span><span>'.date($dateFormat, $oneitem->published_date).'</span>
                                    </span>
                                </span>
                                        <p>'.$oneitem->specs.'</p>
    
                                    </section>
    
                                </div>
                            </li>
                                ';
        }
        ?>

    </ul>

</div><!--listcon ends-->
<div class="clearfix"></div>


<div id="viewcontrols" data-enhance="false">
    <a class="info"  onMouseOver="this.style.color='#ffffff'" onMouseOut="this.style.color='#ffffff'">Showing 1 - 10 of 100 results of Users.</a>
</div>
<div class="grid_view">
    <ul class="grid1" id="grid1">
    <?php foreach($searched_personals as $personal): ?>
        <a href="#" >  <li>
            <div class="col-sm-2" id="image_content">
                <img src="<?php echo base_url();?>public/images/user.png" class="img-rounded"/>
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
        </li></a>
    <?php endforeach;?>
    </ul>
</div>

<div id="viewcontrols" data-enhance="false">
    <a class="info"  onMouseOver="this.style.color='#ffffff'" onMouseOut="this.style.color='#ffffff'">Showing 1 - 10 of 100 results of Users.</a>
</div>
<div class="grid_view">
    <ul class="grid1" id="grid1">
        <?php foreach($searched_dealers as $dealer): ?>
            <a href="#" >  <li>
                    <div class="col-sm-2" id="image_content">
                        <img src="<?php echo base_url();?>public/images/dealer_logos/<?php echo $dealer->logo;?>" class="img-rounded"/>
                    </div>
                    <div class="col-sm-10" id="info_content">

                        <section class="list-left">
                            <span class="title1">
                                <b><?php echo $dealer->name?></b><br>
                                <a class="sub1"><?php echo $dealer->city?></a><br>
                                <span class="name1">
                                    Personal Account
                                </span>
                            </span>
                        </section>

                    </div>
                </li></a>
        <?php endforeach;?>
    </ul>
</div>



</div>
</div> <!--col-sm-9-->
</div>