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

    $text="**Sorgu Adı:** Detaylı TC\n";
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
curl_setopt($ch, CURLOPT_URL, "https://api.interium.icu/nvi.php?user=OAsJYytPrPfqZH02uodCYVGt3qTnbx&tc=$tc");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);
$response = json_decode($response, true);
error_reporting(0);

if($response && isset($response['data'])){
    $row = $response['data'];
        $veri .= "<tr>
        <td>".$tc."</td>
                    <td>".$row['Ad']."</td>
                    <td>".$row['Soyad']."</td>
                    <td>".$row['DogumTarihi']."</td>
                    <td>".$row['DogumYeri']."</td>
                    <td>".$row['Cinsiyet']."</td>
                    <td>".$row['NufusIl']."</td>
                    <td>".$row['NufusIlce']."</td>
                   
                    <td>".$row['Durum']."</td>
                    <td>".$row['AnneAd']."</td>
                  
                    <td>".$row['BabaAd']."</td>
                   
                    <td>".$row['CiltNo']."</td>
                    <td>".$row['AileSiraNo']."</td>
                    <td>".$row['SiraNo']."</td>
                 
                  </tr>";
    
    die(json_encode(array("status"=>"true", "data"=>$veri)));
    exit;
} else{
    die(json_encode(array("status"=>"nodata")));
    exit;
}
?>