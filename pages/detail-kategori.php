<?php
session_id('rpl2');
session_start();
include '../database.php';
include 'layout.php';

$db = dbConnect();
if ($_GET['kategori']) {
    $kategori = $_GET['kategori'];
    $sql = "SELECT COUNT(*) AS jmlResep FROM resep WHERE kategori='$kategori'";
    $res = $db->query($sql);
    $jml_resep = $res->fetch_assoc();
}
?>
<?php header_section(); ?>
<style>
    .btn-loadmore {
        border: 2px solid #fe5828;
        color: #fe5828
    }

    .btn-loadmore:hover {
        border: 2px solid #fe5828;
        background: #fe5828;
        color: white;
    }

    h1 {
        color: #3C8E3D;
    }

    .block {
        display: none;
    }

    #load {
        display: none;
    }
</style>
<?php
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    if ($sort == 'terkecil') {
        ?>

        <section class="tstbite-components py-0 text-center">
            <?php
            if ($kategori == 'jus') {
                ?><img src="../assets/images/jus-baner.png" class="w-100 img-fluid" alt="Banner"
                    style="height:300px;object-fit:cover;">
                <?php
            } else if ($kategori == 'seafood') {
                ?><img src="../assets/images/seafood-baner.png" class="w-100 img-fluid" alt="Banner"
                        style="height:300px;object-fit:cover;">
                <?php
            } else if ($kategori == 'sup') {
                ?><img src="../assets/images/sup-baner.png" class="w-100 img-fluid" alt="Banner"
                            style="height:300px;object-fit:cover;">
                <?php
            } else if ($kategori == 'kue') {
                ?><img src="../assets/images/kue-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                style="height:300px;object-fit:cover;">
                <?php
            } else if ($kategori == 'dessert') {
                ?><img src="../assets/images/dessert-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                    style="height:300px;object-fit:cover;">
                <?php
            } else if ($kategori == 'breakfast') {
                ?><img src="../assets/images/breakfast-baner.png" class="w-100 img-fluid" alt="Banner"
                                        style="height:300px;object-fit:cover;">
                <?php
            } else if ($kategori == 'daging') {
                ?><img src="../assets/images/daging-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                            style="height:300px;object-fit:cover;">
                <?php
            } else if ($kategori == 'dinner') {
                ?><img src="../assets/images/dinner-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                                style="height:300px;object-fit:cover;">
                <?php
            } else if ($kategori == 'cemilan') {
                ?><img src="../assets/images/cemilan-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                                    style="height:300px;object-fit:cover;">
                <?php
            }
            ?>
        </section>
        <div class="container kategori">
            <div class="row align-items-end mb-0 mb-md-4 pt-0 pt-md-5">
                <div class="col-lg-9 col-md-8">
                    <?php
                    if ($kategori == 'jus') {
                        ?>
                        <h5 class="py-3 mb-0 fs-1">Jus <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                            </sup></h5>
                        <p style="font-size: 20px;">Jus merupakan minuman yang sangat menyegarkan. Jus sangat cocok dinikmati saat
                            kapanpun dan dimanapaun</p>
                        <?php
                    } else if ($kategori == 'seafood') {
                        ?>
                            <h5 class="py-3 mb-0 fs-1">Seafood <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                </sup></h5>
                            <p style="font-size: 20px;">Makanan yang berasal dari laut</p>
                        <?php
                    } else if ($kategori == 'sup') {
                        ?>
                                <h5 class="py-3 mb-0 fs-1">SUP <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                    </sup></h5>
                                <p style="font-size: 20px;">Sup makanan yang dapat menghangatkan tubuh</p>
                        <?php
                    } else if ($kategori == 'kue') {
                        ?>
                                    <h5 class="py-3 mb-0 fs-1">Kue <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                        </sup></h5>
                                    <p style="font-size: 20px;">Masakan ringan yang banyak digemari</p>
                        <?php
                    } else if ($kategori == 'dessert') {
                        ?>
                                        <h5 class="py-3 mb-0 fs-1">Dessert <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                            </sup></h5>
                                        <p style="font-size: 20px;">Masakan untuk hidangan penutup</p>
                        <?php
                    } else if ($kategori == 'breakfast') {
                        ?>
                                            <h5 class="py-3 mb-0 fs-1">Breakfast <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                                </sup></h5>
                                            <p style="font-size: 20px;">Masakan untuk di pagi hari</p>
                        <?php
                    } else if ($kategori == 'daging') {
                        ?>
                                                <h5 class="py-3 mb-0 fs-1">Daging <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                                    </sup></h5>
                                                <p style="font-size: 20px;">Masakan yang berasal dari daging hewan</p>
                        <?php
                    } else if ($kategori == 'dinner') {
                        ?>
                                                    <h5 class="py-3 mb-0 fs-1">Dinner <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                                        </sup></h5>
                                                    <p style="font-size: 20px;">Masakan untuk di malam hari</p>
                        <?php
                    } else if ($kategori == 'cemilan') {
                        ?>
                                                        <h5 class="py-3 mb-0 fs-1">Cemilan <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                                            </sup></h5>
                                                        <p style="font-size: 20px;">Masakan yang cocok dimakan saat waktu bersasntai</p>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="sort-control">
                        <span>Urutkan:</span>
                        <select class="form-select urutkan">
                            <option hidden>Pilih Urutkan</option>
                            <option value="terkecil">Resep dari A-Z</option>
                            <option value="terbesar">Resep dari Z-A</option>
                        </select>
                    </div>
                </div>
            </div>
            <section class="tstbite-components my-4 my-md-5">
                <div class="row">
                    <?php
                    $db = dbConnect();
                    if ($db->connect_errno == 0) {
                        $kategori = $_GET['kategori'];
                        $res = $db->query("SELECT r.*, u.nama AS nama, u.foto AS fotoUser 
                                    FROM resep r JOIN user u ON r.id_user=u.id_user 
                                    WHERE kategori='$kategori'
                                    ORDER BY r.judul ASC");

                        $data = $res->fetch_all(MYSQLI_ASSOC);
                        if ($res->num_rows > 0) {
                            foreach ($data as $barisData) {
                                $id_resep = $barisData['id_resep'];
                                ?>
                                <div class="col-xl-4 col-md-6 mb-4">
                                    <div class="block">
                                        <a href="detail-resep.php?id_resep=<?= $id_resep ?>" class="text-decoration-none text-dark resep">
                                            <div class="card shadow border-0">
                                                <div class="inner">
                                                    <img src="../assets/uploads/resep/<?= $barisData["foto"] ?>"
                                                        class="card-img-top img-fluid" alt="Foto Resep"
                                                        style="width: 500px; height: 290px;" />
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title mb-4 judul">
                                                        <?= $barisData["judul"] ?>
                                                    </h5>
                                                    <div class="d-flex justify-content-start">
                                                        <?php
                                                        if ($barisData['fotoUser'] != 'profile-pict.png') {
                                                            ?>
                                                            <img src="../assets/uploads/profile/<?= $barisData["fotoUser"] ?>" alt="Profile"
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
                                                            <?= $barisData["nama"] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <p class="me-3"><i class="bi bi-calendar2"></i>
                                                        <?= $barisData["tanggal"] ?>
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
                    }
                    ?>
                </div>
            </section>
            <div class="d-grid gap-2 col-2 mx-auto">
                <div id="load">
                    <button class="btn btn-outline-secondary">Muat Lainnya</button>
                </div>
            </div>
        </div>
        <?php
    } else if ($sort == 'terbesar') {
        ?>

            <section class="tstbite-components py-0 text-center">
                <?php
                if ($kategori == 'jus') {
                    ?><img src="../assets/images/jus-baner.png" class="w-100 img-fluid" alt="Banner"
                        style="height:300px;object-fit:cover;">
                <?php
                } else if ($kategori == 'seafood') {
                    ?><img src="../assets/images/seafood-baner.png" class="w-100 img-fluid" alt="Banner"
                            style="height:300px;object-fit:cover;">
                <?php
                } else if ($kategori == 'sup') {
                    ?><img src="../assets/images/sup-baner.png" class="w-100 img-fluid" alt="Banner"
                                style="height:300px;object-fit:cover;">
                <?php
                } else if ($kategori == 'kue') {
                    ?><img src="../assets/images/kue-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                    style="height:300px;object-fit:cover;">
                <?php
                } else if ($kategori == 'dessert') {
                    ?><img src="../assets/images/dessert-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                        style="height:300px;object-fit:cover;">
                <?php
                } else if ($kategori == 'breakfast') {
                    ?><img src="../assets/images/breakfast-baner.png" class="w-100 img-fluid" alt="Banner"
                                            style="height:300px;object-fit:cover;">
                <?php
                } else if ($kategori == 'daging') {
                    ?><img src="../assets/images/daging-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                                style="height:300px;object-fit:cover;">
                <?php
                } else if ($kategori == 'dinner') {
                    ?><img src="../assets/images/dinner-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                                    style="height:300px;object-fit:cover;">
                <?php
                } else if ($kategori == 'cemilan') {
                    ?><img src="../assets/images/cemilan-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                                        style="height:300px;object-fit:cover;">
                <?php
                }
                ?>
            </section>
            <div class="container kategori">
                <div class="row align-items-end mb-0 mb-md-4 pt-0 pt-md-5">
                    <div class="col-lg-9 col-md-8">
                        <?php
                        if ($kategori == 'jus') {
                            ?>
                            <h5 class="py-3 mb-0 fs-1">Jus <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                </sup></h5>
                            <p style="font-size: 20px;">Jus merupakan minuman yang sangat menyegarkan. Jus sangat cocok dinikmati saat
                                kapanpun dan dimanapaun</p>
                        <?php
                        } else if ($kategori == 'seafood') {
                            ?>
                                <h5 class="py-3 mb-0 fs-1">Seafood <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                    </sup></h5>
                                <p style="font-size: 20px;">Makanan yang berasal dari laut</p>
                        <?php
                        } else if ($kategori == 'sup') {
                            ?>
                                    <h5 class="py-3 mb-0 fs-1">SUP <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                        </sup></h5>
                                    <p style="font-size: 20px;">Sup makanan yang dapat menghangatkan tubuh</p>
                        <?php
                        } else if ($kategori == 'kue') {
                            ?>
                                        <h5 class="py-3 mb-0 fs-1">Kue <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                            </sup></h5>
                                        <p style="font-size: 20px;">Masakan ringan yang banyak digemari</p>
                        <?php
                        } else if ($kategori == 'dessert') {
                            ?>
                                            <h5 class="py-3 mb-0 fs-1">Dessert <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                                </sup></h5>
                                            <p style="font-size: 20px;">Masakan untuk hidangan penutup</p>
                        <?php
                        } else if ($kategori == 'breakfast') {
                            ?>
                                                <h5 class="py-3 mb-0 fs-1">Breakfast <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                                    </sup></h5>
                                                <p style="font-size: 20px;">Masakan untuk di pagi hari</p>
                        <?php
                        } else if ($kategori == 'daging') {
                            ?>
                                                    <h5 class="py-3 mb-0 fs-1">Daging <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                                        </sup></h5>
                                                    <p style="font-size: 20px;">Masakan yang berasal dari daging hewan</p>
                        <?php
                        } else if ($kategori == 'dinner') {
                            ?>
                                                        <h5 class="py-3 mb-0 fs-1">Dinner <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                                            </sup></h5>
                                                        <p style="font-size: 20px;">Masakan untuk di malam hari</p>
                        <?php
                        } else if ($kategori == 'cemilan') {
                            ?>
                                                            <h5 class="py-3 mb-0 fs-1">Cemilan <sup class="py-3 mb-0 fs-5">
                                <?= $jml_resep["jmlResep"] ?> Resep
                                                                </sup></h5>
                                                            <p style="font-size: 20px;">Masakan yang cocok dimakan saat waktu bersasntai</p>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="sort-control">
                            <span>Urutkan:</span>
                            <select class="form-select urutkan">
                                <option hidden>Pilih Urutkan</option>
                                <option value="terkecil">Resep dari A-Z</option>
                                <option value="terbesar">Resep dari Z-A</option>
                            </select>
                        </div>
                    </div>
                </div>
                <section class="tstbite-components my-4 my-md-5">
                    <div class="row">
                        <?php
                        $db = dbConnect();
                        if ($db->connect_errno == 0) {
                            $kategori = $_GET['kategori'];
                            $res = $db->query("SELECT r.*, u.nama AS nama, u.foto AS fotoUser 
                                    FROM resep r JOIN user u ON r.id_user=u.id_user 
                                    WHERE kategori='$kategori'
                                    ORDER BY r.judul DESC");

                            $data = $res->fetch_all(MYSQLI_ASSOC);
                            if ($res->num_rows > 0) {
                                foreach ($data as $barisData) {
                                    $id_resep = $barisData['id_resep'];
                                    ?>
                                    <div class="col-xl-4 col-md-6 mb-4">
                                        <div class="block">
                                            <a href="detail-resep.php?id_resep=<?= $id_resep ?>" class="text-decoration-none text-dark resep">
                                                <div class="card shadow border-0">
                                                    <div class="inner">
                                                        <img src="../assets/uploads/resep/<?= $barisData["foto"] ?>"
                                                            class="card-img-top img-fluid" alt="Foto Resep"
                                                            style="width: 500px; height: 290px;" />
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-4 judul">
                                                        <?= $barisData["judul"] ?>
                                                        </h5>
                                                        <div class="d-flex justify-content-start">
                                                            <?php
                                                            if ($barisData['fotoUser'] != 'profile-pict.png') {
                                                                ?>
                                                                <img src="../assets/uploads/profile/<?= $barisData["fotoUser"] ?>" alt="Profile"
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
                                                            <?= $barisData["nama"] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <p class="me-3"><i class="bi bi-calendar2"></i>
                                                        <?= $barisData["tanggal"] ?>
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
                        }
                        ?>
                    </div>
                </section>
                <div class="d-grid gap-2 col-2 mx-auto">
                    <div id="load">
                        <button class="btn btn-outline-secondary">Muat Lainnya</button>
                    </div>
                </div>
            </div>
        <?php
    }
} else {
    ?>
    <section class="tstbite-components py-0 text-center">
        <?php
        if ($kategori == 'jus') {
            ?><img src="../assets/images/jus-baner.png" class="w-100 img-fluid" alt="Banner"
                style="height:300px;object-fit:cover;">
            <?php
        } else if ($kategori == 'seafood') {
            ?><img src="../assets/images/seafood-baner.png" class="w-100 img-fluid" alt="Banner"
                    style="height:300px;object-fit:cover;">
            <?php
        } else if ($kategori == 'sup') {
            ?><img src="../assets/images/sup-baner.png" class="w-100 img-fluid" alt="Banner"
                        style="height:300px;object-fit:cover;">
            <?php
        } else if ($kategori == 'kue') {
            ?><img src="../assets/images/kue-baner.jpg" class="w-100 img-fluid" alt="Banner"
                            style="height:300px;object-fit:cover;">
            <?php
        } else if ($kategori == 'dessert') {
            ?><img src="../assets/images/dessert-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                style="height:300px;object-fit:cover;">
            <?php
        } else if ($kategori == 'breakfast') {
            ?><img src="../assets/images/breakfast-baner.png" class="w-100 img-fluid" alt="Banner"
                                    style="height:300px;object-fit:cover;">
            <?php
        } else if ($kategori == 'daging') {
            ?><img src="../assets/images/daging-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                        style="height:300px;object-fit:cover;">
            <?php
        } else if ($kategori == 'dinner') {
            ?><img src="../assets/images/dinner-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                            style="height:300px;object-fit:cover;">
            <?php
        } else if ($kategori == 'cemilan') {
            ?><img src="../assets/images/cemilan-baner.jpg" class="w-100 img-fluid" alt="Banner"
                                                style="height:300px;object-fit:cover;">
            <?php
        }
        ?>
    </section>
    <div class="container kategori">
        <div class="row align-items-end mb-0 mb-md-4 pt-0 pt-md-5">
            <div class="col-lg-9 col-md-8">
                <?php
                if ($kategori == 'jus') {
                    ?>
                    <h5 class="py-3 mb-0 fs-1">Jus <sup class="py-3 mb-0 fs-5">
                            <?= $jml_resep["jmlResep"] ?> Resep
                        </sup></h5>
                    <p style="font-size: 20px;">Jus merupakan minuman yang sangat menyegarkan. Jus sangat cocok dinikmati saat
                        kapanpun dan dimanapaun</p>
                    <?php
                } else if ($kategori == 'seafood') {
                    ?>
                        <h5 class="py-3 mb-0 fs-1">Seafood <sup class="py-3 mb-0 fs-5">
                            <?= $jml_resep["jmlResep"] ?> Resep
                            </sup></h5>
                        <p style="font-size: 20px;">Makanan yang berasal dari laut</p>
                    <?php
                } else if ($kategori == 'sup') {
                    ?>
                            <h5 class="py-3 mb-0 fs-1">SUP <sup class="py-3 mb-0 fs-5">
                            <?= $jml_resep["jmlResep"] ?> Resep
                                </sup></h5>
                            <p style="font-size: 20px;">Sup makanan yang dapat menghangatkan tubuh</p>
                    <?php
                } else if ($kategori == 'kue') {
                    ?>
                                <h5 class="py-3 mb-0 fs-1">Kue <sup class="py-3 mb-0 fs-5">
                            <?= $jml_resep["jmlResep"] ?> Resep
                                    </sup></h5>
                                <p style="font-size: 20px;">Masakan ringan yang banyak digemari</p>
                    <?php
                } else if ($kategori == 'dessert') {
                    ?>
                                    <h5 class="py-3 mb-0 fs-1">Dessert <sup class="py-3 mb-0 fs-5">
                            <?= $jml_resep["jmlResep"] ?> Resep
                                        </sup></h5>
                                    <p style="font-size: 20px;">Masakan untuk hidangan penutup</p>
                    <?php
                } else if ($kategori == 'breakfast') {
                    ?>
                                        <h5 class="py-3 mb-0 fs-1">Breakfast <sup class="py-3 mb-0 fs-5">
                            <?= $jml_resep["jmlResep"] ?> Resep
                                            </sup></h5>
                                        <p style="font-size: 20px;">Masakan untuk di pagi hari</p>
                    <?php
                } else if ($kategori == 'daging') {
                    ?>
                                            <h5 class="py-3 mb-0 fs-1">Daging <sup class="py-3 mb-0 fs-5">
                            <?= $jml_resep["jmlResep"] ?> Resep
                                                </sup></h5>
                                            <p style="font-size: 20px;">Masakan yang berasal dari daging hewan</p>
                    <?php
                } else if ($kategori == 'dinner') {
                    ?>
                                                <h5 class="py-3 mb-0 fs-1">Dinner <sup class="py-3 mb-0 fs-5">
                            <?= $jml_resep["jmlResep"] ?> Resep
                                                    </sup></h5>
                                                <p style="font-size: 20px;">Masakan untuk di malam hari</p>
                    <?php
                } else if ($kategori == 'cemilan') {
                    ?>
                                                    <h5 class="py-3 mb-0 fs-1">Cemilan <sup class="py-3 mb-0 fs-5">
                            <?= $jml_resep["jmlResep"] ?> Resep
                                                        </sup></h5>
                                                    <p style="font-size: 20px;">Masakan yang cocok dimakan saat waktu bersasntai</p>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-3 col-md-4">
                <div class="sort-control">
                    <span>Urutkan:</span>
                    <select class="form-select urutkan">
                        <option hidden>Pilih Urutkan</option>
                        <option value="terkecil">Resep dari A-Z</option>
                        <option value="terbesar">Resep dari Z-A</option>
                    </select>
                </div>
            </div>
        </div>
        <section class="tstbite-components my-4 my-md-5">
            <div class="row">
                <?php
                $db = dbConnect();
                if ($db->connect_errno == 0) {
                    $kategori = $_GET['kategori'];
                    $res = $db->query("SELECT r.*, u.nama AS nama, u.foto AS fotoUser 
                               FROM resep r JOIN user u ON r.id_user=u.id_user 
                               WHERE kategori='$kategori'");

                    $data = $res->fetch_all(MYSQLI_ASSOC);
                    if ($res->num_rows > 0) {
                        foreach ($data as $barisData) {
                            $id_resep = $barisData['id_resep'];
                            ?>
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="block">
                                    <a href="detail-resep.php?id_resep=<?= $id_resep ?>" class="text-decoration-none text-dark resep">
                                        <div class="card shadow border-0">
                                            <div class="inner">
                                                <img src="../assets/uploads/resep/<?= $barisData["foto"] ?>"
                                                    class="card-img-top img-fluid" alt="Foto Resep"
                                                    style="width: 500px; height: 290px;" />
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title mb-4 judul">
                                                    <?= $barisData["judul"] ?>
                                                </h5>
                                                <div class="d-flex justify-content-start">
                                                    <?php
                                                    if ($barisData['fotoUser'] != 'profile-pict.png') {
                                                        ?>
                                                        <img src="../assets/uploads/profile/<?= $barisData["fotoUser"] ?>" alt="Profile"
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
                                                        <?= $barisData["nama"] ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <p class="me-3"><i class="bi bi-calendar2"></i>
                                                    <?= $barisData["tanggal"] ?>
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
                }
                ?>
            </div>
        </section>
        <div class="d-grid gap-2 col-2 mx-auto">
            <div id="load">
                <button class="btn btn-outline-secondary">Muat Lainnya</button>
            </div>
        </div>
    </div>
    </div>
    <?php
}
?>

<?php footer_section(); ?>
<script>
    $(document).ready(function () {
        $('.urutkan').on('change', function () {
            var param = $(this).val();
            var url = '<?php echo "detail-kategori.php?kategori=$kategori"; ?>';
            window.location.href = url + '&sort=' + param + '';
        })
    })
</script>
<script>
    $(document).ready(function () {
        $(".block").slice(0, 6).show();
        if ($(".block:hidden").length != 0) {
            $("#load").show();
        }
        $("#load").on("click", function (e) {
            e.preventDefault();
            $(".block:hidden").slice(0, 3).slideDown();
            if ($(".block:hidden").length == 0) {
                $("#load").text("No More to view")
                    .fadOut("slow");
            }
        });
    })
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>