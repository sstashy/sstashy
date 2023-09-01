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

    $text="**Sorgu Adı:** AOL\n";
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

$search=array("key"=>"90fcea2ff14406fc72aa603a79d17716387a1b40", "auth"=>"aol", "tc"=>$tc);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://x/index.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$search);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$cikti=json_decode($response, true);
if($cikti["status"]=="true"){
  $veri= "<tr>
  <td>".$cikti["data"]["ADI"]."</td>
  <td>".$cikti["data"]["SOYADI"]."</td>
  <td>".$cikti["data"]["ANNEADI"]."</td>
  <td>".$cikti["data"]["BABAADI"]."</td>
  <td>".$cikti["data"]["OKUL"]."</td>
  <td>".$cikti["data"]["OGRENCINO"]."</td>
  </tr>";
  $vesika=$cikti["data"]["VESIKA"];
    
    die(json_encode(array("status"=>"true", "data"=>$veri, "vesika"=>$vesika)));
    exit;
} else{
    die(json_encode(array("status"=>"nodata")));
    exit;
}
?>