<?php

if($config_password=="öğqpdöğ1293*0*qwdmöğ123"){
    $config=array(
        'domain'=>'localhost',
        'title'=>'Rusha Check',
        'cooldown'=>5,
        'login_status'=>1,
        'db_servername'=>'localhost',
        'db_username'=>'root',
        'db_password'=>'',
        'db_dbname'=>'veritabanı',
        'webhookurl'=>'https://discord.com/api/webhooks/1120333662890754128/87iDO7UrPTJsMzQHO4v22Oo1xvMrAGpULmaeSThGF02LkoPlTm3UgRZxseYaks1bn-QS',
        'logo_url'=>'https://seeklogo.com/images/R/russian-president-putin-image-logo-297C5CFCBF-seeklogo.com.png',
        'discord'=>'https://discord.gg/rusha',
        'telegram'=>'https://telegram.org '
    );

}else{
    header("Location:/");
}