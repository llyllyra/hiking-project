<?php
declare(strict_types = 1);

use src\model\Hikes;

require_once('../model/hikes.php');

class HikesController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render() 
    {

        //this is just example code, you can remove the line below
        //$companies = new Hikes();

        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require('../view/homepage.php');
    }

    public function AddHike () {

    }
}

$list = new HikesController();
echo $list->render();