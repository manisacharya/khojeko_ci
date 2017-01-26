
<div class="col-sm-10 col-sm-offset-1">
    <?php echo form_open('admin/feed');?>
    <?php echo $message;?>

    <div class="form-group">
        <label for="email">Content: </label>
        <textarea name="f_content" id="email" class="form-control" rows="15"><?php echo set_value('f_content', $templates->content);?></textarea>
        <?php echo form_error('f_content')?>
    </div>

    <button class="btn btn-primary">Update</button>
    <?php echo form_close();?>

</div><!--col-sm-12-->
</section>