<?php
session_id('rpl2');
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
}

include '../database.php';
include 'layout.php';
$db = dbConnect();

$id_user = $db->escape_string($_POST['id_user']);
$id_resep = $db->escape_string($_POST['id_resep']);

// Cek favorit
$sqlcek = "SELECT * FROM resep_favorit WHERE id_user = '$id_user' AND id_resep = '$id_resep'";
$rescek = $db->query($sqlcek);
if ($rescek) {
    if ($rescek->num_rows > 0) {
        header("Location: detail-resep.php?id_resep=$id_resep&error=adaresep");
    } else {
        $sql = "INSERT INTO resep_favorit VALUES('?','$id_user', '$id_resep')";
        $res = $db->query($sql);
        if ($res) {
            if ($db->affected_rows > 0) {
                header("Location: detail-resep.php?id_resep=$id_resep&sukses=simpan");
            }
        } else {
            echo $db->error;
        }
    }
}
?>