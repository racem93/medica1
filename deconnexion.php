<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));

session_start();
session_unset();
session_destroy();
header("location:login.html");
exit();

?>