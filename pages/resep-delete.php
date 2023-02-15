<?php
session_id('rpl2');
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
}
include('../database.php');

$db = dbConnect();
$id_resep = $db->escape_string($_POST['id_resep']);

// Cek resep favorit
$sqlfav = "SELECT * FROM resep_favorit WHERE id_resep='$id_resep'";
$resfav = $db->query($sqlfav);
if ($resfav) {
    $fav = $resfav->fetch_assoc();
    if (count($fav) > 0) {
        $sql = "DELETE FROM resep_favorit WHERE id_resep = '$id_resep'";
        $res = $db->query($sql);
    }
}

$sqlulasan = "SELECT * FROM ulasan WHERE id_resep='$id_resep'";
$resulasan = $db->query($sqlulasan);
if ($resulasan) {
    $fav = $resulasan->fetch_assoc();
    if (count($fav) > 0) {
        $sql = "DELETE FROM ulasan WHERE id_resep = '$id_resep'";
        $res = $db->query($sql);
    }
}

$sqlresep = "SELECT * FROM resep WHERE id_resep='$id_resep'";
$resresep = $db->query($sqlresep);
if ($resresep) {
    if ($resresep->num_rows == 1) {
        $dataresep = $resresep->fetch_assoc();
        if ($dataresep['foto'] != null) {
            unlink('../assets/uploads/resep/' . $dataresep['foto']);
        }

        $sql = "DELETE FROM resep WHERE id_resep = '$id_resep'";
        $res = $db->query($sql);
        if ($res) {
            if ($db->affected_rows > 0) {
                header("Location: resep-saya.php?sukses=hapus");
            }
        } else {
            echo $db->error;
        }
    }
}
?>