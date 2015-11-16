@extends('layouts.dashboard')

@section('content')

    <h2>Nova Notícia</h2>

    {!! Form::open(['route'=>'news.post_add','files' => true,'class'=>'form-horizontal','role'=>'form']) !!}
    @include('dashboard.forms.news')
    {!! Form::close() !!}
@stop