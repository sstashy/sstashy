<?php
if ($_POST) {
  error_reporting(0);
  include_once("db-connect.php");
  if ($config["login_status"] == 0) {
    header("Location:/login?kontrol=10");
    exit;
  }
  $auth_key = $_POST["auth_key"];
  if ($auth_key == "") {
    header("Location:/login?kontrol=0");
    exit;
  }

  include_once("auth-system.php");
  $sql = "SELECT * FROM `seotamsin-user` WHERE `seo_key` LIKE \"$auth_key\" ";
  $sonuc = mysqli_query($conn, $sql);
  $satirsay = mysqli_num_rows($sonuc);

  if ($satirsay > 0) {
    session_start();
    while ($rows = mysqli_fetch_assoc($sonuc)) {
      extract($rows);
    }
    if ($seo_member == "3" || $seo_member == "4") {

      $_SESSION["auth_key"] = $auth_key;
      header("Location:/dashboard");
      exit;
    }
    if ($seo_end != -1) {
      if ($seo_end <= $current_date) {
        header("Location:/login?kontrol=6");
        exit;
      }
    }
    if ($multi_access == "1") {
      $_SESSION["auth_key"] = $auth_key;
      header("Location:/dashboard");
      exit;
    }
    if ($seo_member == "0") {
      header("Location:/login?kontrol=5");
      exit;
    }
    if ($seo_os == "" || $seo_browser == "" || $seo_browserdetails == "") {

      $sql = "UPDATE `seotamsin-user` SET `seo_os` = \"$os\", `seo_browser` = \"$browser\",  `seo_browserdetails` = \"$browserdetails\" WHERE `id` = \"$id\"";

      $sonuc = mysqli_query($conn, $sql);
      if ($sonuc > 0) {
        $_SESSION["auth_key"] = $auth_key;
        $sqlekle = "INSERT INTO `log` (`member_id`, `detay`, `tarih` ,`durum`) VALUES (\"$id\", \"" . $_SERVER["HTTP_CF_CONNECTING_IP"] . " ip adresi ile giriş yaptı.\", \"" . date("d F Y, l H:i:s") . "\", \"giriş\" )";
        $sonuc = mysqli_query($conn, $sqlekle);
        header("Location:/dashboard");
      } else {
      }
    } else {
      if ($seo_os == $os && $seo_browser == $browser && $seo_browserdetails == $browserdetails) {
        $_SESSION["auth_key"] = $auth_key;

        $sqlekle = "INSERT INTO `log` (`member_id`, `detay`, `tarih` ,`durum`) VALUES (\"$id\", \"" . $_SERVER["HTTP_CF_CONNECTING_IP"] . " ip adresi ile giriş yaptı.\", \"" . date("d F Y, l H:i:s") . "\", \"giriş\" )";
        $sonuc = mysqli_query($conn, $sqlekle);
        header("Location:/dashboard");
      } else {
        header("Location:/login?kontrol=4");
      }
    }
  } else {
    header("Location:/login?kontrol=3");
  }
} else {
  header("Location:/");
}
?>
