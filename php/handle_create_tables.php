<?php 
    function createTables($conn){
        $query = file_get_contents('../sql.txt');

        if ($query === false) {
            echo "Error reading SQL file.";
            return;
        }

        if (mysqli_multi_query($conn, $query)) {
            echo "Query executed successfully.";
        } else {
            echo "Error executing query: " . mysqli_error($conn);
        }
    }

?>