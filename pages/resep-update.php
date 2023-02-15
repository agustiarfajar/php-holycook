<?php
session_id('rpl2');
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
}
include '../database.php';

$db = dbConnect();

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

$id_resep = $db->escape_string($_POST['id_resep']);
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

$sql = "SELECT * FROM resep WHERE id_resep='$id_resep'";
$res = mysqli_query($db, $sql);
$data = $res->fetch_assoc();

$imageUrl = '../assets/uploads/resep/' . $data['foto'];
if ($_FILES['foto']['size'] != 0) {
    unlink($imageUrl);
    // SETUP STORE IMAGE INTO DATABASE
    $target_dir = "../assets/uploads/resep/";
    $fileName = time() . basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // var_dump($imageFileType);
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
        if ($pesansalah == "") {
            $resep = "SELECT * FROM resep where judul='$judul' AND id_resep != '$id_resep'";
            $res = $db->query($resep);
            if ($res) {
                if ($res->num_rows > 0) {
                    header("Location: form-ubah-resep.php?id_resep=$id_resep&error=judul");
                } else {
                    $sql = "UPDATE resep SET judul='$judul', kategori='$kategori', porsi='$porsi', lama_masak='$lama_masak', deskripsi='$deskripsi', bahan='$bahan_str',
        langkah='$langkah', gizi='$gizi', tanggal='$tanggal',id_user='$id_user'
        WHERE id_resep='$id_resep'";

                    $res = $db->query($sql);
                    if ($res) {
                        header('Location: resep-saya.php?sukses=ubah');
                    } else {
                        echo $db->error;
                    }
                }
            }
        }

        // if everything is ok, try to upload file
    } else {
        if ($pesansalah == "") {
            $resep = "SELECT * FROM resep where judul='$judul' AND id_resep != '$id_resep'";
            $res = $db->query($resep);
            if ($res) {
                if ($res->num_rows > 0) {
                    header("Location: form-ubah-resep.php?id_resep=$id_resep&error=judul");
                } else {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                        // END GAMBAR

                        $sql = "UPDATE resep SET judul='$judul', kategori='$kategori', porsi='$porsi', lama_masak='$lama_masak', deskripsi='$deskripsi', bahan='$bahan_str',
                        langkah='$langkah', gizi='$gizi',foto='$fileName', tanggal='$tanggal',id_user='$id_user'
                        WHERE id_resep='$id_resep'";
                        $res = $db->query($sql);
                        if ($res) {
                            header('Location: resep-saya.php?sukses=ubah');
                        } else {
                            echo $db->error;
                        }

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                echo $db->error;
            }
        }
    }
} else {
    // SETUP STORE IMAGE INTO DATABASE
    $target_dir = "../assets/uploads/resep/";
    $fileName = time() . basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    var_dump($imageFileType);
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
        if ($pesansalah == "") {
            $resep = "SELECT * FROM resep where judul='$judul' AND id_resep != '$id_resep'";
            $res = $db->query($resep);
            if ($res) {
                if ($res->num_rows > 0) {
                    header("Location: form-ubah-resep.php?id_resep=$id_resep&error=judul");
                } else {
                    $sql = "UPDATE resep SET judul='$judul', kategori='$kategori', porsi='$porsi', lama_masak='$lama_masak', deskripsi='$deskripsi', bahan='$bahan_str',
        langkah='$langkah', gizi='$gizi', tanggal='$tanggal',id_user='$id_user'
        WHERE id_resep='$id_resep'";

                    $res = $db->query($sql);
                    if ($res) {
                        header('Location: resep-saya.php?sukses=ubah');
                    } else {
                        echo $db->error;
                    }
                }
            }
        }

        // if everything is ok, try to upload file
    } else {
        if ($pesansalah == "") {
            $resep = "SELECT * FROM resep where judul='$judul' AND id_resep != '$id_resep'";
            $res = $db->query($resep);
            if ($res) {
                if ($res->num_rows > 0) {
                    header("Location: form-ubah-resep.php?id_resep=$id_resep&error=judul");
                } else {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                        // END GAMBAR

                        $sql = "UPDATE resep SET judul='$judul', kategori='$kategori', porsi='$porsi', lama_masak='$lama_masak', deskripsi='$deskripsi', bahan='$bahan_str',
                        langkah='$langkah', gizi='$gizi',foto='$fileName', tanggal='$tanggal',id_user='$id_user'
                        WHERE id_resep='$id_resep'";
                        $res = $db->query($sql);
                        if ($res) {
                            header('Location: resep-saya.php?sukses=ubah');
                        } else {
                            echo $db->error;
                        }

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                echo $db->error;
            }
        }
    }
}
?>