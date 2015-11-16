@extends('layouts.dashboard')

@section('content')

    <h2>Notícias Cadastradas</h2>
    @if($news->count() == 0)
        <h2 class="btn-lg label-warning">Você não tem nenhuma notícia cadastrada!</h2>
        <a  href="{{ route('news.add') }}"><button class="btn btn-info"><i class="fa fa-plus"></i> Nova Notícia ou Evento</button></a>
    @endif
    @foreach($allNews as $singleNews)
    <div class="item  col-xs-4 col-lg-4">
        <div class="thumbnail">
            <img class="img-responsive" style="width: auto; height:300px !important" src="{{ asset($singleNews->pictures()->first()->path) }}"
                 alt=""/>

            <div class="caption" style="word-wrap: break-word;">
                <h4 class="list-group-item-heading">
                    {{ $singleNews->title }}</h4>
                <br>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <p class="lead" style="color: red;">
                            <s class="text-left">
                                @if($singleNews->base_value)
                                R${{ $singleNews->base_value }}
                                @endif
                            </s>
                        </p>
                    </div>
                    <div class="col-xs-12 col-md-12 text-center">
                        @foreach($singleNews->tags()->get() as $tag)
                            <span class="label label-info">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    <div class="col-xs-12 col-md-6">

                        <br>
                        <br>
                        <div class="btn-group">
                            <a href="{{ route('news.edit',$singleNews->id) }}"><button type="button" class="btn btn-default">Editar</button></a>
                            <a onclick="click_del('{{ route('news.delete',$singleNews->id) }}')"><button type="button" class="btn btn-danger">Excluir</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row text-center ">
        {!! $allNews->render() !!}
    </div>
@stop