<?php
include '../database.php';
include 'layout.php';
?>
<?php header_section(); ?>
<style>
    a {
        font-weight: 500;
        /* font-size: 30px; */
        text-decoration: none;
        color: black;
    }

    figure img {
        object-fit: cover;
    }

    figure img{
        transition: all 0.5s ease;
        object-fit: cover;
    }

    figure img:hover {
        transform: scale(1.1);
    }

    figure a:hover {
        color: rgb(255, 94, 0);
    }
</style>
<div class="container">
    <section class="tstbite-components my-4 my-md-5">
        <h5 class="py-3 mb-3 mb-lg-5 h2 border-bottom border-gray-200"
            style="font-size: 50px;font-family: 'Playfair Display', serif;">Kategori</h5>
        <div class="row">
            <div class="col-lg-3 col-md-4 col-6">
                <figure class="my-3 my-md-4 text-center tstbite-card">
                    <a href="detail-kategori.php?kategori=seafood" class="tstbite-animation">
                        <img src="../assets/images/seafood.jpg" class="img-fluid img-thumbnail rounded-circle"
                            alt="Menu" style="width:300px;height:300px">
                            <figcaption class="mt-2 mt-md-3">
                                <label class="tstbite-category-title">Seafood</label>
                            </figcaption>
                    </a>
                </figure>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <figure class="my-3 my-md-4 text-center tstbite-card">
                    <a href="detail-kategori.php?kategori=sup" class="tstbite-animation">
                        <img src="../assets/images/sup.jpg" class="img-fluid img-thumbnail rounded-circle" alt="Menu"
                            style="width:300px;height:300px">
                            <figcaption class="mt-2 mt-md-3">
                                <label class="tstbite-category-title">Sup</label>
                            </figcaption>
                    </a>
                </figure>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <figure class="my-3 my-md-4 text-center tstbite-card">
                    <a href="detail-kategori.php?kategori=kue" class="tstbite-animation">
                        <img src="../assets/images/kue.jpg" class="img-fluid img-thumbnail rounded-circle" alt="Menu"
                            style="width:300px;height:300px">
                            <figcaption class="mt-2 mt-md-3">
                                <label class="tstbite-category-title">Kue</label>
                            </figcaption>
                    </a>
                </figure>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <figure class="my-3 my-md-4 text-center tstbite-card">
                    <a href="detail-kategori.php?kategori=dessert" class="tstbite-animation">
                        <img src="../assets/images/dessert.jpg" class="img-fluid img-thumbnail rounded-circle"
                            alt="Menu" style="width:300px;height:300px">
                            <figcaption class="mt-2 mt-md-3">
                                <label class="tstbite-category-title">Dessert</label>
                            </figcaption>
                    </a>
                </figure>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <figure class="my-3 my-md-4 text-center tstbite-card">
                    <a href="detail-kategori.php?kategori=jus" class="tstbite-animation">
                        <img src="../assets/images/jus.jpg" class="img-fluid img-thumbnail rounded-circle" alt="Menu"
                            style="width:300px;height:300px">
                            <figcaption class="mt-2 mt-md-3">
                                <label class="tstbite-category-title">Jus</label>
                            </figcaption>
                    </a>
                </figure>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <figure class="my-3 my-md-4 text-center tstbite-card">
                    <a href="detail-kategori.php?kategori=breakfast" class="tstbite-animation">
                        <img src="../assets/images/breakfast.jpg" class="img-fluid img-thumbnail rounded-circle"
                            alt="Menu" style="width:300px;height:300px">
                            <figcaption class="mt-2 mt-md-3">
                                <label class="tstbite-category-title">Breakfast</label>
                            </figcaption>
                    </a>
                </figure>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <figure class="my-3 my-md-4 text-center tstbite-card">
                    <a href="detail-kategori.php?kategori=daging" class="tstbite-animation">
                        <img src="../assets/images/daging.jfif" class="img-fluid img-thumbnail rounded-circle"
                            alt="Menu" style="width:300px;height:300px">                   
                            <figcaption class="mt-2 mt-md-3">
                                <label class="tstbite-category-title">Daging</label>
                            </figcaption>
                    </a>
                </figure>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <figure class="my-3 my-md-4 text-center tstbite-card">
                    <a href="detail-kategori.php?kategori=dinner" class="tstbite-animation">
                        <img src="../assets/images/dinner.jpeg" class="img-fluid img-thumbnail rounded-circle"
                            alt="Menu" style="width:300px;height:300px">                    
                            <figcaption class="mt-2 mt-md-3">
                                <label class="tstbite-category-title">Dinner</label>
                            </figcaption>
                    </a>
                </figure>
            </div>
            <div class="col-lg-3 col-md-4 col-6">
                <figure class="my-3 my-md-4 text-center tstbite-card">
                    <a href="detail-kategori.php?kategori=cemilan" class="tstbite-animation">
                        <img src="../assets/images/cemilan.jpg" class="img-fluid img-thumbnail rounded-circle"
                            alt="Menu" style="width:300px;height:300px">                   
                            <figcaption class="mt-2 mt-md-3">
                                <label class="tstbite-category-title">Cemilan</label>
                            </figcaption>
                    </a>
                </figure>
            </div>
    </section>
</div>
</div>
<?php footer_section(); ?>