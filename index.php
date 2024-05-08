<?php

/*
https://api.telegram.org/bot7042585454:AAGZz2ZpuvPtsIk7230GU2t_6QJFGI10ryk/setWebHook?url=https://tuoHosting/index.php
*/

//Token
$botToken = "7042585454:AAGZz2ZpuvPtsIk7230GU2t_6QJFGI10ryk";
$website = "https://api.telegram.org/bot".$botToken;

//GetUpdate
$update = file_get_contents('php://input');

$updateraw = $update;

$update = json_decode($update, TRUE);

$chatID = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];
$nome = $update["message"]["chat"]["first_name"];
$cognome = $update["message"]["chat"]["last_name"];
$username = $update["message"]["chat"]["username"];


$myfile = fopen("lastupdate.txt", "w") or die("Unable to open file!");
fwrite($myfile, $updateraw);
fclose($myfile);


switch ($message) {
    case '/ciao':
        InviaMessaggio($chatID,"Ciao");
        break;
    default:
        InviaMessaggio($chatID,"Non capisco cosa vuoi fare");
        break;
}


function InviaMessaggio($chatID,$messaggio)
{
    $url = "$GLOBALS[website]/sendMessage?chat_id=$chatID&parse_mode=HTML&text=".urlencode($messaggio);
    file_get_contents($url);
}