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

        echo "
            <ul class='category".$level."'>";
        foreach ($children as $child) {
            if ( ! $child->c_deleted) {
                // indent and display the title of this child <br>
                echo '
                    <li><a href="#" id="'.$child->c_id.'"><i class="fa fa-plus-circle plus0"></i><i class="fa fa-minus-circle minus0"></i>&nbsp'.$child->c_name.'</a>';
                print_list($child->c_id, $level+1, $array);
                echo  "
                    </li>";
            }
        }
        echo "
            </ul>";
    }
    
    print_list(0, 0, $categories);
?>

