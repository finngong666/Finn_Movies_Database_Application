<?php

require("config.php");


    
    try{

        $connString = "mysql:host=$host;dbname=$dbname";
        return $dbConn =  new PDO($connString,$user,$password);
    
    } catch (PDOException $ex){
    
        exit ("connection error: ".$ex->getMessage());
    
    }


    



