@component('mail::message')

{!!$mens!!}
<p>
    Observação: A confirmação do seu e-mail é obrigatória.
</p>
<p>
    * Este é um e-mail automático do sistema, não responda a este e-mail pois ele não será lido.
</p>
<p style="text-align: center">
    Atenciosamente
</p>
<p style="text-align: center">
    {{$empresa}}
</p>

@endcomponent
