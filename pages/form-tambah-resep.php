<?php
session_id('rpl2');
session_start();
if (!isset($_SESSION["Login"])) {
    header("Location: login.php");
}
include '../database.php';
include 'layout.php';
?>
<?php header_section(); ?>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="profile.php">Profil</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="resep-saya.php">Resep Saya</a></li>
            <li class="breadcrumb-item" aria-current="page">Buat</li>
        </ol>
    </nav>
    <h3>Buat Resep</h3>
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
    <form name="fsimpan" id="formSimpan" action="resep-save.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 mb-3">
                    <div class="card-body">
                        <div class="col-12">
                            <label for="" class="control-label fw-semibold">Foto</label>
                            <img src="../assets/images/add-pict.png" id="foto" class="img-fluid img-thumbnail"
                                style="width:100%;object-fit:cover;object-position:50% 50%">
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
                                    placeholder="Judul: Sup Ayam Keluarga" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label for="kategori" class="control-label fw-semibold">Kategori Resep</label>
                                <select name="kategori" id="kategori" class="form-select">
                                    <option hidden>- Pilih Kategori -</option>
                                    <option value="seafood">Seafood</option>
                                    <option value="sup">Sup</option>
                                    <option value="jus">Jus</option>
                                    <option value="kue">Kue</option>
                                    <option value="dessert">Dessert</option>
                                    <option value="daging">Daging</option>
                                    <option value="breakfast">Breakfast</option>
                                    <option value="cemilan">Cemilan</option>
                                    <option value="dinner">Dinner</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="deskripsi" class="control-label fw-semibold">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="porsi" class="control-label fw-semibold">Porsi</label>
                                <input type="number" min="1" id="porsi" name="porsi" class="form-control"
                                    placeholder="2 Orang" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="lama_masak" class="control-label fw-semibold">Lama Memasak</label>
                                <input type="text" id="lama_masak" name="lama_masak" class="form-control"
                                    placeholder="1 Jam 30 Menit" autocomplete="off">
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
                                <div class="form-group fg-bahan mb-3">
                                    <label for="bahan" class="control-label fw-semibold">Bahan</label>
                                    <input class="form-control input-bahan bahan" name="bahan[]"
                                        placeholder="1 sendok gula">
                                </div>

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
                                <textarea id="langkah" name="langkah"></textarea>
                            </div>
                            <input type="hidden" class="nutrisi" name="gizi">
                            <button type="button" id="btnSimpan" class="btn btn-success w-100" name="simpan"><i
                                    class="bi bi-save"></i> Simpan
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

        // SIMPAN
        $('#btnSimpan').on('click', function () {
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
                        .then(konfirmasiSimpan());
                }
            });
        });
    });

    function konfirmasiSimpan() {
        // event.preventDefault();
        var form = $('#formSimpan');
        Swal.fire({
            icon: "question",
            title: "Konfirmasi",
            text: "Apakah anda yakin ingin menyimpan data?",
            showCancelButton: true,
            confirmButtonText: "Simpan",
            cancelButtonText: "Batal",
            confirmButtonColor: "#ff642b",
        }).then((result) => {
            if (result.value) {
                form.submit();
            } else {
                Swal.fire("Informasi", "Data batal disimpan", "error");
            }
        });
    }
</script>