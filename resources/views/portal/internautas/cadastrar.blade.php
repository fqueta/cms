@extends('layouts.principal')

@section('nav')
    @include('portal.nav')
@endsection

@section('content')
<div class="container">
    <div class = "page-header">
        <h1 class="text-center">
           {{$titulo}}
        </h1>
     </div>
    <div class="row mt-4 mb-4">
        <div class="col-md-12 px-0">
            {!! App\Qlib\Qlib::formatMensagemInfo('<span class="sw_lato_black">Obs</span>: campos com asterisco (<i class="swfa fas fa-asterisk cad_asterisco" aria-hidden="true"></i>) são obrigatórios.','info')!!}
        </div>
    </div>
    <div class="row mb-3">
        {{App\Qlib\Qlib::formulario([
            'campos'=>$campos,
            'config'=>$config,
            'value'=>$value,
        ])}}
    </div>
</div>
@endsection

@section('css')
    @include('portal.css')
@endsection

@section('js')
    @include('portal.js')
    @include('portal.js_submit')
@endsection
