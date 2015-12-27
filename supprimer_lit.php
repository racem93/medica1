<?php
$id=$_GET['id'];
include_once("MyPDO.class.php");
$connect=new MyPDO();
$req1 = "DELETE FROM lit WHERE id=".$id;
$oPDOStatement=$connect->query($req1);
?>

<script language="javascript">
    self.parent.location.href="gestion_lit.php";
</script>
