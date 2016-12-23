<div class="login_title">
    <h2>Post Advertisements Here</h2>
    <p>Advertisement anything that may be 1st hand or 2nd hand stuffs, post service ads, vacancies, events, jobs, rent, real state land and building, all advertisement services are available free of cost. Enjoy.</p>

</div><!--login_title-->
<div class="post_admin">
    <div class="stepwizard">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button" class="btn btn-primary btn-circle steps">1</a>
                    <p>Step 1</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle steps" disabled="disabled">2</a>
                    <p>Step 2</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle steps" disabled="disabled">3</a>
                    <p>Step 3</p>
                </div>
            </div>
        </div>
    </div>
    <?php echo validation_errors(); ?>

    <?php echo form_open_multipart("adpost"); ?>
        <div class="setup-content col-sm-12" id="step-1">
            <div class="form-group post-ad-category">
                <h3>Step 1 : Select Category</h3>
                <?php
                    require_once('templates/require/category_select.php');
                    print_category(0, 0, $category);
                ?>

                <div class="search_section">
                    <label>Suggested Category: &nbsp<div id="post_cname"></div></label>
                    <textarea name="postc_slug" id="post_c_slug" hidden="hidden" readonly></textarea>
                </div><!--search_section ends-->

                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>

        <div class="setup-content step-2 col-sm-12" id="step-2">
            <div class="form-group">
                <h3>Step 2 : Advertisement Information</h3>
                <div class="row">
                    <div class="col-sm-3 input-title"><label>*Ad Title:</label></div>
                    <div class="col-sm-7 input-text">
                        <?php echo form_input('ad_title', $this->input->post('ad_title'), 'maxlength="100" class="sstep form-control" placeholder="Title of the product" required'); ?>
                        <?php echo form_error('ad_title'); ?>
                    </div>
                </div>

                <?php if($user_type == "personal") { ?>
                        <div class="row" id="ad_type">
                            <div class="col-sm-3 input-title"><label>Ad Type:</label></div>
                            <div class="col-sm-7 input-text">
                                <div class="col-sm-5 text-center">
                                    <input type="radio" name="ad_type_personal" id="used" value="Used" checked="checked">
                                    <label for="used">Used</label>
                                </div>
                                <div class="col-sm-7 text-center">
                                    <input type="radio" name="ad_type_personal" id="like_new" value="Likely New">
                                    <label for="like_new">Likely New</label>
                                </div>
                            </div>
                        </div>
                <?php } else {?>
                    <div class="row" id="ad_type">
                        <div class="col-sm-3 input-title"><label>Ad Type:</label></div>
                        <div class="col-sm-7 input-text">
                            <div class="col-sm-3 text-center">
                                <input type="radio" name="ad_type_dealer" id="used" value="Used" checked="checked" onclick="serviceCheck(this)">
                                <label for="used">Used</label>
                            </div>
                            <div class="col-sm-3 text-center">
                                <input type="radio" name="ad_type_dealer" id="new" value="Brand New" onclick="serviceCheck(this)">
                                <label for="new">Brand New</label>
                            </div>
                            <div class="col-sm-3 text-center">
                                <input type="radio" name="ad_type_dealer" id="service" value="Service" onclick="serviceCheck(this)">
                                <label for="service">Service </label>
                            </div>
                            <div class="col-sm-3 text-center">
                                <input type="radio" name="ad_type_dealer" id="event" value="Event" onclick="serviceCheck(this)">
                                <label for="event">Event</label>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="quantity">
                        <div class="col-sm-3 input-title"><label>Quantity:</label></div>
                        <div class="col-sm-7 input-text">
                            <input type="text" name="quantity_dealer" class="sstep form-control" id="quantity_dealer" placeholder="Enter Quantity of item" required/>
                            <?php echo form_error('quantity'); ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="row" id="bought_from">
                    <div class="col-sm-3 input-title"><label>Bought From:</label></div>
                    <div class="col-sm-7 input-text">
                        <div class="col-sm-5 text-center">
                            <input type="radio" name="bought_from" id="nepal" value="Nepal" checked="checked">
                            <label for="nepal">Nepal</label>
                        </div>
                        <div class="col-sm-7 text-center">
                            <input type="radio" name="bought_from" id="abroad" value="Abroad">
                            <label for="abroad">Abroad</label>
                            <input type="text" placeholder="Type Country Name" name="abroad_country" maxlength=30 id="country_name" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row" id="offer">
                    <div class="col-sm-3 input-title"><label for="offer_input">Offer Price:</label></div>
                    <div class="col-sm-7 input-text">
                        <input name="offer" type="text" class="sstep form-control" id="offer_input" required/>
                        <?php echo form_error('offer'); ?>
                    </div>
                </div>

                <div class="row" id="used_for">
                    <div class="col-sm-3 input-title"><label for="used_input">Used for:</label></div>
                    <div class="col-sm-7 input-text">
                        <div class="col-sm-6 input-text">
                            <input type="text" name="used_for_text" class="sstep form-control" id="used_input" required>
                        </div>
                        <div class="col-sm-6 input-text">
                            <select name="used_for_time" class="form-control">
                                <option>Day</option>
                                <option>Month</option>
                                <option>Year</option>
                            </select>
                        </div>
                        <?php echo form_error('used_for'); ?>
                    </div>
                </div>

                <div class="row" id="market_price">
                    <div class="col-sm-3 input-title"><label for="market_price_input">Market Price:</label></div>
                    <div class="col-sm-7 input-text">
                        <input type="text" name="market_price" class="sstep form-control" id="market_price_input" />
                        <?php echo form_error('market_price'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label for="document_input">(ID No / Chasis No / Document no/IMEI no):</label></div>
                    <div class="col-sm-7 input-text">
                        <input type="text" name="document_no" class="sstep form-control" id="document_input"/>
                        <?php echo form_error('document_no'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label for="ad_details">Advertisement Details:</label></div>
                    <div class="col-sm-7 input-text">
                        <?php
                        $data = array(
                            'name' => 'ad_details',
                            'rows' => 6,
                            'cols' => 25,
                            'maxlength' => 300,
                            'id' => 'ad_details',
                            'placeholder' => 'Full specification and Product details',
                            'class'=>'form-control',
                            'required'=>'required'
                        );
                        echo form_textarea($data);
                        echo form_error('ad_details');
                        ?>
                        <div id="textarea_feedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label for="ad_duration">Advertisement Durations:</label></div>
                    <div class="col-sm-7 input-text">
                        <select name="ad_running_time" id="ad_duration" class="form-control">
                            <option value="7 days">7 days</option>
                            <option value="14 days">14 days</option>
                            <option value="30 days" selected>30 days</option>
                            <option value="60 days">60 days</option>
                            <option value="90 days">90 days</option>
                        </select>
                    </div>
                </div>

<!--                <div class="row">-->
<!--                    <div class="col-sm-3 input-title"><label for="url_link">URL Link:</label></div>-->
<!--                    <div class="col-sm-7 input-text">-->
<!--                        <input type="text" name="site_url" class="sstep form-control" id="url_link"/>-->
<!--                        --><?php //echo form_error('site_url'); ?>
<!--                    </div>-->
<!--                </div>-->

                <div class="row" id="home_delivery" style="block">
                    <div class="col-sm-3 input-title"><label>Home delivery:</label></div>
                    <div class="col-sm-7 input-text">
                        <div class="col-sm-6 text-center">
                            <input type="radio" name="home_delivery" class="home_delivery" id="yes" value="1" checked="checked" onclick="deliveryCheck(this)" />
                            <label for="yes">Yes</label>
                        </div>
                        <div class="col-sm-6 text-center">
                            <input type="radio" name="home_delivery" class="home_delivery" id="no" value="0" onclick="deliveryCheck(this)" />
                            <label for="no">No</label>
                        </div>
                    </div>
                </div>

                <div class="row" id="delivery_charge" style="block">
                    <div class="col-sm-3 input-title"><label for="input_delivery">Delivery Charges:</label></div>
                    <div class="col-sm-7 input-text">
                        <input type="text" name="delivery_charge" id="input_delivery" class="sstep form-control"/>
                        <?php echo form_error('delivery_charge'); ?>
                    </div>
                </div>

                <div class="row" id="warranty">
                    <div class="col-sm-3 input-title"><label for="input_warranty">Warranty Period:</label></div>
                    <div class="col-sm-7 input-text">
                        <input type="text" name="warranty" id="input_warranty" class="sstep form-control"/>
                    </div>
                </div>

                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button" >Prev</button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>

        <div class="setup-content step-3 col-sm-12" id="step-3">
            <div class="form-group">
                <h3>Step 3 : Documents:</h3>

                <div class="row">
                    <div class="col-sm-3 input-title"><label>Proof Document:</label></div>
                    <div class="col-sm-7 input-text">
                        <div class="col-sm-3 text-center">
                            <input type="checkbox" name="owner_proof[]" noneoption="false" value="Vat/Pan Bill" id="vat_bill" />
                            <label for="vat_bill">Vat/Pan Bill</label>
                        </div>
                        <div class="col-sm-3 text-center">
                            <input type="checkbox" name="owner_proof[]" noneoption="false" value="Warranty card" id="warranty_card" />
                            <label for="warranty_card">Warranty</label>
                        </div>
                        <div class="col-sm-3 text-center">
                            <input type="checkbox" name="owner_proof[]" noneoption="false" value="Product Packing Box" id="packing_box" />
                            <label for="packing_box">Pack</label>
                        </div>
                        <div class="col-sm-3 text-center">
                            <input type="checkbox" name="owner_proof" id="none" noneoption="true" value="Not" id="nothing" />
                            <label for="nothing">Not Any</label>
                        </div>
                    </div>
                </div>

                <div class="row" id="reason">
                    <div class="col-sm-3 input-title"><label for="reason">Specify Reason:</label></div>
                    <div class="col-sm-7 input-text">
                        <input type="text" name="reason" id="reason" class="form-control" />
                        <?php echo form_error('reason'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 input-title"><label for="image_upload">Upload Images:</label></div>
                    <div class="col-md-7 input-text">
                        <div class="col-md-7 text-center" id="dynamic_field">
                            <input type="file" name="upload_images" accept="image/*" required onchange="showMyImage(this)" />
                        </div>
                        <div class="col-md-5 text-center">
                            <button type="button" name="add" id="add" class="btn btn-primary btn-xs">Add Photos (Max 4)</button>
                            <label style="color:blue; margin-top:5px;">First image will default set as primary</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <label>Upload Video Url From Youtube embeed</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label for="video_url1">Video Url 1:</label></div>
                    <div class="col-sm-7 input-text">
                        <input type="text" name="video1_url" id="video_url1" class="form-control" />
                        <?php echo form_error('video1_url'); ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-3 input-title"><label for="video_url2">Video Url 2:</label></div>
                    <div class="col-sm-7 input-text">
                        <input type="text" name="video2_url" id="video_url2" class="form-control" />
                        <?php echo form_error('video2_url'); ?>
                    </div>
                </div>

                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button" >Prev</button>
                <button class="btn btn-success btn-lg pull-right" type="submit">Done</button>
            </div>
        </div>
    <?php echo form_close(); ?>
</div><!--end of post_admin-->
</div><!--guts-->
</div><!-- col-sm-9 -->
</div>

<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        var text_maximum = 300;
        $('#textarea_feedback').html(text_maximun + ' characters remaining');

        $('#ad_details').keyup(function() {
            var text_length = $('#ad_details').val().length;
            var text_remaining = text_maximum - text_length;

            $('#textarea_feedback').html(text_remaining + ' characters remaining');
        });
    });
</script>