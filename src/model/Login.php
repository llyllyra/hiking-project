<?php

declare(strict_types=1);

namespace \model;

require_once('db.php');

class Login extends Manager
{

    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    //To display company by id
    public function getUser(int $userId)
    {

        $db = $this->connectDb();

        $req = $db->prepare('SELECT ... AS ... 
            FROM ... 
            WHERE id = ?');

        $req->bindParam(1, $this->userId, PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch();

        return $user;
    }

}