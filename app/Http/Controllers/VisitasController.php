<?php namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Consts\Notification;

class VisitasController extends Controller
{

    const MODEL = "App\Visita";

    use RESTActions, NotificationTrait;


    public function checkNextVisits()
    {
        $model = $this::MODEL;

        $nextVisits = $model::where('date', '=', Carbon::now()->subHour())->get();

        try {
            $nextVisits->each(function ($visit, $key) {
                $user = $visit->usuario();
                $vaga = $visit->vaga();

                $status = $this->sendMessage($user->notificationToken, Notification::NOTIFICATION_APPLY_IS_NEAR);

                if($status) {
                    $visit->delete();
                }
            });

            $this->respond(Response::HTTP_OK, ['message' => 'Successfully sent message.']);
        } catch (Exception $error) {
            $this->respond(Response::HTTP_INTERNAL_SERVER_ERROR, ['message' => 'Message was not sent.']);
        }
    }
}
