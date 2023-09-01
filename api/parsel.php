<?php
if(!$_POST){
    header("Location:/");
    exit;
}
extract($_POST);
if(empty($zeminid)){
    die(json_encode(array("status"=>"empty")));
    exit;
}
include("../seotamsin-server/auth-control.php");

// VİP KONTROLÜ AKTİF ETMEK İSTİYORSAN BAŞINDAKİ // KALDIR

// if($seo_member==1){die(json_encode(array("status"=>"vip"))); exit;} 

if($seo_member==1 || $seo_member==2){

    $text="**Sorgu Adı:** PARSEL\n";
    $text.="İD: $zeminid\n"; //yaparım ben ama şöyle bişi var burdan devam et başka bişi var mı eklencek aa dur 
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
curl_setopt($ch, CURLOPT_URL, "https://cbsapi.tkgm.gov.tr/megsiswebapi.v3/api/zemin//$zeminid");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json, text/javascript, */*; q=0.01, */*','Accept-Encoding: gzip, deflate, br','Accept-Language: tr','Connection: keep-alive','Host: cbsapi.tkgm.gov.tr',
    'Referer: https://parselsorgu.tkgm.gov.tr/','Sec-Fetch-Dest: empty','Sec-Fetch-Mode: cors','Sec-Fetch-Site: same-site',

));
$response = curl_exec($ch);
curl_close($ch);
$response = json_decode($response, true);
error_reporting(0);

if (isset($response["properties"])) {
  $properties = $response["properties"];
  $bagimsizBolum = json_decode($properties["bagimsizBolum"], true);
  
  $veri= "<tr>
            <td>".$zeminid."</td>
            <td>".$properties["ilAd"]."</td>
            <td>".$properties["ilceAd"]."</td>
            <td>".$properties["mahalleAd"]."</td>
            <td>".$properties["adaNo"]."</td>
            <td>".$bagimsizBolum["properties"]["no"]."</td>
            <td>".$properties["alan"]."</td>
            <td>".$properties["zeminKmdurum"]."</td>
            <td>".$bagimsizBolum["properties"]["giris"]."</td>
            <td>".$bagimsizBolum["properties"]["blok"]."</td>
            <td>".$bagimsizBolum["properties"]["kat"]."</td>
            <td>".$bagimsizBolum["properties"]["nitelik"]."</td>
            <td>".$properties["parselNo"]."</td>
            <td>".$properties["pafta"]."</td>
        </tr>";
    
    die(json_encode(array("status"=>"true", "data"=>$veri)));
    exit;
} else{
    die(json_encode(array("status"=>"nodata")));
    exit;
}
?>