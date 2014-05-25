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
                $_SESSION['user'] = serialize($user); 
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

    public function signup(){
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $pass = $_POST["pass"];
        $anne = date("Y");

        $new_user = new Data_User($surname,$name,$anne,$pass);

        echo (Nf_UserDvdManagement::getInstance()->addUser($new_user))?'true':'false';

    }

} 