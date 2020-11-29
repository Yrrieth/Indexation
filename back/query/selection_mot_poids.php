<?php
    require 'sql_connect.php';

    $result_mot_poids = array();

    foreach ($all_files as $fichier) {
        $fichier = substr($fichier, 4, strlen($fichier));
        $fichier = ".." . $fichier;
        $result = array();

        /*$sql = "SELECT id_mot, poids FROM document_mot 
                WHERE id_document = (SELECT id_document FROM document WHERE url_document = '$fichier')
                ORDER BY poids DESC
                LIMIT 20";*/

        $sql = "SELECT m.mot , dm.poids FROM document_mot dm
            INNER JOIN mot m ON dm.id_mot = m.id_mot
            WHERE dm.id_document = (SELECT id_document FROM document WHERE url_document = '$fichier')
            ORDER BY dm.poids DESC
            LIMIT 20";

        /*$sql = "SELECT m.mot, d.poids FROM document_mot d
            INNER JOIN mot m
            WHERE d.id_mot = m.id_mot
            AND d.id_document = (SELECT id_document FROM document WHERE url_document = '$fichier')
                ORDER BY poids DESC
                LIMIT 20";*/

        /*$sql = "SELECT m.mot, d.poids FROM document_mot dm
            INNER JOIN mot m ON dm.id_mot = m.id_mot
            INNER JOIN document d ON dm.id_document = d.id_document
            ORDER BY poids DESC
            LIMIT 20";*/

        if ($result_query = mysqli_query($connection, $sql)) {
            if ($result_query->num_rows > 0) {
                $index = 0;
                while ($row = $result_query->fetch_assoc()){
                    //$result[$index++] = $row;
                    //$result[$index++] = "'$row[mot]' => '$row[poids]'";
                    //array_push($result, $row);
                    $result[$row['mot']] = $row['poids'];
                    
                }
                array_push($result_mot_poids, $result);
            }
            //echo "Success select mot poids ";
        } else {
            //echo "Failed select mot poids ";
        }
    }
?>