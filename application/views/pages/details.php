<script>
function changeDisplayImage(image) {
target = document.getElementById('displayImage');
target.src = image.src;
}
</script>
<div class="clearfix"></div>

<div class="item_category">
    <a class="main_cat">MAIN CATEGORY:</a>
    <?php
        echo ($details->gg_parent) ? $details->gg_parent.' >> ' : '';
        echo ($details->g_parent) ? $details->g_parent.' >> ' : '';
        echo ($details->parent) ? $details->parent.' >> ' : '';
        echo $details->category;
    ?>
</div><!--item_category ends-->

<div class="warning_tips">
    <p>
        Safety Tips !!! : Before buying any product and services be carefull..1. ................................. 2. ............................................ 3. ........................................ 4. ........................................ 5. ........................................ 6. .......................................... 7. ................................................. 8. .......................
    </p>
</div><!--warning_tips-->

<div>
    <?php echo $fav_msg; ?>
    <?php echo $spam_msg; ?>
</div>

<div class="item_info">
    <div class="col-sm-4">
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-time symbol" id="clock"></span>
        </div>

        <div class="col-sm-11" id="date">
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
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-eye-open symbol"></span>
        </div>
        <div class="col-sm-11" id="view">
            <a><?php echo $details->views;?> views</a>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-calendar symbol"></span>
        </div>

        <div class="col-sm-11 expiry_date">
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
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-heart symbol"></span>
        </div>
        <div class="col-sm-11" id="favourite">
            <a href="<?php echo base_url("Details/add_to_fav/".$id)?>">Favourite</a>
        </div>
    </div>

    <div class="col-sm-2">
        <div class="col-sm-1">
            <span class="glyphicon glyphicon-warning-sign symbol"></span>
        </div>

        <div class="col-sm-10" id="fake_report">
            <?php
            $spam_msg = $this->session->flashdata('spam_check');
            if($this->session->has_userdata('logged_in')){

                if(1){ ?>
                    <a href="<?php echo base_url("Details/add_to_spam/".$id."/".$details->spam_count)?>" data-toggle="modal" data-target="#myModal">Report Us</a>
                <?php } else { ?>
                    <a href="#" id="spam_repeat" onclick="return same_spam();">Report</a>
            <?php }
            } else { ?>
                <a href="<?php echo base_url("Details/add_to_spam/".$id."/".$details->spam_count)?>">Report Us</a>
            <?php } ?>
        </div>
    </div>
</div><!--item_info ends-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Fake Report</h4>
            </div>
            <div class="modal-body">
                <?php
                    $fake_url = base_url("Details/add_to_spam/".$id."/".$details->spam_count);
                    echo form_open($fake_url);
                ?>
                <strong>
                    Fake Report Comment:
                </strong><br />
                <input type="text" name="fake_comment" id="ad_details" style="width:60%; height:100px;text-align:center" placeholder="TEXT EDITOR" maxlength=300 required="required"/>
                <div id="textarea_feedback"></div>
                <br /><br />
            </div>
            <div class="modal-footer">
                <input type="submit" name="submit" value="Submit" class="btn btn-success">

                <?php echo form_close(); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div class="col-sm-7" style="clear:both">
    <div class="item_image">
        <?php if($details->sales_status == 0){ ?>
            <img src="<?php echo base_url('public/images/sold.png'); ?>" alt="sold" id="sold" class="img-responsive">
        <?php } ?>
        <img id="displayImage" src="<?php echo base_url();?>public/images/item_images/<?php echo $image->row()->image;?>" id="item_img" class="img-big">
    </div><!--item_images ends -->

    <div class="clearfix"></div>

    <div class="item_img_slider">
        <div  id="slider1_container" >
            <div u="slides" style="cursor: move; width: 100%; height: 120px;margin-left:10px;">
                <?php foreach ($image->result() as $row): ?>
                    <div class="item_image_section">
                        <img onclick="changeDisplayImage(this)" src="<?php echo base_url();?>public/images/item_images/<?php echo $row->image; ?>" alt="mobile">
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
        <?php
        $url1 = $details->video_url1;
        $url2 = $details->video_url2;
        if ($url1 != NULL){ ?>
            <iframe width="161" height="172" src="https://www.youtube.com/embed/<?php echo $url1; ?>" frameborder="0" allowfullscreen></iframe>
        <?php } ?>
        <?php if ($url2 != NULL){ ?>
            <iframe width="161" height="172" src="https://www.youtube.com/embed/<?php echo $url2; ?>" frameborder="0" allowfullscreen></iframe>
        <?php } ?>
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
    <?php echo $details->specs;?>
</div><!--item_spec_sub-->

<div class="question_section">
    <div class="question_title">
        <a class="ask">ASK ME Box</a>
        <?php if($this->session->has_userdata('logged_in')) $is_session = 1;
            else $is_session = 0;
        ?>
        <a class="post" href="#!" onclick="showBox(<?php echo $is_session; ?>,'<?php echo base_url('login');?>')">Click to question</a>
        <!--a class="post" href="<?php //echo base_url("Details/ask_me_validation/".$id)?>">Click to question(USE JavaScript)</a-->
    </div>
    <div class="clearfix"></div>
    <div>
        <?php
        echo form_open('Details/ask_me_validation/'.$details->comment_count);
        echo validation_errors();

        echo form_hidden('item_id', $id);

        $data = array(
            'name' => 'question',
            'placeholder' => 'Type your question here',
            'id' => 'ques',
            'style' => 'width: 100%'
        );
        echo form_input($data);

        echo form_close();
        ?>
    </div>

    <div class="question_answer_section">

        <?php foreach ($question->result() as $row): ?>
            <question><?php echo $row->question ?></question><by>-asked by: <em><?php echo $row->khojeko_username; ?></em> on
            <?php echo mdate('%d %M %Y', $row->posted_date);?></by><br>
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