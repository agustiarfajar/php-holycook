<?php
session_id('rpl2');
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
}
include('../database.php');

$db = dbConnect();
// var_dump($_POST);
// Validasi
$pesansalah = "";
$v_judul = trim($_POST["judul"]);
$v_kategori = trim($_POST["kategori"]);
$v_porsi = trim($_POST["porsi"]);
$v_lama_masak = trim($_POST["lama_masak"]);
$v_deskripsi = trim($_POST["deskripsi"]);
$v_langkah = trim($_POST["langkah"]);

if (strlen($v_judul) == 0) {
    $pesansalah .= "Judul tidak boleh kosong.<br>";
}
if (strlen($v_kategori) == 0) {
    $pesansalah .= "Kategori tidak boleh kosong.<br>";
}
if (strlen($v_porsi) == 0) {
    $pesansalah .= "Porsi tidak boleh kosong.<br>";
}
if (strlen($v_lama_masak) == 0) {
    $pesansalah .= "Lama Masak tidak boleh kosong.<br>";
}
if (strlen($v_deskripsi) == 0) {
    $pesansalah .= "Deskripsi tidak boleh kosong.<br>";
}
if (strlen($v_langkah) == 0) {
    $pesansalah .= "Langkah tidak boleh kosong.<br>";
}


$judul = $db->escape_string($_POST['judul']);
$kategori = $db->escape_string($_POST['kategori']);
$porsi = $db->escape_string($_POST['porsi']);
$lama_masak = $db->escape_string($_POST['lama_masak']);
$deskripsi = $db->escape_string($_POST['deskripsi']);
$bahan = $_POST['bahan'];
$bahan_str = implode(" , ", $bahan);
$langkah = $db->escape_string($_POST['langkah']);
$gizi = $db->escape_string($_POST['gizi']);
$tanggal = date('Y-m-d');
$id_user = $_SESSION['id_user'];

// GAMBAR
if ($_FILES['foto']['size'] != 0) {
    $target_dir = "../assets/uploads/resep/";
    $fileName = time() . basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        // echo "Sorry, only JPG, JPEG are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if ($pesansalah == "") {
            // CEK KESAMAAN JUDUL
            $resep = "SELECT * FROM resep where judul='$judul'";
            $res = $db->query($resep);
            if ($res) {
                if ($res->num_rows > 0) {
                    header('Location: form-tambah-resep.php?error=judul');
                } else {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                        // END GAMBAR
                        $sql = "INSERT INTO resep VALUES('?','$judul', '$kategori', '$porsi', '$lama_masak', '$deskripsi', '$bahan_str', '$langkah', '$gizi', '$fileName', '$tanggal', '$id_user')";
                        $res = $db->query($sql);
                        if ($res) {
                            header('Location: resep-saya.php?sukses=tambah');
                        } else {
                            echo $db->error;
                        }

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                $db->error;
            }

        } else {
            $_SESSION["errorinput"] = $pesansalah;
            header('Location: form-tambah-resep.php?error=input');
        }
    }
} else {
    header('Location: form-tambah-resep.php?error=foto');
}

?>