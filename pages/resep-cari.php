<?php
include '../database.php';
include 'layout.php';
$db = dbConnect();
?>
<?php header_section(); ?>
<style>
    .btn-search {
        background: black;
        /* width: 10%; */
        border: 0;
        color: white;
    }

    .btn-search:hover {
        background: #fe5828;
        background-image: linear-gradient(rgb(0 0 0/10%) 0 0);
        border: 0;
        color: white;
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
        color: #fe5828;
    }

    .btn-loadmore:hover {
        border: 2px solid #fe5828;
        background: #fe5828;
        color: white;
    }

    .judul:hover {
        color: #fe5828;
    }

    .block {
        display: none;
    }

    #load {
        display: none;
    }
</style>
<div class="container px-4 py-5">
    <div class="d-flex my-4 justify-content-start">
        <div class="d-flex align-items-center text-white me-4 rounded-circle"
            style="background:#fe5828;width:50px;height:50px;position:relative">
            <i class="bi bi-search fs-5 text-center p-3"></i>
        </div>
        <h2>Pencarian Resep</h2>
    </div>

    <?php
    if (isset($_GET["cari"])) {
        $cari = $_GET["cari"];
        if ($db->connect_errno == 0) {
            if ($cari != "") {
                $sql = "SELECT b.id_resep, b.judul, b.tanggal, b.foto, b.id_user, c.id_user, c.nama AS nama_user, c.foto AS fotoUser
                        FROM resep b INNER JOIN user c ON b.id_user = c.id_user WHERE b.judul LIKE '%$cari%'";
                $res = $db->query($sql);
                if ($res) {
                    if ($res->num_rows > 0) {
                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <h5 class="text-muted text-center" style="margin: 40px 0px 40px">
                            Ditemukan
                            <?php echo count($data) ?> resep <span><strong>"
                                    <?php echo $cari ?>"
                                </strong></span>
                        </h5>

                        <!-- Search Result -->
                        <div class="container-fluid">
                            <div class="row g-5">
                                <?php
                                foreach ($data as $row) {
                                    $id_resep = $row["id_resep"];
                                    ?>
                                    <!-- <div class="resep"> -->
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="block">
                                            <a href="detail-resep.php?id_resep=<?= $id_resep ?>" class="text-decoration-none text-dark resep">
                                                <div class="card shadow border-0">
                                                    <div class="inner">
                                                        <img src="../assets/uploads/resep/<?= $row["foto"] ?>" class="card-img-top img-fluid"
                                                            alt="Foto Resep" style="width: 500px; height: 290px;" />
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-4 judul">
                                                            <?= $row["judul"] ?>
                                                        </h5>
                                                        <div class="d-flex justify-content-start">
                                                            <?php
                                                            if ($row['fotoUser'] != 'profile-pict.png') {
                                                                ?>
                                                                <img src="../assets/uploads/profile/<?= $row["fotoUser"] ?>" alt="Profile"
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
                                                                <?= $row["nama_user"] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <p class="me-3"><i class="bi bi-calendar2"></i>
                                                            <?= $row["tanggal"] ?>
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
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <!-- End Search -->

                        <!-- Load More -->
                        <div class="d-flex justify-content-center mt-5">
                            <div id="load">
                                <button class="btn btn-outline-secondary">Muat Lainnya</button>
                            </div>
                        </div>
                        <!-- End Load -->
                        <?php
                    } else {
                        ?>
                        <div style="height:35vh">
                            <h5 class="text-muted text-center" style="margin: 40px 0px 40px">
                                Tidak ditemukan resep <span><strong>"
                                        <?php echo $cari ?>"
                                    </strong></span>
                            </h5>
                        </div>
                        </h5>
                        <?php
                    }
                } else
                    echo $db->error;
            } else {
                ?>
                <div style="height:35vh">
                    <h5 class="text-muted text-center" style="margin: 40px 0px 40px">
                        Tidak ditemukan resep <span><strong>"
                                <?php echo $cari ?>"
                            </strong></span>
                    </h5>
                </div>
                <?php
            }
        } else
            return $db->connect_errno;
    }
    ?>

</div>
<?php footer_section(); ?>
<script>
    $(document).ready(function () {
        $(".block").slice(0, 6).show();
        if ($(".block:hidden").length != 0) {
            $("#load").show();
        }
        $("#load").on("click", function (e) {
            e.preventDefault();
            $(".block:hidden").slice(0, 6).slideDown();
            if ($(".block:hidden").length == 0) {
                $("#load").text("Tidak ada data lagi")
                    .fadOut("slow");
            }
        });
    })
</script>