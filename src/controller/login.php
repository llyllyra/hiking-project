<?php
declare(strict_types = 1);

use \model\Login;

require_once('./model/login.php');

class LoginController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST) 
    {

        //this is just example code, you can remove the line below
        $companies = new Login();

        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require('./view/login.php');
    }
}