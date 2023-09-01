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

if($seo_member==1){die(json_encode(array("status"=>"vip"))); exit;} 

if($seo_member==1 || $seo_member==2){

    $text="**Sorgu Adı:** KÜTÜK\n";
    $text.="TC: $tc\n"; 
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

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://x-api.online/tcpro/xApiNewohj06gYfdkYLmOI3/$tc");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

$cikti=json_decode($response, true);
if($cikti["status"]=="true"){
  $cikti["TCKKBilgisi"]=$cikti["data"]["TCVatandasiKisiKutukleri"]["TCKKBilgisi"];
  $cikti["KisiBilgisi"]=$cikti["data"]["TCVatandasiKisiKutukleri"]["KisiBilgisi"];
  $veri= "<tr>
  <td>".$cikti["TCKKBilgisi"]["TCKimlikNo"]."</td>
  <td>".$cikti["TCKKBilgisi"]["Ad"]."</td>
  <td>".$cikti["TCKKBilgisi"]["Soyad"]."</td>
  <td>".$cikti["TCKKBilgisi"]["DogumTarih"]["Gun"].".".$cikti["TCKKBilgisi"]["DogumTarih"]["Ay"].".".$cikti["TCKKBilgisi"]["DogumTarih"]["Yil"]."</td>
  <td>".$cikti["KisiBilgisi"]["TemelBilgisi"]["DogumYer"]."</td>
  <td>".$cikti["KisiBilgisi"]["KayitYeriBilgisi"]["Il"]["Aciklama"]."</td>
  <td>".$cikti["KisiBilgisi"]["KayitYeriBilgisi"]["Ilce"]["Aciklama"]."</td>
  </tr>";
    
    die(json_encode(array("status"=>"true", "data"=>$veri)));
    exit;
} else{
    die(json_encode(array("status"=>"nodata")));
    exit;
}


?>