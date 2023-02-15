<?php
session_id('rpl2');
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
}

include '../database.php';
include 'layout.php';

$id_user = $_SESSION['id_user'];
if (isset($_POST["submit"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        // print_r($_POST);
        $id_resep = $db->escape_string($_POST['id_resep']);
        $isi = $db->escape_string($_POST['isi']);
        $sql = "INSERT INTO ulasan(isi,tanggal,id_user,id_resep) 
                VALUES('$isi',NOW(),$id_user,'$id_resep')";

        $res = $db->query($sql);
        if ($res) {
            if ($db->affected_rows > 0) {
                header("Location: detail-resep.php?id_resep=$id_resep&sukses=ulasan");
            }
        } else {
            echo $db->error;
        }
    }

}

?>