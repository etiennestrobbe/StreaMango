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
                $_SESSION["login"] = $login;
                echo 'true';
            }
            else{
                echo 'false';
            }
        }

    }

    public function deconnect(){
        $_SESSION["connected"] = "false";
        $_SESSION["login"] = null;
    }

    public function signup(){
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $pass = $_POST["pass"];
        $anne = date("Y");

        $new_user = new Data_User($surname,$name,$anne,$pass);

        echo (Nf_UserDvdManagement::getInstance()->addUser($new_user))?'true':'false';

    }

    public function show($params) {
        if($params["id"] != 0) {
            $user = Nf_UserDvdManagement::getInstance()->idToUser($params["id"]);
            $user->commentaires = Nf_CommNoteManagement::getInstance()->getCommentairesParUser($user);
            $user->notes = Nf_CommNoteManagement::getInstance()->getNotesParUser($user);
            $user->amis = Nf_FriendManagement::getInstance()->getAmis($user, "ACCEPTE");
        }
        else {
            $user = null;
        }
        $viewparams["user"] = $user;
        $view = new Profile_Users_View($viewparams);
        $view->display("", "Users");
    }

    public function add_friend(){
        echo $friendN = $_GET["friendN"];
        echo $friendS = $_GET["friendS"];
        echo $userN = $_GET["userN"];
        echo $userS = $_GET["userS"];
        $users = Nf_UserDvdManagement::getInstance();
        echo "the user :". $the_user = $users->getUser($userN,$userS);
        echo "the friend :".$the_friend = $users->getUser($friendN,$friendS);
        $friend_manag = Nf_FriendManagement::getInstance();
        echo "send : ".$friend_manag->sendInvitationAmi($the_user,$the_friend)."\n";
        echo "accept : ".$friend_manag->acceptInvitationAmi($the_friend,$the_user);
        header('Location:index.php?controller=Users&action=show&id='.Nf_UserDvdManagement::getInstance()->userToId($the_user));
    }

} 