<?php
session_id('rpl2');
session_start();
include '../database.php';
include 'layout.php';

$db = dbConnect();
$id_resep = $_GET['id_resep'];
$sql = "SELECT a.*, b.nama as nama_user, b.foto as fotoUser
        FROM resep as a
        INNER JOIN user as b ON a.id_user = b.id_user
        WHERE a.id_resep = $id_resep";
$res = $db->query($sql);
if ($res) {
    $resep = $res->fetch_assoc();
} else {
    echo $db->error;
}

// Jumlah favorit
$sqlfav = "SELECT COUNT(*) as fav FROM resep_favorit WHERE id_resep ='$id_resep'";
$resfav = $db->query($sqlfav);
$fav = $resfav->fetch_assoc();

// GET ULASAN KOMEN
$sqlkomen = "SELECT a.*, b.nama as nama_user, b.foto as fotoUser 
            FROM ulasan as a 
            INNER JOIN user as b ON a.id_user = b.id_user 
            WHERE a.id_resep = '$id_resep'";
$reskomen = $db->query($sqlkomen);
$datakomen = $reskomen->fetch_all(MYSQLI_ASSOC);

// GET RESEP LAINNYA
$kategori = $resep['kategori'];
$sqllainnya = "SELECT COUNT(*) as jml_fav, b.*, c.nama as nama_user, c.foto as fotoUser FROM resep_favorit as a
                INNER JOIN resep as b ON a.id_resep = b.id_resep
                INNER JOIN user as c ON b.id_user = c.id_user
                WHERE kategori = '$kategori'
                GROUP BY b.judul
                ORDER BY RAND() 
                LIMIT 4";
$reslainnya = $db->query($sqllainnya);
$datalainnya = $reslainnya->fetch_all(MYSQLI_ASSOC);


?>
<?php header_section(); ?>
<style>
    .block {
        display: none;
    }

    #load {
        display: none;
    }
</style>
<div class="container">
    <div>
        <strong>
            <form id="ffav" action="simpan-favorit.php" method="post">
                <?php
                if (isset($_SESSION['id_user'])) {
                    ?>
                    <input type="text" name="id_user" value="<?= $_SESSION['id_user'] ?>">
                    <?php
                }
                ?>
                <input type="hidden" name="id_resep" value="<?= $resep['id_resep'] ?>">
                <span class="fs-3" style="float:right;cursor:pointer" onclick="konfirmasiSimpan()"><i
                        class="bi bi-bookmark"></i></span>
            </form>
        </strong>
        <h1 class="py-3 mb-0">
            <?= $resep['judul'] ?>
        </h1>
    </div>
    <div class="my-2 mr-4">
        <?php
        if ($resep['fotoUser'] != 'profile-pict.png') {
            ?>
            <img src="../assets/uploads/profile/<?= $resep['fotoUser'] ?>" alt="Profile" class="img-fluid rounded-circle"
                style="width: 30px; height: 30px" />
            <?php
        } else {
            ?>
            <img src="../assets/images/<?= $resep['fotoUser'] ?>" alt="Profile" class="img-fluid rounded-circle"
                style="width: 30px; height: 30px" />
            <?php
        }
        ?>

        <small class="ms-1">
            <?= $resep['nama_user'] ?>
        </small>
        <small class="ms-3"><i class="bi bi-calendar2"></i>
            <?= date('d M Y', strtotime($resep['tanggal'])) ?>
        </small>
        <small class="ms-3"><i class="bi bi-heart"></i>
            <?= $fav['fav'] ?>
        </small>
    </div>
    <div class="my-2">
        <hr />
        <p class="text-muted mt-2">
            <span class="fw-semibold">Kategori: </span>
            <span class="badge rounded-pill text-bg-secondary py-2 px-3">
                <?= $resep['kategori'] ?>
            </span>

        </p>
        <p class="text-muted fw-semibold">
            <span class="fw-semibold">Deskripsi: </span>
        </p>
        <p class="text-muted">
            <?= strip_tags($resep['deskripsi']) ?>
        </p>
    </div>
    <div class=" my-4">
        <img src="../assets/uploads/resep/<?= $resep['foto'] ?>" alt="resep" class="img-fluid w-100 rounded" />
    </div>
    <div class="row mt-0">
        <div class="col-md-12">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <small>Lama Memasak</small>
                    <br />
                    <span>
                        <?= $resep['lama_masak'] ?>
                    </span>
                </li>
                <li class="list-inline-item">|</li>
                <li class="list-inline-item">
                    <small>Porsi</small>
                    <br />
                    <span>
                        <?= $resep['porsi'] ?> Orang <i class="bi bi-people"></i>
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>Bahan-Bahan</h2>
            <div class="checklist pb-2">
                <?php
                $jml_bahan = explode(" , ", $resep['bahan']);
                for ($i = 0; $i < count($jml_bahan); $i++) {
                    ?>
                    <div class="recipe-checkbox mt-3 mb-3">
                        <span style="cursor:pointer"><i class="bi bi-circle"></i>
                            <?= $jml_bahan[$i] ?>
                        </span>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="card p-3 w-50">
                <div class="card-body">
                    <h3 class="card-title fw-bold text-center">Kandungan Gizi</h3>
                    <center><small class="text-muted mb-3">*Total gizi sesuai dengan porsi</small></center>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid#bdbdbd">
                        <span class="fw-bold">Kalori</span>
                        <span class="fw-semibold kalori">0</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span class="fw-bold">Lemak Total</span>
                        <span class="fw-semibold lemak-total">0 g</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2 ms-2 mt-2" style="border-top: 1px solid #bdbdbd">
                        <span>Lemak Jenuh</span>
                        <span class="fw-semibold lemak-jenuh">0 g</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2 ms-2 mt-2" style="border-top: 1px solid #bdbdbd">
                        <span>Lemak Trans</span>
                        <span class="fw-semibold lemak-trans">0 g</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid#bdbdbd">
                        <span class="fw-bold">Kolesterol</span>
                        <span class="fw-semibold kolesterol">0 g</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2" style="border-bottom: 1px solid#bdbdbd">
                        <span class="fw-bold">Sodium</span>
                        <span class="fw-semibold sodium">0 g</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span class="fw-bold">Total Karbohidrat</span>
                        <span class="fw-semibold karbohidrat">0 g</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2 ms-2 mt-2" style="border-top: 1px solid #bdbdbd">
                        <span>Serat Makanan</span>
                        <span class="fw-semibold seratmakanan">0 g</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2 ms-2 mt-2" style="border-top: 1px solid #bdbdbd">
                        <span>Jumlah Gula</span>
                        <span class="fw-semibold jumlahgula">0 g</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span class="fw-bold">Protein</span>
                        <span class="fw-semibold protein">0 g</span>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <div class="col-md-6">
            <h2>Langkah-Langkah</h2>
            <ul class="instruction-list list-unstyled">
                <?php
                $string = $resep['langkah'];
                $nomer = explode('<li>', $string);
                for ($i = 1; $i < count($nomer); $i++) {
                    ?>
                    <li class="d-flex justify-content-start mb-3">
                        <i class="bi bi-<?= $i ?>-circle-fill" style="color: #ff642f"></i>
                        <span class="ms-2">
                            <?= $nomer[$i] ?>
                        </span>

                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="row mb-4">
        <h2 class="py-3 mt-5">Resep Lainnya</h2>
        <?php
        foreach ($datalainnya as $barisData) {
            ?>
            <div class="col-md-3 mb-5">
                <a href="detail-resep.php?id_resep=<?= $barisData['id_resep'] ?>"
                    class="text-decoration-none text-dark resep">
                    <div class="card shadow border-0">
                        <div class="inner">
                            <img src="../assets/uploads/resep/<?= $barisData['foto'] ?>" class="card-img-top img-fluid"
                                alt="..." style="width: 100%; height: 200px;" />
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
                            <p class="me-3"><i class="bi bi-heart"></i>
                                <?= $barisData['jml_fav'] ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <?php
        }

        ?>
    </div>
    <h3 class="mb-3">Tulis ulasan terkait resep</h3>
    <form action="simpan-ulasan.php" method="post">
        <input type="hidden" name="id_resep" value="<?= $resep['id_resep'] ?>">
        <div class="form-group">
            <textarea name="isi" class="form-control w-100 mb-3" rows="10" placeholder="Isi jika ingin memberi ulasan!"
                required></textarea>
            <div class="d-flex justify-content-end me-3 mb-2">
                <button type="submit" name="submit" class="btn btn-primary btnOren mb-5"
                    style="background:#ff642b;border:none;">Kirim
                    Ulasan</button>
            </div>
        </div>
    </form>
    <div style="border: 3px solid #ff642b" class="mb-5"></div>
    <?php
    $sqlcount = "SELECT COUNT(*) as jml_ulasan FROM ulasan WHERE id_resep = '$id_resep'";
    $rescount = $db->query($sqlcount);
    $jml_ulasan = $rescount->fetch_assoc();
    ?>
    <h3 class="mb-3">Ulasan
        <span class="fs-4 ms-1">
            (
            <?= $jml_ulasan['jml_ulasan'] ?>)
        </span>
    </h3>
    <hr>
    <!-- Komen -->
    <?php
    foreach ($datakomen as $row) {
        ?>
        <div class="block">
            <div class="d-flex justify-content-start">
                <div>
                    <?php
                    if ($row['fotoUser'] != 'profile-pict.png') {
                        ?>
                        <img src="../assets/uploads/profile/<?= $row['fotoUser'] ?>" alt="user" class="img-fluid rounded-circle"
                            style="width:48px;height:48px;object-fit:cover">
                        <?php
                    } else {
                        ?>
                        <img src="../assets/images/<?= $row['fotoUser'] ?>" alt="user" class="img-fluid rounded-circle"
                            style="width:48px;height:48px;object-fit:cover">
                        <?php
                    }
                    ?>

                </div>
                <div class="ms-3">
                    <span class="fw-bold d-block">
                        <?= $row['nama_user'] ?>
                    </span>
                    <span class="d-block text-muted mb-2">
                        <?= date('d M Y', strtotime($row['tanggal'])) ?>
                    </span>
                    <p>
                        <?= $row['isi'] ?>
                    </p>
                </div>
            </div>
            <hr>
        </div>
        <?php
    }
    ?>
    <!-- End komen -->

    <!-- Load More -->
    <div class="d-flex justify-content-center mt-5">
        <!-- <div class="btn btn-loadmore rounded-4 px-5 py-2" id="#load-more">
                    <strong>Load More</strong>
                </div> -->
        <div id="load">
            <button class="btn btn-outline-secondary">Muat Lainnya</button>
        </div>
    </div>
</div>
<!-- FOOTER -->
<?php footer_section(); ?>
<!-- ALERT -->
<?php
if (isset($_GET['sukses'])) {
    $sukses = $_GET['sukses'];
    if ($sukses == 'simpan') {
        echo '<script>Swal.fire("Informasi", "Resep berhasil disimpan", "success")</script>';
    } else if ($sukses == 'ulasan') {
        echo '<script>Swal.fire("Informasi", "Ulasan berhasil disimpan", "success")</script>';
    }
}

if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == 'adaresep') {
        echo '<script>Swal.fire("Informasi", "Resep sudah disimpan", "error")</script>';
    }
}
?>
<!-- END ALER -->
<script>
    function konfirmasiSimpan() {
        event.preventDefault();
        var form = $('#ffav');
        Swal.fire({
            icon: "question",
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menyimpan resep?",
            showCancelButton: true,
            confirmButtonText: "Simpan",
            cancelButtonText: "Batal",
            confirmButtonColor: "#ff642b",
        }).then((result) => {
            if (result.value) {
                // Swal.fire("Informasi", "Resep berhasil disimpan", "success");
                form.submit();
            } else {
                Swal.fire("Informasi", "Resep batal disimpan", "error");
            }
        });
    }

    $(document).ready(function () {
        // Langkah2

        // END OF LANGKAH
        // GIZI
        // Convert JSON String to JavaScript Object
        var JSONString = '<?= $resep['gizi'] ?>';

        var JSONObject = JSON.parse(JSONString);
        // console.log(JSONObject);      // Dump all data of the Object in the console
        // var tes = Object.keys(JSONObject).map((key) => [JSONObject[key]]);
        var tes = Object.keys(JSONObject).map((key) => JSONObject[key]);
        console.log(tes);

        // NUTRISI/GIZI
        // Kalori
        var kalori = Math.round(tes[0]["quantity"] * 10) / 10;
        var kalori_unit = tes[0]["unit"];
        $('.kalori').text(kalori + " " + kalori_unit);
        // Lemak
        var lemak_total = Math.round(tes[1]["quantity"] * 10) / 10;
        var lemak_total_unit = tes[1]["unit"];
        $('.lemak-total').text(lemak_total + " " + lemak_total_unit);
        var lemak_jenuh = Math.round(tes[2]["quantity"] * 10) / 10;
        var lemak_jenuh_unit = tes[2]["unit"];
        $('.lemak-jenuh').text(lemak_jenuh + " " + lemak_jenuh_unit);
        var lemak_trans = Math.round(tes[3]["quantity"] * 10) / 10;
        var lemak_trans_unit = tes[3]["unit"];
        $('.lemak-trans').text(lemak_trans + " " + lemak_trans_unit);
        // Kolesterol
        var kolesterol = Math.round(tes[12]["quantity"] * 10) / 10;
        var kolesterol_unit = tes[12]["unit"];
        $('.kolesterol').text(kolesterol + " " + kolesterol_unit);
        // Sodium
        var sodium = Math.round(tes[13]["quantity"] * 10) / 10;
        var sodium_unit = tes[13]["unit"];
        $('.sodium').text(sodium + " " + sodium_unit);
        // total karbohidrat
        var karbohidrat = Math.round(tes[6]["quantity"] * 10) / 10;
        var karbohidrat_unit = tes[6]["unit"];
        $('.karbohidrat').text(karbohidrat + " " + karbohidrat_unit);
        // serat makanan
        var seratmakanan = Math.round(tes[8]["quantity"] * 10) / 10;
        var seratmakanan_unit = tes[8]["unit"];
        $('.seratmakanan').text(seratmakanan + " " + seratmakanan_unit);
        // jumlah gula
        var jumlahgula = Math.round(tes[9]["quantity"] * 10) / 10;
        var jumlahgula_unit = tes[9]["unit"];
        $('.jumlahgula').text(jumlahgula + " " + jumlahgula_unit);
        // protein
        var protein = Math.round(tes[11]["quantity"] * 10) / 10;
        var protein_unit = tes[11]["unit"];
        $('.protein').text(protein + " " + protein_unit);

        // Komen$(document).ready(function () {
        $(".block").slice(0, 1).show();
        if ($(".block:hidden").length != 0) {
            $("#load").show();
        }
        $("#load").on("click", function (e) {
            e.preventDefault();
            $(".block:hidden").slice(0, 3).slideDown();
            if ($(".block:hidden").length == 0) {
                $("#load").text("Tidak ada data lagi")
                    .fadOut("slow");
            }
        });
    })
</script>