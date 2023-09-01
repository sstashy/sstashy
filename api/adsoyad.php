<?php
if(!$_POST){
    header("Location:/");
    exit;
}
extract($_POST);
if((empty($ad)&&empty($soyad))||(empty($ad)&&empty($il))){
    die(json_encode(array("status"=>"empty")));
    exit;
}
include("../seotamsin-server/auth-control.php");

// VİP KONTROLÜ AKTİF ETMEK İSTİYORSAN BAŞINDAKİ // KALDIR

// if($seo_member==1){die(json_encode(array("status"=>"vip"))); exit;} 

if($seo_member==1 || $seo_member==2){

    $text="**Sorgu Adı:** Ad Soyad\n";
    $text.="**AD:** $ad\n";
    if($soyad){
        $text.="**SOYAD:** $soyad\n";
    }
    if($il){
        $text.="İL: $il\n";
    }
    if($ilce){
        $text.="İLÇE: $ilce\n";
    }
    include("../seotamsin-server/lxg.php");


    if($seo_cooldown<=$current_date){
        $cooldown=strtotime("+".$config["cooldown"]." seconds", $currentDate);
        $sqlekle="UPDATE `seotamsin-user` SET `seo_cooldown` = \"$cooldown\" WHERE `id` = \"$id\"";
        $sonuc=mysqli_query($conn,$sqlekle);
    }else{
        die(json_encode(array("status"=>"cooldown")));
        exit;
    }
}

$api_conn = new mysqli("localhost", "root", "", "101m");
$sql="SELECT *  FROM `101m` WHERE `ADI` LIKE \"$ad\"";
if($soyad){
    $sql.=" AND `SOYADI` LIKE \"$soyad\"";
}
if($il){
    $sql.="AND `NUFUSIL` LIKE \"$il\"";
}
if($ilce){
    $sql.="AND `NUFUSILCE` LIKE \"$ilce\"";
}
$sonuc= mysqli_query($api_conn,$sql);
$satirsay=mysqli_num_rows($sonuc);
if ($satirsay>0)
{

    $veri="";
    while( $rows=mysqli_fetch_assoc($sonuc) ){
      $veri.= "<tr>
      <td>".$rows["TC"]."</td>
      <td>".$rows["ADI"]."</td>
      <td>".$rows["SOYADI"]."</td>  
      <td>".$rows["DOGUMTARIHI"]."</td>                 
      <td>".$rows["NUFUSIL"]."</td>
      <td>".$rows["NUFUSILCE"]."</td>
      <td>".$rows["ANNEADI"]."</td>
      <td>".$rows["ANNETC"]."</td>
      <td>".$rows["BABAADI"]."</td>
    
      <td>".$rows["BABATC"]."</td>
     
      <td>".$rows["UYRUK"]."</td>
      </tr>";
    }
    
    die(json_encode(array("status"=>"true", "data"=>$veri)));
    exit;
} else{
    die(json_encode(array("status"=>"nodata")));
    exit;
}
?>