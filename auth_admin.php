<?php
//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));

session_start();
//On pr�pare l'utilisation des variables de fonctions (variable qui sont stock�es sur le serveur pour chaque session ouverte)
//session_start();
// Fichier auth.php
include_once("config/MyPDO.class.php");
$connect=new MyPDO();

// On int�gre les informations de connexion � la base de donn�es ainsi que le fichier (ou librairie fonctions.php)

// On r�cup�re ce que l'utilisateur � saisi, si il n'a rien saisi (login ou mot de passe) on le renvoi sur la page de cr�ation de compte

//$pass=md5($pass);
$AfficherFormulaire = TRUE;

if(!empty($_POST['pseudo']) AND !empty($_POST['MotDePasse'])) {
    $req = $connect->prepare('SELECT COUNT(*) FROM users WHERE password = :MotDePasse AND login = :pseudo');
    $req->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $req->bindValue(':MotDePasse', $_POST['MotDePasse'], PDO::PARAM_STR);
    $req->execute();
    $resultat = $req->fetch();
    $req->closeCursor();
    if($resultat[0] == 0) {
        header("location: login.html");
    } else {


        $_SESSION['pseudo']=$_POST['pseudo'];
        $_SESSION['password']=$_POST['MotDePasse'];
        $_SESSION['admin']="auth_ok";
        header("location: acceuil.php");
        $AfficherFormulaire = FALSE;
    }
}else{
    header("location: login.html");

}

    ?>