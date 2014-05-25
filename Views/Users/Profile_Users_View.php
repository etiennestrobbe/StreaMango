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
        <?php echo $this->user->getPrenom(); echo $this->user->getNom(); ?>
    </header>
    
    <aside>
    </aside>
    
    <section>
    </section>

<?php
            }
            $content = ob_get_contents();
            ob_end_clean();
            
            return $content;    
        }
    }
?>