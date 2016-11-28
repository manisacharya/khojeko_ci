
    <div class="col-sm-12">
        <?php echo form_open('admin/category_add');?>
            <?php echo $message;?>
            <label for="category">Type Category Name: </label>
            <input type="text" name="c_name"><br><br>
            <?php echo form_error('c_name')?>

            <label for="choose">Choose Parent Category</label>
            <div class="parent category">
                <?php
                    require_once ('templates/category.php');
                    print_list(0, 0, $categories);
                ?>
            </div>
            <label style="border:1px solid #ff404b; padding:3px;" class="parent_click">
                <a href="#">Set as parent</a>
            </label><br />
            <label>Choosed Parent Category:</label>
            <div id="display_parent"></div>
            <textarea name="parent_id" id="parent" hidden="hidden"></textarea></br>

            <button type="submit" class="btn-primary">Add</button>
        <?php echo form_error('parent_id'); ?>
     </form>
    
    </div><!--col-sm-12-->
</section>
