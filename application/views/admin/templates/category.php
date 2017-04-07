<?php
function filter_by_parent($parent_id, $array) {
    $retval = array();
    foreach($array as $key => $value){
        if($value->parent_id == $parent_id)
            $retval[] = $value;
    }
    return $retval;
}

function print_category($parent, $level, $array) {

    $children = filter_by_parent($parent, $array);
    if(empty($children))
        return;
    ?>
    <ul class="category<?php echo $level; ?>">
        <?php foreach ($children as $child): ?>
            <?php if ( ! $child->c_deleted): ?>
                <li>
                    <a id="<?php echo $child->c_slug; ?>">
                        <span class="glyphicon glyphicon-plus-sign"></span>
                        <span class="glyphicon glyphicon-minus-sign"></span>
                        <?php echo $child->c_name; ?>
                    </a>
                    <?php print_category($child->c_id, $level+1, $array); ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php } ?>

