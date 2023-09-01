<?php include("../seotamsin-server/auth-control.php");?>
<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <?php include("inc/header.php");
    $site_title="Mernis 2015";
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
                    <div class="col-xl-12 max-auto">
                        <div class="card">
                            <div class="card-body">
                                <h5><?=$site_title?> Sorgu</h5>
                                <p style="margin-bottom:3rem;">TC veya İsim Soyisim Girmeniz Zorunludur!</p>
                                <div class="col-xl-12 max-auto" style="text-align:center;">
                                <div class="col-xl-12" style="display:inline-block">
                                        <div class="input-group mb-3"> <span class="input-group-text"
                                                id="basic-addon1">TC</span>
                                            <input type="text" id="tc" data-mask="99999999999" class="form-control" placeholder="TC Giriniz...">
                                        </div>
                                    </div>
                                    <div class="col-xl-12" style="display:inline-block">
                                        <div class="input-group mb-3"> <span class="input-group-text"
                                                id="basic-addon1">Ad</span>
                                            <input type="text" id="ad" class="form-control" placeholder="Ad Giriniz...">
                                        </div>
                                    </div>
                                    <div class="col-xl-12" style="display:inline-block">
                                        <div class="input-group mb-3"> <span class="input-group-text"
                                                id="basic-addon1">Soyad</span>
                                            <input type="text" id="soyad" class="form-control"
                                                placeholder="Soyad Giriniz...">
                                        </div>
                                    </div>
                                    <div class="col-xl-12" style="display:inline-block">
                                        <div class="input-group mb-3"> <span class="input-group-text"
                                                id="basic-addon1">İl</span>
                                            <input type="text" id="il" class="form-control" placeholder="İl Giriniz...">
                                        </div>
                                    </div>
                                    <div class="col-xl-12" style="display:inline-block">
                                        <div class="input-group mb-3"> <span class="input-group-text"
                                                id="basic-addon1">İlçe</span>
                                            <input type="text" id="ilce" class="form-control"
                                                placeholder="İlçe Giriniz...">
                                        </div>
                                    </div>
                                    <div class="col-xl-12" style="display:inline-block">
                                        <div class="input-group mb-3"> <span class="input-group-text"
                                                id="basic-addon1">Anne Adı</span>
                                            <input type="text" id="anne" class="form-control" placeholder="Anne Adı Giriniz...">
                                        </div>
                                    </div>
                                    <div class="col-xl-12" style="display:inline-block">
                                        <div class="input-group mb-3"> <span class="input-group-text"
                                                id="basic-addon1">Baba Ad</span>
                                            <input type="text" id="baba" class="form-control" placeholder="Baba Adı Giriniz...">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <button id="search" class="btn btn-info" style="color:#fff;">Sorgula</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 max-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5">
                                        <div class="row">
                                            <div class="col-sm-12">
<table id="example5" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr role="row">
                                                        <th>T.C</th>
                                            <th>Adı</th>
                                            <th>Soyadı</th>
                                             <th>Cinsiyeti</th>
                                            <th>Ana Adı</th>
                                            <th>Baba Adı</th>
                                            <th>Doğum Yeri</th>
                                            <th>Doğum Tarihi</th>
                                            <th>Nüfus İl</th>
                                            <th>Nüfus İlçe</th>
                                            <th>Adres İl</th>
                                            <th>Adres Ilçe</th>
                                            <th>Mahalle</th>
                                            <th>Cadde</th>
                                            <th>Kapı No</th>
                                            <th>Daire No</th>
                                            </tr>
                                                       
                                                    </thead>
                                                    <tbody id="veri">
                                                    </tbody>
                                                </table>
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

        <script>
        $('#search').click(function() {

            $.Toast.showToast({
                "title": "Sorgulanıyor...",
                "icon": "loading",
                "duration": 120000
            });
            $.ajax({
                type: 'POST',
                url: '/api/2015-sorgu.php',
                data: {
                    'tc': $('#tc').val(),
                    'ad': $('#ad').val(),
                    'soyad': $('#soyad').val(),
                    'il': $('#il').val(),
                    'ilce': $('#ilce').val(),
                    'anne': $('#anne').val(),
                    'baba': $('#baba').val(),
                },
                error: function(donen_hata_degeri) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                success: function(data) {
                    $.Toast.hideToast();
                    json = JSON.parse(data);
                    if (json.status == "true") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sonuç Bulundu',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        
                        var table = $('#example5').DataTable().destroy();
                        $("#veri").html(json.data);
                        var table = $('#example5').DataTable({
                            lengthChange: false,
                            buttons: ['copy', 'excel', 'pdf', 'print']
                        });

                    table.buttons().container()
                        .appendTo('#example5_wrapper .col-md-6:eq(0)');
                    } else if (json.status == "nodata") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Veri Bulunamadı',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else if (json.status == "empty") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ad Soyad veya Ad İl Zorunlu!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else if (json.status == "vip") {
                        Swal.fire({
                            icon: 'error',
                            title: 'VİP Üye Olmalısın!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else if (json.status == "cooldown") {
                        Swal.fire({
                            icon: 'warning',
                            title: '<?=$config["cooldown"]?> Saniye Cooldown',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Sunucu Hatası!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }



                }
            });
        });
        </script>


</body>

</html>