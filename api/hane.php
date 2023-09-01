<?php
if(!$_POST){
    header("Location:/");
    exit;
}
extract($_POST);
if(empty($tc)){
    die(json_encode(array("status"=>"empty")));
    exit;
}

include("../seotamsin-server/auth-control.php");

// VİP KONTROLÜ AKTİF ETMEK İSTİYORSAN BAŞINDAKİ // KALDIR

// if($seo_member==1){die(json_encode(array("status"=>"vip"))); exit;} 

if($seo_member==1 || $seo_member==2){

   
    $text="**Sorgu Adı:** Hane Sorgu \n";
    $text.="**T.C.:** $tc\n";
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

$url= "http://localhost/rohhem-api/rohhem-hane.php?tc=$tc&auth=rohhemamcarootxdserdaryeteryavas";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
curl_close($ch);
$cikti=json_decode($response, true);
error_reporting(0);

$veri="";
if($cikti[0]["TC"]){
    foreach($cikti as $rows){
      $veri.= "<tr>
      <td>".$rows["TC"]."</td>
      <td>".$rows["ADI"]."</td>
      <td>".$rows["SOYADI"]."</td>
      <td>".$rows["CINSIYETI"]."</td>
      <td>".$rows["ANAADI"]."</td>
      <td>".$rows["BABAADI"]."</td>
      <td>".$rows["DOGUMYERI"]."</td>
      <td>".$rows["DOGUMTARIHI"]."</td>
      <td>".$rows["NUFUSILI"]."</td>
      <td>".$rows["NUFUSILCESI"]."</td>
      <td>".$rows["ADRESIL"]."</td>
      <td>".$rows["ADRESILCE"]."</td>
      <td>".$rows["MAHALLE"]."</td>
      <td>".$rows["CADDE"]."</td>
      <td>".$rows["KAPINO"]."</td>
      <td>".$rows["DAIRENO"]."</td>
      </tr>";
    }  
    die(json_encode(array("status"=>"true", "data"=>$veri)));
    exit;
} else{
    die(json_encode(array("status"=>"nodata")));
    exit;
}
?>