<?php
	class Films_Controller {
			
		public function listAll($params) {
			$limit = 0;
			if(isset($params["limit"])) {
				$limit = (int) $params["limit"];
			}
		
			$films = Nf_FilmManagement::getInstance()->getFilms();
			
			function filmCmp($film1, $film2) {
				return strcmp($film1->getTitre(), $film2->getTitre());
			}
			
			uasort($films, 'filmCmp');
			
			foreach($films as $key => $film) {
				$films[$key]->affiches = Nf_FilmManagement::getInstance()->getAffiches($film);
			}

			$viewparams["films"] = $films;
			
			$view = new ListAll_Films_View($viewparams);
			$view->display("index.php?controller=Films&action=add",1);
		}

		public function show($params) {
			$film = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
			$film->affiches = Nf_FilmManagement::getInstance()->getAffiches($film);
			$film->commentaires = Nf_CommNoteManagement::getInstance()->getCommentairesParFilm($film);

			$viewparams["film"] = $film;

			$view = new Show_Films_View($viewparams);
			$view->display("");
		}
		
		public function edit($params) {
			$film = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
			$view = new Edit_Films_View($film);
			$view->display("");
		}
		
		public function delete($params) {
			$film = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
			$film = Nf_FilmManagement::getInstance()->removeFilm($film);
			
			header('Location:index.php');
		}
			
		public function validateEdit($params) {
			$titre = $_POST['title'];
			$annee = $_POST['year'];
			$style = $_POST['style'];
			$lang = $_POST['lang'];
			$desc = $_POST['desc'];
			$rea = $_POST['real'];
			$roles;
			$actors;

			$old = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
			$new = new Data_Film();
			$new->setTitre($titre);
			$new->setAnnee($annee);
			$new->setStyle($style);
			$new->setLangue($lang);
			$new->setResume($desc);
			
			$realisateur = new Data_Realisateur();
			
			//$realisateur = $rea;
			$new->setRealisateur($realisateur);
			
			// Requete de mise à jour
			Nf_FilmManagement::getInstance()->updateFilm($old, $new);
			
			 header('Location:index.php');
		}
			
		public function add($params) {
			// On récupère la liste des réalisateurs
			$people = Nf_ActeurReaManagement::getInstance()->getRealisateurs();
	 
			// On les tri
			function peopleCmp($p1, $p2) {
				return strcmp($p1->getNom(), $p2->getNom());
			}
			uasort($people,'peopleCmp');

			// On les envoi à la Add_Film_View
			$viewparams["directors"] = $people;
			$view = new Add_Films_View($viewparams);
			$view->display();
		}
		
		public function validateAdd($params) {
			$titre = $_POST['title'];
			$annee = $_POST['year'];
			$style = $_POST['style'];
			$lang = $_POST['lang'];
			$desc = $_POST['desc'];
			$rea = $_POST['real'];

			$people = Nf_ActeurReaManagement::getInstance()->idToPeople($rea);		
			$realisateur = new Data_Realisateur($people);
			
			$new = new Data_Film();
			$new->setTitre($titre);
			$new->setAnnee($annee);
			$new->setStyle($style);
			$new->setLangue($lang);
			$new->setResume($desc);
			$new->setRealisateur($realisateur);

			$film = Nf_FilmManagement::getInstance()->addFilmComplet($new);
			
			header('Location:index.php');
		}
	}
?>