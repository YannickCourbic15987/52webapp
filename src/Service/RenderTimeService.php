<?php
namespace App\Service;

use DateTime;
use DateTimeZone;

class RenderTimeService{

    private  DateTimeZone $zone;

    public function __construct(){
        $this->zone = new DateTimeZone('Europe/Paris');
    }

    public function buttonDownTime(DateTime $dateEdit){
        $newDateEdit = $dateEdit->add(new \DateInterval('P1D'));
        $now = new DateTime('now' , $this->zone);
        if($now >= $newDateEdit){
            return true;
        }
    }
}