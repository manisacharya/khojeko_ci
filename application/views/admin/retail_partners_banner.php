<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery.MultiFile.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/livepreview.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/js/jquery-1.12.4.min.js"></script>

<div class="col-sm-12">
    <h3>Insert Partner Banners(140 x 100)</h3>

    <?= form_open_multipart('admin/partner_banner_upload'); ?>

        <div id="wrapper" style="margin-top: 20px; ">
                <div class="col-sm-9">
<!--                    <table>-->
                    <?php
                        $i=1;
                        $hr = 0;
                        foreach ($retailer_partners->result() as $row) {?>
<!--                        <tr>-->
<!--                            <td>--><?php //echo $i.'>'?><!--</td>-->
                            <div class="col-sm-4">
<!--                            <td>-->
                                <div id="row<?php echo $i; ?>" style="float:left;">
                                    <img id="thumbnail<?php echo $i; ?>" name="partner<?php echo $i; ?>"  data-u="image" src="<?php echo base_url('public/images/logos/'.$row->image);?>" onchange="showMyImage(this,'thumbnail<?php echo $i; ?>','2')" style="width: 140px; height: 100px;" />
                                </div>
                                <button onclick="remove('btn<?php echo $i; ?>')" id="btn<?php echo $i; ?>" type="button" name="<?php echo $i; ?>:thumbnail<?php echo $i; ?>" class="btn btn-danger btn-xs btn_remove">X</button>
                                <div class="row">
                                    <div class="col-sm-7">
                                        <input id="retail<?php echo $i; ?>" type="file" name="partner" accept="image/*" style="display: none;" onchange="showMyImage(this,'retail<?php echo $i; ?>',<?php echo $i; ?>)" />
                                    </div>
                                </div>
                            <br>
<!--                            </td>-->
                        </div>
<!--                        </tr>-->
                    <?php  $i++; } ?>
<!--                    </table>-->
                </div>
            </div>
        </div>
    </form>

    <button class="col-sm-2 btn-primary">Upload</button>
</div>

