<?php
    require 'sql_connect.php';

    foreach ($result_all_word as $value) {
        $sql = "INSERT INTO mot(mot)
            SELECT '$value'
            WHERE NOT EXISTS (
                SELECT mot FROM mot
                WHERE mot = '$value'
            )";

        $result_query = mysqli_query($connection, $sql);
    }

    if ($result_query) {
        echo 'Success insert word';
    } else {
        echo 'Failed insert word';
    }
?>