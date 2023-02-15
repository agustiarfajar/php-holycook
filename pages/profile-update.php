<?php
session_start();
include '../database.php';
$db = dbConnect();

// var_dump($_POST);

// Hapus gambar
$id_user = $db->escape_string($_POST['id_user']);
$email = $db->escape_string($_POST['email']);
$nama = $db->escape_string($_POST['nama']);
$jk = $db->escape_string($_POST['jk']);
$no_telp = $db->escape_string($_POST['no_telp']);
$alamat = $db->escape_string($_POST['alamat']);

$pesansalah = "";
if (strlen($email) == 0) {
    $pesansalah .= "Email tidak boleh kosong.<br>";
}
if (strlen($nama) == 0) {
    $pesansalah .= "Nama tidak boleh kosong.<br>";
}


if ($pesansalah != "") {
    $_SESSION["errorinput"] = $pesansalah;
    header('Location: profile.php?error=input');
} else {
    $query_foto = "SELECT * FROM user WHERE id_user='$id_user'";
    $res_foto = mysqli_query($db, $query_foto);
    $data = $res_foto->fetch_assoc();

    $imageUrl = '../assets/uploads/profile/' . $data['foto'];
    if ($_FILES['foto']['size'] != 0) {
        unlink($imageUrl);
        // SETUP STORE IMAGE INTO DATABASE
        $target_dir = "../assets/uploads/profile/";
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
            $user = "SELECT * FROM user where email='$email' AND id_user != '$id_user'";
            $resuser = $db->query($user);
            if ($resuser) {
                if ($resuser->num_rows > 0) {
                    header('Location: profile.php?error=email');
                } else {
                    $sql = "UPDATE user SET email='$email', nama='$nama', jk='$jk',no_telp='$no_telp', alamat='$alamat' WHERE id_user='$id_user'";
                    $res = $db->query($sql);
                    if ($res) {
                        header('Location: profile.php?sukses=ubah');
                    } else {
                        echo $db->error;
                    }
                }
            } else {
                echo $db->error;
            }

            // if everything is ok, try to upload file
        } else {
            $user = "SELECT * FROM user where email='$email' AND id_user != '$id_user'";
            $resuser = $db->query($user);
            if ($resuser) {
                if ($resuser->num_rows > 0) {
                    header('Location: profile.php?error=email');
                } else {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                        // END GAMBAR

                        $sql = "UPDATE user SET email='$email', nama='$nama', jk='$jk',no_telp='$no_telp', alamat='$alamat', foto='$fileName' WHERE id_user='$id_user'";
                        $res = $db->query($sql);
                        if ($res) {
                            header('Location: profile.php?sukses=ubah');
                        } else {
                            echo $db->error;
                        }

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    } else {
        // SETUP STORE IMAGE INTO DATABASE
        $target_dir = "../assets/uploads/profile/";
        $fileName = basename($_FILES["foto"]["name"]);
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
            $user = "SELECT * FROM user where email='$email' AND id_user != '$id_user'";
            $resuser = $db->query($user);
            if ($resuser) {
                if ($resuser->num_rows > 0) {
                    header('Location: profile.php?error=email');
                } else {
                    $sql = "UPDATE user SET email='$email', nama='$nama', jk='$jk',no_telp='$no_telp', alamat='$alamat' WHERE id_user='$id_user'";
                    $res = $db->query($sql);
                    if ($res) {
                        header('Location: profile.php?sukses=ubah');
                    } else {
                        echo $db->error;
                    }
                }
            } else {
                echo $db->error;
            }

            // if everything is ok, try to upload file
        } else {
            $user = "SELECT * FROM user where email='$email' AND id_user != '$id_user'";
            $resuser = $db->query($user);
            if ($resuser) {
                if ($resuser->num_rows > 0) {
                    header('Location: profile.php?error=email');
                } else {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                        // END GAMBAR

                        $sql = "UPDATE user SET email='$email', nama='$nama', jk='$jk',no_telp='$no_telp', alamat='$alamat', foto='$fileName' WHERE id_user='$id_user'";
                        $res = $db->query($sql);
                        if ($res) {
                            header('Location: profile.php?sukses=ubah');
                        } else {
                            echo $db->error;
                        }

                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }
}




?>