<?php
function print_list($parent, $level, $array) {

    $children = filter_by_parent($parent, $array);
    if(empty($children))
        return;
    ?>
    <ul class="category<?php echo $level; ?>">
        <?php foreach ($children as $child): ?>
            <?php if ( ! $child->c_deleted): ?>
                <li>
                    <a href="#" id="<?php echo $child->c_slug; ?>" onclick="sub_category_items('<?php echo $child->c_slug; ?>')">
                        <span class="glyphicon glyphicon-plus-sign"></span>
                        <span class="glyphicon glyphicon-minus-sign"></span>
                        <?php echo $child->c_name; ?>
                    </a>
                    <?php print_list($child->c_id, $level+1, $array); ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php } ?>