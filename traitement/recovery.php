<?php
include ("../autoloader.php");
session_start();

// Si on souhaite un changement de mot de passe
if(isset($_POST['pseudo'])){
    $pseudo = $_POST['pseudo'];

    // On récupèrer l'utlisateur
    $user = new User();
    $user->fillUserByPseudo($_POST['pseudo']);

    // On verifie que la requête a fonctionnée
    if($user->getApiReturn()->isSucess()){
        // On vérifie que l'utilisateur existe bien
        if(!is_null($user->getPseudo())){
            //On change le mot de passe
            $newPassword = $user->resetPassword();
            if($newPassword->isSucess()){
                $newPassword = $newPassword->getJsonList()[0]['message'];
                sendMail($user->getMail(), "Récupération de mot de passe", "Bonjour", "voici votre nouveau mot de passe : " . $newPassword);
                $_SESSION['status'] = 'success';
                $_SESSION['info'] = "Un mail avec un nouveau mot de passe vous a été envoyer a l'adresse mail suivante : " . $user->getMail();
                header("Location: ../index.php");
            }else{
                $_SESSION['status'] = 'danger';
                $_SESSION['info'] = $user->getApiReturn()->getMessage();
                header("Location: ../index.php");
            }
        // Si l'utilisateur n'existe pas
        }else{
            $_SESSION['status'] = 'warning';
            $_SESSION['info'] = "Le compte ". $pseudo . " n'existe pas";
            header("Location: ../index.php");
        }
    // Si la requète n'a pas fonctionnée
    }else{
        $_SESSION['status'] = 'alert';
        $_SESSION['info'] = $user->getApiReturn()->getMessage();
        header("Location: ../index.php");
    }

}
// Si on souhaite une récupération de pseudo
elseif (isset($_POST['mail'])){
    $mail = $_POST['mail'];

    // On récupère la liste des utilisateurs
    $enti = new Entities();
    $result = $enti->getUserByMail("favier.alexis.96@gmail.com");

    // On verifie que la requête a fonctionnée
    if($result->isSucess()){
        if(empty($result->getJsonList())){
            $_SESSION['status'] = 'warning';
            $_SESSION['info'] = "Il n'y a aucun utilisateur utlisant l'adresse mail ". $pseudo;
            header("Location: ../index.php");
        }else{
            $pseudoList =  "";
            foreach ($result->getJsonList() as $json){
                $pseudoList .= $json['pseudo'] . ", ";
            }
            $pseudoList = substr($pseudoList, 0, -2);
            sendMail($mail, "Récupération de pseudo", "Bonjour", "voici la liste des pseudo liée a votre adresse mail : " . $pseudoList);
            $_SESSION['status'] = 'success';
            $_SESSION['info'] = "Un mail avec la liste de vos pseudo vous a été envoyer a l'adresse mail suivante : " . $mail;
            header("Location: ../index.php");

        }
    // Si la requète n'a pas fonctionnée
    }else{
        $_SESSION['status'] = 'alert';
        $_SESSION['info'] = $user->getApiReturn()->getMessage();
        header("Location: ../index.php");
    }

}


function sendMail($mail, $objet, $titre, $corps){
    /** On récupère les information du fichier de config */
    $config = file_get_contents('../config.xml');
    $config = new SimpleXMLElement($config);

    $myMail = $config->adresseMail;

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }
    //=====Déclaration des messages au format texte et au format HTML.
    $message_txt = $titre . $passage_ligne . $corps ;
    $message_html = "<html><head></head><body><b>$titre</b>, $corps</body></html>";
    //==========

    //=====Création de la boundary
    $boundary = "-----=".md5(rand());
    //==========

    //=====Définition du sujet.
    $sujet = $objet;
    //=========

    //=====Création du header de l'e-mail.
    $header = "From: \"WeaponsB\"".$myMail.$passage_ligne;
    $header.= "Reply-to: \"WeaponsB\"".$myMail.$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //==========

    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary.$passage_ligne;
    //=====Ajout du message au format HTML
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    //==========
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
    //==========

    //=====Envoi de l'e-mail.
    mail($mail,$sujet,$message,$header);
    //==========
}