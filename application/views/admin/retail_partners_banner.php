<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery.MultiFile.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/livepreview.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery-1.12.4.min.js"></script>

<div class="row">
    <?php foreach ($retailer_partners->result() as $row) { ?>
        <div class="col-sm-4">
            <ul>
                <img data-u="image" src="<?php echo base_url('public/images/logos/'.$row->image);?>" />
                <input type="button" name="delete">
            </ul>
        </div>
    <?php } ?>

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