<?php
declare(strict_types=1);

require_once 'dbinfo.php';
class HikesManager
{
	protected function connectDb()
	{
		try{
			$db = new PDO(DNS , USER, PASSWORD);
		    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    return $db;
	    } catch(Exception $e){
	        die('Error : '.$e->getMessage());
	    }
	}

}