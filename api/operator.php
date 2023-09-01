<?php
if(!$_POST){
    header("Location:/");
    exit;
}
extract($_POST);
if(empty($phone)){
    die(json_encode(array("status"=>"empty")));
    exit;
}
if(strlen($phone)!=14){
    die(json_encode(array("status"=>"format")));
    exit;
}
include("../seotamsin-server/auth-control.php");

// VİP KONTROLÜ AKTİF ETMEK İSTİYORSAN BAŞINDAKİ // KALDIR

// if($seo_member==1){die(json_encode(array("status"=>"vip"))); exit;} 

if($seo_member==1 || $seo_member==2){

    $text="**Sorgu Adı:** ÖPERATÖR\n";
    $text.="GSM: $phone\n"; //yaparım ben ama şöyle bişi var burdan devam et başka bişi var mı eklencek aa dur 
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

$phone=str_replace(" ", "", $phone);
$phone=str_replace("-", "", $phone);
$phone=str_replace(")", "", $phone);
$phone=str_replace("(", "", $phone);
$TurkTelekom = ["501", "505", "506","507","552","553","554","555","559"];
$TurkCell = ["530","531","532","533","534","535", "536", "537", "538", "539"];
$Vodafone = ["541", "542", "543", "544", "545", "546", "547", "548", "549"];
$abone_numarasi = substr($phone, 0, 3);
// Operatör kontrolü
if ( in_array($abone_numarasi, $TurkTelekom)){
    $operatör = "TürkTelekom";
}elseif( in_array($abone_numarasi, $TurkCell)){
    $operatör = "Turkcell";
}elseif ( in_array($abone_numarasi, $Vodafone) ) {
    $operatör = "Vodafone";
}elseif( $abone_numarasi == "551"){
    $operatör = "BimCell Sanal operaötürü | TürkTelekom";
}elseif( $abone_numarasi == "516"){
    $operatör = "Bursa mobile | Turkcell";
}elseif( $abone_numarasi == "561"){
    $operatör = "61cell | Turkcell";
}else{
    $operatör=false;
}

if($operatör!=false){
  
  $veri= "<tr>
  <td>".$phone."</td>
  <td>".$operatör."</td>

        </tr>";
    
    die(json_encode(array("status"=>"true", "data"=>$veri)));
    exit;
} else{
    die(json_encode(array("status"=>"nodata")));
    exit;
}
?>