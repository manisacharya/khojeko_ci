
    <div class="col-sm-12">
    	<h3>Insert Site Logo</h3>


        <?=form_open_multipart('admin/logo_upload');?>
            <div id="wrapper" style="margin-top: 20px;">
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