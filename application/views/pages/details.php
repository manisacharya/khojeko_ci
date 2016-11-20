
<div class="clearfix"></div>

<?php echo $fav_msg; ?>

<div class="item_category">
    <a class="main_cat">MAIN CATEGORY:</a>
    <a class="cat_description">Mobile Phones & Tablets</a> >><a class="cat_description"> Mobiles</a> >><a class="cat_description"> Nokia </a>
</div><!--item_category ends-->

<div class="warning_tips">
    <p>
        Safety Tips !!! : Before buying any product and services be carefull..1. ................................. 2. ............................................ 3. ........................................ 4. ........................................ 5. ........................................ 6. .......................................... 7. ................................................. 8. .......................
    </p>
</div><!--warning_tips-->

<div class="item_info">
    <div class="col-sm-2">
        <div class="col-sm-2">
            <i class="fa fa-clock-o" id="clock"></i>
        </div>

        <div class="col-sm-10" id="date">
            <a></a>
            <a>
                <?php
                //default_timezone_set in config.php
                $days = $date;
                echo mdate('%d %M %Y', $details->published_date)."(".$days->format("%a days").")";
                ?>
            </a>
        </div>
    </div>

    <div class="col-sm-2" style="padding-left:4px">
        <div class="col-sm-2">
            <i class="fa fa-eye"></i>
        </div>
        <div class="col-sm-10" id="view">
            <a><?php echo $details->views;?> views</a>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="col-sm-2">
            <i class="fa fa-eye"></i>
        </div>

        <div class="col-sm-10 expiry_date">
            <a>
                <?php
                $edays = $details->ad_duration - $days->format("%a");
                if(intval($edays)<0)
                    echo "Expired";
                else {
                    echo "Expiry after:";
                    echo $edays . " days";
                }
                ?>
            </a>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="col-sm-2">
            <i class="fa fa-heart"></i>
        </div>
        <div class="col-sm-10" id="favourite">
            <a href="<?php echo base_url("Details/add_to_fav/".$id)?>">Add to favourite</a>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="col-sm-2">
            <img src="<?php echo base_url();?>public/images/danger.png" alt="warning">
        </div>

        <div class="col-sm-10" id="fake_report">
            <a href="<?php echo base_url("Details/add_to_spam/".$id)?>">If this ad is fake report us</a>
        </div>
    </div>
</div><!--item_info ends-->

<div class="col-sm-7" style="clear:both">
    <div class="item_image">
        <?php if($details->sales_status == 0){ ?>
            <img src="<?php echo base_url('public/images/sold1.jpg'); ?>" alt="sold" id="sold" class="img-responsive">
        <?php } ?>
        <img src="<?php echo base_url();?>public/images/item_images/<?php echo $image->row()->image;?>" id="item_img" class="img-responsive">
    </div><!--item_images ends -->

    <div class="clearfix"></div>

    <div class="item_img_slider">
        <div  id="slider1_container" >
            <div u="slides" style="cursor: move; width: 100%; height: 120px;margin-left:10px;">
                <?php foreach ($image->result() as $row): ?>
                    <div class="item_image_section">
                        <img src="<?php echo base_url();?>public/images/item_images/<?php echo $row->image; ?>" alt="mobile">
                    </div>
                <?php endforeach ?>


                <style>
                    .jssora11l, .jssora11r {
                        display: block;
                        position: absolute;
                        width: 37px;
                        height: 37px;
                        cursor: pointer;
                        background: url(/public/images/a11.png) no-repeat;

                    }
                    .jssora11l { background-position: -3px -42px; }
                    .jssora11r { background-position: -71px -41px; }
                    .jssora11l:hover { background-position: -131px -41px; }
                    .jssora11r:hover { background-position: -191px -41px; }
                    .jssora11l.jssora11ldn { background-position: -251px -41px; }
                    .jssora11r.jssora11rdn { background-position: -311px -41px; }
                </style>
            </div><!--div u slides ends here-->
            <span u="arrowleft" class="jssora11l" style="top: 123px; left: -10px;"></span>
            <span u="arrowright" class="jssora11r" style="top: 123px; right: -8px;"></span>
        </div><!--slider1_container-->
    </div><!--item_img_slider-->


</div><!--col-sm-7 ends-->

<div class="col-sm-5">
    <div class="item_written_spec">
        <?php
        echo "<a class='item_detail_price'>";
        echo "Offer Rs.".$details->price."</a>"."<a class='status'>".$details->item_type."</a><br>";
        echo "<a class='item_detail_title'> $details->title</a>";
        echo "<p>".$specification->specs."</p>";
        ?>

        <div class="written_from">
            <a class="bought_from">Bought From:
                <?php
                $country = $details->bought_from;
                if(strtoupper("$country") == "NEPAL")
                    echo $country;
                else
                    echo "Abroad(".$country.")";
                ?>
            </a><br>
            <a>Market Indicative Price: <?php echo "Rs. ".$details->mkt_price; ?></a>
        </div>
    </div><!--item_writtten_spec-->

    <div class="item_owner_details">
        <a class="item_id"><?php echo 'ad id: '.$details->item_id; ?>,&nbsp;&nbsp;Member since:<?php echo mdate('%d %M %Y', $user->ac_created); ?></a><br>
        <a>Ad by:<a class="item_owner_name"> <?php echo $user_type->name; ?></a></a><br>
        <a>Address: <?php echo $user_type->city. " " . $user_type->full_address; ?></a><br>
        <a>District: <?php echo $user_type->district; ?></a><br>
        <a>Telephone no.: <?php echo $user_type->tel_no; ?></a><br>
        <a>Mobile: <?php echo $user_type->primary_mob; ?></a>
        <?php
        if($user->m_verified == 0)
            echo "<a class='unverified'>(Unverified)</a>";
        else
            echo "<a class='verified'>(Verified)</a>";
        ?>
        <br>
        <a class="a_visit_owner" href="<?php echo base_url();?>application/views/main_index.php">Visit ad owner page(Active ad - )</a>
    </div>

    <!--<div class="send_email">
                            <div class="send_email_title">
                                <a>Send Email to Ad owner (Private)</a>
                            </div>
                            <?/*php
                            echo form_open('khojekopage/email_validation');
                            echo validation_errors();

                            echo form_hidden('id',$details->item_id);
                            echo form_hidden('tomsg',$user->email);
                            echo form_hidden('username',$user_type->name);

                            echo "<table class='email_send' style='width:100%'>";

                            echo "<tr><td> Your Name: </td>";
                            echo "<td>".form_input("name")."</td>";
                            echo "</tr>";

                            echo "<tr><td> Email Id: </td>";
                            echo "<td>".form_input("email")."</td>";
                            echo "</tr>";

                            echo "<tr><td> Mobile No.: </td>";
                            echo "<td>".form_input("mobile")."</td>";
                            echo "</tr>";

                            echo "<tr><td> Message: </td>";
                            echo "<td><textarea rows='4' name='message' cols='' placeholder='Enter Message here'></textarea></td>";
                            echo "</tr>";

                            echo "<tr><td></td><td>".form_submit("login_submit", "Send")."</td></tr>";

                            echo "</table>";
                            echo form_close();
                            */?>
                        </div><!--send_email ends-->

    <div class="video_ad">
        <video controls>
            <source src="" type="video/mp4">
            <source src="" type="video/ogg">
            Your browser does not support the video tag.
        </video>

        <video controls>
            <source src="" type="video/mp4">
            <source src="" type="video/ogg">
            Your browser does not support the video tag.
        </video>
    </div><!--video_ad ends-->



    <!--div class="map_section">
        MAP
    </div><!--map_section-->
</div><!--col-sm-5 ends-->
</div><!--guts-->

<div class="clearfix"></div>

<div id="item_spec">
    Ad details/Specification
</div><!--item_spec--->

<div class="item_spec_sub">

</div><!--item_spec_sub-->

<div class="question_section">
    <div class="question_title">
        <a class="ask">ASK ME Box</a>
        <a class="post" href="#!">Click to question</a>
        <!--a class="post" href="<?php //echo base_url("Details/ask_me_validation/".$id)?>">Click to question(USE JavaScript)</a-->
    </div>
    <div class="clearfix"></div>
    <div>
        <?php
        echo form_open('Details/ask_me_validation');
        echo validation_errors();

        echo form_hidden('item_id', $id);

        $data = array(
            'name' => 'question',
            'id' => 'ques',
            'style' => 'width: 100%'
        );
        echo form_input($data);

        echo form_close();
        ?>
    </div>

    <div class="question_answer_section">

        <?php foreach ($question->result() as $row): ?>
            <question><?php echo $row->question ?></question>-asked by: <?php echo $row->khojeko_username; ?> on
            <?php echo mdate('%d %M %Y', $row->posted_date);?><br>
            <?php
            $ans = $row->answer;
            if($ans!=NULL){
                ?>
                <answer><?php echo $ans; ?></answer><br> <?php } ?>
            <br>
        <?php endforeach ?>

        <!--question>What about its camera pixel and internal memory?</question><br>
        <br>
        <question>What about its camera pixel and internal memory?</question><br>
        <answer>Its front camera is 10 mpx, back camera of 32 mpx and have 32 gb internal mamory.</answer><br>
        <br-->
    </div><!--question_answer_section-->
</div><!--quetion_section ends-->

</div> <!--col-sm-9-->
</div>  <!--row ends-->