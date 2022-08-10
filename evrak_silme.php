<?php
if (isset($_GET['sil'])) {
    $sqlsil="DELETE FROM evrak WHERE evrak.evrak_id=?";
    $sorgu=$db->prepare($sqlsil);
    $sorgu->execute([$_GET['sil']]);

    header('Location:index.php');
}
?>
