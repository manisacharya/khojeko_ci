
<div class="col-sm-12">
    <?php echo form_open('admin/category_add');?>
        <?php echo $message;?>
        <label for="new_category">Type Category Name: </label>
        <input type="text" name="c_name" id="new_category" value="<?php echo set_value('c_name');?>"><br><br>
        <?php echo form_error('c_name')?>

        <label for="choose">Choose Parent Category</label>
        <div class="parent category">
            <?php
            require_once ('templates/category.php');
            print_category(0, 0, $categories);
            ?>
        </div>
        <button type="button" class="btn btn-default parent_click">Set Parent</button><br />
        <label for="display_parent">Choosed Parent Category:</label>
        <div id="display_parent"></div>
        <textarea name="parent_slug" id="parent" hidden="hidden"></textarea></br>
        <?php echo form_error('parent_slug'); ?>
        <button type="submit" class="btn-primary">Add</button>
    <?php echo form_close(); ?>

</div><!--col-sm-12-->
</section>
