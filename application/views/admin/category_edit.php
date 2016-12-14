
    <div class="col-sm-12">
        <?php echo form_open('admin/category_edit');?>
        <?php echo $message;?>
        <label for="choose">Choose Category to Edit : </label>
        <div class="cname category">
            <?php
                require_once ('templates/category.php');
                print_list(0, 0, $categories);
            ?>
        </div>

        <label>Selected Category:</label>
        <div id="display_cname"></div></br>
        <textarea name="c_id" id="c_id" hidden="hidden"></textarea>
        <?php echo form_error('c_id')?>

        <label for="new_category_name">New Category name: </label>
        <input type="text" name="c_name" id="new_category_name" value="<?php echo set_value('c_name');?>"><br><br>
        <?php echo form_error('c_name')?>

        <label for="choose">Choose Parent : </label>
        <div class="parent category">
            <?php
                require_once ('templates/category.php');
                print_list(0, 0, $categories);
            ?>
        </div>

        <button type="button" class="btn btn-default parent_click">Set Parent</button><br />

        <label>Selected Parent:</label>
        <div id="display_parent"></div><br />
        <textarea name="parent_id" id="parent" hidden="hidden"></textarea>
        <?php echo form_error('parent_id')?>

        <button class="btn-primary">Edit</button>
        </form>
    
    </div><!--col-sm-12-->
</section>