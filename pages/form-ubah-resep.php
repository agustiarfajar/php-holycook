<?php
session_id('rpl2');
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
}
include '../database.php';
include 'layout.php';
$db = dbConnect();

$id_resep = $_GET['id_resep'];

$query_resep = "SELECT * FROM resep WHERE id_resep='$id_resep'";
$res_resep = mysqli_query($db, $query_resep);
$resep = $res_resep->fetch_assoc();
?>
<?php header_section(); ?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="profile.php">Profil</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="resep-saya.php">Resep Saya</a></li>
            <li class="breadcrumb-item" aria-current="page">Ubah</li>
        </ol>
    </nav>
    <h3>Ubah Resep</h3>
    <?php
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Oops!</strong>
            Terjadi Kesalahan:
            <?php
            if ($error == 'input') {
                ?>
                <p class="mt-3">
                    <?= $_SESSION["errorinput"] ?>
                </p>
                <?php
            } else if ($error == 'foto') {
                ?>
                    <p class="mt-3">
                        Foto wajib diupload.
                    </p>
                <?php
            } else if ($error == 'judul') {
                ?>
                        <p class="mt-3">
                            Judul telah ada, silahkan gunakan judul yang lain.
                        </p>
                <?php
            }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
    }
    ?>
    <form id="formUbah" action="resep-update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_resep" value="<?= $resep['id_resep'] ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 mb-3">
                    <div class="card-body">
                        <div class="col-12">
                            <label for="" class="control-label fw-semibold">Foto</label>
                            <?php
                            if ($resep['foto'] == null || $resep['foto'] == "") {
                                ?>
                                <img src="../assets/images/1.jpeg" id="foto" class="img-fluid img-thumbnail"
                                    style="width:100%;object-fit:cover;object-position:50% 50%">
                                <?php
                            } else {
                                ?>
                                <img src="../assets/uploads/resep/<?= $resep['foto'] ?>" id="foto"
                                    class="img-fluid img-thumbnail"
                                    style="width:100%;object-fit:cover;object-position:50% 50%">
                                <?php
                            }
                            ?>

                            <p id="nama-foto" class="text-center"></p>
                            <label for="file-upload" class="btn btn-primary w-100 btnOren"><i class="bi bi-camera"></i>
                                Tambahkan Foto Resep</label>
                            <input type="file" name="foto" accept=".jpeg,.jpg,.png" id="file-upload"
                                class="form-control" style="display:none">
                        </div>
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="judul" class="control-label fw-semibold">Judul Resep</label>
                                <input type="text" id="judul" name="judul" class="form-control"
                                    placeholder="Judul: Sup Ayam Keluarga" value="<?= $resep['judul'] ?>"
                                    autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label for="kategori" class="control-label fw-semibold">Kategori Resep</label>
                                <select name="kategori" id="kategori" class="form-select">
                                    <option hidden>- Pilih Kategori -</option>
                                    <option value="seafood" <?php echo ($resep['kategori'] == 'seafood' ? 'selected' : '') ?>>Seafood</option>
                                    <option value="sup" <?php echo ($resep['kategori'] == 'sup' ? 'selected' : '') ?>>
                                        Sup</option>
                                    <option value="jus" <?php echo ($resep['kategori'] == 'jus' ? 'selected' : '') ?>>
                                        Jus</option>
                                    <option value="kue" <?php echo ($resep['kategori'] == 'kue' ? 'selected' : '') ?>>
                                        Kue</option>
                                    <option value="dessert" <?php echo ($resep['kategori'] == 'dessert' ? 'selected' : '') ?>>Dessert</option>
                                    <option value="daging" <?php echo ($resep['kategori'] == 'daging' ? 'selected' : '') ?>>Daging</option>
                                    <option value="breakfast" <?php echo ($resep['kategori'] == 'breakfast' ? 'selected' : '') ?>>Breakfast</option>
                                    <option value="cemilan" <?php echo ($resep['kategori'] == 'cemilan' ? 'selected' : '') ?>>Cemilan</option>
                                    <option value="dinner" <?php echo ($resep['kategori'] == 'dinner' ? 'selected' : '') ?>>Dinner</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="deskripsi" class="control-label fw-semibold">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi"><?= $resep['deskripsi'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="porsi" class="control-label fw-semibold">Porsi</label>
                                <input type="text" id="porsi" name="porsi" class="form-control" placeholder="2 Orang"
                                    value="<?= $resep['porsi'] ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="lama_masak" class="control-label fw-semibold">Lama Memasak</label>
                                <input type="text" id="lama_masak" name="lama_masak" class="form-control"
                                    placeholder="1 Jam 30 Menit" value="<?= $resep['lama_masak'] ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 mb-3">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="container-bahan">
                                <?php
                                $jml_bahan = explode(" , ", $resep['bahan']);
                                for ($i = 0; $i < count($jml_bahan); $i++) {
                                    ?>
                                    <div class="form-group fg-bahan mb-3">
                                        <label for="bahan" class="control-label fw-semibold">Bahan</label>
                                        <input class="form-control input-bahan bahan" name="bahan[]"
                                            placeholder="1 sendok gula" value="<?= $jml_bahan[$i] ?>">
                                    </div>
                                    <?php
                                }
                                ?>

                                <button type="button" class="btn btn-primary btnOren" id="addButton"><i
                                        class="bi bi-clipboard-plus"></i> Tambah Bahan </button>
                                <button type="button" class="btn btn-outline-danger" id="removeButton"><i
                                        class="bi bi-trash"></i> Hapus Bahan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-0">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="" class="control-label fw-semibold">Langkah-langkah Pembuatan</label>
                                <textarea id="langkah" name="langkah"><?= $resep['langkah'] ?></textarea>
                                <input type="hidden" class="nutrisi" name="gizi">
                            </div>
                            <button type="button" class="btn btn-primary w-100" id="btnUbah"><i
                                    class="bi bi-pencil-square"></i>
                                Ubah
                                Resep</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php footer_section(); ?>
<script>
    $(document).ready(function () {
        $('#deskripsi').summernote();
        $('#langkah').summernote();

        var $container = $('.container-bahan');
        var $row = $('.fg-bahan');
        var $jumlahRow = $row.length;
        $row = $row.slice($jumlahRow - 1);
        var $add = $('#addButton');
        var $remove = $('#removeButton');
        var $focused;

        $container.on('click', '.input-bahan', function () {
            $focused = $(this);
        });

        $add.on('click', function () {
            var $newRow = $row.clone().insertAfter('.fg-bahan:last');
            $newRow.find('.input-bahan').each(function () {
                this.value = '';
            });
        });

        $remove.on('click', function () {
            if (!$focused) {
                alert('Pilih bahan yang ingin dihapus (klik kolom masukan)');
                return;
            }

            var $currentRow = $focused.closest('.fg-bahan');
            if ($currentRow.index() === 0) {
                // don't remove first row
                alert("Tidak bisa menghapus pada baris pertama");
            } else {
                $currentRow.remove();
                $focused = null;
            }
        });

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
        // END of image preview    
    });

    // UBAH
    $('#btnUbah').on('click', function () {
        const bahan = [];
        var inputs = $('.bahan');
        for (var i = 0; i < inputs.length; i++) {
            bahan.push($(inputs[i]).val());
        }

        let ingredients = bahan?.map((d) => (d))
        $.ajax({
            url: "translate.php",    //the page containing php script
            type: "post",    //request type,
            dataType: 'json',
            data: {
                bahan: JSON.stringify(ingredients),
            },
            success: function (result) {
                let params = new URLSearchParams({
                    app_id: 'f443991a',
                    app_key: 'c55d2efe306402c031117d325a7d422d'
                });

                fetch(`https://api.edamam.com/api/nutrition-details?${params}`, {
                    headers: { 'Content-Type': 'application/json; charset=utf8' },
                    method: 'POST',
                    body: JSON.stringify({
                        ingr: result
                    })
                })
                    .then(response => response.json())
                    .then(response => $('.nutrisi').val(JSON.stringify(response.totalNutrients)))
                    .then(konfirmasiUbah());
            }
        });
    });

    function konfirmasiUbah() {
        // event.preventDefault();
        var form = $('#formUbah');
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
                form.submit();
            } else {
                Swal.fire("Informasi", "Data batal diubah", "error");
            }
        });
    }
</script>