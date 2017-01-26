
<div class="col-sm-10 col-sm-offset-1">
    <?php echo form_open('admin/mass_mail');?>
    <?php echo $message;?>

    <div class="form-group">
        <label for="email">Content: </label>
        <textarea name="m_content" id="email" class="form-control" rows="15"><?php echo set_value('m_content', $templates->content);?></textarea>
        <?php echo form_error('m_content')?>
    </div>

    <button class="btn btn-primary">Update</button>
    <?php echo form_close();?>

</div><!--col-sm-12-->
</section>