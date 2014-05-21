<?php
/**
 * Created by IntelliJ IDEA.
 * User: Etienne Strobbe
 * Date: 5/20/14
 * Time: 7:32 PM
 */

class Edit_Star_View extends Main_Global_View{

    private $star;

    public function Edit_Stars_View($viewparams)
    {
        $this->star = $viewparams["star"];
    }




    public function mainContent()
    {

        ob_start();?>
        <section><?php
        if(!$this->star){
            ?>
            <article>
                <?php echo $this->star ?>
                Cette star n'existe pas !!
            </article></section>
            <?php
        }
        else{
            ?>
            <article class="star">
               <!--TODO formulaire d'édition-->
            </article>
<?php
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

} 