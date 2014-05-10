<?php
	class Show_Films_View extends Main_Global_View {

		private $film;
		
		public function Show_Films_View($viewparams) {
			$filmscss = array("film.css");
			$this->setCSS($filmscss);
			
			$this->film = $viewparams["film"];
		}
		
		public function mainContent() {
			ob_start();
			// TODO (Marc)
			$content = ob_get_contents();
			ob_end_clean();
			
			return $content;	
		}
	}
?>