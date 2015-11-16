@extends('layouts.dashboard')

@section('content')

    <h2>Editar Notícia</h2>
    {!! Form::model($edit_news, ['route' => ['news.post_edit', $edit_news->id],'files' => true,'class'=>'form-horizontal','role'=>'form']) !!}
    @include('dashboard.forms.news')
    {!! Form::close() !!}
@stop