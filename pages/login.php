<?php
include '../database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" href="../assets/images/logo holycook.png">
</head>
<style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: #f7f7f7;
    }
</style>

<body>
    <div class="container py-5 h-100">
        <div class="tab-content">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <a href="home.php">
                                <img src="../assets/images/logo holycook.png" alt="logo" class="img-fluid mb-3"
                                    style="width:200px;height:200px">
                            </a>
                            <h3 class="mb-3">
                                LOGIN
                            </h3>
                            <?php
                            if (isset($_GET['error'])) {
                                $error = $_GET['error'];
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong>
                                    Terjadi Kesalahan:
                                    <?php
                                    if ($error == 'identitas') {
                                        ?>
                                        <p class="mt-3">
                                            Username atau password salah!
                                        </p>
                                        <?php
                                    }
                                    ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                <?php
                            }
                            ?>
                            <form name="form-login" method="post" action="login-session.php">
                                <div class="form-outline mb-3">
                                    <label class="form-label d-flex justify-content-start" style="margin-left: 0px;">
                                        <i class="bi bi-envelope" style="margin-right: 5px;"></i>
                                        Email
                                    </label>
                                    <input type="text" class="form-control form-control-lg" name="email"
                                        placeholder="Masukkan Email" value="<?php if (isset($_COOKIE["email"])) {
                                            echo $_COOKIE["email"];
                                        } ?>">
                                    <div class="form-notch">
                                        <div class="form-notch-leading" style="width: 9px;"></div>
                                        <div class="form-notch-middle" style="width: 40px;"></div>
                                        <div class="form-notch-trailing"></div>
                                    </div>
                                </div>

                                <div class="form-outline mb-3">
                                    <label class="form-label d-flex justify-content-start" id="typePasswordX-2"
                                        style="margin-left: 0px;">
                                        <i class="bi bi-key" style="margin-right: 5px;"></i>
                                        Password
                                    </label>
                                    <input type="password" class="form-control form-control-lg" name="password"
                                        id="typePasswordX-2" placeholder="Masukkan Password" value="<?php if (isset($_COOKIE["password"])) {
                                            echo $_COOKIE["password"];
                                        } ?>">
                                    <div class="form-notch">
                                        <div class="form-notch-leading" style="width: 9px;"></div>
                                        <div class="form-notch-middle" style="width: 64px;"></div>
                                        <div class="form-notch-trailing"></div>
                                    </div>
                                </div>

                                <div class="form-check d-flex justify-content-start mb-4">
                                    <input type="checkbox" class="form-check-input" name="remember" <?php if (isset($_COOKIE["id_user"])) {
                                        echo 'checked';
                                    } ?>>
                                    <span class="ms-2">Ingat Saya</span>
                                </div>

                                <button class="btn btn-lg btn-block px-5 text-white w-100"
                                    style="background-color: rgb(255, 94, 0);" type="submit"
                                    name="TblLogin">Login</button>
                                <hr>
                                <div class="my-2 mx-5">
                                    <div class="d-flex justify-content-center">
                                        <p class="">Belum memiliki Akun? <a href="registrasi.php"
                                                style="text-decoration: none;color: rgb(255, 94, 0);">
                                                Registrasi</a></p>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>