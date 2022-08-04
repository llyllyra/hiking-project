<?php

declare(strict_types=1);

//Convertisseur de minutes en heures/minutes
//Exemple 
//123 -> 2h03
//8 -> 8 min
class TimeConverter {
    public int $time;

    public function __construct(int $time)
    {
        $this->time = $time;
    }
    public function convert ()
    {
        //Si la durée est inférieure à 60 minutes, on affiche les minutes
        if ($this->time<60) {
            return ''.$this->time.' min';
        }    
        else {
            //Sinon hours = entier de la durée divisée par 60
            $hours = floor($this->time / 60);
            //Minutes = le reste
            $minutes = ($this->time % 60);
            //If ternaire
            //Si minutes plus petit que 10, on affiche un zéro devant. Ex: 2h03
            $minutes = ($minutes < 10) ? '0'.$minutes.'' : $minutes;
            return ''.$hours.'h'.$minutes.'';
        }
    }
}



