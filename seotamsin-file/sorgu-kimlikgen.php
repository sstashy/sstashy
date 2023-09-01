<?php include("../seotamsin-server/auth-control.php");?>
<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <link href="assets/veska/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/veska/css/style.min.css" rel="stylesheet">
    <?php include("inc/header.php");
    $site_title="SMSBoomer";
    ?>

    <title><?=$config["title"]?> - <?=$site_title?></title>
</head>

<body>


    <!--start wrapper-->
    <div class="wrapper">
        <?php include("inc/sidebar.php");include("inc/topheader.php");?>
        <!-- start page content wrapper-->
        <div class="page-content-wrapper">
            <!-- start page content-->
            <div class="page-content">

                <!--start breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><?=$site_title?></div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0 align-items-center">
                                <li class="breadcrumb-item"><a href="javascript:;">
                                        <ion-icon name="home-outline"></ion-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page"> <?=$site_title?></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->


                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-3">
                </div>


                <div class="row">
                <style>
                    .bg-primary{
                        background-color: transparent!important;
                        box-shadow:none!important;
                        border:none!important;
                    }
                </style>
                <div class="col-12 mb-30">
                    <div class="box">
                        <div class="box-body">
                            <div class="row mbn-20">
                    <div class="row layout-top-spacing">

                        <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">

                            <div class="card text-white bg-primary rounded shadow mb-4">
                                <div class="card-body">
                                    <div class="h4 mb-2">Nasıl Kullanacağım?</div>
                                    <div class="text-one">Görseller yüksek kaliteli değildir, bundan ötürü direkt olarak
                                        orijinal halinde kullanmanız durumunda diğer sistemler sizin sahtecilik
                                        yaptığınız farkına varabilir. Görselleri indirdikten sonra mockup yaparak
                                        kullanmanızı tavsiye ederim.</div>
                                </div>
                            </div>
                            <div class="card text-white bg-primary rounded shadow mt-4">
                                <div class="card-body">
                                    <form action="#" class="row" id="form">
                                        <div class="col-lg-6">
                                            <div>İsim:</div>
                                            <input class="form-control d-block mt-2 shadow" name="name"
                                                placeholder="Kimlik üzerinde yazacak ismi girin." required>
                                        </div>
                                        <div class="col-lg-6 mt-3 mt-lg-0">
                                            <div>Soyisim:</div>
                                            <input class="form-control d-block mt-2 shadow" name="surname"
                                                placeholder="Kimlik üzerinde yazacak soyismi girin." required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <div>Doğum Tarihi:</div>
                                            <input class="form-control d-block mt-2 shadow" name="birth_date"
                                                type="date" required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <div>Cinsiyet:</div>
                                            <select name="gender" class="form-control d-block mt-2 shadow">
                                                <option value="E / M" option>Erkek</option>
                                                <option value="K / F">Kadın</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <div>T.C. Kimlik No:</div>
                                            <input class="form-control d-block mt-2 shadow" name="tckn"
                                                placeholder="Kimlik üzerinde yazacak TC numarasını girin." required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <div>Seri No:</div>
                                            <input class="form-control d-block mt-2 shadow" name="document_number"
                                                placeholder="Kimlik üzerinde yazacak seri numarasını girin." required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <div>Son Geçerlilik Tarihi:</div>
                                            <input class="form-control d-block mt-2 shadow" name="valid_until"
                                                type="date" required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <div>Uyruk:</div>
                                            <input class="form-control d-block mt-2 shadow" value="T.C./TUR" readonly>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <div>Anne İsmi:</div>
                                            <input class="form-control d-block mt-2 shadow" name="mother_name"
                                                placeholder="Kimlik üzerinde yazacak anne ismini girin." required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <div>Baba Adı:</div>
                                            <input class="form-control d-block mt-2 shadow" name="father_name"
                                                placeholder="Kimlik üzerinde yazacak baba ismini girin." required>
                                        </div>
                                        <div class="col-lg-12 mt-3">
                                            <div>Kimlik Fotoğrafı:</div>
                                            <input class="form-control d-block mt-2 shadow" type="file" name="image"
                                                accept="image/*" required>
                                        </div>
                                        <div class="col-lg-12 mt-4 d-flex">
                                            <div class="flex-grow-1">
                                                <button type="submit" class="btn btn-primary shadow">Kimlik
                                                    Oluştur</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card text-white bg-primary rounded shadow my-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="h4 mb-2">Oluşturulan Kimlik Görselleri</div>
                                        <div class="text-one">Yukarıdaki form aracılığı ile kimlik oluşturduğunuzda
                                            burada gözükecektir.
                                        </div>
                                        <div class="text-two d-none">Oluşturulan kimlik görselleri aşağıda
                                            gösterilmiştir. Butona tıklayarak cihazınıza indirebilirsiniz.</div>
                                        <div class="col-lg-6 mt-3">
                                            <img src="assets/veska/img/front-empty.png" class="front-image mw-100">
                                            <button class="btn btn-primary shadow mt-3" id="download-front"
                                                disabled>Görseli İndir</button>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <img src="assets/veska/img/back-empty.png" class="back-image mw-100">
                                            <button class="btn btn-primary shadow mt-3" id="download-back"
                                                disabled>Görseli İndir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="side-container">
                            <div class="front">
                                <img src="#" class="face">
                                <img src="#" class="face-right">
                                <div class="tckn"></div>
                                <div class="name"></div>
                                <div class="surname"></div>
                                <div class="birth_date"></div>
                                <div class="gender"></div>
                                <div class="document_number"></div>
                                <div class="valid_until"></div>
                            </div>
                            <div class="back">
                                <div class="mother_name"></div>
                                <div class="father_name"></div>
                                <div class="mrz"></div>
                            </div>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <!-- end page content-->
            </div>
            <!--end page content wrapper-->

            <?php include("inc/footer.php");?>
            <a href="javaScript:;" class="back-to-top">
                <ion-icon name="arrow-up-outline"></ion-icon>
            </a>
            <!--End Back To Top Button-->


            <!--start overlay-->
            <div class="overlay"></div>
            <!--end overlay-->

        </div>
        <!--end wrapper-->





        <!-- JS Files-->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
        <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <!--plugins-->
        <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
        <script src="assets/plugins/chartjs/chart.min.js"></script>
        <script src="assets/js/index3.js"></script>

        <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/js/table-datatable.js"></script>
        <!-- Main JS-->
        <script src="assets/js/seooo.js"></script>
        <script src="assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="assets/veska/js/bootstrap.bundle.min.js"></script>
    <script src="assets/veska/js/domtoimage.min.js"></script>
    <script src="assets/veska/js/script.min.js"></script>

</body>

</html>