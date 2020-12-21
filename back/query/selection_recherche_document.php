<?php
    require 'sql_connect.php';

    $sql = "SELECT d.url_document, d.titre_document, d.description_document FROM document_mot dm
            INNER JOIN document d ON dm.id_document = d.id_document
            INNER JOIN mot m ON dm.id_mot = m.id_mot
            WHERE m.id_mot = (SELECT id_mot FROM mot WHERE mot = '$recherche')
            ORDER BY dm.poids DESC";

    if ($result_query = mysqli_query($connection, $sql)) {
        if ($result_query->num_rows > 0) {
            $index = 0;
            $html = '<div>';
            while ($row = $result_query->fetch_assoc()){
                $lien = $row['url_document'];
                $lien = "back".substr($lien, 2, strlen($lien));

                $html .= '<div class="d-flex flex-row my-3">';
                $html .= '<div class="col-8">' . $lien .
                    '<a href="'. $lien . '"><h3>' . $row['titre_document'].
                    '</h3></a><p>' . $row['description_document'] .
                    '</p></div>';
                
                $html .= '<div class="tagCloud col">' . genererNuage($result_mot_poids[$lien]) . '</div></div>';
            }
            
            $html .= '</div>';
            echo $html;

            //echo "Success select recherche document ";
        }
    } else {
        echo "Failed select recherche document ";
    }


?>