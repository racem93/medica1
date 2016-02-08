<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/temp'));
session_start();
if(!isset($_SESSION['admin']))
{
    header("location:login.html");
}

?>
<?php
$id=$_GET['id'];
include_once("config/MyPDO.class.php");
$connect=new MyPDO();
$connect->query("SET NAMES 'utf8'");
$req1 = "DELETE FROM lit WHERE id=".$id;
$oPDOStatement=$connect->query($req1);
?>

<script language="javascript">
    self.parent.location.href="gestion_lit.php?msg=supprimer";

</script>
