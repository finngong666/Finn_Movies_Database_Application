<?php

if (!isset($dbConn)) {
    $dbConn = require_once("connect.php");
}

if(isset($_GET["deleteid"])){

    $id = $_GET["deleteid"];
    
    $sql = "DELETE FROM Movies WHERE id = $id;";

    $statement = $dbConn -> prepare($sql);
    $result = $statement -> execute();

if($result){
    header('location:index.php');
}else{
    echo "delete failed";
}

}
