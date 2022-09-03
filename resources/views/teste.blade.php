@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pagina de teste</h1>
@stop

@section('content')
<div class="content">
    <div class="title m-b-md">
        Laravel
    </div>
    <form action="{{ route('tinymce.store') }}" method="POST">
        @csrf
        <textarea class="form-control" name="content" id="description-textarea" rows="8"></textarea>
        <br/>
        <br/>
        <button type="submit">Save</button>
    </form>

</div>
@stop

@section('css')
    <link rel="stylesheet" href=" {{url('/')}}/css/lib.css">
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: ;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
        button {
            display: inline-block;
            font-weight: 500;
            cursor:pointer;
            border: 1px solid transparent;
            padding: 0.59rem 1rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            color: #ffffff;
            background-color: #4c84ff;
            border-color: #4c84ff;
        }
    </style>
<style>
    #conteudo{
        height:200px;
        overflow-y:auto;
    }
</style>
@stop

@section('js')
    <script src=" {{url('/')}}/js/lib.js"></script>
    
@stop
