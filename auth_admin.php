<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));

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
    $req = $connect->prepare('SELECT COUNT(*),TYPE FROM users WHERE password = :MotDePasse AND login = :pseudo');
    $req->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
    $req->bindValue(':MotDePasse', $_POST['MotDePasse'], PDO::PARAM_STR);
    $req->execute();
    $resultat = $req->fetch();
    $req->closeCursor();




    if($resultat[0] == 0 ) {

        echo "<SCRIPT LANGUAGE='JavaScript'>
    alert('login ou mot de passe incorrect');
    self.parent.location.href='login.html';
    </SCRIPT> ";
    }

    if (($resultat[0] != 0) && ($resultat[1] == 0)  ) {


        $_SESSION['pseudo']=$_POST['pseudo'];
        $_SESSION['password']=$_POST['MotDePasse'];
        $_SESSION['admin']="auth_ok";
        $_SESSION['superadmin']="auth_ok";

        header("location: acceuil.php");
        $AfficherFormulaire = FALSE;
    } elseif (($resultat[0] != 0) && ($resultat[1] == 1)){

        $_SESSION['pseudo']=$_POST['pseudo'];
        $_SESSION['password']=$_POST['MotDePasse'];
        $_SESSION['admin']="auth_ok";
        $_SESSION['user1']="auth_ok";

        header("location: acceuil.php");
        $AfficherFormulaire = FALSE;
    }


}else{
    echo "<SCRIPT LANGUAGE='JavaScript'>
    alert('le mot de passe ou login est incorrect');
    </SCRIPT> ";
    header("location: login.html");

}

    ?>