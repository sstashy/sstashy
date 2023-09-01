<?php
include("../seotamsin-server/db-connect.php");
?>
<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>

    <!--plugins-->
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    
    <link rel="icon" type="image/png" href="<?=$config["logo_url"]?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <title>Giriş Yap - <?=$config["title"]?></title>
</head>

<body style="background:url(../assets/images/banner.png) no-repeat;background-size:cover">


    <!--start wrapper-->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto mt-5" style="margin-top:150px!important;">
                    <div class="card radius-10">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <img src="<?=$config["logo_url"]?>"
                                    style="margin-bottom:15px;" width="200" alt="">
                                <h4>Giriş Yap</h4>
                            </div>
                            <form action="auth-login" method="post" class="form-body row g-3">
                                <div class="col-12">
                                    <label for="key" class="form-label"><b>Nükleer Füze Şifresi:</b></label>
                                    <input type="password" class="form-control" name="auth_key" id="key"
                                        placeholder="Lütfen key giriniz...">
                                </div>
                                <?php if (isset($_GET["kontrol"])): if ($_GET["kontrol"]==0):?>
                                    <div class="col-12" style="text-align:center;">
                                        <p class="btn btn-warning" style="margin:0px;">Key Giriniz!</p>
                                    </div>
                                  <?php endif;if ($_GET["kontrol"]==1):?>
                                    <div class="col-12" style="text-align:center;">
                                        <p class="btn btn-warning" style="margin:0px;">Recaptchayı Doğrulayın!</p>
                                    </div>
                                  <?php endif;if ($_GET["kontrol"]==2):?>
                                    <div class="col-12" style="text-align:center;">
                                        <p class="btn btn-warning" style="margin:0px;">Recaptcha Spam!</p>
                                    </div>
                                  <?php endif;if ($_GET["kontrol"]==3):?>
                                    <div class="col-12" style="text-align:center;">
                                        <p class="btn btn-danger" style="margin:0px;">Key Bulunamadı!</p>
                                    </div>
                                  <?php endif;if ($_GET["kontrol"]==4):?>
                                    <div class="col-12" style="text-align:center;">
                                        <p class="btn btn-warning" style="margin:0px;">Multi Giriş! <br>Her zaman giriş yaptınız tarayıcıyı deneyiniz!</p>
                                    </div>
                                  <?php endif;if ($_GET["kontrol"]==5):?>
                                    <div class="col-12" style="text-align:center;">
                                        <p class="btn btn-danger" style="margin:0px;">Yasaklanmış Kullanıcı!</p>
                                    </div>
                                  <?php endif;if ($_GET["kontrol"]==6):?>
                                    <div class="col-12" style="text-align:center;">
                                        <p class="btn btn-warning" style="margin:0px;">Üyelik Süresi Bitmiş!</p>
                                    </div>
                                  <?php endif;if ($_GET["kontrol"]==10):?>
                                    <div class="col-12" style="text-align:center;">
                                        <p class="btn btn-warning" style="margin:0px;">Girişler Kapalıdır!</p>
                                    </div>
                                  <?php endif;?>
                                <?php endif;?>
                                <div class="col-12 col-lg-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success">Giriş Yap</button>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-12 text-center">
                                    <a href="<?=$config["discord"]?>" class="btn btn-primary w-100"
                                        style="font-weight:bold;margin-bottom:7px;">DISCORD</a>
                                    <a href="<?=$config["telegram"]?>" class="btn btn-secondary w-100"
                                        style="font-weight:bold;">TELEGRAM</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="my-5">
            <div class="container">
                <div class="text-center">
                    <p class="my-4">Copyright © 2023</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
