<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<title>Indexation</title>
</head>
	<body>
		<?php
			header('Content-Type: text/html; charset=UTF-8');

			echo '<p><b>DÉBUT DU PROCESSUS :</b><br>';
			echo " ", date ("h:i:s") . '</p>';

			require 'fonctions.inc.php';
			require 'indexation_head.php';
			require 'indexation_body.php';
			require 'rechercherFichier.php';

			$path= "../docs/";
			$tab = array();
			$index = 0;
			$all_files = explorerDir($path, $tab, $index);

			foreach ($all_files[0] as $cle_file => $valeur_file) {
				//echo $valeur_file . ' ';
				echo '<pre>';
					print_r($all_files);
					echo '</pre>';
				start_indexation($valeur_file);
			}

			echo '<p><b>FIN DU PROCESSUS :</b><br>';
			echo " ", date ("h:i:s") . '</p>';

			function start_indexation ($valeur_file) {
				
				//$fichier = "docs/test.html";
				$fichier = $valeur_file;
	
				// $fichier, $titre, $description
				$result_head_data = get_head($fichier, true);
				$result_head_word = get_head($fichier, false);
				$result_body = get_body($fichier);
				
				require '../query/insertion_document.php';
				
				// metadata filtré + body filtré
				$result_all_word = array_merge($result_head_word[0], $result_body[0]);
	
				require '../query/insertion_mot.php';
	
				$result_body_poids = occurence_poids($result_body[0], $result_body[1], $result_head_word[0]);
	
				$result_head_poids = occurence_poids($result_head_word[0], $result_head_word[1], $result_head_word[0]);
	
				$result_all_occurence = array_merge($result_head_poids, $result_body_poids);
	
				require '../query/insertion_document_mot.php';
			}

		?>
	</body>
</html>