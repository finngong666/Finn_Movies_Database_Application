<?php

if (!isset($dbConn)) {
    $dbConn = require_once("connect.php");
}


if (isset($_POST["btnSubmit"])) {

    $optionValue = $_POST["genrelist"];
    $sql = "SELECT * FROM Movies WHERE genre LIKE :optionValue ORDER BY id;";
    $params = [":optionValue" => "%$optionValue%"];

    $statement = $dbConn->prepare($sql);
    $result = $statement->execute($params);

} else {
    $sql = "SELECT * FROM Movies ORDER BY id;";
    $statement = $dbConn->prepare($sql);
    $result = $statement->execute();
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="ISO-8859-1">
    <title>Movie Database Example</title>
    <!-- add your CSS -->
    <link rel="stylesheet" href="style.css">

<body>

    <header>
        <h1>Finn's Movie</h1>
    

    </header>


    <main>


        <form method="post" id="genreform">
            <p>
                <label for="genrelist">Search By genre:</label>

                <select name="genrelist" id="genrelist" form="genreform">

                    <?php

                    $optionValue = [
                         "Drama", "Action", "Romance",
                        "Comedy", "Animation"
                    ];

                    echo "<option value=''>ALL</option>";
                    foreach ($optionValue as $value) {
                            echo "<option value=$value>$value</option>";
                    }

                    ?>

                </select>

                <input type="submit" value="search" name="btnSubmit">
                

            </p>
        

        </form>


        <?php
        

        if ($result) { //query successful
          
            echo "<table>\n
            <caption>Finn's Movie List</caption>\n
            <tr>
            <th>id</th>
            <th>Title</th>
            <th>Genre</th>
            <th>Lead Studio</th>
            <th>Year</th>
            <th>Update</th>
            <th>Delete</th>
            </tr>\n";

            
            $numRecords = 0;
            while ($row = $statement->fetch()) {
              ?>

                <tr> 
                    <td><?php echo $row['id']; ?> </td>
                    <td><?php echo $row['title']; ?> </td>
                    <td><?php echo $row['genre']; ?> </td>
                    <td><?php echo $row['leadStudio']; ?> </td>
                    <td><?php echo $row['year']; ?> </td>
                    
            <?php

                echo"

                <td>

              <button class='btns'><a href = 'update.php?updateid=".$row['id']."'>Update</a></button>

                </td>

              <td> 
                
              <button class='btns'><a href = 'delete.php?deleteid=".$row['id']."'>Delete</a></button>
                
              </td>
          
              </tr>\n";

           
                $numRecords++;
    
            }
          
            echo "</table>\n\n";

        } else {
        }

    
        ?>



        <p><a href="index.php">View all Movies </a></p>
        <p><a href="insert.php">Go to Insert Page </a></p>


    </main>
    <footer>
        <address>&copy; 2022 Finn Gong</address>
    </footer>
</body>

</html>