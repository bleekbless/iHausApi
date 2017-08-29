<?php namespace App\Http\Controllers;

use App\Usuario;
use App\Vaga;
use App\Visita;
use App\Consts\Notification;

trait NotificationTrait
{

    function sendMessage($userId, $type)
    {
        if ($type == Notification::NOTIFICATION_APPLIED) {
            $content = array("mensagem" => 'Alguem se interessou na sua vaga. Clique e marque uma visita.');
        } elseif ($type == Notification::NOTIFICATION_APPLY_IS_NEAR) {
            $content = array("en" => 'Fulano tem uma visita marcada na sua república ás tal horas.');
        }
        
        $fields = array(
            'app_id' => env('ONESIGNAL_APP_ID'),
            'include_player_ids' => array($userId),
            'data' => array("foo" => "bar"),
            'contents' => $content
        );
        
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic '.env('ONESIGNAL_AUTH_KEY')));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
}
