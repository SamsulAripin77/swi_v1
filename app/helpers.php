<?php // Code within app\Helpers\Helper.php


if(!function_exists('number')){
    function number($exp)
    {
        if(fmod($exp,1) !== 0.00) {
           return number_format($exp,2,',','.');
        }else {
           return number_format($exp,0,',','.');
        }
    }
}
    