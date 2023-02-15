<?php
include '../database.php';
include 'layout.php';
?>
<?php header_section(); ?>
<style>
    .team-circle img {
        width: 200px;
        height: 200px;
        object-fit: cover;
    }
</style>
<div class="container">
    <section class="tstbite-components my-4 my-md-5">
        <h5 class="py-3 mb-3 mb-lg-5 h2 border-bottom border-gray-200"
            style="font-size: 50px;font-family: 'Playfair Display', serif;">Tentang Kami</h5>
        <div class="about-detail">
            <br>
            <h2>HolyCook adalah komunitas dari para pencinta makanan di seluruh dunia untuk
                berbagi resep makanan</h2>
            <br>
            <img src="../assets/images/about.jpg" class="w-100 img-fluid" alt="">
            <br>
            <br>
            <p style="font-size: 20px; line-height: 40px;">HolyCook dibuat atas dasar kecintaan kami terhadap
                makanan yang ada di seluruh dunia.
                HolyCook bertujuan agar para pencinta makanan dapat dengan mudah mencari berbagai macam resep yang ada
                di seluruh dunia, bukan hanya itu
                para pengguna pun dapat berbagi resep yang mereka miliki ke kedalam website ini supaya para pengguna
                dapat memamerkan hasil resep yang telah mereka buat.
            </p>
            <br>
            <div class="row pt-md-5 mt-md-4">
                <div class="col-lg-6 order-2 order-md-0">
                    <h2>Resep yang simpel dan mudah dipahami oleh semua orang</h2>
                    <p style="font-size: 20px; line-height: 40px;">Seringkali seseorang kesulitan dalam membaca
                        ataupun mengikuti sebuah resep yang mereka ikuti. Tetapi
                        di HolyCook ini semua orang dapat dengan mudah memahami dan mengikuti resep yang ada, karena
                        HolyCook dirancang sebaik mungkin supaya semua orang dapat dengan nyaman dan mudah
                        mengikuti resep makanan di HolyCook ini.
                    </p>
                </div>
                <div class="col-lg-6">
                    <img src="../assets/images/aboutfc.jpeg" class="w-100 img-fluid mb-3" alt="Menu"
                        style="height: 300px; object-fit: cover">
                </div>
            </div>
            <br>
            <br>
        </div>
        <div class="mt-4 mt-md-5 pt-3 pt-md-4">
            <h2 class="pr-0 pr-lg-5">Tim produksi website HolyCook</h2>
            <div class="row mt-5">
                <div class="col-xl-2 col-md-3 col-6">
                    <figure class="team-box text-center">
                        <div class="team-circle">
                            <img src="../assets/anggota/salma.jpeg" class="rounded-circle img-thumbnail img-fluid"
                                alt="Team" style="width:200px;height:200px;object-fit:cover">
                        </div>
                        <figcaption class="mt-2 mt-md-3">
                            <h6 class="font-weight-medium font-size-16 inter-font mb-0">Salma Wafa</h6>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-xl-2 col-md-3 col-6">
                    <figure class="team-box text-center">
                        <div class="team-circle">
                            <img src="../assets/anggota/hasbi.jpeg" class="rounded-circle img-thumbnail img-fluid"
                                alt="Team" style="width:200px;height:200px;object-fit:cover">
                        </div>
                        <figcaption class="mt-2 mt-md-3">
                            <h6 class="font-weight-medium font-size-16 inter-font mb-0">Muhammad Hasbi A</h6>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-xl-2 col-md-3 col-6">
                    <figure class="team-box text-center">
                        <div class="team-circle">
                            <img src="../assets/anggota/hilman.jpeg" class="rounded-circle img-thumbnail img-fluid "
                                alt="Team" style="width:200px;height:200px;object-fit:cover">
                        </div>
                        <figcaption class="mt-2 mt-md-3">
                            <h6 class="font-weight-medium font-size-16 inter-font mb-0">Muhammad Hilman R</h6>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-xl-2 col-md-3 col-6">
                    <figure class="team-box text-center">
                        <div class="team-circle">
                            <img src="../assets/anggota/agus.jpeg" class="rounded-circle img-thumbnail img-fluid "
                                alt="Team" style="width:200px;height:200px;object-fit:cover">
                        </div>
                        <figcaption class="mt-2 mt-md-3">
                            <h6 class="font-weight-medium font-size-16 inter-font mb-0">Agustiar Fajar Fadilah</h6>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-xl-2 col-md-3 col-6">
                    <figure class="team-box text-center">
                        <div class="team-circle">
                            <img src="../assets/anggota/fikar.jpeg" class="rounded-circle img-thumbnail img-fluid"
                                alt="Team" style="width:200px;height:200px;object-fit:cover">
                        </div>
                        <figcaption class="mt-2 mt-md-3">
                            <h6 class="font-weight-medium font-size-16 inter-font mb-0">Zulfikar Azizan</h6>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-xl-2 col-md-3 col-6">
                    <figure class="team-box text-center">
                        <div class="team-circle">
                            <img src="../assets/anggota/arby.jpeg" class="rounded-circle img-thumbnail img-fluid "
                                alt="Team" style="width:200px;height:200px;object-fit:cover">
                        </div>
                        <figcaption class="mt-2 mt-md-3">
                            <h6 class="font-weight-medium font-size-16 inter-font mb-0">Arby Febrian S</h6>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>
</div>
<?php footer_section(); ?>