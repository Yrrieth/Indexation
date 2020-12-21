<?php
	//Augmentation du temps
	//d'exécution de ce script
	set_time_limit (500);

	//dossier/corpus de fichers à lire
	
	function explorerDir($path) {
		$tab = array();
		$folder = opendir($path);
		$index = 0;
		while($entree = readdir($folder)) {
			$modele = "/\.(html|php)$/i";
			if (preg_match($modele, $entree, $result) == 1) {
				//echo $entree, "<br>";
				$tab[$index++] = $path . $entree;
			} else if (is_dir($entree)) {
				//echo "C'est un dossier <br>";
			}
		}
		closedir($folder);
		return $tab;
	}
?>

