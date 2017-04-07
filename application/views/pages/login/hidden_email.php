
<?php echo form_open('new_password', ['name'=>'frm']); ?>
    <input type='hidden' name='email' value='<?php echo urldecode($email); ?>'>
<?php echo form_close(); ?>

<script type="text/javascript">
    document.frm.submit();
</script>