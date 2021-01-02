<?php
    require 'sql_connect.php';

    $longueur_mot = strlen($recherche);
    $longueur_scinde = $longueur_mot / 2;
    $longueur_plus_1 = $longueur_mot + 1;
    $longueur_moins_1 = $longueur_mot - 1;

    $mot_scinde = array();
    $mot_scinde[0] = substr($recherche, 0, floor($longueur_scinde));
    $mot_scinde[1] = substr($recherche, -ceil($longueur_scinde));

    $sql = "SELECT mot from mot
            WHERE 
            ((
                (mot LIKE '$mot_scinde[0]%') OR (mot LIKE '%$mot_scinde[1]'))
                AND
                (LENGTH(mot) < '$longueur_plus_1' AND LENGTH(mot) > '$longueur_moins_1')
            )";

    if ($result_query = mysqli_query($connection, $sql)) {
        if ($result_query->num_rows > 0) {
            echo 'Cherchez-vous plutôt : ';
            while ($row = $result_query->fetch_assoc()){
                echo '<a href="./rechercher.php?q=' . $row['mot'] . '">' .  $row['mot'] . '</a>';
                //echo $row['mot'] . '<br>';
            }
        }
    } else {
        echo "Failed select correcteur auto ";
    }
?>