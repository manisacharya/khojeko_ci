
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

    <?php echo form_open_multipart("adpost"); ?>
        <div class="setup-content" id="step-1">
            <div class="form-group">
                <h3> Step 1&nbsp;&nbsp;(Select category for ad posting)</h3>

                <?php
                    require_once('templates/require/category.php');
                    print_list(0, 0, $categories);
                ?>

                <div class="search_section">
                    <table>
                        <tr>
                            <td style="width:30%">
                                To find best category quick search is here:
                            </td>

                            <td style="width:50%">
                                <input type="text" class="search" style="width:40%">
                                <button>Search</button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Suggested Category:
                            </td>

                            <td>
                                <textarea name="display_cat" id="display_parent" readonly></textarea>
                                <textarea name="parent_id" id="parent" hidden="hidden"></textarea>
                            </td>
                        </tr>
                    </table>
                </div><!--search_section ends-->

                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>

        <div class="setup-content step-2" id="step-2">
            <div class="form-group">
                <h3> Step 2</h3>

                <?php
                    echo "<strong>*Ad Title:</strong><br>";
                    echo form_input('ad_title', $this->input->post('ad_title'), 'maxlength="100" class="sstep" placeholder="Title of the product" required');
                ?>

                <br /><br />

                <?php
                   // echo "<strong>*Short Description:</strong><br>";
                    //echo form_input('shrt_description', $this->input->post('shrt_description'), 'maxlength="100" class="sstep" placeholder="Description of the product" ');
                ?>

                <!-- <br /><br /> -->

                <?php
                    if($user_type == "personal"){
                        echo '
                        <span class="ad_type">
                            <strong>Ad Type:</strong><br />

                            <input type="radio" name="ad_type_personal" id="used" value="Used" checked="checked">Used<br />
                            <input type="radio" name="ad_type_personal" id="like_new" value="Likely New">Likely New<br />
                        </span>';
                    } else {
                        echo '
                        <span id="ad_type">
                          <strong>Ad Type:</strong><br /> 
                            <input type="radio" name="ad_type_dealer" id="used" value="Used" checked="checked" onclick="serviceCheck(this)">Used
                            <input type="radio" name="ad_type_dealer" id="new" value="Brand_New" onclick="serviceCheck(this)">Brand New (For Dealer ad)
                            <input type="radio" name="ad_type_dealer" id="service" value="Service" onclick="serviceCheck(this)">Service Ad/ General Ad
                            <input type="radio" name="ad_type_dealer" id="event" value="Event" onclick="serviceCheck(this)">Event (Time Based)<br /> <br />
                        </span>';
                    }
                ?>

                <br /><br />

                <span id="bought_from">
                    <strong>Bought From:</strong><br />

                    <input type="radio" name="bought_from" id="nepal" value="Nepal" checked="checked">Nepal<br />
                    <input type="radio" name="bought_from" id="abroad" value="Abroad">Abroad<br />
                    <input type="text" placeholder="Type Country Name" name="abroad_country" id="country_name">
                </span>

                <br /><br />

                <span id="offer" style="display: block;">
                    <strong>Offer Price:</strong><br>
                    <input name="offer" type="text" class="sstep"/>

                    <span>
                        <a href="#!"><i class="fa fa-question-circle" id="popup1"></i></a>
                        <a class="popuptext" id="myPopup1" >If it is Service or Advertisement ad leave box blank</a>
                    </span><br/><br/>
                </span>

                <span id="used_for" style="display: block;">
                    <strong>Used for days/month/year:</strong><br>
                    <input type="text" name="used_for" class="sstep"/>

                    <span>
                        <a href="#!">
                            <i class="fa fa-question-circle" id="popup2"></i>
                        </a>
                        <a class="popuptext" id="myPopup2"> If service related ad (ignore it)</a>
                    </span><br /><br />
                </span>

                <span id="market_price" style="display: block;">
                    <strong>Market Price:</strong><br>
                    <input type="text" name="market_price" class="sstep"/>
                    <span>
                        <a href="#!">
                            <i class="fa fa-question-circle" id="popup3"></i>
                        </a>
                        <a class="popuptext" id="myPopup3">If you don't know indicative market price leave it blank.</a>
                    </span>
                    <br /><br />
                </span>

                <span id="document_no">
                    <strong>(Identification no/Chasis no/Document no/IMEI no):</strong><br>

                    <input type="text" name="document_no" class="sstep"/>
                    <span>
                        <a href="#!">
                            <i class="fa fa-question-circle" id="popup4"></i>
                        </a>

                        <a class="popuptext" id="myPopup4" >this is optional but if you mention ad id no. your ad is fully verified and trustful and may sold out quickly</a>
                    </span>
                    <br /><br />
                </span>

                <strong>
                    Product or Service ad details/ full specification: ( submit with full specification and product details):
                </strong><br />
                <input type="text" name="ad_details" id="ad_details" style="width:60%; height:100px;text-align:center" placeholder="TEXT EDITOR" required="required"/>
                <div id="textarea_feedback"></div>
                <br /><br />

                <strong>Please select your free ad running time</strong>
                <select name="ad_running_time">
                    <option>7 days</option>
                    <option>15 days</option>
                    <option>30 days</option>
                    <option>60 days</option>
                    <option>90 days</option>
                </select><br /><br />

                <strong>Own Web site url link:</strong>
                <input type="text" name="site_url" class="sstep"/>
                <a href="#!" id="popup5">
                    <i class="fa fa-question-circle"  ></i>
                </a>
                <a class="popuptext" id="myPopup5">if not leave it blank.</a>
                <br /><br />

                <span id="home_delivery">
                    <strong>Home delivery facility:</strong><br>
                    <input type="radio" name="home_delivery" id="yes" value="yes" checked="checked" onclick="deliveryCheck(this)" />Yes<br>
                    <input type="radio" name="home_delivery" id="no" value="no" onclick="deliveryCheck(this)" />No<br /><br />
                </span>

                <div id="delivery_charge" style="display: block;">
                    <strong>Delivery Charges:</strong><br>
                    <input type="text" name="delivery_charge" class="sstep"/>
                    <a href="#!" id="popup6">
                        <i class="fa fa-question-circle"  ></i>
                    </a>
                    <a class="popuptext" id="myPopup6">if not leave it blank.</a><br /><br />
                </div>

                <span id="warranty">
                    <strong>Warranty Time:</strong><br>
                    <input type="text" name="warranty" id="input" class="sstep"/>
                    <a href="#!" id="popup7">
                        <i class="fa fa-question-circle"></i>
                    </a>
                    <a class="popuptext" id="myPopup7">if not leave it blank.</a><br /><br />
                </span>

                <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
            </div>
        </div>

        <div class="setup-content" id="step-3">
            <div class="form-group">
                <h3> Step 3</h3>

                <strong> owner proof document:</strong><br />
                <input type="checkbox" name="owner_proof[]" noneoption="false" value="Vat/Pan Bill" />Vat/Pan Bill<br />
                <input type="checkbox" name="owner_proof[]" noneoption="false" value="Product warranty card" />Product warranty card<br />
                <input type="checkbox" name="owner_proof[]" noneoption="false" value="Product Paking Box" />Product Paking Box<br />
                <input type="checkbox" name="owner_proof[]" id="none" noneoption="true" value="Not" />Not any above<br /><br />

                <span id="reason">
                    <strong>If not any above.<br />specify reason</strong>
                    <input type="text" name="reason" style="height:30px; width:160px" />
                </span><br /><br />

                <div id="dynamic_field">
                    <div class="row">
                        <div class="col-md-10">
                            <strong>Upload your images here:</strong>
                            <h5 style="color:blue">First image will be displayed as primary.</h5>
                            <input type="file" name="upload_images" accept="image/*" onchange="showMyImage(this)" />
                        </div>
                        <div class="col-md-2">
                            <button type="button" name="add" id="add" class="btn btn-primary btn-xs pull-right">Add More Photos (Maximum 4)</button>
                        </div>
                    </div>
                </div>

                <hr/>

                <strong>
                    Upload Video Url ( From Youtube embeed):<br /><br> Video 1.
                </strong>
                <input type="text" name="video1_url" id="input"/>
                <a href="#!" class="info">
                    <i class="fa fa-question-circle"></i>
                    <span>if not leave it blank.</span>
                </a>
                <br />

                <strong>Video 2.</strong>
                <input type="text" name="video2_url" id="input"/>
                <a href="#!" class="info">
                    <i class="fa fa-question-circle"  ></i>
                    <span>if not leave it blank.</span>
                </a>
                <br /><br>

                <button class="btn btn-default prevBtn btn-lg pull-left" type="button" >Prev</button>
                <button class="btn btn-success btn-lg pull-right" type="submit">Done!</button>
            </div>
        </div>
    <?php echo form_close(); ?>
</div><!--end of post_admin-->
</div><!--guts-->
</div><!-- col-sm-9 -->
</div>
