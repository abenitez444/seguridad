<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AlertTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notificar a los usuarios las tareas vencidas y por vencer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $users = \DB::table('users')->where('is_admin', '0')->count();
        $users = \DB::table('users')->where('is_active', '1')->get();
        $date = Carbon::now('America/Bogota');
        foreach ($users as $user) {
            $residential = \DB::table('residential')->where('users_id', $user->id)->first();
            if (!is_null($residential)) {
                $alerts = \DB::table('task')->where('users_id', $user->id)->where('is_active', '1')->where('status', 'En Proceso')->get();
                $vencidas = [];
                $por_vencer = [];

                foreach ($alerts as $task) {
                    $task_date_ini = new Carbon($task->date_ini);
                    $task_date_end = new Carbon($task->date_end);
                    if ($task_date_end < $date) {
                       // echo '<br/>Tarea: '.$task->id.' esta vencida<br/>';
                        array_push($vencidas, $task);
                        continue;
                    }

                    $days_end = $date->diffInDays($task_date_end);

                    if ($days_end != 0 && $days_end > 0 && $days_end <= $task->days_alert) {
                        array_push($por_vencer, $task);
                    }

                    //echo 'tarea: '.$task->id.'vence en '.$days_end. ' dias<br/><br/>';
                }
                if (count($por_vencer) <= 0 && count($vencidas) <= 0) {
                    continue;
                }

                $emailText = 'Hola <b>'.$user->name.'</b><br/><br/>';
                $emailText .= 'Notificación desde la Aplicación de Habeas Data de Propiedad Horizontal de Sistemas Integrados de Gestión.<br/><br/>';
                if (count($por_vencer) > 0) {
                    $emailText .= 'Tienes las siguienetes alertas por vencer: <br/>';
                    $emailText .= '<ol>';
                    foreach ($por_vencer as $v) {
                        // dd($v);
                        $emailText .= '<li><b>Alerta: </b>'.$v->description.'<br/><b>Vence el día: </b>'.$v->date_end.'</li>';
                    }
                    $emailText .= '</ol>';
                }
                if (count($vencidas)) {
                    $emailText .= '<br/><br/>';
                    $emailText .= 'Tienes las siguienetes alertas ya vencidas sin completar: <br/>';
                    $emailText .= '<ol>';
                    foreach ($vencidas as $v) {
                        // dd($v);
                        $emailText .= '<li><b>Alerta: </b>'.$v->description.'<br/><b>Vencida desde el día: </b>'.$v->date_end.'</li>';
                    }
                    $emailText .= '</ol>';
                }

                $emailText .= '<br/><br/><br/>';
                $emailText .= 'Un saludo,<br/>El Equipo de Sistemas Integrados de Gestión';

                //echo '<br/><br/>';
                //echo $emailText;
                $headers = array('Content-type:text/html;charset=UTF-8";',
                    'From: Sistemas Integrados de Gestión  <info@sistemasintegradosdegestion.co>',
                    'Reply-To: info@sistemasintegradosdegestion.co',
                    'Return-Path: info@sistemasintegradosdegestion.co',
                );
                $title = 'Notificación Sistemas Integrados de Gestión';
                //$sendTo = 'anthonydeyvis32@gmail.com'; // email del user
                $sendTo = $user->email;
                $cant_intentos = 0;
                while ($cant_intentos <= 3) {
                    $sendMail = mail($sendTo, $title, $emailText, implode("\n", $headers));
                    if ($sendMail) {
                        break;
                    } else {
                        $cant_intentos++;
                    }
                }                
            } else {
                continue;
            }
        }
    }
}
// cd /home/sistemasintegrad/public_html/appgestion/AppCore
// php /home/sistemasintegrad/public_html/appgestion/AppCore/artisan