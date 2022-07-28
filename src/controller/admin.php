<?php
declare(strict_types = 1);

use src\model\CompaniesManager;

require_once('../model/admin.php');

class AdminController
{
    //Méthode affichage de la page d'accueil
    public function render() 
    {
        //Si l'utilisateur est admin
        require('../view/admin/dashboard.php');
    }
}

$adminDisplay = new AdminController();
echo $adminDisplay->render();