<?php

if (!isset($dbConn)) {

    $dbConn = require_once("connect.php");

}

//if the request method is post
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    //get values from global variable $_POST
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $leadstudio = $_POST["leadstudio"];
    $year = $_POST["year"];

    //if threre is no errors and titleErrors array is empty
    if ((!isset($errors))) {

        //insert query to sql
        $sqlQuery = "INSERT INTO Movies(title, genre, leadstudio, year)
        VALUES(:title, :genre, :leadstudio, :year);";

        //avoid malicious injection
        $params = [
            ":title" => $title,
            ":genre" => $genre,
            ":leadstudio" => $leadstudio,
            ":year" => $year
        ];

        //if the server is unable to prepare the statement,
        // the prepare() will return false
        $statement = $dbConn->prepare($sqlQuery);

        //will return true id executed successfully
        //or false if it was unable to execute the query statement
        $executeOk = $statement->execute($params);

        //if successfully executed
        if ($executeOk) {

            //go to index.php page
            header('location:index.php');

        } else {
            echo "unable to insert the movie";
        }
    } else {

    }
} 


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="ISO-8859-1">
    <title>Insert Movie To Database</title>
    <link rel="stylesheet" href="insert.css">
</head>

<body>

    <header>
        <h1>Insert A Movie To Finn's Movie Database</h1>
    </header>

    <main>
        <form name="movie" action="" method="post">
            <div>
                <label for="title">Title:
                    <input type="text" id="title" name="title" size="30" maxlength="70" placeholder="Enter Title" required>

                </label>
            </div>
            <div>
                <label for="genre">Genre:
                    <input type="text" id="genre" name="genre" size="30" maxlength="30" placeholder="Enter Genre" required>
                </label>
            </div>
            <div>
                <label for="leadstudio">Lead Studio:
                    <input type="text" id="leadstudio" name="leadstudio" size="30" maxlength="30" placeholder="Enter Lead Studio" required>
                </label>

            </div>

            <div>
                <label for="year">Year:
                    <input type="number" id="year" name="year" placeholder="Enter Year" required>
                </label>
            </div>


            <div style="margin-top: 10px;">
                <button type="submit">Submit</button>
                <button type="reset">Reset</button>
                <button><a href="index.php">Back to Main Page</a></button>
            </div>

        </form>
    </main>

    <footer>
        <address>&copy; 2022 Finn Gong</address>
    </footer>
</body>

</html>