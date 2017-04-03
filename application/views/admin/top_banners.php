<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery.MultiFile.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/livepreview.js"></script>
    <div class="col-sm-12">
        <h3>Insert Top Banners</h3>


        <?=form_open_multipart('admin/top_banner_upload');?>
            <div id="wrapper" style="margin-top: 20px;">
                <h3 style="text-align: center">Choose either google adv or local adv. (468 x 60)</h3>

                <div class="row">
                    <label>Top Left Banner:</label><br>
                    <div class="col-sm-2">
                        <select name="top-left-banner" id="top-left" class="form-control">
                            <option value="local_adv" selected>Local adv</option>
                            <option value="google_adv">Google adv</option>
                        </select>
                    </div>
                    <div class="col-sm-2" id="local1">
                        <input id="top-left-input" type="file" name="top-left-banner" accept="image/*"  onchange="showMyImage(this,'top-left-input','1');" required />
                        <img id="tbannerl" />
                        <div class="result" id="derror1"></div>
                    </div>
                    <div class="col-sm-4 input-text" id="google1" style="display: none;">
                        <?php
                        $data = array(
                            'name' => 'google_adv1',
                            'rows' => 6,
                            'cols' => 25,
                            'id' => 'google_adv1',
                            'placeholder' => 'Paste code here',
                            'class'=>'form-control',
                            'required'=>'required'
                        );
                        echo form_textarea($data);
                        echo form_error('google_adv1');
                        ?>
                    </div>
                </div>
                <div class="row">
                    <label>Top Right Banner:</label><br>
                    <div class="col-sm-2">
                        <select name="top-right-banner" id="top-right" class="col-sm-7 form-control">
                            <option value="local_ad" selected>Local ad</option>
                            <option value="google_ad">Google ad</option>
                        </select>
                    </div>
                    <div class="col-sm-7" id="local2" >
                        <input id="top-right-input" type="file" name="top-left-banner" accept="image/*"  onchange="showMyImage(this,'top-right-input','1');" required />
                        <img id="tbannerr" />
                        <div class="result" id="derror2"></div>
                    </div>
                    <div class="col-sm-4 input-text" id="google2">
                        <?php
                        $data = array(
                            'name' => 'google_adv2',
                            'rows' => 7,
                            'id' => 'google_adv2',
                            'placeholder' => 'Paste code here',
                            'class'=>'form-control',
                            'required'=>'required'
                        );
                        echo form_textarea($data);
                        echo form_error('google_adv2');
                        ?>
                    </div>
                </div>

                <?php
                $file_data = array(
                    'name'      => 'userfile',
                    'value'     => 'Select Image',
                    'required'  => 'required',
                    'id'        => 'fileUpload'
                );
                echo form_upload($file_data);
                ?>
                <div id="image-holder"></div>
            </div>
            <br><br>
            <div class="clearfix"></div>
            <button class="btn-primary">Upload</button>
            <h4><?php echo $upload_status;?></h4>
            <h6><?php echo $error;?></h6>
            <h6><?php echo $message;?></h6>

        </form>
    </div><!--col-sm-12-->
    </section>

    <script>
        $(document).ready(function(){
            var left_select = document.getElementById("top-left");
            var right_select = document.getElementById("top-right");

            $('#top-left').select(function() {
                if(left_select == "local_ad") {
                    $('#local1').show();
                    $('#google1').hide();
                }
                else if(left_select == 'google_ad') {
                    $('#local1').hide();
                    $('#google1').show();
                }
            });
            $('#top-right').select('local_ad'){
                $('#google2').hide();
            }
        });
    </script>