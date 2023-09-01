<?php

$text.="**Kullanıcı:** $seo_name\n";
$text.="**Tarih:** ".date("d-m-Y H:i");
$json_data = json_encode([
    "content" => "$text",
    "username" => "Rusha.WTF",
    "tts" => false

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );


$ch = curl_init( $config["webhookurl"] );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );
curl_close( $ch );

?>