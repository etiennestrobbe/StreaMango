<?php
class Add_Star_View extends Main_Global_View {

    public function Add_Star_View($viewparams) {
        echo("maman²");
        $filmscss = array("films.css");
        $this->setCSS($filmscss);
    }

    public function mainContent() {
        ob_start();
        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
?>