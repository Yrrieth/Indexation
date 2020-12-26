<?php
	//Augmentation du temps
	//d'exécution de ce script
	set_time_limit (500);

	//dossier/corpus de fichers à lire
	
	function explorerDir($path, $tab, $index) {
		//$tab = array();
		$folder = opendir($path);
		//$index = 0;
		while($entree = readdir($folder)) {
			//echo $path . $entree . '<br>';
			$modele = "/\.(html|php)$/i";
			// Si c'est un fichier html ou php
			if (preg_match($modele, $entree, $result) == 1) {
				//echo $entree, "<br>";
				$tab[$index++] = $path . $entree;
			}
			else // Si c'est un dossier
			if (is_dir($path . $entree) && preg_match("/_files/i" ,$path . $entree, $result) == 0 && $entree != "." && $entree != "..") {
				//echo "C'est un dossier : " . $entree . " <br>";
				//$path = $path . $entree . '/';
				$tab_tmp = array();
				$tab_res = explorerDir($path . $entree . '/', $tab_tmp, $index);
				/*echo '<pre>';
				print_r($tab_res);
				echo '</pre>';*/
				$index = $tab_res[1];
				$tab = array_merge($tab, $tab_res[0]);
				/*echo '<pre>';
				print_r($tab);
				echo '</pre>';*/
			}
		}
		closedir($folder);
		return array($tab, $index);
	}
?>

