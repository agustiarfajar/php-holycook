<?php
function header_section()
{
    session_id('rpl2');
    session_start();
    include_once('../database.php');
    setlocale(LC_TIME, 'id_ID');

    $db = dbConnect();

    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];

        $query_foto = "SELECT * FROM user WHERE id_user='$id_user'";
        $res_foto = mysqli_query($db, $query_foto);
        $user = $res_foto->fetch_assoc();
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="../assets/images/logo holycook.png">
        <title>HolyCook</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="../assets/components/Style.css">
        <link rel="stylesheet" href="../assets/components/summernote/summernote-bs5.min.css">
        <link rel="stylesheet" href="../assets/components/sweetalert2/sweetalert2.min.css">
    </head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap');

        html,
        body {
            height: 100%;
            background: #fff;
        }

        .footer-link {
            color: gray;
        }

        .footer-link:hover {
            color: rgb(255, 94, 0);
        }

        .nav-link:hover {
            color: rgb(255, 94, 0);
        }

        .dropdown-item:hover {
            background-color: rgb(255, 94, 0);
            color: white;
        }
    </style>

    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="home.php">
                    <img src="../assets/images/navbar_logo_1.png" alt="" style="width: 150px;height: 50px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="d-flex justify-content-center m-auto navbar-nav me-auto fw-bold">
                        <li class="nav-item mx-2">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" aria-current="page" href="kategori.php">Kategori Resep</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" aria-current="page" href="tentang.php">Tentang</a>
                        </li>
                    </ul>

                    <ul class="d-flex justify-content-center navbar-nav">
                        <li class="nav-item">
                            <form class="d-flex nav-link" role="search" action="resep-cari.php" method="get">
                                <input class="form-control me-2" name="cari" type="search" placeholder="Cari..."
                                    aria-label="Search">
                                <button type="submit" class="btn btn-outline-secondary"><i
                                        class="bi bi-search text-dark"></i></button>
                            </form>
                        </li>
                        <?php
                        if (isset($_SESSION["Login"])) {
                            ?>
                            <li class="nav-item dropdown m-auto">
                                <a class="nav-link dropdown" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <?php
                                    if ($user['foto'] != 'profile-pict.png') {
                                        ?>
                                        <img class="rounded-circle img-fluid img-thumbnail text-center"
                                            src="../assets/uploads/profile/<?= $user['foto'] ?>"
                                            style="width:40px;height:40px;margin:auto" alt="">
                                        <?php
                                    } else {
                                        ?>
                                        <img class="rounded-circle img-fluid img-thumbnail text-center"
                                            src="../assets/images/<?= $user['foto'] ?>" style="width:40px;height:40px;margin:auto"
                                            alt="">
                                        <?php
                                    }
                                    ?>
                                </a>
                                <ul class="dropdown-menu" style="margin-left: -80%;">
                                    <li><a class="dropdown-item" href="profile.php">Profil</a></li>
                                    <li><a class="dropdown-item" href="form-tambah-resep.php">Buat Resep</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>

                                </ul>
                            </li>
                            <?php
                        } else {
                            ?>
                            <li class="nav-item mt-2">
                                <a href="login.php" class="btn btn-outline-primary btnLogin">Login</a>
                                <a href="registrasi.php" class="btn btn-primary btn-oren"
                                    style="background:#ff642b;border:none;">Register</a>
                            </li>
                            <?php
                        }
                        ?>


                    </ul>
                </div>
            </div>
        </nav>
        <?php
}

function footer_section()
{
    ?>
        <!-- FOOTER -->
        <footer class="footer pt-3 pt-md-5 mt-5 bg-light" style="bottom: 0;width: 100%;">
            <div class="container">
                <center>
                    <img src="../assets/images/navbar_logo_1.png" alt="footer_logo" class="img-fluid mb-3"
                        style="width:200px">
                    <p class="text-muted" style="font-size:20px">
                        HolyCook adalah sebuah platform resep masakan yang dibuat untuk membantu para ibu-ibu, anak
                        sekolah untuk mengeksplor
                        resep masakan buatan dari seluruh masyarakat di penjuru negeri.
                    </p>
                </center>
            </div>

            <div class="container">
                <hr>
                <div class="row pb-4 pt-2 align-items-center">
                    <p class="small text-center mb-0" style="color:gray">
                        &copy; 2023 HolyCook - All Rights Reserved
                    </p>
                </div>
            </div>
        </footer>

        <script src="../assets/components/jquery/jquery-3.6.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SummerNote -->
        <script src="../assets/components/summernote/summernote-bs5.min.js"></script>
        <script src="../assets/components/sweetalert2/sweetalert2.min.js"></script>
    </body>

    </html>
    <?php
}
?>