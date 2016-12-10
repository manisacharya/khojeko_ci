<?php
function filter_by_parent($parent_id, $array) {
    $retval = array();
    foreach($array as $key => $value){
        if($value->parent_id == $parent_id)
            $retval[] = $value;
    }
    return $retval;
}

function print_list($parent, $level, $array) {

    $children = filter_by_parent($parent, $array);
    if(empty($children))
        return;
    ?>
    <ul class="category<?php echo $level; ?>">
        <?php foreach ($children as $child): ?>
            <?php if ( ! $child->c_deleted): ?>
                <li>
                    <a href="#" id="<?php echo $child->c_id; ?>">
                        <span class="glyphicon glyphicon-plus"></span>
                        <span class="glyphicon glyphicon-minus"></span>
                        <?php echo $child->c_name; ?>
                    </a>
                    <?php print_list($child->c_id, $level+1, $array); ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php } ?>