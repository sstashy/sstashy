<?php
if(!$_POST){
    header("Location:/");
    exit;
}
extract($_POST);
if(strlen($tc!=11)){
    
if((empty($ad)&&empty($soyad))||(empty($ad)&&empty($il))){
    die(json_encode(array("status"=>"empty")));
    exit;
}
}
include("../seotamsin-server/auth-control.php");

// VİP KONTROLÜ AKTİF ETMEK İSTİYORSAN BAŞINDAKİ // KALDIR

// if($seo_member==1){die(json_encode(array("status"=>"vip"))); exit;} 

if($seo_member==1 || $seo_member==2){


    $text="**Sorgu Adı:** 2015 Sorgu\n";
    if($tc){
        $text.="**T.C.:** $tc\n";
    }else if($ad){
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
        if($anne){
            $text.="ANNE ADI: $anne\n";
        }
        if($baba){
            $text.="BABA ADI: $baba\n";
        }
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

$api_conn = new mysqli("localhost", "root", "", "secmen2015");
if($tc){
    $sql="SELECT *  FROM `secmen2015` WHERE  `TC` LIKE \"$tc\"";
}else if($ad){
    $sql="SELECT *  FROM `secmen2015` WHERE `ADI` LIKE \"$ad\"";
    if($soyad){
        $sql.=" AND `SOYADI` LIKE \"$soyad\"";
    }
    if($il){
        $sql.="AND `NUFUSILI` LIKE \"$il\"";
    }
    if($ilce){
        $sql.="AND `NUFUSILCESI` LIKE \"$ilce\"";
    }
    if($anne){
        $sql.="AND `ANAADI` LIKE \"$anne\"";
    }
    if($baba){
        $sql.="AND `BABAADI` LIKE \"$baba\"";
    }
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