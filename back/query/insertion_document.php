<?php
    require 'sql_connect.php';

    /**
     * Insert les résultats si ils ne sont pas déjà dans la BDD.
     * Plus précisement :
     * 
     * INSERT DANS la table document 
     * la SELECTION de donnée $result_head etc... ($result_head qui est le résultat de la fonction get_head() du fichier indexation_head.php)
     * SI IL N'EXISTE PAS
     * la SELECTION url_document, titre_document, description_document DE la table document
     * OÙ url vaut $result_head[0] et que titre vaut $result_head[1] et que description vaut $result_head[2]
     */ 
    $sql = "INSERT INTO document(url_document, titre_document, description_document)
            SELECT '$result_head_data[0]', '$result_head_data[1]', '$result_head_data[2]'
            WHERE NOT EXISTS (
                SELECT url_document, titre_document, description_document FROM document
                WHERE url_document = '$result_head_data[0]' AND titre_document = '$result_head_data[1]' AND description_document = '$result_head_data[2]'
            )";

    if (mysqli_query($connection, $sql)) {
        echo 'Success insert';
    } else {
        echo 'Failed insert';
    }

    $sql = "SELECT id_document FROM document WHERE url_document = '' AND titre_document = '' AND description_document = ''";

    if ($result_id_to_delete = mysqli_query($connection, $sql)) {
        $result_id_to_delete->fetch_assoc();
        echo 'Success select id to delete ';
    } else {
        echo 'Failed select id to delete';
    }

    $sql = "DELETE FROM document WHERE url_document = '' AND titre_document = '' AND description_document = ''";

    if (mysqli_query($connection, $sql)) {
        echo 'Success delete';
    } else {
        echo 'Failed delete';
    }

    $sql = "ALTER TABLE document AUTO_INCREMENT = 1";

    if (mysqli_query($connection, $sql)) {
        echo 'Success auto increment';
    } else {
        echo 'Failed auto increment';
    }

    $connection->close();
?>