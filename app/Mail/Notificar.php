<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notificar extends Mailable
{
    use Queueable, SerializesModels;
    public $tramite;
    public $asunto;
    public $usuario;
    public $usuario_solicitante;
    public $fecha_inicio;
    public $fecha_compromiso;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tramite, $asunto, $usuario, $usuario_solicitante, $fecha, $fecha_compromiso)
    {
        $this->tramite = $tramite;
        $this->asunto = $asunto;
        $this->usuario = $usuario;
        $this->usuario_solicitante = $usuario_solicitante;
        $this->fecha_inicio = $fecha;
        $this->fecha_compromiso = $fecha_compromiso;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos.notificacion')
            ->from('portoaguasep@gmail.com', 'SIGOP Portoaguas.')
            ->subject('Notificación Sigop - nuevo tramite asignado');
    }
}
