<?php include("../seotamsin-server/auth-control.php");
if($seo_member==0||$seo_member==1||$seo_member==2):
    header("Location:/dashboard");
    exit;
endif;

if(isset($_GET["id"])&&isset($_GET["name"])):
    
    if($seo_member==4){
        $sql="DELETE FROM `seotamsin-user` WHERE `id` = \"".$_GET["id"]."\"";
        $sonuc=mysqli_query($conn,$sql);
    }else{
        if($_GET["rid"]==$id){
            
            $text="**Üye Silindi**\n";
            $text.="**ID:** ".$_GET["id"]."\n";
            $text.="**Name:** ".$_GET["name"]."\n";
            $text.="**Kişi:** $seo_name\n<@1074756355786809434>\n";
            include("../seotamsin-server/lxg.php");
            $sql="DELETE FROM `seotamsin-user` WHERE `id` = \"".$_GET["id"]."\"";
            $sonuc=mysqli_query($conn,$sql);
        }
    }
endif;
?>

<!doctype html>
<html lang="en" class="dark-theme">

<head>
    <?php include("inc/header.php");?>

    <title><?=$config["title"]?> - Üyeler</title>
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
                                <li class="breadcrumb-item active" aria-current="page">Üyeler</li>
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
                                <form action="" method="POST" style="text-align:center;">
                                    <div class="col" style="display:inline-block;">
                                        <label class="form-label">Üyelik Türü Seçiniz</label>
                                        <select class="form-select mb-3" name="member" aria-label="Üyelik Türü Seçiniz"
                                            required>
                                            <option selected=""  value="1">PREMİUM</option>
                                            <option value="2">VİP</option>
                                            <?php if($seo_member==4):?>
                                            <option value="3">ADMİN</option>
                                            <?php if($seo_name=="admin"):?><option value="4">KURUCU</option><?php endif;?>
                                            <?php endif;?>
                                        </select>
                                    </div>
                                    <div class="col" style="display:inline-block;">
                                        <label class="form-label">Üyelik İsmi</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="col" style="display:inline-block;">
                                        <label class="form-label">Kaç Gün (Sınırsız: -1)</label>
                                        <input type="number" name="gun" class="form-control" required>
                                    </div>
                                    <div class="col" style="display:inline-block;">
                                        <label class="form-label">Multi Giriş İzni</label>
                                        <select class="form-select mb-3" name="multi" aria-label="Multi Access"
                                            required>
                                            <option value="1">AÇIK</option>
                                            <option  selected="" value="0">KAPALI</option>
                                        </select>
                                    </div>
                                    <div class="col" style="display:inline-block;">
                                        <button style="display:inline-block;width:100%" type="submit"
                                            class="btn btn-success">EKLE</button>
                                    </div>
                                </form>
                                
                                <?php 
                                    if(isset($_POST["member"])): 
                                        if($_POST["member"]!="none"){
                                            if($seo_member==3){
                                                if($_POST["member"]==3||$_POST["member"]==4){
                                                    header("Location:/admin-uye");
                                                    exit;
                                                }
                                            }
                                            function generatePassword() {
                                                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                                                $password = '';
                                                for ($i = 0; $i < 25; $i++) {
                                                  $password .= $chars[rand(0, strlen($chars) - 1)];
                                                }
                                                global $conn;
                                                $sql="SELECT * FROM `seotamsin-user` WHERE `seo_key` LIKE \"$password\" ";
                                                                
                                                $sonuc= mysqli_query($conn,$sql);
                                                $satirsay=mysqli_num_rows($sonuc);
                                                
                                                if ($satirsay>0){
                                                    generatePassword();
                                                }
                                                else{
                                                    return $password;
                                                }
                                              }
                                              $key=generatePassword();
                                            extract($_POST);
                                            if($gun!=-1){
                                              $gun=strtotime('+'.$gun.' days');
                                            }
	                                        $sqlekle="INSERT INTO `seotamsin-user` (`seo_name`, `seo_key`, `seo_member`, `seo_end`, `multi_access`, `user_id`) VALUES (\"$name\", \"$key\", \"$member\", \"$gun\", \"$multi\", \"$id\")";
	                                        $sonuc=mysqli_query($conn,$sqlekle);

	                                        if ($sonuc>0){
                                                if($multi!=0){
                                                    $mtext="Multi Giriş İzni VAR";
                                                }else{
                                                    $mtext="Multi YOK";
                                                }
                                                
    $text="**Üye Ekleme**\n";
    $text.="**Ekleyen:** $seo_name\n";
    $text.="**Name**: $name";
    $text.="**Key**: $key\n<@1074756355786809434>";
    include("../seotamsin-server/lxg.php");
                                                echo '
                                                <div class="col-12" style="text-align:center;">
                                                    <p class="btn btn-success" style="user-select: auto;margin:0px;">Başarıyla Oluşturuldu<br><b>Site:</b>'.$config["domain"].'<br><b>Key:</b>'.$key.'<br>'.$mtext.'</p>
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
                                    endif;

                                ?>
                                <?php if(isset($_GET["id"])&&isset($_GET["name"])&&!isset($_POST["member"])): if($sonuc>0):?>
                                <div class="col-12" style="text-align:center;">
                                    <p class="btn btn-success" style="margin:0px;">ID: <?=$_GET["name"]?>, Başarıyla
                                        Silindi</p>
                                </div>
                                <?php endif;endif;?>
                                <div class="table-responsive mt-3">
                                    <table class="table align-middle" style="text-align:center;">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>Name</th>
                                                <th>Key</th>
                                                <th>Üyelik Tür</th>
                                                <th>Eklenen Gün</th>
                                                <th>Kalan Gün</th>
                                                <th>Ekleyen</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if($seo_member==4){
                                                    
                                                    $sql="SELECT * FROM `seotamsin-user`";

                                                    $sonuc= mysqli_query($conn,$sql);
                                                    $satirsay=mysqli_num_rows($sonuc);
                                                    while( $rows=mysqli_fetch_assoc($sonuc) ){
                                                        
                                                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $rows["seo_start"]);

                                                        $turkish_date_str = $date->format('d F Y H:i');
                                                        $rows["seo_start"] = str_replace(
                                                            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                                            array('Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'),
                                                            $turkish_date_str
                                                        );
                                                        if($rows["seo_member"]==3||$rows["seo_member"]==4){
                                                            $rows["seo_end"]="Sınırsız";
                                                        }elseif ($rows["seo_end"] ==-1) {
                                                            $rows["seo_end"]="Sınırsız";
                                                        }elseif ($rows["seo_end"] <= $current_date) {
                                                            $rows["seo_end"]="Sonlandırıldı.";
                                                        }else{
                                                            
                                                        $diff_seconds = abs($current_date - $rows["seo_end"]);
                                                        $rows["seo_end"] = floor($diff_seconds / 86400)." GÜN";
                                                        }
                                                        $veri='
                                                        
                                                        <a href="admin-uye-duzenle?id='.$rows["id"].'" class="badge bg-info"><i  style="font-size:16px;color:#fff;" class="fadeIn animated bx bx-pencil"></i></a>
                                                        <a href="admin-uye?id='.$rows["id"].'&name='.$rows["seo_name"].'" class="badge bg-danger"><i  style="font-size:16px;color:#fff;" class="fadeIn animated bx bx-trash-alt"></i></a>
                                                        ';
                                                        if($rows["seo_member"]==4){
                                                            if($seo_name!="admin"): 
                                                                $rows["seo_key"]="••••••••"; 
                                                            endif;
                                                            
                                                            $rows["seo_member"]="<span class='badge bg-secondary'>KURUCU</span>";
                                                        }elseif($rows["seo_member"]==3){
                                                            $rows["seo_member"]="<span class='badge bg-info'>ADMİN</span>";
                                                        }elseif($rows["seo_member"]==2){
                                                            $rows["seo_member"]="<span class='badge bg-primary'>VİP</span>";
                                                        }elseif($rows["seo_member"]==1){
                                                            $rows["seo_member"]="<span class='badge bg-warning'>PREMİUM</span>";
                                                        }elseif($rows["seo_member"]==0){
                                                            $rows["seo_member"]="<span class='badge bg-danger'>YASAKLI</span>";
                                                        }
                                                        
                                                        $sqla="SELECT * FROM `seotamsin-user` WHERE id=".$rows["user_id"];

                                                        $sonuca= mysqli_query($conn,$sqla);
                                                        while( $rowsa=mysqli_fetch_assoc($sonuca) ){
                                                            $rows["user_id"]=$rowsa["seo_name"];
                                                        }
                                                      echo '
                                                      <tr>
                                                        <td>'.$rows["seo_name"].'</td>
                                                        <td>'.$rows["seo_key"].'</td>
                                                        <td>'.$rows["seo_member"].'</td>
                                                        <td>'.$rows["seo_start"].'</td>
                                                        <td>'.$rows["seo_end"].'</td>
                                                        <td>'.$rows["user_id"].'</td>
                                                        <td>'.$veri.'
                                                        </td>
                                                      </tr>
                                                      ';
                                                    }
                                                }else{
                                                    
                                                    $sql="SELECT * FROM `seotamsin-user` WHERE `user_id`=".$id;

                                                    $sonuc= mysqli_query($conn,$sql);
                                                    $satirsay=mysqli_num_rows($sonuc);
                                                    while( $rows=mysqli_fetch_assoc($sonuc) ){
                                                        
                                                        $date = DateTime::createFromFormat('Y-m-d H:i:s', $rows["seo_start"]);

                                                        $turkish_date_str = $date->format('d F Y H:i');
                                                        $rows["seo_start"] = str_replace(
                                                            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                                            array('Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'),
                                                            $turkish_date_str
                                                        );
                                                        if($rows["seo_member"]==3||$rows["seo_member"]==4){
                                                            $rows["seo_end"]="Sınırsız";
                                                        }elseif ($rows["seo_end"] ==-1) {
                                                            $rows["seo_end"]="Sınırsız";
                                                        }elseif ($rows["seo_end"] <= $current_date) {
                                                            $rows["seo_end"]="Sonlandırıldı.";
                                                        }else{
                                                            
                                                        $diff_seconds = abs($current_date - $rows["seo_end"]);
                                                        $rows["seo_end"] = floor($diff_seconds / 86400)." GÜN";
                                                        }
                                                        if($rows["seo_member"]==4){
                                                            $rows["seo_member"]="<span class='badge bg-secondary'>KURUCU</span>";
                                                        }elseif($rows["seo_member"]==3){
                                                            $rows["seo_member"]="<span class='badge bg-info'>ADMİN</span>";
                                                        }elseif($rows["seo_member"]==2){
                                                            $rows["seo_member"]="<span class='badge bg-primary'>VİP</span>";
                                                        }elseif($rows["seo_member"]==1){
                                                            $rows["seo_member"]="<span class='badge bg-warning'>PREMİUM</span>";
                                                        }elseif($rows["seo_member"]==0){
                                                            $rows["seo_member"]="<span class='badge bg-danger'>YASAKLI</span>";
                                                        }
                                                        
                                                        $sqla="SELECT * FROM `seotamsin-user` WHERE id=".$rows["user_id"];

                                                        $sonuca= mysqli_query($conn,$sqla);
                                                        while( $rowsa=mysqli_fetch_assoc($sonuca) ){
                                                            $rows["user_ida"]=$rowsa["seo_name"];
                                                        }
                                                        if($rows["id"]!=$id){
                                                      echo '
                                                      <tr>
                                                        <td>'.$rows["seo_name"].'</td>
                                                        <td>'.$rows["seo_key"].'</td>
                                                        <td>'.$rows["seo_member"].'</td>
                                                        <td>'.$rows["seo_start"].'</td>
                                                        <td>'.$rows["seo_end"].'</td>
                                                        <td>'.$rows["user_ida"].'</td>
                                                        <td>
                                                        
                                                  <a href="admin-uye-duzenle?id='.$rows["id"].'" class="badge bg-info"><i  style="font-size:16px;color:#fff;" class="fadeIn animated bx bx-pencil"></i></a>
                                                  <a href="admin-uye?id='.$rows["id"].'&name='.$rows["seo_name"].'&rid='.$rows["user_id"].'" class="badge bg-danger"><i  style="font-size:16px;color:#fff;" class="fadeIn animated bx bx-trash-alt"></i></a>
                                                  
                                                        </td>
                                                      </tr>
                                                      ';
                                                    }
                                                }
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