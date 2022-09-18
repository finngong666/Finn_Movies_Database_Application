<?php

//if a database connection has not been set
if (!isset($dbConn)) {

    $dbConn = require_once("connect.php");
}



$id = $_GET['updateid'];


$sql = "SELECT * FROM Movies WHERE id=$id";

$statement = $dbConn->prepare($sql);

$executeOk = $statement->execute($params);

$row = $statement->fetch();

$title = $row['title'];
$genre = $row['genre'];
$leadstudio = $row['leadStudio'];
$year = $row['year'];


if (isset($_POST['submit'])) {


    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $leadstudio = $_POST["leadstudio"];
    $year = $_POST["year"];


    $sql = "UPDATE `Movies` SET title='$title', genre='$genre', leadStudio='$leadstudio', year=$year WHERE id=$id";
    $params = [
        ":title" => $title,
        ":genre" => $genre,
        ":leadstudio" => $leadstudio,
        ":year" => $year
    ];

    $statement = $dbConn->prepare($sql);

    $executeOk = $statement->execute($params);

    if ($executeOk) {
        header('location:index.php');
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="ISO-8859-1">
    <title>Insert Movie To Database</title>
    <!-- add your CSS -->
    <link rel="stylesheet" href="insert.css">
</head>

<body>

    <header>
        <h1>Update The Movie</h1>

    </header>

    <main>
        <form name="movie" action="" method="post">
            <div>
                <label for="title">Title:
                    <input type="text" id="title" name="title" value="<?php echo $title; ?>" size="30" maxlength="70" placeholder="Title is required" required>

                </label>
            </div>
            <div>
                <label for="genre">Genre:
                    <input type="text" id="genre" name="genre" value="<?php echo $genre; ?>" size="30" maxlength="30" required>
                </label>
            </div>
            <div>
                <label for="leadstudio">Lead Studio:
                    <input type="text" id="leadstudio" name="leadstudio" value="<?php echo $leadstudio; ?>" size="30" maxlength="30" required>
                </label>
                </div>

                <div>
                    <label for="year">Year:
                        <input type="number" id="year" value="<?php echo $year; ?>" name="year" required>
                    </label>
                </div>


                <div style="margin-top: 10px;">
                    <button type="submit" name="submit">Update</button>
                    <button type="reset">Reset</button>
                    <button><a href="index.php">Back To Main Page</a></button>
                </div>

        </form>
    </main>
</body>

</html>