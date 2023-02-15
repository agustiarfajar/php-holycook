<?php
session_id('rpl2');
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
}
include '../database.php';
include 'layout.php';
$db = dbConnect();
$id_user = $_SESSION['id_user'];
$query_foto = "SELECT * FROM user WHERE id_user='$id_user'";
$res_foto = mysqli_query($db, $query_foto);
$user = $res_foto->fetch_assoc();

?>
<?php header_section(); ?>
<style>
    .btn-hapus {
        background: white;
        color: black;
        position: absolute;
        border: 0;
    }

    .btn-hapus:hover {
        background: black;
        color: white;
        position: absolute;
        border: 0;
    }

    .card-img-top {
        object-fit: cover;
        width: 100%;
        height: 40vh;
    }

    .profile-icon {
        width: 30px;
        height: 30px;
    }

    .btn-loadmore {
        border: 2px solid #fe5828;
        color: #fe5828
    }

    .btn-loadmore:hover {
        border: 2px solid #fe5828;
        background: #fe5828;
        color: white;
    }

    .resepsimpan {
        transition: transform 0.2s ease;
        box-shadow: 0 4px 6px 0 rgba(22, 22, 26, 0.18);
        object-fit: cover;
    }

    .resepsimpan:hover {
        transform: scale(1.05);
    }

    .block {
        display: none;
    }

    #load {
        display: none;
    }
</style>
<div class="container">
    <div class="row mt-4">
        <div class="col-md-3 mb-3">
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
                                        class="link-secondary text-decoration-none">Ubah Profil</a></li>
                                <li class="list-group-item text-muted" style="border:0"><a href="form-tambah-resep.php"
                                        class="link-secondary text-decoration-none">Buat Resep</a></li>
                                <li class="list-group-item text-muted" style="border:0"><a href="resep-saya.php"
                                        class="link-secondary text-decoration-none">Resep Saya</a></li>
                                <li class="list-group-item text-muted" style="border:0"><a href="resep-tersimpan.php"
                                        class="link-secondary text-decoration-none fw-semibold">Resep Tersimpan</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 mb-3">
            <div class="d-flex justify-content-start">
                <div class="d-flex align-items-center text-white me-4 rounded-circle"
                    style="background:#fe5828;width:50px;height:50px;position:relative">
                    <i class="bi bi-suit-heart-fill fs-5 text-center p-3"></i>
                </div>
                <h2>Resep Tersimpan</h2>
            </div>
            <hr>

            <!-- Navigasi -->
            <form action="" method="get" class="d-flex justify-content-end">
                <div class="input-group w-25 my-4 form-inline">
                    <select class="form-select" name="urut">
                        <option hidden value="id" <?php if (isset($_GET["urut"]) && $_GET["urut"] == "id") {
                            echo "selected";
                        } ?>>Pilih</option>
                        <option value="a-z" <?php if (isset($_GET["urut"]) && $_GET["urut"] == "a-z") {
                            echo "selected";
                        } ?>>
                            A-Z</option>
                        <option value="z-a" <?php if (isset($_GET["urut"]) && $_GET["urut"] == "z-a") {
                            echo "selected";
                        } ?>>
                            Z-A</option>
                    </select>
                    <button class="btn btn-primary" type="submit"
                        style="background:#ff642b;border:none">Urutkan</button>
                </div>
            </form>

            <?php
            if ($db->connect_errno == 0) {
                $urutan = "";
                if (isset($_GET["urut"])) {
                    if ($_GET["urut"] == "a-z") {
                        $urutan .= "ORDER BY b.judul ASC";
                    } else if ($_GET["urut"] == "z-a") {
                        $urutan .= "ORDER BY b.judul DESC";
                    } else if ($_GET["urut"] == "id") {
                        $urutan .= "ORDER BY a.id_favorit ASC";
                    }
                }

                $sql = "SELECT a.*, b.*, c.id_user, c.nama AS nama_user, c.foto AS fotoUser
                        FROM resep_favorit a INNER JOIN resep b ON  a.id_resep = b.id_resep
                        INNER JOIN user c ON b.id_user = c.id_user
                        WHERE a.id_user = '$id_user' 
                        $urutan";
                $res = $db->query($sql);
                if ($res) {
                    if ($res->num_rows > 0) {
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <h5 class="mb-5 text-muted text-center">Anda menyimpan sebanyak
                            <?php echo count($data) ?> resep masakan
                        </h5>

                        <!-- Search Result -->
                        <div class="row g-5">
                            <?php
                            foreach ($data as $row) {
                                $id_resep = $row["id_resep"];
                                ?>
                                <div class="col-md-4">
                                    <div class="block">
                                        <div class="card resepsimpan">
                                            <!-- Button Hapus -->
                                            <!-- <form action="hapus-favorit.php" method="post"> -->
                                            <input type="hidden" value="<?php echo $row["id_favorit"] ?>" id="fav">
                                            <div class="d-flex justify-content-end div-hapus">
                                                <a href="hapus-favorit.php?favorit=<?php echo $row["id_favorit"] ?>"
                                                    class="btn btn-hapus rounded-circle mt-2 me-2" name="btnHapus"
                                                    style="padding: 5px 10px" onclick="konfirmasiHapus()">
                                                    <i class="bi bi-trash fs-5 fw-bold"></i>
                                                </a>
                                            </div>
                                            <!-- </form> -->
                                            <!-- Foto Resep -->
                                            <a href="detail-resep.php?id_resep=<?php echo $id_resep ?>"
                                                class="card-title text-dark fw-bold resep" style="text-decoration:none">
                                                <div class="image-box">
                                                    <img src="../assets/uploads/resep/<?php echo $row["foto"] ?>"
                                                        class="card-img-top img-fluid" alt="..." style="height:200px;object-fit:cover">
                                                </div>
                                                <!-- Detail Resep -->
                                                <div class="card-body">
                                                    <p class="judul">
                                                        <?php echo $row["judul"] ?>
                                                    </p>
                                            </a>
                                            <div class="d-flex mt-3">
                                                <?php
                                                if ($row['fotoUser'] != 'profile-pict.png') {
                                                    ?>
                                                    <img class="profile-icon rounded-circle me-2"
                                                        src="../assets/uploads/profile/<?php echo $row["fotoUser"] ?>">
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img class="profile-icon rounded-circle me-2"
                                                        src="../assets/images/<?php echo $row["fotoUser"] ?>">
                                                    <?php
                                                }
                                                ?>

                                                <span class="text-dark">
                                                    <?php echo $row["nama_user"] ?>
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-end mt-3">
                                                <p class="me-4"><i class="bi bi-calendar2 me-1"></i>
                                                    <?php echo date("d-m-Y", strtotime($row["tanggal"])) ?>
                                                </p>
                                                <?php
                                                $sql2 = "SELECT COUNT(*) as jml_fav FROM resep_favorit WHERE id_resep = '$id_resep'";
                                                $res2 = $db->query($sql2);
                                                $data2 = $res2->fetch_assoc();
                                                ?>
                                                <p class="me-3"><i class="bi bi-heart me-1"></i>
                                                    <?php echo $data2['jml_fav'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                    </div>
                    <?php
                    } else {
                        echo "<div style='height:36vh'><h5 class='text-muted text-center'>Resep tersimpan masih kosong</h5></div>";
                    }
                }
            }
            ?>
        <!-- Load More -->
        <div class="d-grid gap-2 col-2 mx-auto">
            <div id="load">
                <button class="btn btn-outline-secondary">Muat Lainnya</button>
            </div>
        </div>
    </div>

</div>
</div>
<?php footer_section(); ?>
<script>
    function konfirmasiHapus() {
        event.preventDefault();
        var form = event.target.form;
        Swal.fire({
            icon: "question",
            // url : "hapus-favorit.php",
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menghapus resep favorit?",
            showCancelButton: true,
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            confirmButtonColor: "#ff642b",
        }).then((result) => {
            if (result.value) {
                var id_favorit = $("#fav").val();
                var url = "hapus-favorit.php?id_favorit=" + id_favorit + "";
                window.location.href = url;
                // Swal.fire("Informasi", "Resep favorit berhasil dihapus", "success");
                // form.submit();
            } else {
                Swal.fire("Informasi", "Resep favorit batal dihapus", "error");
            }
        });
    }

    $(document).ready(function () {
        $(".block").slice(0, 6).show();
        if ($(".block:hidden").length != 0) {
            $("#load").show();
        }
        $("#load").on("click", function (e) {
            e.preventDefault();
            $(".block:hidden").slice(0, 6).slideDown();
            if ($(".block:hidden").length == 0) {
                $("#load").text("Tidak ada data lagi").fadOut("slow");
            }
        });
    })
</script>