<?php
declare(strict_types = 1);

use src\model\UserRegistration;

require_once('./model/Register.php');


class RegisterController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        header('Location: ../view/Register.php');
    }
}