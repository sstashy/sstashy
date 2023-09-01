<?php include("../seotamsin-server/auth-control.php");
if($seo_member!=4):
    header("Location:/dashboard");
    exit;
endif;
if(isset($_GET["id"])){
    
    $sql="SELECT * FROM `seotamsin-duyuru` WHERE `id` LIKE \"".$_GET["id"]."\" ";

    $sonuc= mysqli_query($conn,$sql);
    $satirsay=mysqli_num_rows($sonuc);

    if ($satirsay>0)
    {
        while( $rows=mysqli_fetch_assoc($sonuc) ){
          extract($rows);
        }
    }else{
        header("Location:/admin-duyuru");
        exit;
    }
}else{
    header("Location:/admin-duyuru");
    exit;
}
?>

<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <?php include("inc/header.php");?>

    <title><?=$config["title"]?> - Duyuru</title>
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
                    <div class="breadcrumb-title pe-3">Admin</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0 align-items-center">
                                <li class="breadcrumb-item"><a href="javascript:;">
                                        <ion-icon name="home-outline"></ion-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Duyuru Düzenle</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->


                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-3">
                </div>


                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="mb-5">Duyurular</h5>
                                </div>
                                <?php 
                                    if(isset($_POST["baslik"])): 
                                        if($_POST["baslik"]!="none"){
                                            extract($_POST);
                                            $id=$_GET["id"];
                                            $aciklama=$metin;
                                            $sql="UPDATE `seotamsin-duyuru` SET `baslik` = \"$baslik\", `aciklama` = \"$metin\" WHERE `id` = \"$id\"";
                                            $sonuc=mysqli_query($conn,$sql);
	                                        if ($sonuc>0){
                                                echo '
                                                <div class="col-12" style="text-align:center;">
                                                    <p class="btn btn-success" style="margin:0px;">Güncellendi</p>
                                                </div><br>';
	                                        }else{
                                            echo '
                                                <div class="col-12" style="text-align:center;">
                                                    <p class="btn btn-danger" style="margin:0px;">HATA</p>
                                                </div>';
	                                        }
                                        }else{
                                            echo '
                                            <div class="col-12" style="text-align:center;">
                                                <p class="btn btn-danger" style="margin:0px;">Başlık Seçin</p>
                                            </div>';
                                        }
                                    endif;?>
                                <form action="" method="POST" style="text-align:center;">
                                    <div class="col-3" style="display:inline-block;">
                                        <label class="form-label">Başlık Seçin:</label>
                                        <select class="form-select mb-3" name="baslik" aria-label="Başlık Seçiniz"
                                            required>
                                            <option <?php if($baslik=="duyuru"){echo "selected";}?> value="duyuru">Duyuru</option>
                                            <option <?php if($baslik=="guncelleme"){echo "selected";}?> value="guncelleme">Güncelleme</option>
                                        </select>
                                    </div>
                                    <div class="col-5" style="display:inline-block;">
                                        <label class="form-label">Duyuru Metni:</label>
                                        <input type="text" name="metin" class="form-control" value="<?=$aciklama?>" required>
                                    </div>
                                    <div class="col-3" style="display:inline-block;">
                                        <button style="display:inline-block;width:100%" type="submit"
                                            class="btn btn-primary">DÜZENLE</button>
                                    </div>
                                </form>
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
        <!-- Main JS-->
        <script src="assets/js/main.js"></script>


</body>

</html>