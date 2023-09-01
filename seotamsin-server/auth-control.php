<?php
session_start();
include("db-connect.php");
$auth_key=$_SESSION["auth_key"];
$sql="SELECT * FROM `seotamsin-user` WHERE `seo_key` LIKE \"$auth_key\" ";
                
$sonuc= mysqli_query($conn,$sql);
$satirsay=mysqli_num_rows($sonuc);

if ($satirsay>0)
{
    while( $rows=mysqli_fetch_assoc($sonuc) ){
      extract($rows);
    }
    if($seo_member == 0){
      unset($_SESSION["auth_key"]);
      header("Location:/login?kontrol=5");
      exit;
    }
    if($seo_member == 1){
      $uyelik_turu="PREMIUM";
      $diff_seconds = abs($current_date - $seo_end);
      $kalan_gun = floor($diff_seconds / 86400)." GÜN";
      if($seo_end!=-1){
        if ($seo_end <= $current_date) {
          header("Location:/login?kontrol=6");
          exit;
        }
      }else{
        $kalan_gun="SINIRSIZ";
      }
    }
    if($seo_member == 2){
      $uyelik_turu="VIP";
      $diff_seconds = abs($current_date - $seo_end);
      $kalan_gun = floor($diff_seconds / 86400)." GÜN";
      if($seo_end!=-1){
        if ($seo_end <= $current_date) {
          header("Location:/login?kontrol=6");
          exit;
        }
      }else{
        $kalan_gun="SINIRSIZ";
      }
    }
    if($seo_member == 3){
      $kalan_gun="SINIRSIZ";
      $uyelik_turu="ADMIN";
    }
    if($seo_member == 4){
      $kalan_gun="SINIRSIZ";
      $uyelik_turu="KURUCU";
    }
}else{
    unset($_SESSION["auth_key"]);
    header("Location:/");
    exit;
}
?>