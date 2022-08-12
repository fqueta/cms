<?php

namespace App\Mail\sic;

use App\Qlib\Qlib;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class infoSolicitacao extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($config)
    {
        $user = Auth::user();
        $this->user = $user;
        $this->mensagem = isset($config['mensagem'])?$config['mensagem']:false;
        $this->arquivo = isset($config['arquivo'])?$config['arquivo']:false;
        $this->email_supervisor = isset($config['email_supervisor'])?$config['email_supervisor']:false;
        $this->nome_supervisor = isset($config['nome_supervisor'])?$config['nome_supervisor']:false;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject(Qlib::documento('email-info-sic','nome'));
        $this->to($this->user['email'],$this->user['nome']);
        if($this->email_supervisor && $this->nome_supervisor)
            $this->to($this->email_supervisor,$this->nome_supervisor);
        $mens = Qlib::documento('email-info-sic');
        $mens = str_replace('{nome_internauta}',$this->user['nome'],$mens);
        $mens = str_replace('{email}',$this->user['email'],$mens);
        $mens = str_replace('{mensagem}',$this->mensagem,$mens);
        if($this->arquivo){
            $this->attach(base_path().'/public/storage/'.$this->arquivo);
        }
        return $this->markdown('mail.sic.info',[
            'user'=>$this->user,
            'empresa'=>Qlib::qoption('empresa'),
            'mens'=>$mens,
        ]);
    }
}
