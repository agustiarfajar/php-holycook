<?php include '../database.php'; ?>

<?php
$db = dbConnect();
if ($db->connect_errno == 0) {
    if (isset($_POST["TblLogin"])) {
        $email = $db->escape_string($_POST["email"]);
        $password = $db->escape_string($_POST["password"]);
        // $enc_pass = md5($password);
        $sql = "SELECT * FROM user WHERE email='$email' AND password=PASSWORD('$password')";
        $res = $db->query($sql);
        if ($res) {
            if ($res->num_rows == 1) {
                $data = $res->fetch_assoc();
                session_id('rpl2');
                session_start();
                $_SESSION["Login"] = true;
                $_SESSION["id_user"] = $data["id_user"];
                $_SESSION["nama"] = $data["nama"];

                if (isset($_POST["remember"])) {
                    // Buat cookie
                    setcookie('id_user', $data["id_user"], time() + 7200);
                    setcookie('email', $data["email"], time() + 7200);
                    setcookie('password', $password, time() + 7200);
                }

                header("Location: home.php");
            } else
                header("Location: login.php?error=identitas");
        } else
            header("Location: home.php?error=2");
    } else
        header("Location: home.php?error=3");
}
?>