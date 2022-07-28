<?php
declare(strict_types = 1);

class User
{
    public function randomKey() {
        $longueurKey = 15;
        $key = "";
        for($i=1;$i<$longueurKey;$i++) {
            $key .= mt_rand(0,9);
        } 
        return $key; 
    }  
}