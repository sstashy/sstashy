<?php include("../seotamsin-server/auth-control.php");
if($seo_member==0||$seo_member==1||$seo_member==2):
    header("Location:/dashboard");
    exit;
endif;

if(isset($_GET["id"])){
    if(isset($_GET["multiban"])){
        $sqlekle="UPDATE `seotamsin-user` SET `seo_os` = \"\", `seo_browser` = \"\", `seo_browserdetails` = \"\" WHERE `id` = \"$id\"";
        $sonuc=mysqli_query($conn,$sqlekle);
        
                                                
    $text="Multi Ban Kaldırma\n";
    $text.="Kişi: $seo_name\n";
    include("../seotamsin-server/lxg.php");
    }
    $sql="SELECT * FROM `seotamsin-user` WHERE `id` LIKE \"".$_GET["id"]."\" ";

    $sonuc= mysqli_query($conn,$sql);
    $satirsay=mysqli_num_rows($sonuc);

    if ($satirsay>0)
    {
        while( $rows=mysqli_fetch_assoc($sonuc) ){
            if($seo_member!=4){
                
            if($rows["user_id"]!=$id){
                header("Location:/admin-uye");
                exit;

            }
            }
            $me_member=$seo_member;
            $me_name=$seo_name;
          extract($rows);
          $user_name=$seo_name;
          $user_member=$seo_member;
          $seo_member=$me_member;
          $seo_name=$me_name;
          if($user_member==4){
            if($seo_name!="admin"){
                header("Location:/admin-uye");
                exit;
            }
          }
        }
        if($seo_end!=-1){
      $diff_seconds = abs($current_date - $seo_end);
      $kalan_gun = floor($diff_seconds / 86400);
    }
    }else{
        header("Location:/admin-uye");
        exit;
    }
}else{
    header("Location:/admin-uye");
    exit;
}
?>

<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <?php include("inc/header.php");?>

    <title><?=$config["title"]?> - Üye Düzenle</title>
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
                                <li class="breadcrumb-item active" aria-current="page">Üye Düzenle</li>
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
                                    <h5 class="mb-5">Üyeler</h5>
                                </div>
                                
                                <?php 
                                    if(isset($_POST["member"])): 
                                        if(isset($_POST["update"])){
                                            if($_POST["member"]!="none"){
                                                if($me_member==3){
                                                    if($_POST["member"]==3||$_POST["member"]==4){
                                                        header("Location:/admin-uye");
                                                        exit;
                                                    }
                                                }
                                                extract($_POST);
                                                if($kalan_gun!=$gun){
                                                    $kalan_gun=$gun;
                                                    $gun=strtotime('+'.$gun.' days');
                                                }else{
                                                    $gun=$seo_end;
                                                }
                                                $multi_access=$multi;
                                                $user_member=$member;
                                                $user_name=$name;
	                                            $sqlekle="UPDATE `seotamsin-user` SET `seo_name` = \"$name\", `seo_member` = \"$member\", `seo_end` = \"$gun\", `multi_access` = \"$multi\" WHERE `id` = \"$id\"";
	                                            $sonuc=mysqli_query($conn,$sqlekle);

	                                            if ($sonuc>0){
                                                        
    $text="Üye Güncelleme\n";
    $text.="Üye: $name\n";
    $text.="ID: $id\n";
    $text.="Kişi: $seo_name\n";
    include("../seotamsin-server/lxg.php");
                                                    echo '
                                                    <div class="col-12" style="text-align:center;">
                                                        <p class="btn btn-success" style="user-select: auto;margin:0px;">Başarıyla Güncellendi</p>
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
                                                    <p class="btn btn-danger" style="margin:0px;">Üyelik Türü Seçin</p>
                                                </div>';
                                            }
                                            
                                        }else if (isset($_POST["multiban"])){
                                            $seo_os="";
                                            $seo_browser="";
                                            $seo_browserdetails="";
                                            $sqlekle="UPDATE `seotamsin-user` SET `seo_os` = \"\", `seo_browser` = \"\", `seo_browserdetails` = \"\" WHERE `id` = \"$id\"";
                                            $sonuc=mysqli_query($conn,$sqlekle);
                                            if ($sonuc>0){
                                                echo '
                                                <div class="col-12" style="text-align:center;">
                                                    <p class="btn btn-success" style="user-select: auto;margin:0px;">Başarıyla Multi Ban Kalktı</p>
                                                </div><br>';
                                            }else{
                                            echo '
                                                <div class="col-12" style="text-align:center;">
                                                    <p class="btn btn-danger" style="margin:0px;">HATA</p>
                                                </div>';
                                            }
                                        }else if (isset($_POST["ban"])){
                                            if($user_member!=0){
                                                        
                                                $text="Ban Atıldı\n";
                                                $text.="ID: $id\n";
                                                $text.="Kişi: $seo_name\n";
                                                include("../seotamsin-server/lxg.php");
                                                $user_member=0;
                                            }else{
                                                $text="Ban Açıldı\n";
                                                $text.="ID: $id\n";
                                                $text.="Kişi: $seo_name\n";
                                                include("../seotamsin-server/lxg.php");
                                                $user_member=1;
                                            }
                                            $sqlekle="UPDATE `seotamsin-user` SET `seo_member` = \"$user_member\" WHERE `id` = \"$id\"";
                                            $sonuc=mysqli_query($conn,$sqlekle);
                                            if ($sonuc>0){
                                                if($user_member==0){
                                                    echo '
                                                    <div class="col-12" style="text-align:center;">
                                                        <p class="btn btn-warning" style="user-select: auto;margin:0px;">Başarıyla Ban Atıldı</p>
                                                    </div><br>';
                                                }else{
                                                    echo '
                                                    <div class="col-12" style="text-align:center;">
                                                        <p class="btn btn-primary" style="user-select: auto;margin:0px;">Başarıyla Ban AÇILDI</p>
                                                    </div><br>';
                                                }
                                            }else{
                                            echo '
                                                <div class="col-12" style="text-align:center;">
                                                    <p class="btn btn-danger" style="margin:0px;">HATA</p>
                                                </div>';
                                            }
                                        }
                                    endif;

                                ?>
                                <form action="" method="POST" style="text-align:center;">
                                    <div class="col" style="display:inline-block;">
                                        <label class="form-label">Üyelik Türü Seçiniz</label>
                                        <select class="form-select mb-3" name="member" aria-label="Üyelik Türü Seçiniz"
                                            required>
                                            <option  <?php if($user_member==0){echo "selected";}?> value="0">YASAKLI</option>
                                            <option  <?php if($user_member==1){echo "selected";}?> value="1">PREMİUM</option>
                                            <option  <?php if($user_member==2){echo "selected";}?> value="2">VİP</option>
                                            <?php if($me_member==4):?>
                                            <option  <?php if($user_member==3){echo "selected";}?> value="3">ADMİN</option>
                                            <option  <?php if($user_member==4){echo "selected";}?> value="4">KURUCU</option>
                                            <?php endif;?>
                                        </select>
                                    </div>
                                    <div class="col" style="display:inline-block;">
                                        <label class="form-label">Üyelik İsmi</label>
                                        <input type="text" name="name" class="form-control" value="<?=$user_name?>" required>
                                    </div>
                                    <div class="col" style="display:inline-block;">
                                        <label class="form-label">Kaç Gün (Sınırsız: -1)</label>
                                        <input type="number" name="gun" value="<?=$kalan_gun?>" class="form-control" required>
                                    </div>
                                    <div class="col" style="display:inline-block;">
                                        <label class="form-label">Multi Giriş İzni</label>
                                        <select class="form-select mb-3" name="multi" aria-label="Multi Access"
                                            required>
                                            <option <?php if($multi_access==1){echo "selected";}?>value="1">AÇIK</option>
                                            <option <?php if($multi_access==0){echo "selected";}?> value="0">KAPALI</option>
                                        </select>
                                    </div>
                                    <div class="col" style="display:inline-block;">
                                        <button style="display:inline-block;width:100%" type="submit"
                                            class="btn btn-primary" name="update">GÜNCELLE</button>
                                    </div>
                                    <div class="col" style="display:inline-block;">
                                        <button style="display:inline-block;width:100%" type="submit"
                                            class="btn btn-secondary" name="multiban">MULTİ BAN AÇ</button>
                                    </div>
                                    <?php
                                        
                                        if($user_member!=0){
                                            echo '
                                            <div class="col" style="display:inline-block;">
                                                <button style="display:inline-block;width:100%" type="submit"
                                                    class="btn btn-danger" name="ban">BAN AT</button>
                                            </div>';
                                        }else{
                                            echo '
                                            <div class="col" style="display:inline-block;">
                                                <button style="display:inline-block;width:100%" type="submit"
                                                    class="btn btn-warning" name="ban">BAN KALDIR</button>
                                            </div>';
                                        }
                                    ?>
                                </form>
                                <div class="table-responsive mt-3">
                                    <table class="table align-middle" style="text-align:center;">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>İşletim Sistemi</th>
                                                <th>Tarayıcı</th>
                                                <th>Tarayıcı Detay</th>
                                                <th>Key</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?=$seo_os?></td>
                                                <td><?=$seo_browser?></td>
                                                <td><?=$seo_browserdetails?></td>
                                                <td><?=$seo_key?></td>
                                            </tr>
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