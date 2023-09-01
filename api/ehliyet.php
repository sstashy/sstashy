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
if(strlen($tc)!=11){
    die(json_encode(array("status"=>"format")));
    exit;
}
include("../seotamsin-server/auth-control.php");

// VİP KONTROLÜ AKTİF ETMEK İSTİYORSAN BAŞINDAKİ // KALDIR

// if($seo_member==1){die(json_encode(array("status"=>"vip"))); exit;} 

if($seo_member==1 || $seo_member==2){

    $text="**Sorgu Adı:** E-OKUL\n";
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

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://x-api.online/ehliyet/xApiNewcUdJJp3jBOP9J5Sj/$tc");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$cikti=json_decode($response, true);
if($cikti["status"]=="true"){
  $vesika=$cikti["data"]["vesika"];
    
    die(json_encode(array("status"=>"true","vesika"=>$vesika)));
    exit;
} else{
    die(json_encode(array("status"=>"nodata")));
    exit;
}
?>