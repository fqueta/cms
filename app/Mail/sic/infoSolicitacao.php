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
        $this->para_email = !empty($config['para_email'])?$config['para_email']:$user->email;
        $this->para_nome = !empty($config['para_nome'])?$config['para_nome']:$user->nome;
        $this->assunto = !empty($config['assunto'])?$config['assunto']:Qlib::documento('email-info-sic','nome');
        $this->mensagem = isset($config['mensagem'])?$config['mensagem']:false;
        $this->arquivos = isset($config['arquivos'])?$config['arquivos']:false;
        $this->assunto_supervisor = !empty($config['assunto_supervisor'])?$config['assunto_supervisor']:false;
        $this->mensagem_supervisor = !empty($config['mensagem_supervisor'])?$config['mensagem_supervisor']:false;
        $this->email_supervisor = !empty($config['email_supervisor'])?$config['email_supervisor']:false;
        $this->nome_supervisor = !empty($config['nome_supervisor'])?$config['nome_supervisor']:false;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->assunto);
        $this->to($this->para_email,$this->para_nome);
        if($this->email_supervisor && $this->nome_supervisor)
            $this->to($this->email_supervisor,$this->nome_supervisor);
        $mens = Qlib::documento('email-info-sic');
        $mens = str_replace('{nome_internauta}',$this->user['nome'],$mens);
        $mens = str_replace('{email}',$this->user['email'],$mens);
        $mens = str_replace('{mensagem}',$this->mensagem,$mens);
        if(isset($this->arquivos) && $this->arquivos){
            if(is_array($this->arquivos)){
                foreach ($this->arquivos as $k => $v) {
                    $this->attach(base_path().'/public/storage/'.$v);
                }
            }else{
                $this->attach(base_path().'/public/storage/'.$this->arquivos);
            }
        }
        return $this->markdown('mail.sic.info',[
            'user'=>$this->user,
            'empresa'=>Qlib::qoption('empresa'),
            'mens'=>$mens,
        ]);
    }
}
