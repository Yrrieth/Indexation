<?php
    require 'sql_connect.php';

    /*$sql = "SELECT * FROM document WHERE url_document = '$fichier'";
    $tab_document = array();
    if ($result_select_document = mysqli_query($connection, $sql)) {
        if ($result_select_document->num_rows > 0) {
            $index = 0;
            while ($row = $result_select_document->fetch_assoc()) {
                //echo $row['url_document'] .'<br>';
                $tab_document[$index++] = $row;
            }
        }
        echo 'Success select document';
    } else {
        echo 'Failed select document';
    }

    $sql = "SELECT * FROM mot";
    $tab_mot = array();
    if ($result_select_mot = mysqli_query($connection, $sql)) {
        if ($result_select_mot->num_rows > 0) {
            $index = 0;
            while ($row = $result_select_mot->fetch_assoc()) {
                //echo $row['mot'] . ' ' . $row['id_mot'].'<br>';
                $tab_mot[$index++] = $row;
            }
        }
        echo 'Success select mot';
    } else {
        echo 'Failed select mot';
    }

    foreach ($tab_mot as $cle_mot => $valeur_mot) {
        $id_mot = $valeur_mot['id_mot'];
        $id_document = $tab_document[0]['id_document'];
        //foreach($tab_document as $cle_document => $valeur_document) {
        foreach ($result_all_occurence as $cle_occurence => $valeur_occurence) {
            if (strcmp($valeur_mot['mot'], $cle_occurence) == 0) {
                $sql = "INSERT INTO document_mot(id_document, id_mot, poids)
                    SELECT '$id_document', '$id_mot', '$valeur_occurence'
                    WHERE NOT EXISTS (
                        SELECT id_document, id_mot FROM document_mot
                        WHERE id_document = '$id_document' AND id_mot = '$id_mot'
                    )";
                
                $result_query = mysqli_query($connection, $sql);
            }
        }
        //}
    }*/

    //print_array($result_all_occurence);
    foreach($result_all_occurence as $cle_occurence => $valeur_occurence) {
        $sql = "INSERT INTO document_mot(id_document, id_mot, poids)
            SELECT 
                (SELECT id_document FROM document WHERE url_document = '$fichier'),
                (SELECT id_mot FROM mot WHERE mot = '$cle_occurence'),
                '$valeur_occurence'
            WHERE NOT EXISTS (
                SELECT id_document, id_mot FROM document_mot
                WHERE 
                    id_document = (SELECT id_document FROM document WHERE url_document = '$fichier') AND 
                    id_mot = (SELECT id_mot FROM mot WHERE mot = '$cle_occurence')
            )";

        $result_query = mysqli_query($connection, $sql);
    }
    

    if ($result_query) {
        echo 'Success insert document mot';
    } else {
        echo 'Failed insert document mot';
    }
    

?>