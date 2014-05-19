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
				$view->display();
			}
			
			public function edit($params) {
				$film = Nf_FilmManagement::getInstance()->idToFilm($params["id"]);
				//$viewparams["films"] = $film;
				$view = new Edit_Films_View($film);
				$view->display();
			}
			
			public function add($params) {
				$view = new Add_Films_View($params);
				$view->display();
			}
	}
?>