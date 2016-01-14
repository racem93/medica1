<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:login.html");
}

?>
<?php require('header.php'); ?>

<?php require('footer.php'); ?>