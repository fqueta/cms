@extends('layouts.principal')

@section('nav')
    @include('portal.nav')
@endsection

@section('content')
@include('portal.sic_front.painel')
<div class="row">
    @include('admin.sic.exibe_relatorios')
</div>

@endsection

@section('css')
    @include('portal.css')
@endsection

@section('js')
    @include('portal.js')
@endsection
