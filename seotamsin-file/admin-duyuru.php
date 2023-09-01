<?php include("../seotamsin-server/auth-control.php");
if($seo_member!=4):
    header("Location:/dashboard");
    exit;
endif;
if(isset($_GET["id"])):
    $sql="DELETE FROM `seotamsin-duyuru` WHERE `id` = \"".$_GET["id"]."\"";
	$sonuc=mysqli_query($conn,$sql);
endif;
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
                                <li class="breadcrumb-item active" aria-current="page">Duyuru</li>
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
                                <form action="" method="POST" style="text-align:center;">
                                    <div class="col-3" style="display:inline-block;">
                                        <label class="form-label">Başlık Seçin:</label>
                                        <select class="form-select mb-3" name="baslik" aria-label="Başlık Seçiniz"
                                            required>
                                            <option selected="" value="none" disabled>Başlık Seçiniz</option>
                                            <option value="duyuru">Duyuru</option>
                                            <option value="guncelleme">Güncelleme</option>
                                        </select>
                                    </div>
                                    <div class="col-5" style="display:inline-block;">
                                        <label class="form-label">Duyuru Metni:</label>
                                        <input type="text" name="metin" class="form-control" required>
                                    </div>
                                    <div class="col-3" style="display:inline-block;">
                                        <button style="display:inline-block;width:100%" type="submit"
                                            class="btn btn-success">EKLE</button>
                                    </div>
                                </form>
                                <?php 
                                    if(isset($_POST["baslik"])): 
                                        if($_POST["baslik"]!="none"){
                                            extract($_POST);
	                                        $sqlekle="INSERT INTO `seotamsin-duyuru` (`baslik`, `aciklama`, `user_id`) VALUES (\"$baslik\", \"$metin\", \"$id\")";
	                                        $sonuc=mysqli_query($conn,$sqlekle);

	                                        if ($sonuc>0){
                                                echo '
                                                <div class="col-12" style="text-align:center;">
                                                    <p class="btn btn-success" style="margin:0px;">Duyuru Başarıyla Eklendi</p>
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

                                ?>
                                <?php endif;?>
                                <?php if(isset($_GET["id"])): if($sonuc>0):?>
                                <div class="col-12" style="text-align:center;">
                                    <p class="btn btn-success" style="margin:0px;">ID: <?=$_GET["id"]?>, Başarıyla
                                        Silindi</p>
                                </div>
                                <?php endif;endif;?>
                                <div class="table-responsive mt-3">
                                    <table class="table align-middle">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>Başlık</th>
                                                <th>Açıklama</th>
                                                <th>Tarih</th>
                                                <th>Paylaşan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql="SELECT * FROM `seotamsin-duyuru` ORDER BY `tarih` DESC";
                                            $sonuc= mysqli_query($conn,$sql);
                                            $satirsay=mysqli_num_rows($sonuc);
                                            $duyuru=array();
                                            if($satirsay>0){
                                              while( $rows=mysqli_fetch_assoc($sonuc) ){
                                                if($rows["baslik"]=="duyuru"){
                                                  $rows["baslik"]='<span class="badge bg-danger">Duyuru</span>';
                                                }else if($rows["baslik"]=="guncelleme"){
                                                  $rows["baslik"]='<span class="badge bg-primary">Güncelleme</span>';
                                                }
                                                array_push($duyuru,$rows);
                                              }
                                              foreach($duyuru as $rows){
                                                $id=$rows["user_id"];
                                                $sql="SELECT * FROM `seotamsin-user` WHERE id = $id";
                                                $sonuc= mysqli_query($conn,$sql);
                                                $satirsay=mysqli_num_rows($sonuc);
                                                if($satirsay>0){
                                                  while( $row=mysqli_fetch_assoc($sonuc) ){
                                                    $rows["user_id"]=$row["seo_name"];
                                                  }
                                                }else{
                                                  $rows["user_id"]="none";
                                                }
                                                $date = DateTime::createFromFormat('Y-m-d H:i:s', $rows["tarih"]);

$turkish_date_str = $date->format('d F Y H:i');
$rows["tarih"] = str_replace(
    array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
    array('Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'),
    $turkish_date_str
);
                                                echo "
                                                <tr>
                                                  <td>".$rows["baslik"]."</td>
                                                  <td>".$rows["aciklama"]."</td>
                                                  <td>".$rows["tarih"]."</td>
                                                  <td>".$rows["user_id"]."</td>
                                                  <td>
                                                  <a href='admin-duyuru-duzenle?id=".$rows["id"]."' class=\"badge bg-info\"><i  style='font-size:16px;color:#fff;' class=\"fadeIn animated bx bx-pencil\"></i></a>
                                                  <a href='admin-duyuru?id=".$rows["id"]."' class=\"badge bg-danger\"><i  style='font-size:16px;color:#fff;' class=\"fadeIn animated bx bx-trash-alt\"></i></a>
                                                  </td>
                                                  
                                                </tr>
                                                ";
                                              }
                                            }else{
                                              echo "<tr><td colspan='4'>Duyuru Bulunmamaktadır.</td></tr>";
                                            }
                                          ?>
                                        </tbody>
                                    </table>
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
        <!-- Main JS-->
        <script src="assets/js/main.js"></script>


</body>

</html>