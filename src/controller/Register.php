<?php
declare(strict_types = 1);

if(isset($_POST['first_name'])) {
    echo"ok";
}
require_once('../view/Register.php');
// require_once('../model/Register.php');


// class RegisterController
// {
//     //render function with both $_GET and $_POST vars available if it would be needed.
//     public function render(array $GET, array $POST)
//     {
//         //you should not echo anything inside your controller - only assign vars here
//         // then the view will actually display them.

//         //load the view
//         header('Location: ../view/register.php');
//     }
// }

// $registerDisplay = new RegisterController();
// echo $registerDisplay; 