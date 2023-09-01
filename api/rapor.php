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

    $text="**Sorgu Adı:** RAPOR\n";
    $text.="TC: $tc\n"; //yaparım ben ama şöyle bişi var burdan devam et başka bişi var mı eklencek aa dur 
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
curl_setopt($ch, CURLOPT_URL, "https://api.interium.icu/rapor.php?user=4lmmsvpw7lRcbJ3h2gWSu0JFMDONEr&tc=$tc");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);
$response=json_decode($response, true);
error_reporting(0);

if($response['success'] == 'true' && isset($response['raporData'])){
    $rows = $response['raporData'];
    $veri = '';
    foreach($rows as $row) {
        $veri .= "<tr>
        <td>".$tc."</td>
                    <td>".$row['BaslangicTarihi']."</td>
                    <td>".$row['BitisTarihi']."</td>
                    <td>".$row['KayitSekli']."</td>
                    <td>".$row['RaporNo']."</td>
                    <td>".$row['RaporTakipNo']."</td>
                    <td>".$row['Tani']."</td>
                  </tr>";
    }
    die(json_encode(array("status"=>"true", "data"=>$veri)));
    exit;
} else{
    die(json_encode(array("status"=>"nodata")));
    exit;
}
?>