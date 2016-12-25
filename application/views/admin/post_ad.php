<?php
   //echo $this->session->flashdata('message');
   //echo $this->session->flashdata('error');
    echo $message;
?>
  
    <div class="col-sm-12">
        <div class="post_admin">
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
                     <div class="stepwizard-step">
                        <a href="#step-4" type="button" class="btn btn-default btn-circle steps" disabled="disabled">4</a>
                        <p>Step 4</p>
                    </div>
                </div>
            </div>

            <?php 
                $attributes = array('id' => 'adminPostAd');
                echo form_open_multipart("admin/post_ad", $attributes);
                echo validation_errors();
            ?>

                <div class="setup-content" id="step-1">
                    <div class="form-group col-sm-12">
                        <div class="row">
                            <h3> Step 1&nbsp;&nbsp;(User Details)</h3>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 input-title">
                                <?php echo "<label class='control-label' name='email_check'>*Email</label>"; ?>
                            </div>
                            <div class="col-sm-7 input-text">
                                <input type="email" name="email" class="form-control" id="email" value="<?php echo set_value('email');?>" maxlength=100 required placeholder="Enter Email" autofocus>

<!--                                --><?php //echo form_input('email', $this->input->post('email'), 'maxlength=100 class="form-control" id="email" placeholder="Enter Email" autofocus required'); ?>
                                <?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
                                <div class="result" id="result2"></div>
                            </div>
                        </div>

                        <div id="matched_email_check">
                            <div class="row">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>*Ad Owner Name</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <?php echo form_input('owner_name', $this->input->post('owner_name'), 'maxlength=100 class="form-control" placeholder="Enter Owner Name" required'); ?>
                                    <?php echo form_error('owner_name', '<div class="alert alert-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>*User Name</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <input type="text" name="username" class="form-control" id="username" value="<?php echo set_value('username');?>" required placeholder="Enter User Name" autofocus>

                                    <?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); ?>
                                    <div class="result" id="result1" ></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>*Password</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <?php
                                    $data = array(
                                                  'name'        => 'password',
                                                  'type'        => 'password',
                                                  'id'          => 'password',
                                                  'class'       => 'form-control',
                                                  'placeholder' => 'Password',
                                                  'required'    => 'required',
                                                );

                                    echo form_input($data);
                                    echo form_error('password', '<div class="alert alert-danger">', '</div>');
                                ?>
                                </div>
                            </div>

                            <div class="row" id="to_hide">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>*Retype Password</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <?php
                                    $data1 = array(
                                                  'name'        => 're_password',
                                                  'type'        => 'password',
                                                  'id'          => 're_password',
                                                  'class'       => 'form-control',
                                                  'placeholder' => 'Retype Password',
                                                  'required'    => 'required',
                                                  'onChange'    => 'checkPasswordMatch();'
                                                );

                                    echo form_input($data1);

                                    //echo form_input('re_password', $this->input->post('re_password'), 'maxlength="100" class="form-control" id="re_password" placeholder="Retype Password" type="password" required');
                                    echo form_error('re_password', '<div class="alert alert-danger">', '</div>'); ?>
                                    <div class="registrationFormAlert" id="divCheckPasswordMatch"></div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>*Zone</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <?php
                                        $options = array();
                                        $options[] = "-- Select Zone --";

                                        foreach($zones as $row) {
                                            $options[$row->zone_name] = $row->zone_name;
                                        }
                                        echo form_dropdown('zone', $options, $this->input->post('zone'), ' id="zone" class="form-control"');
                                    ?>

                                    <?php echo form_error('zone', '<div class="alert alert-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>*District</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <select name='district' id='district' class="form-control">
                                        <option value="">-- Select District --</option>
                                    </select>

                                    <?php echo form_error('district', '<div class="alert alert-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>*City</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <?php echo form_input('city', $this->input->post('city'), 'maxlength=100 class="form-control" placeholder="Enter City" required'); ?>
                                    <?php echo form_error('city', '<div class="alert alert-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>*Address</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <?php echo form_input('address', $this->input->post('address'), 'maxlength=100 class="form-control" placeholder="Enter Address" required'); ?>
                                    <?php echo form_error('address', '<div class="alert alert-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>*Primary Mobile</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <input maxlength=10 name="mobile1" type="text" required class="form-control" value="<?php echo set_value('mobile1');?>" id="mobile1" placeholder="Enter Primary Mobile" maxlength = 10/>
                                    <?php echo form_error('mobile1', '<div class="alert alert-danger">', '</div>'); ?>
                                    <div class="result" id="result3"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>Secondary Mobile</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <input maxlength=10 name="mobile2" id="mobile2" type="text" class="form-control" value="<?php echo set_value('mobile2');?>" placeholder="Enter Secondary Mobile" maxlength = 10/>
                                    <?php echo form_error('mobile2', '<div class="alert alert-danger">', '</div>'); ?>
                                    <div class="result" id="sec_result"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 input-title">
                                    <?php echo "<label class='control-label'>Landline_no</label>"; ?>
                                </div>
                                <div class="col-sm-7 input-text">
                                    <input maxlength=10 name="landline_no" id="text" type="number" class="form-control" value="<?php echo set_value('landline_no');?>" maxlength = 9 placeholder="Enter Landline No."/>
                                    <?php echo form_error('landline_no', '<div class="alert alert-danger">', '</div>'); ?>
                                    <div class="result" id="tel_p_result"></div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div>
                                <button class="btn btn-primary nextBtn btn-lg pull-right" id="checkUser" type="button" >Next</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="setup-content" id="step-2">
                    <div class="form-group col-sm-12">
                        <h3>Step 2 :&nbsp;&nbsp;(Select category for ad posting)</h3>
                        <div class="category post-ad-category">
                            <?php
                                require_once ('templates/category.php');
                                print_category(0, 0, $categories);
                            ?>
                        </div>

                        <div class="search_section">
                            <label>Suggested Category: &nbsp<div id="post_cname"></div></label>
                            <textarea name="postc_slug" id="post_c_slug" hidden="hidden" required readonly></textarea>
                        </div><!--search_section ends-->

                        <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                        <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                    </div>
                </div>

                <div class="setup-content" id="step-3">
                        <div class="form-group col-sm-12">
                            <h3> Step 3 : Advertisement Information</h3>
                            <div class="row">
                                <div class="col-sm-3 input-title"><label>*Ad Title:</label></div>
                                <div class="col-sm-7 input-text">
                                    <?php echo form_input('ad_title', $this->input->post('ad_title'), 'maxlength=100 class="sstep form-control" placeholder="Title of the product" required'); ?>
                                    <?php echo form_error('ad_title'); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3 input-title"><label>Ad Type:</label></div>
                                <div class="col-sm-7 input-text">
                                    <div class="col-sm-5 text-center">
                                        <input type="radio" name="ad_type" id="used" value="Used" checked="checked">
                                        <label for="used">Used</label>
                                    </div>
                                    <div class="col-sm-7 text-center">
                                        <input type="radio" name="ad_type" id="like_new" value="Likely New">
                                        <label for="like_new">Likely New</label>
                                    </div>
                                </div>
                            </div>

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
                                            <option value="Day">Day</option>
                                            <option value="Month">Month</option>
                                            <option value="Year">Year</option>
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

    <!--                        <div class="row">-->
    <!--                            <div class="col-sm-3 input-title"><label for="url_link">URL Link:</label></div>-->
    <!--                            <div class="col-sm-7 input-text">-->
    <!--                                <input type="text" name="site_url" class="sstep form-control" id="url_link"/>-->
    <!--                                --><?php //echo form_error('site_url'); ?>
    <!--                            </div>-->
    <!--                        </div>-->

                            <div class="row" id="home_delivery" style="block">
                                <div class="col-sm-3 input-title"><label>Home delivery:</label></div>
                                <div class="col-sm-7 input-text">
                                    <div class="col-sm-6 text-center">
                                        <input type="radio" name="home_delivery" class="home_delivery" id="yes" value="yes" checked="checked" onclick="deliveryCheck(this)" />
                                        <label for="yes">Yes</label>
                                    </div>
                                    <div class="col-sm-6 text-center">
                                        <input type="radio" name="home_delivery" class="home_delivery" id="no" value="no" onclick="deliveryCheck(this)" />
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

                            <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                            <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                        </div>
                    </div>

                <div class="setup-content" id="step-4">
                        <div class="form-group col-sm-12">
                            <h3>Step 4: Documents</h3>
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

    <!--                        <div id="dynamic_field">-->
    <!--                            <div class="row">-->
    <!--                                <div class="col-md-10">-->
    <!--                                    <strong>Upload your images here:</strong>-->
    <!--                                    <h5 style="color:blue">First image will be displayed as primary.</h5>-->
    <!--                                    <input type="file" name="upload_images" accept="image/*" onchange="showMyImage(this)" />-->
    <!--                                </div>-->
    <!--                                <div class="col-md-2">-->
    <!--                                    <button type="button" name="add" id="add" class="btn btn-primary btn-xs pull-right">Add More Photos (Maximum 4)</button>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->

                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <label>Upload Video Url From Youtube embeed</label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-3 input-title"><label for="video_url1">Video Url 1:</label></div>
                                <div class="col-sm-7 input-text">
                                    <input type="text" name="video1_url" id="video_url1" class="form-control" />
                                    <?php echo form_error('video1_url'); ?>
                                </div>
                            </div>
                            <br>
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

                <!-- <div class="setup-content step-5">
                    <div class="form-group">
                        <div class="message">
                            <a id="success-message">Congratulation your account is successfully created.</a>
                            <a id="unsuccess-message">Please check your email and verify your account soon.</a>
                        </div>
                    </div>
                </div> -->

            <?php echo form_close(); ?>
        </div><!--end of post_admin-->
    </div><!--col-sm-12-->
</section>

<script type="javascript">
    $(document).ready(function(){
        $("#yes").click(function(){
            $('#delivery_charge').show();
        });

        $("#no").click(function(){
            $('#delivery_charge').hide();
        });
    });
</script>

