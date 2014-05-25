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

<article class="one">
	<article class="msg">
		Connectez-vous !
	</article>
</article>

<?php
    } else {
?>

<article class="one">
    <header>
        <?php echo $this->user->getPrenom();?> <?php echo $this->user->getNom(); ?>
    </header>
                <?php
                if(isset($_SESSION["connected"])) {
                    if ($_SESSION["connected"] == "true") {
                        $idSession = unserialize($_SESSION["user"]);
                        if ($idSession->getId() != $this->user->getId()) {

                            ?>
                            <article id="add_friend">
                                <a href="index.php?controller=Users&action=add_friend&friendN=<?php echo $this->user->getNom();?>&friendS=<?php echo $this->user->getPrenom();?>&userN=<?php echo $idSession->getNom();?>&userS=<?php echo $idSession->getPrenom();?>" id="add_friend_button">Ajouter en ami</a>
                            </article>
                        <?php
                        }
                    }
                }
                        ?>

    <section class="one">
        <h2>Amis :</h2>
        <?php
            if(!$this->user->amis) {
                echo "Cet utilisateur n'a aucun ami.";
            }
            foreach ($this->user->amis as $key => $ami) {
                ?>
                <a href="index.php?controller=Users&action=show&id=<?php echo $ami->getAmi()->getId();?>"><?php echo $ami->getAmi()->getPrenom();?> <?php echo $ami->getAmi()->getNom();?></a><br/>
                <?php
            }
        ?>
    </section>

    <section class="one">
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

    <section class="one">
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