<?php

declare(strict_types=1);

require_once 'dbconnect.php';
require_once('../core/db.php');

class Search  extends Dbconnect
{


   public function searchByName(string $search)
   {
       $pdo = $this->getConnection();

       try{
           $query = "SELECT *, h.name  as hName, h.id as Hid
                        FROM hikes h
                            JOIN hikesTag hT ON h.id = hT.hike_id 
                            JOIN tags t ON t.id = hT.tag_id 
                        WHERE t.name LIKE '%$search%' OR h.name LIKE '%$search%'";
           $q=  $pdo->prepare($query);
           $q->execute();
           $searchs = $q->fetchAll(PDO::FETCH_ASSOC);
           return $searchs;

       }catch (Exception $e) {
           echo $e->getMessage();
           exit;
       }

   }
}