<?php
function os() {
    $tespit=$_SERVER['HTTP_USER_AGENT'];
    if(stristr($tespit,"Windows 95")) { $os="Windows 95"; }
    elseif(stristr($tespit,"Windows 98")) { $os="Windows 98"; }
    elseif(stristr($tespit,"Windows NT 5.0")) { $os="Windows 2000"; }
    elseif(stristr($tespit,"Windows NT 5.1")) { $os="Windows XP"; }
    elseif(stristr($tespit,"Windows NT 6.0")) { $os="Windows Vista"; }
    elseif(stristr($tespit,"Windows NT 6.1")) { $os="Windows 7"; }
    elseif(stristr($tespit,"Windows NT 6.2")) { $os="Windows 8"; }
    elseif(stristr($tespit,"Windows NT 10.0")) { $os="Windows 10"; }
    elseif(stristr($tespit,"Windows NT 11.0")) { $os="Windows 11"; }
    elseif(stristr($tespit,"Mac")) { $os="Mac"; }
    elseif(stristr($tespit,"Linux")) { $os="Linux"; }
    else {$os="Diğer";}
    return $os;
}
function browser() {
    $tespit2=$_SERVER['HTTP_USER_AGENT'];
    if(stristr($tespit2,"MSIE")) { $tarayici="Internet Explorer"; }
    elseif(stristr($tespit2,"Firefox")) { $tarayici="Mozilla Firefox"; }
    elseif(stristr($tespit2,"YaBrowser")) { $tarayici="Yandex Browser"; }
    elseif(stristr($tespit2,"Chrome")) { $tarayici="Google Chrome"; }
    elseif(stristr($tespit2,"Safari")) { $tarayici="Safari"; }
    elseif(stristr($tespit2,"Opera")) { $tarayici="Opera"; }
    else {$tarayici="Bilinmiyor ?";}
    return $tarayici;
}
$os =   os();
$browser    =   browser();
$browserdetails =   $_SERVER['HTTP_USER_AGENT'];
$ip =   $_SERVER["REMOTE_ADDR"];;

?>