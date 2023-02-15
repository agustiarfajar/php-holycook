<?php
session_id('rpl2');
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
}
include '../database.php';
$db = dbConnect();


if ($db->connect_errno == 0) {
    $id_favorit = $db->escape_string($_GET["id_favorit"]);
    var_dump($id_favorit);
    $sql = "DELETE FROM resep_favorit WHERE id_favorit='$id_favorit'";
    $res = $db->query($sql);
    if ($res) {
        if ($db->affected_rows > 0) {
            header("Location: resep-tersimpan.php?sukses=hapus");
        }
    }
}

?>