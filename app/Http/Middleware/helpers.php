<?php

function get_results($marks){
    if($marks > 33){
        $result = "Passed";
    }else {
        $result = "Failed";
    }

    return $result;
}



?>