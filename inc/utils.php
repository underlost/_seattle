<?php
// Fetch the post value, else the default value
function get_post_val($key, $default = '') {
    if(isset($_POST[$key]) and
       !empty($_POST[$key])) {
        return $_POST[$key];
    } else {
        return $default;
    }
}
// Pretty prints an object.
function pretty_print($obj){
    echo "<pre>";
    print_r($obj);
    echo "</pre>";
}
