<?php
/**
 * Created by IntelliJ IDEA.
 * User: Etienne Strobbe
 * Date: 5/21/14
 * Time: 7:42 PM
 */

class Users_Controller {

    public function connect(){
        $login = $_POST['login'];
        $pass = $_POST['pass'];

        $users = Nf_UserDvdManagement::getInstance()->getUsers($login);
        foreach($users as $user){
            if($user->getMdp() == $pass){
                $_SESSION["connected"] = "true";
                echo 'true';
            }
            else{
                echo 'false';
            }
        }

    }

    public function deconnect(){
        $_SESSION["connected"] = "false";
    }

} 