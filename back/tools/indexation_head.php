<?php
	function get_meta_keywords ($fichier) {
		$tab_associatif_metas = get_meta_tags($fichier);
		return 	$tab_associatif_metas["keywords"];
	}

	function get_meta_description ($fichier) {
		$tab_associatif_metas = get_meta_tags($fichier);
		return 	$tab_associatif_metas["description"];
	}

	function get_title ($fichier) {
		$chaine_html = file_get_contents($fichier);
		$modele = "/<title>(.*)<\/title>/si";
		preg_match($modele, $chaine_html, $tab_resultat);
		return $tab_resultat[1];	
	}

	function get_head($fichier, $bool) {
		$titre = get_title($fichier);
		$description = get_meta_description($fichier);
		$keywords = get_meta_keywords($fichier);
		
		if (is_null($description)) {
			$description = $titre;
		}

		if (is_null($keywords)) {
			$keywords = $titre;
		}

		$texte_head = $titre . " " . $description . " " . $keywords;
		$texte_head = mb_convert_encoding($texte_head, 'HTML-ENTITIES', "UTF-8");

		$resultat = indexation_texte($texte_head);

		if ($bool == true) {
			return array($fichier, $titre, $description);
		} else {
			return $resultat;
		}
	}
?>