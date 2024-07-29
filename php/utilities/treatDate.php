<?php

    function treatDate($date){
        $date_array = explode("-",$date);
        return $date_array[2]."/".$date_array[1]."/".$date_array[0];
    }

?>