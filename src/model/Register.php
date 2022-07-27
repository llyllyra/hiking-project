<?php

declare(strict_types=1);

namespace \model;

require_once('DbConnect.php');

class CompaniesManager extends User
{

    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    //To display all the companies
    public function getCompanies()
    {
        
        $db = $this->connectDb();

        $req = $db->query('SELECT * FROM hikes');

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    //To display company by id
    // public function getCompany(int $companyId)
    // {

    //     $db = $this->connectDb();

    //     $req = $db->prepare('SELECT ... AS ... 
    //         FROM ... 
    //         WHERE id = ?');

    //     $req->bindParam(1, $this->companyId, PDO::PARAM_STR);
    //     $req->execute();
    //     $company = $req->fetch();

    //     return $company;
    // }

}