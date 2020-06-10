<?php

function connexionBDD()
{
	try
	{
            $bdd = new PDO('mysql:host=localhost;dbname=bdd_geststages;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $bdd;
	}
	catch(Exception $e)
	{
		$pdo_error = $e->getMessage();
                return false;
	}
    
}

?>
