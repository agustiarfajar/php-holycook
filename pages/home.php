<?php
session_id('rpl2');
session_start();
include '../database.php';
include 'layout.php';
?>
<?php header_section(); ?>
<style>
    h1 {
        color: #3c8e3d;
    }

    .block {
        display: none;
    }

    #load {
        display: none;
    }
</style>
<!-- carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../assets/images/menu90.jpg" class="d-block w-100 img-fluid" style="height:700px;object-fit:cover"
                alt="images" />
        </div>
        <div class="carousel-item">
            <img src="../assets/images/bannerhome.jpg" class="d-block w-100 img-fluid"
                style="height:700px;object-fit:cover" alt="images" />
        </div>
        <div class="carousel-item">
            <img src="../assets/images/bannerhome2.jpg" class="d-block w-100 img-fluid"
                style="height:700px;object-fit:cover" alt="images" />
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <div style="background:#000;opacity:0.5;padding:5px">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </div>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <div style="background:#000;opacity:0.5;padding:5px">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </div>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- carousel end -->

<!-- kategori menu -->
<div class="container">
    <div class="row">
        <h2 class="py-3 mt-5" style="font-family: 'Playfair Display', serif;">Kategori Menu</h2>
        <div class="col-lg-2 col-md-4 text-center">
            <a href="detail-kategori.php?kategori=seafood"
                class="text-decoration-none text-dark rounded-circle kategori_home">
                <div class="">
                    <img src="../assets/images/seafood.jpg" alt="Resep" class="img-fluid rounded-circle"
                        style="width: 150px; height: 150px" />
                </div>
                <b>
                    <p class="mt-2">Seafood</p>
                </b>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 text-center">
            <a href="detail-kategori.php?kategori=sup"
                class="text-decoration-none text-dark rounded-circle kategori_home">
                <div class="">
                    <img src="../assets/images/sup.jpg" alt="Resep" class="img-fluid rounded-circle"
                        style="width: 150px; height: 150px" />
                </div>
                <b>
                    <p class="mt-2">Sup</p>
                </b>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 text-center">
            <a href="detail-kategori.php?kategori=kue"
                class="text-decoration-none text-dark rounded-circle kategori_home">
                <div class="">
                    <img src="../assets/images/kue.jpg" alt="Resep" class="img-fluid rounded-circle"
                        style="width: 150px; height: 150px" />
                </div>
                <b>
                    <p class="mt-2">Kue</p>
                </b>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 text-center">
            <a href="detail-kategori.php?kategori=dessert"
                class="text-decoration-none text-dark rounded-circle kategori_home">
                <div class="">
                    <img src="../assets/images/dessert.jpg" alt="Resep" class="img-fluid rounded-circle"
                        style="width: 150px; height: 150px" />
                </div>
                <b>
                    <p class="mt-2">Dessert</p>
                </b>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 text-center">
            <a href="detail-kategori.php?kategori=daging"
                class="text-decoration-none text-dark rounded-circle kategori_home">
                <div class="">
                    <img src="../assets/images/daging.jfif" alt="Resep" class="img-fluid rounded-circle"
                        style="width: 150px; height: 150px" />
                </div>
                <b>
                    <p class="mt-2">Daging</p>
                </b>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 text-center">
            <a href="kategori.php" class="text-decoration-none text-dark rounded-circle kategori_home">
                <div class="">
                    <img src="../assets/images/lainya.png" alt="Resep" class="img-fluid rounded-circle"
                        style="width: 150px; height: 150px" />
                </div>
                <b>
                    <p class="mt-2">Lainnya</p>
                </b>
            </a>
        </div>
    </div>
</div>

<!-- kategori menu end -->

<!-- resep populer start -->
<div class="container">
    <div class="row">
        <h2 class="py-3 mt-5" style="font-family: 'Playfair Display', serif;">Resep Populer</h2>
        <?php
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT COUNT(*) as jml_fav, b.*, c.nama as nama_user, c.foto as fotoUser FROM resep_favorit as a
                    INNER JOIN resep as b ON a.id_resep = b.id_resep
                    INNER JOIN user as c ON b.id_user = c.id_user
                    GROUP BY b.judul
                    ORDER BY jml_fav DESC LIMIT 6";
            $res = $db->query($sql);

            if ($res) {
                if ($res->num_rows > 0) {
                    $data = $res->fetch_all(MYSQLI_ASSOC);

                    foreach ($data as $barisData) {
                        $id_resep = $barisData['id_resep'];
                        ?>
                        <div class="col-xl-4 col-md-6 mb-4">
                            <a href="detail-resep.php?id_resep=<?= $barisData['id_resep'] ?>"
                                class="text-decoration-none text-dark resep">
                                <div class="card shadow border-0">
                                    <div class="inner">
                                        <img src="../assets/uploads/resep/<?= $barisData['foto'] ?>" class="card-img-top img-fluid"
                                            alt="..." style="width: 500px; height: 290px;" />
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title mb-4 judul">
                                            <?= $barisData['judul'] ?>
                                        </h5>
                                        <div class="d-flex justify-content-start">
                                            <?php
                                            if ($barisData['fotoUser'] != 'profile-pict.png') {
                                                ?>
                                                <img src="../assets/uploads/profile/<?= $barisData['fotoUser'] ?>" alt="Profile"
                                                    class="img-fluid rounded-circle" style="width: 30px; height: 30px" />
                                                <?php
                                            } else {
                                                ?>
                                                <img src="../assets/images/<?= $barisData['fotoUser'] ?>" alt="Profile"
                                                    class="img-fluid rounded-circle" style="width: 30px; height: 30px" />
                                                <?php
                                            }
                                            ?>

                                            <p class="ms-2">
                                                <?= $barisData['nama_user'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <p class="me-3"><i class="bi bi-calendar2"></i>
                                            <?= date('d M Y', strtotime($barisData['tanggal'])) ?>
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
                        <?php
                    }
                } else {
                    echo "<h5 class='text-muted text-center'>Resep masih kosong</h5>";
                }
            } else {
                echo $db->error;
            }
        } else {
            return $db->connect_errno;
        }
        ?>
    </div>
</div>
<!--resep populer end -->

<!-- resep terbaru -->
<div class="container">
    <div class="row">
        <h2 class="py-3 mt-5" style="font-family: 'Playfair Display', serif;">Resep Terbaru</h2>
        <?php
        $db = dbConnect();
        if ($db->connect_errno == 0) {
            $sql = "SELECT b.*,b.foto as fotoResep ,c.nama, c.foto as fotoUser FROM resep as b
               INNER JOIN user as c ON b.id_user = c.id_user
               ORDER BY b.tanggal DESC ";
            $res = $db->query($sql);

            if ($res) {
                if ($res->num_rows > 0) {
                    $data = $res->fetch_all(MYSQLI_ASSOC);

                    foreach ($data as $barisData) {
                        $id_resep = $barisData['id_resep'];
                        ?>

                        <div class="col-md-3 mb-3">
                            <div class="block">
                                <a href="detail-resep.php?id_resep=<?= $barisData['id_resep'] ?>"
                                    class="text-decoration-none text-dark resep">
                                    <div class="card shadow border-0">
                                        <div class="inner">
                                            <img src="../assets/uploads/resep/<?= $barisData['fotoResep'] ?>"
                                                class="card-img-top img-fluid" alt="..." style="width: 100%; height: 200px;" />
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title mb-4 judul">
                                                <?= $barisData['judul'] ?>
                                            </h5>
                                            <div class="d-flex justify-content-start">
                                                <?php
                                                if ($barisData['fotoUser'] != 'profile-pict.png') {
                                                    ?>
                                                    <img src="../assets/uploads/profile/<?= $barisData['fotoUser'] ?>" alt="Profile"
                                                        class="img-fluid rounded-circle" style="width: 30px; height: 30px" />
                                                    <?php
                                                } else {
                                                    ?>
                                                    <img src="../assets/images/<?= $barisData['fotoUser'] ?>" alt="Profile"
                                                        class="img-fluid rounded-circle" style="width: 30px; height: 30px" />
                                                    <?php
                                                }
                                                ?>
                                                <p class="ms-2">
                                                    <?= $barisData['nama'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <p class="me-3"><i class="bi bi-calendar2"></i>
                                                <?= $barisData['tanggal'] ?>
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
                        <?php
                    }
                } else {
                    echo "<h5 class='text-muted text-center'>Resep masih kosong</h5>";
                }
            } else {
                echo $db->error;
            }
        } else {
            echo $db->error;
        }
        ?>
    </div>
</div>
<div class="text-center">
    <div id="load">
        <button class="btn btn-outline-secondary">Muat Lainnya</button>
    </div>
</div>
<!-- resep terbaru end -->
<?php footer_section(); ?>
<script>
    $(document).ready(function () {
        $(".block").slice(0, 8).show();
        if ($(".block:hidden").length != 0) {
            $("#load").show();
        }
        $("#load").on("click", function (e) {
            e.preventDefault();
            $(".block:hidden").slice(0, 4).slideDown();
            if ($(".block:hidden").length == 0) {
                $("#load").text("Tidak ada data lagi").fadOut("slow");
            }
        });
    });
</script>