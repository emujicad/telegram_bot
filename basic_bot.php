<?php

ini_set('error_reporting', E_ALL);

$botToken = "TOKEN";
$website = "https://api.telegram.org/bot".$botToken;

$update = file_get_contents('php://input');
//$update = file_get_contents($website."/getupdates");

$update = json_decode($update, TRUE);

$chatId = $update["message"]["chat"]["id"];
print_r("$chatId\n");

$message = $update["message"]["text"];

$last_name = $update["message"]["chat"]["last_name"];

$osname= php_uname();
$host = gethostname();

switch($message) {
	case "/start":
		sendMessage($chatId,"Sr(a): $last_name. Bienvenido");
		break;
	case "/evento":
		sendMessage($chatId,"Proximo evento progamado para el dia DD/MM/YYYY");
		break;
	case "/info":
		sendMessage($chatId,"Sr(a): $last_name. Gracias por contactarnos.\nPuede ubicarnos por https://webpage");
		break;
        case "/osinfo":
                sendMessage($chatId,"Sr(a): $last_name. Se esta comunicando con un bot que interactua con $osname");
                break;
        case "/host":
                sendMessage($chatId,"Sr(a): $last_name. Se esta comunicando con el servidor $host");
                break;
        case "/creditos":
                sendMessage($chatId,"Desarrollado por Ender Mujica - @emujicad");
                break;
        case "/ayuda":
                sendMessage($chatId,"Comandos soportados: \n
				     \t/evento -  Indica si hay algún evento de la comunidad\n
				     \t/info - Indica como contactar en la web\n
				     \t/osinfo - Indica con que sistema operativo esta interactuando\n
				     \t/host - Indica con que servidor esta interactuando\n
				     \t/creditos - Equipo Desarrollador\n
				     \t/ayuda - Muestra los comandos disponibles");
                break;
	default:
		sendMessage($chatId,"Comando no reconocido. Intente con:\n\t /ayuda");
} 

function sendMessage ($chatId, $message) {

	$url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
	file_get_contents($url);
}


// https://api.telegram.org/botTOKEN/setwebhook?url=https://FQDN:PUERTO/basic_bot.php
// curl -F "url=https://FQDN:PUERTO/basic_bot.php" -F "certificate=@/ruta/certificado.crt" https://api.telegram.org/TOKEN/setWebhook
 
?>
