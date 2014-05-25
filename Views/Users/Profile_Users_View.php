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
            <p id="note">
                <?php
                    echo $note->film;
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
            </p><br/>
            <?php
                }
            ?>
    </section>

    <section classe="one">
        <h2>Commentaires :</h2>
    </section>

<?php
            }
            $content = ob_get_contents();
            ob_end_clean();
            
            return $content;    
        }
    }
?>