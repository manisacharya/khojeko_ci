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

<div class="item_info row">
    <div class="col-sm-3 text-center clock">
        <label>
            <span class="glyphicon glyphicon-time" id="clock"></span>
            <?php
                $days = $date;
                echo mdate('%d %M %Y', $details->published_date)." (".$days->format("%a days").")";
            ?>
        </label>
    </div>

    <div class="col-sm-2 text-center views">
        <label>
            <span class="glyphicon glyphicon-eye-open"></span>
            <?php echo $details->views;?>&nbspViews
        </label>
    </div>

    <div class="col-sm-3 text-center expire-date">
        <?php
            $edays = $details->ad_duration - $days->format("%a");
            if(intval($edays)<0):?>
                <label class="red"><span class="glyphicon glyphicon-calendar"></span>&nbsp;Expired</label>
            <?php else: ?>
                <label class='green'><span class='glyphicon glyphicon-calendar'></span>&nbsp;Expire After: <?php echo $edays;?> Days</label>
            <?php endif; ?>
    </div>

    <div class="col-sm-2 text-center favourite">
        <label>
            <a href="<?php echo base_url("add_to_fav/".$id)?>"><span class="glyphicon glyphicon-heart"></span>&nbsp;Favourite</a>
        </label>
    </div>

    <div class="col-sm-2 text-center report-us">
        <label>
            <?php if($this->session->has_userdata('logged_in')) : ?>
                <a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-warning-sign"></span>&nbsp;Report Us</a>
            <?php else : ?>
                <a href="<?php echo base_url("add_to_spam/".$id.'/'.$details->spam_count)?>"><span class="glyphicon glyphicon-warning-sign symbol"></span>&nbsp;Report Us</a>
            <?php endif; ?>
        </label>
    </div>
</div><!--item_info ends-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h3 class="modal-title">Report</h3>
            </div>
            <div class="modal-body">
                <?php echo form_open("add_to_spam/".$id."/".$details->spam_count); ?>
                <label for="ad_details">Report Purpose:</label><br />
                <input name="fake_comment" id="ad_details" placeholder="Report Message" maxlength=150 required="required" autofocus="autofocus" class="form-control" />
                <div id="textarea_feedback"></div>
                <br /><br />
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-success">Report</button>
                <?php echo form_close(); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<div class="col-sm-7">
    <div class="item_image">
        <?php if ($details->sales_status == 0): ?>
            <img src="<?php echo base_url('public/images/sold.png'); ?>" alt="sold" id="sold" class="img-responsive">
        <?php endif ?>
        <img id="displayImage" src="<?php echo base_url();?>public/images/item_images/<?php echo $image->row()->image;?>" id="item_img" class="img-big">
    </div><!--item_images ends -->

    <div class="clearfix"></div>

    <div class="item_img_slider">
        <div id="slider1_container">
            <div u="slides" style="cursor: move; width: 100%; height: 120px;">
                <?php foreach ($image->result() as $row): ?>
                    <div class="item_image_section">
                        <img onclick="changeDisplayImage(this)" src="<?php echo base_url();?>public/images/item_images/<?php echo $row->image; ?>" alt="mobile">
                    </div>
                <?php endforeach ?>
            </div><!--div u slides ends here-->
        </div><!--slider1_container-->
    </div><!--item_img_slider-->
</div><!--col-sm-7 ends-->

<div class="col-sm-5">
    <div class="item_written_spec">
        <label class="item_detail_title"><?php echo $details->title;?><label class='status'>&nbsp;(<?php echo $details->item_type;?>)</label>
            <?php if ($details->is_verified == 1): ?>
                <a data-toggle="tooltip" data-placement="top" title="Verified Advertisement"><span class="glyphicon glyphicon-ok-sign" id="tick"></span></a>
            <?php else:?>
                <a data-toggle="tooltip" data-placement="top" title="Not Verified Advertisement"><span class='glyphicon glyphicon-exclamation-sign' id='danger'></span></a>
            <?php endif ?>
        </label><br />
        <label class="item_detail_price">Rs.&nbsp;<?php echo $details->price;?></label>

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
            <a>Market Price: Rs.&nbsp;<?php echo $details->mkt_price; ?></a>
        </div>
    </div><!--item_writtten_spec-->

    <div class="item_owner_details">
        <label class="member">By:&nbsp;<a class="item_owner_name"><?php echo $user_type->name; ?></a>
            <?php if ($user->u_verified == 1): ?>
                <a data-toggle="tooltip" data-placement="top" title="Verified User"><span class="glyphicon glyphicon-ok-sign" id="tick"></span></a>
            <?php else:?>
                <a data-toggle="tooltip" data-placement="top" title="User Not Verified"><span class='glyphicon glyphicon-exclamation-sign' id='danger'></span></a>
            <?php endif ?>
        </label><br />
        <a>Member Since:&nbsp;<?php echo mdate('%Y %M %d', $user->ac_created); ?></a><br />
        <a>Address:&nbsp;<?php echo $user_type->city. " " . $user_type->full_address; ?></a><br />
        <a>District:&nbsp;<?php echo $user_type->district; ?></a><br />
        <a>Telephone no.:&nbsp;<?php echo $user_type->tel_no; ?></a><br />
        <a>Mobile:&nbsp;<?php echo $user_type->primary_mob; ?>
            <?php if ($user->m_verified == 1): ?>
                <a data-toggle="tooltip" data-placement="top" title="Verified Mobile"><span class="glyphicon glyphicon-ok-sign" id="tick"></span></a>
            <?php else:?>
                <a data-toggle="tooltip" data-placement="top" title="Mobile Not Verified"><span class='glyphicon glyphicon-exclamation-sign' id='danger'></span></a>
            <?php endif ?>
        </a><br />
        <?php if($user->type == 'dealer'):?>
            <a class="a_visit_owner" href="<?php echo base_url('dealer/'.$user->khojeko_username); ?>">Visit Owner Page</a>
        <?php else: ?>
            <a class="a_visit_owner" href="<?php echo base_url('user/'.$user->khojeko_username); ?>">Visit Owner Page</a>
        <?php endif; ?>
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
        if ($url1 != NULL): ?>
            <iframe width="161" height="172" src="https://www.youtube.com/embed/<?php echo $url1; ?>" frameborder="0" allowfullscreen></iframe>
        <?php endif; ?>
        <?php if ($url2 != NULL): ?>
            <iframe width="161" height="172" src="https://www.youtube.com/embed/<?php echo $url2; ?>" frameborder="0" allowfullscreen></iframe>
        <?php endif; ?>
    </div><!--video_ad ends-->

    <!--div class="map_section">
        MAP
    </div><!--map_section-->
</div><!--col-sm-5 ends-->
</div><!--guts-->

<div class="clearfix"></div>
<div class="specification">
    <div id="item_spec">
        <label>Ad details/Specification</label>
    </div><!--item_spec--->

    <div class="item_spec_sub">
        <?php echo $details->specs;?>
    </div><!--item_spec_sub-->
</div>
<div class="question_section">
    <div class="question_title">
        <label class="ask">ASK ME BOX</label>
        <?php if($this->session->has_userdata('logged_in')) $is_session = 1;
        else $is_session = 0;
        ?>
        <button type="button" id="view_btn" onclick="showBox(<?php echo $is_session; ?>,'<?php echo base_url('login');?>')">Click To Question</button>
    </div>
    <div class="clearfix"></div>
    <div>
        <?php
        echo form_open('ask_me_validation/'.$details->comment_count);
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
            <question><?php echo $row->question ?></question><by>-Asked by: <strong><em><?php echo $row->khojeko_username; ?></em></strong> on
                <?php echo mdate('%d %M %Y', $row->posted_date);?></by><br>
            <?php
            $ans = $row->answer;
            if($ans!=NULL){
                ?>
                <answer><?php echo $ans; ?></answer><br> <?php } ?>
            <br>
        <?php endforeach ?>
    </div><!--question_answer_section-->
</div><!--quetion_section ends-->
</div> <!--col-sm-9-->
</div>  <!--row ends-->