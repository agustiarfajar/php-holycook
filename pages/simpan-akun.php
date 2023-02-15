<?php
include("../database.php");

$db = dbConnect();

if (isset($_POST['submit'])) {
    $nama = $db->escape_string($_POST['nama']);
    $email = $db->escape_string($_POST['email']);
    $password = $db->escape_string($_POST['password']);
    $fotoUser = "profile-pict.png";

    // CEK KESAMAAN JUDUL
    $user = "SELECT * FROM user where email='$email'";
    $resuser = $db->query($user);
    if ($resuser) {
        if ($resuser->num_rows > 0) {
            header('Location: registrasi.php?error=email');
        } else {
            $sql = "INSERT INTO user(nama, email, password, foto) VALUES ('$nama','$email',PASSWORD('$password'), '$fotoUser')";
            $res = $db->query($sql);
            if ($res) {
                if ($db->affected_rows > 0) {
                    header("Location: login.php");
                }
            } else {
                header('Location: registrasi.php?error=registrasi');
            }
        }
    }
}
?>