<?php
declare(strict_types = 1);

require_once '../model/dbconnect.php';


if(isset($_GET['page']) && $_GET['page'] == 'disconnect') {
    require_once '../view/disconnect.php';
    require_once '../model/disconnect.php';  
}

switch ($i) {
    case 0:
        echo "i égal 0";
        break;
    case 1:
        echo "i égal 1";
        break;
    case 2:
        echo "i égal 2";
        break;
}