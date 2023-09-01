<?php include("../seotamsin-server/auth-control.php");?>
<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <?php include("inc/header.php");?>

    <title><?=$config["title"]?> - Dashboard</title>
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
                    <div class="breadcrumb-title pe-3">Dashboard</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0 align-items-center">
                                <li class="breadcrumb-item"><a href="javascript:;">
                                        <ion-icon name="home-outline"></ion-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!--end breadcrumb-->


                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-3">
                </div>


                <div class="row">
                    <div class="col-12 col-lg-12 col-xl-12">
                        <div class="card radius-10">
                            <div class="row g-0 align-items-center" style="text-align:center;">
                                <div class="col-md-4">
                                    <div class="p-3">
                                        <img src="<?=$config["logo_url"]?>" width="128" class="img-fluid radius-10"
                                            alt="...">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h2 class="card-title"><?=$config["title"]?>'e Hoşgeldin, <?=$seo_name?></h2>
                                        <p class="card-text" style="font-size:16px;">
                                            <b>Discord Adresimiz:</b> <a
                                                href="<?=$config["discord"]?>"><?=$config["discord"]?></a><br>
                                            <b>Telegram Adresimiz:</b> <a
                                                href="<?=$config["telegram"]?>"><?=$config["telegram"]?></a>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-12 col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <h5 class="mb-0">Duyurular</h5>
                                            </div>
                                            <div class="table-responsive mt-3">
                                                <table class="table align-middle">
                                                    <thead class="table-secondary">
                                                        <tr>
                                                            <th>Başlık</th>
                                                            <th>Açıklama</th>
                                                            <th>Tarih</th>
                                                            <th>Paylaşan</th>
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
                                
                    <div class="col-12 col-lg-12 col-xl-6" style="text-align:center;">
                        <div class="col" style="text-align:center;">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="align-items-center" style="display:inline-block;">
                                        <div class="widget-icon-2 bg-gradient-success text-white">
                                            <i class="lni lni-alarm-clock"></i>
                                        </div>
                                    </div>
                                    <h5 class="my-3">Kalan Gün</h5>
                                    <p class="mb-0 mt-2"><?=$kalan_gun?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col" style="text-align:center;">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="align-items-center" style="display:inline-block;">
                                        <div class="widget-icon-2 bg-gradient-purple text-white">
                                            <i class="lni lni-coin"></i>
                                        </div>
                                    </div>
                                    <h5 class="my-3">Üyelik Tipi</h5>
                                    <p class="mb-0 mt-2"><?=$uyelik_turu?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12 col-xl-6" style="text-align:center;">
                        <?php
                        $sql="SELECT * FROM `seotamsin-user`";
                        $sonuc= mysqli_query($conn,$sql);
                        $satirsay=mysqli_num_rows($sonuc);
                        $members=array(
                          'toplam_member'=>0,
                          'premium_member'=>0,
                          'vip_member'=>0,
                          'admin_member'=>0,
                          'kurucu_member'=>0,
                        );
                        while( $rows=mysqli_fetch_assoc($sonuc) ){
                          $members['toplam_member']++;
                          if($rows["seo_member"]==1){
                            $members['premium_member']++;
                          }
                          if($rows["seo_member"]==2){
                            $members['vip_member']++;
                          }
                          if($rows["seo_member"]==3){
                            $members['admin_member']++;
                          }
                          if($rows["seo_member"]==4){
                            $members['kurucu_member']++;
                          }
                        }
                      ?>
                        <div class="col-5" style="display: inline-block;text-align:center;">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="align-items-center" style="display:inline-block;">
                                        <div class="widget-icon-2 bg-gradient-success text-white">
                                            <i class="fadeIn animated bx bx-user"></i>
                                        </div>
                                    </div>
                                    <h5 class="my-3">Toplam Kullanıcı</h5>
                                    <p class="mb-0 mt-2" style="font-size:23px;">
                                        <?=$members['toplam_member']-$members['kurucu_member']?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-5" style="display: inline-block;text-align:center;">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="align-items-center" style="display:inline-block;">
                                        <div class="widget-icon-2 bg-gradient-purple text-white">
                                            <i class="fadeIn animated bx bx-user"></i>
                                        </div>
                                    </div>
                                    <h5 class="my-3">Toplam Admin</h5>
                                    <p class="mb-0 mt-2" style="font-size:23px;"><?=$members['admin_member']?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-5" style="display: inline-block;text-align:center;">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="align-items-center" style="display:inline-block;">
                                        <div class="widget-icon-2 bg-gradient-danger text-white">
                                            <i class="fadeIn animated bx bx-user"></i>
                                        </div>
                                    </div>
                                    <h5 class="my-3">Toplam Vip</h5>
                                    <p class="mb-0 mt-2" style="font-size:23px;"><?=$members['vip_member']?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-5" style="display: inline-block;text-align:center;">
                            <div class="card radius-10">
                                <div class="card-body">
                                    <div class="align-items-center" style="display:inline-block;">
                                        <div class="widget-icon-2 bg-gradient-warning text-white">
                                            <i class="fadeIn animated bx bx-user"></i>
                                        </div>
                                    </div>
                                    <h5 class="my-3">Toplam Premium</h5>
                                    <p class="mb-0 mt-2" style="font-size:23px;"><?=$members['premium_member']?></p>
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
        <!-- Main JS-->
        <script src="assets/js/main.js"></script>


</body>

</html>