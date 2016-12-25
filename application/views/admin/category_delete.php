
    <div class="col-sm-12">
        <?php echo form_open('admin/category_delete');?>
            <?php echo $message;?>
            <label for="choose">Choose Category To Delete</label>

            <div class="cname category">
                <?php
                    require_once ('templates/category.php');
                    print_category(0, 0, $categories);
                ?>
            </div>

            <label>Category To Delete:</label>
            <div name="c_name" id="display_cname"></div>
            <textarea name="c_slug" id="c_id" hidden="hidden"></textarea></br>
            <?php echo form_error('c_slug')?>

            <button class="btn-primary">Delete</button>
        <?php echo form_close();?>
    
    </div><!--col-sm-12-->
</section>