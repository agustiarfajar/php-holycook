<?php
session_start();
include '../database.php';
include 'layout.php';
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
} else {
    $db = dbConnect();
    $id_user = $_SESSION["id_user"];
    $user = getUser($id_user);
}

function getUser($id_user)
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT * FROM user WHERE id_user='$id_user'");
        if ($res) {
            if ($res->num_rows > 0) {
                $data = $res->fetch_assoc();
                $res->free();
                return $data;
            } else
                return FALSE;
        } else
            return FALSE;
    } else
        return FALSE;
}

?>


<?php header_section(); ?>
<div class="container">
    <form id="formUbah" method="post" action="profile-update.php" enctype="multipart/form-data">
        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            $pesan = $_SESSION['errorinput'];
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong>
                Terjadi Kesalahan:
                <?php
                if ($error == 'email') {
                    ?>
                    <p class="mt-3">
                        Email telah digunakan, silahkan gunakan email yang lain.
                    </p>
                    <?php
                }
                if ($error == 'input') {
                    ?>
                    <p class="mt-3">
                        <?= $pesan ?>
                    </p>
                    <?php
                }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        }
        ?>
        <input type="hidden" name="id_user" value="<?= $id_user ?>">
        <div class="row">
            <div class="col-md-3 mb-3 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-start">
                            <?php
                            if ($user['foto'] != 'profile-pict.png') {
                                ?>
                                <a href="../assets/uploads/profile/<?= $user['foto'] ?>" target="_blank"><img
                                        src="../assets/uploads/profile/<?= $user['foto'] ?>"
                                        class="rounded-circle img-thumbnail img-fluid"
                                        style="width:80px;height:80px;object-fit:cover;object-position:50% 50%;"></a>
                                <?php
                            } else {
                                ?>
                                <a href="../assets/images/<?= $user['foto'] ?>" target="_blank"><img
                                        src="../assets/images/<?= $user['foto'] ?>"
                                        class="rounded-circle img-thumbnail img-fluid"
                                        style="width:80px;height:80px;object-fit:cover;object-position:50% 50%;"></a>
                                <?php
                            }
                            ?>

                            <span class="mt-2 fs-5 ms-2">
                                <?php echo $_SESSION["nama"]; ?>
                            </span>
                        </div>
                        <ul class="list-group mt-3">
                            <li class="list-group-item" style="border:0">
                                <span class="fw-semibold">Profil Saya</span>
                                <ul class="list-group">
                                    <li class="list-group-item text-muted" style="border:0"><a href="profile.php"
                                            class="link-secondary text-decoration-none fw-semibold">Ubah Profil</a></li>
                                    <li class="list-group-item text-muted" style="border:0"><a
                                            href="form-tambah-resep.php"
                                            class="link-secondary text-decoration-none">Buat Resep</a></li>
                                    <li class="list-group-item text-muted" style="border:0"><a href="resep-saya.php"
                                            class="link-secondary text-decoration-none">Resep Saya</a></li>
                                    <li class="list-group-item text-muted" style="border:0"><a
                                            href="resep-tersimpan.php" class="link-secondary text-decoration-none">Resep
                                            Tersimpan</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-9 mb-3 mt-4">
                <div class="card border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-start">
                            <div class="d-flex align-items-center text-white me-4 rounded-circle"
                                style="background:#fe5828;width:50px;height:50px;position:relative">
                                <i class="bi bi-person-fill fs-5 text-center p-3"></i>
                            </div>
                            <h2>Profil</h2>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 mb-3 mt-3">
                                <center>
                                    <div class="mt-4">
                                        <?php
                                        if ($user['foto'] != 'profile-pict.png') {
                                            ?>
                                            <img src="../assets/uploads/profile/<?= $user['foto'] ?>" id="foto"
                                                class="rounded-circle img-thumbnail img-fluid"
                                                style="width:167px;height:167px;object-fit:cover;">
                                            <?php
                                        } else {
                                            ?>
                                            <img src="../assets/images/<?= $user['foto'] ?>" id="foto"
                                                class="rounded-circle img-thumbnail img-fluid"
                                                style="width:167px;height:167px;object-fit:cover;">
                                            <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="mt-4">
                                        <input type="file" accept=".jpg,.jpeg,.png" name="foto" id="file-upload"
                                            style="display:none;" />
                                        <label for="file-upload"
                                            class="btn btn-outline-primary rounded-pill btnLogin">Upload
                                            Foto</label>
                                        <br>
                                        <label id="nama-foto" class="mt-2"></label>
                                    </div>
                                </center>
                            </div>
                            <div class="col-md-9 mb-3 mt-5">

                                <label for="email" class="form-label">Email</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bi bi-envelope" id="basic-addon1"></span>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Masukkan Email" value="<?php echo $user['email']; ?>" required>
                                </div>
                                <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bi bi-person" id="basic-addon1"></span>
                                    <input type="text" name="nama" class="form-control" id="namaLengkap"
                                        placeholder="Masukkan Nama Lengkap" value="<?php echo $user['nama']; ?>"
                                        required>
                                </div>
                                <label for="inputNoTelp" class="col-sm-3 col-form-label">Nomor Telepon</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bi bi-phone" id="basic-addon1"></span>
                                    <input type="text" maxlength="13" name="no_telp" class="form-control" id="no_telp"
                                        placeholder="Masukkan Nomor Telepon" value="<?php echo $user['no_telp']; ?>">
                                </div>
                                <label for="inputJK" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-12 mb-3">
                                    <select name="jk" id="inputJK" class="form-select">
                                        <option hidden>Pilih Jenis Kelamin</option>
                                        <option value="L" <?php echo ($user['jk'] == 'L' ? 'selected' : '') ?>>Laki-laki
                                        </option>
                                        <option value="P" <?php echo ($user['jk'] == 'P' ? 'selected' : '') ?>>Perempuan
                                        </option>
                                    </select>
                                </div>
                                <label for="inputAlamat" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-12 mb-3">
                                    <textarea name="alamat" id="" cols="30" rows="10"
                                        class="form-control"><?php echo $user['alamat']; ?></textarea>
                                </div>
                                <button type="button" onclick="konfirmasiUbah()" name="ubah"
                                    class="btn btn-success btnOren"
                                    style="background:#ff642b;border:none">Simpan</button>
                                <!-- <label for="password" class="form-label">PASSWORD</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bi bi-lock" id="basic-addon1"></span>
                                    <input type="password" class="form-control" id="password"
                                        placeholder="Masukkan Password">
                                </div> -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php footer_section(); ?>
<?php
if (isset($_GET['sukses'])) {
    $sukses = $_GET['sukses'];
    if ($sukses == 'ubah') {
        echo '<script>Swal.fire("Informasi", "Data berhasil diubah", "success");</script>';
    }
}
?>
<script>
    $(document).ready(function () {
        // Muncul nama foto
        $('#file-upload').change(function () {
            var file = $('#file-upload')[0].files[0].name;
            $('#nama-foto').text(file);
        });
        // end muncul nama foto
        // image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#foto').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file-upload").change(function () {
            readURL(this);
        });
    })

    function konfirmasiUbah() {
        event.preventDefault();
        var form = event.target.form;
        Swal.fire({
            icon: "question",
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin mengubah data?",
            showCancelButton: true,
            confirmButtonText: "Ubah",
            cancelButtonText: "Batal",
            confirmButtonColor: "#ff642b",
        }).then((result) => {
            if (result.value) {
                // Swal.fire("Informasi", "Data berhasil diubah", "success");

                form.submit();
            } else {
                Swal.fire("Informasi", "Data batal diubah", "error");
            }
        });
    }
</script>