<?php
    class Profile_Users_View extends Main_Global_View {

        private $user;
        
        public function Profile_Users_View($viewparams) {
            $this->user = $viewparams["user"];
        }
        
        public function mainContent() {
            ob_start();
            if($this->user == null) {
?>

<article>
Connectez-vous !
</article>

<?php
    } else {
?>

<article class="one">
    <header>
        <?php echo $this->user->getPrenom();?> <?php echo $this->user->getNom(); ?>
    </header>

    <section classe="one">
        <h2>Amis :</h2>
    </section>

    <section classe="one">
        <h2>Notes :</h2>
        <?php
            if(!$this->user->notes) {
                echo "Cet utilisateur n'a noté aucun film.";
            }
            foreach ($this->user->notes as $key => $note) {
        ?>
            <p id="note"><b>
                <?php
                    echo $note->film->getTitre();
                    if($note->getNote() >= 9) {
                ?>
                <span><label></label></span>
                <?php
                    }
                    if($note->getNote() >= 7) {
                ?>
                <span><label></label></span>
                <?php
                    }
                    if($note->getNote() >= 5) {
                ?>
                <span><label></label></span>
                <?php
                    }
                    if($note->getNote() >= 3) {
                ?>
                <span><label></label></span>
                <?php
                    }
                    if($note->getNote() >= 1) {
                ?>
                <span><label></label></span>
                <?php
                    }
                    else {
                ?>
                <span><label id="nul"></label></span>
                <?php
                    }
                ?>
            </b></p><br/>
            <?php
                }
            ?>
    </section>

    <section classe="one">
        <h2>Commentaires :</h2>
        <?php
            if(!$this->user->commentaires) {
                echo "Cet utilisateur n'a noté aucun film.";
            }
            foreach ($this->user->commentaires as $key => $commentaire) {
                ?>
                <p><b>
                <?php
                echo $commentaire->getFilm()->getTitre();
                ?>
                </b> : 
                <?php
                echo $commentaire->getCommentaire();
                ?>
                </p>
                <?php
            }
        ?>
    </section>

<?php
            }
            $content = ob_get_contents();
            ob_end_clean();
            
            return $content;    
        }
    }
?>