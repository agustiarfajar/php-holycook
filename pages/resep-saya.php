<?php
session_id('rpl2');
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
}
include '../database.php';
include 'layout.php';
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
} else {
    $db = dbConnect();
    $id_user = $_SESSION["id_user"];
    $query_foto = "SELECT * FROM user WHERE id_user='$id_user'";
    $res_foto = mysqli_query($db, $query_foto);
    $user = $res_foto->fetch_assoc();
}
?>
<?php header_section(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-3 mb-3 mt-4">
            <div class="card rounded">
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
                                        class="link-secondary text-decoration-none">Ubah Profil</a></li>
                                <li class="list-group-item text-muted" style="border:0"><a href="form-tambah-resep.php"
                                        class="link-secondary text-decoration-none">Buat Resep</a></li>
                                <li class="list-group-item text-muted" style="border:0"><a href="resep-saya.php"
                                        class="link-secondary text-decoration-none fw-semibold">Resep Saya</a></li>
                                <li class="list-group-item text-muted" style="border:0"><a href="resep-tersimpan.php"
                                        class="link-secondary text-decoration-none">Resep Tersimpan</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 mb-3 mt-4">
            <div class="d-flex justify-content-start">
                <div class="d-flex align-items-center text-white me-4 rounded-circle"
                    style="background:#fe5828;width:50px;height:50px;position:relative">
                    <i class="bi bi-book-half fs-5 text-center p-3"></i>
                </div>
                <h2>Resep Saya</h2>
            </div>
            <hr>
            <div class="row">
                <?php
                $sql = "SELECT a.*, b.nama as nama_user, b.foto as fotoUser
                FROM resep as a
                INNER JOIN user as b ON a.id_user = b.id_user
                WHERE a.id_user = '$id_user'";
                $res = $db->query($sql);
                if ($res) {
                    $resep = $res->fetch_all(MYSQLI_ASSOC);
                    if ($res->num_rows > 0) {
                        foreach ($resep as $row) {
                            $id_resep = $row['id_resep'];
                            ?>
                            <div class="col-md-4 mb-3">
                                <div class="card rounded">
                                    <a href="detail-resep.php?id_resep=<?= $row['id_resep'] ?>"
                                        class="text-decoration-none text-dark resep">
                                        <div class="inner rounded">
                                            <img src="../assets/uploads/resep/<?= $row['foto'] ?>"
                                                class="card-img-top img-fluid w-100 rounded" alt="resep"
                                                style="height:200px;object-fit:cover" />
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title mb-4 judul">
                                                <?= $row['judul'] ?>
                                            </h5>
                                    </a>
                                    <div class="d-flex justify-content-start">
                                        <?php
                                        if ($row['fotoUser'] != 'profile-pict.png') {
                                            ?>
                                            <img src="../assets/uploads/profile/<?= $row['fotoUser'] ?>" alt="Profile"
                                                class="img-fluid rounded-circle" style="width: 30px; height: 30px" />
                                            <?php
                                        } else {
                                            ?>
                                            <img src="../assets/images/<?= $row['fotoUser'] ?>" alt="Profile"
                                                class="img-fluid rounded-circle" style="width: 30px; height: 30px" />
                                            <?php
                                        }
                                        ?>

                                        <p class="ms-2">
                                            <?= $row['nama_user'] ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <p class="me-3"><i class="bi bi-calendar2"></i>
                                        <?= $row['tanggal'] ?>
                                    </p>
                                    <?php
                                    $sqlcount = "SELECT COUNT(*) as jml_favorit FROM resep_favorit WHERE id_resep = '$id_resep'";
                                    $rescount = $db->query($sqlcount);
                                    $jml_fav = $rescount->fetch_assoc();
                                    ?>
                                    <p class="me-3"><i class="bi bi-heart"></i>
                                        <?= $jml_fav['jml_favorit'] ?>
                                    </p>
                                </div>
                                <div class="d-flex justify-content-end mb-3 me-3">
                                    <form action="resep-delete.php" method="post">
                                        <input type="hidden" name="id_resep" value="<?= $row['id_resep'] ?>">
                                        <a href="form-ubah-resep.php?id_resep=<?= $id_resep ?>"
                                            class="btn btn-primary btn-sm btnOren"><i class="bi bi-pencil"></i> Ubah</a>
                                        <button type="button" onclick="konfirmasiHapus()" class="btn btn-outline-danger btn-sm"><i
                                                class="bi bi-trash"></i>
                                            Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    } else {
                        echo "<div style='height:45vh'><h5 class='text-muted text-center'>Resep saya masih kosong</h5></div>";
                    }
                } else {
                    echo $db->error;
                }
                ?>
        </div>
    </div>
</div>
</div>
<?php footer_section(); ?>
<!-- ALERT -->
<?php
if (isset($_GET['sukses'])) {
    $sukses = $_GET['sukses'];
    if ($sukses == 'tambah') {
        echo '<script>Swal.fire("Informasi", "Resep berhasil ditambah", "success")</script>';
    } else if ($sukses == 'ubah') {
        echo '<script>Swal.fire("Informasi", "Resep berhasil diubah", "success")</script>';
    } else if ($sukses == 'hapus') {
        echo '<script>Swal.fire("Informasi", "Resep berhasil dihapus", "success")</script>';
    }
}
?>
<!-- END ALER -->
<script>
    function konfirmasiHapus() {
        event.preventDefault();
        var form = event.target.form;
        Swal.fire({
            icon: "question",
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus resep?",
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#ff642b",
        }).then((result) => {
            if (result.value) {
                // Swal.fire("Informasi", "Resep berhasil dihapus", "success");
                form.submit();
            } else {
                Swal.fire("Informasi", "Resep batal dihapus", "error");
            }
        });
    }
</script>