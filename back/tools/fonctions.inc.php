<?php
	function difference_array($tab_mots, $tab_anti_dictionnaire) {
		$tab_filtre = array();
		$bool = false;
		foreach ($tab_mots as $cle => $mot) {
			foreach ($tab_anti_dictionnaire as $cle_anti => $mot_anti) {
				if (strcmp($mot, $mot_anti) == 0) {
					$bool = true;
				}
			}
			if ($bool == false) {
				array_push($tab_filtre, $mot);
			}
			$bool = false;
		}		
		return $tab_filtre;
	}

	function explode_bis($separateurs, $texte) {

		$tok = strtok($texte, $separateurs);
		if (is_string($tok) && strlen($tok) > 2)
			$tab_mots[] = $tok;

		while ($tok !== false) {
			$tok = strtok($separateurs);
			if (is_string($tok) && strlen($tok) > 2)
				$tab_mots[] = $tok;
		}
		return $tab_mots;
	}

	function print_tab($tab_mots) {
		foreach ($tab_mots as $indice => $mot) {
			echo $indice . " = " . $mot . "<br>";
		}		
	}

	function print_array($tab) {
		echo '<pre>';
		print_r($tab);
		echo '</pre>';
	}

	// Enlève les balises script au sein du body
	function strip_scripts($chaine_html) {
		$modele = "/<script[^>](.*?)<\/script>/si";
		$chaine_html = preg_replace($modele, "", $chaine_html);

		return $chaine_html;
	}

	function indexation_texte($texte) {
		$separateurs=" ,?.:/!'\n\r\t\0«»+=/*\\\"|[]{}()#~•%";

		$tab_mots = explode_bis($separateurs, strtolower($texte));

		$anti_dictionnaire = file_get_contents("../data/anti_dictionnaire.txt");
		$tab_anti_dictionnaire = explode_bis($separateurs, $anti_dictionnaire);

		foreach ($tab_anti_dictionnaire as $indice => $mot) {
			$tab_anti_dictionnaire[$indice] = htmlentities($mot);
		}

		// Crée un tableau avec pour clé le mot et comme valeur le nombre d'occurence
		$tab_mots_occurences = array_count_values($tab_mots);

		// Crée un tableau avec comme valeur les clés du tableau précédent
		$tab_mots_cles = array_keys($tab_mots_occurences);
		
		/** 
		 * Crée un tableau où les éléments du $tab_anti_dictionnaire sont enlevés de $tab_mots_occurences
		 * L'index reste le même
		 */
		$tab_filtre = array_diff($tab_mots_cles, $tab_anti_dictionnaire);

		// On enlève les index vides
		$tab_filtre = array_values($tab_filtre);
		//print_tab($tab_filtre);

		return array($tab_filtre, $tab_mots_occurences);
	}

	function occurence_poids ($tab_filtre, $tab_mots_occurences, $tab_head_word) {
		$tab = array();
		// Ici, $tab_mots_occurences n'est pas encore filtré
		foreach($tab_mots_occurences as $cle_occurence => $valeur_occurence) {
			foreach($tab_filtre as $cle_filtre => $valeur_filtre) {
				// Ex: internet => 6             1 => internet
				if (strcmp($cle_occurence, $valeur_filtre) == 0) {
					$tab[$cle_occurence] = $valeur_occurence;
					foreach($tab_head_word as $cle_head_word => $valeur_head_word) {
						// Comparaison des occurences de tous les mots et des metadatas
						// et multiplication du poids de l'occurence
						if (strcmp($cle_occurence, $valeur_head_word) == 0) {
							$tab[$cle_occurence] = ceil($tab[$cle_occurence] * 1.5);
						}
					}
				}
			}
		}
		return $tab;
	}
?>