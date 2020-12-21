<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta charset="utf-8">
		<title>Indexation</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<style type="text/css">
            .tagCloud {
                width: 300px;
                background:#CFE3FF;
                color:#0066FF;
                padding: 10px;
                border: 1px solid #559DFF;
                text-align:center;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
                border-radius: 4px;
            }

        </style>
	</head>

	<body>
		<div id="sticky-header" class="container-fluid p-0 sticky-top">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-1" style="justify-content: flex-end;box-shadow: 0px 0px 10px;">
				<form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<input class="form-control mx-1 py-0" type="search" placeholder="Rechercher" aria-label="Search" name="recherche">
					<button class="btn btn-outline-success mx-1 py-0" type="submit">Rechercher</button>
				</form>
				<a href="back/tools/start_indexation.php" class="nav-link btn btn-success mx-1 py-0" role="button">Indexer</a>
			</nav>
		</div>

		<div id="wrapper">
			<div id="header" class="container-fluid mb-0 p-0">
				<!--<a href="index.html"><img src="image/logo.png" alt="Logo du site" title="Logo du site Zoolemag"></a>-->
			</div>
		
		

			<div id="navbar" class="container-fluid p-0">
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark m-0" style="justify-content: space-around;">
					<a href="index.php" class="nav-link">Accueil</a>
				</nav>
			</div>

			<div id="content" class="container d-flex flex-column">
				<?php
					
					if (isset($_POST['recherche'])) {
						// Dans le cas où on appuie sur le bouton "rechercher" après avoir déjà rempli le formulaire de recherche
						if ($_POST['recherche'] == '') {
							unset($_POST['recherche']);
							echo "Veuillez remplir la barre de recherche.";
						} else {
							echo '<div>Vous recherchez : ' . htmlspecialchars(html_entity_decode($_POST['recherche'])) . '</div>';
							$recherche = $_POST['recherche'];

							require 'back/tools/rechercherFichier.php';
							$path = "back/docs/";
							$all_files = explorerDir($path);
							require 'back/query/selection_mot_poids.php';
							require 'back/tools/generation_nuage_mot.php';

							/*echo '<pre>';
							print_r($result_mot_poids);
							echo '</pre>';

							echo '<pre>';
							print_r(array_keys($result_mot_poids));
							echo '</pre>';

							foreach($result_mot_poids as $valeur_mot_poids) {
								echo '<div class="tagCloud">';
								echo genererNuage($valeur_mot_poids);
								echo '</div>';
							}*/

							require 'back/query/selection_recherche_document.php';
						}
						
					} else {
						echo "Veuillez remplir la barre de recherche.";
					}
					if (isset($_GET['q'])) {
						echo 'Vous recherchez : ' . htmlspecialchars(html_entity_decode($_GET['q']));
						$recherche = $_GET['q'];
						require 'back/query/selection_recherche_document.php';
					}
				?>
			</div>

			<div id="footer" class="container-fluid p-0 mt-auto"></div>
		</div>
		
	</body>
 </html>