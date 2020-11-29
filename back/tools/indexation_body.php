<?php
    // Extraction de la partie body

    function get_body($fichier) {
        $texte_file_html = file_get_contents("$fichier");
        $texte_file_html = mb_convert_encoding($texte_file_html, 'HTML-ENTITIES', "UTF-8");

        $modele = "/<body[^>]*>(.*?)<\/body>/si";

        $texte_file_html = strip_scripts($texte_file_html);

        preg_match($modele, $texte_file_html, $tab_resultats);

        // La chaine HTML body
        $texte_html_body = $tab_resultats[0];

        // Suppresion du formatage HTML
        $texte_body = strip_tags($texte_html_body);

        $resultat = indexation_texte($texte_body);
        return $resultat;
    }
    

?>