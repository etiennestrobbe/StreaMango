<?php

	abstract class Main_Global_View {
		
		/**
		* Tableau contenant les fichiers CSS à inclure.
		*
		* @var array
		*/
		protected $css = array();
		
		/**
		* Tableau contenant les fichiers JS à inclure.
		*
		* @var array
		*/
		protected $js = array();
		
		/**
		* Met à jour le tableau $css.
		*
		* @param array $css
		* @return void
		*/
		protected function setCSS($css) {
			$this->css = $css;
 		}
		
		/**
		* Met à jour le tableau $js.
		*
		* @param array $js
		* @return void
		*/
		protected function setJS($js) {
			$this->js = $js;
 		}
		
		/**
		* Effectue l'affichage de la vue.
		*
		* @return void
		*/
		public function display($link,$controller,$param = 0) {
			
			$cssGlobal = array("general.css");
			$jsGlobal = array("jquery-2.1.0.min.js", "jquery.sticky.js", "global.js","jquery.bpopup.min.js","jquery-ui-1.10.4.custom.min.js");
			
			$cssTotal = array_merge($cssGlobal, $this->css);
			$jsTotal = array_merge($jsGlobal, $this->js);
			
			
			$header = new Header_Global_View($cssTotal, $jsTotal);
			$ban = new Banniere_Global_View();
			$nav = new Menu_Global_View();
            if($param !=0){
                $search = new Search_Global_View($link,$controller);
            }

			$footer = new Footer_Global_View();
			
			$content = $header->getHeader();
			$content .= $ban->getBanniere();
			$content .= $nav->getMenu($param);
            if($param !=0) {
                $content .= $search->getSearch();
            }
			$content .= $this->mainContent();
			$content .= $footer->getFooter();
			
			echo $content;
		}
		
		/**
		 * Permet d'obtenir le contenu principal de la page.
		 *
		 * @return string
		 */
		abstract protected function mainContent();
		
	}
	
?>